<?php
/**
 * Alta Fantasia — Conexão com o Banco de Dados MySQL via PDO.
 * As credenciais são carregadas do arquivo .env com prioridade absoluta.
 * Em produção, respeita estritamente o usuário/host configurado no .env,
 * evitando tentativas espúrias com credenciais locais padrão.
 */
require_once __DIR__ . '/../env.php';

$hasEnv     = env_has_file();
$envHost    = env('DB_HOST', $hasEnv ? '127.0.0.1' : 'db');
$envPort    = env('DB_PORT', '3306');
$dbname     = env('DB_NAME', 'altafantasia');
$envUser    = env('DB_USER', 'root');
$envPass    = env('DB_PASS', $hasEnv ? '' : 'root_password');
$charset    = env('DB_CHARSET', 'utf8mb4');

$candidates = [];

// 1. Configuração prioritária especificada no .env (ou padrão)
$candidates[] = [
    'host'       => $envHost,
    'port'       => $envPort,
    'user'       => $envUser,
    'pass'       => $envPass,
    'is_primary' => true,
];

// Alternativa automática entre 'localhost' (socket) e '127.0.0.1' (TCP) COM AS MESMAS CREDENCIAIS DO USUÁRIO
if ($envHost === 'localhost') {
    $candidates[] = [
        'host'       => '127.0.0.1',
        'port'       => $envPort,
        'user'       => $envUser,
        'pass'       => $envPass,
        'is_primary' => false,
    ];
} elseif ($envHost === '127.0.0.1') {
    $candidates[] = [
        'host'       => 'localhost',
        'port'       => $envPort,
        'user'       => $envUser,
        'pass'       => $envPass,
        'is_primary' => false,
    ];
}

// Apenas se NÃO existir arquivo .env (modo de desenvolvimento local inicial):
if (!$hasEnv) {
    // Docker interno (container db:3306)
    $candidates[] = [
        'host'       => 'db',
        'port'       => '3306',
        'user'       => 'root',
        'pass'       => 'root_password',
        'is_primary' => false,
    ];
    // Docker exposto no Windows (127.0.0.1:3307)
    $candidates[] = [
        'host'       => '127.0.0.1',
        'port'       => '3307',
        'user'       => 'root',
        'pass'       => 'root_password',
        'is_primary' => false,
    ];
    // XAMPP padrão local sem senha (127.0.0.1:3306)
    $candidates[] = [
        'host'       => '127.0.0.1',
        'port'       => '3306',
        'user'       => 'root',
        'pass'       => '',
        'is_primary' => false,
    ];
}

$conn = null;
$primaryError = null;
$lastError = null;
$tested = [];

foreach ($candidates as $cfg) {
    $sig = "{$cfg['host']}:{$cfg['port']}:{$cfg['user']}";
    if (isset($tested[$sig])) {
        continue;
    }
    $tested[$sig] = true;

    try {
        $dsn = "mysql:host={$cfg['host']};port={$cfg['port']};dbname={$dbname};charset={$charset}";
        $pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_TIMEOUT            => 3,
        ]);
        $conn = $pdo;
        break;
    } catch (PDOException $e) {
        if (!empty($cfg['is_primary'])) {
            $primaryError = $e;
        }
        $lastError = $e;
    }
}

if (!$conn) {
    $err = $primaryError ?: $lastError;
    $errMsg = $err ? $err->getMessage() : 'Desconhecido';

    $diag = [];
    if ($hasEnv) {
        $diag[] = "Arquivo .env: Detectado (" . basename(env_file_path()) . ")";
    } else {
        $diag[] = "Arquivo .env: NÃO encontrado na raiz";
    }
    $diag[] = "Host: " . ($envHost ?: 'não definido');
    $diag[] = "Porta: " . $envPort;
    $diag[] = "Banco: " . $dbname;
    $diag[] = "Usuário: " . ($envUser ?: 'não definido');

    $diagStr = implode(' | ', $diag);
    error_log("Erro de Conexão MySQL [{$diagStr}]: {$errMsg}");
    die("Erro na conexão com o banco de dados ({$diagStr}): " . $errMsg);
}
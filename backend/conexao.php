<?php
/**
 * Conexão com o Banco de Dados MySQL via PDO.
 * As credenciais são carregadas do arquivo .env com suporte inteligente a fallback
 * automático entre Docker ('db:3306'), host externo ('127.0.0.1:3307') e XAMPP ('127.0.0.1:3306').
 */
require_once __DIR__ . '/../env.php';

$envHost    = env('DB_HOST', 'db');
$envPort    = env('DB_PORT', '3306');
$dbname     = env('DB_NAME', 'altafantasia');
$envUser    = env('DB_USER', 'root');
$envPass    = env('DB_PASS', 'root_password');
$charset    = env('DB_CHARSET', 'utf8mb4');

// Lista de configurações candidatas para conexão resiliente
$candidates = [
    // 1. Configuração prioritária especificada no .env
    [
        'host' => $envHost,
        'port' => $envPort,
        'user' => $envUser,
        'pass' => $envPass,
    ],
];

// Se o host configurado for 'localhost', adicionar '127.0.0.1' para evitar erro de socket UNIX no Linux/Docker
if ($envHost === 'localhost') {
    $candidates[] = [
        'host' => '127.0.0.1',
        'port' => $envPort,
        'user' => $envUser,
        'pass' => $envPass,
    ];
}

// 2. Serviço MySQL padrão do docker-compose deste projeto
$candidates[] = [
    'host' => 'db',
    'port' => '3306',
    'user' => 'root',
    'pass' => 'root_password',
];

// 3. Porta mapeada do Docker ao acessar pelo host Windows/XAMPP
$candidates[] = [
    'host' => '127.0.0.1',
    'port' => '3307',
    'user' => 'root',
    'pass' => 'root_password',
];

// 4. MySQL local nativo (XAMPP / WAMP padrão)
$candidates[] = [
    'host' => '127.0.0.1',
    'port' => '3306',
    'user' => 'root',
    'pass' => '',
];
$candidates[] = [
    'host' => '127.0.0.1',
    'port' => '3306',
    'user' => 'root',
    'pass' => 'root_password',
];

$conn = null;
$lastError = null;
$tested = [];

foreach ($candidates as $cfg) {
    $sig = "{$cfg['host']}:{$cfg['port']}:{$cfg['user']}:{$cfg['pass']}";
    if (isset($tested[$sig])) {
        continue;
    }
    $tested[$sig] = true;

    try {
        $dsn = "mysql:host={$cfg['host']};port={$cfg['port']};dbname={$dbname};charset={$charset}";
        $pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_TIMEOUT            => 2,
        ]);
        $conn = $pdo;
        break;
    } catch (PDOException $e) {
        $lastError = $e;
    }
}

if (!$conn) {
    die("Erro na conexão com o banco de dados: " . ($lastError ? $lastError->getMessage() : 'Desconhecido'));
}
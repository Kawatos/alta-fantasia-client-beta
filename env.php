<?php
/**
 * Carrega variáveis do arquivo .env (raiz do projeto) para getenv()/$_ENV.
 * Uso: require_once __DIR__ . '/env.php'; $v = env('CHAVE', 'padrao');
 */
if (!function_exists('env')) {
    function env(string $key, $default = '')
    {
        static $loaded = false;
        if (!$loaded) {
            $loaded = true;
            $file = __DIR__ . '/.env';
            if (is_readable($file)) {
                foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                    $line = trim($line);
                    if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
                        continue;
                    }
                    [$k, $v] = explode('=', $line, 2);
                    $k = trim($k);
                    $v = trim($v);
                    // Remove aspas simples ou duplas
                    if ((str_starts_with($v, '"') && str_ends_with($v, '"')) ||
                        (str_starts_with($v, "'") && str_ends_with($v, "'"))) {
                        $v = substr($v, 1, -1);
                    }
                    $_ENV[$k] = $v;
                    putenv("$k=$v");
                }
            }
        }
        $val = $_ENV[$key] ?? (getenv($key) !== false ? getenv($key) : null);
        return $val !== null ? $val : $default;
    }
}

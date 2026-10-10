<?php
/**
 * Alta Fantasia — Carregador de Variáveis de Ambiente (.env)
 * Carrega variáveis do arquivo .env para $_ENV, $_SERVER e getenv().
 * Suporte a UTF-8 com/sem BOM, comentários inline, aspas e múltiplos caminhos.
 * 
 * Uso:
 *   require_once __DIR__ . '/env.php';
 *   $host = env('DB_HOST', '127.0.0.1');
 */

if (!function_exists('env_file_path')) {
    function env_file_path(): string
    {
        static $resolvedPath = null;
        if ($resolvedPath !== null) {
            return $resolvedPath;
        }

        $candidates = [
            __DIR__ . '/.env',
            __DIR__ . '/backend/.env',
            dirname(__DIR__) . '/.env',
        ];

        foreach ($candidates as $candidate) {
            if (is_file($candidate) && is_readable($candidate)) {
                $resolvedPath = realpath($candidate) ?: $candidate;
                return $resolvedPath;
            }
        }

        $resolvedPath = '';
        return $resolvedPath;
    }
}

if (!function_exists('env_has_file')) {
    function env_has_file(): bool
    {
        return env_file_path() !== '';
    }
}

if (!function_exists('env')) {
    function env(string $key, $default = '')
    {
        static $loaded = false;
        if (!$loaded) {
            $loaded = true;
            $filePath = env_file_path();
            if ($filePath !== '') {
                $content = @file_get_contents($filePath);
                if ($content !== false) {
                    // Remove BOM UTF-8 se presente
                    if (substr($content, 0, 3) === "\xEF\xBB\xBF") {
                        $content = substr($content, 3);
                    }

                    $lines = preg_split("/\r\n|\n|\r/", $content);
                    foreach ($lines as $line) {
                        $line = trim($line);
                        if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
                            continue;
                        }

                        [$k, $v] = explode('=', $line, 2);
                        $k = trim($k);
                        $v = trim($v);

                        // Remove aspas simples ou duplas externas
                        $len = strlen($v);
                        if ($len >= 2 && (($v[0] === '"' && $v[$len - 1] === '"') || ($v[0] === "'" && $v[$len - 1] === "'"))) {
                            $v = substr($v, 1, -1);
                        } else {
                            // Se não estiver entre aspas, remove comentários inline após espaço
                            $commentPos = strpos($v, ' #');
                            if ($commentPos !== false) {
                                $v = trim(substr($v, 0, $commentPos));
                            }
                        }

                        $_ENV[$k] = $v;
                        $_SERVER[$k] = $v;
                        putenv("$k=$v");
                    }
                }
            }
        }

        if (array_key_exists($key, $_ENV)) {
            return $_ENV[$key];
        }
        if (array_key_exists($key, $_SERVER)) {
            return $_SERVER[$key];
        }
        $systemVal = getenv($key);
        if ($systemVal !== false) {
            return $systemVal;
        }

        return $default;
    }
}

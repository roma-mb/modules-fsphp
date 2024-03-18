<?php

spl_autoload_register(static function(string $class) {
    $path = __DIR__ . str_replace(['App', 'src', '\\'], ['', '', DIRECTORY_SEPARATOR], $class) . '.php';
    $path = str_replace(['//', '\\'], DIRECTORY_SEPARATOR, $path);

    if (file_exists($path)) {
        require_once($path);
    }
});

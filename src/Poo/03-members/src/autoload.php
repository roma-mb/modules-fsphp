<?php

spl_autoload_register(static function(string $class) {
    $path  = str_replace(['App', '\\'], ['src', DIRECTORY_SEPARATOR], $class);
    $path .= '.php';

    if (file_exists($path)) {
        require_once($path);
    }
});

<?php

# - NameSpace
    use Lib\Logger;

# - Autoload Manager Namespace
    spl_autoload_register(function ($class) {
        $prefixes = ['Articmi\\' => __DIR__ . '/../App/', 'Lib\\' => __DIR__ . '/'];

        foreach ($prefixes as $prefix => $base_dir) {
            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) === 0) {
                $relative_class = substr($class, $len);
                $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
                if (file_exists($file)) {
                    require $file;
                    return;
                } else {
                    Logger::log("ARTICMI/ART0001", "File not found '$file'.");
                }
            }
        }
    });
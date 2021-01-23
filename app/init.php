<?php

require_once 'config/config.php';
require_once 'core/Error_handler.php';

spl_autoload_register(function ($class) {
    $dirs = array('helpers', 'core', 'models', 'controllers');
    $file = $class . '.php';

    foreach ($dirs as $dir) {
        $classFile = __DIR__ . '/' . $dir . '/' . $file;
        if (file_exists($classFile)) {
            require_once $classFile;
            break;
        }
    }
});

<?php
// load app config
require_once 'config/config.php';

// autoload core libraries - function automatically loads classess in the libraries directory
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
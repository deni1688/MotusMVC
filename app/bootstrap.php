<?php
// load app config
require_once 'config/config.php';
// load helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/auth_helper.php';
require_once 'helpers/excerpt_helper.php';

// autoload core libraries - function automatically loads classess in the libraries directory
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
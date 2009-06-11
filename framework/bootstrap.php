<?php

if (!defined(FRAMEWORK_ROOT)) {
    define("FRAMEWORK_ROOT", realpath(dirname(__FILE__))."/");
}

// Load Log Handler...
require_once(FRAMEWORK_ROOT."sys/logger.php");
require_once(FRAMEWORK_ROOT."sys/event.php");

// Load Config Handler...
require_once(FRAMEWORK_ROOT."sys/configure.php");
joy_Configure::getInstance()->Load(FRAMEWORK_ROOT."config.ini");

// Load Namespace Handler...
require_once(FRAMEWORK_ROOT."sys/namespace.php");

?>
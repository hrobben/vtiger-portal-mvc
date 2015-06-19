<?php

// for use in development mode
error_reporting(E_ALL);

require 'config.php';
require 'util/Auth.php';
require 'include/Zend/Json.php';

// Also spl_autoload_register (Take a look at it if you like)
function __autoload($class) {
    require LIBS . $class . ".php";
}

        global $client;
        $client = new nusoap_client(SERVER_PATH."/vtigerservice.php?service=customerportal", false, PROXY_HOST, PROXY_PORT, PROXY_USERNAME, PROXY_PASSWORD);
        //We have to overwrite the character set which was set in nusoap/lib/nusoap.php file (line 151)
        $client->soap_defencoding = DEFAULT_CHARSET;

// Load the Bootstrap!
$bootstrap = new Bootstrap();

// Optional Path Settings
//$bootstrap->setControllerPath();
//$bootstrap->setModelPath();
//$bootstrap->setDefaultFile();
//$bootstrap->setErrorFile();

$bootstrap->init();

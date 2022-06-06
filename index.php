<?php

session_start();

define('WEBROOT', str_replace('index.php','', $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('index.php','', $_SERVER['SCRIPT_FILENAME']));

require_once('app/autoload.php');

$param = explode('/',$_GET['p']);
$controller = empty($param[0])?'\controllers\tutoriel': '\controllers\\'.$param[0];
$action = empty($param[1]) ? 'index' : $param[1];
print_r($_GET);

$controller = new $controller();

if(method_exists($controller, $action)){
    unset($param[0]); unset($param[1]);
    call_user_func_array([$controller, $action], $param);
}else{
    echo 'erreur 404';
}

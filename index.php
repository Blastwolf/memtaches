<?php
session_start();
if($_SERVER['HTTP_HOST'] == 'localhost'){
    define('ROOTDIR','/'.basename(__DIR__).DIRECTORY_SEPARATOR);
}
define ('ROOTPATH',__DIR__.DIRECTORY_SEPARATOR);

set_include_path(get_include_path().
    PATH_SEPARATOR . ROOTPATH . 'app' . DIRECTORY_SEPARATOR . 'views'. DIRECTORY_SEPARATOR.
    PATH_SEPARATOR . ROOTPATH . 'app' . DIRECTORY_SEPARATOR . 'models'. DIRECTORY_SEPARATOR.
    PATH_SEPARATOR . ROOTPATH . 'app' . DIRECTORY_SEPARATOR . 'controllers'. DIRECTORY_SEPARATOR.
    PATH_SEPARATOR . ROOTPATH . 'app' . DIRECTORY_SEPARATOR . 'config'. DIRECTORY_SEPARATOR.
    PATH_SEPARATOR . ROOTPATH . 'app' . DIRECTORY_SEPARATOR . 'helpers'. DIRECTORY_SEPARATOR.
    PATH_SEPARATOR . ROOTPATH . 'core' . DIRECTORY_SEPARATOR
);
spl_autoload_register(function ($class) {
    include $class .'.php';
});

require 'app/config/config.php';
require 'vendor/autoload.php';
//require 'app/controllers/Calendar_controller.php';
//require 'Router.php';



if (!empty($_SERVER['PATH_INFO'])) {
    $path = $_SERVER['PATH_INFO'];
}else{
    $path = '';
}
try {
    $router = new Router($path);
}catch(Exception $e)
{
    echo $e->getMessage();
}

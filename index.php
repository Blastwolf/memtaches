<?php
require 'app/config/config.php';
require 'app/controllers/Calendar_controller.php';
require 'Router.php';



define('ROOT',dirname(__FILE__));
//echo '<pre>';
//var_dump($_SERVER);
//echo '<pre>';

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

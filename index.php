<?php
// Định nghĩa một hằng số bảo vệ project
define("IN_SITE", true);

// Lấy module và action trên URL
$controller = isset($_GET['controller'])? $_GET['controller']: 'dashboard' ;
$action = isset($_GET['action'])?$_GET['action']: 'getDashBoard' ;

include_once('libs/session.php');
include_once('models/database.php');
include_once('libs/role.php');
include_once('libs/helper.php');
include_once('controllers/'.$controller.'.php');


$action();

?>
<?php
require 'vendor/autoload.php'; 

use Config\Database\DBConfig as DB;

Config\Database\DBConnection::setDBConnection(
    DB::$user,DB::$password, 
    DB::$hostname, DB::$databaseType, DB::$port);

\Tools\Session::initialize();
$accessController = new \Tools\Access();


if(isset($_GET['controller']))
    $controller = $_GET['controller'];
else if($accessController->islogin() && (int)(\Tools\Session::get(\Tools\Access::$activeAccount)) === (int)1)
    $controller = 'Accounts';
else if($accessController->islogin() && (int)(\Tools\Session::get(\Tools\Access::$activeAccount)) === (int)0)
    $controller = 'User';
else
    $controller ='User';

if(isset($_GET['action']))
    $action = $_GET['action'];
else if($accessController->islogin() && (int)(\Tools\Session::get(\Tools\Access::$activeAccount)) === (int)1)
    $action = 'main';
else if($accessController->islogin() && (int)(\Tools\Session::get(\Tools\Access::$activeAccount)) !== (int)1)
    $action = 'verification';
else
    $action = 'logForm';

if(isset($_GET['id']))
    $id = $_GET['id'];
else	
    $id = null;

$controller = 'Controllers\\'.$controller;

$myController = new $controller();
$myController->$action($id);



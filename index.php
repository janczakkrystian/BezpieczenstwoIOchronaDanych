<?php
require 'vendor/autoload.php'; 

use Config\Database\DBConfig as DB;

Config\Database\DBConnection::setDBConnection(
    DB::$user,DB::$password, 
    DB::$hostname, DB::$databaseType, DB::$port);

\Tools\Session::initialize();

if(isset($_GET['controller']))
    $controller = $_GET['controller'];
else
    $controller = 'User';
if(isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = 'logForm';

if(isset($_GET['id']))
    $id = $_GET['id'];
else	
    $id = null;

$controller = 'Controllers\\'.$controller;

$myController = new $controller();
$myController->$action($id);



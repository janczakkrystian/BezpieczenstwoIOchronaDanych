<?php
require 'vendor/autoload.php'; 

use Config\Database\DBConfig as DB;

Config\Database\DBConnection::setDBConnection(
    DB::$user,DB::$password, 
    DB::$hostname, DB::$databaseType, DB::$port);

\Tools\Session::initialize();
$accessController = new \Tools\Access();


//Piorytet na wylogowanie się z serwisu
if(isset($_GET['controller']) && $_GET['controller'] === 'User' && isset($_GET['action']) && $_GET['action'] === 'logout'){
    $controller = $_GET['controller'];
    $action = $_GET['action'];
}
else {
    //Priorytet na akcję z priorytetem
    if($accessController->islogin() &&
        isset($_GET['controller']) &&
        $_GET['controller'] === 'Verification' &&
        isset($_GET['action']) && $_GET['action'] === 'verificationForm' &&
        \Tools\Session::is('priority') && \Tools\Session::get('priority') === true
    ){
        $controller = $_GET['controller'];
        $action = $_GET['action'];
    }
    elseif($accessController->islogin() &&
        isset($_GET['controller']) &&
        $_GET['controller'] === 'Verification' &&
        isset($_GET['action']) && $_GET['action'] === 'verification' &&
        \Tools\Session::is('priority') && \Tools\Session::get('priority') === true
    ){
        $controller = $_GET['controller'];
        $action = $_GET['action'];
    }
    else {
        //Jeśli jestem zalogowany, to:
        if ($accessController->islogin()) {
            //Ustaw okno zmiany hasła, jeśli hasło jest ustawione losowe
            if ((int)(\Tools\Session::get(\Tools\Access::$trialLimit)) === (int)(-2)) $controller = 'User';
            //Ustaw główne okno aplikacji
            elseif(isset($_GET['controller']))  $controller = $_GET['controller'];
            else $controller = 'Accounts';
        } elseif (isset($_GET['controller']))
            $controller = $_GET['controller'];
        else
            $controller = 'User';

        if ($accessController->islogin()) {
            if ((int)(\Tools\Session::get(\Tools\Access::$trialLimit)) === (int)(-2)) $action = "changePasswordForm";
            elseif(isset($_GET['action'])) $action = $_GET['action'];
            else $action = 'main';
        } elseif (isset($_GET['action']))
            $action = $_GET['action'];
        else
            $action = 'logForm';
    }
}

if(isset($_GET['id']))
    $id = $_GET['id'];
else	
    $id = null;


$controller = 'Controllers\\'.$controller;

$myController = new $controller();
$myController->$action($id);



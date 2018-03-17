<?php
namespace Config\Database;
use \PDO;

class DBConnection{
    private static $type;
    private static $host;
    private static $port;
    private static $username;
    private static $password;

    public static function setDBConnection(
        $username, $password,
        $host, $type, $port){
        DBConnection::$username = $username;
        DBConnection::$password = $password;
        DBConnection::$host = $host;
        DBConnection::$type = $type;
        DBConnection::$port = $port;
    }

    public static function getHandle(){
        try{
            $pdo = new PDO(
                DBConnection::$type.
                ':host='.DBConnection::$host.
                ';dbname='.DBConfig::$databaseName.
                ';port='.DBConnection::$port,
                DBConnection::$username, DBConnection::$password );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(\PDOException $e){
            throw new \PDOException($e);
        }
        return null;
    }
}

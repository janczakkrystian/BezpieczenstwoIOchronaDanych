<?php
namespace Models;
use \PDO;
class Log extends Model {

    public function newLog($description, $idUser, $ip = null){
        $data = array();
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($description == null || $idUser == null){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        if($ip == null){
            $ip = "127.0.0.1";
        }
        $date = date('Y-m-d H:i:s', time());
        try{
            $stmt = $this->pdo->prepare('
                    INSERT INTO `'.\Config\Database\DBConfig::$tableLog.'`
                    (`'.\Config\Database\DBConfig::$tableLog.'`.`'.\Config\Database\DBConfig\Log::$Description.'`,
                     `'.\Config\Database\DBConfig::$tableLog.'`.`'.\Config\Database\DBConfig\Log::$Date.'`,
                     `'.\Config\Database\DBConfig::$tableLog.'`.`'.\Config\Database\DBConfig\Log::$IP.'`,
                     `'.\Config\Database\DBConfig::$tableLog.'`.`'.\Config\Database\DBConfig\Log::$IdUser.'`)
                    VALUES(:description , :date , :ip, :idUser)
                ');
            $stmt->bindValue(':description' , $description , PDO::PARAM_STR);
            $stmt->bindValue(':date' , $date , PDO::PARAM_STR);
            $stmt->bindValue(':ip' , $ip , PDO::PARAM_STR);
            $stmt->bindValue(':idUser' , $idUser , PDO::PARAM_INT);
            $result = $stmt->execute();
            if(!$result){
                $data['error'] = \Config\Database\DBErrorName::$query;
                return $data;
            }
            else{
                $data['message'] = "Dodano log.";
            }
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getAll($idUser){
        $data = array();
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($idUser === null){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data['logs'] = array();
        try{
            $stmt = $this->pdo->prepare('
                    SELECT *  
                    FROM `'.\Config\Database\DBConfig::$tableLog.'` 
                    WHERE `'.\Config\Database\DBConfig::$tableLog.'`.`'.\Config\Database\DBConfig\Log::$IdUser.'` = :idUser
                    ORDER BY `'.\Config\Database\DBConfig::$tableLog.'`.`'.\Config\Database\DBConfig\Log::$Date.'` DESC'
            );
            $stmt->bindValue(':idUser' , $idUser , PDO::PARAM_INT);
            $result = $stmt->execute();
            if(!$result){
                $data['error'] = "Nie udało się pobrać logów.";
                return $data;
            }
            $data['logs'] = $stmt->fetchAll();
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

}
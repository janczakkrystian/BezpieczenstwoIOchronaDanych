<?php
    namespace Models;
    use Config\Database\DBConfig;
    use \PDO;
    class PasswordHistory extends Model {
        public function getAllPasswordHistoryForUser($idUser){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($idUser === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            try{
                $stmt = $this->pdo->prepare('
                    SELECT *  
                    FROM `'.\Config\Database\DBConfig::$tablePasswordsHistory.'` 
                    WHERE `'.\Config\Database\DBConfig::$tablePasswordsHistory.'`.`'.\Config\Database\DBConfig\PasswordsHistory::$IdUser.'` = :idUser');
                $stmt->bindValue(':idUser' , $idUser , PDO::PARAM_INT);
                $stmt->execute();
                $passwordsHistory = $stmt->fetchAll();
                $data['passwordsHistory'] = $passwordsHistory;
                $stmt->closeCursor();
            }
            catch(\PDOException $e){
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        public function addNewPasswordForUser($idUser , $password){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($idUser === null || $password === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            $createDate = date('Y-m-d');
            $options = array('cost' => 6);
            $password = password_hash($password , PASSWORD_BCRYPT, $options);
            try{
                $stmt = $this->pdo->prepare('
                    INSERT INTO `'.\Config\Database\DBConfig::$tablePasswordsHistory.'`
                    (`'.\Config\Database\DBConfig::$tablePasswordsHistory.'`.`'.\Config\Database\DBConfig\PasswordsHistory::$Password.'`,
                     `'.\Config\Database\DBConfig::$tablePasswordsHistory.'`.`'.\Config\Database\DBConfig\PasswordsHistory::$IdUser.'`,
                     `'.\Config\Database\DBConfig::$tablePasswordsHistory.'`.`'.\Config\Database\DBConfig\PasswordsHistory::$CreateDate.'`)
                    VALUES(:password , :idUser , :createDate)
                ');
                $stmt->bindValue(':idUser' , $idUser , PDO::PARAM_INT);
                $stmt->bindValue(':password' , $password , PDO::PARAM_STR);
                $stmt->bindValue(':createDate' , $createDate , PDO::PARAM_STR);
                $result = $stmt->execute();
                if(!$result){
                    $data['error'] = \Config\Database\DBErrorName::$query;
                    return $data;
                }
                $stmt->closeCursor();
            }
            catch(\PDOException $e){
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        public function checkPassword($idUser , $password){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($idUser === null || $password === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            $data = $this->getAllPasswordHistoryForUser($idUser);
            if(isset($data['error']))
                return $data;
            $passwordsHistory = $data['passwordsHistory'];
            if(!isset($passwordsHistory)){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            $data = array();
            foreach ($passwordsHistory as $passwordHistory){
                if(password_verify($password , $passwordHistory[\Config\Database\DBConfig\PasswordsHistory::$Password])){
                    $data['error'] = "Hasło nie może się powtarzać";
                    $data['checkPassword'] = false;
                    return $data;
                }
            }
            if(!isset($data['checkPassword']))
                $data['checkPassword'] = true;
            return $data;
        }
    }
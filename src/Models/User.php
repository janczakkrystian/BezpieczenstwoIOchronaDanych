<?php
    namespace Models;
    use Config\Database\DBConfig;
    use \PDO;
    class User extends Model {

        public function register($FirstName , $LastName , $Email , $Login , $Password){
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($FirstName === null || $LastName === null || $Email === null || $Login === null || $Password === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            $data = array();
            $options = array('cost' => 6);
            $Password = password_hash($Password , PASSWORD_BCRYPT, $options);
            $Code = rand(1 , 1000000000) + 999999999;
            $IdStatus = 2;
            $TrialLimit = 7;
            $Active = 0;
            $CreateDate = date('Y-m-d');
            try{
                $stmt = $this->pdo->prepare('
                  START TRANSACTION;
                  INSERT INTO `'.\Config\Database\DBConfig::$tableUser.'` (`'.\Config\Database\DBConfig\User::$FirstName.'` , `'.\Config\Database\DBConfig\User::$LastName.'`, `'.\Config\Database\DBConfig\User::$Email.'` , `'.\Config\Database\DBConfig\User::$Login.'` , `'.\Config\Database\DBConfig\User::$Password.'` , `'.\Config\Database\DBConfig\User::$Code.'` , `'.\Config\Database\DBConfig\User::$IdStatus.'`, `'.\Config\Database\DBConfig\User::$TrialLimit.'` , `'.\Config\Database\DBConfig\User::$Active.'`) VALUES (:FirstName , :LastName , :Email , :Login , :Password , :Code , :IdStatus , :TrialLimit , :Active);
                  SET @id = (SELECT LAST_INSERT_ID());
                  INSERT `'.\Config\Database\DBConfig::$tablePasswordsHistory.'` (`'.\Config\Database\DBConfig\PasswordsHistory::$Password.'` , `'.\Config\Database\DBConfig\PasswordsHistory::$CreateDate.'` , `'.\Config\Database\DBConfig\PasswordsHistory::$IdUser.'`) VALUES(:Password2 , :CreateDate , @id);
                  COMMIT;
                  ');
                $stmt->bindValue(':FirstName' , $FirstName , PDO::PARAM_STR);
                $stmt->bindValue(':LastName' , $LastName , PDO::PARAM_STR);
                $stmt->bindValue(':Email' , $Email , PDO::PARAM_STR);
                $stmt->bindValue(':Login' , $Login , PDO::PARAM_STR);
                $stmt->bindValue(':Password' , $Password , PDO::PARAM_STR);
                $stmt->bindValue(':Code' , $Code , PDO::PARAM_INT);
                $stmt->bindValue(':IdStatus' , $IdStatus , PDO::PARAM_INT);
                $stmt->bindValue(':TrialLimit' , $TrialLimit , PDO::PARAM_INT);
                $stmt->bindValue(':Active' , $Active , PDO::PARAM_BOOL);
                $stmt->bindValue(':Password2' , $Password , PDO::PARAM_BOOL);
                $stmt->bindValue(':CreateDate' , $CreateDate , PDO::PARAM_STR);
                $result = $stmt->execute();
                if(!$result)
                    $data['error'] = \Config\Database\DBErrorName::$noadd;
                else
                    $data['message'] = \Config\Database\DBMessageName::$registerok;
                $stmt->closeCursor();
            }
            catch(\PDOException $e){
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        public function getCode($id){
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            $data = array();
            try{
                $stmt = $this->pdo->prepare('SELECT `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$Code.'` FROM `'.\Config\Database\DBConfig::$tableUser.'` WHERE `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$IdUser.'` = :id');
                $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
                $stmt->execute();
                $code = $stmt->fetchAll();
                if($code && !empty($code)){
                    $data['code'] = $code[0];
                }
                $stmt->closeCursor();
            }
            catch(\PDOException $e){
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        public function validatePassword($Login , $Password){
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($Login === null || $Password === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            $data = array();
            try{
                $stmt = $this->pdo->prepare('SELECT `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$Password.'` FROM `'.\Config\Database\DBConfig::$tableUser.'` WHERE `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$Login.'` = :login');
                $stmt->bindValue(':login' , $Login , PDO::PARAM_STR);
                $stmt->execute();
                $code = $stmt->fetchAll();
                if($code && !empty($code)){
                    if($code[0] && !empty($code[0])){
                        if($code[0][\Config\Database\DBConfig\User::$Password] && !empty($code[0][\Config\Database\DBConfig\User::$Password])){
                            if(password_verify($Password , $code[0][\Config\Database\DBConfig\User::$Password])){
                                $data['validate'] = true;
                            }
                            else $data['validate'] = false;
                        }
                        else $data['validate'] = false;
                    }
                    else $data['validate'] = false;
                }
                else $data['validate'] = false;

                $stmt->closeCursor();
            }
            catch(\PDOException $e){
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

    }
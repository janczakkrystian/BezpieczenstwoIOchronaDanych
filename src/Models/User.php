<?php
    namespace Models;
    use Config\Database\DBConfig;
    use \PDO;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    class User extends Model {

        private function generateCode(){
            return rand(1 , 1000000000) + 999999999;
        }

        private function sendByEmail($email, $firstName , $lastname , $subject , $body){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($email === null || $firstName === null || $lastname === null || $subject === null || $body === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }

            //require '\Tools\PHPMailer\PHPMailerAutoload.php';
            $mail = new PHPMailer(true);
            try{
                //Configuration my email account
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = \Config\Database\DBConfig::$hostEmail;  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = \Config\Database\DBConfig::$userNameEmail;                 // SMTP username
                $mail->Password = \Config\Database\DBConfig::$passwordEmail;                           // SMTP password
                $mail->SMTPSecure = \Config\Database\DBConfig::$SMTPSecureEmail;                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = \Config\Database\DBConfig::$PORTEmail;                                    // TCP port to connect to

                //Adresses to
                $mail->setFrom(\Config\Database\DBConfig::$fullNameEmail, \Config\Database\DBConfig::$subjectEmail);
                $mail->addAddress($email, $lastname.' '.$firstName);     // Add a recipient

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = \Config\Database\DBConfig::$subjectEmail."".$subject;
                $mail->Body    = $body;
                $mail->AltBody = $body;

                //Send email
                $mail->send();
                $mail->smtpClose();
            }
            catch(\Exception $e){
                $data['error'] = \Config\Database\DBErrorName::$createMail;
            }
            return $data;
        }

        public function getUserData($id){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($id === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            try{
                $stmt = $this->pdo->prepare('
                    SELECT * 
                    FROM `'.\Config\Database\DBConfig::$tableUser.'` 
                    WHERE `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$IdUser.'` = :id');
                $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
                $stmt->execute();
                $user = $stmt->fetchAll();
                $user = $user[0];
                $data['user'] = $user;
                $stmt->closeCursor();
            }
            catch(\PDOException $e){
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        public function register($FirstName , $LastName , $Email , $Login , $Password){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($FirstName === null || $LastName === null || $Email === null || $Login === null || $Password === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            $options = array('cost' => 6);
            $Password = password_hash($Password , PASSWORD_BCRYPT, $options);
            $Code = $this->generateCode();
            $IdStatus = 2;
            $TrialLimit = 2;
            $Active = false;
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
                else {
                    $data = $this->sendByEmail($Email , $FirstName , $LastName , \Config\Database\DBMessageName::$veryficationCodeEmailSubject , \Config\Database\DBMessageName::$veryficationCodeEmailBody.$Code);
                    if(isset($data['error'])){
                        return $data;
                    }
                    $data['message'] = \Config\Database\DBMessageName::$registerok;
                }
                $stmt->closeCursor();
            }
            catch(\PDOException $e){
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        public function getCode($id){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($id === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            try{
                $stmt = $this->pdo->prepare('SELECT `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$IdUser.'` , `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$Code.'` FROM `'.\Config\Database\DBConfig::$tableUser.'` WHERE `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$IdUser.'` = :id');
                $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
                $stmt->execute();
                $code = $stmt->fetchAll();
                $code = $code[0][\Config\Database\DBConfig\User::$Code];
                $data['code'] = $code;
                $stmt->closeCursor();
            }
            catch(\PDOException $e){
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        private function setCode($id , $code){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($id === null || $code === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            try{
                $stmt = $this->pdo->prepare('UPDATE `'.\Config\Database\DBConfig::$tableUser.'` SET `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$Code.'` = :code WHERE `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$IdUser.'` = :id');
                $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
                $stmt->bindValue(':code' , $code , PDO::PARAM_INT);
                $result = $stmt->execute();
                if(!$result) $data['error'] = \Config\Database\DBErrorName::$query;
                $stmt->closeCursor();
            }
            catch(\PDOException $e){
                $data['error'] = \Config\Database\DBErrorName::$query;
                return $data;
            }
            return $data;
        }

        private function sendCodeByEmail($idUser){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($idUser === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            $data = $this->getUserData($idUser);
            if(isset($data['error'])){
                return $data;
            }
            $data = $this->sendByEmail($data['user'][\Config\Database\DBConfig\User::$Email] , $data['user'][\Config\Database\DBConfig\User::$FirstName] , $data['user'][\Config\Database\DBConfig\User::$LastName] , \Config\Database\DBMessageName::$veryficationCodeEmailSubject , \Config\Database\DBMessageName::$veryficationCodeEmailBody.$data['user'][\Config\Database\DBConfig\User::$Code]);
            if(isset($data['error'])){
                return $data;
            }
            return $data;
        }

        public function showTrialLimit($id){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($id === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            try{
                $stmt = $this->pdo->prepare('
                    SELECT `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$TrialLimit.'` 
                    FROM `'.\Config\Database\DBConfig::$tableUser.'` 
                    WHERE `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$IdUser.'` = :id;');
                $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
                $result = $stmt->execute();
                if(!$result){
                    $data['error'] = \Config\Database\DBErrorName::$query;
                    return $data;
                }
                $trialLimit = $stmt->fetchAll();
                $data['trialLimit'] = $trialLimit[0][\Config\Database\DBConfig\User::$TrialLimit];
                $stmt->closeCursor();
            }
            catch(\PDOException $e){
                $data['error'] = \Config\Database\DBErrorName::$query;
                return $data;
            }
            return $data;
        }

        public function setTrialLimit($id , $trialLimit){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($id === null || $trialLimit === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            try{
                $stmt = $this->pdo->prepare('           
                    UPDATE `'.\Config\Database\DBConfig::$tableUser.'` 
                    SET `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$TrialLimit.'` = :trialLimit 
                    WHERE `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$IdUser.'` = :id;
                    ');
                $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
                $stmt->bindValue(':trialLimit' , $trialLimit , PDO::PARAM_INT);
                $result = $stmt->execute();
                if(!$result){
                    $data['error'] = \Config\Database\DBErrorName::$query;
                    return $data;
                }
                $stmt->closeCursor();
            }
            catch(\PDOException $e){
                $data['error'] = \Config\Database\DBErrorName::$query;
                return $data;
            }
            return $data;
        }

        public function verificationAccount($id , $code){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($id === null || $code === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }

            $data = $this->getCode($id);
            if(isset($data['error'])){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            if(!isset($data['code'])){
                $data['error'] = \Config\Database\DBErrorName::$errorCode;
                return $data;
            }
            $codeFromBase = $data['code'];
            if($codeFromBase && !empty($codeFromBase)){

                if((int)$code === (int)$codeFromBase) {
                    try {
                        $stmt = $this->pdo->prepare('UPDATE `'.\Config\Database\DBConfig::$tableUser.'` SET `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$Active.'` = 1 WHERE `' . \Config\Database\DBConfig::$tableUser . '`.`' . \Config\Database\DBConfig\User::$IdUser . '` = :id');
                        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                        $result = $stmt->execute();
                        $stmt->closeCursor();

                        if($result) {
                            
                            $data['message'] = \Config\Database\DBMessageName::$veryficationOk;
                        }
                        else $data['error'] = \Config\Database\DBErrorName::$query;

                    } catch (\PDOException $e) {
                        $data['error'] = \Config\Database\DBErrorName::$query;
                        return $data;
                    }
                }
                else{
                    $data = $this->showTrialLimit($id);
                    $trialLimit = $data['trialLimit'];
                    if($trialLimit > 0) {
                        $trialLimit = $trialLimit - 1;
                        $data = $this->setTrialLimit($id , $trialLimit);
                        if (isset($data['error'])) {
                            return $data;
                        }
                    }
                    if($trialLimit <= 0){
                        $data = $this->setCode($id , $this->generateCode());
                        if(isset($data['error'])){
                            return $data;
                        }
                        $data = $this->sendCodeByEmail($id);
                        if(isset($data['error'])){
                            return $data;
                        }
                        $data = $this->setTrialLimit($id , 2);
                        if(isset($data['error'])){
                            return $data;
                        }
                        $data['error'] = \Config\Database\DBMessageName::$generatedNewCode;
                    }
                    else
                        $data['error'] = \Config\Database\DBErrorName::$errorCode." Pozostało ".$trialLimit." prób.";
                    return $data;
                }

            }
            else{
                $data['error'] = \Config\Database\DBErrorName::$nomatch;
                return $data;
            }
            return $data;
        }

        public function validatePassword($Login , $Password){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($Login === null || $Password === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
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
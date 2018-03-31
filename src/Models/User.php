<?php
    namespace Models;
    use Config\Database\DBConfig;
    use \PDO;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    class User extends Model {

        private function generateCode(){
            return rand(1 , 900000000) + 99999999;
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
                  INSERT INTO `'.\Config\Database\DBConfig::$tableUser.'` (`'.\Config\Database\DBConfig\User::$FirstName.'` , 
                                `'.\Config\Database\DBConfig\User::$LastName.'`, 
                                `'.\Config\Database\DBConfig\User::$Email.'` , 
                                `'.\Config\Database\DBConfig\User::$Login.'` , 
                                `'.\Config\Database\DBConfig\User::$Password.'` , 
                                `'.\Config\Database\DBConfig\User::$Code.'` , 
                                `'.\Config\Database\DBConfig\User::$IdStatus.'`, 
                                `'.\Config\Database\DBConfig\User::$TrialLimit.'` , 
                                `'.\Config\Database\DBConfig\User::$Active.'`) 
                                VALUES (:FirstName , :LastName , :Email , :Login , :Password , :Code , :IdStatus , :TrialLimit , :Active);
                  SET @id = (SELECT LAST_INSERT_ID());
                  INSERT `'.\Config\Database\DBConfig::$tablePasswordsHistory.'` 
                            (`'.\Config\Database\DBConfig\PasswordsHistory::$Password.'` , 
                            `'.\Config\Database\DBConfig\PasswordsHistory::$CreateDate.'` , 
                            `'.\Config\Database\DBConfig\PasswordsHistory::$IdUser.'`) 
                            VALUES(:Password2 , :CreateDate , @id);
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
                    $data = $this->sendByEmail($Email ,
                                                $FirstName ,
                                                $LastName ,
                                                \Config\Database\DBMessageName::$veryficationCodeEmailSubject ,
                                        \Config\Database\DBMessageName::$veryficationCodeEmailBody.$Code);
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
                $stmt = $this->pdo->prepare('
                    SELECT `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$IdUser.'` , 
                    `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$Code.'` 
                    FROM `'.\Config\Database\DBConfig::$tableUser.'` 
                    WHERE `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$IdUser.'` = :id');
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
                $stmt = $this->pdo->prepare('
                    UPDATE `'.\Config\Database\DBConfig::$tableUser.'` 
                    SET `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$Code.'` = :code 
                    WHERE `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$IdUser.'` = :id');
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

        public function generatePassword(){
            $length = 20;
            $available_sets = 'luds';
            $sets = array();
            if(strpos($available_sets, 'l') !== false)
                $sets[] = 'abcdefghjkmnpqrstuvwxyz';
            if(strpos($available_sets, 'u') !== false)
                $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
            if(strpos($available_sets, 'd') !== false)
                $sets[] = '0123456789';
            if(strpos($available_sets, 's') !== false)
                $sets[] = '!@#$%&*?[]|;:<>,.';
            $all = '';
            $password = '';
            foreach($sets as $set)
            {
                $password .= $set[array_rand(str_split($set))];
                $all .= $set;
            }
            $all = str_split($all);
            for($i = 0; $i < $length - count($sets); $i++)
                $password .= $all[array_rand($all)];
            $password = str_shuffle($password);
            return $password;
        }

        private function setPassword($id , $password){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($id === null || $password === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            $options = array('cost' => 6);
            $password = password_hash($password , PASSWORD_BCRYPT, $options);
            try{
                $stmt = $this->pdo->prepare('
                    UPDATE `'.\Config\Database\DBConfig::$tableUser.'` 
                    SET `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$Password.'` = :password 
                    WHERE `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$IdUser.'` = :id');
                $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
                $stmt->bindValue(':password' , $password , PDO::PARAM_INT);
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

        public function sendCodeByEmail($idUser){
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
            $data = $this->sendByEmail($data['user'][\Config\Database\DBConfig\User::$Email] ,
                                        $data['user'][\Config\Database\DBConfig\User::$FirstName] ,
                                        $data['user'][\Config\Database\DBConfig\User::$LastName] ,
                                        \Config\Database\DBMessageName::$veryficationCodeEmailSubject ,
                                \Config\Database\DBMessageName::$veryficationCodeEmailBody.
                                            $data['user'][\Config\Database\DBConfig\User::$Code]);
            if(isset($data['error'])){
                return $data;
            }
            $data['message'] = \Config\Database\DBMessageName::$sendAgainCode;
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
                        $stmt = $this->pdo->prepare('
                            UPDATE `'.\Config\Database\DBConfig::$tableUser.'` 
                            SET `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$Active.'` = 1 
                            WHERE `' . \Config\Database\DBConfig::$tableUser . '`.`' . \Config\Database\DBConfig\User::$IdUser . '` = :id');
                        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                        $result = $stmt->execute();
                        $stmt->closeCursor();

                        if($result) {
                            $data = $this->setCode($id , $this->generateCode());
                            if(isset($data['error'])){return $data;}
                            $data = $this->setTrialLimit($id , 7);
                            if(isset($data['error'])){return $data;}
                            $data = array();
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

        private function findUserForLogin($login){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($login === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            try{
                $stmt = $this->pdo->prepare('
                    SELECT *  
                    FROM `'.\Config\Database\DBConfig::$tableUser.'` 
                    WHERE `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$Login.'` = :login');
                $stmt->bindValue(':login' , $login , PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetchAll();
                $data['user'] = $user[0];
                $stmt->closeCursor();
            }
            catch(\PDOException $e){
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        public function changePassword($login , $oldpassword , $newpassword , $mustBeChanged = false){
            $data = array();
            if($this->pdo === null){
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if($login === null || $oldpassword === null || $newpassword === null){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            $data = $this->findUserForLogin($login);
            if(isset($data['error']))
                return $data;
            if(!isset($data['user']))
                return $data;
            $user = $data['user'];
            if($oldpassword === $newpassword){
                $data['error'] = "Nie można zmienić na to samo hasło!";
                return $data;
            }
            if(password_verify($oldpassword , $user[\Config\Database\DBConfig\User::$Password])){
                $data = $this->setPassword($user[\Config\Database\DBConfig\User::$IdUser] , $newpassword);
                if(isset($data['error']))
                    return $data;
                if($mustBeChanged)
                {
                    $data = $this->setTrialLimit($user[\Config\Database\DBConfig\User::$IdUser] , 7);
                    if(isset($data['error']))
                        return $data;
                }
                $data = array();
                $data['message'] = \Config\Database\DBMessageName::$changePasswordOk;
                $data['change'] = true;
                \Tools\Session::set(\Tools\Access::$trialLimit , 7);
                return $data;
            }
            else
                $data['error'] = \Config\Database\DBErrorName::$errorChangePassword." ".$user[\Config\Database\DBConfig\User::$Login];
            $data['change'] = false;
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

            $data = $this->findUserForLogin($Login);
            if(isset($data['error']))
                return $data;
            else if(!isset($data['user'])){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            $user = $data['user'];
            $id = $user[\Config\Database\DBConfig\User::$IdUser];

            if($user && !empty($user)){
                if($user && !empty($user)){
                    if($user[\Config\Database\DBConfig\User::$Password] && !empty($user[\Config\Database\DBConfig\User::$Password])){
                        if(password_verify($Password , $user[\Config\Database\DBConfig\User::$Password])){
                            $data['validate'] = true;
                            $data['message'] = \Config\Database\DBMessageName::$loginOk;
                            $data['active'] = $user[\Config\Database\DBConfig\User::$Active];
                            \Tools\Access::login($Login ,
                                                $user[\Config\Database\DBConfig\User::$IdUser] ,
                                                $user[\Config\Database\DBConfig\User::$Active] ,
                                                $user[\Config\Database\DBConfig\User::$FirstName] ,
                                                $user[\Config\Database\DBConfig\User::$LastName],
                                                $user[\Config\Database\DBConfig\User::$TrialLimit]
                                );
                            if($data[\Config\Database\DBConfig\User::$TrialLimit > 0]) {
                                $data = $this->setTrialLimit($id, 7);
                                if (isset($data['error']))
                                    return $data;
                            }
                        }
                        else $data['validate'] = false;
                    }
                    else $data['validate'] = false;
                }
                else $data['validate'] = false;
            }
            else $data['validate'] = false;

            if(!isset($data['validate']) || $data['validate'] === false){
                $data['validate'] = false;
                $data['error'] = \Config\Database\DBErrorName::$dataLoginWrong;

                $data = $this->showTrialLimit($id);
                if(isset($data['error']))
                    return $data;
                else if(!isset($data['trialLimit'])){
                    $data['error'] = \Config\Database\DBErrorName::$empty;
                    return $data;
                }
                $trialLimit = $data['trialLimit'];
                if($trialLimit > 0) {
                    $trialLimit = $trialLimit - 1;
                    $data = $this->setTrialLimit($id , $trialLimit);
                    if (isset($data['error'])) {
                        return $data;
                    }
                }
                else if($trialLimit <= 0 && $trialLimit >= -1){
                    $data = $this->setTrialLimit($id , -2);
                    if(isset($data['error']))
                        return $data;

                    $generatedPassword = $this->generatePassword();
                    $data = $this->setPassword($id , $generatedPassword);
                    if(isset($data['error']))
                        return $data;

                    $data = $this->sendByEmail($user[\Config\Database\DBConfig\User::$Email] ,
                                                $user[\Config\Database\DBConfig\User::$FirstName] ,
                                                $user[\Config\Database\DBConfig\User::$LastName] ,
                                                \Config\Database\DBConfig::$subjectEmail ,
                                                nl2br('Zostało wygenerowane nowe hasło: "<b>'.$generatedPassword.'"</b>.'
                                                .PHP_EOL." Silne hasło zostało wygenerowane z dwóch powodów:"
                                                .PHP_EOL." - zbyt duża liczba pomyłek przy wpisywaniu hasła do konta"
                                                .PHP_EOL." - próba kradzieży konta metodą brute force."
                                                .PHP_EOL." Po zalogowaniu się nowym hasłem, zostaniesz poproszony o zmienienie go na swoje."
                                                .PHP_EOL." Za utrudnienia przepraszamy.")
                    );
                    $data['message'] = \Config\Database\DBMessageName::$generatedNewPassword;
                }
                else $data['message'] = \Config\Database\DBMessageName::$passwordWasSent;
            }
            return $data;
        }

        public function logout(){
            \Tools\Access::logout();
        }

    }
<?php
    namespace Models;
    use \PDO;
    use \Models\Log;
    class Accounts extends Model {


        public function getAll()
        {
            if($this->pdo == null)
            {
                $data['error']= \Config\Database\DBErrorName::$connection;
                return $data;
            }
            $data = array ();
            $data['account'] = array();
            try
            {
            $account = array();
            $stmt = $this->pdo->query('SELECT * FROM ' . \Config\Database\DBConfig::$tableAccount . ' INNER JOIN '
                . \Config\Database\DBConfig::$tableAccountDictionary . ' ON ' . \Config\Database\DBConfig::$tableAccount .
                '.' . \Config\Database\DBConfig\Account::$IdAccountDictionary . ' = '
                . \Config\Database\DBConfig::$tableAccountDictionary . '.' . \Config\Database\DBConfig\AccountDictionary::$IdAccountDictionary.'
				inner join useraccount on account.IdAccount = useraccount.IdAccount where useraccount.IdUser = '.$_SESSION['idUser']);
            while ($row = $stmt -> fetch())
            {
                $account[$row['IdAccount']] = $row;
            }
            $stmt->closeCursor();
            if($account && !empty($account))
                $data['account'] = $account;
            else
                $data['account']= array();
            }
            catch(\PDOException $e)
            {
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }
		
		public function getByName($name)
        {
            if($this->pdo == null)
            {
                $data['error']= \Config\Database\DBErrorName::$connection;
                return $data;
            }
            $data = array ();
            $data['account'] = array();
            try
            {
            $account = array();
            $stmt = $this->pdo->prepare('SELECT * FROM ' . \Config\Database\DBConfig::$tableAccount . ' INNER JOIN '
                . \Config\Database\DBConfig::$tableAccountDictionary . ' ON ' . \Config\Database\DBConfig::$tableAccount .
                '.' . \Config\Database\DBConfig\Account::$IdAccountDictionary . ' = '
                . \Config\Database\DBConfig::$tableAccountDictionary . '.' . \Config\Database\DBConfig\AccountDictionary::$IdAccountDictionary.'
				inner join useraccount on account.IdAccount = useraccount.IdAccount where accountdictionary.Name = "'.$name.'"');
			$result = $stmt->execute(); 
            $account = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
			
            if($account && !empty($account))
                $data['account'] = $account;
            else
                $data['account']= array();
            }
            catch(\PDOException $e)
            {
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }
		
		public function getAccountDictionariesByUser()
        {
            if($this->pdo == null)
            {
                $data['error']= \Config\Database\DBErrorName::$connection;
                return $data;
            }
            $data = array ();
            $data['account'] = array();
            try
            {
            $account = array();
            $stmt = $this->pdo->prepare('SELECT DISTINCT Name FROM ' . \Config\Database\DBConfig::$tableAccount . ' INNER JOIN '
                . \Config\Database\DBConfig::$tableAccountDictionary . ' ON ' . \Config\Database\DBConfig::$tableAccount .
                '.' . \Config\Database\DBConfig\Account::$IdAccountDictionary . ' = '
                . \Config\Database\DBConfig::$tableAccountDictionary . '.' . \Config\Database\DBConfig\AccountDictionary::$IdAccountDictionary.'
				inner join useraccount on account.IdAccount = useraccount.IdAccount where useraccount.IdUser = '.$_SESSION['idUser']);
			$result = $stmt->execute(); 
            $account = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
			
            if($account && !empty($account))
                $data['account'] = $account;
            else
                $data['account']= array();
            }
            catch(\PDOException $e)
            {
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }
		
		public function getAccountDictionaries()
        {
            if($this->pdo == null)
            {
                $data['error']= \Config\Database\DBErrorName::$connection;
                return $data;
            }
            $data = array ();
            $data['account'] = array();
            try
            {
            $account = array();
			$stmt = $this->pdo->query('select * from '. \Config\Database\DBConfig::$tableAccountDictionary);
            while ($row = $stmt -> fetch())
            {
                $account[$row['IdAccountDictionary']] = $row;
            }
            $stmt->closeCursor();
            if($account && !empty($account))
                $data['account'] = $account;
            else
                $data['account']= array();
            }
            catch(\PDOException $e)
            {
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        public function getAllForSelect()
        {
            $data = $this->getAll();
            $accounts = array();
            if (!isset($data['error']))
                foreach ($data['account'] as $account)
                    $accounts [$account[\Config\Database\DBConfig\Account::$IdAccountDictionary]] = $account[\Config\Database\DBConfig\Account::$Login];
            return $accounts;
        }
		
		public function getAcountsDictionariesForSelect()
        {
            $data = $this->getAccountDictionaries();
            $accounts = array();
            if (!isset($data['error']))
                foreach ($data['account'] as $account)
                    $accounts [$account[\Config\Database\DBConfig\AccountDictionary::$IdAccountDictionary]] = $account[\Config\Database\DBConfig\AccountDictionary::$Name];
            return $accounts;
        }

        public function getOne($id)
        {
            if ($this->pdo === null) {
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if ($id === null) {
                $data['error'] = \Config\Database\DBErrorName::$nomatch;
                return $data;
            }
            $data = array();
            $data['account'] = array();
            try {
                $stmt = $this->pdo->prepare('SELECT * FROM `' . \Config\Database\DBConfig::$tableAccount . '`WHERE  `' . \Config\Database\DBConfig\Account::$IdAccount . '`=:id');
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $result = $stmt->execute();
                $account = $stmt->fetch();
                $stmt->closeCursor();
                if ($account && !empty($account))
                    $data['account'] = $account;
                else
                    $data['error'] = \Config\Database\DBErrorName::$nomatch;
            } catch (\PDOException $e) {
                var_dump($e);
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        public function getOneForOne($id)
        {
            if ($this->pdo === null) {
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if ($id === null) {
                $data['error'] = \Config\Database\DBErrorName::$nomatch;
                return $data;
            }
            $data = array();
            $data['account'] = array();
            try {
                $stmt = $this->pdo->prepare('SELECT * FROM `' . \Config\Database\DBConfig::$tableAccount . '`WHERE  `' . \Config\Database\DBConfig\Account::$IdAccount . '`=:id');
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $result = $stmt->execute();
                $account = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                if ($account && !empty($account))
                    $data['account'] = $account;
                else
                    $data['error'] = \Config\Database\DBErrorName::$nomatch;
            } catch (\PDOException $e) {
                var_dump($e);
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        public function add($IdAccountDictionary, $Login, $Password, $userId, $IP)
        {
            if ($this->pdo === null) {
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if ($IdAccountDictionary === null || $Login === null || $Password === null || $userId === null || $IP === null) {
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            $data = array();
            try {
                $stmt = $this->pdo->prepare('INSERT INTO `' . \Config\Database\DBConfig::$tableAccount . '` (`' . \Config\Database\DBConfig\Account::$IdAccountDictionary . '` , `' . \Config\Database\DBConfig\Account::$Login . '` , `' . \Config\Database\DBConfig\Account::$Password . '`) VALUES (:IdAccountDictionary , :Login , :Password)');
                $stmt->bindValue(':IdAccountDictionary', $IdAccountDictionary, PDO::PARAM_INT);
                $stmt->bindValue(':Login', $Login, PDO::PARAM_STR);
                $stmt->bindValue(':Password', $Password, PDO::PARAM_STR);
                $result = $stmt->execute();
				$id = $this->pdo->lastInsertId();
				$stmt = $this->pdo->prepare('INSERT INTO useraccount (IdUser, IdAccount) VALUES ('.$userId.', '.$id.')');
				$stmt->execute();
                if (!$result)
                    $data['error'] = \Config\Database\DBErrorName::$noadd;
                else {
                    $data['message'] = \Config\Database\DBMessageName::$addok;
                    $name = $this->getAccountDictionaryNameById($IdAccountDictionary);
                    if(isset($name['name']))
                        $name = "'".$name['name']."'";
                    else {
                        $name = "";
                    }
                    $log = new Log();
                    $log->newLog("Dodano konto '".$Login."' do serwisu ".$name , $userId, $IP);
                }
                $stmt->closeCursor();
            } catch (\PDOException $e) {
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        private function getAccountDictionaryNameById($idAccountDictionary){
            $data = array();
            if ($this->pdo === null) {
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if ($idAccountDictionary === null) {
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            try {
                $stmt = $this->pdo->prepare('
                    SELECT *
                    FROM `' . \Config\Database\DBConfig::$tableAccountDictionary . '`
                    WHERE `' . \Config\Database\DBConfig::$tableAccountDictionary . '`.`' . \Config\Database\DBConfig\AccountDictionary::$IdAccountDictionary . '` = :id
                ');
                $stmt->bindValue(':id', $idAccountDictionary, PDO::PARAM_INT);
                $result = $stmt->execute();
                $name = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result)
                    $data['name'] = $name[\Config\Database\DBConfig\AccountDictionary::$Name];
                $stmt->closeCursor();
            } catch (\PDOException $e) {
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        public function delete($id, $idUser, $IP)
        {
            $data = array();
            if ($this->pdo === null) {
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if ($id === null || $idUser === null) {
                $data['error'] = \Config\Database\DBErrorName::$nomatch;
                return $data;
            }
            try {
                $accountData = $this->getAccountDataForId($id);
                if(isset($accountData['account'])){
                    $accountData = $accountData['account'];
                    $login = $accountData[ \Config\Database\DBConfig\Account::$Login];
                    $idAccountDictionary = $accountData[ \Config\Database\DBConfig\Account::$IdAccountDictionary];
                }

                $stmt = $this->pdo->prepare('DELETE FROM  `' . \Config\Database\DBConfig::$tableAccount . '` WHERE  `' . \Config\Database\DBConfig\Account::$IdAccount . '`=:id');
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $result = $stmt->execute();
                if (!$result)
                    $data['error'] = \Config\Database\DBErrorName::$nomatch;
                else {
                    $data['message'] = \Config\Database\DBMessageName::$deleteok;
                    if(isset($login) && isset($idAccountDictionary)) {
                        $name = $this->getAccountDictionaryNameById($idAccountDictionary);
                        if (isset($name['name']))
                            $name = "'" . $name['name'] . "'";
                        else {
                            $name = "";
                        }
                        $log = new Log();
                        $log->newLog("Usunięto konto '" . $login . "' do serwisu " . $name, $idUser, $IP);
                    }
                }
                $stmt->closeCursor();
            } catch (\PDOException $e) {
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        private function getAccountDataForId($idAccount){
            $data = array();
            if ($this->pdo === null) {
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if ($idAccount === null) {
                $data['error'] = \Config\Database\DBErrorName::$nomatch;
                return $data;
            }
            $data['account'] = array();
            try {
                $stmt = $this->pdo->prepare('
                  SELECT *
                  FROM `' . \Config\Database\DBConfig::$tableAccount . '`
                  WHERE  `' . \Config\Database\DBConfig::$tableAccount . '`.`' . \Config\Database\DBConfig\Account::$IdAccount . '`=:id
                ');
                $stmt->bindValue(':id', $idAccount, PDO::PARAM_INT);
                $result = $stmt->execute();
                if (!$result)
                    $data['error'] = \Config\Database\DBErrorName::$nomatch;
                else {
                    $data['message'] = \Config\Database\DBMessageName::$deleteok;
                    $data['account'] = $stmt->fetch(PDO::FETCH_ASSOC);
                }
                $stmt->closeCursor();
            } catch (\PDOException $e) {
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }

        public function update($IdAccount, $IdAccountDictionary, $Login, $Password, $IP, $idUser)
        {
            $data = array();
            if ($this->pdo === null) {
                $data['error'] = \Config\Database\DBErrorName::$connection;
                return $data;
            }
            if ($IdAccount === null || $IdAccountDictionary === null || $Login === null ||
                $Password === null || $IP === null || $idUser === null) {
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            try {
                $stmt = $this->pdo->prepare('UPDATE `'  . \Config\Database\DBConfig::$tableAccount . '` SET `'
                    . \Config\Database\DBConfig\Account::$IdAccountDictionary . '`=:IdAccountDictionary,`'
                    . \Config\Database\DBConfig\Account::$Login . '`=:Login,`'
                    . \Config\Database\DBConfig\Account::$Password . '`=:Password WHERE `'
                    . \Config\Database\DBConfig\Account::$IdAccount . '`=:IdAccount');

                $stmt->bindValue(':IdAccountDictionary', $IdAccountDictionary, PDO::PARAM_INT);
                $stmt->bindValue(':Login', $Login, PDO::PARAM_STR);
                $stmt->bindValue(':Password', $Password, PDO::PARAM_STR);
                $stmt->bindValue(':IdAccount', $IdAccount, PDO::PARAM_INT);
                $result = $stmt->execute();
                $rows = $stmt->rowCount();
                if (!$result)
                    $data['error'] = \Config\Database\DBErrorName::$nomatch;
                else {
                    $data['message'] = \Config\Database\DBMessageName::$updateok;
                    $name = $this->getAccountDictionaryNameById($IdAccountDictionary);
                    if(isset($name['name']))
                        $name = "'".$name['name']."'";
                    else {
                        $name = "";
                    }
                    $log = new Log();
                    $log->newLog("Edytowano konto '".$Login."' do serwisu ".$name , $idUser, $IP);
                }
                $stmt->closeCursor();
            } catch (\PDOException $e) {
                $data['error'] = \Config\Database\DBErrorName::$query;
            }
            return $data;
        }
    }
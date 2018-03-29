<!doctype html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <title>Installation</title>
  <link rel="stylesheet">
</head>
<body>
<?php
    require 'vendor/autoload.php';

    use Config\Database\DBConfig as DB;
    use Config\Database\DBConnection as DBConnection;
    
    DBConnection::setDBConnection(DB::$user,DB::$password, 
            DB::$hostname, DB::$databaseType, DB::$port);	
    try {
        $pdo =  DBConnection::getHandle();
    }catch(\PDOException $e){
        echo \Config\Database\DBErrorName::$connection;
        exit(1);
    }

    // Table UserAccount
    $query = 'DROP TABLE IF EXISTS `'.DB::$tableUserAccount.'`';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$delete_table.DB::$tableUserAccount;
    }

    // Table Account
    $query = 'DROP TABLE IF EXISTS `'.DB::$tableAccount.'`';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$delete_table.DB::$tableAccount;
    }

    // Table Log
    $query = 'DROP TABLE IF EXISTS `'.DB::$tableLog.'`';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$delete_table.DB::$tableLog;
    }

    // Table PasswordsHistory
    $query = 'DROP TABLE IF EXISTS `'.DB::$tablePasswordsHistory.'`';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$delete_table.DB::$tablePasswordsHistory;
    }

    // Table User
    $query = 'DROP TABLE IF EXISTS `'.DB::$tableUser.'`';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$delete_table.DB::$tableUser;
    }

    // Table Status
    $query = 'DROP TABLE IF EXISTS `'.DB::$tableStatus.'`';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$delete_table.DB::$tableStatus;
    }

    // Table AccountDictionary
    $query = 'DROP TABLE IF EXISTS `'.DB::$tableAccountDictionary.'`';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$delete_table.DB::$tableAccountDictionary;
    }

    // Create table Status
    $query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableStatus.'` (
            `'.DB\Status::$IdStatus.'` INT NOT NULL AUTO_INCREMENT,
            `'.DB\Status::$Name.'` VARCHAR(30) NOT NULL UNIQUE,
            PRIMARY KEY ('.DB\Status::$IdStatus.')) ENGINE=InnoDB;';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$create_table.DB::$tableStatus;
    }

    // Create table AccountDictionary
    $query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableAccountDictionary.'` (
            `'.DB\AccountDictionary::$IdAccountDictionary.'` INT NOT NULL AUTO_INCREMENT,
            `'.DB\AccountDictionary::$Name.'` VARCHAR(50) NOT NULL UNIQUE,
            PRIMARY KEY ('.DB\AccountDictionary::$IdAccountDictionary.')) ENGINE=InnoDB;';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$create_table.DB::$tableAccountDictionary;
    }

    // Create table User
    $query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableUser.'` (
                `'.DB\User::$IdUser.'` INT NOT NULL AUTO_INCREMENT,
                `'.DB\User::$FirstName.'` VARCHAR(100) NOT NULL,
                `'.DB\User::$LastName.'` VARCHAR(200) NOT NULL,
                `'.DB\User::$Email.'` VARCHAR(200) NOT NULL,
                `'.DB\User::$Login.'` VARCHAR(200) NOT NULL UNIQUE,
                `'.DB\User::$Password.'` VARCHAR(200) NOT NULL,
                `'.DB\User::$Code.'` INT NOT NULL,
                `'.DB\User::$TrialLimit.'` INT NOT NULL,
                `'.DB\User::$IdStatus.'` INT NOT NULL,
                `'.DB\User::$Active.'` BINARY NOT NULL,
                PRIMARY KEY ('.DB\User::$IdUser.'),
                FOREIGN KEY ('.DB\User::$IdStatus.') REFERENCES '.DB::$tableStatus.'('.DB\Status::$IdStatus.') ON DELETE CASCADE
                ) ENGINE=InnoDB;          
                ';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$create_table.DB::$tableUser;
    }

    // Create table Log
    $query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableLog.'` (
            `'.DB\Log::$IdLog.'` INT NOT NULL AUTO_INCREMENT,
            `'.DB\Log::$Description.'` VARCHAR(200) NOT NULL,
            `'.DB\Log::$Date.'` DATE NOT NULL,
            `'.DB\Log::$IP.'` VARCHAR(40) NOT NULL,
            `'.DB\Log::$IdUser.'` INT NOT NULL,
            PRIMARY KEY ('.DB\Log::$IdLog.'),
            FOREIGN KEY ('.DB\Log::$IdUser.') REFERENCES '.DB::$tableUser.'('.DB\User::$IdUser.') ON DELETE CASCADE
            ) ENGINE=InnoDB;';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$create_table.DB::$tableLog;
    }

    // Create table PasswordsHistory
    $query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tablePasswordsHistory.'` (
                `'.DB\PasswordsHistory::$IdPasswordsHistory.'` INT NOT NULL AUTO_INCREMENT,
                `'.DB\PasswordsHistory::$Password.'` VARCHAR(200) NOT NULL,
                `'.DB\PasswordsHistory::$CreateDate.'` DATE NOT NULL,
                `'.DB\PasswordsHistory::$IdUser.'` INT NOT NULL,
                PRIMARY KEY ('.DB\PasswordsHistory::$IdPasswordsHistory.'),
                FOREIGN KEY ('.DB\PasswordsHistory::$IdUser.') REFERENCES '.DB::$tableUser.'('.DB\User::$IdUser.') ON DELETE CASCADE
                ) ENGINE=InnoDB;';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$create_table.DB::$tablePasswordsHistory;
    }

    // Create table Account
    $query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableAccount.'` (
                    `'.DB\Account::$IdAccount.'` INT NOT NULL AUTO_INCREMENT,
                    `'.DB\Account::$IdAccountDictionary.'` INT NOT NULL,
                    `'.DB\Account::$Login.'` VARCHAR(200) NOT NULL,
                    `'.DB\Account::$Password.'` VARCHAR(200) NOT NULL,
                    PRIMARY KEY ('.DB\Account::$IdAccount.'),
                    FOREIGN KEY ('.DB\Account::$IdAccountDictionary.') REFERENCES '.DB::$tableAccountDictionary.'('.DB\AccountDictionary::$IdAccountDictionary.') ON DELETE CASCADE
                    ) ENGINE=InnoDB;';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$create_table.DB::$tableAccount;
    }

    // Create table UserAccount
    $query = 'CREATE TABLE IF NOT EXISTS `'.DB::$tableUserAccount.'` (
                        `'.DB\UserAccount::$IdUserAccount.'` INT NOT NULL AUTO_INCREMENT,
                        `'.DB\UserAccount::$IdUser.'` INT NOT NULL,
                        `'.DB\UserAccount::$IdAccount.'` INT NOT NULL,
                        PRIMARY KEY ('.DB\UserAccount::$IdUserAccount.'),
                        FOREIGN KEY ('.DB\UserAccount::$IdUser.') REFERENCES '.DB::$tableUser.'('.DB\User::$IdUser.') ON DELETE CASCADE,
                        FOREIGN KEY ('.DB\UserAccount::$IdAccount.') REFERENCES '.DB::$tableAccount.'('.DB\Account::$IdAccount.') ON DELETE CASCADE
                        ) ENGINE=InnoDB;';
    try
    {
        $pdo->exec($query);
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$create_table.DB::$tableUserAccount;
    }


    //!!!!!!!!!!!!!!!!!!!INSERT!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    //Table Status
    $Statuses = array();
    $Statuses[] = array(
        'Name' => 'Administrator');
    $Statuses[] = array(
        'Name' => 'Użytkownik');
    // insert
    try
    {
        $stmt = $pdo -> prepare('INSERT INTO `'.DB::$tableStatus.'` (`'.DB\Status::$Name.'`) VALUES(:Name)');
        foreach($Statuses as $status)
        {
            $stmt -> bindValue(':Name', $status['Name'], PDO::PARAM_STR);
            $stmt -> execute();
        }
    }
    catch(PDOException $e)
    {
        echo \Config\Database\DBErrorName::$noadd;
    }

echo "<b>Instalacja aplikacji zakończona!</b>"
?>
</body>
</html>
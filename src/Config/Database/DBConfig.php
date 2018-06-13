<?php
namespace Config\Database;

class DBConfig
{
    //Configuration database
    //nazwa bazy danych
    public static $databaseName = 'biod';
    //dane dostępowe do bazy danych
    public static $hostname = 'localhost';
    public static $databaseType = 'mysql';
    public static $port = '3306';
    public static $user = 'root';
    public static $password = '';

    //Configuration email
    public static $hostEmail = 'poczta.o2.pl';
    public static $userNameEmail = 'biodprojekt2018';
    public static $passwordEmail = 'informatyka2018';
    public static $SMTPSecureEmail = 'ssl';
    public static $PORTEmail = 465;
    public static $subjectEmail = 'Portfel haseł';
    public static $fullNameEmail = 'biodprojekt2018@o2.pl';


    //Tables
    public static $tableAccount = "Account";
    public static $tableAccountDictionary = "AccountDictionary";
    public static $tableLog = "Log";
    public static $tablePasswordsHistory = "PasswordsHistory";
    public static $tableStatus = "Status";
    public static $tableUser = "User";
    public static $tableUserAccount = "UserAccount";
}
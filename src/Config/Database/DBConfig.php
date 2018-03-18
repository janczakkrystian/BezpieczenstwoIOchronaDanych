<?php
namespace Config\Database;

class DBConfig
{
    //nazwa bazy danych
    public static $databaseName = 'biod';
    //dane dostępowe do bazy danych
    public static $hostname = 'localhost';
    public static $databaseType = 'mysql';
    public static $port = '3306';
    public static $user = 'root';
    public static $password = '';

    //Tables
    public static $tableAccount = "Account";
    public static $tableAccountDictionary = "AccountDictionary";
    public static $tableLog = "Log";
    public static $tablePasswordsHistory = "PasswordsHistory";
    public static $tableStatus = "Status";
    public static $tableUser = "User";
    public static $tableUserAccount = "UserAccount";
}
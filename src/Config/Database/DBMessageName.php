<?php
namespace Config\Database;
use \PDO;

class DBMessageName{
    public static $addok = "Rekord dodano do bazy danych.";
    public static $deleteok = "Rekord usunięto z bazy danych.";
    public static $updateok = "Rekord zaktualizowano w bazie danych.";
    public static $registerok = "Poprawnie zarejestrowano nowego użytkownika.";
    public static $veryficationOk = "Poprawnie aktywowano konto";
    public static $veryficationCodeEmailSubject = "weryfikacja konta";
    public static $veryficationCodeEmailBody = "Przesyłamy kod, w celu weryfikacji konta:";
}

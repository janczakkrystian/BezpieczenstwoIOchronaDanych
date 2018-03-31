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
    public static $generatedNewCode = 'Wygenerowano oraz wysłano nowy kod.';
    public static $sendAgainCode = "Wysłano ponownie kod.";
    public static $loginOk = "Poprawnie się zalogowano!";
    public static $logoutOk = "Poprawnie się wylogowano!";
    public static $mustLogin = "Aby wykonać operację musisz się zalogować!";
    public static $generatedNewPassword = "Zostało wygenerowane silne hasło oraz wysłane na maila.";
    public static $passwordWasSent = "Silne hasło zostało już wysłane na maila.";
    public static $changePasswordOk = "Hasło zostało zmienione!";
}

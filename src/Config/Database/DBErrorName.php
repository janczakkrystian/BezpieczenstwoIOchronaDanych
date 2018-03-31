<?php
namespace Config\Database;
use \PDO;

class DBErrorName{
    public static $connection = "Błąd połączenia z bazą danych!";
    public static $create_table = "Błąd tworzenia tabeli: ";
    public static $delete_table = "Błąd usuwania tabeli: ";
    public static $query = "Błąd zapytania do bazy danych!";
    public static $noadd = "Nie udało dodać się rekordu do bazy!";
    public static $nomatch = "Nie dopasowano rekordu w bazie!";
    public static $empty = "Podana wartość nie może być pusta!";
    public static $errorCode = "Podany kod nie jest poprawny!";
    public static $createMail = "Błąd podczas tworzenia maila!";
    public static $dataLoginWrong = "Niepoprawne dane logowania!";
    public static $errorChangePassword = "Nie udało się zmienić hasła!";
    public static $theSamePassword = "Nie można zmienić na to samo hasło!";
    public static $notTheSamePassword = "Hasła nie są takie same.";
    public static $passwordWasSet = "To hasło było już użyte.";
}

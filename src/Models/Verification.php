<?php
namespace Models;
use Config\Database\DBConfig;
use \PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Models\PasswordHistory;
use Models\User;
use Models\Accounts;

class Verification extends Model {

    public function verificationAndAction($IdUser , $Code , $Action){
        $data = null;
        if($IdUser === null || $Code === null || $Action === null || !isset($Action['Model']) || !isset($Action['Action']) || !isset($Action['Data'])){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        //Pobranie kodu z bazy
        $Model = \Models\User::class;
        $data = $Model->getCode($IdUser);
        if(isset($data['error'])){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        if(!isset($data['code'])){
            $data['error'] = \Config\Database\DBErrorName::$errorCode;
            return $data;
        }
        //Przypisanie pobranego kodu użytkownika do zmiennej
        $codeFromBase = $data['code'];

        //Sprawdzenie, czy istnieje zmienna
        if($codeFromBase && !empty($codeFromBase)){

            //Sprawdzenie, czy kod wpisany przez użytkownika, to ten sam, który jest w bazie danych
            if((int)$Code === (int)$codeFromBase) {

                //Wyczyszczenie sesji, jeśli nie zrobiono tego wcześniej
                if(\Tools\Session::is('action')){
                    \Tools\Session::clear('action');
                }

                //Wykonanie akcji, którą zlecił użytkownik
                $model = new ('Models\\'.$Action['Model']);
                $action = new $Action['Action'];
                $model->$action($Action['Data']);
            }

            //Zapisanie błędu, jeśli kod nie jest poprawny
            else{
                $data['error'] = "Kod niepoprawny!!";
                return $data;
            }
        }

        //Zapisanie błędu, jeśli nie ma zmiennej
        else{
            $data['error'] = \Config\Database\DBErrorName::$nomatch;
            return $data;
        }

        //Ustawienie wiadomości, jeśli wszystko się wykonało bez błędów
        $data['message'] = "Potwierdzono !";
        return $data;
    }

}
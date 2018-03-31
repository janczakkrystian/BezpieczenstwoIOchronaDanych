<?php
namespace Tools;

class Access extends Session {
    static $login = 'user';
    static $idUser = 'idUser';
    static $activeAccount = 'activeAccount';
    static $firstName = 'firstName';
    static $lastName = 'lastName';
    private static $loginTime = 'logintime';
    private static $sessionTime = 300;

    public static function login($login , $idUser , $activeAccount , $firstName , $lastName) {
        if(parent::check() === true)
        {
            parent::regenerate();
            parent::set(self::$login, $login);
            parent::set(self::$idUser, $idUser);
            parent::set(self::$activeAccount, $activeAccount);
            parent::set(self::$firstName, $firstName);
            parent::set(self::$lastName, $lastName);
            parent::set(self::$loginTime, time());
        }
    }

    public static function logout() {
        parent::clear(self::$login);
        parent::clear(self::$idUser);
        parent::clear(self::$activeAccount);
        parent::clear(self::$loginTime);
        parent::regenerate();
    }

    public static function islogin() {
        if(parent::is(self::$login) === true) {

            if(time() > parent::get(self::$loginTime) + self::$sessionTime) {
                self::logout();
                return false;
            }
            parent::set(self::$loginTime, time());
            return true;
        }
        return false;
    }
}
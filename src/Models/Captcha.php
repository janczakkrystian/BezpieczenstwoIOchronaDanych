<?php
namespace Models;
use \PDO;
class Captcha extends Model {

    public function verificationCaptcha($recaptcha){
        $data = array();
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $privatekey = "6LfuYFYUAAAAAAfsw5fzWdCh7g3j7nKtapeSb7t_";
        $response = file_get_contents($url."?secret=".$privatekey."&response=".$recaptcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        $checkCaptcha = json_decode($response);
        if(!isset($checkCaptcha->success) || $checkCaptcha->success != true){
            $data['error'] = "Jesteś robotem!";
        }
        else{
            $data['message'] = "Nie jesteś robotem.";
        }
        return $data;
    }

}
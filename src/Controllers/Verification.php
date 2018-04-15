<?php
namespace Controllers;

class Verification extends Controller {

    public function verificationForm($data){
        $view = $this->getView('Verification');
        //$data = null;
        if (\Tools\Session::is('message'))
            $data['message'] = \Tools\Session::get('message');
        if (\Tools\Session::is('error'))
            $data['error'] = \Tools\Session::get('error');

        if(!isset($data['IdUser'])){
            if(isset($data['Login'])) {
                $IdUser = $this->getModel('User');
                $IdUser->findUserForLogin($data['Login']);
                if(isset($IdUser['error']))
                    $data['error'] = "Błąd pobierania ID";
                if(isset($IdUser[\Config\Database\DBConfig\User::$IdUser]))
                    $data['IdUser'] = $IdUser[\Config\Database\DBConfig\User::$IdUser];
                else
                    $data['error'] = "Nie pobrano ID użytkownika!!";
            }
            else
                $data['error'] = "Nie ma loginu!!";
        }

        if(!isset($data['error'])){
            $sendCodeForVerification = $this->getModel('User');
            if(!isset($data['IdUser']))
                $data['error'] = "Nie ma ID użytkownika!";
            $sendCodeForVerification->sendCodeByEmail($data['IdUser']);
            if(isset($sendCodeForVerification['error']))
                $data['error'] = "Błąd wysyłania kodu!!";
            else
                $data['message'] = "Wysłano kod na email";
        }

        $view->verificationForm($data);
        \Tools\Session::clear('message');
        \Tools\Session::clear('error');
    }

    public function verification(){
        $model = $this->getModel('Verification');
        if(\Tools\Session::is('action')) {
            $data = $model->verificationAndAction($_POST['IdUser'], $_POST['Code'], \Tools\Session::get('action'));
            if (isset($data['error'])) {
                \Tools\Session::set('error', $data['error']);
            }
            \Tools\Session::clear('action');
        }
        else $data['error'] = "Brak akcji do wykonania!!";
        if(isset($data['message']))
            \Tools\Session::set('message' , $data['message']);
        $this->redirect("");
    }

}
<?php
namespace Controllers;

class Verification extends Controller {

    public function verificationForm($id = null){
        $view = $this->getView('Verification');
        $data = null;
        if($id !== null){
            $data['Model'] = $id[0];
            $data['Action'] = $id[1];
            $data['Data'] = array();
            $i = 0;
            foreach($_POST as $item){
                $data['Data'][$i] = $item;
                $i++;
            }
        }
        if (\Tools\Session::is('message'))
            $data['message'] = \Tools\Session::get('message');
        if (\Tools\Session::is('error'))
            $data['error'] = \Tools\Session::get('error');

        if(!\Tools\Session::is(\Tools\Access::$idUser)){
            if(\Tools\Session::is(\Tools\Access::$login) || $_POST['Login']) {
                if(isset($_POST['Login']) && $_POST['Login'] != null)
                    $data['Login'] = $_POST['Login'];
                else{
                    $data['Login'] = \Tools\Session::get(\Tools\Access::$login);
                }
                $IdUser = $this->getModel('User');
                $IdUser = $IdUser->findUserForLogin($data['Login']);
                if(isset($IdUser['error']))
                    $data['error'] = "Błąd pobierania ID";
                if(isset($IdUser['user'][\Config\Database\DBConfig\User::$IdUser]))
                    $data['IdUser'] = $IdUser['user'][\Config\Database\DBConfig\User::$IdUser];
                else
                    $data['error'] = "Nie pobrano ID użytkownika!!";
            }
            else
                $data['error'] = "Nie ma loginu!!";
        }
        else
            $data['IdUser'] = \Tools\Session::get(\Tools\Access::$idUser);

        if(!isset($data['error'])){
            $sendCodeForVerification = $this->getModel('User');
            if(!isset($data['IdUser']))
                $data['error'] = "Nie ma ID użytkownika!";
            $sendCodeForVerification = $sendCodeForVerification->sendCodeByEmail($data['IdUser']);
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
        else \Tools\Session::set('error' , "Brak akcji do wykonania!!");
        if(isset($data['message']))
            \Tools\Session::set('message' , $data['message']);
        $this->redirect("");
    }

}
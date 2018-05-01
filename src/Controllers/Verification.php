<?php
namespace Controllers;

class Verification extends Controller {

    public function verificationForm(){
        if(\Tools\Session::is('priority'))
            \Tools\Session::clear('priority');
        $data = null;
        if(\Tools\Session::is('controller') && \Tools\Session::is('action')){
            $data['Model'] = \Tools\Session::get('controller');
            $data['Action'] = \Tools\Session::get('action');
            $data['Data'] = array();
            $i = 0;
            \Tools\Session::clear('controller');
            \Tools\Session::clear('action');
            foreach($_POST as $item){
                $data['Data'][$i] = $item;
                $i++;
            }
            if($data['Model'] === 'User' && $data['Action'] === 'validatePassword'){

                //Captcha
                $i--;
                unset($data['Data'][$i]); // Usuwam ostatnią wartość, ponieważ Captcha we formularzu jest dodatkowym polem, dodawanym
                                          //niepotrzebnie do tablicy ['Data']

                $model = $this->getModel('Captcha');
                $captcha = $model->verificationCaptcha($_POST['g-recaptcha-response']);
                if(isset($captcha['error'])){
                    \Tools\Session::set('error' ,  $captcha['error']);
                    $this->redirect("");
                }

                $model = $this->getModel('User');
                $validatePassword = $model->validatePassword($data['Data']);
                if(isset($validatePassword['error'])) {
                    \Tools\Session::set('error' ,  $validatePassword['error']);
                    $this->redirect("");
                }
                elseif(isset($validatePassword['message'])){
                    \Tools\Session::set('error' ,  \Config\Database\DBErrorName::$dataLoginWrong);
                    $this->redirect("");
                }
            } //Walidacja danych zanim przejdzie do weryfikacji kodem.
            elseif(($data['Model'] === 'User' && $data['Action'] === 'changedPassword')){
                $data['Data'][3] = $data['Data'][2];
                $data['Data'][2] = $data['Data'][1];
                $data['Data'][1] = $data['Data'][0];
                $data['Data'][0] = \Tools\Session::get(\Tools\Access::$login);
                $data['Data'][4] = (int)(\Tools\Session::get(\Tools\Access::$trialLimit)) === (int)(-2);
                $model = $this->getModel('User');
                $changePassword = $model->changedPassword($data['Data']);
                if(isset($changePassword['error'])) {
                    \Tools\Session::set('error', $changePassword['error']);
                    $this->redirect("?controller=User&action=changePasswordForm");
                }
            } //Sprawdzenie, czy hasło spełnia wymagania, nim przejdzie do weryfikacji kodem.
        }
        else {
            \Tools\Session::set('error' , 'Brak danych!');
            $this->redirect("");
        }
        $view = $this->getView('Verification');
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
            //-----------------------TUTAJ---------------------------------------------------
            /*$sendCodeForVerification = $sendCodeForVerification->sendCodeByEmail($data['IdUser']);
            if(isset($sendCodeForVerification['error'])) {
                $data['error'] = "Błąd wysyłania kodu!";
                $this->redirect('');
            }
            else
                $data['message'] = "Wysłano kod na email";*/
        }

        $view->verificationForm($data);
        \Tools\Session::clear('message');
        \Tools\Session::clear('error');
    }

    public function verification(){
        if(\Tools\Session::is('priority'))
            \Tools\Session::clear('priority');
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
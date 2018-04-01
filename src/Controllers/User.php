<?php
    namespace Controllers;

    class User extends Controller {

        public function logForm(){
            if(!\Tools\Access::islogin()) {
                $view = $this->getView('User');
                $data = null;
                if (\Tools\Session::is('message'))
                    $data['message'] = \Tools\Session::get('message');
                if (\Tools\Session::is('error'))
                    $data['error'] = \Tools\Session::get('error');
                $view->logForm($data);
                \Tools\Session::clear('message');
                \Tools\Session::clear('error');
            }
            else $this->redirect("");
        }

        public function validatePassword(){
            if(!\Tools\Access::islogin()) {
                $model = $this->getModel('User');
                $data = $model->validatePassword($_POST['Login'], $_POST['Password']);
                if (isset($data['error']))
                    \Tools\Session::set('error', $data['error']);
                if (isset($data['message']))
                    \Tools\Session::set('message', $data['message']);
                if (!isset($data['validate']) || $data['validate'] === true) {
                    $this->redirect("");
                } else {
                    $this->logForm();
                }
            }
            else $this->redirect("");
        }

        public function regForm(){
            if(!\Tools\Access::islogin()) {
                $view = $this->getView('User');
                $data = null;
                if (\Tools\Session::is('message'))
                    $data['message'] = \Tools\Session::get('message');
                if (\Tools\Session::is('error'))
                    $data['error'] = \Tools\Session::get('error');
                $view->regForm($data);
                \Tools\Session::clear('message');
                \Tools\Session::clear('error');
            }
            else $this->redirect("");
        }

        public function register(){
            if(!\Tools\Access::islogin()) {
                $model = $this->getModel('User');
                $data = $model->register(
                    $_POST['FirstName'] ,
                    $_POST['LastName'] ,
                    $_POST['Email'] ,
                    $_POST['Login'] ,
                    $_POST['Password']);
                if(isset($data['error']))
                    \Tools\Session::set('error' , $data['error']);
                if(isset($data['message']))
                    \Tools\Session::set('message' , $data['message']);
                if(!isset($data['error'])){$this->redirect("");}
                else $this->regForm($data);
            }
            else $this->redirect("");
        }

        public function verification(){
            $this->islogin();
            $view = $this->getView('User');
            $data = null;
            if(\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if(\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->verification($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }

        public function verificationAccount(){
            $this->islogin();
            $model = $this->getModel('User');
            $data = $model->verificationAccount($_POST['IdUser'] , $_POST['Code']);
            if(isset($data['error'])) {
                \Tools\Session::set('error', $data['error']);
            }
            else{\Tools\Session::set(\Tools\Access::$activeAccount , (int)1);}
            if(isset($data['message']))
                \Tools\Session::set('message' , $data['message']);
            $this->redirect("");
        }

        public function sendCodeAgain($id){
            $this->islogin();
            $model = $this->getModel('User');
            $data = $model->sendCodeByEmail($id);
            if(isset($data['error'])) {
                \Tools\Session::set('error', $data['error']);
            }
            if(isset($data['message']))
                \Tools\Session::set('message' , $data['message']);
            $this->redirect("");
        }

        public function logout(){
            $model=$this->getModel('User');
            $model->logout();
            $this->redirect("");
        }

        public function islogin(){
            if(\Tools\Access::islogin() !== true){
                $this->redirect("");
            }
        }

        public function changePasswordForm(){
            $this->islogin();
            $view = $this->getView('User');
            $data = null;
            if(\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if(\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->changePasswordForm($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }

        public function changedPassword(){
            $this->islogin();
            $model = $this->getModel('User');
            $data = $model->changePassword(
                \Tools\Session::get(\Tools\Access::$login) ,
                $_POST['OldPassword'] ,
                $_POST['NewPassword'] ,
                $_POST['NewPasswordAgain'] ,
                (int)(\Tools\Session::get(\Tools\Access::$trialLimit)) === (int)(-2));
            if(isset($data['error'])) {
                \Tools\Session::set('error', $data['error']);
                $this->redirect("?controller=User&action=changePasswordForm");
            }
            if(isset($data['message']))
                \Tools\Session::set('message' , $data['message']);
            $this->redirect("");
        }

        public function remindPasswordForLoginForm(){
            if(!\Tools\Access::islogin()) {
                $view = $this->getView('User');
                $data = null;
                if (\Tools\Session::is('message'))
                    $data['message'] = \Tools\Session::get('message');
                if (\Tools\Session::is('error'))
                    $data['error'] = \Tools\Session::get('error');
                $view->remindPasswordForLoginForm($data);
                \Tools\Session::clear('message');
                \Tools\Session::clear('error');
            }
            else $this->redirect("");
        }

        public function remindPasswordForm(){
            if(!\Tools\Access::islogin()) {
                $view = $this->getView('User');
                $data = null;
                if(!isset($_POST['Login'])){
                    $data['error'] = \Config\Database\DBErrorName::$empty;
                    $view->logForm($data);
                }
                else $data['login'] = $_POST['Login'];

                //Wysłanie kodu mailem
                $model = $this->getModel('User');
                $sendCode = $model->sendCodeByEmailForLogin($_POST['Login']);

                $view = $this->getView('User');
                if (\Tools\Session::is('message'))
                    $data['message'] = \Tools\Session::get('message');
                else if(isset($sendCode['message'])) $data['message'] = $sendCode['message'];
                if (\Tools\Session::is('error'))
                    $data['error'] = \Tools\Session::get('error');
                else if(isset($sendCode['error']))$data['error'] = $sendCode['error'];
                $view->remindPasswordForm($data);
                \Tools\Session::clear('message');
                \Tools\Session::clear('error');
            }
            else $this->redirect("");
        }

        public function sendPasswordByEmail(){
            if(!\Tools\Access::islogin()) {
                if(isset($_POST['Login']) && isset($_POST['Code'])){
                    $model = $this->getModel('User');
                    $data = $model->sendGeneratedPasswordByEmail($_POST['Login'] , $_POST['Code']);
                    if(isset($data['error'])) {
                        \Tools\Session::set('error', $data['error']);
                        $this->redirect("?controller=User&action=remindPasswordForm");
                    }
                    if(isset($data['message']))
                        \Tools\Session::set('message' , $data['message']);
                }
                else{
                    \Tools\Session::set('error' , \Config\Database\DBErrorName::$empty." Tutaj.");
                }
            }
            $this->redirect("");
        }
    }
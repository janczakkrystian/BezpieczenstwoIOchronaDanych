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
                    $_POST['Password'],
                    $_POST['PasswordAgain']);
                if(isset($data['error']))
                    \Tools\Session::set('error' , $data['error']);
                if(isset($data['message']))
                    \Tools\Session::set('message' , $data['message']);
                if(!isset($data['error'])){$this->redirect("");}
                else $this->regForm($data);
            }
            else $this->redirect("");
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
            $this->redirect("?controller=Verification&action=verificationForm");
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
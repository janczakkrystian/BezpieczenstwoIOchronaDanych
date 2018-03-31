<?php
    namespace Controllers;

    class User extends Controller {

        public function logForm(){
            $view = $this->getView('User');
            $data = null;
            if(\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if(\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->logForm($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }

        public function validatePassword(){
            $model = $this->getModel('User');
            $data = $model->validatePassword($_POST['Login'] , $_POST['Password']);
            if(isset($data['error']))
                \Tools\Session::set('error' , $data['error']);
            if(isset($data['message']))
                \Tools\Session::set('message' , $data['message']);
            if(!isset($data['validate']) || $data['validate'] === true) {
                $this->redirect("");
            }
            else {
                $this->logForm();
            }
        }

        public function regForm(){
            $view = $this->getView('User');
            $data = null;
            if(\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if(\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->regForm($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }

        public function register(){
            $model = $this->getModel('User');
            $data = $model->register($_POST['FirstName'] , $_POST['LastName'] , $_POST['Email'] , $_POST['Login'] , $_POST['Password']);
            if(isset($data['error']))
                \Tools\Session::set('error' , $data['error']);
            if(isset($data['message']))
                \Tools\Session::set('message' , $data['message']);
            if(!isset($data['error'])){$this->redirect("");}
            else $this->regForm($data);
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
    }
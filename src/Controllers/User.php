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
            $this->redirect("");
        }
    }
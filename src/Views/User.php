<?php
    namespace Views;

    use Tools\Access;
    use Tools\Session;

    class User extends View {

        public function logForm($data){
            if(isset($data['message']))
                $this->set('message' , $data['message']);
            if(isset($data['error']))
                $this->set('error' , $data['error']);
            $this->render('logForm');
        }

        public function regForm($data){
            if(isset($data['message']))
                $this->set('message' , $data['message']);
            if(isset($data['error']))
                $this->set('error' , $data['error']);
            $this->render('regForm');
        }

        public function verification($data){
            if(isset($data['message']))
                $this->set('message' , $data['message']);
            if(isset($data['error']))
                $this->set('error' , $data['error']);
            $this->render('verificationForm');
        }

        public function changePasswordForm($data){
            if(isset($data['message']))
                $this->set('message' , $data['message']);
            if(isset($data['error']))
                $this->set('error' , $data['error']);
            $this->render('changePasswordForm');
        }

        public function remindPasswordForLoginForm($data){
            if(isset($data['message']))
                $this->set('message' , $data['message']);
            if(isset($data['error']))
                $this->set('error' , $data['error']);
            $this->render('remindPasswordForLoginForm');
        }

        public function remindPasswordForm($data){
            if(isset($data['message']))
                $this->set('message' , $data['message']);
            if(isset($data['error']))
                $this->set('error' , $data['error']);
            if(!isset($data['login']))
                $this->set('error' , \Config\Database\DBErrorName::$empty);
            else $this->set('login' , $data['login']);
            $this->render('remindPasswordForm');
        }
    }
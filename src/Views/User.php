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
    }
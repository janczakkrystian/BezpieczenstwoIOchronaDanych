<?php
    namespace Views;

    class User extends View {
        public function logForm($data){
            if(isset($data['message']))
                $this->set('message' , $data['message']);
            if(isset($data['error']))
                $this->set('error' , $data['error']);
            $this->render('logForm');
        }
    }
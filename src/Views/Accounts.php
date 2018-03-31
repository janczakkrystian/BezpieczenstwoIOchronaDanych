<?php
    namespace Views;

    class Accounts extends View {

        public function main($data){
            if(isset($data['message']))
                $this->set('message' , $data['message']);
            if(isset($data['error']))
                $this->set('error' , $data['error']);
            $this->render('main');
        }

    }
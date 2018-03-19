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
    }
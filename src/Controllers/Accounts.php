<?php
    namespace Controllers;

    class Accounts extends Controller {

        public function main(){
            $accessController = new \Controllers\User();
            $accessController->islogin();

            $view = $this->getView('Accounts');
            $data = null;
            if(\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if(\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->main($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }

    }
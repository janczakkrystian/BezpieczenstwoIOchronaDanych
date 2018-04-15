<?php
namespace Controllers;

class User extends Controller {

    public function verificationForm($data){
        $view = $this->getView('Verification');
        //$data = null;
        if (\Tools\Session::is('message'))
            $data['message'] = \Tools\Session::get('message');
        if (\Tools\Session::is('error'))
            $data['error'] = \Tools\Session::get('error');
        $view->verificationForm($data);
        \Tools\Session::clear('message');
        \Tools\Session::clear('error');
    }

    public function verification(){

    }

}
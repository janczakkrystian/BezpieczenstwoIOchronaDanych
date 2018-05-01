<?php
namespace Controllers;

class Log extends Controller {

    public function logs(){
        $accessController = new \Controllers\User();
        $accessController->islogin();

        $view = $this->getView('Log');
        $data = null;
        if(\Tools\Session::is('message'))
            $data['message'] = \Tools\Session::get('message');
        if(\Tools\Session::is('error'))
            $data['error'] = \Tools\Session::get('error');
        $view->logs($data);
        \Tools\Session::clear('message');
        \Tools\Session::clear('error');
    }

}
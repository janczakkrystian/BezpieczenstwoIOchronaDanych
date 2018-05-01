<?php
namespace Views;

class Log extends View {

    public function logs($data){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        //Pobranie logów z bazy
        $model = $this->getModel('Log');
        $logs = $model->getAll(\Tools\Session::get(\Tools\Access::$idUser));
        if(isset($logs['error'])){
            $this->set('error' , $logs['error']);
        }
        else{
            $this->set('logs', $logs['logs']);
        }
        $this->render('logs');
    }

}
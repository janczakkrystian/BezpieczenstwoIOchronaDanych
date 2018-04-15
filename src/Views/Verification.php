<?php
namespace Views;

use Tools\Access;
use Tools\Session;

class Verification extends View {

    public function verificationForm($data){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        $this->set('IdUser' , $data['IdUser']);
        $this->render('verificationForm');
        $action['Model'] = $data['Model'];
        $action['Action'] = $data['Action'];
        $action['Data'] = $data['Data'];
        \Tools\Session::set('action' , $action);
    }

}
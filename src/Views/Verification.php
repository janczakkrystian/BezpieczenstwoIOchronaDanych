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

        if(isset($data['IdUser']))
            $this->set('IdUser' , $data['IdUser']);
        $this->render('verificationForm');
        if(isset($data['Model']))
            $action['Model'] = $data['Model'];
        if(isset($data['Action']))
            $action['Action'] = $data['Action'];
        if(isset($data['Data']))
            $action['Data'] = $data['Data'];
        \Tools\Session::set('action' , $action);
    }

}
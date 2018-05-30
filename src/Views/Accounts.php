<?php
namespace Views;

class Accounts extends View {

    public function main($data){
		$model = $this->getModel('Accounts');
		$data = $model->getAll();
		$this->set('accounts', $data['account']);
		$data = $model->getAccountDictionariesByUser();
		$this->set('accountsdictionaries', $data['account']);
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);
        $this->render('AccountGetAll');
    }

    public function getOne($id){
        //pobranie wybranego konta
        $model = $this->getModel('Accounts');
        $item = $model->getOne($id);
        //je�li istnieje to wy�wietlenie jej
        if($item !== null)
        {
            $this->set('accounts', $item);
            $this->render('OneAccount');
            return true;
        }
        else
            return false;
    }
	
	public function getByName($name){
        $model = $this->getModel('Accounts');
        $item = $model->getByName($name);
		echo json_encode($item['account']);
    }

    public function addform()
    {
        $this->set('customScript', 'Accounts');
		
        $model = $this->getModel('Accounts');
        $listAccount = $model->getAcountsDictionariesForSelect();
        $this->set('listAccount', $listAccount);

        $this->render('AccountAddForm');
    }

    public function editform($accounts){
        $this->set('IdAccount', $accounts[\Config\Database\DBConfig\Account::$IdAccount]);
        $this->set('IdAccountDictionary', $accounts[\Config\Database\DBConfig\Account::$IdAccountDictionary]);
        $this->set('Login', $accounts[\Config\Database\DBConfig\Account::$Login]);
        $this->set('Password', $accounts[\Config\Database\DBConfig\Account::$Password]);
        $this->set('customScript', 'Account');
        $this->render('AccountEditForm');
    }



}
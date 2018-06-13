<?php
    namespace Controllers;

    class Accounts extends Controller {


        // to jest get all z knychały nie wiem dlaczego zapisane jako main, krystian musisz wyjaśnić xDDD

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
		
		public function getByName($name){
            $accessController = new \Controllers\User();
            $accessController->islogin();

            $model = $this->getModel('Accounts');
            $data = $model->getByName($name);
			echo json_encode($data['account']);
        }

        public function addform()
        {
            $accessController = new \Controllers\User();
            $accessController->islogin();
            $view = $this->getView('Accounts');
            $view->addform();
        }

        public function add()
        {
            $accessController = new \Controllers\User();
            $accessController->islogin();
            $model = $this->getModel('Accounts');
            $data = $model->add($_POST['IdAccountDictionary'],$_POST['Login'],$_POST['Password'], $_POST['userId'], $_POST['IP']);
			
            if (isset ($data['error']))
                \Tools\Session::set('error', $data['error']);
            if (isset ($data['message']))
                \Tools\Session::set('message', $data['message']);
            $this->redirect("?controller=Accounts&action=main");
        }

        public function delete($id)
        {
            $accessController = new \Controllers\User();
            $accessController->islogin();

            $model = $this->getModel('Accounts');
            $data = $model->delete($id, \Tools\Access::get(\Tools\Access::$idUser), \Tools\Access::get(\Tools\Access::$ip));
            if(isset($data['error']))
                \Tools\Session::set('error' , $data['error']);
            if(isset($data['message']))
                \Tools\Session::set('message' , $data['message']);
            $this->redirect('?controller=Accounts&action=main');
        }

        public function editform($id){
            $accessController = new \Controllers\User();
            $accessController->islogin();

            $model = $this->getModel('Accounts');
            $data = $model->getOne($id);
            if(isset($data['error'])){
                \Tools\Session::set('error' , $data['error']);
                $this->redirect('accounts/');
            }
            $widok = $this->getView('Accounts');
            $widok->editform($data['account']);
        }

        public function update(){
            $accessController = new \Controllers\User();
            $accessController->islogin();

            $model = $this->getModel('Accounts');
            $data = $model->update($_POST['IdAccount']['0'],$_POST['IdAccountDictionary']['0'] ,$_POST['Login'], $_POST['Password'], $_POST['IP'], $_POST['idUser']);
            if(isset($data['error']))
                \Tools\Session::set('error' , $data['error']);
            if(isset($data['message']))
                \Tools\Session::set('message' , $data['message']);
            $this->redirect("?controller=Accounts&action=main");
        }


    }
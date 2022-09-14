<?php

class Home extends Controllers{

    public function __construct(){
        
        parent::__construct(); //herencia de la clase Controllers

    }


    public function home(){

        $data['tag_page'] = "Home";
        $data['page_title'] = "Pagina Principal";
        $data['page_name'] = "home";

      
        $this->views->getView($this,"home",$data);
    }

    public function insertar(){

        $data = $this->model->setUser("carlos",18);
        print_r($data);

    }

    public function verusuario($id){

        
        $data = $this->model->getUser($id);
        print_r($data);
        

    }

    public function actualizar(){

        $data = $this->model->updateUser(1,"Roberto",20);
        print_r($data);

    }

    public function verusuarios(){

        $data = $this->model->getAllUsers();
        print_r($data);


    }

    public function eliminar($id){

        $data = $this->model->deleteUser($id);
        print_r($data);

    }



}



?>
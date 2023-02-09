<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this -> load -> model('User_model');
	}
	public function index($id)
	{
        $data = $this -> User_model-> getUsuario($id);
		$this->load->view('user/edit',$data);
       
	}

    public function update($id) {
        $fullName = $this -> input->post("fullName");
        $email = $this -> input->post("email");
        $password = $this -> input->post("password");
        $repeatPassword = $this -> input->post("repeatPassword");

        $data = $this -> User_model -> getUsuario($id);
        $validateEmail = '';
        if ($email != $data -> correo) {
            $validateEmail = '|is-unique[usuario.email]';
        }

        $this->form_validation->set_rules('fullName', 'Nombre completo', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'Correo electrónico', 'required|valid_email'.$validateEmail);
        $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[4]');
        $this->form_validation->set_rules('repeatPassword', 'Confirma contraseña', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE)
        {
            $this -> index($id);
        }
        else
        {
            $data = array(
                "nombre" => $fullName,
                "correo" => $email,
                "contrasena" => md5($password),
    
    
            );
    
           
    
            $this -> User_model -> update($data,$id);
            $this -> session -> set_flashdata('success', 'Se editaron los datos correctamente');
            redirect(base_url().'usuarios');
        }
        
        
        
     
    }

   

	
}
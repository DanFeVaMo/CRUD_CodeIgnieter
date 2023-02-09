<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ADD extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this -> load -> model('User_model');
	}
	public function index()
	{
		$this->load->view('user/add');
	}

    public function save() {
        $fullName = $this -> input->post("fullName");
        $email = $this -> input->post("email");
        $password = $this -> input->post("password");
        $repeatPassword = $this -> input->post("repeatPassword");

        $this->form_validation->set_rules('fullName', 'Nombre completo', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'Correo electrónico', 'required|valid_email|is_unique[usuario.correo]');
        $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[4]');
        $this->form_validation->set_rules('repeatPassword', 'Confirma contraseña', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('user/add');
        }
        else
        {
            $data = array(
                "nombre" => $fullName,
                "correo" => $email,
                "contrasena" => md5($password),
    
    
            );
    
           
    
            $this -> User_model -> save($data);
            $this -> session -> set_flashdata('success', 'Se guardó los datos correctamente');
            redirect(base_url().'usuarios');
        }
        
        
        
      

    }
	
}

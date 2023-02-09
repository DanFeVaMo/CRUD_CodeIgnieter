<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index()
	{
		$data  = array("data" => $this->User_model->getUsuarios());

		$this->load->view('user/main', $data);
	}

	public function delete($id)
	{
		$this->User_model->delete($id);
		$this->session->set_flashdata('success', 'Eliminado correctamente');
		redirect(base_url() . 'usuarios');
	}
}

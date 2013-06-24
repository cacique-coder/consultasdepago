<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes extends CI_Controller {
	private $current_user;

	function __construct() {
		parent::__construct();
		$this->load->model('Reporte_model');
		$this->load->model('User_model');
		$current_user = User_model::load($this->session->all_userdata())
		$this->set_current_user();
	}
	public function index(){
		$this->load->view('index',array('user' => $this->current_user));
	}
	public function reporte(){
		$this->load->view('index',array('user' => $this->current_user));
	}
	public function formulario(){
		$reporte = new Reporte_model($this->current_user);
		print_r($reporte->generarComprobante());
	}

	private function set_current_user(){
		$this->session->sess_destroy();
		$data_user = $this->session->userdata('user');
		if($data_user)
			$this -> current_user = User_model::load($data_user);
		else
			redirect("/");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
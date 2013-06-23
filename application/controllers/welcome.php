<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private $current_user;

	function __construct() {
		parent::__construct();
		$this->load->model('Reporte_model');
		$this->load->model('User_model');
//		$current_user = User_model::load($this->session->all_userdata())
		$this -> current_user = new User_model();
	}
	public function index(){
		$reporte = new Reporte_model($this->current_user);
		print_r($reporte->generarComprobante());
#		$this->load->view('index',array('reporte' => ));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
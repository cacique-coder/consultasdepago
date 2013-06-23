<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte extends CI_Controller {
	private $current_user;

	function __construct() {
		parent::__construct();
		$this->load->model('Reporte_model');
		$this->load->model('User_model');
//		$current_user = User_model::load($this->session->all_userdata())
		$this -> current_user = new User_model();
	}
	public function index(){
		$this->load->view('index',array('user' => $this->current_user));
	}
	public function reporte(){
		$this->load->view('index',array('user' => $this->current_user));
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
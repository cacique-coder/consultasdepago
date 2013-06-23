<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private = $current_user;
	function __construct() {
		$this -> load -> model('Reporte_model')
		$this -> load -> model('User_model')
//		$current_user = User_model::load($this->session->all_userdata())
		$current_user = new User_model();
	}
	public function index(){
		$this->load->view('index',array('reporte' => ));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private $current_user;

	function __construct() {
		parent::__construct();
		$this->load->model('Reporte_model');
		$this->load->model('User_model');
		$this-> set_current_user();
	}
	public function index(){
		if($this->current_user)
			redirect('reporte/formulario');
		else 
			redirect('auth');
	}
	private function set_current_user(){
		$data_user = $this->session->all_userdata();
		if(isset($data_user['auth']))
			$this -> current_user = User_model::load($data_user);
		else
			$this -> current_user = false;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
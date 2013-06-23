<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auth extends CI_Controller {
	private $current_user;

	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		$this -> current_user = new User_model();
	}
	public function index(){

	}
	public function log_in(){
		$this ->current_user->load($this->input->post('user'));
		//autentincar...
		/*
		if(OK)
			redirect('reporte');
		else
			redirect('Fallo');
		*/
	}
}

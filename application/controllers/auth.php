<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auth extends CI_Controller {
  private $current_user;

  function __construct() {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Auth_model');
    $this -> current_user = new User_model();
  }
  public function index(){
    $this->load->view('login_form');
  }

  public function login() {
    $this->current_user->set_log_params($this->input->post('user'));
    $auth = new Auth_model($this -> current_user);
    if($auth->always_in()){
      $this->session->sess_destroy();
      $this->session->set_userdata($auth->data_login_user());
      redirect('reportes');
    }
    else
      $this->load->view('login_form',array('error' => 'No se pudo iniciar sesion'));
  }
}

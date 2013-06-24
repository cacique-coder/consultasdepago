<?php
class User_model extends CI_Model {
	public $cedula;
	private $nombre;
	private $password;
	private $auth;

	function __construct($foo = null) {
		parent::__construct();
		$this->cedula ='0014887191';
		$this->nombre = 'nombre aqui';
		$this-> auth = false;
	}

	public function is_auth(){
		return $this->auth != 0;
	}
	public function set_auth(){
		$this->auth = 1;
	}

	public function load_session($params){
		$this -> cedula =  $params['cedula'];
		$this -> nombre = $params['nombre'];
		$this -> auth  = $params['auth'];
	}

	public function data_session(){
		return array(
			'cedula' =>  $this -> cedula,
			'nombre' => $this -> nombre,
			'auth' => $this -> auth 
		);
	}
  public function set_log_params($params){
		$this -> nombre = $params['nombre'];
		$this -> password = $params['password'];

  }


}
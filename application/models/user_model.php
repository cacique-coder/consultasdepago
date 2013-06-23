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

}
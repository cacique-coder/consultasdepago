<?php
class User_model extends CI_Model {
	private $cedula;
	private $nombre;

	function __construct($foo = null) {
		parent::__construct();
		$this->cedula ='0014887191';
		$this->nombre = 'bastardita';
	}
}
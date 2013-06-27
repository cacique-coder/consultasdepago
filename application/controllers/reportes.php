<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes extends CI_Controller {
	private $current_user;

	function __construct() {
		parent::__construct();
		$this->load->model('Reporte_model');
		$this->load->model('User_model');
		$this->set_current_user();
	}
	public function index(){
		$this->load->view('reporte_formulario',array('user' => $this->current_user));
	}
	public function comprobante(){
		$reporte = new Reporte_model($this->current_user,$this->input->get('filter'));
		$data = array(
			'comprobante' => $reporte->generarComprobante()
		);
		$html = $this->load->view("comprobante_pago",$data,true);
//		$html = $this->load->view("comprobante_pago",$data,false);
		$this->load->library('mpdf');
		$pdf = new mPDF();
		$pdf->WriteHtml($html);
		$pdf->Output();
	}

	private function set_current_user(){
		$data_user = $this->session->all_userdata();
		if(isset($data_user['auth'])){
			$this->User_model->load_session($data_user);
			$this -> current_user = $this->User_model;
		}
		else
			redirect("/");			
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
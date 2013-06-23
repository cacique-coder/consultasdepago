<?php
class Reporte_model extends CI_Model {
	private $user;
	function __construct(User_model $user = null) {
		parent::__construct();
		if ($user != null){
			$this->user=$user;
		}
	}
	public function generarComprobante(){
		$cedula = $this -> format_cedula();
		return $this->query('reporte',array($cedula));
	}

	private function format_cedula(){
		return $this->user->cedula;
	}

	private function query($nombre_query,$params){
		$query = $this->db->query($this->sql[$nombre_query],$params);
		$result = array();
		foreach ($query->result_array() as $row)
			$result[] = $row;
		return $result;
	}
	private function replace_params($query,$params){
		foreach ($params as $param) {

		}
	}

	private  $sql = array(
		'reporte' => '
		SELECT sno_concepto.codemp,    sigesp_empresa.nombre,     sno_concepto.codnom, 
			sno_hconceptopersonal.codper,  sno_personal.nomper, sno_personal.apeper,     sno_personal.fecingper,    SNO_CARGO.descar,    
			srh_organigrama.desorg,
			sno_tipopersonal.destipper,    sno_hnomina.desnom,    sno_hperiodo.fecdesper desde, 
			sno_hperiodo.fechasper hasta,
			sno_hnomina.despernom,    sno_concepto.codconc, sno_concepto.nomcon,    sno_concepto.sigcon, 
			sno_concepto.forcon, 
			sno_hconceptopersonal.acuemp
		FROM sno_concepto,
			sno_personal,  
			sigesp_empresa,  
			SNO_CARGO,       
			sno_tipopersonal, 
			srh_organigrama,   
			sno_hpersonalnomina,
			sno_hnomina, 
			sno_hconceptopersonal, 
			sno_hperiodo
		WHERE (sno_hconceptopersonal.aplcon = 1 OR sno_concepto.glocon = 1) 
			AND sno_hconceptopersonal.codemp = sno_concepto.codemp
			AND sno_hconceptopersonal.codnom = sno_concepto.codnom 
			AND sno_hconceptopersonal.codconc = sno_concepto.codconc
			and sno_personal.codper=sno_hconceptopersonal.codper
			and sno_personal.codper=sno_hpersonalnomina.codper
			and sno_personal.codemp = sno_hpersonalnomina.codemp
			and sno_hnomina.codemp =sno_hconceptopersonal.codemp
			and sno_hnomina.codnom =sno_hconceptopersonal.codnom
			and sno_hnomina.anocurnom =sno_hconceptopersonal.anocur
			and sno_hnomina.peractnom =sno_hconceptopersonal.codperi 
			and sno_hnomina.codemp =sno_hpersonalnomina.codemp
			and sno_hnomina.codnom =sno_hpersonalnomina.codnom
			and sno_hnomina.anocurnom =sno_hpersonalnomina.anocur
			and sno_hnomina.peractnom =sno_hpersonalnomina.codperi 
			and sno_hnomina.codemp =sno_hperiodo.codemp
			and sno_hnomina.codnom =sno_hperiodo.codnom
			and sno_hnomina.anocurnom =sno_hperiodo.anocur
			and sno_hnomina.peractnom =sno_hperiodo.codperi 
			and sigesp_empresa.codemp= sno_hpersonalnomina.codemp
			and sno_cargo.codcar=sno_hpersonalnomina.codcar
			and sno_tipopersonal.codtipper=sno_hpersonalnomina.codtipper
			and srh_organigrama.codemp=sno_personal.codemp
			and srh_organigrama.codorg=sno_personal.codorg
			and sno_hconceptopersonal.codper = ?
		ORDER BY CODPER, CODCONC'
	);
}
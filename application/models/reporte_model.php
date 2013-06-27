<?php
class Reporte_model extends CI_Model {
	private $user;
	function __construct(User_model $user = null,$filter=null) {
		parent::__construct();
		$this->user=$user;
		$this->filter=$filter;
	}
	public function generarComprobante(){
		$params = $this -> params_comprobante();
		$result = $this->query_with_filter('reporte',$params);
		if (count($result > 0)) 
			return $this->formatear_comprobante_pago($result);
		else
			return false;
	}

	private function format_cedula(){
		return $this->user->cedula;
	}

	private function formatear_comprobante_pago($data){
		return array(
			'fechas' => $this->rango_fechas($data),
			'empresa' => $this->nombre_empresa($data),
			'empleado' => $this->datos_empleado($data),
			'conceptos' => $this->datos_conceptos($data)
			);
	}

	private function rango_fechas($data){
		return $data[0]['desde'].' - '.$data[0]['hasta'];
	}

	private function nombre_empresa($data){
		return  $data[0]['nombre'];
	}
	
	private function datos_empleado($data){
		return array(
			'nombre' => $data[0]['nomper'].' '. $data[0]['apeper'],
			'ingreso' => $data[0]['fecingper'],
			'cargo' => $data[0]['descar'],
			'funcion' => $data[0]['desorg']);
	}
	private function datos_conceptos($data){
		$conceptos = array('asignaciones' => array(), 'deducciones' => array());
		foreach ($data as $concepto) {
			$key = ($concepto['sigcon'] == 'A') ? 'asignaciones' : 'deducciones';
			$conceptos[$key][] = array(
				'nombre' => $concepto['nomcon'],
				'monto' => $concepto['acuemp'] );
		}
		return $conceptos;
	}

	private function query_with_filter($nombre_query,$params){
		$query = $this->add_filter($nombre_query);
		$query = $this->db->query($query,$params);
		$result = array();
		foreach ($query->result_array() as $row)
			$result[] = $row;
		return $result;
	}

	private function add_filter($nombre_query){
		$where = 'WHERE codper = ? and EXTRACT(month from desde) = ? ';
		if( !$this -> son_ambas_quincenas() ){
			$where = $where.' and '.$this->condicion_de_quincena();
		}
	//	return $this->sql[$nombre_query].' '.$where.' ORDER BY nomcon';
		return $this->sql[$nombre_query].' '.$where;
	}

	private function son_ambas_quincenas() {
		return $this->filter['quincena'] == 3;
	}

	private function condicion_de_quincena(){
		return $this->filter['quincena'] == 1 ? 'EXTRACT(day from desde) = 1' : 'EXTRACT(day from desde) = 16';
	}

	private function params_comprobante(){
		$cedula = $this -> format_cedula();
		$mes = (int)$this ->filter['mes'];
		return array($cedula,$mes);
	}

	private  $sql = array(
		'reporte' => '
			SELECT desde, hasta, codemp, nombre, codnom, codper, nomper, apeper, fecingper, descar, desorg, destipper, desnom, despernom, codconc, nomcon, sigcon, forcon, acuemp
			FROM a_mejorado_recibo_pago
			'
	);
}
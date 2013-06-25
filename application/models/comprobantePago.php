<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
define('FPDF_FONTPATH','fpdf/font/');
require('fpdf/fpdf.php');
require_once("../class/bd/classbdConsultas.php");
require_once("../../../librerias/classlibFecHor.php");




class PDF extends FPDF //para colocar encabezado y pie de pagina
{
//Cabecera de página

function Header()
{
	//Logo
	 //$this->SetRightMargin(20);
	 //$this->SetLeftMargin(20);

	 //$this->SetLeftMargin(8);
	$this->Image('imagenes/logo_vtv.jpg',30,10,40,17);
	$this->Ln(17);
	$this->SetFont('Arial','',6);
	//$this->SetFillColor(189,219,240);
	$this->Cell(5);
	$this->Cell(70,3,'República Bolivarina de Venezuela',0,0,'C',0);
	$this->Ln(3);
	$this->Cell(5);
	$this->Cell(70,3,'Ministerio del Poder Popular para la Comunicación e Información',0,0,'C',0);
	$this->Ln(3);
	$this->Cell(5);
	$this->Cell(70,3,'C.A Venezolana de Televisión',0,0,'C',0);
	$this->Ln(3);
	$this->Cell(5);
	$this->Cell(70,3,'Gerencia de Recursos Humanos',0,0,'C',0);
	$this->SetFont('Arial','B',12);
	$this->Ln(15);
	$this->Cell(5);
	$this->Cell(180,5,'COMPROBANTE DE PAGO',0,0,'C',0);
	$this->Ln(10);

	
}

//Pie de página

function Footer()
{

$fecha_actual=date("Y-m-d");

 $this->SetY(-33);
$this->SetFont('Arial','I',8);
$this->Cell(5);
//$this->Cell(170,5,'Este comprobante ha sido emitido a través de la Intranet de Venezolana de Televisión C.A., y el contenido aqui refejado corresponde a la N&oacute;mina procesada en el Sistema de Gesti&oacute;n, Administaci&oacute;n Integral',0,0,'C');

$this->MultiCell(170,5,'Este comprobante ha sido emitido a través de la Intranet de Venezolana de Televisión C.A., el contenido del mismo corresponde a la Nómina procesada en Sistema de Gestión Administrativo Integral (SIGAI).',0,'C',0);

$this->Ln(10);
$this->Cell(0,5,'Fecha de Emisión:  '.$fecha_actual,0,0,'R'); 

}

function DatosTrabajadorPDF($fecha_pago,$quincena,$apellidos_nombres,$cedula,$ingreso,$cargo,$cod_empleado,$tipo_trabajador,$gerencia)
{
$this->SetFont('Arial','B',9);
$this->Ln(6);//baja 6 milimetros
$this->Cell(5);
//$this->SetFillColor(238,238,238);

$this->SetFillColor(255,255,255);		
$this->Cell(130,5,'Fecha de Pago:',0,0,'R',1);
$this->SetFont('Arial','',9);
$this->Cell(20,5,$fecha_pago,0,0,'L',1);
$this->SetFont('Arial','B',9);
$this->Cell(20,5,'Quincena:',0,0,'R',1);
$this->SetFont('Arial','',9);
$this->Cell(10,5,$quincena,0,0,'L',1);
$this->Ln(5);//baja 6 milimetros
$this->Cell(5);
$this->SetFont('Arial','B',9);
$this->Cell(180,5,$apellidos_nombres,1,0,'C',1);
$this->Ln(5);//baja 6 milimetros
$this->Cell(5);
$this->SetFont('Arial','',9);
$this->Cell(30,5,"Cédula",1,0,'C',1);
$this->Cell(30,5,"Fecha Ingreso",1,0,'C',1);
$this->Cell(120,5,"Cargo",1,0,'C',1);
$this->Ln(5);//baja 6 milimetros
$this->Cell(5);
$this->SetFont('Arial','B',9);
$this->Cell(30,5,$cedula,1,0,'C',1);
$this->Cell(30,5,$ingreso,1,0,'C',1);
$this->Cell(120,5,$cargo,1,0,'C',1);
$this->Ln(5);//baja 6 milimetros
$this->Cell(5);
$this->SetFont('Arial','',9);
$this->Cell(30,5,"Código Nómina",1,0,'C',1);
$this->Cell(50,5,"Tipo de Trabajador",1,0,'C',1);
$this->Cell(100,5,"Gerencia",1,0,'C',1);
$this->Ln(5);//baja 6 milimetros
$this->Cell(5);
$this->SetFont('Arial','B',9);
$this->Cell(30,5,$cod_empleado,1,0,'C',1);
$this->Cell(50,5,$tipo_trabajador,1,0,'C',1);
$this->Cell(100,5,$gerencia,1,0,'C',1);

$this->Ln(10);//baja 6 milimetros
}

function DatosBancarios($banco,$forma_pago,$tipo_cta,$nro_cta)
{
$this->Cell(5);
$this->SetFont('Arial','',9);
$this->Cell(90,5,"Banco",1,0,'C',1);
$this->Cell(45,5,"Forma de Pago",1,0,'C',1);
$this->Cell(45,5,"Tipo Cuenta",1,0,'C',1);
//$this->Cell(50,5,"N° Cuenta",1,0,'C',1);
$this->Ln(5);//baja 6 milimetros
$this->Cell(5);
if ($banco=="")
{$forma_pago="CHEQUE";}
else
{$forma_pago="DEPOSITO";}

$this->SetFont('Arial','B',9);
$this->Cell(90,5,$banco,1,0,'C',1);
$this->Cell(45,5,$forma_pago,1,0,'C',1);
$this->Cell(45,5,$tipo_cta,1,0,'C',1);
//$this->Cell(50,5,$nro_cta,1,0,'C',1);
$this->Ln(10);//baja 6 milimetros
}

function DatosDetallePago($DatosAsignacion,$DatosDeduccion)
{

		$anio=$_POST['anio'];
		
		if ($anio<=2007)
		{$bs='Bs.';}
		else
		{$bs='Bs.F';}


$this->Cell(5);
$this->SetFont('Arial','B',7);
$this->Cell(180,5,"DETALLE PAGO",1,0,'C',1);
$this->Ln(5);//baja 6 milimetros
$this->Cell(5);
$this->Cell(15,5,"Código",1,0,'C',1);
$this->Cell(90,5,"Concepto",1,0,'L',1);
$this->Cell(25,5,"Cantidad",1,0,'C',1);
$this->Cell(25,5,"Asignaciones (".$bs.")",1,0,'C',1);
$this->Cell(25,5,"Deducciones (".$bs.")",1,0,'C',1);

$this->SetFont('Arial','',7);


	foreach($DatosAsignacion as $llave => $valor){
	$this->Ln(5);//baja 6 milimetros
	$this->Cell(5);
	//$asiganaciones.=$valor[1]."-".$valor[2]."-".$valor[3]."-".$valor[4]."<br>";
	$this->Cell(15,5,$valor[1],1,0,'C',1);
	$this->Cell(90,5,$valor[2],1,0,'L',1);
	$this->Cell(25,5,number_format($valor[5],2,",","."),1,0,'R',1);	
	$this->Cell(25,5,number_format($valor[3],2,",","."),1,0,'R',1);
	$this->Cell(25,5,"",1,0,'C',1);
	$contadorA=$contadorA+$valor[3];
	}





	foreach($DatosDeduccion as $llave => $valor){
	$this->Ln(5);//baja 6 milimetros
	$this->Cell(5);
	//$asiganaciones.=$valor[1]."-".$valor[2]."-".$valor[3]."-".$valor[4]."<br>";
	$this->Cell(15,5,$valor[1],1,0,'C',1);
	$this->Cell(90,5,$valor[2],1,0,'L',1);
	$this->Cell(25,5,number_format($valor[5],2,",","."),1,0,'R',1);
	$this->Cell(25,5,"",1,0,'C',1);
	$this->Cell(25,5,number_format($valor[3],2,",","."),1,0,'R',1);
	$contadorD=$contadorD+$valor[3];
	}

	$this->SetFont('Arial','B',7);
	$this->Ln(5);//baja 6 milimetros
	$this->Cell(5);
	$this->Cell(105,5,"Sub-Totales:",1,0,'R',1);
	$this->Cell(50,5,number_format($contadorA,2,",","."),1,0,'R',1);
	$this->Cell(25,5,number_format($contadorD,2,",","."),1,0,'R',1);
	$this->Ln(5);//baja 6 milimetros
	$this->Cell(5);
	$this->Cell(105,5,"Monto Neto:",1,0,'R',1);
	$total=$contadorA-$contadorD;
	$this->Cell(75,5,number_format($total,2,",","."),1,0,'R',1);
}


}
		//Create new pdf file
		$pdf=new PDF();
		$pdf->AliasNbPages();
		$pdf->Open();
		$pdf->SetAutoPageBreak(true,30);
		$pdf->AddPage('P');

		$ObjConsulta=new classbdConsultas();
		
		$ObjFecHor=new classlibFecHor();
		$conect_sigai="../../../database/archi_conex/sqlserver_sigai";
		
		$cedula=$_POST['cedula'];
		$anio=$_POST['anio'];
		$mes=$_POST['mes'] ;
		$tipo_nomina=$_POST['tipo_nomina'];
		$quincena=$_POST['quincena'];
		
		
		/*if($anio==date('Y'))
		{$anio_select='';}
		else
		{$anio_select='_'.$anio;}*/
		
		
		$var=($quincena/$mes);
		if ($var==2)
		{$var=2;}
		else
		{$var=1;}
		
		$asi_ded='A';//asignaciones
		$DatosAsignacion=$ObjConsulta->NominaTrabajadorPorTipo($conect_sigai,$cedula,$tipo_nomina,$quincena,$asi_ded,$anio);
		$fecha_pago=$DatosAsignacion[1][4];
		$fecha_pago=$ObjFecHor->flibInvertirInEs($fecha_pago);
		
		$cedula=$DatosAsignacion[1][6];
		$apellidos_nombres=$DatosAsignacion[1][7];
		$tipo_trabajador=$DatosAsignacion[1][8];
		$cargo=$DatosAsignacion[1][9];
		$gerencia=$DatosAsignacion[1][10];
		$cod_empleado=$DatosAsignacion[1][11];
		$ingreso=$DatosAsignacion[1][12];
		$ingreso=$ObjFecHor->flibInvertirInEs($ingreso);
	
		$banco=$DatosAsignacion[1][13];
		$tipo_cta=$DatosAsignacion[1][14];		
		$nro_cta=$DatosAsignacion[1][15];		
			
		$asi_ded='D';//deducciones
		$DatosDeduccion=$ObjConsulta->NominaTrabajadorPorTipo($conect_sigai,$cedula,$tipo_nomina,$quincena,$asi_ded,$anio);

	$pdf->DatosTrabajadorPDF($fecha_pago,$var,$apellidos_nombres,$cedula,$ingreso,$cargo,$cod_empleado,$tipo_trabajador,$gerencia);
	$pdf->DatosBancarios($banco,$forma_pago,$tipo_cta,$nro_cta);
	$pdf->DatosDetallePago($DatosAsignacion,$DatosDeduccion);


$pdf->Output();
?> 

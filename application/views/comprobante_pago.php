<?php $total = 0; ?>
<h1> EMPRESA </h1>
<h2> <?php echo $comprobante['empresa']; ?> </h2>
<div style = 'height:100px' class="datos_empleado">
	<div class="nombre">
		<?php echo $comprobante['empleado']['nombre'];?>
	</div>
	<br>
	<div class="fecha_ingreso">
		<b> Fecha de ingreso </b>: <?php echo $comprobante['empleado']['ingreso']?>
	</div>
	<br>
	<div class="cargo">
		<?php echo $comprobante['empleado']['cargo'].' - '.$comprobante['empleado']['funcion'] ?>	
	</div>
</div>
<br>
<table cellspacing='0' style="width: 100%; border: solid 1px black; background: #f00; text-align: center; font-size: 10pt;">
	<caption> Detalles de nomina </caption>
	<tr>
		<th style='width:24%'>Nombre de concepto</th>
		<th style='width:24%'> asignacion </th>
		<th style='width:24%'> deduccion</th>
		<th style='width:24%'></th>
	</tr>
	<?php foreach($comprobante['conceptos']['asignaciones'] as $concepto) : ?>
		<?php include('_asignacion.php'); ?>
	<?php endforeach;?>
	<?php foreach($comprobante['conceptos']['deducciones'] as $concepto) : ?>
		<?php include('_deduccion.php'); ?>
	<?php endforeach;?>
	<tr>
		<th colspan="3"> Monto neto</th>
		<td> <?php echo $total ?> </td>
	</tr>
</table>

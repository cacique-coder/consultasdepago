<?php $total = 0; ?>
<style type="text/css">
	table{
		width: 100%;
		border-spacing:0;
	}
	tr{
		border-bottom: 1px solid #aaa;
	}
	td{
	}
	td,th{
		border: 1px solid #aaa;
		padding: 10px;
	}
	th.foot{
		text-align: right;
	}
</style>
	<?php foreach ($comprobante['detalles'] as $detalles) :?>
		<h2> <?php echo $comprobante['empresa']; ?> </h2>
		<div style = 'height:100px' class="datos_empleado">
			<div class="nombre">
				<?php echo $comprobante['empleado']['nombre'];?>
			</div>
			<div class="fecha_ingreso">
				<b> Fecha de ingreso </b>: <?php echo $comprobante['empleado']['ingreso']?>
			</div>
			<div class="cargo">
				<?php echo $comprobante['empleado']['cargo'].' - '.$comprobante['empleado']['funcion'] ?>	
			</div>
		</div>
		<?php  $total = 0; ?>
		<table>
			<caption> Detalles de nomina <?php echo $detalles['fecha']?></caption>
			<tr>
				<th >Nombre de concepto</th>
				<th > asignacion </th>
				<th > deduccion</th>
				<th ></th>
			</tr>
			<?php foreach($detalles['asignaciones'] as $concepto) : ?>
				<?php include('_asignacion.php'); ?>
			<?php endforeach;?>
			<?php foreach($detalles['deducciones'] as $concepto) : ?>
				<?php include('_deduccion.php'); ?>
			<?php endforeach;?>
			<tr>
				<th class ="foot" colspan="3"> Monto neto</th>
				<td> <?php echo $total ?> </td>
			</tr>
		</table>
	<?php endforeach;?>

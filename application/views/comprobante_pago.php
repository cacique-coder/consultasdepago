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
		<?php include('recibo.php'); ?>
	<?php endforeach;?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="latin9">
	<title> </title>
	<?php echo link_tag('css/estilos.css'); ?>
</head>
<body>

<div id="container">
	<div id="header">
		<h1> Sistema de consulta de recibo de pago</h1>
	</div>
	<div id="body">
		<?php if (isset($error)) : ?>	
			<div id="error">
				<?php echo $error;?>
			</div>
		<?php endif;?>
		<?php echo form_open('auth/login'); ?>
			<label>Usuario <input type='text' name='usuario[usuario]'/></label>
			<label>Password <input type='password' name='usuario[password]'/></label>
			<input type="submit" value='Entrar'>
		</form>
	</div>
</div>
</body>
</html>
<?php include('head_html.php');?>
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
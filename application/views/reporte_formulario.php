<?php include('head_html.php');?>
<div id="container">
  <div id="header">
    <h1> Sistema de consulta de recibo de pago</h1>
    <h2><?php echo $user->cedula?></h2>
  </div>

  <div id="body">
    <?php if (isset($error)): ?>
      <p>No hay nominas cargadas para el periodo establecido</p>
    <?php endif ?>
    <?php echo form_open('reportes/comprobante',array('class' => 'big_label','method' =>'get')); ?>
      <label> Indique la quincena deseada:
        <select name='filter[quincena]'>
          <option value='1'> Primera</option>
          <option value='2'> Segunda</option>
          <option value='3'> Ambas</option>
        </select>
      </label>
      <label>
        Indique el mes:
        <?php $meses = explode(' ',"Enero Febrero Marzo Abril Mayo Junio Julio Agosto Septiembre Octubre Noviembre Diciembre");?>
        <?php $mes_actual = date('n') - 1; ?>
        <select name='filter[mes]'> 
          <?php foreach($meses as $mes => $nombre) :?>
            <?php if( $mes_actual < $mes):?>
              <?php break;?>
            <?php endif;?>
            <option value="<?php echo $mes + 1 ?>">
              <?php echo $nombre; ?>
            </option>
          <?php endforeach;?>
        </select>
      </label>
      <input type="submit" value='Entrar'>
    </form>
  </div>
</div>
</body>
</html>
<div>
  <?php if ($error != '') { ?>
    <p><?php echo $error; ?></p>
  <?php } elseif ($action == 'M') { ?>
  <form method="POST" action="<?php echo site_url('cart/linkPassword'); ?>">
    <input name="email">
    <input type="submit" value="send">
  </form>
  <?php  } else { ?>
  <form method="POST" action="<?php echo site_url('cart/cambiarPassword') . '/' . $email; ?>">
    <input name="password">
    <input name="confirmPassword">
    <input type="submit" value="send">
  </form>
  <?php } ?>
</div>
<div class="msgBox hide">
  <p>Estamos procesando su solicitud, en breve recibira un correo con un link para resetear su contraseña. Si no lo encuentra en su bandeja de entrada revise en correos no deseados. Por cualquier inconveniente contactenos a info@vqv.com.uy</p>
  <p>Se ha modificado su contraseña correctamente</p>
</div>

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

<?php
#session
if($session->id_tenant != null && $session->id_user != null):

#privs ANULAR FOOTER
if(1 > 99):
?>
<footer>
  <div class="row footer">
    <div class="small-6 large-4 columns">
      <ul class="menu align-left">
        <li>AndesLabs SpA 2018</li>
        <li class="pushed-left"><a href="">Términos y condiciones</a></li>
        <li class="pushed-left"><a href="">Privacidad</a></li>
        <li class="pushed-left"><a href="">Seguridad</a></li>
      </ul>
    </div>
    <div class="small-6 large-4 columns" style="text-align:center;">
      <ul class="menu" style="display: inline-block;">
        <li>Pergo - v<?php echo $constants->getSysVersion(); ?></li>
      </ul>
      <ul class="menu" style="display: inline-block;">
        <li class="pushed-left">Gomez & Riesco</li>
      </ul>
    </div>
    <div class="large-4 columns">
      <ul class="menu align-right">
        <li class="pushed-left"><a href="">Contacto</a></li>
        <li class="pushed-left">Ayuda</li>
        <li class="pushed-left">Acerca de Pergo</li>
      </ul>
    </div>
  </div>
</footer>
<?php endif;?>

<script type="text/javascript" language="javascript" src="views/lib/vendor/what-input.js"></script>
<script type="text/javascript" language="javascript" src="views/lib/vendor/foundation.js"></script>
<script type="text/javascript" language="javascript" src="views/lib/app.js"></script>
<script type="text/javascript" language="javascript" src="views/lib/jquery.validate.min.js"></script>
<script type="text/javascript" language="javascript" src="views/lib/jquery.validate.messages.js"></script>
<script type="text/javascript" language="javascript" src="views/lib/jquery.timepicker.min.js"></script>

</body>
</html>
<?php
else:
    session_destroy();
    echo '<script language="JavaScript">alert("Debe Identificarse"); document.location = "'.$rootPath.'"</script>';
endif; #session

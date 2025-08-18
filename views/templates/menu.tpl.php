<!-- NO SCRIPT WARNING -->
<noscript>
<div>
    <h4>¡Espera un momento!</h4>
    <p>La página que estás viendo requiere JavaScript activado.
    Si lo has deshabilitado intencionalmente, por favor vuelve a activarlo o comunicate con soporte.</p>
</div>
</noscript>

<?php
use App\Libs\Menu;

$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
?>

<div class="top-bar-container" data-sticky-container>
  <div class="top-bar sticky" data-sticky data-margin-top="0">
      <div class="top-bar-title">
          <li class="menu-text">Relok v<?php echo $constants->getSysVersion(); ?></li>
      </div>
      <div class="top-bar-left">
          <?php
          include 'libs/Menu.php';
          $menu = new Menu();
          $menu->loadMainMenu($session);
          ?>
      </div>
      <div class="top-bar-right">
        <?php
        $menu->loadAccountMenu($session);
        ?>
      </div>
  </div>

</div>

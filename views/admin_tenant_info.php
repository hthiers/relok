<?php
require('templates/header.tpl.php'); #session & header

#session
if($session->id_tenant != null && $session->id_user != null):

#privs
#if($session->privilegio > 0):
?>

<!-- AGREGAR JS & CSS AQUI -->
<script type="text/javascript" language="javascript" src="views/lib/utils.js"></script>
<!--<link rel="stylesheet" href="views/css/company_info.css"></link>-->
<style type="text/css" title="currentStyle">
	@import "views/css/datatable.css";
</style>

<!-- Funciones JS -->
<?php require_once('js_admin_tenant_info.php'); # JS ?>

</head>

<body id="dt_example">

  <?php require('templates/menu.tpl.php'); #banner & menu ?>

    <!-- CENTRAL -->
    <div id="central">
    <div id="contenido">

      <!-- DEBUG -->
      <?php
      if($debugMode)
      {
          print('<div class="row" id="debugbox">');
          print("tenant: ".$session->id_tenant.", user: ".$session->id_user."<br/>");
          #print_r($titulo); print('<br />');
          print_r($usuarios); print('<br />');
          #print(htmlspecialchars($error_flag, ENT_QUOTES)); print('<br />');
          #print_r($permiso_editar); print('<br />');
          print('</div>');
      }
      ?>
      <!-- END DEBUG -->

      <h1>
          <span class="icon-title fi-widget"></span><?php echo $titulo; ?>
      </h1>

      <?php
      if (isset($error_flag)){
          if(strlen($error_flag) > 0){
              echo $error_flag;
          }
      }
      ?>

      <!-- Company card  -->
      <div class="card-user-container">

      <!--card's image-->
      <div class="card-user-avatar">
        <!--<img src="views/img/logo-gyr.png" alt="" class="user-image">-->
      </div>

      <!--user info name, bio and location-->
      <div class="card-user-bio">
        <h3> <?php echo $company_info['tenant'] ?></h3>
        <p> <?php echo 'Tipo de cuenta: '.$company_info['account_type'] ?></p>
        <!--<p> <?php setlocale(LC_MONETARY, 'es_CL'); echo 'Valor por usuario: '.money_format('UF %.2n', $company_info['price']); ?></p>-->
        <!-- <p> <?php #echo 'Fecha de expiración: '.$company_info['expiration_date'] ?></p> -->
        <p> <?php echo 'Estado de cuenta: '.$company_info['tenant_status'] ?></p>
      </div>

      <!--card's follow button-->
      <div class="card-user-button">
        <!--<a href="?controller=tenant&amp;action=getPaymentHistory" class="hollow button">Historial de Pagos</a>-->
      </div>

    </div>
    </div>
    <!-- END CENTRAL -->

<?php
#endif; #privs
endif; #session
require('templates/footer.tpl.php');

<?php
require('templates/header.tpl.php'); #session & header

#session
if($session->id_tenant != null && $session->id_user != null):

#privs
if($session->id_profile > 0):
?>

<!-- AGREGAR JS & CSS AQUI -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" language="javascript" src="views/lib/utils.js"></script>
<?php require_once('js_panel.php'); # JS ?>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart', 'bar'], 'language':'es'});
  google.charts.setOnLoadCallback(chartTareasxMaterias);
  google.charts.setOnLoadCallback(chartTareasxUsuarios);
  google.charts.setOnLoadCallback(chartTareasxAnio);
</script>

</head>

<body>

    <?php #require('templates/dialogs.tpl.php'); #banner & menu ?>
    <?php require('templates/menu.tpl.php'); #banner & menu ?>

    <!-- CENTRAL -->
    <div class="row normal">

        <!-- DEBUG -->
        <?php
        if($debugMode)
        {
            print('<div class="row" id="debugbox">');
            #print("tenant: ".$session->id_tenant.", user: ".$session->id_user."<br/>");
            #print_r($titulo); print('<br />');
            #print_r($usuariosTareas); print('<br />');
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

        <!-- General -->
        <ul class="stats-list">
          <li>
            <?php echo $listado->rowCount(); ?> <span class="stats-list-label">Trabajos</span>
          </li>
          <li class="stats-list">
            <?php echo $clientes->rowCount(); ?> <span class="stats-list-label">Clientes</span>
          </li>
          <li class="stats-list">
            <?php echo $usuarios->rowCount(); ?> <span class="stats-list-label">Colaboradores</span>
          </li>
        </ul>

        <!-- Charts -->
        <div class="row">

          <div class="large-6 columns">
            <div class="sweetbox-pad" style="margin-bottom:20px;" id="chart_trabajosxmaterias_div"></div>
            <!-- <div class="sweetbox-pad" id="chart_gestionesxanio_div"></div> -->
          </div>
          <div class="large-6 columns">
            <div class="sweetbox-pad" id="chart_gestionesxusuario_div"></div>
          </div>

        </div>

        <?php
        #$rTodo = $usuariosTareas->fetchAll(PDO::FETCH_ASSOC); //todos
        #$rUsuarios = $usuariosTareas->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_UNIQUE); //usuarios
        $rUsuarios = $usuariosTareas->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_UNIQUE); //usuarios
        $rMaterias = $usuMaterias->fetchAll(PDO::FETCH_GROUP); // materias de usuarios
        // $usuariosTareas->closeCursor();
        // $rMaterias = $usuariosMaterias->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_UNIQUE); //materias
        // print_r($rUsuarios);
        // print_r($rMaterias);
        ?>

        <table class="dashboard-table">
          <colgroup>
            <!-- width total:  -->
            <col width="150">
            <col width="80">
            <col width="200">
            <col width="60">
            <!-- <col width="100"> -->
            <col width="80">
          </colgroup>
          <thead>
            <tr>
              <th>Usuario</th>
              <th>Perfil</th>
              <th>Último Trabajo</th>
              <th>Materias</th>
              <!-- <th><a href="#">Total de Trabajos<i class="fa fa-caret-down"></i></a></th> -->
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
          </tbody>

              <?php foreach ($rUsuarios as $key => $value):?>
              <tr>
              <td>
                <div class="flex-container align-justify align-top">
                  <div class="flex-child-shrink">
                    <?php if($value['genero'] == "M"): ?>
                    <img class="dashboard-table-image" src="views/img/dashboard/man_avatar_32px.png">
                    <?php else: ?>
                    <img class="dashboard-table-image" src="views/img/dashboard/woman_avatar_32px.png">
                    <?php endif; ?>
                  </div>
                  <div class="flex-child-grow">
                    <h6 class="dashboard-table-text"><?php echo $value['nombres']." ".$value['apellidos']; ?></h6>
                    <span class="dashboard-table-timestamp"><?php echo $value['name_user']; ?></span>
                  </div>
                </div>
              </td>

              <td>
                <h6 class="dashboard-table-text"><?php echo $value['label_profile']; ?></h6>
              </td>

              <td style="text-align:center">
                <?php if($value['label_task'] != null): ?>
                <h6 class="dashboard-table-text"><?php echo $value['label_task']  ?></h6>
                <h7 class="dashboard-table-text"><?php echo $value['date_end'];?></h7>
                <span class="dashboard-table-timestamp"><?php echo $value['label_type'];?></span>
                <?php else: ?>
                <h6 class="dashboard-table-text"><?php echo "(sin trabajos)"; ?></h6>
                <?php endif; ?>
              </td>

              <td>
                <h6 class="dashboard-table-text">
                  <?php
                  $found = 0;

                  // Revisar materias de usuario
                  foreach ($rMaterias as $mKey => $mValue) {

                    if($mKey == $value['id_user']){
                      $found = 1;

                      foreach ($mValue as $mate) {
                        echo $mate['label_type'];
                        echo "<br>";
                      }
                    }
                  }

                  if($found == 0){
                    echo "(sin trabajos)";
                  }
                  ?>
                </h6>
              </td>

              <!-- <td>
                <h6 class="dashboard-table-text">...</h6>
              </td> -->

              <td style="text-align:center">
                <?php echo ($value['id_status']==1) ? "<i class='fi-like' style='font-size: 1.8rem;'></i>":"Inactivo";?>
              </td>

              </tr>

              <?php endforeach; ?>

          </tbody>
        </table>

    </div>
    <!-- END CENTRAL -->

<?php
endif; #privs
endif; #session
require('templates/footer.tpl.php');

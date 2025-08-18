<?php
require('templates/header.tpl.php'); #session & header

#session
if($session->id_tenant != null && $session->id_user != null):

#privs
#if($session->privilegio > 0):
?>

<!-- Funciones JS -->
<?php require_once('js_tasks_edit.php'); # JS ?>

</head>
<body>

    <?php require('templates/menu.tpl.php'); #banner & menu ?>

    <!-- Content -->
    <div class="row">

        <!-- DEBUG -->
        <?php
        if($debugMode)
        {
            print('<div id="debugbox">');

            print('<br />');
            print($label_management);
            print('<br />');
            print('<br />');

            print_r($titulo); print('<br />');
            print($date_ini); print('<br />');
            print($date_end); print('<br />');
            print($id_task); print('<br />');
            print_r($pdoUsers); print('<br />');

            print("tenant: ".$session->id_tenant.", user: ".$session->id_user."<br/>");

            if(isset($error)){
                print($error);
                print('<br />');
            }

            print('</div>');
        }
        ?>
        <!-- END DEBUG -->

        <h1>
          <span class="icon-title fi-clipboard-pencil"></span><?php echo $titulo; ?>
        </h1>

        <?php
        if (isset($error_flag)){
            if(strlen($error_flag) > 0){
                echo $error_flag;
            }
        }
        ?>

        <?php require('modal_tasks_new.php'); #banner & menu ?>

        <!-- box -->
        <div class="sweetbox-pad">

            <!-- Nueva tarea-->
            <form id="formModule" name="formModule" method="post" action="?controller=tasks&amp;action=tasksUpdate">
              <!-- form container -->
              <div class="row">

                <!-- seccion nueva tarea -->
                <div class="medium-6 columns">
                  <div class="row">
                    <div class="medium-3 columns">
                      <label for="cbousers" class="text-right middle">Responsable</label>
                    </div>
                    <div class="medium-9 columns">
                      <?php
                      echo "<select class='input_box' id='cbousers' name='cbousers'>\n";
                      while($row = $pdoUsers->fetch(PDO::FETCH_ASSOC))
                      {
                          if($row['id_user'] == $id_user){
                              echo "<option selected value='$row[id_user]'>$row[name_user]</option>\n";
                          }
                          else{
                              echo "<option value='$row[id_user]'>$row[name_user]</option>\n";
                          }
                      }
                      echo "</select>\n";
                      ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="medium-3 columns">
                      <label for="cbocustomers" class="text-right middle">Cliente</label>
                    </div>
                    <div class="medium-9 columns">
                      <?php
                      echo "<select class='input_box' id='cbocustomers' name='cbocustomers'>\n";
                      echo "<option value='noaplica'>Sin Cliente</option>\n";
                      while($row = $pdoCustomer->fetch(PDO::FETCH_ASSOC))
                      {
                          if($row['id_customer'] == $id_customer){
                              echo "<option selected value='$row[id_customer]'>$row[label_customer]</option>\n";
                          }
                          else{
                              echo "<option value='$row[id_customer]'>$row[label_customer]</option>\n";
                          }
                      }
                      echo "</select>\n";
                      ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="medium-3 columns">
                      <label for="cbotypes" class="text-right middle">Materia</label>
                    </div>
                    <div class="medium-9 columns">
                      <?php
                      echo "<select id='cbotypes' name='cbotypes' style='width: 89%;'>\n";

                      while($row = $pdoTypes->fetch(PDO::FETCH_ASSOC))
                      {
                          if($row['id_type'] == $id_type){
                              echo "<option selected value='$row[id_type]'>$row[label_type]</option>\n";
                          }
                          else {
                              echo "<option value='$row[id_type]'>$row[label_type]</option>\n";
                          }
                      }

                      echo "</select>\n";
                      ?>

                      <a id="create-type" class="icon-action" href="#" data-open="modalNuevaMateria"><span class="fi-plus pushed"></span></a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="medium-3 columns">
                      <label for="cbotypes" class="text-right middle">Gestión</label>
                    </div>
                    <div class="medium-9 columns">
                      <?php
                        echo "<select id='cbomanagements' name='cbomanagements' style='width: 89%;'>\n";
                        echo "<option selected value='$id_management'>$label_management</option>\n";
                        echo "</select>\n";
                        ?>

                        <a id="create-management" class="icon-action" href="#" data-open="modalNuevaGestion"><span class="fi-plus pushed"></span></a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="medium-3 columns">
                      <label for="cbotypes" class="text-right middle">Descripción</label>
                    </div>
                    <div class="medium-9 columns">
                      <textarea rows="5" name="descripcion"><?php echo $desc_task;?></textarea>
                    </div>
                  </div>

                </div>
                <!-- /Seccion nueva tarea -->

                <!-- Seccion tarea pasada -->
                <div class="medium-6 columns">

                  <div class="row">
                    <div class="medium-3 columns">
                      <label for="datepicker" class="text-right middle">Fecha inicio</label>
                    </div>
                    <div class="medium-9 columns">
                      <div id="datepicker" name="datepicker" class="datepicker"></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="medium-3 columns">
                      <label for="hora_ini" class="text-right middle">Hora inicio</label>
                    </div>
                    <div class="medium-9 columns">
                      <input id="hora_ini" name="hora_ini" type="text" value="<?php echo $date_ini; ?>" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="medium-3 columns">
                      <label for="duration" class="text-right middle">Duración</label>
                    </div>
                    <div class="medium-9 columns">
                      <input id="duration" name="duration" type="text" value="<?php echo $time_total; ?>" />
                    </div>
                  </div>

                </div>
                <!-- /Seccion tarea pasada -->

                <input id="hdnPicker" type="hidden" name="fecha_ini" value="" />
                <input id="hdnUser" type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
                <input id="gestion" type="hidden" name="etiqueta"/>

                <div class="medium-1 medium-centered columns">
                  <a id="btn_play" class="button success icon-tool icon-tool-circle"><span class="icon-tool fi-play"></span></a>
                </div>

              </div>
              <!-- /form container -->
            </form>
            <!-- /Nueva tarea-->

        </div>
    </div>
    <!-- /Content -->

<?php
#endif; #privs
endif; #session
require('templates/footer.tpl.php');

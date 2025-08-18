<?php
require('templates/header.tpl.php'); #session & header

#session
if($session->id_tenant != null && $session->id_user != null):

#privs
//if($session->privilegio > 0):
?>

<!-- Funciones JS -->
<?php require_once('js_users_edit.php'); # JS ?>

</head>
<body>

    <?php require('templates/menu.tpl.php'); #banner & menu?>

    <!-- CENTRAL -->
    <div class="row">

        <!-- DEBUG -->
        <?php
        if($debugMode)
        {
            print('<div id="debugbox">');
            print_r($title); print('<br />');print_r($controller); print('<br />');
            print_r($profiles); print('<br />');print_r($action_b); print('<br />');
            print_r($user); print('<br />');print_r($action_b); print('<br />');
            print_r($estados); print('<br />');
            print(htmlspecialchars($error_flag, ENT_QUOTES)); print('<br />');
            print('</div>');
        }
        ?>
        <!-- END DEBUG -->

        <h1>
          <span class="icon-title fi-clipboard-pencil"></span><?php echo $title; ?>
        </h1>

        <?php
        if (isset($error_flag)){
            if(strlen($error_flag) > 0){
                echo $error_flag;
            }
        }
        ?>

        <?php $data_user = $user->fetch(PDO::FETCH_ASSOC); ?>


        <div class="sweetbox-pad">

            <!-- FORM -->
            <form id="moduleForm" name="form1" method="post" action="?controller=panel&amp;action=userEdit">

              <div class="row">

                <div class="row">
                  <div class="medium-3 columns">
                    <label for="fullname_user" class="text-right middle">Nombre Completo</label>
                  </div>
                  <div class="medium-4 columns">
                    <input type="text" id="fullname_user" name="fullname_user" value="<?php echo $data_user['nombres'];?>" />
                  </div>
                  <div class="medium-5 columns">
                    <input type="text" id="lastname_user" name="lastname_user" value="<?php echo $data_user['apellidos'];?>" />
                  </div>
                </div>

                <div class="row">
                  <div class="medium-3 columns">
                    <label for="name_user" class="text-right middle">Nombre de Usuario</label>
                  </div>
                  <div class="medium-9 columns">
                    <input type="text" id="name_user" name="name_user" value="<?php echo $data_user['name_user'];?>" />
                  </div>
                </div>

                <?php if($session->id_profile == 1): ?>
                <div class="row">
                  <div class="medium-3 columns">
                    <label for="cboprofiles" class="text-right middle">Perfil</label>
                  </div>
                  <div class="medium-9 columns">
                    <?php
                    echo "<select id='cboprofiles' name='cboprofiles'>\n";
                    while($row = $profiles->fetch(PDO::FETCH_ASSOC))
                    {
                        if($row['id_profile'] == $data_user['id_profile'])
                        {
                            echo "<option value='$row[id_profile]' selected>$row[label_profile]</option>\n";
                        }
                        else
                        {
                            echo "<option value='$row[id_profile]' >$row[label_profile]</option>\n";
                        }
                    }
                    echo "</select>\n";
                    ?>
                  </div>
                </div>
                <div class="row">
                  <div class="medium-3 columns">
                    <label for="cbostatus" class="text-right middle">Activo</label>
                  </div>
                  <div class="medium-9 columns">
                    <div class="switch">
                      <input
                        class="switch-input"
                        id="chk_status"
                        type="checkbox"
                        name="chk_status"
                        <?php echo $data_user['id_status'] < 1 ? '': 'checked=checked';?>"
                       />
                      <label class="switch-paddle" for="chk_status">
                          <span class="show-for-sr">Activo</span>
                          <span class="switch-active" aria-hidden="true">Si</span>
                          <span class="switch-inactive" aria-hidden="true">No</span>
                      </label>
                    </div>
                  </div>
                </div>
                <?php endif; ?>

                <div class="row">
                  <div class="medium-3 columns">
                    <label for="pass_user_1" class="text-right middle">Ingrese nueva contraseña</label>
                  </div>
                  <div class="medium-9 columns">
                    <input type="password" name="pass_user_1" id="pass_user_1" placeholder="solo cambio contraseña" />
                  </div>
                </div>

                <div class="row">
                  <div class="medium-3 columns">
                    <label for="pass_user_2" class="text-right middle">Repita contraseña</label>
                  </div>
                  <div class="medium-9 columns">
                    <input type="password" name="pass_user_2" id="pass_user_2" placeholder="solo cambio contraseña" />
                  </div>
                </div>


                <div class="medium-1 medium-centered columns">
                  <button name="button" type="submit" class="button">Editar</button>
                </div>

                <input type="hidden" name="id_user" value="<?php echo $data_user['id_user']; ?>" />
                <input type="hidden" name="original_name_user" value="<?php echo $data_user['name_user']; ?>" />
                <?php if( $session->id_profile <> 1 && $data_user['id_status'] == 1): ?>
                <input type="hidden" name="chk_status" value="1" />
                <?php endif; ?>

              </div>
            </form>

        </div>
    </div>
    <!-- END CENTRAL -->

<?php
//endif; #privs
endif; #session

require('templates/footer.tpl.php');
?>
</body>

<?php
require('templates/header.tpl.php'); #session & header

#session
if($session->id_tenant != null && $session->id_user != null):

#privs
#if($session->privilegio > 0):
?>

<!-- Funciones JS -->
<?php require_once('js_users_edit.php'); # JS ?>

</head>
<body>

    <?php require('templates/menu.tpl.php'); #banner & menu ?>

    <!-- CENTRAL -->
    <div class="row">

        <!-- DEBUG -->
        <?php
        if($debugMode)
        {
            print('<div id="debugbox">');
            print("tenant: ".$session->id_tenant.", user: ".$session->id_user."<br/>");
            print_r($titulo); print('<br />');
            print_r($listado); print('<br />');
            print_r($customer); print('<br />');
            #print_r($permiso_editar); print('<br />');
            print('</div>');
        }
        ?>
        <!-- END DEBUG -->

        <p class="titulos-form"><?php echo $titulo; ?></p>

        <div id="sweetbox-pad">

            <!-- FORM -->
            <form id="moduleForm" name="form1" method="post"  action="<?php echo $rootPath.'?controller=customers&amp;action=customerEdit';?>">
            <table border="0" align="center" class="texto">
                <tr>
                    <td>Nombre</td>
                    <td width="50">:</td>
                    <td>
                        <input class="input_box" name="label_customer" type="text" id="label_customer" size="40" value="<?php echo $customer['label_customer'];?>" />
                    </td>
                </tr>
                <tr>
                    <td>RUN</td>
                    <td width="50">:</td>
                    <td>
                        <input class="input_box" name="customer_dni" type="text" id="customer_dni" size="40" value="<?php echo $customer['customer_dni'];?>" />
                    </td>
                </tr>
                <tr>
                    <td>Descripción</td>
                <td>:</td>
                <td>
                    <input class="input_box" name="detail_customer" type="text" id="detail_customer" size="40" value="<?php echo $customer['detail_customer']; ?>" />
                </td>
                </tr>

            </table>
            <div class="medium-1 medium-centered columns">
                <button name="button" type="submit" class="button">Editar</button>
            </div>

            <input type="hidden" name="id_customer" value="<?php echo $customer['id_customer']; ?>" />
            </form>
            <!-- END FORM -->

    <!-- END CENTRAL -->
    </div>

<?php
#endif; #privs
endif; #session
require('templates/footer.tpl.php');
?>

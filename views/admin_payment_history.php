<?php
require('templates/header.tpl.php'); #session & header

#session
if($session->id_tenant != null && $session->id_user != null):

#privs
#if($session->privilegio > 0):
?>

<!-- AGREGAR JS & CSS AQUI -->
<script type="text/javascript" language="javascript" src="views/lib/utils.js"></script>
<link rel="stylesheet" href="views/css/payments.css"></link>

<!-- Funciones JS -->
<?php require_once('js_admin_payment_history.php'); # JS ?>

</head>

<body>

    <?php #require('templates/dialogs.tpl.php'); #banner & menu ?>
    <?php require('templates/menu.tpl.php'); #banner & menu ?>

    <!-- CENTRAL -->
    <div class="row large">

        <!-- DEBUG -->
        <?php
        if($debugMode)
        {
            print('<div class="row" id="debugbox">');
            print("tenant: ".$session->id_tenant.", user: ".$session->id_user."<br/>");
            #print_r($titulo); print('<br />');
            print_r($usuarios); print('<br />');
            print_r($payments_array); print('<br />');
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

          <?php
          $body = '';
          if ($payments_array->rowCount() > 0) {
              $body = '<table>
              <thead>
              <tr class="headers">
                <th>
                  Periodo
                </th>
                <th>
                  Monto a pagar
                </th>
                <th>
                  Monto Pagado
                </th>
                <th>
                  Fecha de Facturación
                </th>
                <th>
                  Fecha de Expiración
                </th>
                <th>
                  Fecha de Pago
                </th>
                <th>
                  Estado
                </th>
              </tr>
            </thead>
            <tbody class="detail-payments">';

            if($payments_array->execute()){
              setlocale(LC_MONETARY,"es_ES");
              while ($fila = $payments_array->fetch(PDO::FETCH_ASSOC)) {
                $body .= '<tr>';
                $body .= '<td class="detail-payments-info">'.$fila['period'].'</td>';
                $body .= '<td class="detail-payments-ammount">'.Utils::moneda_chilena($fila['payment_ammount']).'</td>';
                $body .= '<td class="detail-payments-ammount">'.Utils::moneda_chilena($fila['paid_ammount']).'</td>';
                $body .= '<td class="detail-payments-info">'.$fila['billing_date'].'</td>';
                $body .= '<td class="detail-payments-info">'.$fila['expiration_date'].'</td>';
                $body .= '<td class="detail-payments-info">'.$fila['payment_date'].'</td>';
                $body .= '<td class="detail-payments-info">'.$fila['status'].'</tr>';
                $body .= '</tr>';
              }
            }
            else{
              $body .= '<tr>';
              $body .= '<td class="detail-payments-info">No Data</td>';
              $body .= '</tr>';
            }

            $body .= '  </tbody>
            </table>';
            echo $body;
          }

          else {
            $body .= 'No se encuentran registros de pagos';
            echo $body;
          }

          ?>



    </div>
    <!-- END CENTRAL -->

<?php
#endif; #privs
endif; #session
require('templates/footer.tpl.php');

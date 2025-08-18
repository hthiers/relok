<?php
require('templates/header.tpl.php'); #session & header

#session
if($session->id_tenant != null && $session->id_user != null):

#privs
#if($session->privilegio > 0):
 ?>

 <script type="text/javascript" language="javascript" src="views/lib/utils.js"></script>

 <?php #require_once('js_tasks_dt.php'); # JS ?>

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


        <table class="dashboard-table">
          <colgroup>
            <col width="150">
            <col width="80">
            <col width="200">
            <col width="60">
            <col width="220">
            <col width="170">
          </colgroup>
          <tbody>
          </tbody>
            <tr>
              <td>
                <div class="flex-container align-justify align-top">
                  <div class="flex-child-shrink">
                    <img class="dashboard-table-image" src="views/img/dashboard/user_avatar_48px.png">
                  </div>
                  <div class="flex-child-grow">
                    <h6 class="dashboard-table-text">A Person</h6>
                    <span class="dashboard-table-timestamp">03/04/2017</span>
                  </div>
                </div>
              </td>
              <td>Single Line</td>
              <td class="bold">A Bold Line</td>
              <td>A Date</td>

              <td>
                <div class="flex-container align-top">
                  <div class="flex-child-shrink">
                    <img class="dashboard-table-image" src="http://lorempixel.com/50/50/people/">
                  </div>
                  <div class="flex-child">
                    <h6 class="dashboard-table-text">Another person did something</h6>
                    <span class="dashboard-table-timestamp">03/08/2017</span>
                  </div>
                </div>
              </td>

              <td class="listing-inquiry-status">

                <div class="flex-container align-top">
                  <div class="flex-child-shrink">
                    <img class="dashboard-table-image" src="http://lorempixel.com/25/25/abstract/">
                  </div>
                  <div class="flex-child">
                    <h6 class="dashboard-table-text"><a href="#">A longer wrapping item with an image that is aligned to the top</a></h6>
                  </div>
                </div>

              </td>
            </tr>
            <tr>
              <td>
                <div class="flex-container align-justify align-top">
                  <div class="flex-child-shrink">
                    <img class="dashboard-table-image" src="http://lorempixel.com/50/50/people/">
                  </div>
                  <div class="flex-child-grow">
                    <h6 class="dashboard-table-text">A Person</h6>
                    <span class="dashboard-table-timestamp">03/04/2017</span>
                  </div>
                </div>
              </td>
              <td>Single Line</td>
              <td class="bold">A Bold Line</td>
              <td>A Date</td>
              <td>
                <div class="flex-container align-top">
                  <div class="flex-child-shrink">
                    <img class="dashboard-table-image" src="http://lorempixel.com/50/50/people/">
                  </div>
                  <div class="flex-child">
                    <h6 class="dashboard-table-text">Another person did something</h6>
                    <span class="dashboard-table-timestamp">03/08/2017</span>
                  </div>
                </div>
              </td>
              <td class="listing-inquiry-status">

                <div class="flex-container align-top">
                  <div class="flex-child-shrink">
                    <img class="dashboard-table-image" src="http://lorempixel.com/25/25/abstract/">
                  </div>
                  <div class="flex-child">
                    <h6 class="dashboard-table-text"><a href="#">A longer wrapping item with an image that is aligned to the top</a></h6>
                  </div>
                </div>

              </td>
            </tr>
          </tbody>
        </table>





    </div>
    <!-- END CENTRAL -->

<?php
#endif; #privs
endif; #session
require('templates/footer.tpl.php');

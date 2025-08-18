<?php
namespace App\Controllers;

use App\Libs\ControllerBase;
use App\Libs\FR_Session;
use App\Libs\Utils;
use App\VO\UserVO;
use App\Models\UsersModel;
use App\Models\ProfilesModel;
use App\Models\TasksModel;
use App\Models\CustomersModel;
use App\Models\PanelModel;
use App\Models\TypesModel;
use PDO;

class PanelController extends ControllerBase
{
    /*******************************************************************************
    * Contexto de Usuarios
    *******************************************************************************/

    /*
     * Show new user form
     */
    public function newUserForm()
    {
        $session = FR_Session::singleton();

        if( $session->id_profile <> 1 )
            header("Location: ".$this->root."?controller=panel&action=usersDt");

        //incluye el modelo que corresponde
        require_once 'models/ProfilesModel.php';

        $error_flag = '';
        $message = '';

        #support global messages
        if(isset($_GET['error_flag'])) {
            $error_flag = $_GET['error_flag'];
        }
        if(isset($_GET['message']))
            $message = $_GET['message'];

        $data['titulo'] = "Información de la cuenta";

        //Se crea una instancia del "modelo"
        $model = new ProfilesModel();

        $pdoProfiles = $model->getAllProfiles();
        $data['profiles'] = $pdoProfiles;

        $data['error_flag'] = $this->errorMessage->getError($error_flag,$message);


        $this->view->show("users_new.php", $data);
    }

    public function newUserAdd()
    {
        //Incluye el modelo que corresponde
        require_once 'models/UsersModel.php';
        require_once 'vo/UserVO.php';

        $session = FR_Session::singleton();
        $model = new UsersModel();
        $user = new UserVO();
        $profile_user = null; //Daclaración de variable antes de capturar el valor de un combobox

        #support global messages
        if(isset($_GET['error_flag']))
            $error_flag = $_GET['error_flag'];
        if(isset($_GET['message']))
            $message = $_GET['message'];

        $data['titulo'] = "Nuevo Usuario";

        $fullname_user = filter_input(INPUT_POST, 'fullname_user');
        $lastname_user = filter_input(INPUT_POST, 'lastname_user');

        $name_user = filter_input(INPUT_POST, 'name_user');
        $profile_user = filter_input(INPUT_POST, 'cboprofiles');

        $password = filter_input(INPUT_POST, 'pass_user');
        $password_cnf = filter_input(INPUT_POST, 'pass_user_cnf');

        if($password === $password_cnf):

          $code_user = Utils::guidv4();

          $user->setFullnameUser($fullname_user);
          $user->setLastnameUser($lastname_user);
          $user->setNameUser($name_user);
          $user->setPasswordUser($password);
          $user->setIdProfile($profile_user);
          $user->setIdTenant($session->id_tenant);
          $user->setIdStatus(1);

          $result_val= $model->getBoolUsername($user);
          $boolean_name_user = $result_val->fetch(PDO::FETCH_ASSOC);

          $validacion = $this->validarDatosUsuario($user, 'normal', $boolean_name_user['result']);

          if($validacion['estado'] == true )
          {
              $result = $model->addNewUser(
                    $session->id_tenant
                    , $code_user
                    , $user->getNameUser()
                    , $user->getIdProfile()
                    , $user->getPasswordUser()
                    , $user->getIdStatus()
                    , $user->getFullnameUser()
                    , $user->getLastnameUser());

              $error = $result->errorInfo();
              $rows_n = $result->rowCount();

              if($error[0] == 00000 && $rows_n > 0){
                  header("Location: ".$this->root."?controller=Panel&action=usersDt&error_flag=1");
              }
              elseif($error[0] == 00000 && $rows_n < 1){
                  header("Location: ".$this->root."?controller=Panel&action=usersDt&error_flag=10&message='Ha ocurrido un error grave'");
              }
              else{
                  header("Location: ".$this->root."?controller=Panel&action=usersDt&error_flag=10&message='Ha ocurrido un error: ".$error[2]."'");
              }
          }

          else {
              header("Location: ".$this->root."?controller=Panel&action=newUserForm&error_flag=10&user_id=".$id_user."&message='Error de validación: ".$validacion['error']."'");
          }
        else:
          header("Location: ".$this->root."?controller=Panel&action=newUserForm&error_flag=10&user_id=".$id_user."&message='Contraseña debe repetirse correctamente'");
        endif;



    }

    public function ajaxUsersDt()
    {
        $session = FR_Session::singleton();

        //Incluye el modelo que corresponde
        require_once 'models/UsersModel.php';

        //Creamos una instancia de nuestro "modelo"
        $model = new UsersModel();

        /*
        * Build up dynamic query
        */
        $sTable = $model->getTableName();

        $aColumns = array('u.id_user'
                    , 'u.code_user'
                    , 'u.id_tenant'
                    , 'u.nombres'
                    , 'u.apellidos'
                    , 'u.name_user'
                    , 'p.label_profile'
                    , 'u.id_status');

        $sIndexColumn = "id_user";

        /******************** Paging */
        if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
            $sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];

        /******************** Ordering */
        $sOrder = "";
        if ( isset( $_GET['iSortCol_0'] ) )
        {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
            {
                    if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                    {
                            $sOrder .= "".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]." ".
                                    $_GET['sSortDir_'.$i].", ";
                    }
            }

            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                    $sOrder = "";
            }
        }

        /******************** Filtering */
        $sWhere = "";

        if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= "".$aColumns[$i]." LIKE '%".$_GET['sSearch']."%' OR ";
            }

            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

        /********************* Individual column filtering */
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
            {
                if ( $sWhere == "" )
                {
                    $sWhere = "WHERE ";
                }
                else
                {
                    $sWhere .= " AND ";
                }

                $sWhere .= "".$aColumns[$i]." LIKE '%".$_GET['sSearch_'.$i]."%' ";
            }
        }

        /******************** Custom Filtering */
//        if( isset($_GET['filResponsable']) && $_GET['filResponsable'] != "")
//        {
//            if ( $sWhere == "" )
//            {
//                    $sWhere = "WHERE ";
//            }
//            else
//            {
//                    $sWhere .= " AND ";
//            }
//
//            $sWhere .= " A.TIPO LIKE '%".mysql_real_escape_string($_GET['filTipo'])."%' ";
//        }

        /********************** Create Query */
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS
                ".str_replace(" , ", " ", implode(", ", $aColumns))."
            FROM $sTable u
            INNER JOIN cas_profile p ON ( u.id_profile = p.id_profile )
            INNER JOIN cas_tenant b
            ON (u.id_tenant = b.id_tenant
                AND
                b.id_tenant = $session->id_tenant)
            $sWhere
            $sOrder
            $sLimit";

        $result_data = $model->goCustomQuery($sql);

        $found_rows = $model->goCustomQuery("SELECT FOUND_ROWS()");

        $total_rows = $model->goCustomQuery("SELECT COUNT(`".$sIndexColumn."`) FROM $sTable");

        /*
        * Output
        */
        $iTotal = $total_rows->fetch(PDO::FETCH_NUM);
        $iTotal = $iTotal[0];

        $iFilteredTotal = $found_rows->fetch(PDO::FETCH_NUM);
        $iFilteredTotal = $iFilteredTotal[0];

        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        $k = 1;
        while($aRow = $result_data->fetch(PDO::FETCH_NUM))
        {
            $row = array();

            for ($i=0;$i<count($aColumns);$i++)
            {
                //$row[] = utf8_encode($aRow[ $i ]);
                $row[] = $aRow[$i];
            }

            $output['aaData'][] = $row;

            $k++;
        }

        echo json_encode( $output );
    }

    public function editUserForm()
    {
        require_once 'models/UsersModel.php';
        require_once 'models/ProfilesModel.php';
        require_once 'vo/UserVO.php';

        $error_flag = '';
        $message = '';

        #support global messages
        if(isset($_GET['error_flag']))
            $error_flag = $_GET['error_flag'];
        if(isset($_GET['message']))
            $message = $_GET['message'];

        $user = new UserVO();
        //Asegurar que session esta abierta
        $session = FR_Session::singleton();
        $id = filter_input(INPUT_GET, 'user_id');
        $user_model = new UsersModel();
        $profile_model = new ProfilesModel();
        $user->setIdUser($id);
        $pdoProfiles = $profile_model->getAllProfiles();
        $pdoUser = $user_model->getUserById($user);

        $data['title'] = "Editar Usuario";
        $data['estados'] = array(0,1);
        $data['profiles'] = $pdoProfiles;
        $data['user'] = $pdoUser;
        $data['message'] = $message;

        $data['error_flag'] = $this->errorMessage->getError($error_flag,$message);

        $this->view->show("users_edit.php", $data);
    }

    public function editUserFormSession()
    {
        require_once 'models/UsersModel.php';
        require_once 'models/ProfilesModel.php';
        require_once 'vo/UserVO.php';

        #support global messages
        if(isset($_GET['error_flag']))
            $error_flag = $_GET['error_flag'];
        if(isset($_GET['message']))
            $message = $_GET['message'];

        $user = new UserVO();
        //Asegurar que session esta abierta
        $session = FR_Session::singleton();

        $user_model = new UsersModel();
        $profile_model = new ProfilesModel();
        $user->setIdUser($session->id_user);
        $pdoProfiles = $profile_model->getAllProfiles();
        $pdoUser = $user_model->getUserById($user);

        $data['title'] = "Editar Usuario";
        $data['profiles'] = $pdoProfiles;
        $data['user'] = $pdoUser;
        $data['message'] = $message;

        $data['error_flag'] = $this->errorMessage->getError($error_flag,$message);

        $this->view->show("users_edit.php", $data);
    }

    public function userEdit()
    {
        //Incluye el modelo que corresponde
        require_once 'models/UsersModel.php';
        require_once 'vo/UserVO.php';

        $session = FR_Session::singleton();
        $model = new UsersModel();
        $user = new UserVO();
        $id_user = filter_input(INPUT_POST, 'id_user');
        $user->setIdUser($id_user);
        $pdoUser = $model->getUserById($user);
        $dataUser = $pdoUser->fetch(PDO::FETCH_ASSOC);
        $user->setCodeUser($dataUser['code_user']);
        $user->setIdTenant($dataUser['id_tenant']);
        $user->setIdStatus($dataUser['id_status']);
        $user->setNameUser(filter_input(INPUT_POST, 'name_user'));
        $user->setIdProfile(filter_input(INPUT_POST, 'cboprofiles'));

        // Check pass change for non admin
        if(empty($user->getIdProfile())){
          $user->setIdProfile($dataUser['id_profile']);
        }

        $user->setFullnameUser(filter_input(INPUT_POST, 'fullname_user'));
        $user->setLastnameUser(filter_input(INPUT_POST, 'lastname_user'));

        if(filter_input(INPUT_POST, 'chk_status')){
          $user->setIdStatus("1");
        }
        else{
          $user->setIdStatus("0");
        }

        $user->setPasswordUser('');
        //$pass1 = filter_input(INPUT_TYPE, 'pass_user_1');
        //$pass2 = filter_input(INPUT_TYPE, 'pass_user_2');
        $pass1 = $_POST['pass_user_1'];
        $pass2 = $_POST['pass_user_2'];

        /*  Obtiene nombre de usuario original para comparar al momento de validar si nombre de
           usuario existe o no */
        $original_name_user = filter_input(INPUT_POST, 'original_name_user');

        // Ensure action controller for non admins
        $controller = 'panel';
        $action = 'usersDt';

        if($user->getIdProfile() > 1){
          $controller = 'tasks';
          $action = 'tasksDt';
        }

        if($original_name_user != $user->getNameUser())
        {
            $result_val= $model->getBoolUsername($user);
            $boolean_name_user = $result_val->fetch(PDO::FETCH_ASSOC);
            $boolean_name_user_result = $boolean_name_user['result'];
        }
        else
        {
            $boolean_name_user_result = 'false';
        }

        // Contraseña intervenida (se debe validar)
        if($pass1 !='' && $pass2 !='')
        {
            if($pass1 == $pass2)
            {
                $user->setPasswordUser($pass1);
                $validacion = $this->validarDatosUsuario($user, 'normal', $boolean_name_user_result);
            }
            else
            {
                $user->setPasswordUser('');
                $validacion = $this->validarDatosUsuario($user, 'distintos', $boolean_name_user_result);
            }
        }
        // Contraseñas en blanco (ignorar)
        else if ($pass1 == '' && $pass2 == '')
        {
            $user->setPasswordUser($dataUser['password_user']);
            $validacion = $this->validarDatosUsuario($user, 'md5', $boolean_name_user_result, FALSE);
        }

        if($validacion["estado"] == true )
        {
            if($pass1 == $user->getPasswordUser()){
                $user->setPasswordUser(md5($user->getPasswordUser()));
            }
            else {
                $user->setPasswordUser($dataUser['password_user']);
            }

            $result = $model->editUser($user);
            $error = $result->errorInfo();
            $rows_n = $result->rowCount();

            if($error[0] == 00000){
                #$this->projectsDt(1);
                header("Location: ".$this->root."?controller=".$controller."&action=".$action."&error_flag=1");
            }
            else{
                #$this->projectsDt(10, "Ha ocurrido un error: ".$error[2]);
                header("Location: ".$this->root."?controller=".$controller."&action=".$action."&error_flag=10&message='Ha ocurrido un error: ".$error[2]." ___ ".$id_user."'");
            }
        }
        else {
            //$pdoUser = $model->getUserById($user);
            header("Location: ".$this->root."?controller=".$controller."&action=".$action."&error_flag=10&user_id=".$id_user."&message='Ha ocurrido un error: ".$validacion['error']."'");
        }

    }

    public function usersDt()
    {
        $session = FR_Session::singleton();

        $error_flag = '';
        $message = '';

        #support global messages
        if(isset($_GET['error_flag']))
            $error_flag = $_GET['error_flag'];
        if(isset($_GET['message']))
            $message = $_GET['message'];

        //Incluye el modelo que corresponde
        require_once 'models/UsersModel.php';
        require_once 'vo/UserVO.php';
        //Creamos una instancia de nuestro "modelo"
        $model = new UsersModel();
        $user = new UserVO();

        $user->setIdTenant($session->id_tenant);
        //Le pedimos al modelo todos los items
        $listado = $model->getAllUsers($user);

        //Pasamos a la vista toda la información que se desea representar
        $data['listado'] = $listado;

        // Obtener permisos de edición
//        require_once 'models/UsersModel.php';
//        $userModel = new UsersModel();

//        $permisos = $userModel->getUserModulePrivilegeByModule($session->id, 2);
//        if($row = $permisos->fetch(PDO::FETCH_ASSOC)){
//            $data['permiso_editar'] = $row['EDITAR'];
//        }

        //Titulo pagina
        $data['titulo'] = "Usuarios";

        //Controller
        $data['controller'] = "panel";
        $data['action'] = "editUserForm";

        //Posible error
        $data['error_flag'] = $this->errorMessage->getError($error_flag,$message);

        //Finalmente presentamos nuestra plantilla
        $this->view->show("users_dt.php", $data);
    }

    public function removeUserAction()
    {

    }

    public function validarDatosUsuario(UserVO $user, $tipoPass, $boolean_name_user, $withpass = true)
    {

        $mensaje['estado'] = true;
        $mensaje['largoNombre'] = strlen($user->getNameUser());
        $mensaje['largoPass'] = strlen($user->getPasswordUser());

        //echo "user: ".$user->getNameUser();
        //exit();
        // si $tipoPass es normal, el password no es md5
        // si $tipoPass es md5, el pass tiene formato md5

        if(strlen($user->getNameUser()) < 5 )
        {
            $mensaje['error'] = "El nombre de usuario debe tener más de 4 letras";
            $mensaje['estado'] = false;
        }

        else
        {
            if ($boolean_name_user != 'false')
            {
                $mensaje['error'] = "El nombre de usuario ya existe, debe ingresar un nombre nuevo.";
                $mensaje['estado'] = false;
            }
        }

        // Revisar si considera o no revisión de contraseña
        if($withpass){
          if($tipoPass == 'normal')
          {
              if(strlen($user->getPasswordUser()) < 5 )
              {
                  $mensaje['error'] = "La contraseña  debe tener más de 4 letras";
                  $mensaje['estado'] = false;
              }
          }
          else if($tipoPass == 'distintos')
          {
              $mensaje['error'] = "Los Campos de la contraseña deben ser iguales";
              $mensaje['estado'] = false;
          }

          else if($tipoPass == 'md5')
          {
              $mensaje['error'] = "Los Campos de la contraseña no pueden quedar vacios";
              $mensaje['estado'] = false;
          }
        }

        return $mensaje;
    }

    public function dashboard(){
      $session = FR_Session::singleton();

      require_once 'models/TasksModel.php';
      require_once 'models/UsersModel.php';
      require_once 'models/CustomersModel.php';
      require_once 'models/PanelModel.php';
      require_once 'models/TypesModel.php';
      $tasks = new TasksModel();
      $users = new UsersModel();
      $customers = new CustomersModel();
      $panel = new PanelModel();
      $types = new TypesModel();

      $listado = $tasks->getAllTasksByTenant($session->id_tenant);
      $usuarios = $users->getAllUserAccountByTenant($session->id_tenant);
      $clientes = $customers->getAllCustomers($session->id_tenant);
      $usuMaterias = $types->getTypesByAllUsers($session->id_tenant);

      $usuariosTareas = $users->goCustomQuery('select
        	a.id_user
          , a.id_user
          , a.name_user
          , a.nombres
          , a.apellidos
          , a.id_profile
          , a.genero
          , pro.label_profile
          , b.id_task
          , b.label_task
          , DATE_FORMAT(b.date_end, "%d/%m/%Y") date_end
          , b.cas_customer_id_customer
          , cus.label_customer
          , b.id_type
          , c.label_type
          , a.id_status
        from cas_user a
        left outer join cas_task b
        on (
          a.id_user = b.id_user
          AND
          a.id_tenant = b.id_tenant
        )
        left outer join cas_type c
        on (
          b.id_type = c.id_type
          AND
          b.id_tenant = c.id_tenant
        )
        left outer join cas_customer cus
        on (
            b.cas_customer_id_customer = cus.id_customer
            AND
            b.id_tenant = cus.id_tenant
        )
        left outer join cas_profile pro
        on (
            a.id_profile = pro.id_profile
            AND
            a.id_tenant = pro.id_tenant
        )
        where a.id_tenant = 1;');

      $data['titulo'] = "Tablero";
      $data['controller'] = "panel";
      $data['action'] = "dashboard";
      $data['listado'] = $listado;
      $data['usuarios'] = $usuarios;
      $data['clientes'] = $clientes;
      $data['usuariosTareas'] = $usuariosTareas;
      $data['usuMaterias'] = $usuMaterias;

      $this->view->show("admin_dashboard.php", $data);
    }

    public function ajaxDashboardTableX()
    {
        $session = FR_Session::singleton();

        require_once 'models/PanelModel.php';
        $model = new PanelModel();

        $table = 'cas_user';

        $cols = array('a.id_user'
          , 'a.name_user'
          , 'a.id_profile'
          , 'a.genero'
          , 'pro.label_profile'
          , 'b.id_task'
          , 'b.label_task'
          , 'b.date_end'
          , 'b.cas_customer_id_customer'
          , 'cus.label_customer'
          , 'b.id_type'
          , 'c.label_type');

        $index = "id_user";


        /********************** Create Query */
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS
                ".str_replace(" , ", " ", implode(", ", $cols))."";

        $sqlMaterias = "select a.id_user, c.label_type";


        $sqlFrom = "
            FROM $table a
            left outer join cas_task b
            on (
              a.id_user = b.id_user
              AND
              a.id_tenant = b.id_tenant
            )
            left outer join cas_type c
            on (
              b.id_type = c.id_type
              AND
              b.id_tenant = c.id_tenant
            )
            left outer join cas_customer cus
            on (
                b.cas_customer_id_customer = cus.id_customer
                AND
                b.id_tenant = cus.id_tenant
            )
            left outer join cas_profile pro
            on (
                a.id_profile = pro.id_profile
                AND
                a.id_tenant = pro.id_tenant
            )
            where a.id_tenant = $session->id_tenant";

        // union
        $sql = $sql.$sqlFrom;

        $result_data_users = $model->goCustomQuery($sql);
        $result_data_types = $model->goCustomQuery($sql);

        $found_rows = $model->goCustomQuery("SELECT FOUND_ROWS()");
        $total_users = $model->goCustomQuery("SELECT COUNT(`".$index."`) FROM $table where id_tenant = $session->id_tenant");

        // total usuarios
        $iTotal = $total_users->fetch(PDO::FETCH_NUM);
        $iTotal = $iTotal[0];

        // total filas encontradas
        $iFilteredTotal = $found_rows->fetch(PDO::FETCH_NUM);
        $iFilteredTotal = $iFilteredTotal[0];

        // output full
        $output = array(
            "iTotalUsers" => $iTotal,
            "iTotalRecords" => $iFilteredTotal,
            "iData" => array()
        );

        // Obtener usuarios y ultima tarea
        $rUsuarios = $result_data_users->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_UNIQUE);
        $output['iData']['users'] = $rUsuarios;

        // while($aRow = $result_data_users->fetch(PDO::FETCH_NUM))
        // {
        //     $row = array();
        //
        //     for ($i=0;$i<count($cols);$i++)
        //     {
        //         $row[] = $aRow[$i];
        //     }
        //
        //     $output['data']['users'] = $row;
        // }

        echo json_encode( $output );
    }

    public function ajaxIndiTareasMat() {
      $session = FR_Session::singleton();

      require_once 'models/PanelModel.php';
      $model = new PanelModel();

      // Tareas detalle
      $sql = "
        select
          tas.id_tenant,
          tas.id_task,
          tas.label_task,
          tas.id_user,
          tas.id_type,
          typ.label_type,
          tas.date_end,
          tas.desc_task
        from cas_task tas
        inner join cas_type typ
        on (tas.id_type = typ.id_type
            and
            tas.id_tenant = typ.id_tenant)
        where tas.id_tenant = $session->id_tenant
      ";

      $r_tasks = $model->goCustomQuery($sql);

      // Materias
      $sql = "
        SELECT
          typ.id_type,
          typ.label_type
        FROM cas_type typ
        where typ.id_tenant = $session->id_tenant
      ";

      $r_types = $model->goCustomQuery($sql);

      // Tareas por materia
      $sql = "
        SELECT
          typ.label_type
          , count(tas.id_task) cant
        FROM cas_type typ
        inner join cas_task tas
        on (typ.id_type = tas.id_type
           and
           typ.id_tenant = tas.id_tenant)
        where typ.id_tenant = $session->id_tenant
        and typ.status_type = 1
        group by typ.label_type
      ";

      $r_tasksTypes = $model->goCustomQuery($sql);

      // Total tareas
      $r_totalTasks = $model->goCustomQuery("SELECT COUNT(id_task) FROM cas_task where status_task < 9 and id_tenant = $session->id_tenant");
      $total_tasks = $r_totalTasks->fetch(PDO::FETCH_NUM);
      $total_tasks = $total_tasks[0];

      // Total materias
      $r_totalTypes = $model->goCustomQuery("SELECT COUNT(id_type) FROM cas_type where status_type = 1 and id_tenant = $session->id_tenant");
      $total_types = $r_totalTypes->fetch(PDO::FETCH_NUM);
      $total_types = $total_types[0];

      // Generar JSON (Google chart)
      // $output = array(
      //     "iTotalTasks" => $total_tasks,
      //     "iTotalTypes" => $total_types,
      //     "iData" => array()
      // );

      $k = 0;
      $data = array();

      while($row = $r_tasksTypes->fetch(PDO::FETCH_ASSOC))
      {
        $data[] = $row;
        $k++;
      }

      $newData = array();
      $firstLine = true;

      foreach ($data as $dataRow)
      {
        if ($firstLine)
        {
          $newData[] = array_keys($dataRow);
          $firstLine = false;
        }

        $newData[] = array_values($dataRow);
      }

      $output = array(
        "cols" => array(
          0 => array (
            'label' => 'Topping',
            'type' => 'string',
          ),
          1 => array (
            'label' => 'Slices',
            'type' => 'number',
          )
        ),
        "rows" => $newData
      );

      echo json_encode($newData, JSON_NUMERIC_CHECK);
    }

    public function ajaxDashboardUsers(){
      $session = FR_Session::singleton();

      require_once 'models/PanelModel.php';
      $model = new PanelModel();

      // Usuario, perfil y ultimo trabajo
      $sql = "
        SELECT
          user.nombres usuario
          , user.name_user
          , prof.label_profile
          , (select xtask.label_task
              from cas_task xtask
              where xtask.id_user = user.id_user
              and xtask.id_tenant = user.id_tenant
              order by date_ini desc
              limit 1
          ) last_label_task
        FROM cas_user user
        inner join cas_profile prof
        on user.id_profile = prof.id_profile
        where user.id_tenant = $session->id_tenant
      ";

      $r_profile = $model->goCustomQuery($sql);

      // Materias por usuario
      $sql = "
        SELECT
          distinct
          task.id_user
          , typ.label_type
        FROM cas_task task
        inner join cas_type typ
        on (task.id_type = typ.id_type
            and
            task.id_tenant = typ.id_tenant)
        where task.id_tenant = $session->id_tenant
      ";

      $r_types = $model->goCustomQuery($sql);

      // Total de tareas por usuario
      $sql = "
        SELECT
          task.id_user
          , count(task.id_task)
        FROM cas_task task
        where task.id_tenant = $session->id_tenant
        group by task.id_user
      ";

      $r_numTasks = $model->goCustomQuery($sql);


      $data = array();

      while($row = $r_profile->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
      }

      print_r($data);
      die();

      // $data_types = array();

      $data_types = $r_types->fetchAll(PDO::FETCH_GROUP);

      // while ($row = $r_types->fetch(PDO::FETCH_GROUP | PDO::FETCH_UNIQUE)) {
      //   $data_types[] = $row;
      // }

      // print_r($data_types);
      // die();

      foreach ($data as $key => $value) {

        echo $key;

        // foreach ($data_types as $id => $type) {
        //   echo $value[0];
        // }
      }

      die();

      $k = 0;
      $data = array();

      while($row = $r_tasksUsers->fetch(PDO::FETCH_ASSOC))
      {
        $data[] = $row;
        $k++;
      }

      $newData = array();
      $firstLine = true;

      foreach ($data as $dataRow)
      {
        if ($firstLine)
        {
          $newData[] = array_keys($dataRow);
          $firstLine = false;
        }

        $newData[] = array_values($dataRow);
      }

      echo json_encode($newData, JSON_NUMERIC_CHECK);
    }

    public function ajaxIndiGestionesUsu(){
      $session = FR_Session::singleton();

      require_once 'models/PanelModel.php';
      $model = new PanelModel();

      // Tareas por materia
      $sql = "
        SELECT
          user.nombres usuario
          , count(tas.id_task) cant
        FROM cas_user user
        inner join cas_task tas
        on (user.id_user = tas.id_user
           and
           user.id_tenant = tas.id_tenant)
        where user.id_tenant = $session->id_tenant
        group by user.nombres
      ";

      $r_tasksUsers = $model->goCustomQuery($sql);

      // Generar JSON
      $k = 0;
      $data = array();

      while($row = $r_tasksUsers->fetch(PDO::FETCH_ASSOC))
      {
        $data[] = $row;
        $k++;
      }

      $newData = array();
      $firstLine = true;

      foreach ($data as $dataRow)
      {
        if ($firstLine)
        {
          $newData[] = array_keys($dataRow);
          $firstLine = false;
        }

        $newData[] = array_values($dataRow);
      }

      echo json_encode($newData, JSON_NUMERIC_CHECK);
    }


    public function ajaxIndiGestionesAnio(){
      $session = FR_Session::singleton();

      require_once 'models/PanelModel.php';
      $model = new PanelModel();

      // Tareas por materia
      $sql = "
        SELECT
          user.nombres usuario
          , count(tas.id_task) cant
        FROM cas_user user
        inner join cas_task tas
        on (user.id_user = tas.id_user
           and
           user.id_tenant = tas.id_tenant)
        where user.id_tenant = $session->id_tenant
        group by user.nombres
      ";

      $r_tasksUsers = $model->goCustomQuery($sql);

      // Generar JSON
      $k = 0;
      $data = array();

      while($row = $r_tasksUsers->fetch(PDO::FETCH_ASSOC))
      {
        $data[] = $row;
        $k++;
      }

      $newData = array();
      $firstLine = true;

      foreach ($data as $dataRow)
      {
        if ($firstLine)
        {
          $newData[] = array_keys($dataRow);
          $firstLine = false;
        }

        $newData[] = array_values($dataRow);
      }

      echo json_encode($newData, JSON_NUMERIC_CHECK);
    }
}

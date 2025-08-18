<?php
namespace App\Libs;

use App\Libs\ModelBase;

/**
 * System Menu
 */
class Menu extends ModelBase
{
        /**
         * Clase CSS para item de menu abierto (current page)
         * @var String
         */
        private $current_class = 'class="current"';

        function getCurrentClass($controller, $target, $option = ""){
            if($controller == $target)
                return $this->current_class;
            elseif($controller == $option)
                return $this->current_class;
            else
                return "control: ".$controller.", tar: ".$target.", opt: ".$option;
        }

        function getUserAccesByPrivi($privi)
        {
            $consulta = $this->db->prepare("SELECT
                        A.COD_PRIVILEGIO
                        , A.VER
                        , A.ESCRIBIR
                        , A.EDITAR
                        , B.NAME_MODULO
                        FROM t_privilegios_permisos as A
                        INNER JOIN t_modulos as B
                        ON A.COD_MODULO = B.COD_MODULO
                        INNER JOIN t_privilegios_modulos as C
                        ON (A.COD_PRIVILEGIO = C.COD_PRIVILEGIO
                            AND A.COD_MODULO = C.COD_MODULO)
                        WHERE A.COD_PRIVILEGIO=$privi
                          AND A.VER = 1
                        ORDER BY C.ORDER asc");
            $consulta->execute();

            $result = $consulta->rowCount();

            if($result > 0)
                return $consulta;
            else
                return null;
        }

	public function loadMenu($userSession,$nav,$root,$controller)
	{
            error_log("loadMenu method called...");

            #$privi = $userSession->privilegio;
            #$access = $this->getUserAccesByPrivi($privi);

            if($access != null)
            {
                $menuFullString = '';

                if($nav == 'MSIE 6.0')
                    $menuFullString.= '<ul id="navmenu-h">';
                else
                    $menuFullString.= '<ul id="menu">';

                while($accessModule = $access->fetch(PDO::FETCH_ASSOC))
                {
                    #$permission = $this->getPriviPermission($privi, $accessModule['COD_MODULO']);
                    $menuFullString.= call_user_func_array(array($this, $accessModule['NAME_MODULO']), array($root, $accessModule['ESCRIBIR'], $controller));
                }

                $menuFullString.= '</ul>';

                #Print out menu
                print $menuFullString;
            }
            else
            {
                $menuFullString = '';
                if($nav == 'MSIE 6.0')
                    $menuFullString.= '<ul id="navmenu-h">';
                else
                    $menuFullString.= '<ul id="menu">';
                $menuFullString.= '<li>-- empty! --</li>';
                $menuFullString.= '</ul>';
            }
        }

        // Menú activo 2024
        function loadMainMenu($session)
        {
            if($session->id_profile == 1)
            {
                $this->loadMainMenuAdmin();
            }
            else if($session->id_profile == 2)
            {
                $this->loadMainMenuGeneric();
            }
            else if($session->id_profile == 3)
            {
                $this->loadMainMenuMantencion();
            }
        }

        function loadDynamicMenu(){
          $menuString = '<ul class="dropdown menu" data-dropdown-menu>';



          $menuString = '</ul>';
        }

        function loadMainMenuAdmin()
        {
            $menuFullString = '<ul id="submenu" class="dropdown menu hidden" data-dropdown-menu>';

            $menuFullString.= '<li>';
            $menuFullString.= '<a href="?controller=panel&amp;action=dashboard">Tablero</a>';
            $menuFullString.= '</li>';

            $menuFullString.= '<li>';
            $menuFullString.= '<a href="?controller=tasks&amp;action=tasksDt">Gestiones</a>';
            $menuFullString.= '<ul class="menu vertical">';
            $menuFullString.= '<li><a href="?controller=tasks&amp;action=tasksNewForm">Nueva Gestión</a></li>';
            $menuFullString.= '<li><a href="?controller=admtypes&amp;action=typesDt">Administracion de Gestiones</a></li>';
            $menuFullString.= '</ul>';
            $menuFullString.= '</li>';

            $menuFullString.= '<li>';
            $menuFullString.= '<a href="?controller=customers&amp;action=customersDt">Clientes</a>';
            $menuFullString.= '<ul class="menu vertical">';
            $menuFullString.= '<li><a href="?controller=customers&amp;action=customersAddForm">Nuevo Cliente</a></li>';
            $menuFullString.= '</ul>';
            $menuFullString.= '</li>';

            $menuFullString.= '<li>';
            $menuFullString.= '<a href="?controller=panel&amp;action=usersDt">Usuarios</a>';
            $menuFullString.= '<ul class="menu vertical">';
            $menuFullString.= '<li><a href="?controller=panel&amp;action=newUserForm">Nuevo Usuario</a></li>';
            $menuFullString.= '</ul>';
            $menuFullString.= '</li>';

            #$menuFullString.= '<li><a href="?controller=managements&amp;action=managementsDt">Gestiones</a></li>';

            $menuFullString.= '<li><a href="?controller=types&amp;action=typesDt">Materias</a></li>';

            $menuFullString.= '</ul>';

            print $menuFullString;
        }

        function loadMainMenuMantencion()
        {
            $menuFullString = '<ul id="submenu" class="dropdown menu hidden" data-dropdown-menu>';

            $menuFullString.= '<li>';
            $menuFullString.= '<a href="?controller=panel&amp;action=dashboard">Tablero</a>';
            $menuFullString.= '</li>';

            $menuFullString.= '<li>';
            $menuFullString.= '<a href="?controller=tasks&amp;action=tasksDt">Gestiones</a>';
            $menuFullString.= '<ul class="menu vertical">';
            $menuFullString.= '<li><a href="?controller=tasks&amp;action=tasksNewForm">Nueva Gestión</a></li>';
            $menuFullString.= '</ul>';
            $menuFullString.= '</li>';

            $menuFullString.= '<li>';
            $menuFullString.= '<a href="?controller=customers&amp;action=customersDt">Clientes</a>';
            $menuFullString.= '<ul class="menu vertical">';
            $menuFullString.= '<li><a href="?controller=customers&amp;action=customersAddForm">Nuevo Cliente</a></li>';
            $menuFullString.= '</ul>';
            $menuFullString.= '</li>';

            $menuFullString.= '<li>';
            $menuFullString.= '<a href="?controller=panel&amp;action=usersDt">Usuarios</a>';
            $menuFullString.= '</li>';

            $menuFullString.= '<li><a href="?controller=types&amp;action=typesDt">Materias</a></li>';

            $menuFullString.= '</ul>';

            print $menuFullString;
        }

        function loadMainMenuGeneric()
        {
          $menuFullString = '<ul id="submenu" class="dropdown menu hidden" data-dropdown-menu>';
          $menuFullString.= '<li>';
          $menuFullString.= '<a href="?controller=tasks&amp;action=tasksDt">Gestiones</a>';
          $menuFullString.= '<ul class="menu vertical">';
          $menuFullString.= '<li><a href="?controller=tasks&amp;action=tasksNewForm">Nueva Gestión</a></li>';
          $menuFullString.= '</ul>';
          $menuFullString.= '</li>';

          $menuFullString.= '<li>';
          $menuFullString.= '<a href="?controller=customers&amp;action=customersDt">Clientes</a>';
          $menuFullString.= '</li>';

          $menuFullString.= '<li><a href="?controller=types&amp;action=typesDt">Materias</a></li>';

          $menuFullString.= '</ul>';

          print $menuFullString;
        }

        function loadTestMenu()
        {
            $menuFullString = '<ul id="menu">';
                $menuFullString.= '<li><a class="menu_sup" href="?controller=tasks&amp;action=tasksDt">Gestiones</a>';
                $menuFullString.= '</li>';
                $menuFullString.= '<li><a class="menu_sup" href="?controller=tasks&amp;action=tasksNewForm">NUEVO Gestión</a>';
                $menuFullString.= '</li>';
                $menuFullString.= '<li><a class="menu_sup" href="?controller=customers&amp;action=customersDt">CLIENTES</a>';
                $menuFullString.= '</li>';
                $menuFullString.= '<li><a class="menu_sup" href="?controller=customers&amp;action=customersAddForm">NUEVO CLIENTE</a>';
                $menuFullString.= '</li>';
            $menuFullString.= '</ul>';

            print $menuFullString;
        }

        function mimenu($root, $permiso, $controller)
      	{
                  $code = '<li '. $this->getCurrentClass($controller, "admin", "users").'><a href="#">Menu</a>';
                      $code.= '<ul>';
                      $code.= $this->administracion($root);
                      $code.= '<li><a href="'.$root.'?controller=users&amp;action=userProfile">Mi Cuenta</a></li>';
                      $code.= '</ul>';
                  $code.= '</li>';

                  return $code;
      	}

      	function mimenuuser($root, $permiso, $controller)
      	{
                  $code = '<li '. $this->getCurrentClass($controller, "admin", "users").'><a href="#">Menu</a>';
                  $code.= '<ul>';
                  $code.= '<li><a href="'.$root.'?controller=users&amp;action=userProfile">Mi Cuenta</a></li>';
                  $code.= '</ul>';
                  $code.= '</li>';
                  return $code;
      	}

        function loadAccountMenu($session)
        {
            if($session->id_profile == 1)
            {
                $this->miMenuAdmin($session);
            }

            else if($session->id_profile == 2 || $session->id_profile == 3)
            {
                $this->miMenuGeneric($session);
            }
        }

        function miMenuAdmin($session)
        {
          $menuUser = '<ul id="submenu" class="dropdown menu hidden" data-dropdown-menu>';
          $menuUser .= '<li>';
          $menuUser .= '<a href="?controller=Panel&amp;action=editUserForm&user_id='. $session->id_user .'">';
          $menuUser .= '<span class="fi-torso-business"></span>';
          $menuUser .=  $session->fullname_user.' '.$session->lastname_user;
          $menuUser .= '</a>';
          #$menuUser .= '<ul class="menu vertical"><li><a href="?controller=tenant&amp;action=tenantInfoForm">';
          #$menuUser .= '<span class="fi-shopping-bag"></span>Cuenta Empresa</a></li></ul></li>';
          $menuUser .= '<li><a href="?controller=users&amp;action=logOut"><span class="fi-power"></span></a></li>';
          print $menuUser;
        }

        function miMenuGeneric($session)
        {
          $menuUser = '<ul id="submenu" class="dropdown menu hidden" data-dropdown-menu>';
          $menuUser .= '<li>';
          $menuUser .= '<a href="?controller=Panel&amp;action=editUserForm&user_id='. $session->id_user .'">';
          $menuUser .= '<span class="fi-torso-business"></span>';
          $menuUser .=  $session->fullname_user.' '.$session->lastname_user;
          $menuUser .= '</a>';
          $menuUser .= '<li><a href="?controller=users&amp;action=logOut"><span class="fi-power"></span></a></li>';
          print $menuUser;
        }
}

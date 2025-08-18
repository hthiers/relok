<?php
namespace App\Models;

use App\Libs\ModelBase;
use App\VO\UserVO;
use PDO;

class UsersModel extends ModelBase
{
        public function getAllUserAccountByTenant($id_tenant)
	{
		//realizamos la consulta de todos los segmentos
		$consulta = $this->db->prepare("SELECT
                                id_user
                                , code_user
                                , id_tenant
                                , name_user
                                , id_profile
                            FROM cas_user
                            WHERE id_tenant = '$id_tenant'");

		$consulta->execute();

		//devolvemos la coleccion para que la vista la presente.
		return $consulta;
	}

	public function getUserAccount($username, $password)
	{
		//realizamos la consulta de todos los segmentos
		$consulta = $this->db->prepare("SELECT
                                id_user
                                , code_user
                                , id_tenant
                                , name_user
                                , id_profile
                                , nombres
                                , apellidos
                            FROM cas_user
                            WHERE name_user='$username'
                              AND password_user='$password'");

		$consulta->execute();

		//devolvemos la coleccion para que la vista la presente.
		return $consulta;
	}

        public function getUserAccountByID($id_user)
	{
		//realizamos la consulta de todos los segmentos
		$consulta = $this->db->prepare("SELECT
                                 id_user
                                , code_user
                                , id_tenant
                                , name_user
                                , id_profile
                            FROM cas_user WHERE id_user='$id_user'");
		$consulta->execute();

		//devolvemos la coleccion para que la vista la presente.
		return $consulta;
	}

        public function getUserAccountByCode($code_user)
	{
		//realizamos la consulta de todos los segmentos
		$consulta = $this->db->prepare("SELECT
                                 id_user
                                , code_user
                                , id_tenant
                                , name_user
                                , id_profile
                            FROM cas_user WHERE code_user='$code_user'");
		$consulta->execute();

		//devolvemos la coleccion para que la vista la presente.
		return $consulta;
	}

  //Nuevos métodos para contexto de user
  public function addNewUser($id_tenant,
                $code_user,
                $name_user,
                $id_profile,
                $password_user,
                $id_status,
                $nombres,
                $apellidos)
  {
      $name = empty($name_user) ? "NULL" : "$name_user";
      $password = md5($password_user);

      $consulta = $this->db->prepare("INSERT INTO cas_user "
              . "(id_tenant, code_user, name_user, id_user, "
              . "id_profile, password_user, id_status, nombres, apellidos) VALUES "
              . "($id_tenant, '$code_user', '$name', NULL, $id_profile, '$password', $id_status, '$nombres', '$apellidos');");

      $consulta->execute();

      return $consulta;
  }

  public function getLastCodeUser()
  {
      $consulta = $this->db->prepare("SELECT MAX( code_user ) 'code' FROM cas_user");
      $consulta->execute();
      return $consulta;
  }

  public function getUserById(UserVO $user)
  {
      $query = $this->db->prepare("SELECT id_user, code_user, id_tenant, name_user, "
              . "id_profile, password_user, id_status, nombres, apellidos "
              . "from cas_user where id_user =".$user->getIdUser());
      $query->execute();
      return $query;
  }

  public function editUser(UserVO $user)
  {
      $query = $this->db->prepare("UPDATE cas_user set code_user='".$user->getCodeUser()."', "
              . "id_tenant=".$user->getIdTenant().", name_user='".$user->getNameUser()."', "
              . "id_profile=".$user->getIdProfile().", password_user='".$user->getPasswordUser()."', "
              . "id_status=".$user->getIdStatus().", nombres='".$user->getFullnameUser()."', "
              . "apellidos='".$user->getLastnameUser()."' "
              . "where id_user=".$user->getIdUser());
      $query->execute();
      return $query;
  }

  public function getAllUsers(UserVO $user)
  {
      $query = $this->db->prepare("SELECT u.id_user, u.code_user, u.id_tenant, u.name_user, p.label_profile "
              . "from cas_user u inner join cas_profile p on u.id_profile = p.id_profile where u.id_tenant = ".$user->getIdTenant()." "
              . "order by u.name_user");

      $query->execute();
      return $query;
  }

  public function getBoolUsername(UserVO $user)
  {
      $query = $this->db->prepare("SELECT if(COUNT(*)>0,'true','false') AS result FROM cas_user "
              . "WHERE id_tenant= ".$user->getIdTenant()." AND name_user LIKE '".$user->getNameUser()."'");

      $query->execute();
      return $query;
  }

  public function removeUserAction()
  {

  }

  /**
   * Get PDO object from custom sql query
   * NOTA: Esta función impide tener un control de la consulta sql (depende desde donde se llame).
   * @param string $sql
   * @return PDO
   */
  public function goCustomQuery(string $sql): \PDOStatement
    {
        // Registra la consulta SQL en el log o muéstrala
        error_log("Executing SQL: " . $sql);
        // echo "Executing SQL: " . $sql;

        // Prepara la consulta sin usar atributos no apropiados para esta función
        $consulta = $this->db->prepare($sql);

        $consulta->execute();
        return $consulta;
    }

  /**
   * Get database table name linked to this model
   * NOTA: Solo por lógica modelo = tabla
   * @return string
   */
  public function getTableName()
  {
      $tableName = "cas_user";

      return $tableName;
  }
}
?>

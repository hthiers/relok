<?php
namespace App\Models;

use App\Libs\ModelBase;
use PDO;

class TasksModel extends ModelBase
{
    /*******************************************************************************
    * Tasks
    *******************************************************************************/

    /**
     * Get all tasks under a project by tenant
     * @param int $id_tenant
     * @param int $id_project
     * @return PDOStatement
     */
    public function getAllTasksByTenantProject(int $id_tenant, int $id_project): PDOStatement
    {
        $consulta = $this->db->prepare("
            SELECT
                a.id_task,
                b.cas_project_id_project,
                a.code_task,
                a.id_tenant,
                a.label_task,
                IFNULL(a.date_ini, 'n/a') as date_ini,
                IFNULL(a.date_end, 'n/a') as date_end,
                IFNULL(a.time_total, 'n/a') as time_total,
                IFNULL(a.desc_task, 'n/a') as desc_task,
                a.status_task,
                a.cas_customer_id_customer
            FROM cas_task a
            INNER JOIN cas_project_has_cas_task b ON a.id_task = b.cas_task_id_task
            WHERE a.id_tenant = :id_tenant
              AND b.cas_project_id_project = :id_project
            ORDER BY a.label_task
        ");

        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->bindParam(':id_project', $id_project, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta;
    }

    /**
     * Get all tasks by tenant
     * @param int $id_tenant
     * @return \PDOStatement
     */
    public function getAllTasksByTenant(int $id_tenant): \PDOStatement
    {
        $consulta = $this->db->prepare("
            SELECT
                a.id_task,
                a.code_task,
                a.id_tenant,
                a.label_task,
                a.date_ini,
                a.date_end,
                a.time_total,
                a.desc_task,
                a.status_task,
                b.id_project,
                b.label_project,
                c.id_customer,
                c.label_customer,
                c.customer_dni,
                e.id_user,
                e.name_user,
                f.cas_type_id_type,
                g.label_type
            FROM cas_task a
            LEFT OUTER JOIN cas_project b ON (a.cas_project_id_project = b.id_project AND a.id_tenant = b.id_tenant)
            LEFT OUTER JOIN cas_customer c ON (a.cas_customer_id_customer = c.id_customer AND a.id_tenant = b.id_tenant)
            LEFT OUTER JOIN cas_task_has_cas_user d ON a.id_task = d.cas_task_id_task
            LEFT OUTER JOIN cas_user e ON d.cas_user_id_user = e.id_user
            LEFT OUTER JOIN cas_task_has_cas_type f ON a.id_task = f.cas_task_id_task
            LEFT OUTER JOIN cas_type g ON f.cas_type_id_type = g.id_type
            WHERE a.id_tenant = :id_tenant
        ");

        $consulta->bindParam(':id_tenant', $id_tenant, \PDO::PARAM_INT);
        $consulta->execute();

        return $consulta;
    }


    /**
     * Get a task by ID
     * @param int $id_tenant
     * @param int $id_task
     * @return PDOStatement|null
     */
    public function getTaskById(int $id_tenant, int $id_task): \PDOStatement
    {
        $consulta = $this->db->prepare("
            SELECT
                a.id_task,
                a.code_task,
                a.id_tenant,
                a.label_task,
                a.date_ini,
                a.date_end,
                a.time_total,
                a.desc_task,
                a.status_task,
                a.cas_project_id_project,
                a.cas_customer_id_customer,
                c.id_user,
                c.name_user,
                a.date_pause,
                a.time_paused,
                d.cas_type_id_type,
                e.label_type,
                f.label_customer,
                man.id_management,
                man.label_management
            FROM cas_task a
            LEFT OUTER JOIN cas_task_has_cas_user b ON a.id_task = b.cas_task_id_task
            LEFT OUTER JOIN cas_user c ON b.cas_user_id_user = c.id_user
            LEFT OUTER JOIN cas_task_has_cas_type d ON a.id_task = d.cas_task_id_task
            LEFT OUTER JOIN cas_type e ON d.cas_type_id_type = e.id_type
            LEFT OUTER JOIN cas_customer f ON (a.cas_customer_id_customer = f.id_customer AND a.id_tenant = f.id_tenant)
            LEFT OUTER JOIN cas_management man ON (a.id_management = man.id_management AND a.id_tenant = man.id_tenant)
            WHERE a.id_tenant = :id_tenant AND a.id_task = :id_task
            ORDER BY a.label_task
            LIMIT 1
        ");

        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->bindParam(':id_task', $id_task, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->rowCount() > 0 ? $consulta : null;
    }

    /**
     * Get last existent task by tenant
     * @param int $id_tenant
     * @return PDOStatement
     */
    public function getLastTask(int $id_tenant): \PDOStatement
    {
        $consulta = $this->db->prepare("
            SELECT
                a.id_task,
                a.code_task,
                a.id_tenant,
                a.label_task,
                a.date_ini,
                a.date_end,
                a.time_total,
                a.desc_task,
                a.status_task,
                a.cas_project_id_project,
                a.cas_customer_id_customer
            FROM cas_task a
            INNER JOIN cas_tenant b ON a.id_tenant = b.id_tenant
            WHERE b.id_tenant = :id_tenant
            ORDER BY a.id_task DESC
            LIMIT 1
        ");

        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta;
    }

    /**
     * Get a task by its code and tenant
     * @param int $id_tenant
     * @param string $code_task
     * @return PDOStatement
     */
    public function getTaskByCode(int $id_tenant, string $code_task): PDOStatement
    {
        $consulta = $this->db->prepare("
            SELECT
                a.id_task,
                a.code_task,
                a.id_tenant,
                a.label_task,
                a.date_ini,
                a.date_end,
                a.time_total,
                a.desc_task,
                a.status_task,
                a.cas_project_id_project,
                a.cas_customer_id_customer
            FROM cas_task a
            INNER JOIN cas_tenant b ON a.id_tenant = b.id_tenant
            WHERE b.id_tenant = :id_tenant AND a.code_task = :code_task
            LIMIT 1
        ");

        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->bindParam(':code_task', $code_task, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta;
    }

    /**
     * Get a task ID by its code and tenant
     * @param int $id_tenant
     * @param string $code_task
     * @return PDOStatement
     */
    public function getTaskIDByCode(int $id_tenant, string $code_task): \PDOStatement
    {
        $consulta = $this->db->prepare("
            SELECT
                a.id_task
            FROM cas_task a
            INNER JOIN cas_tenant b ON a.id_tenant = b.id_tenant
            WHERE b.id_tenant = :id_tenant AND a.code_task = :code_task
            LIMIT 1
        ");

        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->bindParam(':code_task', $code_task, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta;
    }

    /**
     * Get a task ID value by its code and tenant
     * @param int $id_tenant
     * @param string $code_task
     * @return int|null
     */
    public function getPTaskIDByCodeINT(int $id_tenant, string $code_task): ?int
    {
        $consulta = $this->getTaskIDByCode($id_tenant, $code_task);
        $row = $consulta->fetch(PDO::FETCH_ASSOC);

        return $row ? (int)$row['id_task'] : null;
    }

    /**
     * Add new task
     * @param int $id_tenant
     * @param string $new_code
     * @param string $etiqueta
     * @param string $date_ini
     * @param string $hora_ini
     * @param string|null $date_end
     * @param string|null $time_total
     * @param string $descripcion
     * @param int|null $id_project
     * @param int|null $id_customer
     * @param int|null $id_management
     * @param int $id_user
     * @param int $id_type
     * @param int $estado
     * @return PDOStatement
     */
    public function addNewTask(
        int $id_tenant,
        string $new_code,
        string $etiqueta,
        string $date_ini,
        string $hora_ini,
        ?string $date_end,
        ?string $time_total,
        string $descripcion,
        ?int $id_project,
        ?int $id_customer,
        ?int $id_management,
        int $id_user,
        int $id_type,
        int $estado = 1
    ): \PDOStatement {
        $consulta = $this->db->prepare("
            INSERT INTO cas_task
                (id_task, code_task, id_tenant, label_task, date_ini, date_end, time_total, desc_task, status_task, cas_project_id_project, cas_customer_id_customer, id_management, id_user, id_type)
            VALUES
                (NULL, :new_code, :id_tenant, :etiqueta, :date_ini, :date_end, :time_total, :descripcion, :estado, :id_project, :id_customer, :id_management, :id_user, :id_type)
        ");
    
        // Enlazar todos los parámetros de forma segura
        $consulta->bindParam(':new_code', $new_code, PDO::PARAM_STR);
        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->bindParam(':etiqueta', $etiqueta, PDO::PARAM_STR);
        $consulta->bindParam(':date_ini', $date_ini, PDO::PARAM_STR);
        $consulta->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $consulta->bindParam(':estado', $estado, PDO::PARAM_INT);
        $consulta->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $consulta->bindParam(':id_type', $id_type, PDO::PARAM_INT);
    
        // Manejar valores NULL correctamente
        $consulta->bindValue(':date_end', $date_end, $date_end !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $consulta->bindValue(':time_total', $time_total, $time_total !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $consulta->bindValue(':id_project', $id_project, $id_project !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $consulta->bindValue(':id_customer', $id_customer, $id_customer !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $consulta->bindValue(':id_management', $id_management, $id_management !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);

        $consulta->execute();
    
        return $consulta;
    }
    

    /**
     * Add user to task (allows multiple users in one task)
     * @param int $id_task
     * @param int $id_user
     * @param int $id_tenant
     * @return PDOStatement
     */
    public function addUserToTask(int $id_task, int $id_user, int $id_tenant): \PDOStatement
    {
        $consulta = $this->db->prepare("
            INSERT IGNORE INTO cas_task_has_cas_user
                (cas_task_id_task, cas_user_id_user, id_tenant)
            VALUES
                (:id_task, :id_user, :id_tenant)
        ");

        $consulta->bindParam(':id_task', $id_task, PDO::PARAM_INT);
        $consulta->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta;
    }

    /**
     * Add a type to an existent task
     * @param int $id_task
     * @param int $id_type
     * @param int $id_tenant
     * @return PDOStatement
     */
    public function addTypeToTask(int $id_task, int $id_type, int $id_tenant): \PDOStatement
    {
        $consulta = $this->db->prepare("
            INSERT IGNORE INTO cas_task_has_cas_type
                (cas_task_id_task, cas_type_id_type, id_tenant)
            VALUES
                (:id_task, :id_type, :id_tenant)
        ");

        $consulta->bindParam(':id_task', $id_task, PDO::PARAM_INT);
        $consulta->bindParam(':id_type', $id_type, PDO::PARAM_INT);
        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta;
    }

    /**
     * Update existent task
     * @param int $id_tenant
     * @param int $id_task
     * @param string $label_task
     * @param string $date_ini
     * @param string|null $date_end
     * @param string|null $time_total
     * @param string $desc_task
     * @param string $status_task
     * @param int|null $id_customer
     * @param string|null $date_pause
     * @param string|null $time_paused
     * @param int|null $id_management
     * @param int $id_user
     * @param int $id_type
     * @return PDOStatement
     */
    public function updateTask(
        int $id_tenant,
        int $id_task,
        string $label_task,
        string $date_ini,
        ?string $date_end,
        ?string $time_total,
        string $desc_task,
        string $status_task,
        ?int $id_customer,
        ?string $date_pause,
        ?string $time_paused,
        ?int $id_management,
        int $id_user,
        int $id_type
    ): \PDOStatement {
        $date_end = $date_end ? "'$date_end'" : "NULL";
        $time_total = $time_total ? "'$time_total'" : "NULL";
        $date_pause = $date_pause ? "'$date_pause'" : "NULL";
        $time_paused = $time_paused ? "'$time_paused'" : "NULL";
        $id_customer = $id_customer ? "'$id_customer'" : "NULL";

        $consulta = $this->db->prepare("
            UPDATE cas_task
            SET
                label_task = :label_task,
                date_ini = :date_ini,
                date_end = $date_end,
                time_total = $time_total,
                desc_task = :desc_task,
                status_task = :status_task,
                date_pause = $date_pause,
                time_paused = $time_paused,
                cas_customer_id_customer = $id_customer,
                id_management = :id_management,
                id_user = :id_user,
                id_type = :id_type
            WHERE id_tenant = :id_tenant AND id_task = :id_task
        ");

        $consulta->bindParam(':label_task', $label_task, PDO::PARAM_STR);
        $consulta->bindParam(':date_ini', $date_ini, PDO::PARAM_STR);
        $consulta->bindParam(':desc_task', $desc_task, PDO::PARAM_STR);
        $consulta->bindParam(':status_task', $status_task, PDO::PARAM_STR);
        $consulta->bindParam(':id_management', $id_management, PDO::PARAM_INT);
        $consulta->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $consulta->bindParam(':id_type', $id_type, PDO::PARAM_INT);
        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->bindParam(':id_task', $id_task, PDO::PARAM_INT);

        $consulta->execute();

        return $consulta;
    }

    /**
     * Get all tasks by tenant
     * @param int $id_tenant
     * @return PDOStatement
     */
    public function getAllTasksNameByTenant(int $id_tenant): \PDOStatement
    {
        $consulta = $this->db->prepare("
            SELECT DISTINCT
                a.label_task
            FROM cas_task a
            WHERE a.id_tenant = :id_tenant
        ");

        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta;
    }

    /**
     * Get number of tasks by tenant
     * @param int $id_tenant
     * @return PDOStatement
     */
    public function getNumTasksByUsers(int $id_tenant): \PDOStatement
    {
        $consulta = $this->db->prepare("
            SELECT COUNT(a.id_task)
            FROM cas_task a
            WHERE a.id_tenant = :id_tenant
        ");

        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta;
    }

    /**
     * Get count of active tasks by user
     * @param int $id_tenant
     * @param int $id_user
     * @return PDOStatement
     */
    public function getCountActiveTaskByUser(int $id_tenant, int $id_user): \PDOStatement
    {
        $consulta = $this->db->prepare("
            SELECT COUNT(a.id_task) AS cantidad
            FROM cas_task AS a
            WHERE a.id_tenant = :id_tenant
              AND a.id_user = :id_user
              AND a.status_task IN (1, 3)
        ");

        $consulta->bindParam(':id_tenant', $id_tenant, PDO::PARAM_INT);
        $consulta->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta;
    }

    /**
     * Get PDO object from custom SQL query
     * @param string $sql
     * @return PDOStatement
     */
    public function goCustomQuery(string $sql): \PDOStatement
    {
        $consulta = $this->db->prepare($sql);
        $consulta->execute();

        return $consulta;
    }
}

<?php
/**
 * Repository: TaskRepository
 *
 * Este repositorio encapsula la lógica de acceso a datos para las tareas
 * (cas_task) y sus relaciones. Permite filtrar, paginar y ordenar
 * resultados de manera segura utilizando sentencias preparadas y listas
 * blancas de columnas. El resultado devuelto incluye el conjunto de
 * tareas solicitadas junto con el total de filas para soportar la
 * paginación en interfaces gráficas.
 */

class TaskRepository
{
    /** @var \PDO */
    private \PDO $pdo;

    /** @var string */
    private string $table = 'cas_task';

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Obtiene una lista de tareas para ser mostradas en un datagrid.
     *
     * Los filtros disponibles en el parámetro $criteria son:
     *  - search: texto a buscar en label_task o desc_task
     *  - status: estado de la tarea (int)
     *  - unit_id: id de la unidad a la que pertenece
     *  - project_id: id del proyecto
     *  - customer_id: id del cliente
     *  - type_id: id de la materia (cas_type)
     *  - user_id: id del usuario creador
     *  - year / month / day: fecha de inicio (date_ini)
     *  - tenant_id: id del tenant para restringir resultados
     *  - sort: clave de columna a ordenar (ver $sortable)
     *  - dir: dirección de orden ('asc' o 'desc')
     *  - page: página actual (desde 1)
     *  - pageSize: tamaño de página
     *
     * @param array $criteria
     * @return array ['items' => array, 'page' => int, 'page_size' => int, 'total' => int]
     */
    public function findForGrid(array $criteria): array
    {
        // Columnas permitidas para ordenar
        $sortable = [
            'id'          => 't.id_task',
            'code'        => 't.code_task',
            'label'       => 't.label_task',
            'status'      => 't.status_task',
            'start_date'  => 't.date_ini',
            'end_date'    => 't.date_end',
            'project'     => 'p.label_project',
            'customer'    => 'c.label_customer',
            'type'        => 'ty.label_type',
            'user'        => 'u.name_user',
            'unit'        => 'un.name',
            'time_total'  => 't.time_total',
        ];

        // Normalización de paginación
        $page     = isset($criteria['page']) && (int)$criteria['page'] > 0 ? (int)$criteria['page'] : 1;
        $pageSize = isset($criteria['pageSize']) && (int)$criteria['pageSize'] > 0 ? (int)$criteria['pageSize'] : 20;
        $pageSize = min($pageSize, 200); // proteger de cargas excesivas

        // Ordenamiento
        $sortKey = $criteria['sort'] ?? 'start_date';
        $sortCol = $sortable[$sortKey] ?? $sortable['start_date'];
        $dir     = strtolower($criteria['dir'] ?? 'desc');
        $dir     = in_array($dir, ['asc', 'desc'], true) ? $dir : 'desc';

        // Construcción del WHERE y bindings
        $where  = [];
        $params = [];

        if (!empty($criteria['tenant_id'])) {
            $where[] = 't.id_tenant = :tenant_id';
            $params[':tenant_id'] = (int)$criteria['tenant_id'];
        }
        if (!empty($criteria['search'])) {
            $where[] = '(t.label_task LIKE :search OR t.desc_task LIKE :search)';
            $params[':search'] = '%' . $criteria['search'] . '%';
        }
        if (isset($criteria['status']) && $criteria['status'] !== '') {
            $where[] = 't.status_task = :status';
            $params[':status'] = (int)$criteria['status'];
        }
        if (!empty($criteria['unit_id'])) {
            $where[] = 't.cas_unit_id = :unit_id';
            $params[':unit_id'] = (int)$criteria['unit_id'];
        }
        if (!empty($criteria['project_id'])) {
            $where[] = 't.cas_project_id_project = :project_id';
            $params[':project_id'] = (int)$criteria['project_id'];
        }
        if (!empty($criteria['customer_id'])) {
            $where[] = 't.cas_customer_id_customer = :customer_id';
            $params[':customer_id'] = (int)$criteria['customer_id'];
        }
        if (!empty($criteria['type_id'])) {
            $where[] = 't.id_type = :type_id';
            $params[':type_id'] = (int)$criteria['type_id'];
        }
        if (!empty($criteria['user_id'])) {
            $where[] = 't.id_user = :user_id';
            $params[':user_id'] = (int)$criteria['user_id'];
        }
        if (!empty($criteria['year'])) {
            $where[] = 'YEAR(t.date_ini) = :year';
            $params[':year'] = (int)$criteria['year'];
        }
        if (!empty($criteria['month'])) {
            $where[] = 'MONTH(t.date_ini) = :month';
            $params[':month'] = (int)$criteria['month'];
        }
        if (!empty($criteria['day'])) {
            $where[] = 'DAY(t.date_ini) = :day';
            $params[':day'] = (int)$criteria['day'];
        }

        $whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

        // Consulta principal con joins a project, customer, type, user y unit
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS
                   t.id_task     AS id,
                   t.code_task   AS code,
                   t.label_task  AS label,
                   t.date_ini    AS start_date,
                   t.date_end    AS end_date,
                   t.time_total  AS time_total,
                   t.status_task AS status,
                   p.label_project  AS project_name,
                   c.label_customer AS customer_name,
                   ty.label_type    AS type_name,
                   u.name_user      AS user_name,
                   un.name          AS unit_name
            FROM {$this->table} t
            LEFT JOIN cas_project p ON t.cas_project_id_project = p.id_project
            LEFT JOIN cas_customer c ON t.cas_customer_id_customer = c.id_customer
            LEFT JOIN cas_type ty ON t.id_type = ty.id_type
            LEFT JOIN cas_user u ON t.id_user = u.id_user
            LEFT JOIN cas_unit un ON t.cas_unit_id = un.id
            {$whereSql}
            ORDER BY {$sortCol} {$dir}
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $val) {
            $type = is_int($val) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
            $stmt->bindValue($key, $val, $type);
        }
        $limit  = $pageSize;
        $offset = ($page - 1) * $pageSize;
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        $items = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $total = (int)$this->pdo->query("SELECT FOUND_ROWS()")->fetchColumn();

        return [
            'items'     => $items,
            'page'      => $page,
            'page_size' => $pageSize,
            'total'     => $total,
        ];
    }
}

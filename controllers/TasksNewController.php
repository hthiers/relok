<?php
require_once __DIR__ . '/../models/TaskRepository.php';
require_once __DIR__ . '/../models/UnitRepository.php';

/**
 * Controlador para el listado de tareas.
 * Orquesta la carga de la vista y sirve los datos en formato JSON
 * consumidos por el datagrid.
 */
class TasksNewController
{
    /** @var \PDO */
    private \PDO $pdo;

    /** @var TaskRepository */
    private TaskRepository $taskRepo;

    /** @var UnitRepository */
    private UnitRepository $unitRepo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo     = $pdo;
        $this->taskRepo = new TaskRepository($pdo);
        $this->unitRepo = new UnitRepository($pdo);
    }

    /**
     * Renderiza la vista con la tabla vacía y filtros.
     * Aquí puedes cargar las listas de unidades y pasarlas a la vista.
     */
    public function index(): void
    {
        // Traer unidades activas para el selector; paginamos lo suficiente
        $unitsResult = $this->unitRepo->findAll(1, 1000);
        $units = $unitsResult['items'] ?? [];

        // Aquí puedes añadir más listados (clientes, proyectos, tipos, usuarios).
        // Incluye la plantilla de la vista correspondiente
        include __DIR__ . '/../views/tasks/index.php';
    }

    /**
     * Endpoint JSON que devuelve las tareas filtradas y paginadas.
     * Se espera que el frontend haga peticiones GET a esta URL con los
     * parámetros de filtrado, orden y paginación.
     */
    public function datagrid(): void
    {
        // Recoger y normalizar parámetros GET
        $criteria = [
            'search'      => $_GET['search']      ?? '',
            'status'      => $_GET['status']      ?? '',
            'unit_id'     => $_GET['unit_id']     ?? '',
            'project_id'  => $_GET['project_id']  ?? '',
            'customer_id' => $_GET['customer_id'] ?? '',
            'type_id'     => $_GET['type_id']     ?? '',
            'user_id'     => $_GET['user_id']     ?? '',
            'year'        => $_GET['year']        ?? '',
            'month'       => $_GET['month']       ?? '',
            'day'         => $_GET['day']         ?? '',
            'tenant_id'   => $_GET['tenant_id']   ?? '',
            'sort'        => $_GET['sort']        ?? 'start_date',
            'dir'         => $_GET['dir']         ?? 'desc',
            'page'        => $_GET['page']        ?? 1,
            'pageSize'    => $_GET['pageSize']    ?? 20,
        ];

        // Consultar el repositorio
        $result = $this->taskRepo->findForGrid($criteria);

        // Devolver JSON
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }
}

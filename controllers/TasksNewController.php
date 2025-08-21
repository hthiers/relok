<?php
namespace App\Controllers;

use App\Libs\ControllerBase;
use App\Libs\SPDO;
use App\Models\TaskRepository;
use App\Models\UnitRepository;

class TasksNewController extends ControllerBase
{
    private TaskRepository $taskRepo;
    private UnitRepository $unitRepo;

    public function __construct()
    {
        // inicializa las propiedades heredadas (view, utils, etc.)
        parent::__construct();

        // Obtén la conexión usando el singleton de SPDO
        $pdo = SPDO::singleton();

        // Instancia los repositorios con esa conexión
        $this->taskRepo = new TaskRepository($pdo);
        $this->unitRepo = new UnitRepository($pdo);
    }

    /**
     * Renderiza la vista con la tabla vacía y filtros.
     * Aquí puedes cargar las listas de unidades y pasarlas a la vista.
     */
    public function index(): void
    {
      $unitsResult = $this->unitRepo->findAll(1, 1000);
      $units = $unitsResult['items'] ?? [];

      $data = [
          'page_title'   => 'Tareas',
          'content_view' => 'tasksnew/table.php', // <-- partial que creaste
          'units'        => $units,
          // Si quieres cards de resumen en el layout:
          // 'summary_cards' => [
          //   ['label' => 'Abiertas',     'value' => 24],
          //   ['label' => 'En progreso',  'value' => 13],
          //   ['label' => 'Cerradas',     'value' => 8],
          //   ['label' => 'Tiempo (h)',   'value' => 120],
          // ],
      ];

      $this->view->show('layouts/cms.php', $data);
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

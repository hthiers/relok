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
          'pageTitle'   => 'Tareas',
          'contentPath' => 'tasksnew/table.php', // <-- partial que creaste
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

    public function test(): void
    {
        // Renderiza la vista usando el layout de testing.
        $unitsResult = $this->unitRepo->findAll(1, 1000);
        $units = $unitsResult['items'] ?? [];

        $data = [
            'pageTitle'   => 'Tareas - Testing',
            'contentPath' => 'tasksnew/table.php', // partial reutilizable
            'units'       => $units,
            // Puedes añadir flags o datos específicos para el layout de testing:
            // 'is_testing' => true,
        ];

        $this->view->show('layouts/testing.php', $data);
    }

    /**
     * Endpoint JSON que devuelve las tareas filtradas y paginadas.
     * Se espera que el frontend haga peticiones GET a esta URL con los
     * parámetros de filtrado, orden y paginación.
     */
    public function datagrid(): void
    {
        // Recoger y normalizar parámetros GET
        $params = $_GET;
        $data = $this->taskRepo->findForGrid($params);
        error_log("Parameters received in datagrid: " . json_encode($params));
        
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

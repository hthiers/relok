<?php
namespace App\Controllers;

use App\Libs\ControllerBase;
use App\Libs\SPDO;
use App\Models\TaskRepository;
use App\Models\UnitRepository;
use App\Models\CustomerRepository;
use App\Models\TypeRepository;
use App\Libs\FR_Session;

class TasksNewController extends ControllerBase
{
    private TaskRepository $taskRepo;
    private UnitRepository $unitRepo;
    private CustomerRepository $customerRepo;
    private TypeRepository $typeRepo;

    public function __construct()
    {
        // inicializa las propiedades heredadas (view, utils, etc.)
        parent::__construct();

        // Obtén la conexión usando el singleton de SPDO
        $pdo = SPDO::singleton();

        // Instancia los repositorios con esa conexión
        $this->taskRepo = new TaskRepository($pdo);
        $this->unitRepo = new UnitRepository($pdo);
        $this->customerRepo = new CustomerRepository($pdo);
        $this->typeRepo = new TypeRepository($pdo);
    }

    /**
     * Renderiza la vista con la tabla vacía y filtros.
     * Aquí puedes cargar las listas de unidades y pasarlas a la vista.
     */
    public function index(): void
    {
        $session = FR_Session::singleton();
        
        // Obtener la tarea activa actual (usando datos de sesión)
        $userId = $session->id_user ?? 1;
        $tenantId = $session->id_tenant ?? 1;
        $activeTask = $this->taskRepo->findLatestActiveTask($userId, $tenantId);

        $unitsResult = $this->unitRepo->findAll(1, 1000);
        $units = $unitsResult['items'] ?? [];

        $activeCustomers = $this->customerRepo->findActiveCustomers(); // Del paso anterior
        $activeUnits = $this->unitRepo->findActiveForSelect(); // Usamos el nuevo método
        $activeTypes = $this->typeRepo->findActiveForSelect(); // Usamos el nuevo método

        $data = [
            'pageTitle'   => 'Tareas',
            'contentPath' => 'tasksnew/table.php',
            //'units'        => $units,
            'customers'   => $activeCustomers, // Datos para el modal
            'units'       => $activeUnits,
            'types'       => $activeTypes, 
            'activeTask'  => $activeTask, // Tarea activa actual
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

    /**
     * Recibe los datos del formulario del modal para crear una nueva tarea.
     * Responde en formato JSON.
     */
    public function create()
    {
        // Establecemos que la respuesta será en formato JSON
        header('Content-Type: application/json');

        try {
            // 1. Validar que la petición sea por método POST
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Método no permitido. Se esperaba POST.");
            }

            // Esta es una función estándar para generar UUIDs en PHP.
            $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0x0fff) | 0x4000,
                mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
            );

            // 2. Recoger y sanear los datos del formulario
            // Los nombres de los campos coinciden con los enviados por tasks-create.js
            $data = [
                'label_task' => trim($_POST['label_task'] ?? ''),
                'cas_customer_id_customer' => (int)($_POST['cas_customer_id_customer'] ?? 0),
                'cas_unit_id' => (int)($_POST['cas_unit_id'] ?? 0),
                'desc_task' => trim($_POST['desc_task'] ?? ''),
                'code_task' => $uuid,
                'id_type' => (int)($_POST['id_type'] ?? 0),
                
                // 3. Añadir valores por defecto o de sesión
                'status_task' => 1, // Asumimos '1' como estado inicial "En Curso"
                'id_user' => $_SESSION['id_user'] ?? 1, // IMPORTANTE: Obtener el ID del usuario de la sesión
                'id_tenant' => $_SESSION['id_tenant'] ?? 1, // IMPORTANTE: Obtener el ID del tenant de la sesión
                'date_ini' => date('Y-m-d H:i:s') // Fecha y hora actual de creación
            ];

            // 4. Validación básica de datos obligatorios
            if (empty($data['label_task']) || empty($data['cas_customer_id_customer']) || empty($data['cas_unit_id'])) {
                throw new Exception("El nombre, cliente y unidad son obligatorios.");
            }

            // Llamar al repositorio para que inserte en la base de datos
            $newTaskId = $this->taskRepo->createTask($data);

            if ($newTaskId) {
                // 6. Enviar respuesta de éxito
                echo json_encode(['success' => true, 'taskId' => $newTaskId]);
            } else {
                throw new Exception("Error al guardar la tarea en la base de datos.");
            }

        } catch (Exception $e) {
            // 7. Manejar cualquier error y enviar una respuesta clara
            http_response_code(400); // Código de error para "Bad Request"
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

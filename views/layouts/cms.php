<?php
// Las variables $pageTitle y $contentPath son pasadas desde el controlador
// a través del método View->show().
$pageTitle = $pageTitle ?? 'Relok'; // Asigna un valor por defecto
$contentPath = $contentPath ?? null;
?>
<!DOCTYPE html>
<html lang="es" class="h-full bg-gray-100 dark:bg-neutral-900">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?> | Relok</title>
  <link rel="stylesheet" href="/public/css/app.css?v=11">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <header class="fixed top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-48 lg:z-61 w-full bg-zinc-100 text-sm py-2.5 dark:bg-neutral-900">
    <nav class="px-4 sm:px-5.5 flex basis-full items-center w-full mx-auto">
        <div class="w-full flex items-center gap-x-1.5">
            <a href="/" class="shrink-0 inline-flex justify-center items-center bg-indigo-700 size-8 rounded-md text-xl font-semibold text-white focus:outline-hidden focus:opacity-80" aria-label="Relok">
                R
            </a>
            <span class="font-semibold text-gray-800 dark:text-neutral-200">Relok</span>

            <button type="button" class="p-1.5 size-7.5 inline-flex items-center gap-x-1 text-xs rounded-md border border-transparent text-gray-500 hover:text-gray-800 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:text-gray-800 dark:text-neutral-500 dark:hover:text-neutral-400 dark:focus:text-neutral-400" data-hs-overlay="#hs-pro-sidebar">
              <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="18" x="3" y="3" rx="2" />
                <path d="M15 3v18" />
                <path d="m10 15-3-3 3-3" />
              </svg>
              <span class="sr-only">Sidebar Toggle</span>
            </button>

            <!-- User Profile Dropdown -->
            <div class="ms-auto flex items-center gap-x-3">
                 <div class="hs-dropdown relative inline-flex [--strategy:absolute] [--auto-close:inside] [--placement:bottom-right]">
                     <button id="hs-account-dd" type="button" aria-haspopup="menu" aria-expanded="false" class="p-0.5 inline-flex items-center rounded-full hover:bg-gray-200 dark:hover:bg-neutral-800">
                         <img class="w-8 h-8 rounded-full" src="https://i.pravatar.cc/80?img=5" alt="Avatar">
                     </button>
                     <div class="hs-dropdown-menu hidden opacity-0 transition-[opacity,margin] duration z-50 w-60 bg-white border border-gray-200 rounded-xl shadow-xl dark:bg-neutral-900 dark:border-neutral-700" role="menu" aria-labelledby="hs-account-dd">
                         <div class="py-2 px-3.5">
                             <span class="font-medium text-gray-800 dark:text-neutral-300">Perfil</span>
                             <p class="text-xs text-gray-500 dark:text-neutral-500">usuario@relok</p>
                         </div>
                         <div class="border-t border-gray-200 dark:border-neutral-800 p-1">
                             <a class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm text-gray-600 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-800" href="/?controller=auth&action=logout">
                                 <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>
                                 Salir
                             </a>
                         </div>
                     </div>
                 </div>
            </div>
        </div>
    </nav>
  </header>

  <main class="lg:hs-overlay-layout-open:ps-60 transition-all duration-300 lg:fixed lg:inset-0 pt-13 px-3 pb-3">

    <!-- Sidebar -->
    <div id="hs-pro-sidebar" class="hs-overlay [--body-scroll:true] lg:[--overlay-backdrop:false] [--is-layout-affect:true] [--opened:lg] [--auto-close:lg] hs-overlay-open:translate-x-0 lg:hs-overlay-layout-open:translate-x-0 -translate-x-full transition-all duration-300 transform w-60 hidden fixed inset-y-0 z-60 start-0 bg-gray-100 lg:block lg:-translate-x-full lg:end-auto lg:bottom-0 dark:bg-neutral-900">
        <div class="lg:pt-13 relative flex flex-col h-full max-h-full">
            <nav class="p-3 size-full flex flex-col overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-200 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                <ul class="flex flex-col gap-y-1">
                    <li><a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-500 rounded-lg hover:bg-gray-200 hover:text-gray-800 dark:text-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-neutral-200" href="/?controller=dashboard&action=index">Dashboard</a></li>
                    <li><a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 bg-white border border-gray-200 rounded-lg shadow-xs dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200" href="/?controller=tasksnew&action=index">Tareas</a></li>
                    <li><a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-500 rounded-lg hover:bg-gray-200 hover:text-gray-800 dark:text-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-neutral-200" href="/?controller=units&action=index">Unidades</a></li>
                    <li><a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-500 rounded-lg hover:bg-gray-200 hover:text-gray-800 dark:text-neutral-500 dark:hover:bg-neutral-800 dark:hover:text-neutral-200" href="/?controller=reports&action=index">Reportes</a></li>
                </ul>
            </nav>
            <footer class="mt-auto p-3 flex flex-col border-t border-gray-200 dark:border-neutral-700">
                <span class="text-sm text-gray-500 dark:text-neutral-500">© <?= date('Y') ?> Relok</span>
            </footer>
        </div>
    </div>

    <!-- Content Area -->
    <div class="h-[calc(100dvh-62px)] 
      lg:h-full overflow-hidden 
      flex 
      flex-col 
      bg-white 
      border 
      border-gray-200 
      shadow-xs 
      rounded-lg 
      dark:bg-neutral-800 
      dark:border-neutral-700">
      <div class="py-3 px-4 flex flex-wrap justify-between items-center gap-2 bg-white border-b border-gray-200 dark:bg-neutral-800 dark:border-neutral-700">
        <div>
          <h1 class="font-medium text-lg text-gray-800 dark:text-neutral-200"><?= htmlspecialchars($pageTitle) ?></h1>
        </div>
        <div>
          <button type="button" 
                  class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                  data-hs-overlay="#task-creation-modal">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Crear Tarea
          </button>
        </div>
      </div>
      <div class="flex-1 flex flex-col overflow-hidden overflow-y-auto p-4">
          <?php
            if ($contentPath) {
                // Construye la ruta completa a la vista de contenido
                $fullContentPath = dirname(__FILE__, 2) . '/' . ltrim($contentPath, '/');
                if (is_file($fullContentPath)) {
                    include $fullContentPath;
                } else {
                    echo '<div class="p-4 text-red-700 bg-red-50 border border-red-200 rounded-lg">No se encontró el archivo de contenido: ' . htmlspecialchars($contentPath) . '</div>';
                }
            } else {
              echo '<div class="p-4 text-orange-700 bg-orange-50 border border-orange-200 rounded-lg">No se especificó un contenido para cargar.</div>';
            }
          ?>
      </div>
      </div>
    </main>

    <!-- Modal para crear nueva tarea -->
    <div id="task-creation-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto">
      <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
          <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
            <h3 class="font-bold text-gray-800 dark:text-white">
              Crear Nueva Tarea
            </h3>
            <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#task-creation-modal">
              <span class="sr-only">Cerrar</span>
              <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
          </div>
          <div class="p-4 overflow-y-auto">
            <form>
              <div class="space-y-4">
                <div>
                  <label for="task-name" class="block text-sm font-medium mb-2 dark:text-white">Nombre de la tarea</label>
                  <input type="text" id="task-name" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" placeholder="Ej: Revisar informe mensual">
                </div>

                <div>
                  <label for="task-customer" class="block text-sm font-medium mb-2 dark:text-white">Cliente</label>
                  <select id="task-customer" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    <option value="" selected>Seleccionar un cliente...</option>
                    <?php if (isset($customers)): ?>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?= htmlspecialchars($customer['id_customer']) ?>">
                                <?= htmlspecialchars($customer['label_customer']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>

                <div>
                  <label for="task-unit" class="block text-sm font-medium mb-2 dark:text-white">Unidad</label>
                  <select id="task-unit" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    <option selected>Seleccionar una unidad...</option>
                    <?php if (isset($units)): ?>
                        <?php foreach ($units as $unit): ?>
                            <option value="<?= htmlspecialchars($unit['id']) ?>">
                                <?= htmlspecialchars($unit['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>

                <div>
                  <label for="task-type" class="block text-sm font-medium mb-2 dark:text-white">Tipo</label>
                  <select id="task-type" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                      <option value="" selected>Seleccionar tipo...</option>
                      <?php if (isset($types)): ?>
                          <?php foreach ($types as $type): ?>
                              <option value="<?= htmlspecialchars($type['id_type']) ?>">
                                  <?= htmlspecialchars($type['label_type']) ?>
                              </option>
                          <?php endforeach; ?>
                      <?php endif; ?>
                  </select>
                </div>

                <div>
                  <label for="task-description" class="block text-sm font-medium mb-2 dark:text-white">Descripción</label>
                  <textarea id="task-description" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" rows="3" placeholder="Añadir detalles sobre la tarea..."></textarea>
                </div>
              </div>
            </form>
          </div>
          <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
            <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800" data-hs-overlay="#task-creation-modal">
              Cancelar
            </button>
            <button type="button" id="save-task-btn" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50">
              Guardar Tarea
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Modal Crear Tarea -->

    <script src="/public/vendor/lodash.min.js"></script>
    <script src="/public/vendor/vanilla-calendar.js"></script>
    <script src="/public/vendor/preline/index.js"></script>
    <script src="/views/js/tasks-create.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
          window.HSStaticMethods.autoInit();
        }, 100);
      });
    </script>
</body>
</html>
<div class="flex flex-col">

  <!-- Filtros y Búsqueda -->
  <div class="bg-gray-50 rounded-lg p-4 mb-2 dark:bg-neutral-800">
    <button type="button"
            class="hs-collapse-toggle w-full flex justify-between items-center text-sm font-semibold text-gray-700 dark:text-neutral-300"
            id="hs-filters-collapse-trigger"
            data-hs-collapse="#filters-collapse-content"
            aria-controls="filters-collapse-content"
            aria-expanded="false">
        Opciones de Búsqueda y Filtro
        <svg class="hs-collapse-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6"/>
        </svg>
    </button>

    <!-- Filters Contenido colapsable -->
    <div id="filters-collapse-content"
         class="hs-collapse hidden w-full overflow-hidden transition-[height] duration-300"
         aria-labelledby="hs-filters-collapse-trigger">
        <div class="border-t border-gray-200 mt-4 pt-4 dark:border-neutral-700">
            <form id="filters">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium mb-2 dark:text-white">Buscar</label>
                        <input type="text" name="search" id="search" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium mb-2 dark:text-white">Estado</label>
                        <select name="status" id="status" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                            <option value="">Todos</option>
                            <option value="1" selected>En Curso</option>
                            <option value="2">Finalizada</option>
                            <option value="3">En Pausa</option>
                        </select>
                    </div>
                    <div>
                        <label for="unit_id" class="block text-sm font-medium mb-2 dark:text-white">Unidad</label>
                        <select name="unit_id" id="unit_id" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                            <option value="">Todas</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="start_date_filter" class="block text-sm font-medium mb-2 dark:text-white">Rango de Fechas</label>
                        <div class="relative">
                            <input name="start_date_filter" class="hs-datepicker py-2 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-600 focus:ring-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:border-blue-500 dark:focus:ring-neutral-500" type="text" placeholder="Seleccione días" readonly="" data-hs-datepicker='{
                                "type": "default",
                                "selectionDatesMode": "multiple-ranged",
                                "dateMin": "2020-01-01",
                                "dateMax": "2050-12-31",
                                "styles": {
                                    "week": "vc-week flex pb-1.5",
                                    "weekDay": "vc-week__day m-px w-10 block font-normal text-center text-sm text-gray-500 focus:outline-hidden dark:text-neutral-500",
                                    "dates": "vc-dates grid grid-cols-7 gap-y-0.5",
                                    "date": "vc-date relative size-10.5 flex justify-center items-center text-sm text-gray-800 rounded-full hover:text-blue-600 [&>button]:relative [&>button]:size-full [&>button]:rounded-full nth-[7n]:rounded-r-full nth-[7n+1]:rounded-l-full before:absolute before:inset-0 before:size-full before:border before:border-transparent before:rounded-full hover:before:border-blue-600 hs-vc-date-selected:text-white hs-vc-date-today:bg-blue-600 hs-vc-date-today:text-white hs-vc-date-selected:hs-vc-date-month-prev:text-white hs-vc-date-selected:hs-vc-date-month-next:text-white hs-vc-date-selected:hs-vc-date-month-prev:hover:before:border-blue-600 hs-vc-date-selected:hs-vc-date-month-next:hover:before:border-blue-600 hs-vc-calendar-selected-middle:text-gray-800 hs-vc-calendar-selected-middle:hover:text-blue-600 hs-vc-calendar-selected-first:bg-gray-100 hs-vc-calendar-selected-first:rounded-l-full hs-vc-calendar-selected-first:rounded-r-none hs-vc-date-selected:before:bg-blue-600 hs-vc-calendar-selected-middle:bg-gray-100 hs-vc-calendar-selected-middle:before:bg-gray-100 hs-vc-calendar-selected-middle:rounded-none hs-vc-calendar-selected-last:bg-gray-100 hs-vc-calendar-selected-last:rounded-r-full hs-vc-calendar-selected-last:rounded-l-none hs-vc-date-selected:before:bg-blue-600 hs-vc-date-month-prev:text-gray-400 hs-vc-date-month-next:text-gray-400 hs-vc-date-month-prev:before:hover:border-gray-200 hs-vc-date-month-next:before:hover:border-gray-200 hs-vc-date-month-prev:hs-vc-calendar-selected-middle:text-gray-400 hs-vc-date-month-next:hs-vc-calendar-selected-middle:text-gray-400 hs-vc-date-month-prev:hs-vc-calendar-selected-middle:before:hover:border-gray-200 hs-vc-date-month-next:hs-vc-calendar-selected-middle:before:hover:border-gray-200 hs-vc-date-selected-first:hs-vc-date-month-prev:bg-transparent hs-vc-date-selected-first:hs-vc-date-month-next:bg-transparent hs-vc-date-selected-last:hs-vc-date-month-prev:bg-transparent hs-vc-date-selected-last:hs-vc-date-month-next:bg-transparent dark:text-neutral-200 dark:hover:text-blue-500 dark:hover:before:border-blue-500 dark:hs-vc-date-selected:text-white dark:hs-vc-date-selected:hs-vc-date-month-prev:text-white dark:hs-vc-date-selected:hs-vc-date-month-next:text-white dark:hs-vc-date-today:bg-blue-500 dark:hs-vc-date-today:text-white dark:hs-vc-date-selected:hs-vc-date-month-prev:hover:before:border-blue-500 dark:hs-vc-date-selected:hs-vc-date-month-next:hover:before:border-blue-500 dark:hs-vc-calendar-selected-middle:text-neutral-200 dark:hs-vc-calendar-selected-middle:hover:text-blue-500 dark:hs-vc-calendar-selected-first:bg-neutral-800 dark:hs-vc-date-selected:before:bg-blue-500 dark:hs-vc-calendar-selected-middle:bg-neutral-800 dark:hs-vc-calendar-selected-middle:before:bg-neutral-800 dark:hs-vc-calendar-selected-last:bg-neutral-800 dark:hs-vc-date-selected:before:bg-blue-500 dark:hs-vc-date-month-prev:text-neutral-600 dark:hs-vc-date-month-next:text-neutral-600 dark:hs-vc-date-month-prev:before:hover:border-neutral-700 dark:hs-vc-date-month-next:before:hover:border-neutral-700 dark:hs-vc-date-month-prev:hs-vc-calendar-selected-middle:text-neutral-600 dark:hs-vc-date-month-next:hs-vc-calendar-selected-middle:text-neutral-600 dark:hs-vc-date-month-prev:hs-vc-calendar-selected-middle:before:hover:border-neutral-700 dark:hs-vc-date-month-next:hs-vc-calendar-selected-middle:before:hover:border-neutral-700",
                                    "arrowPrev": "vc-arrow vc-arrow_prev size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800",
                                    "arrowNext": "vc-arrow vc-arrow_next size-8 flex justify-center items-center text-gray-800 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    },
                                "mode": "default",
                                "locale": "es",
                                "inputModeOptions": {
                                    "itemsSeparator": " / "
                                },
                                "templates": {
                                "arrowPrev": "<button data-vc-arrow=\"prev\"><svg class=\"shrink-0 size-4\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m15 18-6-6 6-6\"></path></svg></button>",
                                "arrowNext": "<button data-vc-arrow=\"next\"><svg class=\"shrink-0 size-4\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m9 18 6-6-6-6\"></path></svg></button>"
                                }
                            }'>
                            <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                                <svg class="size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-x-3">
                    <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
                        Filtrar
                    </button>
                    <button type="button" id="resetBtn" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                        Limpiar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Filters Contenido colapsable -->
  
  </div>
  <!-- End Filtros y Búsqueda -->

  <div class="flex items-center mb-4">
    <div class="inline-flex bg-gray-100 rounded-lg p-1 dark:bg-neutral-800">
        <button id="view-cards-btn" type="button" class="px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md">
            Tarjetas
        </button>
        <button id="view-table-btn" type="button" class="px-3 py-1.5 text-sm font-medium text-gray-600 hover:bg-gray-200 rounded-md">
            Tabla
        </button>
    </div>
  </div>

  <div>
      <!-- Vista de Tabla -->
      <div id="table-view" class="hidden">
          <div class="overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                  <div class="border rounded-lg overflow-hidden dark:border-neutral-700">
                      <table id="grid" class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                          <thead class="bg-gray-50 dark:bg-neutral-800">
                              <tr>
                                  <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400" data-sort="id">ID</th>
                                  <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400" data-sort="label">Título</th>
                                  <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400" data-sort="status">Estado</th>
                                  <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400" data-sort="unit_name">Unidad</th>
                                  <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400" data-sort="customer_name">Cliente</th>
                                  <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400" data-sort="type_name">Tipo</th>
                                  <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400" data-sort="start_date">F. Inicio</th>
                                  <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400" data-sort="end_date">F. Fin</th>
                                  <th scope="col" class="px-3 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Acciones</th>
                              </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                              </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>

      <!-- Vista de Tarjetas -->
      <div id="cards-view">
          <div id="cards-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
              </div>
      </div>
  </div>
  
  <div class="py-4 flex justify-between items-center">
      <span id="pageinfo" class="text-sm text-gray-700 dark:text-neutral-400"></span>
      <div class="flex gap-2">
          <button id="prev" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">Anterior</button>
          <button id="next" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">Siguiente</button>
      </div>
  </div>
</div>

<script src="/views/js/tasks-grid.js"></script>
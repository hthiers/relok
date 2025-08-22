<div class="flex flex-col">
    <form id="filters" class="mb-4 p-4 bg-gray-50 rounded-lg dark:bg-neutral-800">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium mb-2 dark:text-white">Buscar</label>
                <input type="text" name="search" id="search" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium mb-2 dark:text-white">Estado</label>
                <select name="status" id="status" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    <option value="">Todos</option>
                    <option value="1">En Curso</option>
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
        </div>
        <div class="mt-4">
            <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                Filtrar
            </button>
        </div>
    </form>

    <div class="-m-1.5 overflow-x-auto">
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
                            <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400" data-sort="start_date">Inicio</th>
                            <th scope="col" class="px-3 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400" data-sort="end_date">Fin</th>
                            <th scope="col" class="px-3 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        </tbody>
                </table>
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
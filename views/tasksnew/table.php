<h1 class="text-2xl font-semibold">Tareas</h1>

<!-- Formulario de filtros -->
<form id="filters" class="flex flex-wrap gap-3 items-end">
  <div>
    <label class="block text-sm">Buscar</label>
    <input type="text" name="search" class="border rounded px-2 py-1"
           placeholder="Título o descripción">
  </div>
  <div>
    <label class="block text-sm">Estado</label>
    <select name="status" class="border rounded px-2 py-1">
      <option value="">Todos</option>
      <option value="1">En progreso</option>
      <option value="2">Terminada</option>
      <!-- Ajusta estos valores según tu enumeración de estados -->
    </select>
  </div>
  <div>
    <label class="block text-sm">Unidad</label>
    <select name="unit_id" class="border rounded px-2 py-1">
      <option value="">Todas</option>
      <?php foreach ($units as $u): ?>
        <option value="<?= (int)$u['id'] ?>">
          <?= htmlspecialchars($u['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <button type="submit" class="px-3 py-2 rounded bg-blue-600 text-white">
    Aplicar
  </button>
</form>

<!-- Tabla de datos -->
<div class="overflow-x-auto border rounded">
  <table class="min-w-full text-sm" id="grid">
    <thead class="bg-gray-50">
      <tr>
        <th data-sort="id"         class="px-3 py-2 cursor-pointer">ID</th>
        <th data-sort="label"      class="px-3 py-2 cursor-pointer">Título</th>
        <th data-sort="status"     class="px-3 py-2 cursor-pointer">Estado</th>
        <th data-sort="unit"       class="px-3 py-2 cursor-pointer">Unidad</th>
        <th data-sort="project"    class="px-3 py-2 cursor-pointer">Proyecto</th>
        <th data-sort="customer"   class="px-3 py-2 cursor-pointer">Cliente</th>
        <th data-sort="type"       class="px-3 py-2 cursor-pointer">Materia</th>
        <th data-sort="start_date" class="px-3 py-2 cursor-pointer">Inicio</th>
        <th data-sort="end_date"   class="px-3 py-2 cursor-pointer">Término</th>
        <th class="px-3 py-2">Acciones</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<!-- Controles de paginación -->
<div class="flex items-center gap-3" id="pager">
  <button id="prev" class="px-2 py-1 border rounded">Anterior</button>
  <span id="pageinfo" class="text-sm"></span>
  <button id="next" class="px-2 py-1 border rounded">Siguiente</button>
</div>

<!-- Modal de edición -->
<dialog id="taskModal" class="rounded p-0">
  <form method="dialog">
    <div class="p-4 space-y-3">
      <h2 class="text-lg font-semibold" id="modalTitle">Editar Tarea</h2>
      <div>
        <label class="block text-sm">Título</label>
        <input id="m_title" class="border rounded w-full px-2 py-1">
      </div>
      <div>
        <label class="block text-sm">Estado</label>
        <select id="m_status" class="border rounded w-full px-2 py-1">
          <option value="1">En progreso</option>
          <option value="2">Terminada</option>
          <!-- Ajusta las opciones de estado según tu esquema -->
        </select>
      </div>
      <div class="flex justify-end gap-2">
        <button value="cancel" class="px-3 py-2 border rounded">
          Cancelar
        </button>
        <button id="saveBtn" value="default"
                class="px-3 py-2 rounded bg-blue-600 text-white">
          Guardar
        </button>
      </div>
    </div>
  </form>
</dialog>

<script src="/views/js/tasks-grid.js"></script>
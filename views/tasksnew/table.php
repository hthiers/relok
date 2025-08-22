<?php
$units = $units ?? [];
?>
<div class="space-y-4">
  <!-- Filtros -->
  <div class="p-4 bg-white border border-gray-200 rounded-lg">
    <form id="filters" class="grid grid-cols-1 md:grid-cols-4 gap-3 items-end">
      <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Estado</label>
        <select name="status" class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-gray-300">
          <option value="">Todos</option>
          <option value="1">En progreso</option>
          <option value="2">Terminada</option>
        </select>
      </div>
      <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Unidad</label>
        <select name="unit_id" class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-gray-300">
          <option value="">Todas</option>
          <?php foreach ($units as $u): ?>
            <option value="<?= (int)($u['id'] ?? 0) ?>"><?= htmlspecialchars($u['name'] ?? '') ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Buscar</label>
        <input type="text" name="search" class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-gray-300" placeholder="Título o descripción">
      </div>
      <div>
        <button type="submit" class="w-full inline-flex justify-center items-center gap-2 py-2.5 px-3 rounded-lg text-sm bg-indigo-600 text-white hover:bg-indigo-700">Aplicar</button>
      </div>
    </form>
  </div>

  <!-- Tabla -->
  <div class="bg-white border border-gray-200 rounded-lg shadow-xs overflow-hidden">
    <div class="overflow-x-auto">
      <table id="grid" class="min-w-full text-sm">
        <thead class="bg-gray-50">
          <tr class="text-gray-600">
            <th data-sort="id"         class="px-4 py-3 text-left font-medium border-b border-gray-200 cursor-pointer">ID</th>
            <th data-sort="label"      class="px-4 py-3 text-left font-medium border-b border-gray-200 cursor-pointer">Título</th>
            <th data-sort="status"     class="px-4 py-3 text-left font-medium border-b border-gray-200 cursor-pointer">Estado</th>
            <th data-sort="unit"       class="px-4 py-3 text-left font-medium border-b border-gray-200 cursor-pointer">Unidad</th>
            <th data-sort="project"    class="px-4 py-3 text-left font-medium border-b border-gray-200 cursor-pointer">Proyecto</th>
            <th data-sort="customer"   class="px-4 py-3 text-left font-medium border-b border-gray-200 cursor-pointer">Cliente</th>
            <th data-sort="type"       class="px-4 py-3 text-left font-medium border-b border-gray-200 cursor-pointer">Materia</th>
            <th data-sort="start_date" class="px-4 py-3 text-left font-medium border-b border-gray-200 cursor-pointer">Inicio</th>
            <th data-sort="end_date"   class="px-4 py-3 text-left font-medium border-b border-gray-200 cursor-pointer">Término</th>
            <th class="px-4 py-3 text-right font-medium border-b border-gray-200">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200"></tbody>
      </table>
    </div>
  </div>

  <!-- Paginación -->
  <div id="pager" class="flex items-center gap-3">
    <button id="prev" class="px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Anterior</button>
    <span id="pageinfo" class="text-sm text-gray-600"></span>
    <button id="next" class="px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Siguiente</button>
  </div>

  <!-- Modal edición -->
  <dialog id="taskModal" class="rounded-lg p-0 border border-gray-200 backdrop:bg-black/20">
    <form method="dialog">
      <div class="p-4 space-y-3 bg-white rounded-lg">
        <h2 class="text-lg font-semibold" id="modalTitle">Editar Tarea</h2>
        <div>
          <label class="block text-sm mb-1 text-gray-700">Título</label>
          <input id="m_title" class="block w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-gray-300">
        </div>
        <div>
          <label class="block text-sm mb-1 text-gray-700">Estado</label>
          <select id="m_status" class="block w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:outline-none focus:border-gray-300">
            <option value="1">En progreso</option>
            <option value="2">Terminada</option>
          </select>
        </div>
        <div class="flex justify-end gap-2 pt-1">
          <button value="cancel" class="px-3 py-2 border border-gray-200 rounded-lg hover:bg-gray-50">Cancelar</button>
          <button id="saveBtn" value="default" class="px-3 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Guardar</button>
        </div>
      </div>
    </form>
  </dialog>
</div>

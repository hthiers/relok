document.addEventListener('DOMContentLoaded', () => {
  // Todo tu código original va aquí adentro
  const tbody    = document.querySelector('#grid tbody');
  const headers  = document.querySelectorAll('#grid thead th[data-sort]');
  const form     = document.querySelector('#filters');
  const pageInfo = document.querySelector('#pageinfo');
  const prevBtn  = document.querySelector('#prev');
  const nextBtn  = document.querySelector('#next');
  const resetBtn = document.querySelector('#resetBtn');

  // Selectores para el cambio de vista
  const viewTableBtn = document.querySelector('#view-table-btn');
  const viewCardsBtn = document.querySelector('#view-cards-btn');
  const tableView = document.querySelector('#table-view');
  const cardsView = document.querySelector('#cards-view');
  const cardsContainer = document.querySelector('#cards-container');

  // Estado de la tabla
  const stateInitial = {
    search: '',
    status: 1,
    unit_id: '',
    project_id: '',
    customer_id: '',
    type_id: '',
    user_id: '',
    year: '',
    month: '',
    day: '',
    sort: 'start_date',
    dir: 'desc',
    page: 1,
    page_size: 20,
    start_date: '',
    end_date: '',
  };

  let state = { ...stateInitial };

  // Construye una query string a partir del estado
  const qs = (params) => {
    return Object.entries(params)
      .filter(([,v]) => v !== '' && v !== null && v !== undefined)
      .map(([k,v]) => `${encodeURIComponent(k)}=${encodeURIComponent(v)}`)
      .join('&');
  };

  // Carga los datos desde el backend
  async function load() {
    const url = `/index.php?controller=tasksnew&action=datagrid&${qs(state)}`;
    console.log('Cargando tareas desde:', url);
    const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
    const data = await res.json();

    renderData(data.items || []);
    renderPager(data);
  }

  // Función principal que llama a los renderizadores de tabla y tarjetas
  function renderData(items) {
      renderRows(items);
      renderCards(items);
  }

  // --- FUNCIONES DE RENDERIZADO ---
  
  // Formatea una fecha en formato DD/MM/YYYY
  function formatDate(dateString) {
    if (!dateString) return '';
    const date = new Date(dateString);
    if (isNaN(date.getTime())) return '';
    
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    
    return `${day}/${month}/${year}`;
  }

  // Renderiza las tareas como filas de tabla
  function renderRows(items) {
    tbody.innerHTML = '';
    for (const it of items) {
      const tr = document.createElement('tr');
      tr.className = 'hover:bg-gray-100 dark:hover:bg-neutral-800';
      tr.innerHTML = `
        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">${it.id ?? ''}</td>
        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">${escapeHtml(it.label ?? '')}</td>
        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">${escapeHtml(it.name_status ?? '')}</td>
        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">${escapeHtml(it.unit_name ?? '')}</td>
        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">${escapeHtml(it.customer_name ?? '')}</td>
        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">${escapeHtml(it.type_name ?? '')}</td>
        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">${formatDate(it.start_date)}</td>
        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">${formatDate(it.end_date)}</td>
        <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-end">
          <button class="py-1.5 px-2.5 inline-flex items-center gap-x-1.5 text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800"
                  data-action="edit"
                  data-id="${it.id}">
            Editar
          </button>
        </td>
      `;
      tbody.appendChild(tr);
    }
  }

  // Renderiza las tareas como tarjetas
  function renderCards(items) {
    cardsContainer.innerHTML = ''; // Limpiar el contenedor antes de añadir nuevas tarjetas
    if (items.length === 0) {
        cardsContainer.innerHTML = `<p class="text-gray-500 col-span-full text-center">No se encontraron tareas.</p>`;
        return;
    }

    for (const it of items) {
      const card = document.createElement('div');
      card.className = 'bg-white border rounded-lg shadow-sm p-4 dark:bg-neutral-800 dark:border-neutral-700 flex flex-col justify-between';
      card.innerHTML = `
          <div>
              <div class="flex justify-between items-start mb-2">
                  <span class="text-xs font-semibold uppercase text-gray-500 dark:text-neutral-400">ID: ${it.id ?? ''}</span>
                  <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">${escapeHtml(it.status_name ?? '')}</span>
              </div>
              <h3 class="text-md font-bold text-gray-800 dark:text-white mb-2">${escapeHtml(it.label ?? '')}</h3>
              <p class="text-sm text-gray-600 dark:text-neutral-300 mb-1"><span class="font-semibold">Cliente:</span> ${escapeHtml(it.customer_name ?? 'N/A')}</p>
              <p class="text-sm text-gray-600 dark:text-neutral-300"><span class="font-semibold">Unidad:</span> ${escapeHtml(it.unit_name ?? 'N/A')}</p>
          </div>
          <div class="border-t border-gray-200 dark:border-neutral-700 mt-4 pt-3 text-xs text-gray-500 dark:text-neutral-400">
              <p><strong>Inicio:</strong> ${formatDate(it.start_date)}</p>
              <p><strong>Fin:</strong> ${formatDate(it.end_date)}</p>
          </div>
      `;
      cardsContainer.appendChild(card);
    }
  }

  // Renderiza el paginador
  function renderPager({ page, page_size, total }) {
    const pages = Math.max(1, Math.ceil((total || 0) / (page_size || 1)));
    pageInfo.textContent = `Página ${page} de ${pages} (total: ${total})`;
    prevBtn.disabled = page <= 1;
    nextBtn.disabled = page >= pages;
  }

  // --- MANEJADORES DE EVENTOS ---

  // Cambio de vista
  viewTableBtn.addEventListener('click', () => {
      tableView.classList.remove('hidden');
      cardsView.classList.add('hidden');

      viewTableBtn.classList.add('bg-blue-600', 'text-white');
      viewTableBtn.classList.remove('text-gray-600', 'hover:bg-gray-200');
      
      viewCardsBtn.classList.add('text-gray-600', 'hover:bg-gray-200');
      viewCardsBtn.classList.remove('bg-blue-600', 'text-white');
  });

  viewCardsBtn.addEventListener('click', () => {
      cardsView.classList.remove('hidden');
      tableView.classList.add('hidden');

      viewCardsBtn.classList.add('bg-blue-600', 'text-white');
      viewCardsBtn.classList.remove('text-gray-600', 'hover:bg-gray-200');
      
      viewTableBtn.classList.add('text-gray-600', 'hover:bg-gray-200');
      viewTableBtn.classList.remove('bg-blue-600', 'text-white');
  });

  headers.forEach(h => {
    h.addEventListener('click', () => {
      const col = h.getAttribute('data-sort');
      if (state.sort === col) {
        state.dir = (state.dir === 'asc' ? 'desc' : 'asc');
      } else {
        state.sort = col;
        state.dir = 'asc';
      }
      state.page = 1;
      load();
    });
  });

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const fd = new FormData(form);
    state.search   = (fd.get('search') || '').trim();
    state.status   = fd.get('status') || '';
    state.unit_id  = fd.get('unit_id') || '';
    state.page     = 1;

    // Limpiamos los parámetros de fecha anteriores
    state.year = '';
    state.month = '';
    state.day = '';
    state.start_date = '';
    state.end_date = '';

    // --- Lógica para obtener la fecha del datepicker de Preline ---
    const datepickerEl = document.querySelector('.hs-datepicker');
    const selectedDate = datepickerEl ? datepickerEl.value : '';

    if (selectedDate && selectedDate.includes('/ ')) {
      const dates = selectedDate.split('/ ');

      if (dates.length === 2) {
        // Asignamos las fechas a los nuevos parámetros del estado
        state.start_date = dates[0].replace(/\./g, '-'); // Reemplaza puntos por guiones
        state.end_date = dates[1].replace(/\./g, '-');   // Reemplaza puntos por guiones
      }

    } else {
      state.day = '';
      state.month = '';
      state.year = '';
    }

    console.log('Filtros aplicados:', state);

    load();
  });

  resetBtn.addEventListener('click', () => {
    form.reset();
    
    const datepickerEl = document.querySelector('.hs-datepicker');
    if (datepickerEl) {
      datepickerEl.value = '';
    }

    state = { ...stateInitial };
    load();
  });

  prevBtn.addEventListener('click', () => {
    state.page = Math.max(1, state.page - 1);
    load();
  });
  nextBtn.addEventListener('click', () => {
    state.page += 1;
    load();
  });

  const dlg = document.getElementById('taskModal');

  if (dlg) {
      const saveBtn = document.getElementById('saveBtn');
      const mTitle  = document.getElementById('m_title');
      const mStatus = document.getElementById('m_status');
    
      tbody.addEventListener('click', (e) => {
        const btn = e.target.closest('button[data-action]');
        if (!btn) return;
        const id = btn.getAttribute('data-id');
        if (btn.dataset.action === 'edit') {
          openEditModal(id);
        }
      });
    
      async function openEditModal(id) {
        const res = await fetch(`/tasks/${id}`, { headers: { 'Accept': 'application/json' } });
        const it = await res.json();
        document.getElementById('modalTitle').textContent = `Editar Tarea #${id}`;
        mTitle.value  = it.label ?? '';
        mStatus.value = it.status ?? '1';
        dlg.showModal();
    
        saveBtn.onclick = async (ev) => {
          ev.preventDefault();
          const payload = {
            label: mTitle.value,
            status: mStatus.value,
          };
          await fetch(`/tasks/${id}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload),
          });
          dlg.close();
          load();
        };
      }
  }

  function escapeHtml(s) {
    return String(s).replace(/[&<>"']/g, (c) => ({
      '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'
    }[c]));
  }

  load();
});
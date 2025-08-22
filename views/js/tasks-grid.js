(() => {
  const tbody    = document.querySelector('#grid tbody');
  const headers  = document.querySelectorAll('#grid thead th[data-sort]');
  const form     = document.querySelector('#filters');
  const pageInfo = document.querySelector('#pageinfo');
  const prevBtn  = document.querySelector('#prev');
  const nextBtn  = document.querySelector('#next');

  // Estado de la tabla
  const state = {
    search: '',
    status: '',
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
  };

  // Construye una query string a partir del estado
  const qs = (params) => {
    return Object.entries(params)
      .filter(([,v]) => v !== '' && v !== null && v !== undefined)
      .map(([k,v]) => `${encodeURIComponent(k)}=${encodeURIComponent(v)}`)
      .join('&');
  };

  async function load() {
    const url = `/index.php?controller=tasksnew&action=datagrid&${qs(state)}`;
    console.log('Cargando tareas desde:', url);
    const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
    const data = await res.json();
    renderRows(data.items || []);
    renderPager(data);
  }

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
        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">${escapeHtml(it.start_date ?? '')}</td>
        <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">${escapeHtml(it.end_date ?? '')}</td>
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

  function renderPager({ page, page_size, total }) {
    const pages = Math.max(1, Math.ceil((total || 0) / (page_size || 1)));
    pageInfo.textContent = `Página ${page} de ${pages} (total: ${total})`;
    prevBtn.disabled = page <= 1;
    nextBtn.disabled = page >= pages;
  }

  // Ordenar al hacer clic en cabeceras
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

  // Filtrar
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const fd = new FormData(form);
    state.search   = (fd.get('search') || '').trim();
    state.status   = fd.get('status') || '';
    state.unit_id  = fd.get('unit_id') || '';
    // Puedes añadir aquí más filtros (project_id, customer_id, etc.)
    state.page     = 1;
    load();
  });

  // Paginación
  prevBtn.addEventListener('click', () => {
    state.page = Math.max(1, state.page - 1);
    load();
  });
  nextBtn.addEventListener('click', () => {
    state.page += 1;
    load();
  });

  // Modal de edición (asumo que tienes un modal con este id en alguna parte)
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
        // Cargar los datos actuales de la tarea
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
            method: 'POST', // o PUT si usas method override
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

  // Carga inicial
  load();
})();
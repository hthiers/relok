<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title><?= isset($page_title) ? htmlspecialchars($page_title) : 'Relok • Panel' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="/public/css/app.css?v=1" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">

  <div class="min-h-screen grid grid-cols-1 md:grid-cols-[260px_1fr]">

    <!-- Sidebar -->
    <aside id="sidebar"
      class="bg-white border-r border-gray-200 h-screen sticky top-0 py-4 px-3 hidden md:block">
      <div class="flex items-center gap-2 px-2 mb-6">
        <div class="w-8 h-8 rounded-lg bg-blue-600"></div>
        <span class="font-bold">Relok</span>
      </div>

      <nav class="space-y-1">
        <a href="/index.php?controller=dashboard&action=index"
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100">
          <span class="w-1.5 h-1.5 rounded-full bg-transparent"></span>
          <span>Dashboard</span>
        </a>
        <a href="/index.php?controller=tasksnew&action=index"
           class="flex items-center gap-2 px-3 py-2 rounded-lg bg-blue-50 text-blue-700">
          <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
          <span>Tareas</span>
        </a>
        <a href="/index.php?controller=units&action=index"
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100">
          <span class="w-1.5 h-1.5 rounded-full bg-transparent"></span>
          <span>Unidades</span>
        </a>
        <a href="/index.php?controller=reports&action=index"
           class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100">
          <span class="w-1.5 h-1.5 rounded-full bg-transparent"></span>
          <span>Reportes</span>
        </a>
      </nav>

      <div class="mt-8 text-xs text-gray-500 px-3">
        © <?= date('Y') ?> Relok
      </div>
    </aside>

    <!-- Main -->
    <div class="flex flex-col">

      <!-- Topbar -->
      <header class="sticky top-0 z-10 bg-white border-b border-gray-200">
        <div class="h-14 flex items-center justify-between px-3">
          <button id="btn-mobile"
                  class="md:hidden inline-flex items-center gap-2 px-3 py-2 border rounded-lg">
            ☰ <span class="text-sm">Menú</span>
          </button>
          <div class="font-semibold"><?= isset($page_title) ? htmlspecialchars($page_title) : 'Panel' ?></div>
          <div class="flex items-center gap-3">
            <input placeholder="Buscar…" class="hidden md:block border rounded-lg px-3 py-1.5" />
            <div class="w-8 h-8 rounded-full bg-gray-200"></div>
          </div>
        </div>
      </header>

      <!-- Breadcrumbs -->
      <div class="px-4 pt-4">
        <nav class="text-sm text-gray-500">
          <ol class="flex flex-wrap gap-1">
            <li><a class="hover:underline" href="/index.php?controller=dashboard&action=index">Inicio</a></li>
            <li>/</li>
            <li class="text-gray-700"><?= isset($page_title) ? htmlspecialchars($page_title) : 'Sección' ?></li>
          </ol>
        </nav>
      </div>

      <!-- Content -->
      <main class="p-4 flex-1 space-y-4">
        <!-- Cards ejemplo (puedes reemplazar/ocultar) -->
        <?php if (!empty($summary_cards ?? [])): ?>
          <section class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php foreach ($summary_cards as $card): ?>
              <div class="bg-white border rounded-xl p-4 shadow-sm">
                <div class="text-xs text-gray-500"><?= htmlspecialchars($card['label'] ?? '') ?></div>
                <div class="text-2xl font-semibold"><?= htmlspecialchars($card['value'] ?? '') ?></div>
              </div>
            <?php endforeach; ?>
          </section>
        <?php endif; ?>

        <!-- Slot de contenido -->
        <section class="bg-white border rounded-xl shadow-sm p-4">
          <?php
            // Render del contenido específico de la página
            if (!empty($content_view)) {
              $content_path = __DIR__ . '/../' . ltrim($content_view, '/');
              if (is_file($content_path)) {
                include $content_path;
              } else {
                echo '<div class="text-red-600">Vista no encontrada: '
                   . htmlspecialchars($content_view) . '</div>';
              }
            }
          ?>
        </section>
      </main>
    </div>
  </div>

  <script>
    // Toggle sidebar en móvil
    const btn = document.getElementById('btn-mobile');
    const aside = document.getElementById('sidebar');
    btn?.addEventListener('click', () => {
      if (aside.classList.contains('hidden')) {
        aside.classList.remove('hidden');
        aside.classList.add('fixed','inset-0','z-50','w-64');
      } else {
        aside.classList.add('hidden');
        aside.classList.remove('fixed','inset-0','z-50','w-64');
      }
    });
  </script>
</body>
</html>

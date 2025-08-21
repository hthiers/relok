<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title><?= isset($page_title) ? htmlspecialchars($page_title) : 'Relok • Panel' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="/public/css/app.css?v=1" rel="stylesheet">
</head>
<body class="tw-bg-gray-50 tw-text-gray-800">

  <div class="tw-min-h-screen tw-grid tw-grid-cols-1 md:tw-grid-cols-[260px_1fr]">

    <!-- Sidebar -->
    <aside id="sidebar"
      class="tw-bg-white tw-border-r tw-border-gray-200 tw-h-screen tw-sticky tw-top-0 tw-py-4 tw-px-3 tw-hidden md:tw-block">
      <div class="tw-flex tw-items-center tw-gap-2 tw-px-2 tw-mb-6">
        <div class="tw-w-8 tw-h-8 tw-rounded-lg tw-bg-blue-600"></div>
        <span class="tw-font-bold">Relok</span>
      </div>

      <nav class="tw-space-y-1">
        <a href="/index.php?controller=dashboard&action=index"
           class="tw-flex tw-items-center tw-gap-2 tw-px-3 tw-py-2 tw-rounded-lg hover:tw-bg-gray-100">
          <span class="tw-w-1.5 tw-h-1.5 tw-rounded-full tw-bg-transparent"></span>
          <span>Dashboard</span>
        </a>
        <a href="/index.php?controller=tasksnew&action=index"
           class="tw-flex tw-items-center tw-gap-2 tw-px-3 tw-py-2 tw-rounded-lg tw-bg-blue-50 tw-text-blue-700">
          <span class="tw-w-1.5 tw-h-1.5 tw-rounded-full tw-bg-blue-600"></span>
          <span>Tareas</span>
        </a>
        <a href="/index.php?controller=units&action=index"
           class="tw-flex tw-items-center tw-gap-2 tw-px-3 tw-py-2 tw-rounded-lg hover:tw-bg-gray-100">
          <span class="tw-w-1.5 tw-h-1.5 tw-rounded-full tw-bg-transparent"></span>
          <span>Unidades</span>
        </a>
        <a href="/index.php?controller=reports&action=index"
           class="tw-flex tw-items-center tw-gap-2 tw-px-3 tw-py-2 tw-rounded-lg hover:tw-bg-gray-100">
          <span class="tw-w-1.5 tw-h-1.5 tw-rounded-full tw-bg-transparent"></span>
          <span>Reportes</span>
        </a>
      </nav>

      <div class="tw-mt-8 tw-text-xs tw-text-gray-500 tw-px-3">
        © <?= date('Y') ?> Relok
      </div>
    </aside>

    <!-- Main -->
    <div class="tw-flex tw-flex-col">

      <!-- Topbar -->
      <header class="tw-sticky tw-top-0 tw-z-10 tw-bg-white tw-border-b tw-border-gray-200">
        <div class="tw-h-14 tw-flex tw-items-center tw-justify-between tw-px-3">
          <button id="btn-mobile"
                  class="md:tw-hidden tw-inline-flex tw-items-center tw-gap-2 tw-px-3 tw-py-2 tw-border tw-rounded-lg">
            ☰ <span class="tw-text-sm">Menú</span>
          </button>
          <div class="tw-font-semibold"><?= isset($page_title) ? htmlspecialchars($page_title) : 'Panel' ?></div>
          <div class="tw-flex tw-items-center tw-gap-3">
            <input placeholder="Buscar…" class="tw-hidden md:tw-block tw-border tw-rounded-lg tw-px-3 tw-py-1.5" />
            <div class="tw-w-8 tw-h-8 tw-rounded-full tw-bg-gray-200"></div>
          </div>
        </div>
      </header>

      <!-- Breadcrumbs -->
      <div class="tw-px-4 tw-pt-4">
        <nav class="tw-text-sm tw-text-gray-500">
          <ol class="tw-flex tw-flex-wrap tw-gap-1">
            <li><a class="hover:tw-underline" href="/index.php?controller=dashboard&action=index">Inicio</a></li>
            <li>/</li>
            <li class="tw-text-gray-700"><?= isset($page_title) ? htmlspecialchars($page_title) : 'Sección' ?></li>
          </ol>
        </nav>
      </div>

      <!-- Content -->
      <main class="tw-p-4 tw-flex-1 tw-space-y-4">
        <!-- Cards ejemplo (puedes reemplazar/ocultar) -->
        <?php if (!empty($summary_cards ?? [])): ?>
          <section class="tw-grid sm:tw-grid-cols-2 lg:tw-grid-cols-4 tw-gap-4">
            <?php foreach ($summary_cards as $card): ?>
              <div class="tw-bg-white tw-border tw-rounded-xl tw-p-4 tw-shadow-sm">
                <div class="tw-text-xs tw-text-gray-500"><?= htmlspecialchars($card['label'] ?? '') ?></div>
                <div class="tw-text-2xl tw-font-semibold"><?= htmlspecialchars($card['value'] ?? '') ?></div>
              </div>
            <?php endforeach; ?>
          </section>
        <?php endif; ?>

        <!-- Slot de contenido -->
        <section class="tw-bg-white tw-border tw-rounded-xl tw-shadow-sm tw-p-4">
          <?php
            // Render del contenido específico de la página
            if (!empty($content_view)) {
              $content_path = __DIR__ . '/../' . ltrim($content_view, '/');
              if (is_file($content_path)) {
                include $content_path;
              } else {
                echo '<div class="tw-text-red-600">Vista no encontrada: '
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
      if (aside.classList.contains('tw-hidden')) {
        aside.classList.remove('tw-hidden');
        aside.classList.add('tw-fixed','tw-inset-0','tw-z-50','tw-w-64');
      } else {
        aside.classList.add('tw-hidden');
        aside.classList.remove('tw-fixed','tw-inset-0','tw-z-50','tw-w-64');
      }
    });
  </script>
</body>
</html>

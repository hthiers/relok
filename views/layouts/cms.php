<?php
// Espera $pageTitle y $content/$contentPath (p. ej. 'tasksnew/table.php')
$__content = $contentPath ?? ($content ?? null);
if ($__content && !is_file($__content)) {
  $viewsRoot = dirname(__FILE__, 2); // /views
  $try = $viewsRoot . '/' . ltrim($__content, '/');
  if (is_file($try)) $__content = $try;
}
$pageTitle = $pageTitle ?? 'Relok';
?>
<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?> | Relok</title>
  <link rel="stylesheet" href="/public/css/app.css?v=10">
</head>
<body class="bg-gray-100 text-sm h-full">

  <!-- ========== HEADER ========== -->
  <header class="fixed top-0 inset-x-0 z-50 w-full bg-zinc-100/95 backdrop-blur border-b border-gray-200">
    <nav class="h-14 px-4 sm:px-6 max-w-[1400px] mx-auto flex items-center gap-3">
      <!-- Brand -->
      <a href="/" class="inline-flex items-center gap-2 shrink-0">
        <span class="grid place-items-center w-8 h-8 rounded-md bg-indigo-700 text-white font-semibold">R</span>
        <span class="font-semibold text-gray-800">Relok</span>
      </a>

      <!-- Toggle SIEMPRE visible -->
      <button
        type="button"
        class="ms-1 inline-flex items-center justify-center w-9 h-9 rounded-md text-gray-600 hover:bg-gray-200 hover:text-gray-900"
        aria-controls="hs-pro-sidebar" aria-expanded="false" aria-haspopup="dialog"
        data-hs-overlay="#hs-pro-sidebar" title="Mostrar/ocultar menú">
        <!-- ícono estilo demo -->
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect width="18" height="18" x="3" y="3" rx="2" />
          <path d="M15 3v18" />
          <path d="m10 15-3-3 3-3" />
        </svg>
        <span class="sr-only">Sidebar Toggle</span>
      </button>

      <!-- Search (opcional) -->
      <div class="hidden md:block ms-2 flex-1">
        <div class="relative">
          <input type="text" placeholder="Buscar…"
                 class="w-full ps-9 pe-3 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 placeholder:text-gray-400 outline-none focus:border-gray-300">
          <span class="absolute inset-y-0 start-0 grid place-items-center ps-3">
            <svg class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m21 21-4.3-4.3"/><circle cx="11" cy="11" r="7"/></svg>
          </span>
        </div>
      </div>

      <!-- Perfil (cerrado por defecto) -->
      <div class="ms-auto">
        <div class="hs-dropdown relative [--strategy:absolute] [--auto-close:inside] [--placement:bottom-right]">
          <button id="hs-account-dd" type="button" aria-haspopup="menu" aria-expanded="false"
                  class="p-0.5 inline-flex items-center rounded-full hover:bg-gray-200">
            <img class="w-8 h-8 rounded-full" src="https://i.pravatar.cc/80?img=5" alt="Avatar">
          </button>
          <div class="hs-dropdown-menu hidden opacity-0 transition-[opacity,margin] duration z-50 w-60 bg-white border border-gray-200 rounded-xl shadow-xl"
               role="menu" aria-labelledby="hs-account-dd">
            <div class="py-2 px-3.5">
              <span class="font-medium text-gray-800">Perfil</span>
              <p class="text-xs text-gray-500">usuario@relok</p>
            </div>
            <div class="border-t border-gray-200 p-1">
              <a class="flex items-center gap-3 py-2 px-3 rounded-lg text-sm text-gray-600 hover:bg-gray-100"
                 href="/?controller=auth&action=logout">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                </svg>
                Salir
              </a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <!-- ========== END HEADER ========== -->

  <!-- ========== MAIN (sidebar + content) ========== -->
  <main class="lg:hs-overlay-layout-open:ps-60 transition-all duration-300 fixed inset-0 pt-14 px-3 pb-3">
    <!-- Sidebar -->
    <aside id="hs-pro-sidebar"
      class="hs-overlay [--body-scroll:true] lg:[--overlay-backdrop:false] [--is-layout-affect:true] [--opened:lg] [--auto-close:lg]
             hs-overlay-open:translate-x-0 lg:hs-overlay-layout-open:translate-x-0
             -translate-x-full transition-all duration-300 transform
             w-60 hidden fixed inset-y-0 z-50 start-0
             bg-gray-100 border-r border-gray-200 shadow-xs lg:block lg:-translate-x-full">

      <div class="h-full flex flex-col lg:pt-14">
        <nav class="p-3 flex-1 overflow-y-auto">
          <ul class="flex flex-col gap-y-1">
            <li><a href="/?controller=dashboard&action=index" class="w-full flex items-center gap-2 py-2 px-2.5 text-sm text-gray-600 rounded-lg hover:bg-gray-200 hover:text-gray-900">Dashboard</a></li>
            <li><a href="/?controller=tasksnew&action=index" class="w-full flex items-center gap-2 py-2 px-2.5 text-sm bg-white border border-gray-200 text-gray-800 rounded-lg shadow-xs">Tareas</a></li>
            <li><a href="/?controller=units&action=index" class="w-full flex items-center gap-2 py-2 px-2.5 text-sm text-gray-600 rounded-lg hover:bg-gray-200 hover:text-gray-900">Unidades</a></li>
            <li><a href="/?controller=reports&action=index" class="w-full flex items-center gap-2 py-2 px-2.5 text-sm text-gray-600 rounded-lg hover:bg-gray-200 hover:text-gray-900">Reportes</a></li>
          </ul>
        </nav>
        <footer class="p-3 border-t border-gray-200 text-[13px] text-gray-500">© <?= date('Y') ?> Relok</footer>
      </div>
    </aside>
    <!-- End Sidebar -->

    <!-- Content card -->
    <section class="h-[calc(100dvh-56px)] lg:h-full overflow-hidden flex flex-col bg-white border border-gray-200 shadow-xs rounded-lg">
      <!-- Header de sección -->
      <div class="py-3 px-4 flex items-center justify-between gap-2 bg-white border-b border-gray-200">
        <h1 class="font-medium text-lg text-gray-800"><?= htmlspecialchars($pageTitle) ?></h1>
      </div>

      <!-- Slot de contenido -->
      <div class="flex-1 overflow-y-auto p-4">
        <?php
          if ($__content && is_file($__content)) {
            include $__content;
          } else {
            echo '<div class="p-4 text-red-700 bg-red-50 border border-red-200 rounded-lg">No se encontró el contenido a cargar. Verifica $contentPath / $content.</div>';
          }
        ?>
      </div>
    </section>
  </main>
  <!-- ========== END MAIN ========== -->

  <!-- Preline: local con fallback a CDN; autoInit al cargar -->
  <script src="/public/vendor/preline/index.js"
          onload="window.HSStaticMethods?.autoInit()"
          onerror="(function(){var s=document.createElement('script');s.src='https://cdn.jsdelivr.net/npm/preline@2.5.0/dist/preline.min.js';s.onload=function(){window.HSStaticMethods?.autoInit()};document.head.appendChild(s)})()"></script>
</body>
</html>

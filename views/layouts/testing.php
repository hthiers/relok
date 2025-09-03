<?php
// /Users/hernanthiers/Workspace/relok/views/layouts/testing.php
// Simple testing layout view
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Testing Layout</title>
  <style>
    :root { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial; color: #222; }
    body { margin: 0; padding: 0; background: #f7f9fc; }
    header { background: #0b5fff; color: #fff; padding: 1rem 1.5rem; }
    .container { max-width: 960px; margin: 1.25rem auto; padding: 0 1rem; }
    .card { background: #fff; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); padding: 1rem; margin-bottom: 1rem; }
    .row { display: flex; gap: 1rem; flex-wrap: wrap; }
    .col { flex: 1 1 220px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { text-align: left; padding: .5rem; border-bottom: 1px solid #eee; }
    footer { text-align: center; color: #666; padding: 1rem 0; font-size: .9rem; }
    button { background: #0b5fff; color: #fff; border: none; padding: .5rem .75rem; border-radius: 4px; cursor: pointer; }
    input[type="text"] { padding: .5rem; border: 1px solid #ddd; border-radius: 4px; width: 100%; box-sizing: border-box; }
    .muted { color: #666; font-size: .9rem; }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <h1 style="margin:0;font-size:1.25rem;">Testing Layout</h1>
    </div>
  </header>

  <main class="container" role="main">
    <section class="card" id="status">
      <strong>Environment:</strong>
      <span class="muted">Testing PHP layout</span>
      <div style="margin-top:.5rem">
        <span id="ping" class="muted">Ping: —</span>
        <button id="pingBtn" style="margin-left:.5rem">Ping</button>
      </div>
    </section>

    <section class="card">
      <div class="row">
        <div class="col">
          <h3 style="margin-top:0">Quick form</h3>
          <form id="testForm">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" placeholder="Type a name" />
            <div style="margin-top:.5rem;">
              <button type="submit">Submit</button>
            </div>
          </form>
          <div id="formResult" class="muted" style="margin-top:.5rem"></div>
        </div>

        <div class="col">
          <h3 style="margin-top:0">Sample table</h3>
          <table>
            <thead>
              <tr><th>#</th><th>Item</th><th>Note</th></tr>
            </thead>
            <tbody>
              <tr><td>1</td><td>Alpha</td><td class="muted">example</td></tr>
              <tr><td>2</td><td>Beta</td><td class="muted">example</td></tr>
              <tr><td>3</td><td>Gamma</td><td class="muted">example</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <section class="card">
      <h3 style="margin-top:0">Simple input</h3>
      <input
        class="hs-datepicker"
        type="text" placeholder=""
        readonly
        data-hs-datepicker='{
          "type": "default",
          "dateMax": "2050-12-31",
          "styles": {
            "week": "vc-week",
            "weekDay": "vc-week__day",
            "dates": "vc-dates",
            "date": "vc-date",
            "arrowPrev": "vc-arrow vc-arrow_prev",
            "arrowNext": "vc-arrow vc-arrow_next"
          },
          "mode": "custom-select"
      }'>
    </section>

    <section class="card">
      <h3 style="margin-top:0">Render area</h3>
      <div id="renderArea" class="muted">This area can be used to render dynamic content from controllers.</div>
      <?php
        // If a view injects $content into this layout, it will be printed here.
        if (!empty($content)) {
            echo $content;
        }
      ?>
    </section>
  </main>

  <footer>
    &copy; <?= date('Y') ?> Testing layout — small demo
  </footer>

  <script>
    // Small client-side interactions for testing
    document.getElementById('pingBtn').addEventListener('click', function () {
      var start = Date.now();
      // fake async ping with timeout
      setTimeout(function () {
        var ms = Date.now() - start;
        document.getElementById('ping').textContent = 'Ping: ' + ms + ' ms';
      }, Math.floor(Math.random() * 150) + 20);
    });

    document.getElementById('testForm').addEventListener('submit', function (e) {
      e.preventDefault();
      var name = document.getElementById('name').value.trim();
      document.getElementById('formResult').textContent = name ? 'Submitted: ' + name : 'Please enter a name.';
    });

    // Expose a simple debug helper
    window.layoutTest = {
      setContent: function (html) {
        document.getElementById('renderArea').innerHTML = html;
      }
    };
  </script>
  <script src="/public/vendor/lodash.min.js"></script>
  <script src="/public/vendor/vanilla-calendar.js"></script>
  <script src="/public/vendor/preline/index.js"></script>
</body>
</html>
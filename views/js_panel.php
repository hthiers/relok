<script type="text/javascript">

// Google Chart
function chartTareasxMaterias() {
  var jsonData = $.ajax({
    url: "?controller=panel&action=ajaxIndiTareasMat",
    dataType: "json",
    async: false
  }).responseText;

  var data = google.visualization.arrayToDataTable($.parseJSON(jsonData));

  // Set chart options
  var options = {
    title:'Gestiones por materia',
    width:400,
    height:300
  };

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.PieChart(document.getElementById('chart_trabajosxmaterias_div'));
  chart.draw(data, options);
}

function chartTareasxUsuarios(){
  var jsonData = $.ajax({
    url: "?controller=panel&action=ajaxIndiGestionesUsu",
    dataType: "json",
    async: false
  }).responseText;

  var data = google.visualization.arrayToDataTable($.parseJSON(jsonData));
  var view = new google.visualization.DataView(data);

  var options = {
    title: "Gestiones por colaborador",
    width: 400,
    height: 300,
    bar: {groupWidth: "95%"},
    legend: { position: "none" },
  };

  var chart = new google.visualization.ColumnChart(document.getElementById("chart_gestionesxusuario_div"));
  chart.draw(view, options);
}

function chartTareasxAnio(){
  var jsonData = $.ajax({
    url: "?controller=panel&action=ajaxIndiGestionesAnio",
    dataType: "json",
    async: false
  }).responseText;

  // var data = google.visualization.arrayToDataTable($.parseJSON(jsonData));
  var data = google.visualization.arrayToDataTable([
          ['Genre', 'Fantasy & Sci Fi', 'Romance', 'Mystery/Crime', 'General',
           'Western', 'Literature', { role: 'annotation' } ],
          ['2010', 10, 24, 20, 32, 18, 5, ''],
          ['2020', 16, 22, 23, 30, 16, 9, ''],
          ['2030', 28, 19, 29, 30, 12, 13, '']
        ]);

  var view = new google.visualization.DataView(data);

  var options = {
    width: 400,
    height: 300,
    legend: { position: 'right', maxLines: 3 },
    bar: { groupWidth: '75%' },
    isStacked: true
  };

  var chart = new google.visualization.BarChart(document.getElementById("chart_gestionesxanio_div"));
  chart.draw(view, options);
}

$(document).ready(function() {
  $("ul#submenu").removeClass("hidden");
});

</script>

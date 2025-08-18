<script type="text/javascript">
TableTools.BUTTONS.download = {
    "sAction": "text",
    "sTag": "default",
    "sFieldBoundary": "",
    "sFieldSeperator": "\t",
    "sNewLine": "<br>",
    "sToolTip": "",
    "sButtonClass": "DTTT_button_text",
    "sButtonClassHover": "DTTT_button_text_hover",
    "sButtonText": "Download",
    "mColumns": "all",
    "bHeader": true,
    "bFooter": true,
    "sDiv": "",
    "fnMouseover": null,
    "fnMouseout": null,
    "fnClick": function( nButton, oConfig ) {
        var oParams = this.s.dt.oApi._fnAjaxParameters( this.s.dt );

        oParams.push(
            { "name": "filAnio", "value": $('#cboAnio').val() },
            { "name": "filCliente", "value": $('#cboCliente').val() },
            { "name": "filMes", "value": $('#cboMes').val() },
            { "name": "filDia", "value": $('#cboDia').val() },
            { "name": "filType", "value": $('#cboType').val() },
            { "name": "filEstado", "value": $('#cboEstado').val() },
            { "name": "filUser", "value": $('#cboUser').val() }
        );

//       console.log(oParams);

        /* Create an IFrame to do the request */
        var nIFrame = document.createElement('iframe');
        nIFrame.setAttribute( 'id', 'RemotingIFrame' );
        nIFrame.style.border='0px';
        nIFrame.style.width='0px';
        nIFrame.style.height='0px';
        nIFrame.src = oConfig.sUrl+"&"+$.param(oParams);
        document.body.appendChild( nIFrame );
    },
    "fnSelect": null,
    "fnComplete": null,
    "fnInit": null
};

/*
* Getting needed value from dt row
 */
function fnFormatDetails (oTable, nTr){
    var aData = oTable.fnGetData( nTr );
    return aData[6];
}

function viewTask(task){
    //console.log(task);

    var urlAction = "<?php echo "?controller=".$controller."&action=tasksView";?>";

    $('#dt_form').attr('action', urlAction);
    $('#dt_form').attr('method', 'POST');
    $('#task_id').val(task);

    $("#dt_form").submit();
}

function editTask(task){
    //console.log(task);

    var urlAction = "<?php echo "?controller=".$controller."&action=tasksEditForm";?>";

    $('#dt_form').attr('action', urlAction);
    $('#dt_form').attr('method', 'POST');
    $('#task_id').val(task);

    $("#dt_form").submit();
}

function removeTask(task){
    var urlAction = "<?php echo "?controller=".$controller."&action=tasksRemove";?>";

    $('#task_id').val(task);
   $('#modalEliminar').foundation('open');
}

function hideErrorBox(){
    $("#errorbox_success").fadeToggle( "slow", "linear" );
    $("#errorbox_failure").fadeToggle( "slow", "linear" );
}

$(document).ready(function() {
    $("ul#submenu").removeClass("hidden");
    var s_id_user = "<?php echo $session->id_user;?>";
    var s_id_profile = "<?php echo $session->id_profile;?>";

    //Hide errorbox
    setTimeout(function() {
        hideErrorBox();
    }, 2000);

    var oTable = $('#example').dataTable({
        //Initial server side params
        "bProcessing": true,
        "bServerSide": true,
        "bStateSave": true,
        "bStateLoad": true,
        "bAutoWidth": false,
        "sAjaxSource": '?controller=tasks&action=ajaxTasksDt',

        "fnStateSave": function (oSettings, oData) {
          localStorage.setItem( 'DataTables_'+window.location.pathname, JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
          var data = localStorage.getItem('DataTables_'+window.location.pathname);

          return JSON.parse(data);
        },

        "sDom": 'T<"top"lpf>rt<"stats">',

        "fnDrawCallback": function (aoData) {
          var filas = aoData._iRecordsDisplay;
          var total = aoData._iRecordsTotal;
          var tiempo = secondsToTime(aoData.jqXHR.responseJSON.iTotalTime);


          var strStats = "<span class='fi-list icon-indicator'></span> "+filas+"/"+total;
          strStats += " <span class='fi-clock icon-indicator'></span> "+tiempo['h']+":"+tiempo['m']+":"+tiempo['s'];
          $(".stats").html(strStats);
        },

        "oLanguage": {
            "sInfo": "_TOTAL_ registros",
            "sInfoEmpty": "0 registros",
            "sInfoFiltered": "(de _MAX_ registros)",
            "sLengthMenu": "_MENU_ por p&aacute;gina",
            "sZeroRecords": "No hay registros",
            "sInfo": "_START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 registros",
            "sSearch": "Buscar",
            "sProcessing": "",
            "oPaginate": {
                "sFirst": "Primera",
                "sNext": "Siguiente",
                "sPrevious": "Anterior",
                "sLast": "&Uacute;ltima"
            }
        },

        "oTableTools": {
            "sSwfPath": "views/media/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "download",
                    "sButtonText": "Excel",
                    "sUrl": "?controller=tasks&action=ajaxBuildXls"
                }
            ]
        },

        //Custom filters params
        "fnServerParams": function ( aoData ){
            aoData.push(
		            { "name": "filAnio", "value": $('#cboAnio').val() },
		            { "name": "filCliente", "value": $('#cboCliente').val() },
                { "name": "filMes", "value": $('#cboMes').val() },
                { "name": "filDia", "value": $('#cboDia').val() },
                { "name": "filType", "value": $('#cboType').val() },
                { "name": "filEstado", "value": $('#cboEstado').val() },
                { "name": "filUser", "value": $('#cboUser').val() }
            );
        },

        "aoColumnDefs": [
            {
                "sClass": "td_options", "aTargets": [-1]
            },
            {
                "sWidth": "10%", "aTargets": [0,1,4,5,6,-1]
            },
            {
                "sWidth": "20%", "aTargets": [2]
            },
            { "mDataProp": null, "aTargets": [-1] },
            { "bVisible": false, "aTargets": [8,9,10,11, 12] },
            {
                "fnRender": function ( oObj ) {
                    if(oObj.aData[0] !== null){
                        var db_date = oObj.aData[0];
                        var string_date = formatDateTimeString(db_date);

                        return string_date;
                    }
                    else{
                        return '';
                    }
                },
                "aTargets": [0]
            },
            {
                "fnRender": function ( oObj ) {
                    if(oObj.aData[1] !== null){
                        var db_date = oObj.aData[1];
                        var string_date = formatDateTimeString(db_date);

                        return string_date;
                    }
                    else{
                        return '';
                    }
                },
                "aTargets": [1]
            },
            {
                "fnRender": function ( oObj ) {
                    if(oObj.aData[7] !== null){
                        var seconds = oObj.aData[7];
                        var total = secondsToTime(seconds);

                        return total['h']+':'+total['m']+':'+total['s'];
                    }
                    else{
                        return '';
                    }
                },
                "aTargets": [7]
            },
            {
                "fnRender": function ( oObj ) {
                    var dt_tools = "";

                    // perfil administrador (todas las opciones)
                    if(s_id_profile == 1){
                      if(Object.entries(oObj.aData[1]).length === 0){
                        dt_tools = dt_tools+"<a href=\'javascript:void(0)\' id=\'btn_view\' class=\'icon-action fi-eye medium\' name='"+oObj.aData[8]+"' onclick='viewTask("+oObj.aData[8]+")'></a> &nbsp;"
                        dt_tools = dt_tools+"<a href=\'javascript:void(0)\' id=\'tool_remove\' class=\'icon-action fi-trash\' name='"+oObj.aData[8]+"' onclick='removeTask("+oObj.aData[8]+")'></a>";
                      }
                      else{
                        dt_tools = dt_tools+"<a href=\'javascript:void(0)\' id=\'btn_view\' class=\'icon-action fi-eye medium\' name='"+oObj.aData[8]+"' onclick='viewTask("+oObj.aData[8]+")'></a> &nbsp;"
                        dt_tools = dt_tools+"<a href=\'javascript:void(0)\' id=\'btn_edit\' class=\'icon-action fi-page-edit\' name='"+oObj.aData[8]+"' onclick='editTask("+oObj.aData[8]+")'></a> &nbsp;"
                        dt_tools = dt_tools+"<a href=\'javascript:void(0)\' id=\'tool_remove\' class=\'icon-action fi-trash\' name='"+oObj.aData[8]+"' onclick='removeTask("+oObj.aData[8]+")'></a>";
                      }
                    }
                    else if(s_id_profile == 3){
                      dt_tools = dt_tools+"<a href=\'javascript:void(0)\' id=\'btn_view\' class=\'icon-action fi-eye medium\' name='"+oObj.aData[8]+"' onclick='viewTask("+oObj.aData[8]+")'></a> &nbsp;";
                    }
                    else{
                        //opciones para tareas propias
                        if(parseInt(s_id_user) === parseInt(oObj.aData[12])){
                          dt_tools = dt_tools+"<a href=\'javascript:void(0)\' id=\'btn_view\' class=\'icon-action fi-eye medium\' name='"+oObj.aData[8]+"' onclick='viewTask("+oObj.aData[8]+")'></a>";

                          if(Object.entries(oObj.aData[1]).length > 0){
                            dt_tools = dt_tools+"&nbsp; <a href=\'javascript:void(0)\' id=\'tool_remove\' class=\'icon-action fi-trash\' name='"+oObj.aData[8]+"' onclick='removeTask("+oObj.aData[8]+")'></a>";
                          }
                        }
                    }
                    //console.log(dt_tools);

                    return dt_tools;
                },
                "aTargets": [-1]
            }
        ],

        "sPaginationType": "two_button",
        "aaSorting": [[0, "asc"]]

    });

    ahora = new Date();
    ahoraDay = ahora.getDate();
    ahoraMonth = ahora.getMonth();
    ahoraYear = ahora.getYear();

    // año
    var dteNow = new Date();
    var intYear = dteNow.getFullYear();

    // listeners de filtros para dataTable
    $('#cboAnio').change(function() {
      localStorage.setItem('cboAnio', this.value);
      oTable.fnDraw();
    });
    $('#cboCliente').change(function() {
      localStorage.setItem('cboCliente', this.value);
      oTable.fnDraw();
    });
    $('#cboMes').change(function() {
      localStorage.setItem('cboMes', this.value);
      oTable.fnDraw();
    });
    $('#cboDia').change(function() {
      localStorage.setItem('cboDia', this.value);
      oTable.fnDraw();
    });
    $('#cboType').change(function() {
      localStorage.setItem('cboType', this.value);
      oTable.fnDraw();
    });
    $('#cboEstado').change(function() {
      localStorage.setItem('cboEstado', this.value);
      oTable.fnDraw();
    });
    $('#cboUser').change(function() {
      localStorage.setItem('cboUser', this.value);
      oTable.fnDraw();
    });

    getLastDay('cboMes', 'cboAnio', 'cboDia');
    $('#cboCliente').select2();
    $('#cboType').select2();
    $('#cboUser').select2({
      minimumResultsForSearch: 5
    });
    $('#cboAnio').select2({
      minimumResultsForSearch: 5
    });
    $('#cboMes').select2();
    $('#cboDia').select2();
    $('#cboEstado').select2({
      minimumResultsForSearch: 5
    });

    $('#confirmarEliminar').click(function() {
        var urlAction = "<?php echo "?controller=tasks&action=tasksRemove";?>";

        $('#dt_form').attr('action', urlAction);
        $('#dt_form').attr('method', 'POST');

        $("#dt_form").submit();
    });

    $('#cancelarEliminar').click(function() {
        $('#modalEliminar').foundation('close');
    });

    // Use localStorage if exists
    var todosOptions = new Option("Todos", "0", false, false);

    if(localStorage.getItem('cboCliente')){
      // $('#cboCliente').append(todosOptions);
      $('#cboCliente').val(localStorage.getItem('cboCliente')).trigger('change');
    }
    if(localStorage.getItem('cboType')){
      // $('#cboType').append(todosOptions);
      $('#cboType').val(localStorage.getItem('cboType')).trigger('change');
    }
    if(localStorage.getItem('cboUser')){
      // $('#cboUser').append(todosOptions);
      $('#cboUser').val(localStorage.getItem('cboUser')).trigger('change');
    }
    if(localStorage.getItem('cboAnio')){
      // $('#cboAnio').append(todosOptions);
      $('#cboAnio').val(localStorage.getItem('cboAnio')).trigger('change');
    }
    if(localStorage.getItem('cboMes')){
      // $('#cboMes').append(todosOptions);
      $('#cboMes').val(localStorage.getItem('cboMes')).trigger('change');
    }
    if(localStorage.getItem('cboDia')){
      // $('#cboDia').append(todosOptions);
      $('#cboDia').val(localStorage.getItem('cboDia')).trigger('change');
    }
    if(localStorage.getItem('cboEstado')){
      // $('#cboEstado').append(todosOptions);
      $('#cboEstado').val(localStorage.getItem('cboEstado')).trigger('change');
    }
});

</script>

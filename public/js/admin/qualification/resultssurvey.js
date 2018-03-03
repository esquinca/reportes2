$(function() {
  $("#selectfiltro").hide();
  $("#filter_year").hide();
  $("#filter_month").hide();
  $("#filter_vertical").hide();
  $("#filter_operation").hide();
  $("#filter_average").hide();
  $("#tfoot_average").hide();
  $('#filasasw')[0].reset();
});

$('#boton_muestra_selectfiltro').on('click', function() {
 	$("#selectfiltro").show(10);
});
$(".selectFiltro").change(function() {
	mostraryreordenar($( this).val(), $("#filtration_container") );
});
function mostraryreordenar(identifier, contentElements)
{
  contentElements.append( $('#'+identifier) ); //Para mover el div
	$('#'+identifier).show(300);
  $("#selectfiltro").hide(100);
  $('#selectfiltro').prop('selectedIndex',0);
}
$(".boton-mini").click(function(event) {
   var identifier = $(this).closest( $( ".control-filter" ) );
	 ocultaryreordenar(identifier);
});
function ocultaryreordenar(element)
{
	element.hide(100);
  element.find('select').prop('selectedIndex',0);
}
$('#boton_muestra_selectfiltro').on('click', function() {
 	$("#selectfiltro").show(10);
});

$("#boton-aplica-filtro-visitantes").click(function(event) {
	 var objData = $("#filasasw").find("select,textarea, input").serialize();
   var _token = $('input[name="_token"]').val();
   $.ajax({
      url: "/survey_viewresults",
      type: "POST",
      data: objData,
      success: function (data) {
        if ($('#searchaverage').val()=== '0') {
          //console.log(data);
          tablaEnc(data, $("#table_qualification") , 0);
          // $("#tfoot_average").hide();
          // modTableCali();
        }
        else {
          // tablaEnctwo(data, $("#example1") , 0);
          // $("#tfoot_average").show();
          // modTableCali();
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
});

function searchfechas (identificador){
  switch (identificador) {
    case '1':
      return $fecha = '<i class = "fa fa-arrow-up"></i>';
    break;
    case '2':
      return $fecha = '<i class = "fa fa-arrow-down"></i>';
    break;
    case '3':
      return $fecha = '<i class = "fa fa-arrow-right"></i>';
    break;
    case '4':
      return $fecha = '<i class = "fa fa-arrow-right"></i>';
    break;
    case '5':
      return $fecha = '<i class = "fa fa-window-close"></i>';
    break;
    case '':
      return $fecha = '<i class = "fa fa-window-close"></i>';
  }
}

function tablaEnc(datajson, table, order){
  table.DataTable().destroy();
  var vartable = table.dataTable({
    dom: "<'row'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [
      {
        extend: 'excelHtml5',
        text: '<i class="fa fa-file-excel-o"></i> Extraer a Excel',
        titleAttr: 'Excel',
        className: 'btn btn-info custombtntable',
      },
      {
        extend: 'csvHtml5',
        text: '<i class="fa fa-file-text-o"></i> Extraer a CSV',
        titleAttr: 'CSV',
        className: 'btn btn-danger',
      }
    ],
    "order": [[ order, "asc" ]],
    language:{
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "<i class='fa fa-search'></i> Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },
    "columnDefs": [
      {
      "targets": 0,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData === 'Aeropuerto' ) {
            $(td).css('background-color', '#7030A0').css('color', 'white').css('font-weight', 'bold');
          }
          if ( cellData === 'Educación' ) {
            $(td).css('background-color', '#0070C0').css('color', 'white').css('font-weight', 'bold');
          }
          if ( cellData === 'Eventos' ) {
            $(td).css('background-color', '#2e4053').css('color', 'white').css('font-weight', 'bold');
          }
          if ( cellData === 'Hospitalidad' ) {
            $(td).css('background-color', '#008081').css('color', 'white').css('font-weight', 'bold');
          }
          if ( cellData === 'MB' ) {
            $(td).css('background-color', '#a93226').css('color', 'white').css('font-weight', 'bold');
          }
          if ( cellData === 'Oficinas' ) {
            $(td).css('background-color', '#333F4F').css('color', 'white').css('font-weight', 'bold');
          }
          if ( cellData === 'Parques' ) {
            $(td).css('background-color', '#92D050').css('color', 'white').css('font-weight', 'bold');
          }
          if ( cellData === 'Plaza' ) {
            $(td).css('background-color', '#757171').css('color', 'white').css('font-weight', 'bold');
          }
          if ( cellData === 'Restaurantes' ) {
            $(td).css('background-color', '#B40431').css('color', 'white').css('font-weight', 'bold');
          }
          if ( cellData === 'Retail' ) {
            $(td).css('background-color', '#F7AC25').css('color', 'white').css('font-weight', 'bold');
          }
          if ( cellData === 'Kidzania' ) {
            $(td).css('background-color', '#FFD966').css('color', 'white').css('font-weight', 'bold');
          }
          if ( cellData === 'Transporte' ) {
            $(td).css('background-color', '#FF4000').css('color', 'white').css('font-weight', 'bold');
          }
        }
      },
      {
        "targets": 1,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
      },
      {
        "targets": 2,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
       },
      {
        "targets": 3,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
       },
      {
        "targets": 4,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
      },
      {
        "targets": 5,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
      },
      {
        "targets": 6,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
       },
      {
        "targets": 7,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
       },
      {
        "targets": 8,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
       },
      {
        "targets": 9,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
      },
      {
        "targets": 10,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
      },
      {
        "targets": 11,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
      },
      {
        "targets": 12,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
      },
      {
        "targets": 13,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
      },
      {
        "targets": 15,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData > 8 ) {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData >= 1 && cellData <= 6 ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
          if ( cellData > 6 && cellData <= 8 ) {
             $(td).css('background-color', '#F8FB68').css('color', '#D18106').css('font-weight', 'bold');
          }
          if(cellData <= 0){
            $(td).css('background-color', '#cfcfcf');
          }
        }
      },
      {
        "targets": 16,
        "createdCell": function (td, cellData, rowDat1a, row, col) {
          if ( cellData == '🖒') {
            $(td).css('background-color', '#DFF2BF').css('color', 'green').css('font-weight', 'bold');
          }
          if (cellData === '☞'  ) {
            $(td).css('background-color', '#F8FB68').css('color', 'black').css('font-weight', 'bold');
          }
          if ( cellData ==='👎' ) {
            $(td).css('background-color', '#ff8a8a').css('color', 'red').css('font-weight', 'bold');
          }
        }
      }
    ],
  });
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    vartable.fnAddData([
      status.Vertical,
      status.Nombre_hotel,
      status.a12,//Enero
      status.a11,
      status.a10,
      status.a9,
      status.a8,
      status.a7,
      status.a6,
      status.a5,
      status.a4,
      status.a3,
      status.a2,
      status.a1,//Diciembre
      status.anio,
      status.NPS,
      searchfechas(status.Indicator),
      status.Assigned_IT,
      '<a href="javascript:void(0);" onclick="enviar(this)" value="'+status.id_comment+'" class="btn btn-default btn-sm" role="button" data-target="#modal-edithotcl"><span class="fa fa-comments"></span></a>',
      ]);
    });
}
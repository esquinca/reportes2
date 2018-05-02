$(function() {
    $(".select2").select2();
    general_table_equipment();
});
$('#select_one').on('change', function(e){
  var id= $(this).val();
  if (id != ''){
    general_table_equipment();
  }
  else {
    menssage_toast('Mensaje', '2', 'Seleccione un hotel!' , '3000');
    general_table_equipment();
  }
});

function general_table_equipment() {
  var _token = $('input[name="_token"]').val();
  var indent = $('#select_one').val();
  $.ajax({
      type: "POST",
      url: "/search_rem_equipament_hotel",
      data: { ident: indent,_token : _token },
      success: function (data){
        table_move_equipament(data, $("#table_move"), $("#table_check"));
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
}

function table_move_equipament(datajson, table, form){
      table.DataTable().destroy();
      var vartable = table.dataTable(Configuration_table_responsive_checkbox_move);
      vartable.fnClearTable();
      $.each(JSON.parse(datajson), function(index, status){
        vartable.fnAddData([
          status.idequipo,
          status.Nombre_hotel,
          status.name,
          status.Nombre_marca,
          status.MAC,
          status.Serie,
          status.ModeloNombre,
          "<center><kbd style='background-color:grey'>"+status.Nombre_estado+"</kbd></center>",
          status.Fecha_Registro,
          '<a href="javascript:void(0);" onclick="enviar(this)" value="'+status.idequipo+'" class="btn btn-info btn-xs" role="button" data-target="#EditarServ"><i class="fa fa-pencil-square-o margin-r5"></i></a>',
        ]);
      });
}


$(".btnconf").on("click", function () {
  var rows_selected = $("#table_move").DataTable().column(0).checkboxes.selected();
  var _token = $('input[name="_token"]').val();
   // Iterate over all selected checkboxes
   var valores= new Array();
   $.each(rows_selected, function(index, rowId){
      valores.push(rowId);
  });
  var hotel_destino = $('#select_two').val();
  var estatus = $('#select_three').val();

  if ( valores.length === 0 || hotel_destino == '' || estatus == ''){
    menssage_toast('Mensaje', '2', 'Seleccione uno o mas equipos a mover, un hotel de destino y un estatus, para continuar!' , '3000');
  }
  else {
    $('#modal-confirmation').modal('show');
  }
});

$(".btn-conf-action").click(function(event) {
  var rows_selected = $("#table_move").DataTable().column(0).checkboxes.selected();
  var _token = $('input[name="_token"]').val();
   // Iterate over all selected checkboxes
   var valores= new Array();
   $.each(rows_selected, function(index, rowId){
      valores.push(rowId);
  });
  //Extract required data
  var hotel_destino = $('#select_two').val();
  var estatus = $('#select_three').val();

  $.ajax({
      type: "POST",
      url: "/send_item_move_hotels",
      data: { idents: JSON.stringify(valores), destino: hotel_destino, estatus: estatus, _token : _token },
      success: function (data){
        if (data === 'true') {
          $('#modal-confirmation').modal('toggle');
          menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
          general_table_equipment();
          $('#select_two').val('').trigger('change');
          $('#select_three').val('999').trigger('change');
        }
        if (data === 'false') {
          $('#modal-confirmation').modal('toggle');
           menssage_toast('Mensaje', '2', 'Operation Abort!' , '3000');
           $('#select_two').val('').trigger('change');
           $('#select_three').val('999').trigger('change');
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
});;

function enviar(e){
  var valor= e.getAttribute('value');
  var _token = $('input[name="_token"]').val();
  $.ajax({
       type: "POST",
       url: '/search_item_descript_hotels',
       data: {sector : valor, _token : _token},
       success: function (data) {
         console.log(data);
         if (data != '' && data != '[]') {
           var data_new = JSON.parse(data);
           $('#modal-comments').modal('show');
           $('#token_min').val(data_new.id);
           $('#comment_a').val(data_new.description);
         }
         else {
           menssage_toast('Mensaje', '2', 'Operation Abort!' , '3000');
         }
       },
       error: function (data) {
         alert('Error:', data);
       }
   })
}

$(".btn-update-descrip").click(function(event) {
  var _token = $('input[name="_token"]').val();
  var id_equipo = $('#token_min').val();
  var description = $('#comment_a').val();
  $.ajax({
      type: "POST",
      url: "/save_description_move_hotels",
      data: { tokensito: id_equipo, descript: description, _token : _token },
      success: function (data){
        if (data === 'true') {
          $('#modal-comments').modal('toggle');
          menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
          general_table_equipment();
        }
        else {
          $('#modal-comments').modal('toggle');
           menssage_toast('Mensaje', '2', 'Operation Abort!' , '3000');
           general_table_equipment();
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
});;

$(function () {
  table_provider();

});
$(".create_provider").on("click", function () {
  var objData = $("#reg_provider").find("select,textarea, input").serialize();
  alert(objData);
  // $.ajax({
  //      type: "POST",
  //      url: '/',
  //      data: objData,
  //      success: function (data) {
  //        if (data == 'true') {
  //          $('#add_provider').modal('toggle');
  //          menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
  //        }
  //        if (data == 'false') {
  //           menssage_toast('Mensaje', '2', 'You do not have permission to access this module, please refer to your system administrator!' , '3000');
  //        }
  //      },
  //      error: function (data) {
  //        menssage_toast('Mensaje', '2', 'Operation Abort- Changes not made' , '3000');
  //      }
  //  })
});

function table_provider() {
  // var _token = $('input[name="_token"]').val();
  // $.ajax({
  //     type: "POST",
  //     url: "/",
  //     data: { _token : _token },
  //     success: function (data){
      var data = JSON.stringify([{id:'1', rfc:'Zyxel', fiscal:'Persona Moral', estado:'Quintana Roo'},
        {id:'2', rfc:'Fibremex', fiscal:'Persona Fisica', estado:'Quintana Roo'},
        {id:'3', rfc:'Anixter', fiscal:'Persona Moral', estado:'Quintana Roo'}
      ]);

        table_consumption_dow(data, $("#table_providers"));
      // },
      // error: function (data) {
      //   console.log('Error:', data);
      // }
  // });
}

function table_consumption_dow(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    vartable.fnAddData([
      status.rfc,
      status.fiscal,
      status.estado,
      '<a href="javascript:void(0);" onclick="enviaredit(this)" value="'+status.id+'" class="btn btn-primary btn-xs" role="button" data-target="#EditServ"><i class="fa fa-pencil margin-r5"></i> Editar</a><a href="javascript:void(0);" onclick="enviardelet(this)" value="'+status.id+'" class="btn btn-danger btn-xs" role="button" data-target="#DeletServ"><i class="fa fa-trash-o margin-r5"></i> Eliminar</a>',
    ]);
  });
}

function enviaredit(e) {
  var valor= e.getAttribute('value');
  $('#rec_provider').val(valor);
  $('#edit_provider').modal('show');
}
function enviardelet(e) {
  var valor= e.getAttribute('value');
  $('#recibidoconf').val(valor);
  $('#del_provider').modal('show');
}

$(".btndelete").on("click", function () {
  var objData = $("#deleteprovidersystem").find("select,textarea, input").serialize();
  var id = $('#recibidoconf').val();
  $.ajax({
       type: "POST",
       url: '/',
       data: objData,
       success: function (data) {
         if (data == 'abort') {
            $('#del_provider').modal('toggle');
            menssage_toast('Mensaje', '2', 'Operation Abort- The current user can not be removed' , '3000');
         }
         if (data == 'true') {
           $('#del_provider').modal('toggle');
           menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
         }
         if (data == 'false') {
           $('#del_provider').modal('toggle');
           menssage_toast('Mensaje', '2', 'You do not have permission to access this module, please refer to your system administrator!' , '3000');
         }
       },
       error: function (data) {
         menssage_toast('Mensaje', '2', 'Operation Abort- Changes not made' , '3000');
       }
   })
});
$(".update_data").on("click", function () {
  var objData = $("#ed_provider").find("select,textarea, input").serialize();
  alert(objData);
  $.ajax({
       type: "POST",
       url: '/',
       data: objData,
       success: function (data) {
         if (data == 'true') {
           $('#edit_provider').modal('toggle');
           menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
         }
         if (data == 'false') {
            menssage_toast('Mensaje', '2', 'You do not have permission to access this module, please refer to your system administrator!' , '3000');
         }
       },
       error: function (data) {
         menssage_toast('Mensaje', '2', 'Operation Abort- Changes not made' , '3000');
       }
   })
});

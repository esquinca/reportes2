$(function () {
  table_provider();
});
$(".create_provider").on("click", function () {
  let provider_rfc = $('#provider_rfc').val();
  let provider_name = $('#provider_name').val();
  let provider_tf = $('#provider_tf').val();
  let provider_address = $('#provider_address').val();
  let provider_estate = $('#provider_estate').val();
  let provider_country = $('#provider_country').val();

  var objData = $("#reg_provider").find("select,textarea, input").serialize();

  if (provider_rfc === "" || provider_name === "" || provider_tf === "" || provider_address === "" || provider_estate === "" || provider_country === "") {
    menssage_toast('Mensaje', '2', 'Por favor complete todos los campos con "*"' , '3000');
  }else{
    $.ajax({
      type: "POST",
      url: '/insertProveedor',
      data: objData,
      success: function (data) {
        //console.log(data);
        if (data === "1") {
          menssage_toast('Mensaje', '4', 'Datos insertados con exito' , '3000');
          $('#add_provider').modal('toggle');
          table_provider();
          clean_modal();
        }else{

          menssage_toast('Mensaje', '2', 'Hubo un error en la insercion, vuelva a intentar.' , '3000');
        }
      },
      error: function (data) {
       menssage_toast('Mensaje', '2', 'Operation Abort- Changes not made' , '3000');
      }
    })

  }

});

$(".delete_provider").on("click", function () {
  clean_modal();
});

function clean_modal() {
  $('#provider_rfc').val("");
  $('#provider_name').val("");
  $('#provider_tf').val("");
  $('#provider_address').val("");
  $('#provider_estate').val("");
  $('#provider_country').val("");
  $('#provider_municipality').val("");
  $('#provider_postcode').val("");
  $('#provider_phone').val("");
  $('#provider_fax').val("");
  $('#provider_email').val("");
  $('#agent_name').val("");
  $('#agent_phone').val("");
}

function table_provider() {
  var _token = $('input[name="_token"]').val();
  // var data = JSON.stringify([{id:'1', rfc:'Zyxel', fiscal:'Persona Moral', estado:'Quintana Roo'},
  //   {id:'2', rfc:'Fibremex', fiscal:'Persona Fisica', estado:'Quintana Roo'},
  //   {id:'3', rfc:'Anixter', fiscal:'Persona Moral', estado:'Quintana Roo'}
  // ]);
  $.ajax({
      type: "POST",
      url: "/getTableProvider",
      data: { _token : _token },
      success: function (data){

        table_provider_fun(data, $("#table_providers"));
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
}

function table_provider_fun(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    vartable.fnAddData([
      status.rfc,
      status.regimen_Fiscal,
      status.estado,
      '<a href="javascript:void(0);" onclick="enviaredit(this)" value="'+status.id+'" class="btn btn-primary btn-xs" role="button" data-target="#EditServ"><i class="fa fa-pencil margin-r5"></i> Editar</a><a href="javascript:void(0);" onclick="enviardelet(this)" value="'+status.id+'" class="btn btn-danger btn-xs" role="button" data-target="#DeletServ"><i class="fa fa-trash-o margin-r5"></i> Eliminar</a>',
    ]);
  });
}

function enviaredit(e) {
  var _token = $('input[name="_token"]').val();
  var valor= e.getAttribute('value');
  $('#rec_provider').val(valor);
  $('#edit_provider').modal('show');

  $.ajax({
    type: "POST",
    url: "/show_updateinfo",
    data: { rec_provider : valor, _token: _token},
    success: function (data){
      //console.log(data);
      var datosJ = JSON.parse(data);
      //console.log(datosJ);
      $('#provider_name1').val(datosJ[0].nombre);
      $('#provider_rfc1').val(datosJ[0].rfc);
      $('#provider_address1').val(datosJ[0].direccion);
      $('#provider_tf1').val(datosJ[0].regimen_Fiscal);
      $('#provider_municipality1').val(datosJ[0].municipio);
      $('#provider_estate1').val(datosJ[0].estado);
      $('#provider_country1').val(datosJ[0].pais);
      $('#provider_postcode1').val(datosJ[0].cp);
      $('#provider_phone1').val(datosJ[0].telefono);
      $('#provider_fax1').val(datosJ[0].fax);
      $('#provider_email1').val(datosJ[0].email);
      $('#agent_name1').val(datosJ[0].agente_nombre);
      $('#agent_phone1').val(datosJ[0].agente_telefono);
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });

}
function enviardelet(e) {
  var valor= e.getAttribute('value');
  $('#recibidoconf').val(valor);
  $('#del_provider').modal('show');
}

$(".btndelete").on("click", function () {
  var objData = $("#deleteprovidersystem").find("select,textarea, input").serialize();
  //var id = $('#recibidoconf').val();
  //alert(id);
  $.ajax({
       type: "POST",
       url: '/delete_provider',
       data: objData,
       success: function (data) {
        console.log(data);
        if (data == '1') {
          $('#del_provider').modal('toggle');
          table_provider();
          menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
        }else{
          $('#del_provider').modal('toggle');
          menssage_toast('Mensaje', '2', 'There seems to be an error, try again later.' , '3000');        
        }
       },
       error: function (data) {
        console.log(data);
        $('#del_provider').modal('toggle');
        menssage_toast('Mensaje', '2', 'Operation Abort- Changes not made' , '3000');
       }
   })
});

$(".update_data").on("click", function () {
  var objData = $("#ed_provider").find("select,textarea, input").serialize();

  let provider_rfc = $('#provider_rfc1').val();
  let provider_name = $('#provider_name1').val();
  let provider_tf = $('#provider_tf1').val();
  let provider_address = $('#provider_address1').val();
  let provider_estate = $('#provider_estate1').val();
  let provider_country = $('#provider_country1').val();

  if (provider_rfc === "" || provider_name === "" || provider_tf === "" || provider_address === "" || provider_estate === "" || provider_country === "") {
    menssage_toast('Mensaje', '2', 'Por favor complete todos los campos con "*"' , '3000');
  }else{    
    $.ajax({
      type: "POST",
      url: '/update_provider',
      data: objData,
      success: function (data) {
        //console.log(data);
        if (data == '1') {
          $('#edit_provider').modal('toggle');
          table_provider();
          menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
        }else{
          $('#edit_provider').modal('toggle');
          menssage_toast('Mensaje', '2', 'There seems to be an error, try again later.' , '3000');        
        }
      },
      error: function (data) {
        console.log(data);
        $('#edit_provider').modal('toggle');
        menssage_toast('Mensaje', '2', 'Operation Abort- Changes not made' , '3000');
      }
    });
  }
});

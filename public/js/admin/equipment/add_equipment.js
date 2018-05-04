$(function() {
  $(".select2").select2({ width: '80%' });

  $('input[type="radio"]').prop('checked', false); // Unchecks it

  $('input[type="radio"]').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass   : 'iradio_square-blue',
    increaseArea : '20%' // optionales
  });

  $('input[name="facturitha"]').on('ifClicked', function (event) {
    if (this.value == 'yes') {
      $('.data_fact').show();
      $('.data_equipament').show();
      $('.data_temporal').show();
      reset_fact();
      $('#form_marca')[0].reset();
      $('#form_model')[0].reset();
      $('#reg_provider')[0].reset();
    }
    if (this.value == 'no') {
      $('.data_fact').hide();
      $('.data_equipament').show();
      $('.data_temporal').show();
      reset_fact();
      $('#form_marca')[0].reset();
      $('#form_model')[0].reset();
      $('#reg_provider')[0].reset();
    }
  });

  $('#date_fact').datepicker({
      language: 'es',
      defaultDate: '',
      format: "yyyy-mm-dd",
      autoclose: true
  });

  $('input[name="grupitho"]').typeahead({
    minLength: 0,
    items: 9999,
    source: function(query, process) {
      console.log(query);
        return $.ajax({
            url: "/search_key_group",
            type: 'post',
            data: {key: query, _token : $('input[name="_token"]').val()},
            success: function(data) {
              var dataArray = [];
              $.each(JSON.parse(data), function(index, status){
                dataArray.push(status.Nombre_Grupo);
              });
              console.log(dataArray);
              // var json = JSON.parse(data); // string to json
              return process(dataArray);
              //console.log(json);
            }
        });
    }
  });

  var vartable = $("#table_temporality").dataTable(Configuration_table_clearx2);

});

function reset_fact() {
  $('#nfactura').val('');
  $('#date_fact').val('');
  reset_select2('select_one');
}

function reset_select2(name_d){
  $('#'+name_d).val('').trigger('change');
}

$(".close_marca").on("click", function () { $('#form_marca')[0].reset(); });
$(".close_model").on("click", function () { $('#form_model')[0].reset(); });
$(".delete_provider").on("click", function () { $('#reg_provider')[0].reset(); });

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
          recargar_proveedor();
          $('#reg_provider')[0].reset();
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
function recargar_proveedor(){
  var _token = $('input[name="_token"]').val();
  let count = 0;
  $.ajax({
    type: "POST",
    url: '/search_provider',
    data: { _token : _token },
    success: function (data) {
      countH = data.length;
      $('#select_one').empty();
      $('#select_one').append('<option value="" selected>Elije</option>');
      if (countH > 0) {
        $.each(JSON.parse(data),function(index, objdata){
          $('#select_one').append('<option value="'+objdata.id+'">'+ objdata.nombre +'</option>');
        });
      }
    },
    error: function (data) {
     menssage_toast('Mensaje', '2', 'Operation Abort- Changes not made' , '3000');
    }
  })
}

$('#type_equipment').on('change', function(e){
  var id= $(this).val();
  var _token = $('input[name="_token"]').val();

  if (id != ''){
    let parsed;
    let countH = 0;
      $.ajax({
        type: "POST",
        url: "./search_marcas",
        data: { numero : id , _token : _token },
        success: function (data){
          countH = data.length;
          if (countH === 0) {
            $('#Marcas').empty();
            $('#Marcas').append('<option value="" selected>Elija</option>');

            $('#mmodelo').empty();
            $('#mmodelo').append('<option value="" selected>Elija</option>');

          }else{
            $('#Marcas').empty();
            $('#Marcas').append('<option value="" selected>Elija</option>');
            $.each(JSON.parse(data),function(index, objdata){
              $('#Marcas').append('<option value="'+objdata.id+'">'+ objdata.Nombre_marca +'</option>');
            });

            $('#mmodelo').empty();
            $('#mmodelo').append('<option value="" selected>Elija</option>');
          }
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
  }
  else {
      $('#Marcas').empty();
      $('#Marcas').append('<option value="" selected>Elije</option>');
      $("#Marcas").select2({placeholder: "Elija", width: '80%'});

      $('#mmodelo').empty();
      $('#mmodelo').append('<option value="" selected>Elije</option>');
      $("#mmodelo").select2({placeholder: "Elija", width: '80%'});
  }
});

$('#Marcas').on('change', function(e){
  var id= $(this).val();
  var _token = $('input[name="_token"]').val();

  if (id != ''){
    let parsed;
    let countH = 0;
      $.ajax({
        type: "POST",
        url: "./search_modelo",
        data: { numero : id , _token : _token },
        success: function (data){
          countH = data.length;
          if (countH === 0) {
            $('#mmodelo').empty();
            $('#mmodelo').append('<option value="" selected>Elija</option>');
          }else{
            $('#mmodelo').empty();
            $('#mmodelo').append('<option value="" selected>Elija</option>');
            $.each(JSON.parse(data),function(index, objdata){
              $('#mmodelo').append('<option value="'+objdata.id+'">'+ objdata.ModeloNombre +'</option>');
            });
          }
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
  }
  else {
      $('#mmodelo').empty();
      $('#mmodelo').append('<option value="" selected>Elije</option>');
      $("#mmodelo").select2({placeholder: "Elija", width: '80%'});
  }
});
function reset_modelithos(){
  var id= $('#Marcas').val();
  var _token = $('input[name="_token"]').val();
  $.ajax({
    type: "POST",
    url: "./search_modelo",
    data: { numero : id , _token : _token },
    success: function (data){
      countH = data.length;
      if (countH === 0) {
        $('#Modelo').empty();
        $('#Modelo').append('<option value="" selected>Elija</option>');
      }else{
        $('#Modelo').empty();
        $('#Modelo').append('<option value="" selected>Elija</option>');
        $.each(JSON.parse(data),function(index, objdata){
          $('#Modelo').append('<option value="'+objdata.id+'">'+ objdata.ModeloNombre +'</option>');
        });
      }
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}
$(".btn_rmd").on("click", function () {
  $('#form_model')[0].reset();
  var _token = $('input[name="_token"]').val();
  let count = 0;
  $.ajax({
    type: "POST",
    url: '/search_marca_all',
    data: { _token : _token },
    success: function (data) {
      countH = data.length;
      $('#marcas_current').empty();
      $('#marcas_current').append('<option value="" selected>Elije</option>');
      if (countH > 0) {
        $.each(JSON.parse(data),function(index, objdata){
          $('#marcas_current').append('<option value="'+objdata.id+'">'+ objdata.Nombre_marca +'</option>');
        });
      }
    },
    error: function (data) {
     menssage_toast('Mensaje', '2', 'Operation Abort- Changes not made' , '3000');
    }
  })
});

$(".create_model").on("click", function () {
  let modelitho = $('#add_modelitho').val();
  let marquithas_p = $('#marcas_current').val();
  var objData = $("#form_model").find("select,textarea, input").serialize();
  if (modelitho === "" || marquithas_p === "") {
    menssage_toast('Mensaje', '2', 'Por favor complete todos los campos' , '3000');
  }else{
    $.ajax({
      type: "POST",
      url: '/insertModel',
      data: objData,
      success: function (data) {
        if (data === "1") {
          menssage_toast('Mensaje', '4', 'Datos insertados con exito' , '3000');
          $('#add_modelo').modal('toggle');
          reset_modelithos();
          $('#form_model')[0].reset();
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
function reset_fact() {
  $('#nfactura').val('');
  $('#date_fact').val('');
  reset_select2('select_one');
}

$(".btn-save").on("click", function () {
    var type = $("#type_equipment").select2('data')[0]['text'];
    var marca = $("#Marcas").select2('data')[0]['text'];
    var venue = $("#venue").select2('data')[0]['text'];
    var serie = $("#add_num_se").val();
    var mac = $('#add_mac_eq').val();
    var descripcion = $('#add_descrip').val();
    var grupo =$('#grupitho').val();

    if ( ! $('#table_temporality').DataTable().data().count() ) {

        $('#table_temporality').DataTable().destroy();
        $('#table_temporality').DataTable(Configuration_table_clearx2).row.add( [
          venue,
          type,
          marca,
          mac,
          serie,
          grupo,
          descripcion
        ] ).draw( false );
    }
    else {
      $('#table_temporality').DataTable().row.add( [
        venue,
        type,
        marca,
        mac,
        serie,
        grupo,
        descripcion
      ] ).draw();
    }


});

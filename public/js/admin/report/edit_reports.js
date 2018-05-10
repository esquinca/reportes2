$(function () {
  $(".select2").select2();
});
$('#date_type_device').datepicker({
  language: 'es',
  format: "yyyy-mm-dd",
  autoclose: true,
  endDate: '-1d'
});
$('#date_type_banda').datepicker({
  language: 'es',
  format: "yyyy-mm-dd",
  autoclose: true,
  endDate: '-1d'
});
$('#date_trans_gb').datepicker({
  language: 'es',
  format: "yyyy-mm-dd",
  autoclose: true,
  endDate: '-1d'
});
$('#date_trans_user').datepicker({
  language: 'es',
  format: "yyyy-mm-dd",
  autoclose: true,
  endDate: '-1d'
});

$('#select_onet').on('change', function(e){
  var id= $(this).val();
  var _token = $('input[name="_token"]').val();
  if (id != ''){
    $.ajax({
      type: "POST",
      url: "./search_info_zdhtl",
      data: { numero : id , _token : _token },
      success: function (data){
        if (data === '[]') {
          $('#select_two_zd').empty();
          $('#select_two_zd').append('<option value="" selected>Elija</option>');
          $('#select_two_zd').append('<option value="5000">Default</option>');
        }
        else{
          $('#select_two_zd').empty();
          $('#select_two_zd').append('<option value="" selected>Elija</option>');
          $.each(JSON.parse(data),function(index, objdata){
            $('#select_two_zd').append('<option value="'+objdata.id+'">'+ objdata.ip +'</option>');
          });
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
  }
  else {
    $('#select_two_zd').empty();
    $('#select_two_zd').append('<option value="" selected>Elija</option>');
  }
});

$('#select_two_zd').on('change', function(e){
  var id= $(this).val();
  var _token = $('input[name="_token"]').val();
  if (id != ''){
    var hotel = $('#select_onet').val();
    var date = $('#date_trans_gb').val();
    if (hotel == '' || date == "") {
      $('#select_two_zd').val('').trigger('change');
      menssage_toast('Mensaje', '2', 'Operation Abort!- Necesita seleccionar primero la fecha y luego el hotel.' , '3000');
    }
    else{
      $.ajax({
        type: "POST",
        url: "./search_infogb",
        data: { zd : id , dt : date , htl : hotel , _token : _token },
        success: function (data){
          if (data === '[]') {
            $('#date_trans_gb').val('');
             menssage_toast('Mensaje', '2', 'Dia no capturado' , '3000');
             $('#date_trans_gb').val('');
             $('#date_trans_gb').datepicker('setDate', null);
             $('#select_two_zd').val('').trigger('change');
          }
          else {
            var data_new = JSON.parse(data);
            $('#date_trans_gb').val(data_new[0].gb);
          }
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    }
  }
  else {
    $('#date_trans_gb').val('');
  }
});

function validarSelect(campo) {
  if (campo != '') {
    select=document.getElementById(campo).selectedIndex;
    if( select == null || select == 0 ) {
      return false;
    }
    else {
      return true;
    }
  }
  else {
    return false;
  }
}
function validarespacioinputlength(campo, campob){
  if( $("#"+campo).val().trim()==='' || $("#"+campo).val().length < campob ) {
    return false;
  }
  else {
    return true;
  }
}
$('#generateGbInfo').on('click', function(e){
  var _token = $('input[name="_token"]').val();
  $obligatorio_a = validarespacioinputlength('date_trans_gb', 10);
  $obligatorio_b = validarSelect('select_onet');
  $obligatorio_c = validarSelect('select_two_zd');
  $obligatorio_d = validarespacioinputlength('newdata_trans_gb',1);
  if ($obligatorio_a == true && $obligatorio_b == true && $obligatorio_c == true && $obligatorio_d == true) {
    var hotel = $('#select_onet').val();
    var date = $('#date_trans_gb').val();
    var ip = $('#select_two_zd').val();
    var new_gb = $('#newdata_trans_gb').val();
    $.ajax({
      type: "POST",
      url: "./update_infogb",
      data: { htl : hotel, dt : date, zd : ip, gb : new_gb, _token : _token },
      success: function (data){
        if (data === '1') {
          $('#select_onet').val('').trigger('change');
          $('#select_two_zd').val('').trigger('change');
          $('#form_gb')[0].reset();
          menssage_toast('Mensaje', '4', 'Datos actualizados con exito' , '3000');
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
  }
  else {
    menssage_toast('Mensaje', '2', 'Completa los datos de obligatorios (*)' , '3000');
  }
});
$('#generateGbClear').on('click', function(e){
  $('#select_onet').val('').trigger('change');
  $('#select_two_zd').val('').trigger('change');
  $('#form_gb')[0].reset();
});
/*
 get_gb_venue_edit
*/

$('#select_one_device').on('change', function(e){
  var id= $(this).val();
  var date = $('#date_trans_user').val();
  var _token = $('input[name="_token"]').val();
  if (id != ''){
    $.ajax({
      type: "POST",
      url: "./search_info_user",
      data: { htl : id , dt: date, _token : _token },
      success: function (data){
        if (data === '[]' || data === 'null') {
          $('#data_trans_user').val('');
          menssage_toast('Mensaje', '2', 'Dia no capturado' , '3000');
          $('#date_trans_user').val('');
          $('#date_trans_user').datepicker('setDate', null);
          $('#select_one_device').val('').trigger('change');
        }
        else {
          var data_new = JSON.parse(data);
          if (data_new[0].usuarios === 'null') { menssage_toast('Mensaje', '2', 'Dia no capturado' , '3000');  $('#date_trans_user').val(''); $('#date_trans_user').datepicker('setDate', null);}
          else { $('#data_trans_user').val(data_new[0].usuarios); }
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
  }
  else {
    $('#data_trans_gb').val('');
  }
});
$('#generateUserInfo').on('click', function(e){
  var _token = $('input[name="_token"]').val();
  $obligatorio_a = validarespacioinputlength('date_trans_user', 10);
  $obligatorio_b = validarSelect('select_one_device');
  $obligatorio_c = validarespacioinputlength('newdata_trans_user',1);
  if ($obligatorio_a == true && $obligatorio_b == true && $obligatorio_c == true) {
    var hotel = $('#select_one_device').val();
    var date = $('#date_trans_user').val();
    var new_user = $('#newdata_trans_user').val();
    $.ajax({
      type: "POST",
      url: "./update_infouser",
      data: { htl : hotel, dt : date, user : new_user, _token : _token },
      success: function (data){
        if (data === '1') {
          $('#select_one_device').val('').trigger('change');
          $('#form_user')[0].reset();
          menssage_toast('Mensaje', '4', 'Datos actualizados con exito' , '3000');
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
  }
  else {
    menssage_toast('Mensaje', '2', 'Completa los datos de obligatorios (*)' , '3000');
  }
});

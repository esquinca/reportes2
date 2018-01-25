$(function() {
  $(".select2").select2();
  $('.datepickermonth').datepicker({ language: 'es', format: "yyyy-mm", viewMode: "months", minViewMode: "months", autoclose: true, clearBtn: true });
  $('.datepickermonth').val('').datepicker('update');
});

$('#select_one').on('change', function(e){
  var id= $(this).val();
  var _token = $('input[name="_token"]').val();

  if (id != ''){
    let countTR = 0;
      $.ajax({
        type: "POST",
        url: "./typereport",
        data: { numero : id , _token : _token },
        success: function (data){
          //console.log(data);
          countTR = data.typereports.length;
          //console.log(countTR);

          if (countTR === 0) {
            //console.log('Nating');
            $('#select_two').empty();
            $('#select_two').append('<option value="" selected>Elije</option>');
          }else{
            $('#select_two').empty();
            $('#select_two').append('<option value="" selected>Elije</option>');

            for (var i = 0; i < countTR; i++) {
              console.log(data.typereports[i].name);
              $("#select_two option").prop("selected", false);
              $('#select_two').append('<option value="'+data.typereports[i].name+'" selected>'+ data.typereports[i].name +'</option>');
              $('#select_two').val(data.typereports[i].name).trigger('change');
            }

          }


          // $('#calendar_fecha').val('');
          // $('#calendar_fecha').datepicker('setDate', null);
          // $('#calendar_fecha').attr('disabled', false);
          //
          // $.each(JSON.parse(data),function(index, objdata){
          //   if (objdata.Nombre == 'Basico') {
          //     $("#select_two option").prop("selected", false);
          //     $('#select_two').append('<option value="'+objdata.Nombre+'" selected>'+ objdata.Nombre +'</option>');
          //     $('#select_two').val(objdata.Nombre).trigger('change');
          //   }
          //   else {
          //     $('#select_two').append('<option value="'+objdata.Nombre+'">'+ objdata.Nombre +'</option>');
          //   }
          // });
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
  }
  else {
      $('#select_two').empty();
      $('#select_two').append('<option value="" selected>Elije</option>');
      $("#select_two").select2({placeholder: "Elija"});
  }
});

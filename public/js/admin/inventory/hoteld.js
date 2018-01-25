$(function() {
  $(".select2").select2();
});

$('#select_one').on('change', function(e){
  var id= $(this).val();
  var _token = $('input[name="_token"]').val();

  if (id != ''){
    let parsed;
    let countH = 0;
      $.ajax({
        type: "POST",
        url: "./hotel_cadena",
        data: { numero : id , _token : _token },
        success: function (data){
          //console.log(data);
          countH = data.length;
          //console.log(data.length);
          if (countH === 0) {
            //console.log('Nating');
            $('#select_two').empty();
            $('#select_two').append('<option value="" selected>Elije</option>');
          }else{
            $('#select_two').empty();
            $('#select_two').append('<option value="" selected>Elije</option>');

            for (var i = 0; i < countH; i++) {
              // console.log(data[i].id);
              // console.log(data[i].Nombre_hotel);
              $("#select_two option").prop("selected", false);
              $('#select_two').append('<option value="'+data[i].id+'" selected>'+ data[i].Nombre_hotel +'</option>');
              $('#select_two').val(data[i].id).trigger('change');
            }

          }

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

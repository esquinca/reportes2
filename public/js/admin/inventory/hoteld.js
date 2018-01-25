$(function() {
  $(".select2").select2();
});

$('#select_one').on('change', function(e){
  var id= $(this).val();
  var _token = $('input[name="_token"]').val();

  if (id != ''){
    let countTR = 0;
      $.ajax({
        type: "POST",
        url: "./hotel_cadena",
        data: { numero : id , _token : _token },
        success: function (data){
          console.log(data);
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

$(function() {
	$(".select2").select2();
});

$('#select_one').on('change', function(){
	var select = $('#select_one').val();
	var _token = $('input[name="_token"]').val();
	console.log(select);

	$.ajax({
	  type: "POST",
	  url: "/getInfoZD",
	  data: { _token : _token, select : select },
	  success: function (data){
	    console.log(data);
	  },
	  error: function (data) {
	    console.log('Error:', data);
	  }
	});
	
});

$('#comprobarip').on('click', function(){
	var select = $('#select_one').val();
    var direc=$('#direccion_ip').val();
    var puert=$('#puerto_dir').val();
    var _token = $('input[name="_token"]').val();



	console.log('click');
});


$('#resetcomprobarip').on('click', function(){
	console.log('click');
});
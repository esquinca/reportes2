$(function() {
  $(".select2").select2();


});

// $('#select_one').on('change', function(e){
// });

$('#select_one').on('change', function(e){
	//$('#new_group').val('');
});



$('#btn_update_group').on('click', function(e){
	var newtext = $('#new_group').val();
	var select = $('#select_one').val();
	var inputmac = $('#mac_input').val();
	
	if (newtext != "" && select != "" && inputmac != "") {
		menssage_toast('Mensaje', '2', 'Elija que campo de grupo usar.' , '3000');
	}else if (newtext != "" && inputmac != "") {
		convertMac(inputmac);
		update_group(newtext, inputmac);
		emptySelect();
		update_select_group();
		$('#mac_input').focus();
	}else if (select != "" && inputmac != "") {
		convertMac(inputmac);
		update_group(select, inputmac);
		emptySelect();
		update_select_group();
		$('#mac_input').focus();
	}else if (newtext != "" || select != "") {
		menssage_toast('Mensaje', '2', 'Completa los campos necesarios.' , '3000');
	}else{
		menssage_toast('Mensaje', '2', 'Completa los campos necesarios.' , '3000');
	}

});

function convertMac(value) {
	//DBDBDBDBDBDB 5 espacios.
	//12 + 5 = 17
	//DB DB DB DB DB DB
	let status = 0;
	let newstr = "";
	var parts = []
	countstr = value.length;
	//console.log(value.length);
	if (countstr < 17) {
		parts = value.match(/[\s\S]{1,2}/g) || [];
		for (var i = 0; i < parts.length; i++) {
			newstr = newstr + parts[i] + ':';
		}
		//console.log(newstr);
		newstr = newstr.substr(0, newstr.length - 1);
		//console.log(newstr);
		return status = 1;
	}else if (countstr = 17) {
		return status = 1;
	}else{
		//console.log('string > 17');
		return status;
	}
	return status;
	// count = parts.length;
	// console.log(parts);
	// console.log(count);
}

function emptySelect() {
	$('#select_one').empty();
	$('#select_one').select2("destroy");
}

function update_select_group() {
	var _token = $('input[name="_token"]').val();
	dataselect = [];
	// var data_count = [{value:335, name:'Ap Stock = 335'},{value:310, name:'Ap Renta = 310'},{value:234, name:'Ap Prestamo = 234'},{value:135, name:'Ap Venta = 135'},{value:1315, name:'Ap Demo = 1315'},{value:1548, name:'SW Renta = 1548'}];

	$.ajax({
		type: "POST",
		url: "/get_new_groups",
		data: { _token : _token},
		success: function (data){
			//console.log(data);
			dataselect.push({id : "", text : "Elija"});
			$.each(JSON.parse(data), function(index, datos){
				dataselect.push({id: datos.Nombre_Grupo, text: datos.Nombre_Grupo});
			});
			//console.log(dataselect);
			$('#select_one').select2({
				data : dataselect
			});
		},
		error: function (data) {
		  console.log('Error:', data);
		}
	});
}


function update_group(datos, mac) {
	var _token = $('input[name="_token"]').val();
	$.ajax({
		type: "POST",
		url: "/update_group_equipment",
		data: { select1: datos, mac: mac, _token: _token },
		success: function (data){
		  //console.log(data);
		  if (data === '1') {
		  	menssage_toast('Mensaje', '4', 'Datos actualizados.' , '3000');
		  	refresh_table(datos, $('#table_group'));

		  	$('#select_one').val('').trigger('change');
		  	$('#mac_input').val("");

		  }else{
		  	menssage_toast('Mensaje', '2', 'Se encontro un error: Revisar la mac address.' , '3000');
		  }
		},
		error: function (data) {
		  console.log('Error:', data);
		}
	});
}

function refresh_table(group, table) {
	var _token = $('input[name="_token"]').val();
	$.ajax({
		type: "POST",
		url: "/get_table_group",
		data: { select1: group, _token: _token },
		success: function (data){
		  //console.log(data);
		  table_group_content(data, table);
		},
		error: function (data) {
		  console.log('Error:', data);
		}
	});
}

function table_group_content(datajson, table){
	table.DataTable().destroy();
	var vartable = table.dataTable(Configuration_table_responsive_with_pdf_enc_dominio);
	vartable.fnClearTable();
	$.each(JSON.parse(datajson), function(index, status){
	  table.fnAddData([
	    status.name,
	    status.MAC,
	    status.Serie,
	    status.Nombre_marca,
	    status.ModeloNombre
	  ]);
	});
}
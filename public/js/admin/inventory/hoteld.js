$(function() {
  $(".select2").select2();
  graph_aps();
  graph_equipment();
  graph_modelos();
  general_table_equipment();
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

function graph_aps() {
  var cadena= $('#select_one').val();
  var hotel= $('#select_two').val();
  // var _token = $('input[name="_token"]').val();
  var data_count = [{value:335, name:'Ap Stock = 335'},{value:310, name:'Ap Renta = 310'},{value:234, name:'Ap Prestamo = 234'},{value:135, name:'Ap Venta = 135'},{value:1315, name:'Ap Demo = 1315'},{value:1548, name:'SW Renta = 1548'}];
  var data_name = ["Ap Stock = 335","Ap Renta = 310","Ap Prestamo = 234","Ap Venta = 135","Ap Demo = 1315","SW Renta = 1548"];
  graph_pie_default_two('main_aps', data_name, data_count);

  // $.ajax({
  //     type: "POST",
  //     url: "/data_aps",
  //     data: { data_one : cadena,  data_two : hotel,  _token : _token },
  //     success: function (data){
  //       //alert(data);
  //       $.each(JSON.parse(data),function(index, objdata){
  //         data_name.push(objdata.Edades);
  //         data_count.push({ value: objdata.Cantidad, name: objdata.Edades},);
  //       });
  //       graph_pie_default('main_ages', data_name, data_count);
  //     },
  //     error: function (data) {
  //       console.log('Error:', data);
  //       alert('3');
  //     }
  // });
}

function graph_equipment() {
  var date= $('#date_search_pral').val();
  var _token = $('input[name="_token"]').val();
  var data_count = [{value:335, name:'Antenas = 335'},{value:310, name:'Smart Zone = 310'},{value:234, name:'Sonda = 234'},{value:135, name:'SW = 135'},{value:1315, name:'Zequenze = 1315'},{value:1548, name:'Zone Director = 1548'}];
  var data_name = ["Antenas = 335","Smart Zone = 310","Sonda = 234","SW = 135","Zequenze = 1315","Zone Director = 1548"];
  graph_barras_two('main_equipos', data_name, data_count);
  // $.ajax({
  //     type: "POST",
  //     url: "/data_nationality",
  //     data: { data : date,  _token : _token },
  //     success: function (data){
  //       //alert(data);
  //       $.each(JSON.parse(data),function(index, objdata){
  //         data_name.push(objdata.Nacionalidad);
  //         data_count.push(objdata.Cantidad);
  //       });
  //       graph_barras('main_equipos', data_name, data_count);
  //     },
  //     error: function (data) {
  //       console.log('Error:', data);
  //       alert('3');
  //     }
  // });
}

function graph_modelos() {
  var date= $('#date_search_pral').val();
  var _token = $('input[name="_token"]').val();
  var data_count = [120, 132, 101, 134, 90, 230, 210];
  var data_name = ["WS-C2960S-24PS-L","Smart Zone","FW7541D-NG1","GB-BACE-3150","GS2210-24HP","Zone Director"];


  graph_area_one_default('main_modelos', data_name, data_count);
  // $.ajax({
  //     type: "POST",
  //     url: "/data_nationality",
  //     data: { data : date,  _token : _token },
  //     success: function (data){
  //       //alert(data);
  //       $.each(JSON.parse(data),function(index, objdata){
  //         data_name.push(objdata.Nacionalidad);
  //         data_count.push(objdata.Cantidad);
  //       });
  //       graph_barras('main_equipos', data_name, data_count);
  //     },
  //     error: function (data) {
  //       console.log('Error:', data);
  //       alert('3');
  //     }
  // });
}
function general_table_equipment() {
  var _token = $('input[name="_token"]').val();
  var data =
  [{"equipo":"Switch","mac":"54:3D:37:0C:EE:90","serie":"911302002193","modelo":"WS-C2960S-24PS-L","descripcion":"HRPC-HAB_7352","marca":"Cisco","estado":"Activo","servicio":"Arrendamiento"},{"equipo":"Antena","mac":"54:3D:37:0C:EE:90","serie":"911302002193","modelo":"zf7025","descripcion":"HRPC-HAB_7352","marca":"RUCKUS AP","estado":"Inactivo","servicio":"Arrendamiento"},{"equipo":"Zone Director","mac":"54:3D:37:0C:EE:90","serie":"911302002193","modelo":"zf7025","descripcion":"HRPC-HAB_7352","marca":"RUCKUS AP","estado":"Procesando","servicio":"Arrendamiento"}
  ];


  // $.ajax({
  //     type: "POST",
  //     url: "/",
  //     data: {_token : _token },
  //     success: function (data){
        table_equipment(data, $("#table_equipment"));
  //     },
  //     error: function (data) {
  //       console.log('Error:', data);
  //     }
  // });
}

function table_equipment(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_with_pdf);
  vartable.fnClearTable();
  // $.each(JSON.parse(datajson), function(index, status){ //Este es el bueno
  $.each(datajson, function(index, status){
    var estado="";
    if(status.estado == 'Activo'){ estado= "<kbd style='background-color:#449D44'>"+status.estado+"</kbd>"; }
    if(status.estado == 'Inactivo'){ estado="<kbd style='background-color:#C9302C'>"+status.estado+"</kbd>"; }
    if(status.estado == 'Procesando'){ estado="<kbd style='background-color:#2DC1DF'>"+status.estado+"</kbd>"; }
    vartable.fnAddData([
      status.equipo,
      status.mac,
      status.serie,
      status.modelo,
      status.descripcion,
      status.marca,
      estado,
      status.servicio
    ]);
  });
}

$('.btn-export').on('click', function(){
    $("#captura_table_general").hide();

    $(".hojitha").css("border", "");
    html2canvas(document.getElementById("captura_pdf_general")).then(function(canvas) {
      var ctx = canvas.getContext('2d');
      ctx.rect(0, 0, canvas.width, canvas.height);
          var imgData = canvas.toDataURL("image/jpeg", 1.0);
          var correccion_landscape = 0;
          var correccion_portrait = 0;
          if(canvas.height > canvas.width) {
              var orientation = 'portrait';
              correccion_portrait = 1;
              correccion_landscape = 0;
              var imageratio = canvas.height/canvas.width;
          }
          else {
              var orientation = 'landscape';
              correccion_landscape = 0;
              correccion_portrait = 0;
              var imageratio = canvas.width/canvas.height;
          }
          if(canvas.height < 900) {
              fontsize = 16;
          }
          else if(canvas.height < 2300) {
              fontsize = 11;
          }
          else {
              fontsize = 6;
          }

          var margen = 0;//pulgadas

          // console.log(canvas.width);
          // console.log(canvas.height);

         var pdf  = new jsPDF({
                      orientation: orientation,
                      unit: 'in',
                      format: [16+correccion_portrait, (16/imageratio)+margen+correccion_landscape]
                    });

          var widthpdf = pdf.internal.pageSize.width;
          var heightpdf = pdf.internal.pageSize.height;
          pdf.addImage(imgData, 'JPEG', 0, margen, widthpdf, heightpdf-margen);
          pdf.save("Detalllado.pdf");
          $(".hojitha").css("border", "1px solid #ccc");
          $(".hojitha").css("border-bottom-style", "hidden");
          $("#captura_table_general").css("border-top-style", "hidden");
          $('#captura_table_general').show(); //muestro mediante id

    });

    /*Datos primordiales*/
    // var orientation = 'landscape';
    // var margen = 0.75;//pulgadas
    // var correccion_portrait = 0;
    // var correccion_landscape = 0;
    /*Generador*/
    // var pdf = new jsPDF({
    //   orientation: orientation,
    //   unit: 'in',
    //   format: [16+correccion_portrait, 16 +margen+correccion_landscape]
    // });
    // var titulo = 'Contenido';
    // var denominacion = 'Portada';
    // var fechas = 'Hoy';
    // var fontsize = 11;
    // var texto = denominacion+" - "+titulo+", Periodo: "+ fechas;
    // pdf.setFontSize(fontsize);
    // pdf.text(1.5, 0.5, texto);
    // pdf.setFont("helvetica");
    // pdf.setFontType("bold");
    // pdf.save('Generador.pdf');

});

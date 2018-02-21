$(function() {
  $(".select2").select2();
  $('.datepickermonth').datepicker({
    language: 'es',
    format: "yyyy-mm",
    viewMode: "months",
    minViewMode: "months",
    endDate: '1m',
    autoclose: true,
    clearBtn: true
  });
  $('.datepickermonth').val('').datepicker('update');
  //graph_client_wlan();
  graph_top_ssid();
  graph_client_day();
  graph_gigabyte_day();
  graph_top_aps();
  general_table_top_aps();
  general_table_comparative();
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
          countTR = data.typereports.length;
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

$('#btn_generar').on('click', function(e){
  var cadena= $('#select_one').val();
  if (cadena == "") {
    
  }else{
    //document.getElementById("captura_pdf_general").style.display="block";
    empty_header();
    fill_header();

    graph_client_wlan();

  }


});

function empty_header() {
  $("#client_name").empty();
  // URL de imagen
  $("#client_img").attr("src","../images/hotel/Sin_imagen.png");

  $("#email").empty();
  $("#tel").empty();

  $("#gigamax").empty();
  $("#gigamin").empty();
  $("#gigaprom").empty();

  $("#usermax").empty();
  $("#userprom").empty();
  $("#usermonth").empty();

  $("#usermax").empty();
  $("#userprom").empty();
  $("#usermonth").empty();

  $("#noant").empty();
  $("#rogue").empty();

  $("#device").empty();
  $("#promdevice").empty();
}

function fill_header() {
  var cadena= $('#select_one').val();
  var date = $('#calendar_fecha').val();
  //console.log(date);
  var _token = $('input[name="_token"]').val();
  var datax;
  $.ajax({
    type: "POST",
    url: "/view_reports_header",
    data: { data_one : cadena , data_two : date , _token : _token },
    success: function (data){
      datax = JSON.parse(data);
      //console.log(datax);
      $("#client_name").text(datax[11].Cantidad);
      $("#client_img").attr("src","../images/hotel/"+datax[13].Cantidad);
      $("#email").text(datax[12].Cantidad);
      $("#tel").text(datax[14].Cantidad);


      $("#gigamax").text(datax[0].Cantidad);
      $("#gigamin").text(datax[2].Cantidad);
      $("#gigaprom").text(datax[1].Cantidad);

      $("#usermax").text(datax[3].Cantidad);
      $("#userprom").text(datax[4].Cantidad);
      $("#usermonth").text(datax[6].Cantidad);

      $("#noant").text(datax[7].Cantidad);
      $("#rogue").text(datax[10].Cantidad);

      $("#device").text(datax[8].Cantidad);
      $("#promdevice").text(datax[9].Cantidad);
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}

function graph_client_wlan() {
  var cadena= $('#select_one').val();
  var date = $('#calendar_fecha').val();
  var _token = $('input[name="_token"]').val();

  var data_count = [{value:27284, name:'MoonPalace_JG = 27284'},{value:5326, name:'Palacetvnet = 5326'},{value:2415, name:'MoonPalaceJG = 24152415'},{value:647, name:'PalaceJG = 647'},{value:11, name:'Comandaspr = 11'}];
  var data_name = ["MoonPalace_JG = 27284","Palacetvnet = 5326","MoonPalaceJG = 2415","PalaceJG = 647","Comandaspr = 11"];
  
  var data_count = [];
  var data_name = [];

  $.ajax({
      type: "POST",
      url: "/get_client_wlan",
      data: { data_one : cadena , data_two : date , _token : _token },
      success: function (data){
        console.log(data);
        $.each(JSON.parse(data),function(index, objdata){
          data_name.push(objdata.WLAN + ' = ' + objdata.Clientes);
          data_count.push({ value: objdata.Clientes, name: objdata.WLAN + ' = ' + objdata.Clientes},);
        });
        graph_pie_default_four('main_client_wlan', data_name, data_count, 'Distribución de clientes', 'Wlan & Unidad', 'left');
        //console.log(data_count);
      },
      error: function (data) {
        console.log('Error:', data);
        //alert('3');
      }
  });

  //graph_pie_default_four('main_client_wlan', data_name, data_count, 'Distribución de clientes', 'Wlan & Unidad', 'left');
}

function graph_top_ssid() {
  var cadena= $('#select_one').val();
  var date = $('#calendar_fecha').val();
  var _token = $('input[name="_token"]').val();

  var data_count = [{value:27284, name:'MoonPalace_JG = 27284'},{value:5326, name:'Palacetvnet = 5326'},{value:2415, name:'MoonPalaceJG = 24152415'},{value:647, name:'PalaceJG = 647'},{value:11, name:'Comandaspr = 11'}];
  var data_name = ["MoonPalace_JG = 27284","Palacetvnet = 5326","MoonPalaceJG = 2415","PalaceJG = 647","Comandaspr = 11"];
  
  var data_count = [];
  var data_name = [];

  // $.ajax({
  //     type: "POST",
  //     url: "/",
  //     data: { data_one : cadena , data_two : date , _token : _token },
  //     success: function (data){
  //       console.log(data);
  //       $.each(JSON.parse(data),function(index, objdata){
  //         data_name.push(objdata.WLAN + ' = ' + objdata.Clientes);
  //         data_count.push({ value: objdata.Clientes, name: objdata.WLAN + ' = ' + objdata.Clientes},);
  //       });
  //       graph_pie_default_four('main_client_wlan', data_name, data_count, 'Distribución de clientes', 'Wlan & Unidad', 'left');
  //       //console.log(data_count);
  //     },
  //     error: function (data) {
  //       console.log('Error:', data);
  //       //alert('3');
  //     }
  // });

  //graph_barras_three('main_top_ssid', data_name, data_count, 'Top 5', 'Equipos & Cantidades');
}

function graph_client_day() {
  var date= $('#date_search_pral').val();
  var _token = $('input[name="_token"]').val();
  var data_count = [120, 132, 101, 134, 90, 230, 210,267,117,50, 121,22, 182, 191, 234, 290, 330, 310, 123, 442,321, 90, 149, 210, 122, 133, 334,121,22,56,19];
  var data_name = ['1','2','3','4','5','6','7','8','9','10', '11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
  graph_area_four_default('main_client_day', data_name, data_count, 'Clientes', 'Consumo diario','right', 90, 8, 'rgba(255, 126, 80, 1)', 'rgba(255, 126, 80, 0.5)');
}

function graph_gigabyte_day() {
  var date= $('#date_search_pral').val();
  var _token = $('input[name="_token"]').val();
  var data_count = [120, 132, 101, 134, 90, 230, 210,267,117,50, 121,22, 182, 191, 234, 290, 330, 310, 123, 442,321, 90, 149, 210, 122, 133, 334,121,22,56,19];
  var data_name = ['1','2','3','4','5','6','7','8','9','10', '11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
  graph_area_four_default('main_gigabyte_day', data_name, data_count, 'Gigabyte', 'Consumo diario','right', 90, 8, 'rgba(35, 160, 164, 1)', 'rgba(35, 160, 164, 0.5)');
}

function graph_top_aps() {
  var _token = $('input[name="_token"]').val();
  var data_count = [{value:15646, name:'Mexico = 15646'},{value:447, name:'Jamaica = 447'},{value:1483, name:'Republica dominicana = 1483'}];
  var data_name = ["Mexico = 15646","Jamaica = 447","Republica dominicana = 1483"];
  graph_douhnut_two_default('main_top_aps', 'Top 5', 'Aps & Unidades', 'left', data_name, data_count);
}

function general_table_top_aps() {
  var _token = $('input[name="_token"]').val();
  var data =[
    {"descripcion":"Rest_SeaFood Cabanas","mac":"E0:10:7F:2F:AD:E0","nclient":"894"},
    {"descripcion":"Rest_Oriental_Tepanyaki","mac":"F0:B0:52:29:B4:E0","nclient":"837"},
    {"descripcion":"Motor_Lobby","mac":"F0:B0:52:09:08:80","nclient":"1010"},
    {"descripcion":"Azotea Rest_Italiano_Playa","mac":"E0:10:7F:2F:B2:70","nclient":"806"},
    {"descripcion":"Azotea Cabanas Presidenciales","mac":"E0:10:7F:2F:B9:D0","nclient":"1895"}
  ];
  // $.ajax({
  //     type: "POST",
  //     url: "/",
  //     data: {_token : _token },
  //     success: function (data){
        table_aps_top(data, $("#table_top_aps"));
  //     },
  //     error: function (data) {
  //       console.log('Error:', data);
  //     }
  // });
}
function table_aps_top(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_simple);
  vartable.fnClearTable();
  // $.each(JSON.parse(datajson), function(index, status){ //Este es el bueno
  $.each(datajson, function(index, status){
    vartable.fnAddData([
      status.descripcion,
      status.mac,
      status.nclient
    ]);
  });
}


function general_table_comparative() {
  var _token = $('input[name="_token"]').val();
  var data =[
    {"concepto":"Pico Consumo","mes1":"7,910 GB", "mes2":"11,910 GB","identificador":"->"},
    {"concepto":"Pico Clientes","mes1":"1587","mes2":"1910","identificador":"->"},
    {"concepto":"Min Consumo","mes1":"1,953 GB","mes2":"2,910 GB","identificador":"->"},
    {"concepto":"Min Clientes","mes1":"527","mes2":"910 GB","identificador":"->"},
    {"concepto":"Avg Consumo","mes1":"4,718 GB","mes2":"5,410 GB","identificador":"->"},
    {"concepto":"Avg Clientes","mes1":"887","mes2":"1110 GB","identificador":"->"}
  ];
  // $.ajax({
  //     type: "POST",
  //     url: "/",
  //     data: {_token : _token },
  //     success: function (data){
        table_comparative(data, $("#table_comparative"));
  //     },
  //     error: function (data) {
  //       console.log('Error:', data);
  //     }
  // });
}
function table_comparative(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_simple);
  vartable.fnClearTable();
  // $.each(JSON.parse(datajson), function(index, status){ //Este es el bueno
  $.each(datajson, function(index, status){
    vartable.fnAddData([
      status.concepto,
      status.mes1,
      status.mes2,
      status.identificador
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
          pdf.save("Reporte Mensual.pdf");
          $(".hojitha").css("border", "1px solid #ccc");
          $(".hojitha").css("border-bottom-style", "hidden");
          $("#captura_table_general").css("border-top-style", "hidden");
          $('#captura_table_general').show(); //muestro mediante id
    });
});

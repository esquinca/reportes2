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
});

$('#btn_generar').on('click', function(e){
  var cadena= $('#select_one').val();
  //console.log(cadena);
  if (cadena == "") {

  }else{
    //document.getElementById("captura_pdf_general").style.display="block";
    empty_header();
    fillHeaders();
    table_gigabyte_cont();
    table_user_cont();
  }
});

function empty_header() {
  $("#client_name").empty();
  // URL de imagen
  $("#client_img").attr("src","../images/hotel/Sin_imagen.png");
  $("#email").empty();
  $("#tel").empty();
}

function fillHeaders() {
  var cadena= $('#select_one').val();
  var _token = $('input[name="_token"]').val();
  var datax;
  $.ajax({
    type: "POST",
    url: "/detailed_pro_head",
    data: { data_one : cadena,  _token : _token },
    success: function (data){
      datax = JSON.parse(data);
      //console.log(data);

      $("#client_name").text(datax[0].name);
      $("#email").text(datax[0].correo);
      $("#tel").text(datax[0].phone);

      //URL de imagen
      $("#client_img").attr("src","../images/hotel/"+datax[0].dirlogo1);

    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}


function table_gigabyte_cont() {
  var cadena= $('#select_one').val();
  var date = $('#calendar_fecha').val();
  var _token = $('input[name="_token"]').val();

  var data = JSON.stringify([{id:'1', Nombre_hotel:'Beach Palace', a12:'0', a11:'0',a10:'0',a9:'0',a8:'0',a7:'0',a6:'0',a5:'0',a4:'0',a3:'0',a2:'0',a1:'0'},
    {id:'2', Nombre_hotel:'Cozumel Palace', a12:'0', a11:'0',a10:'0',a9:'0',a8:'0',a7:'0',a6:'0',a5:'0',a4:'0',a3:'0',a2:'0',a1:'0'},
    {id:'3', Nombre_hotel:'Isla Palace', a12:'0', a11:'0',a10:'0',a9:'0',a8:'0',a7:'0',a6:'0',a5:'0',a4:'0',a3:'0',a2:'0',a1:'0'}
  ]);
  var data_data = [];
  //data_data.push({"concepto": objdata.Concepto,"mes1": objdata.Anterior,"mes2": objdata.Actual, "identificador": ind1});

  $.ajax({
      type: "POST",
      url: "/get_gb_cont",
      data: {data_one : cadena , data_two : date , _token : _token},
      success: function (data){
        //console.log(data);
        $.each(JSON.parse(data),function(index, objdata){
          data_data.push({"Nombre_hotel": objdata.Nombre_hotel, "a12": objdata.a12, "a11": objdata.a11, "a10": objdata.a10, "a9": objdata.a9, "a8": objdata.a8, "a7": objdata.a7, "a6": objdata.a6, "a5": objdata.a5, "a4": objdata.a4, "a3": objdata.a3, "a2": objdata.a2, "a1": objdata.a1});
        });
        table_conc_one(data_data, $("#table_cont_gb"));
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
  
}


function table_user_cont() {
  var cadena= $('#select_one').val();
  var date = $('#calendar_fecha').val();
  var _token = $('input[name="_token"]').val();
  var data = JSON.stringify([{id:'1', Nombre_hotel:'Beach Palace', a12:'0', a11:'0',a10:'0',a9:'0',a8:'0',a7:'0',a6:'0',a5:'0',a4:'0',a3:'0',a2:'0',a1:'0'},
    {id:'2', Nombre_hotel:'Cozumel Palace', a12:'0', a11:'0',a10:'0',a9:'0',a8:'0',a7:'0',a6:'0',a5:'0',a4:'0',a3:'0',a2:'0',a1:'0'},
    {id:'3', Nombre_hotel:'Isla Palace', a12:'0', a11:'0',a10:'0',a9:'0',a8:'0',a7:'0',a6:'0',a5:'0',a4:'0',a3:'0',a2:'0',a1:'0'}
  ]);
  var data_data = [];
  $.ajax({
      type: "POST",
      url: "/get_user_cont",
      data: {data_one : cadena , data_two : date , _token : _token},
      success: function (data){
        //console.log(data);
        $.each(JSON.parse(data),function(index, objdata){
          data_data.push({"Nombre_hotel": objdata.Nombre_hotel, "a12": objdata.a12, "a11": objdata.a11, "a10": objdata.a10, "a9": objdata.a9, "a8": objdata.a8, "a7": objdata.a7, "a6": objdata.a6, "a5": objdata.a5, "a4": objdata.a4, "a3": objdata.a3, "a2": objdata.a2, "a1": objdata.a1});
        });
        table_conc_two(data_data, $("#table_cont_user"));
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
}

function table_conc_one(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_with_cont_one_pdf);
  vartable.fnClearTable();
  $.each(datajson, function(index, status){ //Este es el bueno
    vartable.fnAddData([
      status.Nombre_hotel,
      status.a12,
      status.a11,
      status.a10,
      status.a9,
      status.a8,
      status.a7,
      status.a6,
      status.a5,
      status.a4,
      status.a3,
      status.a2,
      status.a1
    ]);
  });
}

function table_conc_two(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_with_cont_two_pdf);
  vartable.fnClearTable();
  $.each(datajson, function(index, status){ //Este es el bueno
    vartable.fnAddData([
      status.Nombre_hotel,
      status.a12,
      status.a11,
      status.a10,
      status.a9,
      status.a8,
      status.a7,
      status.a6,
      status.a5,
      status.a4,
      status.a3,
      status.a2,
      status.a1
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

$(document).ready(function() {
  clearmultiselect('select_two');
  // clearmultiselect('select_hotels');
  table_surveyed();
});


$('#select_one').on('change', function(e){
  var id= $(this).val();
  var _token = $('input[name="_token"]').val();
  if (id != ''){
    let countC = 0;
    $.ajax({
      type: "POST",
      url: "./user_vertical",
      data: { iv : id , _token : _token },
      success: function (data){
        countH = data.length;
        if (countH === 0) {
          $('#select_two').empty();
          // $('#select_two').append('<option value="" selected>Elije</option>');
          $("#select_two").multiselect('destroy');
        }
        else{
          $("#select_two").multiselect('destroy');
          $('#select_two').empty();
          // $('#select_two').append('<option value="" selected>Elije</option>');
          $.each(JSON.parse(data),function(index, objdata){
            $('#select_two').append('<option value="'+objdata.id+'">'+ objdata.name +'</option>');
          });
          $('#select_two').multiselect({
            buttonWidth: '100%',
            nonSelectedText: 'Elija uno o más',
            maxHeight: 100,
           });
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
  }
  else{
    $("#select_two").multiselect('fresh');
    $('#select_two').empty();
  }
});

$('#cancela_cu').click(function(){
  $('#creatusersystem')[0].reset();
  $('#creatusersystem').validator('destroy').validator();
});
$('#cancela_hc').click(function(){
  $('#select_hotels').multiselect('deselectAll', false);
  $('#select_hotels').multiselect('updateButtonText');
  $('#assign_hotel_client')[0].reset();
  $('#assign_hotel_client').data('formValidation').resetForm('true');
  $("#select_clients").val('').trigger('change');
});
$('#cancela_dc').click(function(){
  $('#delete_all_client')[0].reset();
});


$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href") // activated tab
    if (target == '#tab_1-1') {
      $('#creatusersystem')[0].reset();
      $('#creatusersystem').validator('destroy').validator();
    }
    if (target == '#tab_2-2') {
      $('#select_hotels').multiselect('deselectAll', false);
      $('#select_hotels').multiselect('updateButtonText');
      $('#assign_hotel_client')[0].reset();
    }
    if (target == '#tab_3-2') {
      $('#delete_all_client')[0].reset();
    }
  });

function clearmultiselect(campo){
      $('#'+campo).multiselect({
        buttonWidth: '100%',
        nonSelectedText: 'Elija uno o más',
        maxHeight: 100,
      });
      $('#'+campo).multiselect('deselectAll', false);
      $('#'+campo).multiselect('updateButtonText');
  }


$("#creatusersystem").validator().on("submit", function (event) {
      if (event.isDefaultPrevented()) {
          menssage_toast('Mensaje', '2', 'Completa los requisitos' , '3000');
      } else {
          // everything looks good!
          // event.preventDefault();
          // submitForm();
          document.getElementById("creatusersystem").submit();
      }
  });


function submitForm(){
      // Initiate Variables With Form Content
      // var name = $("#inputCreatName").val();
      // var email = $("#inputCreatEmail").val();
      // var location = $("#inputCreatLocation").val();

      var objData = $("#creatusersystem").find("select,textarea, input").serialize();
      $.ajax({
           type: "POST",
           url: "./data_create_client_config",
           data: objData,
           success: function (data) {
              if (data == 'true') {
                menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
              }
              if (data == 'false') {
                 menssage_toast('Mensaje', '2', 'You do not have permission to access this module, please refer to your system administrator!' , '3000');
              }
           },
           error: function (data) {
             menssage_toast('Mensaje', '2', 'Operation Abort- This Email is already registered' , '3000');
           }
       })

  }

function table_surveyed(){
  var _token = $('input[name="_token"]').val();
  $.ajax({
    type: "POST",
    url: "./show_assign_surveyed",
    data: { _token : _token },
    success: function (data){
        table_equipment(data, $("#see_venue_client"));
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}


function table_equipment(datajson, table){
  table.DataTable().destroy();
  var vartable = table.dataTable(Configuration_table_responsive_with_pdf);
  vartable.fnClearTable();
  $.each(JSON.parse(datajson), function(index, status){
    vartable.fnAddData([
      status.nombre,
      status.Venue,
      status.hotel_user_id
    ]);
  });
}

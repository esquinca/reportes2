$(function() {
  $(".select2").select2({ width: '80%' });

  $('input[type="radio"]').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass   : 'iradio_square-blue',
    increaseArea : '20%' // optional
  });


  $('input[name="facturitha"]').on('ifClicked', function (event) {
        if (this.value == 'yes') {
          alert("You clicked " + this.value);
        }
        if (this.value == 'no') {
          alert("You clicked " + this.value);
        }
  });

  $('input[name="provider_municipality"]').typeahead({
    minLength: 0,
    items: 9999,
    source: function(query, process) {
      console.log(query);
        return $.ajax({
            url: "/search_key_group",
            type: 'post',
            data: {key: query, _token : $('input[name="_token"]').val()},
            success: function(data) {
              var dataArray = [];
              $.each(JSON.parse(data), function(index, status){
                dataArray.push(status.Nombre_Grupo);
              });
              console.log(dataArray);
              // var json = JSON.parse(data); // string to json
              return process(dataArray);
              //console.log(json);
            }
        });
    }
  });

  var vartable = $("#table_temporality").dataTable(Configuration_table_clear);
});


$(".btn-save").on("click", function () {
  var rows_selected = $("#table_qualification").DataTable().column(0).checkboxes.selected();
  
  t.row.add( [
              counter +'.1',
              counter +'.2',
              counter +'.3',
              counter +'.4',
              counter +'.5'
          ] ).draw( false );
});

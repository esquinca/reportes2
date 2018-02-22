    $(function() {
      $("#selectfiltro").hide();
      $("#filter_year").hide();
      $("#filter_month").hide();
      $("#filter_vertical").hide();
      $("#filter_operation").hide();
      $("#filter_average").hide();
      $("#tfoot_average").hide();
      $('#filasasw')[0].reset();
    });

    $('#boton_muestra_selectfiltro').on('click', function() {
     	$("#selectfiltro").show(10);
    });
    $(".selectFiltro").change(function() {
  		mostraryreordenar($( this).val(), $("#filtration_container") );
  	});
    function mostraryreordenar(identifier, contentElements)
    {
      contentElements.append( $('#'+identifier) ); //Para mover el div
    	$('#'+identifier).show(300);
      $("#selectfiltro").hide(100);
      $('#selectfiltro').prop('selectedIndex',0);
    }
    $(".boton-mini").click(function(event) {
	     var identifier = $(this).closest( $( ".control-filter" ) );
			 ocultaryreordenar(identifier);
		});
    function ocultaryreordenar(element)
    {
    	element.hide(100);
      element.find('select').prop('selectedIndex',0);
    }
    $('#boton_muestra_selectfiltro').on('click', function() {
     	$("#selectfiltro").show(10);
    });

    $("#boton-aplica-filtro-visitantes").click(function(event) {
    	 var objData = $("#filasasw").find("select,textarea, input").serialize();
       var _token = $('input[name="_token"]').val();
       $.ajax({
          url: "/survey_viewresult",
          type: "POST",
          data: objData,
          success: function (data) {
            if ($('#searchaverage').val()=== '0') {
              tablaEnc(data, $("#example1") , 0);
              $("#tfoot_average").hide();
              modTableCali();
            }
            else {
              tablaEnctwo(data, $("#example1") , 0);
              $("#tfoot_average").show();
              modTableCali();
            }
          },
          error: function (data) {
            console.log('Error:', data);
          }
      });
    });

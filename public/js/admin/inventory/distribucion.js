var map;
var marker;
var markas = [];
var infowindow;
var markerCluster;

$(function() {
  init();
});

function init() {
  map = new google.maps.Map(document.getElementById('googlemap'), {
    zoom: 5,
    center: new google.maps.LatLng(20.960072,-77.264404),
  });
  infowindow = new google.maps.InfoWindow;
  addLocation();
}

function addLocation(){
  let contentstring;
  var _token = $('input[name="_token"]').val();
  $.ajax({
    type: "POST",
    url: "./geoHotel",
    data: { _token : _token },
    success: function (data) {
      var obj = JSON.parse(data);
      console.log(obj);
      var length = Object.keys(obj).length;
      console.log(length);

      for (var i = 0; i < length; i++) {
        marker = new google.maps.Marker({
             position: new google.maps.LatLng(obj[i].Latitude, obj[i].Longitude),
             map: map
        });
        markas.push(marker);

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            contentstring = "<div style=\"overflow: hidden;\"><b>Hotel:<\/b> " + obj[i].Nombre_hotel +"<br><b>Dirección:<\/b> " + obj[i].Direccion +"<br><b>Latitude:<\/b> " + obj[i].Latitude + "<br><b>Longitude:<\/b> " + obj[i].Longitude;
            infowindow.setContent(contentstring);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
      markerCluster = new MarkerClusterer(map, markas,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

    },
    error: function (data) {
      console.log('Error:', data);
    }
  });
}

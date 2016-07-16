var map;
var marker;
var infowindow;

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: {lat: -6.917464, lng: 107.619123},
    mapTypeControl: false
  });

  document.getElementById('geocode').addEventListener('click', function() {
    geocodeAddress();
  });

  map.addListener('click', function(event) {
    if (marker) {
      marker.setMap(null);
      if (infowindow) {
        infowindow.close();
      }
    }
    placeMarker(event.latLng);
  });
}

function placeMarker(position) {
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({'latLng': position}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        infowindow.setContent(results[0].formatted_address + '<br> coordinates: '+ marker.getPosition().toUrlValue(6));
        infowindow.open(map, marker);
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });

  marker = new google.maps.Marker({
    map: map,
    draggable: true,
    animation: google.maps.Animation.DROP,
    position: position,
    //title: results[0].formatted_address
    //title: results[0].address_components[2].long_name
  });

  infowindow = new google.maps.InfoWindow();
  infowindow.setContent(marker.getFormattedAddress() + "<br>coordinates: " + marker.getPosition().toUrlValue(6));

  infowindow.open(map, marker);

  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });

  marker.addListener('dragend', function() {
    geocodeLatLng(geocoder, this, marker.getPosition());
  });
}

function geocodeLatLng(geocoder, marker, position) {
  geocoder.geocode({'latLng': position}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        if (infowindow) {
          infowindow.close();
        }

        infowindow.setContent(results[0].address_components[2].long_name + '<br> coordinates: '+ marker.getPosition().toUrlValue(6));
        infowindow.open(map, marker);
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
}

function geocodeAddress() {
  var geocoder = new google.maps.Geocoder();
  var address = document.getElementById('address').value;
  if(address == '') {
    window.alert('You must enter an area, or address.');
  } else {
    geocoder.geocode({'address': address}, function(results, status) {
      if (status === google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        if (marker) {
          marker.setMap(null);
          if (infowindow) {
            infowindow.close();
          }
        }
        marker = new google.maps.Marker({
          map: map,
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: results[0].geometry.location,
          //title: results[0].formatted_address
          title: results[0].address_components[2].long_name
        });

        for (var i=0; i<results[0].address_components.length; i++) {
          for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
            if (results[0].address_components[i].types[0] == "administrative_area_level_4") {
              //this is the object you are looking for
              document.getElementById('village').value = results[0].address_components[i].long_name;
              //break;
            }
          }
        }

        document.getElementById('lat').value = marker.getPosition().lat();

        infowindow = new google.maps.InfoWindow();
        infowindow.setContent(marker.title + "<br>coordinates: " + marker.getPosition().toUrlValue(6));

        infowindow.open(map, marker);

        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });

        marker.addListener('dragend', function() {
          geocodeLatLng(geocoder, this, marker.getPosition());
        });

      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }
}

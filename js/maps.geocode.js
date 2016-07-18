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
    hideMarker();
    geocodeAddress();
  });

  map.addListener('click', function(event) {
    hideMarker();
    placeMarker(event.latLng);
  });
}

function hideMarker() {
  if (marker) {
    marker.setMap(null);
    if (infowindow) {
      infowindow.close();
    }
  }
}

function setInfoWindow(marker) {
  infowindow = new google.maps.InfoWindow();
  infowindow.setContent(marker.title + '<br> coordinates: '+ marker.getPosition().toUrlValue(6));
  infowindow.open(map, marker);
}

function placeMarker(position) {
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({'latLng': position}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        // create marker
        marker = new google.maps.Marker({
          map: map,
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: position,
          title: results[0].formatted_address
          //title: results[0].address_components[2].long_name
        });

        // add listener for marker
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });

        marker.addListener('dragend', function() {
          geocodeLatLng(geocoder, this, marker.getPosition());
        });

        // create info window
        setInfoWindow(marker);

        // set value in form
        document.getElementById('lat').value = marker.getPosition().lat();
        document.getElementById('lng').value = marker.getPosition().lng();
        var str = marker.title.split(',',1);
        document.getElementById('address').value = str;
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
}

function geocodeLatLng(geocoder, marker, position) {
  geocoder.geocode({'latLng': position}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        if (infowindow) {
          infowindow.close();
        }
        infowindow.setContent(results[0].formatted_address + '<br> coordinates: '+ marker.getPosition().toUrlValue(6));
        infowindow.open(map, marker);

        // set value in form
        document.getElementById('lat').value = marker.getPosition().lat();
        document.getElementById('lng').value = marker.getPosition().lng();
        var str = marker.title.split(',',1);
        document.getElementById('address').value = str;
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
  // check for the address
  if(address == '') {
    window.alert('You must enter an area, or address.');
  } else {
    geocoder.geocode({'address': address}, function(results, status) {
      if (status === google.maps.GeocoderStatus.OK) {
        if(results[0]) {
          // set the center of the map
          map.setCenter(results[0].geometry.location);

          marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: results[0].geometry.location,
            title: results[0].formatted_address
            //title: results[0].address_components[2].long_name
          });

          // add listener for marker
          marker.addListener('click', function() {
            infowindow.open(map, marker);
          });

          marker.addListener('dragend', function() {
            geocodeLatLng(geocoder, this, marker.getPosition());
          });

          // create info window
          setInfoWindow(marker);

          // set value in form
          document.getElementById('lat').value = marker.getPosition().lat();
          document.getElementById('lng').value = marker.getPosition().lng();
          var str = marker.title.split(',',1);
          document.getElementById('address').value = str;
        } else {
          window.alert('No results found');
        }
      } else {
        window.alert('Geocoder failed due to: ' + status);
      }
    });
  }
}

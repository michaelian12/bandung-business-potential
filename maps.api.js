var map;
// Create a new blank array for all the listing markers.
var markers = [];

function initMap() {
  // Constructor creates a new map - only center and zoom are required.
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: {lat: -6.917464, lng: 107.619123},
    mapTypeControl: false
  });

  // These are the real estate listings that will be shown to the user.
  // Normally we'd have these in a database instead.
  //var locations = initLocations();
  var locations = [];

  // Change this depending on the name of your PHP file
  downloadUrl("libs/phpsqlajax_genxml.php", function(data) {
    var xml = data.responseXML;
    var business = xml.documentElement.getElementsByTagName("marker");
    for (var i = 0; i < business.length; i++) {
      var name = business[i].getAttribute("name");
      var address = business[i].getAttribute("address");
      //var type = business[i].getAttribute("type");
      var lat = parseFloat(business[i].getAttribute("lat"));
      var lng = parseFloat(business[i].getAttribute("lng"));

      var loc = {title: name, address: address, location: {lat: lat, lng: lng}};
      locations.push(loc);
    }

    var infowindow = new google.maps.InfoWindow();

    // The following group uses the location array to create an array of markers on initialize.
    for (var i = 0; i < locations.length; i++) {
      // Get the position from the location array.
      var position = locations[i].location;
      var title = locations[i].title;
      var address = locations[i].address;
      // Create a marker per location, and put into markers array.
      var marker = new google.maps.Marker({
        position: position,
        title: title,
        address: address,
        animation: google.maps.Animation.DROP,
        id: i
      });

      // Push the marker to our array of markers.
      markers.push(marker);

      // Create an onclick event to open an infowindow at each marker.
      marker.addListener('click', function() {
        populateInfoWindow(this, infowindow);
      });
    }

    map.addListener('click', function() {
      infowindow.marker = null;
      infowindow.close()
    });
  });

  document.getElementById('show-listings').addEventListener('click', showListings);
  document.getElementById('hide-listings').addEventListener('click', hideListings);
}

// This function populates the infowindow when the marker is clicked. We'll only allow
// one infowindow which will open at the marker that is clicked, and populate based
// on that markers position.
function populateInfoWindow(marker, infowindow) {
  // Check to make sure the infowindow is not already opened on this marker.
  if (infowindow.marker != marker) {
    // Clear the infowindow content to give the streetview time to load.
    infowindow.setContent('');
    infowindow.marker = marker;
    // Make sure the marker property is cleared if the infowindow is closed.
    infowindow.addListener('closeclick', function() {
      infowindow.marker = null;
    });

    var streetViewService = new google.maps.StreetViewService();
    var radius = 50;

    // In case the status is OK, which means the pano was found, compute the
    // position of the streetview image, then calculate the heading, then get a
    // panorama from that and set the options
    function getStreetView(data, status) {
      if (status == google.maps.StreetViewStatus.OK) {
        var nearStreetViewLocation = data.location.latLng;
        var heading = google.maps.geometry.spherical.computeHeading(nearStreetViewLocation, marker.position);
        infowindow.setContent('<div>' + marker.title + '</div><div>' + marker.address + '</div><div>coordinates: ' + marker.getPosition().toUrlValue(6) + '</div>');
        var panoramaOptions = {
          position: nearStreetViewLocation,
          pov: {
            heading: heading,
            pitch: 30
          }
        };
        var panorama = new google.maps.StreetViewPanorama(document.getElementById('pano'), panoramaOptions);
      } else {
        infowindow.setContent('<div>' + marker.title + '</div><div>' + marker.address + '</div><div>coordinates: ' + marker.getPosition().toUrlValue(6) + '</div><div>No Street View Found</div>');
      }
    }

    // Use streetview service to get the closest streetview image within
    // 50 meters of the markers position
    streetViewService.getPanoramaByLocation(marker.position, radius, getStreetView);
    // Open the infowindow on the correct marker.
    infowindow.open(map, marker);
  }
}

// This function will loop through the markers array and display them all.
function showListings() {
  var bounds = new google.maps.LatLngBounds();
  // Extend the boundaries of the map for each marker and display the marker
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
    bounds.extend(markers[i].position);
  }
  map.fitBounds(bounds);
}

// This function will loop through the listings and hide them all.
function hideListings() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
}

function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      request.onreadystatechange = doNothing();
      callback(request, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
}

function doNothing() {}

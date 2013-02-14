  function codeAddress(address) {
      var defaultZoom = 10;
      var mapOptions = {
          mapTypeId: google.maps.MapTypeId.ROADMAP
      }
      var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
      var bounds = new google.maps.LatLngBounds();
      var geocoder = new google.maps.Geocoder();
      var locations = address.split("|");
      var markers = [];
      var infowindow = new google.maps.InfoWindow();

      for (var i = 0; i < locations.length; i++) {
          geocoder.geocode({
              'address': locations[i]
          }, function (results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                  var marker = new google.maps.Marker({
                      map: map,
                      position: results[0].geometry.location,
                      title: results[0].formatted_address
                  });

                  // add popup
                  google.maps.event.addListener(marker, 'click', function () {
                      infowindow.setContent("<span class='map_popup'>" + results[0].formatted_address + "</span>");
                      infowindow.open(map, marker);
                  });

                  markers.push(marker);

                  bounds.extend(results[0].geometry.location);
              } else {
                  //            alert('Geocode was not successful for the following reason: ' + status);
              }
              if (markers.length == 1) {
                  // one marker, so set center and zoom level
                  map.setCenter(results[0].geometry.location);
                  map.setZoom(defaultZoom);
              } else {
                  // multiple markers, so allow map to set center and zoom level
                  map.fitBounds(bounds);
              }
          });
      }
  }
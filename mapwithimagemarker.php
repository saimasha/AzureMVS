<?php

function get_confirmed_locations() {
    require("include/connection.php");

    // $manufacturerData = [];
    // $stockistData = [];
    $rows = array();
    // manufacturer data
    // global $heirchy;
    // $heirchy = '';

    $query = "SELECT fdManufacturerLat, fdManufacturerLong FROM `tbManufacturerMaster` WHERE fdManufacturerID= 36";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Manufacturer Query Error: " . mysqli_error($conn));
    }

    while ($r = mysqli_fetch_assoc($result)) {
        $heirchy = '10';
        $r[] = $heirchy;
        $rows[] = $r;
        // $rows[] = $heirchy;
        
        // echo $rows;
    }
    // stockist data

    $query = "SELECT fdStockistLat, fdStockistLong FROM `tbStockistMaster` WHERE fdManufacturerID = 36";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Stockist Query Error: " . mysqli_error($conn));
    }

    while ($r = mysqli_fetch_assoc($result)) {
        $heirchy = '20';
        $r[] = $heirchy;

        $rows[] = $r;

    }
    // distributor data

    $query = "SELECT fdDistrLat, fdDistrLong FROM `tbDistributorMaster` WHERE fdManufacturerID = 36";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Stockist Query Error: " . mysqli_error($conn));
    }

    while ($r = mysqli_fetch_assoc($result)) {
        $heirchy = '30';
        $r[] = $heirchy;

        $rows[] = $r;

    }
    // Retailer data

    $query = "SELECT fdRetailerLat, fdRetailerLong FROM `tbRetailerMaster`";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Stockist Query Error: " . mysqli_error($conn));
    }

    while ($r = mysqli_fetch_assoc($result)) {
        $heirchy = '40';
        $r[] = $heirchy;

        $rows[] = $r;
    }
        // dealer data

    $query = "SELECT fdDealerLat, fdDealerLong FROM `tbDealerMaster`";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Stockist Query Error: " . mysqli_error($conn));
    }

    while ($r = mysqli_fetch_assoc($result)) {
        $heirchy = '50';
        $r[] = $heirchy;
        $rows[] = $r;
    }
    
    $indexed = array_map('array_values', $rows);
    $array = array_filter($indexed);
 
    echo json_encode($array);
    if (!$rows) {
        return null;
    }
    // $combinedData = array_merge($manufacturerData, $stockistData);

    // echo json_encode($combinedData);
}
?>

<html>
<head>
  <title>Manufacturer Location</title>
  <link href="dist/css/style.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
     <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDonb2ULBup0rFfk6C8CSbGx2rcR52vm2o&callback=initMap&libraries=places&v=weekly&channel=2"
      async
    ></script> 

  <style type="text/css">
    #map {
      height: 400px;
      width: 100%;
      /* margin-left:150px;
      margin-top: 30px;
      */
    }
.marker-icon {
    background-color: #ff0000; /* Set your desired background color */
    padding: 5px; /* Optional: Add some padding to the marker image */
    border-radius: 50%; /* Optional: Add border-radius for rounded corners */
}
    /* Optional: Makes the sample page fill the window. */
    
</style>

</head>
<body>
  
  <!-- <div class="pac-card" id="pac-card">
          <div id="label" style="color:white;font-family:Segoe UI,Arial,sans-serif;font-size: 0.7rem;">
             Search Location
          </div>       
        <div id="pac-container">
          <input id="pac-input" type="text" placeholder="Enter a location" style="width:95%;">
          <div id="location-error"></div>
        </div>
        </div> -->
       <!-- <br> -->
<div class="container-fluid">

<div class="row">
    
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0"><strong><i class="fas fa-map-marker-alt">  MANUCFATURER LOCATION</i></strong></h4><br>
                                <div class="pac-card" id="pac-card">
        <div id="label" style="color:white;font-family:Segoe UI,Arial,sans-serif;font-size: 0.7rem;">
           Search Location
        </div>       
      <div id="pac-container">
        <input id="pac-input" type="text" placeholder="Enter a location" style="width:100%;">
        <div id="location-error"></div>
      </div>
      </div>
    <div id="infowindow-content">
      <!--<img src="" width="16" height="16" id="place-icon">-->
      <span id="place-name"  class="title"></span>
      <span id="place-address"></span>
    </div>
  
                            <div id="map" ></div>
                        </div>
                    </div>
                </div>
            </div>
</div>
<script>
    
      /**
 * Create new map
 */
var circle;
var map;
function initMap() {

var infowindow;
var map;
var red_icon = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';

var locations = <?php get_confirmed_locations() ?>;
var myOptions = {
  zoom: 7,
  center: new google.maps.LatLng(31.87916, 35.32910),
  mapTypeId: 'roadmap'
};
map = new google.maps.Map(document.getElementById('map'), myOptions);

var centerCoordinates = new google.maps.LatLng(37.6, 40.665);
        map = new google.maps.Map(document.getElementById('map'), {
        center: centerCoordinates,
        zoom: 4
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        
        var infowindowContent = document.getElementById('infowindow-content');
        
        //map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);
        var infowindow = new google.maps.InfoWindow();
        infowindow.setContent(infowindowContent);
        
        var marker = new google.maps.Marker({
          map: map
        });

        circle = new google.maps.Circle({
           map: map,
           strokeColor: "#00ff59",
           strokeOpacity: 0.8,
           strokeWeight: 2,
           fillColor: "#0ee66b",
           fillOpacity: 0.35,
           center: centerCoordinates,
           radius: 10 * 1609.34,
           
        });
         autocomplete.addListener('place_changed', function() {
            document.getElementById("location-error").style.display = 'none';
            infowindow.close();
            marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    document.getElementById("location-error").style.display = 'inline-block';
                    document.getElementById("location-error").innerHTML = "Cannot Locate '" + input.value + "' on map";
                    return;
                }
                
                map.fitBounds(place.geometry.viewport);
                marker.setPosition(place.geometry.location);
                circle.setCenter(place.geometry.location);
                marker.setVisible(true);
                circle.setVisible(true);
                    
                infowindowContent.children['place-icon'].src = place.icon;
                infowindowContent.children['place-name'].textContent = place.name;
                infowindowContent.children['place-address'].textContent = input.value;
                infowindow.open(map, marker);
        });

        
/**
 * Global marker object that holds all markers.
 * @type {Object.<string, google.maps.LatLng>}
 */
var markers = [];

/**
 * Concatenates given lat and lng with an underscore and returns it.
 * This id will be used as a key of marker to cache the marker in markers object.
 * @param {!number} lat Latitude.
 * @param {!number} lng Longitude.
 * @return {string} Concatenated marker id.
 */
var getMarkerUniqueId = function(lat, lng) {
  return lat + '_' + lng;
};

/**
 * Creates an instance of google.maps.LatLng by given lat and lng values and returns it.
 * This function can be useful for getting new coordinates quickly.
 * @param {!number} lat Latitude.
 * @param {!number} lng Longitude.
 * @return {google.maps.LatLng} An instance of google.maps.LatLng object
 */
var getLatLng = function(lat, lng) {
  return new google.maps.LatLng(lat, lng);
};


/**
 * Binds right click event to given marker and invokes a callback function that will remove the marker from map.
 * @param {!google.maps.Marker} marker A google.maps.Marker instance that the handler will binded.
 */
var bindMarkerEvents = function(marker) {
  google.maps.event.addListener(marker, "rightclick", function(point) {
    var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
    var marker = markers[markerId]; // find marker
    removeMarker(marker, markerId); // remove it
  });
};


/**
 * loop through (Mysql) dynamic locations to add markers to map.
 */
var i;
var confirmed = 0;
var bounds = new google.maps.LatLngBounds();

for (i = 0; i < locations.length; i++) {
    var tbPowerFactor = locations[i][2];

    
      var markerIcon = '';

  // Define the color based on the tbPowerFactor range
//   var color = '';
  if (tbPowerFactor == "10") {
        markerIcon = 'https://schedarcloud.com/medicineverifications/image/marker/manumarkerbg.png'; // Path to the custom marker icon for tbPowerFactor 10
  }
  else if (tbPowerFactor == "20") {
        markerIcon = 'https://schedarcloud.com/medicineverifications/image/marker/stockistmarkerbg.png'; // Path to the custom marker icon for tbPowerFactor 10
  }
  else if (tbPowerFactor == "30") {
        markerIcon = 'https://schedarcloud.com/medicineverifications/image/marker/distributormarkerbg.png'; // Path to the custom marker icon for tbPowerFactor 10
  }
  else if (tbPowerFactor == "40") {
        markerIcon = 'https://schedarcloud.com/medicineverifications/image/marker/dealermarkerbg.png'; // Path to the custom marker icon for tbPowerFactor 10
  }
  else if (tbPowerFactor == "50") {
        markerIcon = 'https://schedarcloud.com/medicineverifications/image/marker/retailermarkerbg.png'; // Path to the custom marker icon for tbPowerFactor 10
  }
  
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(locations[i][0], locations[i][1], locations[i][2],locations[i][3]),
    map: map,
    // animation: google.maps.Animation.BOUNCE,
    animation: google.maps.Animation.DROP,
    
    icon: {
       url: markerIcon,
            scaledSize: new google.maps.Size(50, 60),
// Adjust the size of the marker icon if needed
        },
    // icon: locations[i][4] === '1' ? red_icon : purple_icon,
    html: "<div id='window_loc'>\n" +
      "<form method='GET'>\n" +
      "<table class=\"map1\" style='width: 227px;'>\n" +
      "<tr>\n" +
      "<td><input type='hidden'  name='description' id='description'/>" + locations[i][0] + "</td></tr>\n" +
      "<tr>\n" +
      "<td><textarea disabled  id='question' placeholder='Question' style='width: 227px;'>Customer ID:-" + locations[i][0] + " Customer Meter sno:- " + locations[i][1] + "</textarea></td></tr>\n" +
      "<tr>\n" +
      "<td><input type='hidden' name='id' id='id' value=" + locations[i][0] + " /></td></tr>\n" +
      "</tr>\n" +
      "</table>\n" +
      "</form>\n" +
      "</div>"
  });

  bounds.extend(marker.getPosition());

  google.maps.event.addListener(marker, 'click', (function(marker, i) {
    return function() {
      infowindow = new google.maps.InfoWindow();
      confirmed = locations[i][4] === '1' ? 'checked' : 0;
      $("#confirmed").prop(confirmed, locations[i][4]);
      $("#id").val(locations[i][0]);
      $("#description").val(locations[i][1]);
      $("#form").show();
      infowindow.setContent(marker.html);
      infowindow.open(map, marker);
    }
  })(marker, i));
  markers.push(marker);
}

map.fitBounds(bounds);
// Add a marker clusterer to manage the markers.
new MarkerClusterer(map, markers, {
  imagePath: "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
});

function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
    new ActiveXObject('Microsoft.XMLHTTP') :
    new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      callback(request.responseText, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
} 
// Add circle overlay and bind to marker
  for (const city in citymap) {
    // Add the circle for this city to the map.

    const cityCircle = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map,
      center: citymap[city].center,
      radius: Math.sqrt(citymap[city].population) * 800,
    });
  };

   } 
    function updateRadius() {
        circle.setRadius(document.getElementById('radius').value * 1609.34);
        map.fitBounds(circle.getBounds());
    }
   
  </script>
  
   

</body>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<script src="dist/js/app.min.js"></script>
<script src="dist/js/app.init.dark.js"></script>
<script src="dist/js/app-style-switcher.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<!-- <script src="assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<!-- <script src="../../dist/js/waves.js"></script>
<!--Menu sidebar -->
<!-- <script src="../../dist/js/sidebarmenu.js"></script> -->
<!--Custom JavaScript -->
<!-- <script src="../../dist/js/custom.min.js"></script> --> 
<!-- This Page JS -->

<!-- <script src="assets/libs/gmaps/gmaps.min.js"></script> -->
<script src="dist/js/pages/maps/map-google.init.js"></script>
</html>
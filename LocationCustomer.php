<?php
require ("include/connection.php");

function get_confirmed_locations(){

  require ("include/connection.php");
    // update location with location_status if admin location_status.
    $query = mysqli_query($conn,"SELECT fdLatitude,fdLongitude,fdCustomerID AS confirmed FROM tbCustomerMaster");

    $rows = array();

    while($r = mysqli_fetch_assoc($query)) {
        $rows[] = $r;
    }
    $indexed = array_map('array_values', $rows);
    $array = array_filter($indexed);
 
    echo json_encode($array);
    if (!$rows) {
        return null;
    }

    }

?>
<html>
<head>
  <title>Customer Location</title>
  <link href="dist/css/style.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    label{
    font-size: 24px;
    color: #FFFFFF;
    line-height: 55px;
    text-align: center;
    white-space: nowrap;
}
.marker-icon {
    background-color: #ff0000; /* Set your desired background color */
    padding: 5px; /* Optional: Add some padding to the marker image */
    border-radius: 50%; /* Optional: Add border-radius for rounded corners */
}
    /* Optional: Makes the sample page fill the window. */
  .custom-marker-label {
      color: white; /* Text color */
      width: 30px;  
      height: 30px; /* Height of the label */
      margin-bottom:50px;
      /*border: 2px solid black; */
      border-radius: 50%; /* Make it a circle */
      line-height: 26px; /* Center the text vertically */
      cursor: pointer;
      margin-top:-45px;
      position: relative;
      text-align: center; /* Center the text horizontally */
      text-shadow: 0px 0px 2px #000000;
}
#legend {
  /*background-color: white;*/
  padding: 10px;
  /*border: 1px solid #ccc;*/
  border-radius: 5px;
  position: absolute;
  bottom: -6px;
  left: 25%;
  z-index: 1000;
  display: flex;
}

.legend-marker {
    width: 20px;
    height: 20px;
    display: inline-block;
    margin-right: 7px;
    border: 1px solid #000;
    padding: 10px;
    margin-left: 10px;
}
/*.marker {*/
/*  box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);*/
/*}*/

/*.marker {*/
/*    position: relative;*/
    background-color: #e82020; /* Marker color */
    width: 20px; /* Marker width */
    height: 40px; /* Marker height */
/*    border-radius: 50%;*/
/*    cursor: pointer;*/
/*}*/

/*.marker:after {*/
/*    content: '';*/
/*    position: absolute;*/
    bottom: -10px; /* Adjust the shadow position */
/*    left: 50%;*/
/*    transform: translateX(50%);*/
    width: 20px; /* Shadow width */
    height: 10px; /* Shadow height */
    background: rgba(0, 0, 0, 0.3); /* Shadow color */
/*    border-radius: 50%;*/
/*}*/


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
                <h4 class="card-title mb-0" style="font-family:Segoe UI,Arial,sans-serif;"><strong><i class="fas fa-map-marker-alt"></i>  CUSTOMER LOCATION</strong></h4><br>
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

                <div id="map" ></div><br>
                <div id="legend">
                    <!-- <div style="display: contents;"><span class="legend-marker" style="background-color: #e82020;"></span> Manufacturer</div> -->
                    <div style="display: contents;"><span class="legend-marker" style="background-color: #218c09;"></span> Customer</div>
                    
                </div>
        
            </div>
        </div>
    </div>
</div>
            
</div>

<script>
    
      /**
 * Create new map
 */
var markerCluster; // Define markerCluster variable outside initMap function

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
           // Inside the autocomplete listener function
autocomplete.addListener('place_changed', function() {
    document.getElementById("location-error").style.display = 'none';
    infowindow.close();
    
    var place = autocomplete.getPlace();
    if (!place.geometry) {
        document.getElementById("location-error").style.display = 'inline-block';
        document.getElementById("location-error").innerHTML = "Cannot locate '" + input.value + "' on map";
        return;
    }

    var locationLat = place.geometry.location.lat();
    var locationLng = place.geometry.location.lng();
    var radius = 10; // Radius in kilometers, adjust as needed
    var foundStockist = false;
    var foundDistributor = false;
    var foundDealer = false;
    var foundRetailer = false;
    var foundCustomer = false;

    // Loop through the locations array to check if any dealers or retailers exist within the radius
    for (var i = 0; i < locations.length; i++) {
        var distance = google.maps.geometry.spherical.computeDistanceBetween(
            new google.maps.LatLng(locationLat, locationLng),
            new google.maps.LatLng(locations[i][0], locations[i][1])
        );
        if (distance <= radius * 1000 && locations[i][3] === '20') {
            // Stockist found within the radius
            foundStockist = true;
        }else if (distance <= radius * 1000 && locations[i][3] === '30') {
            // Distributor found within the radius
            foundDistributor = true;
        }else if (distance <= radius * 1000 && locations[i][3] === '50') {
            // Dealer found within the radius
            foundDealer = true;
        } else if (distance <= radius * 1000 && locations[i][3] === '40') {
            // Retailer found within the radius
            foundRetailer = true;
        }else if (distance <= radius * 1000 && locations[i][3] === '60') {
            // Retailer found within the radius
            foundCustomer = true;
        }
    }

    if (foundStockist || foundDistributor ||  foundDealer || foundRetailer || foundCustomer) {
        // At least one relevant user (dealer or retailer) found within the radius
        map.fitBounds(place.geometry.viewport);
        // Display appropriate marker and info window based on the type of user found
    if (foundStockist) {
        // Stockist found within the radius, proceed with moving the stockist marker
        stockistMarker.setPosition(place.geometry.location);
        circle.setCenter(place.geometry.location);
        stockistMarker.setVisible(true);
        circle.setVisible(true);
        // infowindow.setContent('<div><strong>Stockist Found</strong><br>' + place.name + '<br>' + place.formatted_address + '</div>');
        // infowindow.open(map, stockistMarker);
    } else if (foundDistributor) {
        // Distributor found within the radius, proceed with moving the distributor marker
        distributorMarker.setPosition(place.geometry.location);
        circle.setCenter(place.geometry.location);
        distributorMarker.setVisible(true);
        circle.setVisible(true);
        // infowindow.setContent('<div><strong>Distributor Found</strong><br>' + place.name + '<br>' + place.formatted_address + '</div>');
        // infowindow.open(map, distributorMarker);
    } else if (foundDealer) {
            // Dealer found within the radius, proceed with moving the dealer marker
            marker.setPosition(place.geometry.location);
            circle.setCenter(place.geometry.location);
            marker.setVisible(true);
            circle.setVisible(true);
            // infowindow.setContent('<div><strong>Dealer Found</strong><br>' + place.name + '<br>' + place.formatted_address + '</div>');
            // infowindow.open(map, marker);
        } else if (foundRetailer) {
            // Retailer found within the radius, proceed with moving the retailer marker
            retailerMarker.setPosition(place.geometry.location);
            circle.setCenter(place.geometry.location);
            retailerMarker.setVisible(true);
            circle.setVisible(true);
            // infowindow.setContent('<div><strong>Retailer Found</strong><br>' + place.name + '<br>' + place.formatted_address + '</div>');
            // infowindow.open(map, retailerMarker);
        }
        else {
            // Retailer found within the radius, proceed with moving the retailer marker
            customerMarker.setPosition(place.geometry.location);
            circle.setCenter(place.geometry.location);
            customerMarker.setVisible(true);
            circle.setVisible(true);
            // infowindow.setContent('<div><strong>Customer Found</strong><br>' + place.name + '<br>' + place.formatted_address + '</div>');
            // infowindow.open(map, customerMarker);
        }
    } else {
       // No relevant user found within the radius, display "No user found" message
    document.getElementById("location-error").style.display = 'inline-block';
    document.getElementById("location-error").innerHTML = "No user found for this location";
}
});
// Function to handle "View on map" link click
function viewOnMap() {
    // Implement the desired behavior here, such as centering the map on the blue marker's location
    map.setCenter(searchMarker.getPosition());
    map.setZoom(15); // Optionally, set the zoom level as desired

}
   

        
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
    var tbPowerFactor = locations[i][3];

    
      //var markerIcon = '';
var markerLabel;
// var tooltipContent='';

  // Define the color based on the tbPowerFactor range
   var color = '';
  if (tbPowerFactor == "20") {
    color = '#77f279';
    markerLabel = '\uf5fd'; // Unicode for your second Font Awesome icon
    // tooltipContent = 'Stockist';

  }
  else if (tbPowerFactor == "30") {
    color = '#9290e0';
    markerLabel = '\uf362'; // Unicode for your third Font Awesome icon
    // tooltipContent = 'Distributor';

  }
  else if (tbPowerFactor == "50") {
    color = '#f5f264';
    markerLabel = '\uf2b5'; // Unicode for your fourth Font Awesome icon
    // tooltipContent = 'Dealer';

  }
  else if (tbPowerFactor == "40") {
    color = 'orange';
    markerLabel = '\uf0f8'; // Unicode for your fifth Font Awesome icon
    // tooltipContent = 'Retailer';

  }
  else if (tbPowerFactor == "60") {
    color = '#218c09';
    markerLabel = '\uf007'; // Unicode for your fifth Font Awesome icon
    // tooltipContent = 'Customer';

  }
   
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(locations[i][0], locations[i][1], locations[i][2],locations[i][3],locations[i][4]),
    map: map,
    // animation: google.maps.Animation.BOUNCE,
    animation: google.maps.Animation.DROP,
    className: 'marker', // Add the CSS class to the marker

label: {
        fontFamily: 'Fontawesome',
        text: markerLabel,
        className :'custom-marker-label',
        color: "black",
        fontSize : "20px",
       
},
    icon: {
      path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',

      fillColor: color,
      fillOpacity: 3,
    //   strokeColor: 'black',
    //   strokeWeight: 1.2,
      scale: 1.6,
      

    },

    // icon: locations[i][4] === '1' ? red_icon : purple_icon,
    html: "<div id='window_loc'>\n" +
    "<form method='GET'>\n" +
    "<table class=\"map1\" style='width: 227px;border: 1px solid black;border-collapse: collapse;'>\n" +
    "<tr style='border: 1px solid black;border-collapse: collapse;'>\n" +
    "<th style='border: 1px solid black;border-collapse: collapse; background-color:#1e88e566;color:white;'>Type:</th>" +
    "<td style='color:black;'><strong>" + 
    (locations[i][3] === '20' ? "<strong> STOCKIST </strong>" : 
    locations[i][3] === '30' ? "<strong> DISTRIBUTOR </strong>" : 
    locations[i][3] === '40' ? "<strong> RETAILER </strong>" : 
    locations[i][3] === '50' ? "<strong> RETAILER </strong>" : 
    "<strong> CUSTOMER </strong>") + "</td></tr>\n" + 
    "<th style='border: 1px solid black;border-collapse: collapse;background-color:#1e88e566;color:white;'>ID:</th>" +
    "<td style='color:black;'><strong>" + locations[i][2] + "</strong></td></tr>\n" + // ID
    "<tr>\n" +
    "<th style='border: 1px solid black;border-collapse: collapse;background-color:#1e88e566;color:white;'>Latitude:</th>" +
    "<td style='color:black;'><strong>" + locations[i][0] + "</strong></td></tr>\n" + // Latitude
    "<tr>\n" +
    "<th style='border: 1px solid black;border-collapse: collapse;background-color:#1e88e566;color:white;'>Longitude:</th>" +
    "<td style='color:black;'><strong>" + locations[i][1] + "</strong></td></tr>\n" + // Longitude
    "<tr>\n" +
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

   // Create a new marker clusterer
    markerCluster = new MarkerClusterer(map, markers, {
        imagePath: "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
        maxZoom: 15, // Adjust maximum zoom level to prevent cluster splitting at higher zoom levels
        gridSize: 60, // Adjust grid size for clustering based on your requirements
    });

    // Add event listeners for mouseover and mouseout events
    google.maps.event.addListener(markerCluster, 'mouseover', handleClusterMouseover);
    google.maps.event.addListener(markerCluster, 'mouseout', handleClusterMouseout);
}

function handleClusterMouseover(cluster) {
    var markersInCluster = cluster.getMarkers();
    var content = '<div>';
    markersInCluster.forEach(function(marker) {
        content += '<p>Marker ID: ' + marker.id + '</p>'; // Customize this as per your marker data
    });
    content += '</div>';

    infowindow.setContent(content);
    infowindow.setPosition(cluster.getCenter());
    infowindow.open(map);
}

function handleClusterMouseout() {
    infowindow.close();
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
<script src="dist/js/pages/maps/map-google.init.js"></script>
</html>
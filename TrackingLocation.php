<head>
  
  <link href="dist/css/style.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

     <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDonb2ULBup0rFfk6C8CSbGx2rcR52vm2o&callback=initMap&libraries=places&v=weekly&channel=2"
      async
    ></script> 

<style>
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
.marker-icon {
    background-color: #ff0000; /* Set your desired background color */
    padding: 5px; /* Optional: Add some padding to the marker image */
    border-radius: 50%; /* Optional: Add border-radius for rounded corners */
}
    </style>
<?php
// Start the session
session_start();

function get_locations_and_medicine($id, $type) {
    require("include/connection.php");

    $query = "";
    $medicineQuery = "";

    // Construct the SQL query based on the chosen ID type
    switch ($type) {
        case 'Carton':
            $query = "SELECT fdScanLat, fdScanLong, fdTrxnType, fdCreatedOn,fdTrxnOwner FROM tbScanlog WHERE fdCartonID = ?";
            $medicineQuery = "SELECT tbMedicineMaster.fdMedicineID, tbMedicineMaster.fdMedicineName 
                              FROM tbCarton 
                              JOIN tbMedicineMaster ON tbCarton.fdMedicineID = tbMedicineMaster.fdMedicineID 
                              WHERE tbCarton.fdCartonID = ?";
            break;
        case 'Packet':
            $query = "SELECT fdScanLat, fdScanLong, fdTrxnType, fdCreatedOn, fdTrxnOwner FROM tbScanlog WHERE fdPacketID = ?";
            $medicineQuery = "SELECT tbMedicineMaster.fdMedicineID, tbMedicineMaster.fdMedicineName 
                              FROM tbPacket 
                              JOIN tbMedicineMaster ON tbPacket.fdMedicineID = tbMedicineMaster.fdMedicineID 
                              WHERE tbPacket.fdPacketID = ?";
            break;
        case 'Strip':
            $query = "SELECT fdScanLat, fdScanLong, fdTrxnType, fdCreatedOn, fdTrxnOwner FROM tbScanlog WHERE fdStripID = ?";
            $medicineQuery = "SELECT tbMedicineMaster.fdMedicineID, tbMedicineMaster.fdMedicineName 
                              FROM tbMedicineStripTest 
                              JOIN tbMedicineMaster ON tbMedicineStripTest.fdMedicineID = tbMedicineMaster.fdMedicineID 
                              WHERE tbMedicineStripTest.fdStripID = ?";
            break;
        default:
            // Handle invalid type
            return null;
    }

    // Prepare and execute the SQL query
    if ($query !== "" && $medicineQuery !== "") {
        // Fetching locations
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $locations = [];
            while ($row = mysqli_fetch_assoc($result)) {
                // Only include locations with valid latitude and longitude
                if (!empty($row['fdScanLat']) && !empty($row['fdScanLong'])) {
                    $locations[] = array(
                        'fdLat' => $row['fdScanLat'],
                        'fdLong' => $row['fdScanLong'],
                        'fdTrxnType' => $row['fdTrxnType'],
                        'fdCreatedOn' => $row['fdCreatedOn'],
                        'fdTrxnOwner' => $row['fdTrxnOwner']
                    );
                }
            }
            mysqli_stmt_close($stmt);

            // Fetching medicine details
            $stmt = mysqli_prepare($conn, $medicineQuery);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $medicine = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

                return array('locations' => $locations, 'medicine' => $medicine);
            } else {
                // Error in preparing the statement
                die("Query Error: " . mysqli_error($conn));
            }
        } else {
            // Error in preparing the statement
            die("Query Error: " . mysqli_error($conn));
        }
    } else {
        // Invalid type
        return null;
    }
}


// Check if packet ID, carton ID, or strip ID is provided in the URL
if (isset($_GET["fdPacketID"])) {
    $id = $_GET["fdPacketID"];
    $type = 'Packet';
} elseif (isset($_GET["fdCartonID"])) {
    $id = $_GET["fdCartonID"];
    $type = 'Carton';
} elseif (isset($_GET["fdStripID"])) {
    $id = $_GET["fdStripID"];
    $type = 'Strip';
}

if (isset($id) && isset($type)) {
    $data = get_locations_and_medicine($id, $type);
    $locations = $data['locations'];
    $medicine = $data['medicine'];
}
?>
<html>
<head>
  
    <style type="text/css">
        #map {
            height: 400px;
            width: 100%;
        }
        .custom-marker-label {
            color: white; 
            width: 30px;  
            height: 30px; 
            margin-bottom:50px;
            border-radius: 50%; 
            line-height: 26px; 
            cursor: pointer;
            margin-top:-45px;
            position: relative;
            text-align: center;
            text-shadow: 0px 0px 2px #000000;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0"><strong><i class="fas fa-map-marker-alt"></i> LOCATION</strong></h4><br>
                    <div id="map"></div><br>
                    <div id="legend">
                        <div style="display: contents;"><span class="legend-marker" style="background-color: #e82020;"></span> Manufacturer</div>
                        <div style="display: contents;"><span class="legend-marker" style="background-color: #77f279;"></span> Stockist</div>
                        <div style="display: contents;"><span class="legend-marker" style="background-color: #9290e0;"></span> Distributor</div>
                        <div style="display: contents;"><span class="legend-marker" style="background-color: #f5f264;"></span> Dealer</div>
                        <div style="display: contents;"><span class="legend-marker" style="background-color: orange;"></span> Retailer</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var map;

    function initMap() {
        var packetLocations = <?php echo json_encode($locations); ?>;
        var medicine = <?php echo json_encode($medicine); ?>;
        console.log("Packet Locations: ", packetLocations); // Debugging line

        if (packetLocations.length === 0) {
            var defaultLocation = {lat: 0, lng: 0};
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center: defaultLocation
            });
            return;
        }

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: {lat: parseFloat(packetLocations[0].fdLat), lng: parseFloat(packetLocations[0].fdLong)}
        });

        var bounds = new google.maps.LatLngBounds();

        function getMarkerProperties(trxnType) {
            var color = '';
            var markerLabel = '';
            var tooltipContent = '';

            switch(trxnType) {
                case 'MNFRIN':
                case 'MNFROUT':
                    color = '#e82020';
                    markerLabel = '\uf1ad';
                    tooltipContent = 'Manufacturer';
                    break;
                case 'STKSIN':
                case 'STKSOUT':
                    color = '#77f279';
                    markerLabel = '\uf5fd';
                    tooltipContent = 'Stockist';
                    break;
                case 'DSTRIN':
                case 'DSTROUT':
                    color = '#9290e0';
                    markerLabel = '\uf362';
                    tooltipContent = 'Distributor';
                    break;
                case 'DELRIN':
                case 'DELROUT':
                    color = '#f5f264';
                    markerLabel = '\uf2b5';
                    tooltipContent = 'Dealer';
                    break;
                case 'RTLRIN':
                case 'RTLROUT':
                    color = 'orange';
                    markerLabel = '\uf0f8';
                    tooltipContent = 'Retailer';
                    break;
                default:
                    color = 'gray';
                    markerLabel = '\uf1f3';
                    tooltipContent = 'Unknown';
            }

            return {
                color: color,
                markerLabel: markerLabel,
                tooltipContent: tooltipContent
            };
        }

        for (var i = 0; i < packetLocations.length; i++) {
            console.log("Processing: ", packetLocations[i]); // Debugging line
            var position = {lat: parseFloat(packetLocations[i].fdLat), lng: parseFloat(packetLocations[i].fdLong)};
            var trxnType = packetLocations[i].fdTrxnType;
            var markerProps = getMarkerProperties(trxnType);

            var marker = new google.maps.Marker({
                position: position,
                map: map,
                animation: google.maps.Animation.DROP,
                label: {
                    fontFamily: 'Fontawesome',
                    text: markerProps.markerLabel,
                    className :'custom-marker-label',
                    color: "black",
                    fontSize: "20px",
                },
                icon: {
                    path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
                    fillColor: markerProps.color,
                    fillOpacity: 3,
                    scale: 1.6,
                },
            });

            bounds.extend(position);

            (function(marker, tooltipContent, fdCreatedOn, fdTrxnOwner, fdUserFName) {
    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'click', function() {
        var content = '<div style="font-size: 16px; color: black;width:200px;">' + 
                      tooltipContent + '<br>' +
                      'ID: ' + fdTrxnOwner + '<br>' +
                      'Name: ' + fdUserFName + '<br>' +
                      'Medicine ID: <a href="timeline.php?medicineID=' + medicine.fdMedicineID + '" target="_blank">' + medicine.fdMedicineID + '</a><br>' +
                      'Medicine Name: ' + medicine.fdMedicineName + '<br>' +
                      'Date & Time: ' + fdCreatedOn + 
                      '</div>';
        infowindow.setContent(content);
        infowindow.open(map, marker);
    });
})(marker, markerProps.tooltipContent, packetLocations[i].fdCreatedOn, packetLocations[i].fdTrxnOwner, packetLocations[i].fdUserFName);

        }

        map.fitBounds(bounds);

        var lineCoordinates = packetLocations.map(function(location) {
            return {lat: parseFloat(location.fdLat), lng: parseFloat(location.fdLong)};
        });

        var lineSymbol = {
            path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
            scale: 4,
            strokeColor: '#FF0000'
        };

        var polyline = new google.maps.Polyline({
            path: lineCoordinates,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2,
            icons: [{
                icon: lineSymbol,
                offset: '100%',
                repeat: '100px'
            }]
        });

        polyline.setMap(map);
    }
</script>

</body>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/app.init.dark.js"></script>
<script src="dist/js/app-style-switcher.js"></script>
<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="dist/js/pages/maps/map-google.init.js"></script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDonb2ULBup0rFfk6C8CSbGx2rcR52vm2o&callback=initMap&libraries=places&v=weekly&channel=2"
      async
    ></script> 

</html>

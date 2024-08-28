
<?php require "include/header.php";
 require "include/connection.php";  ?>
 <style>
    #mapCanvas {
    height: 300px;
}
</style>
<script>
// $(document).ready(function() {
//     $('#carton_id').on('change', function() {
//         var carton_id = this.value;
//         $.ajax({
//             url: "get_carton.php",
//             type: "POST",
//             data: {
//                 carton_id: carton_id
//             },
//             cache: false,
//             success: function(result){
//                 $("#packet_id").html(result);
//                 $('#strip_id').html('<option value="">Select Packet First</option>'); 
//             }
//         });
//     });
        
// });    
 
$(document).ready(function() {
$('#carton_id').on('change', function() {
    var carton_id = this.value;
    $.ajax({
        url: "get_packet.php", // Corrected the URL
        type: "POST",
        data: {
            carton_id: carton_id
        },
        cache: false,
        success: function(result) {
            // Clear and populate the state dropdown using Bootstrap Select
            $('#packet_id')
                .empty()
                .append(result)
                 .selectpicker('refresh'); // Refresh the Bootstrap Select
            $('#strip_id').html('<option value="">Select Packet First</option>');
        }
    });
});
});


$(document).ready(function() {
    $('#packet_id').on('change', function() {
        var packet_id = this.value;
        if (packet_id !== "") {
            $.ajax({
                url: "get_strip.php",
                type: "POST",
                data: {
                    packet_id: packet_id
                },
                cache: false,
                success: function(result) {
                    $('#strip_id').html(result);
                }
            });
        } else {
            // Clear the city dropdown if no state is selected
            $('#strip_id').html('<option value="">Select Strip</option>');
        }
    });
});

</script>
<?php
    // code fro add transection
   // code fro add transection
    if(isset($_POST['savebtn'])){

      $ScanLogID = $_POST['ScanLogID'];
      $CustomerID = $_POST['CustomerID'];
      $mid = $_POST['mid'];
      $sid = $_POST['sid'];
      $did = $_POST['did'];
      $deaid = $_POST['deaid'];
      $rid = $_POST['rid'];
      $Medicineid = $_POST['Medicineid'];
      $carton_id = $_POST['carton_id'];
      $packet_id = $_POST['packet_id'];
      $strip_id = $_POST['strip_id'];
      $DLlatitude = $_POST['DLlatitude'];
      $DLlongitude = $_POST['DLlongitude'];
     

      $command = escapeshellcmd("python3 test.py $ScanLogID $CustomerID $mid $sid $did $deaid $rid $Medicineid $carton_id $packet_id $strip_id $DLlatitude $DLlongitude");
      $output = shell_exec($command);

      if(isset($output)){
        echo '<div class="alert alert-success" role="alert">'.$output.'</div>'; 
      }else{
          echo '<div class="alert alert-danger" role="alert">Error:'.$output.'</div>'; 
          
      }
    }
    ?>
    
<div class="row">
<div class="col-12">
    <div class="card"> 
        <div class="card-header" style="background-color:#1e88e566;">
            <h4 class="mb-0 text-white"><strong>SCAN LOG DETAILS</strong></h4>
        </div>
    <form class="form-horizontal"  method="POST">
        <div class="card-body">
            <h5 class="card-title">SCAN LOG DETAILS</h5>
                <div class="card-body">
                    <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">ScanLog ID </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="ScanLogID" name="ScanLogID" placeholder="ScanLogID Here" >
                                        
                                    </div>  
                            </div>
                        </div> 
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Customer ID </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="CustomerID" name="CustomerID" placeholder="Customer ID Here" >
                                        
                                    </div>  
                            </div>
                        </div> 
                </div>
                <div class="row">                    
                        <!--<div class="col-sm-12 col-lg-6">-->
                        <!--    <div class="form-group row">-->
                        <!--        <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">BlockchainRecord ID </label>-->
                        <!--            <div class="col-sm-8">-->
                        <!--                <input type="text" class="form-control " id="BlockchainRecordID" name="BlockchainRecordID" placeholder="Blockchain Record ID Name Here" >-->
                                        
                        <!--            </div>  -->
                        <!--    </div>-->
                        <!--</div> -->
                        <!--<div class="col-sm-12 col-lg-6">-->
                        <!--    <div class="form-group row">-->
                        <!--        <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Scan Date </label>-->
                        <!--            <div class="col-sm-8">-->
                        <!--                <input type="date" class="form-control " id="ScanDate" name="ScanDate" placeholder=" Scan Date Here" >-->
                                        
                        <!--            </div>  -->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="nname" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Manufacturer ID </label>

                                <div class="col-sm-8">                      
                                <select name="mid" id="Mid" class="form-control required-field"onblur="validateField(this)" oninput="validateField(this)">
                                    <span class="error-message"></span>
                                   <option selected value="0">Select Manufacuture</option>
                                <?php
                                $query = "SELECT * FROM `tbManufacturerMaster`";
                                $result = mysqli_query($conn, $query);

                                foreach ($result as $row) {
                                    echo '<option value="' . $row["fdManufacturerID"] . '"> ' . $row["fdManufacturerID"] . ' </option>';
                                }

                                ?>
                            </select>
                                <span class="error-message"></span>
                                   
                            </div>  
                            
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Stockist ID<code>*</code></label>
                                    <div class="col-sm-8">
                                    <select name="sid" id="sid" class="form-control required-field"onblur="validateField(this)" oninput="validateField(this)">
                                    <span class="error-message"></span>
                                   <option selected value="0">Select Stockist ID</option>
                                   <?php
                                $query = "SELECT * FROM `tbStockistMaster`";
                                $result = mysqli_query($conn, $query);

                                foreach ($result as $row) {
                                    echo '<option value="' . $row["fdStockistID"] . '"> ' . $row["fdStockistID"] . ' </option>';
                                }

                                ?>
                            </select></div> 
                                </div>
                            </div>           
                        </div>

                        <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                 <label for="id" class="col-sm-4 text-right control-label col-form-label">Distributor ID <code>*</code></label>
                                <div class="col-sm-8">
                               
                                 <select name="did" id="did" class="form-control required-field" onblur="validateField(this)" oninput="validateField(this)" required>
                
                                <option selected value="0">Select Distributor ID</option>
                                <?php
                                $query = "SELECT * FROM `tbDistributorMaster`";
                                $result = mysqli_query($conn, $query);

                                foreach ($result as $row) {
                                    echo '<option value="' . $row["fdDistributorID"] . '"> ' . $row["fdDistributorID"] . ' </option>';
                                }

                                ?>
                            </select>
                            <span class="error-message"></span>
                                <!--<span class="error-message"></span>-->
                            
                                </div>                                    
                                </div>
                            </div> 
                            <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="nname" class="col-sm-4 text-right control-label col-form-label">Dealer ID <code>*</code></label>
                                <div class="col-sm-8">
                                    <select name="deaid" id="deaid" class="form-control" required>
                                    <span class="error-message"></span>   
                                    <option selected value="0">Select Dealer</option>
                                        <?php
                                        $query = "SELECT * FROM `tbDealerMaster`";
                                        $result = mysqli_query($conn, $query);

                                        foreach ($result as $row) {
                                            echo '<option value="' . $row["fdDealerID"] . '"> ' . $row["fdDealerID"] . ' </option>';
                                        }

                                        ?>
                                    </select>
                                </div>                                    
                            </div>
                        </div>

                </div>  
                <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="nname" class="col-sm-4 text-right control-label col-form-label">RetailerID <code>*</code></label>
                                <div class="col-sm-8">
                                    <select name="rid" id="rid" class="form-control" required>
                                    <span class="error-message"></span>   
                                    <option selected value="0">Select RetailerID</option>
                                        <?php
                                        $query = "SELECT * FROM `tbRetailerMaster`";
                                        $result = mysqli_query($conn, $query);

                                        foreach ($result as $row) {
                                            echo '<option value="' . $row["fdRetailerID"] . '"> ' . $row["fdRetailerID"] . ' </option>';
                                        }

                                        ?>
                                    </select>
                                </div>                                    
                            </div>
                        </div> 
                        <!--<div class="col-sm-12 col-lg-6">-->
                        <!--    <div class="form-group row">-->
                        <!--        <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Status</label>-->
                        <!--            <div class="col-sm-8">-->
                        <!--                <input type="text" class="form-control " id="status" name="Status" placeholder="Enter Status Here" >-->
                                        
                        <!--            </div>  -->
                        <!--    </div>-->
                        <!--</div> -->
                </div>  
                </div>
                                    </div>
            <hr style="margin-top: -25px; margin-bottom: -1px; background: grey;opacity: 0.5;">
        <div class="card-body">
        <h5 class="card-title mb-0">MEDICINE DETAILS</h5>
        <div class="card-body">
        <!-- <div class="row mb-0"> -->
       
        <div class="row">                    
                <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Medicine ID </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="Medicineid" name="Medicineid" placeholder="Medicine ID Here" >
                                        
                                    </div>  
                            </div>
                        </div> 
                        <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label">Carton ID</label>
                                        <div class="col-sm-8">
                                        <select class="form-control required-field" id="carton_id" name="carton_id" onblur="validateField(this)" oninput="validateField(this)" required>
    <option value="">Select Carton ID</option>  
    <?php
    require_once "include/connection.php";
    $result = mysqli_query($conn,"SELECT * FROM tbCarton");
    while($row = mysqli_fetch_array($result)) {
    ?>
        <option value="<?php echo $row["fdCartonID"];?>"><?php echo $row["fdCartonID"];?></option>
    <?php
    }
    ?>
</select>
<span class="error-message"></span>                      
                    </div>                                                
                </div>
            </div> 
</div>
<div class="row">                    
<div class="col-sm-12 col-lg-6">
                <div class="form-group row">
                    <label class="col-sm-4 text-right control-label col-form-label">Packet ID</label>
                    <div class="col-sm-8">
                    <select class="form-control required-field selectpicker" id="packet_id" name="packet_id" onblur="validateField(this)" oninput="validateField(this)" required>
                 
                    
                    </select>
                    <span class="error-message"></span> 

                                    </div>
                                    <script>
    $(function() {
        $('.selectpicker').selectpicker();
    });
</script>
                                </div>
                                </div>
                                
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label">Strip ID</label>
                                        <div class="col-sm-8">
                                        <select class="form-control required-field" id="strip_id" name="strip_id" onblur="validateField(this)" oninput="validateField(this)" required>
    

        </select>
        <span class="error-message"></span> 
                                    </div>
                                    </div>
                                </div>

</div>
<div class="row">                    
                <!--<div class="col-sm-12 col-lg-6">-->
                <!--            <div class="form-group row">-->
                <!--                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Scan Location</label>-->
                <!--                    <div class="col-sm-8">-->
                <!--                        <input type="text" class="form-control " id="ScanLocation" name="ScanLocation" placeholder="Scan Location Here" >-->
                                        
                <!--                    </div>  -->
                <!--            </div>-->
                <!--        </div> -->
                        <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 text-right control-label col-form-label">Scan Latitude <code>*</code></label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control required-field" id="DLlatitude" name="DLlatitude" placeholder="Distributor Latitude Here" onblur="validateField(this)" oninput="validateField(this)"> 
                                    <span class="error-message"></span>                                                  
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 text-right control-label col-form-label">Scan Longitude <code>*</code></label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control required-field" id="DLlongitude" name="DLlongitude" placeholder="Distributor Longitude Here" onblur="validateField(this)" oninput="validateField(this)">  
                                    <span class="error-message"></span>                                                  
                                    </div>
                                </div>
                            </div>  
</div>
<div class="container border rounded pt-3 pb-3" style="background:#3a404e;">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">
                        <input type="button" class="btn btn-primary btn-sm" value="Locate Me" onclick="initMap()">
                    </label>
                    <div class="col-sm-9">
                    <input placeholder="Current Address" type="text" name="mapadd" id="location" class="form-control">                                                   
                    </div>
                </div>
            </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label class="col-sm-4 text-right control-label col-form-label">Enter Location</label>
                <div class="col-sm-8">
                <input id="searchInput" class="form-control" type="text" placeholder="Enter a location">
                </div>                                                    
            </div>
        </div>
        </div>
                        
        <div id="mapCanvas"></div>
    </div>
  
         
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDonb2ULBup0rFfk6C8CSbGx2rcR52vm2o&callback=initMap&libraries=places&v=weekly&channel=2"
    async
  ></script> 
                            </div>           
                    </div> 

                
                       
        <hr style="margin-top: -25px; margin-bottom: -1px; background: grey;opacity: 0.5;">
<!--        <div class="card-body">-->
<!--        <h5 class="card-title mb-0">IMAGE</h5>-->
<!--        <div class="card-body">-->
<!--        <div class="row mb-0">-->
<!--        <div class="col-sm-12 col-lg-6">-->
<!--        <div class="form-group row">-->
<!--    <label for="cono12" class="col-sm-4 text-right control-label col-form-label">User Photo</label>-->
<!--        <div class="input-group col-sm-8">-->
<!--        <div class="input-group-prepend">-->
<!--                <input type="file" id="P_image" name="P_image" class="form-control" onchange="displayUserPhoto(this)">-->
<!--                <span class="input-group-text">Upload</span>-->
<!--            </div>-->

<!--            <div class="col-sm-4">-->
                <!-- Display the user photo from the database -->
<!--                <img id="userPhoto" src="image/profile/<?php echo $rows["fdProfileImage"]; ?>" width="100" align="right" style="float: left;margin-top:-40px; margin-left:355%;">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--</div>-->
<!--<script>-->
<!--function displayUserPhoto(input) {-->
<!--    var reader = new FileReader();-->
<!--    reader.onload = function (e) {-->
<!--        document.getElementById('userPhoto').src = e.target.result;-->
<!--    };-->
<!--    reader.readAsDataURL(input.files[0]);-->
<!--}-->
<!--</script>-->
<!--</div>-->
<!--</div>                      -->


                           

        <div class="card-body">
            <div class="form-group mb-0 d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-success waves-effect waves-light" name="savebtn" id="savebtn">Submit</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>

    
    <script>
    var map, infoWindow;
    var geocoder;
    var marker;

    function initMap() {
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('mapCanvas'), {
            center: { lat: 20.5937, lng: 78.9629 },
            zoom: 16
        });
        infoWindow = new google.maps.InfoWindow;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    draggable: true,
                    title: 'Your position'
                });

                map.setCenter(pos);
                updateMarkerPosition(marker.getPosition());
                geocodeLatLng(pos);

                google.maps.event.addListener(marker, 'dragend', function () {
                    updateMarkerPosition(marker.getPosition());
                    geocodeLatLng(marker.getPosition());
                });

            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            handleLocationError(false, infoWindow, map.getCenter());
        }

        var input = document.getElementById('searchInput');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function () {
            
            // Remove the existing marker if it exists
            if (marker) {
                marker.setMap(null);
            }
            
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            map.setCenter(place.geometry.location);

            marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location,
                draggable: true,
                title: place.name
            });
            
            google.maps.event.addListener(marker, 'dragend', function () {
            updateMarkerPosition(marker.getPosition());
            geocodeLatLng(marker.getPosition());
        });

            updateMarkerPosition(marker.getPosition());
        
            document.getElementById('location').value = place.formatted_address;

            // google.maps.event.addListener(marker, 'dragend', function () {
            //     updateMarkerPosition(marker.getPosition());
            // });
        });
    }

    function geocodeLatLng(latlng) {
    geocoder.geocode({ 'location': latlng }, function (results, status) {
        if (status === 'OK') {
            if (results[0]) {
                document.getElementById('location').value = results[0].formatted_address;
            } else {
                document.getElementById('location').value = 'No results found';
            }
        } else {
            document.getElementById('location').value = 'Geocoding failed: ' + status;
        }
    });
}

    function updateMarkerPosition(latLng) {
        document.getElementById('DLlatitude').value = latLng.lat();
        document.getElementById('DLlongitude').value = latLng.lng();
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }
</script>
<?php require "include/footer.php"; ?>
<?php 
//  include("include/connection.php");
//  include("include/header.php");
//  include("include/navbar.php");
session_start();
$RoleUniqueID=$_SESSION['fdRoleUniqueID'] ;

date_default_timezone_set('Asia/Kolkata');

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');

// split the date and time into separate variables
$date = date('Y-m-d', strtotime($currentDateTime));
$time = date('H:i:s', strtotime($currentDateTime));
?>


<script>    

function validateField(inputField) {
        var errorSpan = inputField.nextElementSibling;

        if (inputField.value.trim() === '') {
            errorSpan.textContent = 'This field is required';
            inputField.classList.add('error');
        } else {
            errorSpan.textContent = ''; // Clear the error message
            inputField.classList.remove('error');
        }
    }
    function validateAllRequiredFields() {
    var requiredFields = document.querySelectorAll('.required-field');
    var hasError = false;

    requiredFields.forEach(function (field) {
        if (field.value.trim() === '') {
            validateField(field);
            hasError = true;
        }
    });

    if (hasError) {
        // Display an error message or prevent form submission
        alert('Please fill in all required fields.');
    } else {
        // All required fields are filled, you can submit the form
        document.querySelector('form').submit();
    }
}
</script>

<?php

        if(isset($_POST['updatebtn'])){
            $rid=$_POST['rid'];
            $mid=$_POST['mid'];
            $sid=$_POST['sid'];
            $disid=$_POST['disid'];
            $deaid=$_POST['deaid'];
            $sname = $_POST['sname'];
            $hname = $_POST['hname'];
            $haddress1 = $_POST['haddress1'];
            $haddress2 = $_POST['haddress2'];
            $hcity = $_POST['hcity'];
            $hstate = $_POST['hstate'];
            $hcountry = $_POST['hcountry'];
            $hpostcode = $_POST['hpostcode'];
            $hphone = $_POST['hphone'];
            $hemail = $_POST['hemail'];
            $slatitude = $_POST['slatitude'];
            $slagitude = $_POST['slagitude'];
            $hweb1 = $_POST['hweb1'];
            $oname = $_POST['oname'];
            $ophonenumber = $_POST['ophonenumber'];
            $oemail = $_POST['oemail'];
            $cp1name = $_POST['cp1name'];
            $cp1phonenumber = $_POST['cp1phonenumber'];
            $cp1email = $_POST['cp1email'];
            $cp2name = $_POST['cp2name'];
            $cp2phonenumber = $_POST['cp2phonenumber'];
            $cp2email = $_POST['cp2email'];
            $notes = $_POST['notes'];
            $date = $conn->real_escape_string($date);
            $time = $conn->real_escape_string($time);
            $newfilename = "";
        if (isset($_FILES["P_image"]) && $_FILES["P_image"]["error"] == 0) {
        $filename = $_FILES["P_image"]["name"];
          $tempname = $_FILES["P_image"]["tmp_name"];
  
      $filepath_info = pathinfo($filename);
  
      $filename = $filepath_info['filename'];
      $curentTimeStam = date("m/d/Y H:i:s a", time());
      $newfilename = md5($filename . $curentTimeStam);
  
      $extension = $filepath_info['extension'];
      $newfilename = $newfilename. '.'.$extension;
  
      $folder = "image/profile/" . $newfilename;
      move_uploaded_file($tempname, $folder);
  }
  
        
          $updateSql = "UPDATE tbRetailerMaster SET fdRetailerName= '$sname' ,fdStockistID= '$sid', fdDistributorID= '$disid',fdDealerID= '$deaid',fdHeadOfficeName= '$hname', fdHeadOfficeAddressLine1= '$haddress1', fdHeadOfficeAddressLine2= '$haddress2', fdHeadOfficeCity= '$hcity', fdHeadOfficeState= '$hstate', fdHeadOfficeCountry= '$hcountry', fdHeadOfficePostalCode= '$hpostcode', fdHeadOfficePhoneNumber= '$hphone', fdHeadOfficeEmail= '$hemail', fdRetailerLat= '$slatitude', fdRetailerLong= '$slagitude', fdOwnerName= '$oname', fdOwnerPhoneNumber= '$ophonenumber', fdOwnerEmail= '$oemail', fdContactPerson1Name= '$cp1name',fdContactPerson1PhoneNumber= '$cp1phonenumber', fdContactPerson1Email= '$cp1email', fdContactPerson2Name= '$cp2name',fdContactPerson2PhoneNumber= '$cp2phonenumber', fdContactPerson2Email= '$cp2email', fdWebsiteURL= '$hweb1', fdManufacturerID= '$mid', fdNotes= '$notes', fdDate= '$date', fdTime= '$time', fdProfileImage='$newfilename' WHERE fdRetailerID= '$rid' ";
          
          
          if ($result = mysqli_query($conn, $updateSql)){
            $sql1 = "UPDATE tbUserMaster SET fdUserFName='$oname', fdEmailAsUserID='$oemail',fdPhoneNumber='$ophonenumber', fdCountry='$hcountry', fdCity='$hcity', fdState='$hstate', fdZipCode='$hpostcode', fdLatitude='$slatitude', fdLongitude='$slagitude', fdProfileImage='$newfilename' WHERE fdRoleUniqueID= '$rid'";
            if (mysqli_query($conn,$sql1)) {
            echo'<script>Swal.fire({
                icon: "success",
                title: "Updated Successfully",
              }).then(function(){
              window.location ="?ListRetailer";
                  });
              </script>';            
          } else {
              echo'<script>Swal.fire({ 
                  icon: "error",
                  title:"Failed  to update !"});
              </script>';
          }
      }
    }

            $retailer_id = $_GET['rid'];
            $query = "SELECT * FROM tbRetailerMaster WHERE fdRetailerID = '$retailer_id'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn)); // Add this line to display MySQL errors
            }

            if (mysqli_num_rows($result) > 0) {
                $rows = mysqli_fetch_assoc($result);
                $manufacturerID = $rows['fdManufacturerID'];
            }
?>        

<style>
label.control-label{
    white-space:nowrap;
}
.error-message {
            color:#e83e8c;
            font-size: 14px;
        }
#mapCanvas {
    height: 300px;
}
.iti {
    width: 100%;
}

.iti__selected-flag {
    border: 1px solid #4f5467; /* Dark border color */
    background-color: #272b34; /* Dark background color */
    color: #fff; /* White text color */
}

.iti__arrow {
    border: 1px solid #4f5467; /* Dark border color */
}

.iti__country-list {
    background-color: #272b34; /* Dark background color */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Dark box shadow */
}

.iti__country-list-item {
    color: #fff; /* White text color */
}

</style>
<script>
$(document).ready(function() {
    $('#hcountry').on('change', function() {
            var country_id = this.value;
            $.ajax({
                url: "get_country.php",
                type: "POST",
                data: {
                    country_id: country_id
                },
                cache: false,
                success: function(result){
                    $("#hstate").html(result);
                    $('#hcity').html('<option value="">Select State First</option>'); 
                }
            });
        });
         
    });    
 
    $(document).ready(function() {
    $('#hcountry').on('change', function() {
        var country_id = this.value;
        $.ajax({
            url: "get_state.php", // Corrected the URL
            type: "POST",
            data: {
                country_id: country_id
            },
            cache: false,
            success: function(result) {
                // Clear and populate the state dropdown using Bootstrap Select
                $('#hstate')
                    .empty()
                    .append(result)
                    .selectpicker('refresh'); // Refresh the Bootstrap Select
                $('#hcity').html('<option value="">Select State First</option>');
            }
        });
    });
});


$(document).ready(function() {
    $('#hstate').on('change', function() {
        var state_id = this.value;
        if (state_id !== "") {
            $.ajax({
                url: "get_city.php",
                type: "POST",
                data: {
                    state_id: state_id
                },
                cache: false,
                success: function(result) {
                    $('#hcity').html(result);
                }
            });
        } else {
            // Clear the city dropdown if no state is selected
            $('#hcity').html('<option value="">Select City</option>');
        }
    });
});

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>


<div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-header" style="background-color:#1e88e566;">
            <h4 class="mb-0 text-white"><strong>UPDATE RETAILER</strong></h4>
            </div>
            <!-- <hr style="margin-top: -5px; margin-bottom: -4px; background: grey; opacity:0.5;"> -->
            <form class="form-horizontal"  method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Retailer User</h4>
                    <div class="card-body">
                        <div class="row">                    
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Retailer Name <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" class= "form-control required-field" id= "sname" name= "sname" value= "<?php echo $rows['fdRetailerName'];?>" onblur="validateField(this)" oninput="validateField(this)" required>
                                        <span class="error-message"></span>  
                                    </div>  
                                </div>
                            </div>
                      
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Retailer ID <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" class= "form-control" id= "rid" name= "rid" value= "<?php echo $retailer_id?>" readonly>
                                        </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="nname" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Stockist ID <code>*</code></label>
                                <div class="col-sm-8">
                <input type="text" class="form-control" id="sid" name="sid" value="<?php echo $rows['fdStockistID']; ?>" readonly>
                </div>                                   
                            </div>
                        </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Distributor ID <code>*</code></label>
                                    <div class="col-sm-8">
                <input type="text" class="form-control" id="disid" name="disid" value="<?php echo $rows['fdDistributorID']; ?>" readonly>
            </div>                                    
                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="nname" class="col-sm-4 text-right control-label col-form-label">Dealer ID <code>*</code></label>
                                <div class="col-sm-8">
                <input type="text" class="form-control" id="deaid" name="deaid" value="<?php echo $rows['fdDealerID']; ?>" readonly>
            </div>                                    
                                </div>
                            </div>

                            <div class="col-sm-12 col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="fname3" class="col-sm-4 text-right control-label col-form-label">Manufacturer ID <code>*</code></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="mid" name="mid" value="<?php echo $manufacturerID ?>" readonly>
                                                <span class="error-message"></span> 
                                        </div>                                    
                                </div>
                            </div>
                        </div> 
                    </div> 
                    </div>                    

                    <hr style="margin-top: -15px; margin-bottom : -1px; background: grey; opacity: 0.5;">
                    
                    <div class="card-body">
                    <h4 class="card-title">Head Office Details</h4>
                        <div class="card-body">
                        <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                    <label for="fname2" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Head Office Name <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" class= "form-control required-field" id= "hname" name= "hname" 
                                        value= "<?php echo $rows['fdHeadOfficeName'];?>" onblur="validateField(this)" oninput="validateField(this)" required>
                                        <span class="error-message"></span>  
                                    </div>                                   
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row ">
                                    <label for="web1" class="col-sm-4 text-right control-label col-form-label">Website </label>
                                    <div class="col-sm-8">
                                        <input type="text" class= "form-control" id= "hweb1" name= "hweb1" value= "<?php echo $rows['fdWebsiteURL'];?>" >
                                        <span class="error-message"></span>  
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="cono12" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Phone Number <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="tel" class="form-control required-field" name= "hphone" id= "hphone"  value= "<?php echo $rows['fdHeadOfficePhoneNumber'];?>" onblur="validateField(this)" oninput="validateField(this)" required>
                                        <span class="error-message"></span>  
                                    </div>                                   
                                </div>
                            </div>
                                <script>
                                     const phoneInputField = document.querySelector("#hphone");
                        
                                        const phoneInput = window.intlTelInput(phoneInputField, {
                                        utilsScript:
                                            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                                        // Enable the country dropdown search
                                        allowDropdown: true,
                                        initialCountry: "in", // Replace with the ISO 3166-1 alpha-2 country code you want
                                        nationalMode: true,
                                        separateDialCode: true,

                                        // Set the minimum number of characters needed to show the dropdown
                                        dropdownSearch: 2,
                                        });
                                </script>

                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control required-field" id= "hemail" name= "hemail" 
                                        value= "<?php echo $rows['fdHeadOfficeEmail'];?>" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$">
                                          
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label class="control-label text-right col-sm-4">Country <code>*</code></label>
                                <div class="col-sm-8">
                                <select class="form-control required-field" id="hcountry" name="hcountry" onblur="validateField(this)" oninput="validateField(this)" required>
                                    <option value="">Select Country</option>  
                                    <?php
                                    require_once "include/connection.php";
                                    $result = mysqli_query($conn,"SELECT * FROM tbCountries");
                                    while($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <option value="<?php echo $row['id'];?>" <?php if ($row['id'] == $rows["fdHeadOfficeCountry"]) echo 'selected'; ?>><?php echo $row["name"];?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                    <span class="error-message"></span>  
                                </div>                                                
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label class="col-sm-4 text-right control-label col-form-label">State <code>*</code></label>
                                <div class="col-sm-8">
                                    <select class="form-control required-field selectpicker" id="hstate" name="hstate" onblur="validateField(this)" oninput="validateField(this)" required>
                            <!-- <option value="">Select State</option> -->
                            
                            <?php
                                    $selectedStateId = $rows["fdHeadOfficeState"];
                                 // Assuming fdHeadOfficeStates is the ID of the State

                                    require_once "include/connection.php";
                                    $result = mysqli_query($conn, "SELECT id, name FROM tbStates WHERE id = '$selectedStateId'");
                                    $stateRow = mysqli_fetch_assoc($result);
                                    ?>
                                    <option value="<?php echo $stateRow['id']; ?>" selected><?php echo $stateRow['name']; ?></option>
        
        
                                    </select>
                                    <span class="error-message"></span>  
                                </div>                                            
                            </div>
                        </div>
                    </div>
                <script>
                            $(function() {
                                $('.selectpicker').selectpicker();
                            });
                </script>

                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label">City <code>*</code></label>
                                <div class="col-sm-8">
                                    <select class="form-control required-field" id="hcity" name="hcity" onblur="validateField(this)" oninput="validateField(this)" required>                                
                                    <?php
                                // Assuming fdHeadOfficeCity is the ID of the city
                                $selectedCityId = $rows["fdHeadOfficeCity"];

                                require_once "include/connection.php";
                                $result = mysqli_query($conn, "SELECT id, name FROM tbCities WHERE id = $selectedCityId");
                                $cityRow = mysqli_fetch_assoc($result);
                                ?>
                                <option value="<?php echo $cityRow['id']; ?>" selected><?php echo $cityRow['name']; ?></option>

                                    </select>
                                    <span class="error-message"></span>  
                                </div>                                                    
                            </div>
                        </div>
                            <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label">Post Code <code>*</code></label>
                                        <div class="col-sm-8">
                                            <input type="text" class= "form-control required-field" id= "hpostcode" name= "hpostcode" value="<?php echo $rows['fdHeadOfficePostalCode'];?>"  onblur="validateField(this)" oninput="validateField(this)" required>
                                        <span class="error-message"></span>  
                                </div>                                                    
                                    </div>
                            </div>                 
                        </div>    
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 text-right control-label col-form-label">Address 1 <code>*</code></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control required-field" id= "haddress1" name= "haddress1" value= "<?php echo $rows['fdHeadOfficeAddressLine1'];?>" onblur="validateField(this)" oninput="validateField(this)" required>
                                        <span class="error-message"></span>  
                                </div>                                                    
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 text-right control-label col-form-label">Address 2</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id= "haddress2" name= "haddress2"  value= "<?php echo $rows['fdHeadOfficeAddressLine2'];?>">
                                        <span class="error-message"></span>  
                                 </div>                                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label" style="white-space: nowrap;">Latitude <code>*</code></label>
            <div class="col-sm-8" style="display: flex;">
                <input type="text" class="form-control required-field" id="slatitude" name="slatitude" value="<?php echo $rows['fdRetailerLat']; ?>" onblur="validateField(this)" oninput="validateField(this)" required>
                <span class="error-message"></span>
                <button class="btn btn-outline-secondary" type="button" onclick="refreshLatitude()" style="border-color: #80808000;">
                    <i class="fas fa-sync-alt"></i>
                </button>
                
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label" style="white-space: nowrap;">Longitude <code>*</code></label>
            <div class="col-sm-8" style="display: flex;">
                <input type="text" class="form-control required-field" id="slangitude" name="slagitude" value="<?php echo $rows['fdRetailerLong']; ?>" onblur="validateField(this)" oninput="validateField(this)" required>
                <span class="error-message"></span>
                <button class="btn btn-outline-secondary" type="button" onclick="refreshLongitude()" style="border-color: #80808000;">
                    <i class="fas fa-sync-alt"></i>
                </button>
               
            </div>
        </div>
    </div>
</div>

                        <div class="container border rounded pt-3 pb-3" style="background:#3a404e;">
                        <div class="row">
                             <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 text-right control-label col-form-label">
                                        <input type="button" class="btn btn-primary btn-sm" value="Locate Me" onclick="initMap()">
                                    </label>
                                    <div class="col-sm-8">
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
                        <script>
                        function refreshLatitude() {
                        // Get the updated latitude value from your data source and set it in the input field
                        var updatedLatitude = <?php echo $rows["fdRetailerLat"]; ?>;
                        document.getElementById('slatitude').value = updatedLatitude;
                        }

                    function refreshLongitude() {
                        // Get the updated longitude value from your data source and set it in the input field
                        var updatedLongitude = <?php echo $rows["fdRetailerLong"]; ?>;
                        document.getElementById('slangitude').value = updatedLongitude;
                    }

                    </script>
                    <script
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDonb2ULBup0rFfk6C8CSbGx2rcR52vm2o&callback=initMap&libraries=places&v=weekly&channel=2"
                        async>
                    </script> 
<script>
    var map, infoWindow;
    var geocoder;
    var marker;

    function initMap() {
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('mapCanvas'), {
            center: { lat: <?php echo $rows['fdRetailerLat']; ?>, lng: <?php echo $rows['fdRetailerLong']; ?> },
            zoom: 16
        });
        infoWindow = new google.maps.InfoWindow;

        // Add marker to the map
        marker = new google.maps.Marker({
            position: { lat: <?php echo $rows['fdRetailerLat']; ?>, lng: <?php echo $rows['fdRetailerLong']; ?> },
            map: map,
            draggable: true,
            title: 'Retailer Location'
        });

        // Update marker position on drag
        google.maps.event.addListener(marker, 'dragend', function () {
            updateMarkerPosition(marker.getPosition());
            geocodeLatLng(marker.getPosition());
        });

        // Update marker position and address on autocomplete place selection
        var input = document.getElementById('searchInput');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function () {
            if (marker) {
                marker.setMap(null); // Remove existing marker
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
        });
    }

    // Function to update marker position
    function updateMarkerPosition(latLng) {
        document.getElementById('slatitude').value = latLng.lat();
        document.getElementById('slangitude').value = latLng.lng();
    }

    // Function to handle geocoding of latlng
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
</script>

        </div>
            </div> 

            <hr style="margin-top: -25px; margin-bottom: -1px; background: grey;opacity: 0.5;">
<div class="card-body">
<h4 class="card-title">Profile Photo</h4>
<div class="card-body">
<div class="row">
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="cono12" class="col-sm-4 text-right control-label col-form-label">User Photo</label>
        <div class="input-group col-sm-8">
            <div class="input-group-prepend">
                <input type="file" id="P_image" name="P_image" class="form-control" onchange="displayUserPhoto(this)">
                <span class="input-group-text">Upload</span>
            </div>

            <div class="col-sm-4">
                <!-- Display the user photo from the database -->
                <img id="userPhoto" src="<?php echo !empty($rows["fdProfileImage"]) ? 'image/profile/'.$rows["fdProfileImage"] : ''; ?>" width="100" align="right" style="float: left; margin-top: -40px; margin-left: 410%;">
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<script>
function displayUserPhoto(input) {
        var preview = document.getElementById('userPhoto');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Show the image preview
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            preview.style.display = 'none'; // Hide the image preview if no file is selected
        }
    }
</script>   

    <hr style="margin-top : -30px; margin-bottom : -4px; background: grey; opacity: 0.5;">
            <div class="card-body">
                <h4 class="card-title">Owner Details
                </h4>                                     
                <div class="card-body">                                        
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Owner Name <code>*</code></label>
                                <div class="col-sm-8">
                                    <input type="text" class= "form-control required-field" id= "oname"  name= "oname" value= "<?php echo $rows['fdOwnerName'];?>" onblur="validateField(this)" oninput="validateField(this)" required>
                                    <span class="error-message"></span>  
                                </div>                               
                            </div>
                        </div>  
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Phone Number <code>*</code></label>
                                <div class="col-sm-8">
                                    <input type="tel" class="form-control required-field" name= "ophonenumber" id= "ophonenumber" value= "<?php echo $rows['fdOwnerPhoneNumber'];?>" onblur="validateField(this)" oninput="validateField(this)" required>
                                    <span class="error-message"></span>  
                                </div>                                
                            </div>
                        </div> 
                    </div> 
                    <script>
                        const phoneInputField1 = document.querySelector("#ophonenumber");
                    
                        const phoneInput1 = window.intlTelInput(phoneInputField1, {
                        utilsScript:
                            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                        // Enable the country dropdown search
                        allowDropdown: true,
                        initialCountry: "in", // Replace with the ISO 3166-1 alpha-2 country code you want
                        nationalMode: true,
                        separateDialCode: true,

                        // Set the minimum number of characters needed to show the dropdown
                        dropdownSearch: 2,
                        });
                    </script>
                    <div class="row">                           
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email <code>*</code></label>
                                <div class="col-sm-8">
                                    <input type="email" class= "form-control required-field" id= "oemail" name= "oemail" value= "<?php echo $rows['fdOwnerEmail'];?>" onblur="validateField(this)" oninput="validateField(this)" required>
                                    <span class="error-message"></span>  
                                </div>                                   
                            </div>
                        </div>
                    </div>                                                        
                </div>
            </div>
                    
    <hr style="margin-top: -30px; margin-bottom: -4px; background: grey; opacity: 0.5;">
        <div class="card-body">
            <h4 class="card-title">Contact Person1 Details</h4>
                <div class="card-body">                  
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Person1 Name</label>
                                <div class="col-sm-8">
                                    <input type= "text" class= "form-control required-field" id="cp1name"  name= "cp1name" 
                                    value= "<?php echo $rows['fdContactPerson1Name'];?>">
                                    
                                </div>                                
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Phone Number</label>
                                <div class="col-sm-8">
                                    <input type="tel" class="form-control required-field" name= "cp1phonenumber" id= "cp1phonenumber" value= "<?php echo $rows['fdContactPerson1PhoneNumber'];?>">
                                    
                                </div>                               
                            </div>
                        </div>
                    </div>
                    <script>
                        const phoneInputField2 = document.querySelector("#cp1phonenumber");
                    
                        const phoneInput2 = window.intlTelInput(phoneInputField2, {
                        utilsScript:
                            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                        // Enable the country dropdown search
                        allowDropdown: true,
                        initialCountry: "in", // Replace with the ISO 3166-1 alpha-2 country code you want
                        nationalMode: true,
                        separateDialCode: true,

                        // Set the minimum number of characters needed to show the dropdown
                        dropdownSearch: 2,
                        });
                    </script>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class= "form-control required-field" id="cp1email" name= "cp1email" value= "<?php echo $rows['fdContactPerson1Email'];?>">
                                    
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
        </div>
                    
    <hr style="margin-top: -30px; margin-bottom: -4px; background: grey; opacity: 0.5;">
        <div class="card-body">
            <h4 class="card-title">Contact Person2 Details</h4>
                <div class="card-body">                  
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Person2 Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class= "form-control" id= "cp2name"  name= "cp2name" 
                                    value= "<?php echo $rows['fdContactPerson2Name'];?>">
                                </div>                                
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Phone Number</label>
                                <div class="col-sm-8">
                                    <input type="tel" class="form-control" name= "cp2phonenumber" id= "cp2phonenumber" value= "<?php echo $rows['fdContactPerson2PhoneNumber'];?>">
                                </div>                                
                            </div>
                        </div> 
                    </div>
                    <script>
                        const phoneInputField3 = document.querySelector("#cp2phonenumber");
                    
                        const phoneInput3 = window.intlTelInput(phoneInputField3, {
                        utilsScript:
                            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                        // Enable the country dropdown search
                        allowDropdown: true,
                        initialCountry: "in", // Replace with the ISO 3166-1 alpha-2 country code you want
                        nationalMode: true,
                        separateDialCode: true,

                        // Set the minimum number of characters needed to show the dropdown
                        dropdownSearch: 2,
                        });
                    </script>
                    <div class="row">                         
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class= "form-control" id= "cp2email" name= "cp2email" value= "<?php echo $rows['fdContactPerson2Email'];?>">
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    <hr style="margin-top: -30px; margin-bottom: -4px; background: grey; opacity: 0.5;">
        <div class="card-body">
                <h4 class="card-title">Notes</h4>
                    <div class="card-body">
                        <div class="row">                            
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group row">
                                    <label for="notes" class="col-sm-2 text-right control-label col-form-label">Notes</label>
                                        <div class="col-sm-9">
                                            <input type="text" class= "form-control" id= "notes" name= "notes" value= "<?php echo $rows['fdNotes'];?>">                                  
                                        </div>                                    
                                </div>
                            </div>
                    </div>
               </div>   
            </div>                                
        <div class="card-body">
            <div class="form-group mb-0 ">
             <td>
            <!-- <button href="?ListRetailer" type="submit" class="btn btn-danger waves-effect waves-light float-left">Cancel</button> -->                    
            <button type="submit" class="btn btn-warning waves-effect waves-light float-left" name="updatebtn" id="updatebtn" onclick="validateAllRequiredFields()">Update</button>
            </td>
        </div>
    </div>
</form><br><br>
</div>
</div>
</div>
</div>




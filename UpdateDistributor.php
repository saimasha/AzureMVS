<!--  Jidnyasa Patil ///28/09/2023 -- Update form> -->

<!-- <title>Update Distributor Details </title> -->
<?php session_start();
//  $roleid = $_SESSION['fdRoleID'];
$RoleUniqueID = $_SESSION['fdRoleUniqueID'];

date_default_timezone_set('Asia/Kolkata');

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');

// Split the date and time into separate variables
$date = date('Y-m-d', strtotime($currentDateTime));
$time = date('H:i:s', strtotime($currentDateTime));
   
if(isset($_POST['Updatebtn'])){

    $Did=$_POST['Did'];
    // $HierarchyLevel = $_POST['HierarchyLevel'];
      $Mid=$_POST['Mid'];
      $sid = $_POST['sid'];
      $DName=$_POST['DName'];
      $HOName=$_POST['HOName'];
      $HOAddress1=$_POST['HOAddress1'];
      $HOAddress2=$_POST['HOAddress2'];
      $HOCity=$_POST['HOCity'];
      $HOState=$_POST['HOState'];
      $HOCountry=$_POST['HOCountry'];
      $HOPostcode=$_POST['HOPostcode'];
      $HOPhone=$_POST['HOPhone'];
      $HOEmail=$_POST['HOEemail'];
      $DLlatitude=$_POST['DLlatitude'];
      $DLlongitude=$_POST['DLlongitude']; 
      $HOWeb=$_POST['HOWeb'];
      $OName=$_POST['OName'];
      $OPhonenumber=$_POST['OPhonenumber'];
      $OEmail=$_POST['OEmail'];
      $CP1Name=$_POST['CP1Name'];
      $CP1Phonenumber=$_POST['CP1Phonenumber'];
      $CP1Email=$_POST['CP1Email'];
      $CP2Name=$_POST['CP2Name'];
      $CP2Phonenumber=$_POST['CP2Phonenumber'];
      $CP2Email=$_POST['CP2Email'];
      $Notes=$_POST['Notes'];
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


     $sql = " UPDATE  tbDistributorMaster SET fdDistributorName = '$DName', fdHeadOfficeName = '$HOName', fdHeadOfficeAddressLine1 = '$HOAddress1', fdHeadOfficeAddressLine2 = '$HOAddress2', fdHeadOfficeCity = '$HOCity' , fdHeadOfficeState = '$HOState', fdHeadOfficeCountry = '$HOCountry', fdHeadOfficePostalCode = '$HOPostcode' , fdHeadOfficePhoneNumber = '$HOPhone' , fdHeadOfficeEmail = '$HOEmail', 
fdDistrLat = '$DLlatitude', fdDistrLong = '$DLlongitude', fdOwnerName = '$OName' , fdOwnerPhoneNumber = '$OPhonenumber' , fdOwnerEmail = '$OEmail', fdContactPerson1Name = '$CP1Name' , fdContactPerson1PhoneNumber = '$CP1Phonenumber' , fdContactPerson1Email = '$CP1Email', fdContactPerson2Name = '$CP2Name', fdContactPerson2PhoneNumber = '$CP2Phonenumber' , fdContactPerson2Email = '$CP2Email', fdWebsiteURL= '$HOWeb', fdNotes ='$Notes', fdDate= '$date', fdTime ='$time', fdManufacturerID='$Mid' ,fdStockistID='$sid', fdProfileImage='$newfilename' WHERE fdDistributorID = '$Did' " ;

    if (mysqli_query($conn, $sql)) { 
        $sql1 = "UPDATE tbUserMaster SET fdUserFName='$OName', fdEmailAsUserID='$OEmail',fdPhoneNumber='$OPhonenumber', fdCountry='$HOCountry', fdCity='$HOCity', fdState='$HOState', fdZipCode='$HOPostcode', fdLatitude='$DLlatitude', fdLongitude='$DLlongitude', fdProfileImage ='$newfilename' WHERE fdRoleUniqueID = '$Did'";
        if (mysqli_query($conn,$sql1)) {
    echo'<script>Swal.fire({ 
        icon: "success",
        title:"Update Successfully!"
      }).then(function(){
        window.location = "?ListDistributor";
        });
     </script>';
      }
    else{
        echo'<script> swal({ 
            icon: "error",
            title:"Failed  to update !"});
         </script>';
        }  
}
}


if(isset($_GET['did'])){

    $did = $_GET['did'];
  
    $sql = "SELECT * FROM tbDistributorMaster WHERE fdDistributorID = '$did' ";
    $result = mysqli_query($conn, $sql);
    if (!$result){
      die("qurey Failed");
    }
    if (mysqli_num_rows($result) > 0) {
      $rows = mysqli_fetch_assoc($result);   
    }
}

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

<style>
label.control-label {
  white-space: nowrap;
}
.error-message {
     color:#e83e8c;
     font-size: 14px;
     font-weight: normal;
}
hr.hr1{
   margin-bottom: 0px;
   margin-top: -20px;
   background: grey;
   opacity: 0.5;
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
    border: 1px solid #4f5467; 
}

.iti__country-list {
    background-color: #272b34; /* Dark background color */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Dark box shadow */
}

.iti__country-list-item {
    color: #fff; /* White text color */
}


   
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div class="row">
        <div class="col-12">
            <div class="card">
             
                <div class="card-header" style="background-color:#1e88e566;">
                    <h4 class="card-title mb-0 text-white"><strong>UPDATE DISTRIBUTOR</strong</h4> 
                                   </div>
             
               <!-- <br> -->
                <!-- <hr class=hr1> -->
                <form class="form-horizontal"  method="POST" enctype="multipart/form-data">
                 <div class="card-body">
                        <h4 class="card-title mb-0">Distributor User</h4><br>
                        <div class="card-body">
                        <div class="row">                    
                            <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname3" class="col-sm-4 text-right  control-label col-form-label">Distributor Name  <code>*</code></label>
                                                <div class="col-sm-8">
                                                <input type="text" value="<?php echo $rows["fdDistributorName"]; ?>" class="form-control required-field" id="DName" name="DName"  onblur="validateField(this)" oninput="validateField(this)" required>
                                                <span class="error-message"></span>    
                                            </div>
                                            </div>
                                     </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Manufacture ID  <code>*</code></label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Mid" name="Mid" value="<?php echo $rows["fdManufacturerID"]; ?>"readonly>         
                                     
                                </div>                                  
                                </div>
                            </div>
                                <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Distributor ID  <code>*</code></label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" id="Did" name="Did" value="<?php echo $rows["fdDistributorID"]; ?>" readonly>  
                                       
                                </div>                                         
                                  </div>
                              </div>
                              <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Stockist ID<code>*</code></label>
                                    <div class="col-sm-8">
                <input type="text" class="form-control" id="sid" name="sid" value="<?php echo $rows['fdStockistID']; ?>" readonly>
                </div>                    
                                </div>
                            </div>

                  </div>  
                 </div>     
                
                    <hr class=hr1>      
                    <!-- <hr> -->
                    <div class="card-body"> 
                    <h4 class="card-title mb-0">Head Office Details</h4>
                    <div class="card-body">
                     <div class="row">
                    <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="fname2" class="col-sm-4 text-right control-label col-form-label ">Head Office Name  <code>*</code></label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control required-field" id="HOName" name="HOName" value="<?php echo $rows["fdHeadOfficeName"]; ?>" onblur="validateField(this)" oninput="validateField(this)" required>       
                                    <span class="error-message"></span>  
                                </div>                                   
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row ">
                                    <label for="web1" class="col-sm-4 text-right control-label col-form-label">Website</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" id="HOWeb" name="HOWeb" value="<?php echo $rows["fdWebsiteURL"]; ?>">     
                                    </div>                                     
                                </div>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number  <code>*</code></label>
                                    <div class="col-sm-8">
                                    <input type="tel" class="form-control required-field" name="HOPhone" id="HOPhone" value="<?php echo $rows["fdHeadOfficePhoneNumber"]; ?>"  onblur="validateField(this)" oninput="validateField(this)" required>  
                                    <span class="error-message"></span>    
                                </div>                                        
                                </div>
                            </div>
                            <script>
        const phoneInputField = document.querySelector("#HOPhone");
    
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
                                <input type="email" class="form-control required-field" id="HOEemail" name="HOEemail" value="<?php echo $rows["fdHeadOfficeEmail"]; ?>">   
                                   
                            </div>                                       
                                </div>
                            </div>
                        </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label">Country  <code>*</code></label>
                            <div class="col-sm-8">
                            <select class="form-control required-field" id="HOCountry" name="HOCountry" onblur="validateField(this)" oninput="validateField(this)" required>
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
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label">State  <code>*</code></label>
                            <div class="col-sm-8">   
                            <select class="form-control required-field selectpicker" id="HOState" name="HOState" onblur="validateField(this)" oninput="validateField(this)" required>                           
                            <?php
                    $selectedCountryId = $rows["fdHeadOfficeCountry"];
                    $selectedStateId = $rows["fdHeadOfficeState"];

                   
                    $stateQuery = "SELECT id, name FROM tbStates WHERE country_id = '$selectedCountryId'";
                    $stateResult = mysqli_query($conn, $stateQuery);

                    while ($stateRow = mysqli_fetch_assoc($stateResult)) {
                        $selected = ($stateRow['id'] == $selectedStateId) ? "selected" : "";
                        echo "<option value='{$stateRow['id']}' {$selected}>{$stateRow['name']}</option>";
                    }
                    ?>
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
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 text-right control-label col-form-label">City  <code>*</code></label>
                                <div class="col-sm-8">    
                                <select class="form-control required-field" id="HOCity" name="HOCity" onblur="validateField(this)" oninput="validateField(this)" required>
                <!-- <option value="<?php echo $rows["fdHeadOfficeCity"]; ?>"><?php echo $rows["fdHeadOfficeCity"]; ?></option>   -->
        <?php
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
                      
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 text-right control-label col-form-label">Post Code<code>*</code></label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control required-field" id="HOPostcode" name="HOPostcode" value="<?php echo $rows["fdHeadOfficePostalCode"]; ?>" onblur="validateField(this)" oninput="validateField(this)" required>     
                                <span class="error-message"></span>    
                            </div>                                                      
                            </div>
                        </div>                                            
                                                          
                    </div>      
                    <div class="row">   
                            <div class="col-md-6">
                                <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label">Address 1  <code>*</code></label>
                                        <div class="col-sm-8">
                                         <input type="text" class="form-control required-field" id="HOAddress1" name="HOAddress1"  value="<?php echo $rows["fdHeadOfficeAddressLine1"]; ?>" onblur="validateField(this)" oninput="validateField(this)" required>     
                                         <span class="error-message"></span>
                                        </div>                                                      
                                </div>
                            </div>
                         <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 text-right control-label col-form-label">Address 2</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" id="haddress2" name="HOAddress2" value="<?php echo $rows["fdHeadOfficeAddressLine2"]; ?>">                                                    
                                    </div>       
                                    </div>
                          </div>
                    </div>                                
                    <div class="row">
                    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label" style="white-space: nowrap;">Latitude <code>*</code></label>
            <div class="col-sm-8" style="display: flex;">
                <input type="text" class="form-control required-field" id="DLlatitude" name="DLlatitude" value="<?php echo $rows['fdDistrLat']; ?>" onblur="validateField(this)" oninput="validateField(this)" required>
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
                <input type="text" class="form-control required-field" id="DLlongitude" name="DLlongitude" value="<?php echo $rows['fdDistrLong']; ?>" onblur="validateField(this)" oninput="validateField(this)" required>
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
    var updatedLatitude = <?php echo $rows["fdDistrLat"]; ?>;
    document.getElementById('DLlatitude').value = updatedLatitude;
}

function refreshLongitude() {
    // Get the updated longitude value from your data source and set it in the input field
    var updatedLongitude = <?php echo $rows["fdDistrLong"]; ?>;
    document.getElementById('DLlongitude').value = updatedLongitude;
}

</script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDonb2ULBup0rFfk6C8CSbGx2rcR52vm2o&callback=initMap&libraries=places&v=weekly&channel=2"
    async
  ></script> 
  <script>
    var map, infoWindow;
    var geocoder;
    var marker;

    function initMap() {
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('mapCanvas'), {
            center: { lat: <?php echo $rows['fdDistrLat']; ?>, lng: <?php echo $rows['fdDistrLong']; ?> },
            zoom: 16
        });
        infoWindow = new google.maps.InfoWindow;

        // Add marker to the map
        marker = new google.maps.Marker({
            position: { lat: <?php echo $rows['fdDistrLat']; ?>, lng: <?php echo $rows['fdDistrLong']; ?> },
            map: map,
            draggable: true,
            title: 'Distributor Location'
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
        document.getElementById('DLlatitude').value = latLng.lat();
        document.getElementById('DLlongitude').value = latLng.lng();
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
                    
                    <hr class="hr1">
<div class="card-body">
    <h4 class="card-title mb-0">Profile Picture</h4>
    <div class="card-body">
        <div class="row mb-0">
            <div class="col-sm-12 col-lg-6">
                <div class="form-group row">
                    <label for="cono12" class="col-sm-4 text-right control-label col-form-label">User Photo</label>
                    <div class="input-group col-sm-8">
                        <div class="input-group-prepend">
                        <input type="file" id="P_image" name="P_image" class="form-control" onchange="displayUserPhoto(this)">
                            <span class="input-group-text">Upload</span>
                        </div>

                        <div class="col-sm-4">
                            
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
                    <hr class=hr1>
                    <div class="card-body">
                    <h4 class="card-title mb-0">Owner Details</h4>                 
                                    
                    <div class="card-body">                                        
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Owner Name  <code>*</code></label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control required-field" id="OName"  name="OName" value="<?php echo $rows["fdOwnerName"]; ?>"  onblur="validateField(this)" oninput="validateField(this)" required>     
                                <span class="error-message"></span>   
                            </div>                                 
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number  <code>*</code></label>
                                <div class="col-sm-8">
                                <input type="tel"  class="form-control required-field" name="OPhonenumber" id="OPhonenumber" value="<?php echo $rows["fdOwnerPhoneNumber"]; ?>" onblur="validateField(this)" oninput="validateField(this)" required>        
                                <span class="error-message"></span>   
                            </div>                               
                            </div>
                        </div>
                    </div>
                    <script>
                        const phoneInputField1 = document.querySelector("#OPhonenumber");
                    
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
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email  <code>*</code></label>
                                <div class="col-sm-8">
                                <input type="email" class="form-control required-field" id="OEmail" name="OEmail" value="<?php echo $rows["fdOwnerEmail"]; ?>"  onblur="validateField(this)" oninput="validateField(this)" required>      
                                <span class="error-message"></span>    
                            </div>                                    
                                </div>
                            </div>
                        </div>                                    
            
                                    </div>
                    </div>
                    <hr class=hr1>
                    <div class="card-body">
                    <h4 class="card-title mb-0">Contact Person1 Details</h4>
                     <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Person1 Name</label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control required-field" id="CP1Name"  name="CP1Name" value="<?php echo $rows["fdContactPerson1Name"]; ?>">       
                                   
                            </div>                                
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number</label>
                                <div class="col-sm-8">
                                <input type="tel"  class="form-control required-field" name="CP1Phonenumber" id="CP1Phonenumber"  value="<?php echo $rows["fdContactPerson1PhoneNumber"]; ?>">                        
                                    
                            </div>              
                            </div>
                        </div>
                    </div>
                    <script>
                        const phoneInputField2 = document.querySelector("#CP1Phonenumber");
                    
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
                                <input type="email" class="form-control required-field" id="CP1Email" name="CP1Email" value="<?php echo $rows["fdContactPerson1Email"]; ?>">    
                                    
                            </div>                                       
                                </div>
                            </div>
                    </div>
              </div>
                    </div>
                    <hr class=hr1>
                    
                    <div class="card-body">
                    <h4 class="card-title mb-0">Contact Person2 Details</h4>
                     <div class="card-body">
                                        
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Person2 Name</label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control" id="CP2Name"  name="CP2Name" value="<?php echo $rows["fdContactPerson2Name"]; ?>">   
                                </div>                                    
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number</label>
                                <div class="col-sm-8">
                                <input type="tel" class="form-control" name="CP2Phonenumber" id="CP2Phonenumber" value="<?php echo $rows["fdContactPerson2PhoneNumber"]; ?>">       
                                </div>                               
                            </div>
                        </div>
                    </div>
                    <script>
                        const phoneInputField3 = document.querySelector("#CP2Phonenumber");
                    
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
                                <input type="email" class="form-control" id="CP2Email" name="CP2Email" value="<?php echo $rows["fdContactPerson2Email"]; ?>" >    
                                </div>                                       
                                </div>
                            </div>
                 </div>                    
                    </div>
                    </div>
                        <hr class=hr1>
                        <h4 class="card-title ml-4 pt-3">Notes</h4>
                            <div class="card-body">
                                    <div class="row">                            
                                <div class="col-sm-12 col-lg-12">
                                <div class="form-group row">
                                <label for="text" class="col-sm-2 text-right control-label col-form-label ">Notes</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="Notes" name="Notes" value="<?php echo $rows["fdNotes"]; ?>" >    
                                </div>                                
                                </div>
                            </div>
                           </div>
                            </div>
                    <div class="card-body">
                        <div class="form-group pb-3">
                            <button type="submit" class="btn waves-effect waves-light btn-warning float-left" name="Updatebtn" id="Updatebtn" onclick="validateAllRequiredFields()">Update</button>
                            <!-- <button type="submit" class="btn waves-effect waves-light btn-danger float-left">Cancel</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script>
$(document).ready(function() {
    $('#HOCountry').on('change', function() {
            var country_id = this.value;
            $.ajax({
                url: "get_country.php",
                type: "POST",
                data: {
                    country_id: country_id
                },
                cache: false,
                success: function(result){
                    $("#HOState").html(result);
                    $('#HOCity').html('<option value="">Select State First</option>'); 
                }
            });
        });
         
    });    
 
    $(document).ready(function() {
    $('#HOCountry').on('change', function() {
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
                $('#HOState')
                    .empty()
                    .append(result)
                    .selectpicker('refresh'); // Refresh the Bootstrap Select
                $('#HOCity').html('<option value="">Select State First</option>');
            }
        });
    });
});


$(document).ready(function() {
    $('#HOState').on('change', function() {
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
                    $('#HOCity').html(result);
                }
            });
        } else {
            // Clear the city dropdown if no state is selected
            $('#HOCity').html('<option value="">Select City</option>');
        }
    });
});

</script>
   
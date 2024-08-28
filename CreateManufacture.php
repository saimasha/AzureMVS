


<style>
label.control-label {
  white-space: nowrap;
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
    .error-message {
        color:#e83e8c;
        font-size: 14px;
    }
    #showPasswordIcon {
    position: absolute;
    right: 20px;
    /*top: 18%;*/
    transform: translateY(-50%);
    cursor: pointer;
    color:#b2b9bf;
    font-size: 15px;
    margin-top: -16px;
}
</style>

<?php

session_start();
$RoleUniqueID=$_SESSION['fdRoleUniqueID'] ;
date_default_timezone_set('Asia/Kolkata');
$currentDateTime = date('Y-m-d H:i:s');
require("function.php");
if(isset($_POST['savebtn'])){
    //$ruid=$_POST['ruid'];

    $mid=$_POST['mid'];
    $mname=$_POST['mname'];
    $iid=$_POST['iid'];
    $gid=$_POST['gid'];
    $hname=$_POST['hname'];
    $haddress1=$_POST['haddress1'];
    $haddress2=$_POST['haddress2'];
    $hcity=$_POST['hcity'];
    $hstate=$_POST['hstate'];
    $hcountry=$_POST['hcountry'];
    $hpostcode=$_POST['hpostcode'];
    $hphone=$_POST['hphone'];
    $hemail=$_POST['hemail'];
    $haname=$_POST['haname'];
    $haposition=$_POST['haposition'];
    $haphonenumber=$_POST['haphonenumber'];
    $haemail=$_POST['haemail'];
    $mlatitude=$_POST['mlatitude'];
    $mlongitude=$_POST['mlongitude'];      
    $cp1name=$_POST['cp1name'];
    $cp1phonenumber=$_POST['cp1phonenumber'];
    $cp1email=$_POST['cp1email'];
    $cp2name=$_POST['cp2name'];
    $cp2phonenumber=$_POST['cp2phonenumber'];
    $cp2email=$_POST['cp2email'];
    $mweb1=$_POST['mweb1'];
    $mlatitude=$_POST['mlatitude'];
    $mlongitude=$_POST['mlongitude'];    
    $mnotes=$_POST['mnotes'];
    $roleid = $_POST['roleid'];
    $pass=$_POST["pass"];
    $currentTime=date('H:i:s');
    $currentTime = date('H:i:s');
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
    $sql = "INSERT INTO tbManufacturerMaster (fdManufacturerID, fdManufacturerName, fdIndustryID, fdGroupID, fdHeadOfficeName, fdHeadOfficeAddressLine1, fdHeadOfficeAddressLine2, fdHeadOfficeCity, fdHeadOfficeState, fdHeadOfficeCountry, fdHeadOfficePostalCode, fdHeadOfficePhoneNumber, fdHeadOfficeEmail, fdHighestAuthorityName, fdHighestAuthorityPosition, fdHighestAuthorityPhoneNumber, fdHighestAuthorityEmail, fdContactPerson1Name, fdContactPerson1PhoneNumber, fdContactPerson1Email, fdContactPerson2Name, fdContactPerson2PhoneNumber, fdContactPerson2Email, fdWebsiteURL, fdManufacturerLat, fdManufacturerLong, fdNotes, fdDate, fdTime,fdProfileImage) VALUES ('$mid','$mname','$iid','$gid', '$hname','$haddress1','$haddress2','$hcity','$hstate','$hcountry','$hpostcode', '$hphone','$hemail','$haname','$haposition','$haphonenumber','$haemail','$cp1name', '$cp1phonenumber','$cp1email','$cp2name', '$cp2phonenumber' ,'$cp2email','$mweb1','$mlatitude','$mlongitude','$mnotes', CURDATE(), '$currentTime','$newfilename')";

    if (mysqli_query($conn,$sql)) {
          echo $sql1 = "INSERT INTO tbUserMaster (fdRoleUniqueID, fdUserFName, fdEmailAsUserID, fdPassword, fdPhoneNumber, fdRoleID, fdCountry, fdCity, fdState, fdZipCode, fdLatitude, fdLongitude,fdRegistrationDate,fdProfileImage)
         VALUES ('$mid', '$haname', '$haemail', '$pass', '$haphonenumber', '$roleid', '$hcountry', '$hcity', '$hstate', '$hpostcode', '$mlatitude', '$mlongitude', CURDATE(), '$newfilename')";
         if (mysqli_query($conn,$sql1)) {
            sendEmail($conn, 1, $haemail);
     
         echo'<script>Swal.fire({
             icon: "success",
             title: "Created Successfully",
           }) ;
           </script>';            
       } else {
           echo'<script>Swal.fire({ 
               icon: "error",
               title:"Failed  to Create!"});
           </script>';
       }
     }else {
           echo'<script>Swal.fire({ 
               icon: "error",
               title:"Failed  to Create!"});
           </script>';
       }

   
}
  
    
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<div class="row">

<div class="col-12">

<div class="card">
<div class="card-header" style="background-color:#1e88e566;">
    <h4 class="mb-0 text-white"><strong>CREATE MANUFACTURER </strong></h4>
</div>

<form class="form-horizontal"  method="POST" enctype="multipart/form-data" >
<div class="card-body">
<h4 class="card-title">Manufacturer User</h4>
<div class="card-body">
    <div class="row">                    
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="fname3" class="col-sm-4 text-right control-label col-form-label">Manufacturer Name <code>*</code></label>
            <div class="col-sm-8">
            <input type="text" class="form-control required-field" id="mname" name="mname" placeholder="Manufacturer Name Here" onblur="validateField(this)" oninput="validateField(this)" required>
            <span class="error-message"></span> 
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="nname" class="col-sm-4 text-right control-label col-form-label">Role ID <code>*</code></label>
            <div class="col-sm-8">
            <select name="roleid" id="roleid" class="form-control required-field" required>
            
            <option selected value="">Select Role</option> 
                        <?php
                $allowedRoles = array("Manufacture");
                $query = "SELECT * FROM `tbRoleMaster` WHERE fdRoleName IN ('" . implode("','", $allowedRoles) . "')";
                $result = mysqli_query($conn, $query);

                foreach ($result as $row) {
                    echo '<option value="' . $row["fdRoleID"] . '"> ' . $row["fdRoleName"] . ' </option>';
                }
                ?>
    </select>
    <span class="error-message"></span>
                </div>                                    
        </div>
    </div>
    <!-- <div class="row"> -->
    <div class="col-sm-12 col-sm-12 col-lg-6">
        <div class="form-group row">
        <label for="fname3" class="col-sm-4 text-right control-label col-form-label">Manufacturer ID <code>*</code></label>
        <div class="col-sm-8">
        <input type="text" class="form-control" id="mid" name="mid" placeholder="Enter manufacturer_id" readonly>
        <span class="error-message"></span> 
        </div>                                    
        </div>
    </div>
    <script>
    document.getElementById('roleid').addEventListener('change', function () {
    var selectedRole = this.value;
    var randomUniqueID = Math.floor(Math.random() * 10000); 
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth() + 1; 
        var currentYear = currentDate.getFullYear();
        var lasttwodigits = currentYear % 100;

    var roleUniqueID = selectedRole + currentMonth + lasttwodigits +randomUniqueID;
document.getElementById('mid').value = roleUniqueID;
});
</script>
  
    
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="uname1" class="col-sm-4 text-right control-label col-form-label" >Industry ID <code>*</code></label>
                <div class="col-sm-8">
                <select name="iid" id="iid" class="form-control" required>
                <span class="error-message"></span>
                        <option selected value="0">Select Industry</option>
                        <?php
                        $query = "SELECT * FROM `tbIndustryMaster`";
                        $result = mysqli_query($conn, $query);

                        foreach ($result as $row) {
                            echo '<option value="' . $row["fdSlno"] . '"> ' . $row["fdIndustryID"] . ' </option>';
                        }

                        ?>
                    </select>
                </div>                                                 
            </div>
        </div>
    <!-- </div> -->
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="nname" class="col-sm-4 text-right control-label col-form-label" >Group ID <code>*</code></label>
                <div class="col-sm-8">
                    <select name="gid" id="gid" class="form-control" required>
                    <span class="error-message"></span>
                        <option selected value="0">Select Group</option>
                        <?php
                        $query = "SELECT * FROM `tbGroupMaster`";
                        $result = mysqli_query($conn, $query);

                        foreach ($result as $row) {
                            echo '<option value="' . $row["fdGroupID"] . '"> ' . $row["fdGroupName"] . ' </option>';
                        }

                        ?>
                    </select>
                </div>                                    
            </div>
           
</div>
</div>


</div> 

<hr style="margin-top: -25px; margin-bottom: -4px; background: grey; opacity: 0.5;">
<div class="card-body">
<h4 class="card-title">Head Office Details</h4>
<div class="card-body">

<div class="row">
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="fname2" class="col-sm-4 text-right control-label col-form-label" >Head Office Name <code>*</code></label>
        <div class="col-sm-8">
        <input type="text" class="form-control required-field" id="hname" name="hname" placeholder=" Head Office Name Here"  onblur="validateField(this)" oninput="validateField(this)"  required>
        <span class="error-message"></span>
        </div>                                   
    </div>
</div>
<div class="col-sm-12 col-lg-6">
    <div class="form-group row ">
        <label for="web1" class="col-sm-4 text-right control-label col-form-label">Website</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" id="mweb1" name="mweb1" placeholder="http://">
        </div>                                   
    </div>
</div>
</div>

<div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number <code>*</code></label>
                <div class="col-sm-8">
                <input type="tel" class="form-control required-field" name="hphone" id="hphone" placeholder="Contact No Here"  onblur="validateField(this)" oninput="validateField(this)"  required>
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
        <input type="email" class="form-control" id="hemail" name="hemail" placeholder="Email Here"  >
       
        </div>                                   
    </div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-lg-6">
<div class="form-group row">
    <label class="col-sm-4 text-right control-label col-form-label">Country <code>*</code></label>
    <div class="col-sm-8">
        <select class="form-control" id="hcountry" name="hcountry" placeholder="Country Name Here" onblur="validateField(this)" oninput="validateField(this)" required>
        
        <option value="">Select Country</option>  
                <?php
                require_once "include/connection.php";

                $result = mysqli_query($conn,"SELECT * FROM tbCountries");

                while($row = mysqli_fetch_array($result)) {
                ?>
                    <option value="<?php echo $row['id'];?>"><?php echo $row["name"];?></option>
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
    <select class="form-control selectpicker" id="hstate" name="hstate" placeholder="State Name Here" onblur="validateField(this)" oninput="validateField(this)" required>
    <option value="">Select State</option> 
    
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
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label">City <code>*</code></label>
            <div class="col-sm-8">
        <select class="form-control"  id="hcity" name="hcity"  placeholder="City Name Here" onblur="validateField(this)" oninput="validateField(this)" required>>
        <option value="">Select City</option>  
                    </select>
            <span class="error-message"></span> 
            </div>                                                   
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label class="col-sm-4 text-right control-label col-form-label">Post Code <code>*</code></label>
        <div class="col-sm-8">
        <input type="text" class="form-control required-field" id="hpostcode" name="hpostcode" placeholder="Post code Here"  onblur="validateField(this)" oninput="validateField(this)"  required>
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
                    <input type="text" class="form-control required-field" id="haddress1" name="haddress1" placeholder="Address1 Here"  onblur="validateField(this)" oninput="validateField(this)"  required>
                    <span class="error-message"></span>                                                    
        </div>
        </div>
    </div>
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label class="col-sm-4 text-right control-label col-form-label">Address 2</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" id="haddress2" name="haddress2"  placeholder="Addres2 Here">
        </div>                                                    
    </div>
</div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label">Latitude <code>*</code></label>
            <div class="col-sm-8">
            <input type="text" class="form-control required-field" id="mlatitude" name="mlatitude" placeholder="Manufacturer Latitude Here"  onblur="validateField(this)" oninput="validateField(this)"  required>
            <span class="error-message"></span>
            </div>                                                   
        </div>
    </div>
        <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label">Longitude <code>*</code></label>
            <div class="col-sm-8">
            <input type="text" class="form-control required-field" id="mlongitude" name="mlongitude" placeholder="Manufacturer Longitude Here"  onblur="validateField(this)" oninput="validateField(this)"  required>
            <span class="error-message"></span>
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
</div>
<div id="mapCanvas"></div>
</div>

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
    document.getElementById('mlatitude').value = latLng.lat();
    document.getElementById('mlongitude').value = latLng.lng();
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
}
</script>                          
            <!-- <div class="col-sm-12 col-lg-6">
                <div class="form-group row">
                    <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Ware House ID</label>
                    <input type="text" class="form-control" name="whid" id="whid" placeholder="Ware House ID Here">                                
                </div>
            </div> -->
</div>
</div>
<hr style="margin-top: -25px; margin-bottom: -1px; background: grey;opacity: 0.5;">
<div class="card-body">
<h4 class="card-title">Profile Photo</h4>

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
                <img id="userPhoto" src="image/profile/<?php echo $rows["fdProfileImage"]; ?>" width="100" align="right" style="float: left;margin-top:-40px; margin-left:410%;">
            </div>
        </div>
    </div>
</div>
</div>
<script>
function displayUserPhoto(input) {
    var reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById('userPhoto').src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
<hr style="margin-top: -25px; margin-bottom: -1px; background: grey; opacity: 0.5;">
<div class="card-body">
<h4 class="card-title">Highest Authority Details</h4> 
<div class="card-body">                                        
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="fname2" class="col-sm-4 text-right control-label col-form-label"> Name <code>*</code></label>
            <div class="col-sm-8">
            <input type="text" class="form-control required-field" id="haname"  name="haname" placeholder=" Highest Authority Name Here" onblur="validateField(this)" oninput="validateField(this)"  required>
            <span class="error-message"></span>
            </div>                               
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="cono12" class="col-sm-4 text-right control-label col-form-label"> Position <code>*</code></label>
            <div class="col-sm-8">
            <input type="text" class="form-control required-field" name="haposition" id="haposition" placeholder="Highest Authority Position Here" onblur="validateField(this)" oninput="validateField(this)"  required>
            <span class="error-message"></span>
            </div>                                
        </div>
    </div>
</div>
<div class="row">                            
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
            <label for="email2" class="col-sm-4 text-right control-label col-form-label"> Phone Number <code>*</code></label>
            <div class="col-sm-8">
            <input type="tel" class="form-control required-field" id="haphonenumber" name="haphonenumber" placeholder="Highest Authority Phone Number Here" onblur="validateField(this)" oninput="validateField(this)"  required>
            <span class="error-message"></span>
            </div>                                   
            </div>
        </div>
        <script>
    const phoneInputField1 = document.querySelector("#haphonenumber");
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
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
            <label for="email2" class="col-sm-4 text-right control-label col-form-label"> Email <code>*</code></label>
            <div class="col-sm-8">
            <input type="email" class="form-control required-field" id="haemail" name="haemail" placeholder="Highest Authority email Here" onblur="validateField(this)" oninput="validateField(this)"  required>
            <span class="error-message"></span>
            </div>                                   
            </div>
        </div> 
        <div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="nname" class="col-sm-4 text-right control-label col-form-label">Password <code>*</code></label>
        <div class="col-sm-8">
        <input type="password" class="form-control required-field" id="password" name="pass" placeholder="Password Here"  onblur="validatePassword(this)" oninput="validatePassword(this)" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">  
        <i class="fa fa-eye-slash" id="showPasswordIcon" onclick="togglePasswordVisibility()"></i>   
        <span class="error-message" id="errorText"></span>                                     
            </div>                                    
    </div>
</div>                                                       
    </div>                                  
    </div>
</div>
<hr style="margin-top: -25px; margin-bottom: -1px; background: grey; opacity: 0.5;">
<div class="card-body">
<h4 class="card-title">Contact Person1 Details</h4>
<div class="card-body">                            
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Person1 Name</label>
            <div class="col-sm-8">
            <input type="text" class="form-control required-field" id="cp1name"  name="cp1name" placeholder=" Contact Person1 Name Here">
            </div>                                
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number</label>
            <div class="col-sm-8">
            <input type="tel" class="form-control required-field" name="cp1phonenumber" id="cp1phonenumber" placeholder="Contact Person1 No Here">
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
            <input type="email" class="form-control" id="cp1email" name="cp1email" placeholder="Email Here">
           
            </div>                                    
            </div>
        </div>
</div>
</div>
</div>
<hr style="margin-top: -25px; margin-bottom: -1px; background: grey; opacity: 0.5;">        
<div class="card-body">
<h4 class="card-title">Contact Person2 Details</h4>
<div class="card-body">                    
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Person2 Name</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="cp2name"  name="cp2name" placeholder=" Contact Person2 Name Here">
            </div>                                
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number</label>
            <div class="col-sm-8">
            <input type="tel" class="form-control" name="cp2phonenumber" id="cp2phonenumber" placeholder="Contact Person2 No Here">
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
        <input type="email" class="form-control" id="cp2email" name="cp2email" placeholder="Email Here"> 
        </div>                                   
        </div>
    </div>
</div>                                       
</div>
</div>
<hr style="margin-top:-25px; margin-bottom: 8px; background: grey; opacity: 0.5;">
<div class="card-body">
<h4 class="card-title">Notes</h4>
<div class="row">                            
<div class="col-sm-12 col-lg-12">
    <div class="form-group row">
    <label for="notes" class="col-sm-2 text-right control-label col-form-label">Notes</label>
    <div class="col-sm-8">
    <textarea name="mnotes" id="mnotes" class="form-control" placeholder="Notes Here"></textarea>
    </div>                                    
    </div>
</div>
</div>
</div>
                            
<div class="card-body">
    <div class="form-group mb-0 d-flex justify-content-between align-items-center">
    <!-- <button type="submit" class="btn btn-danger waves-effect waves-light">Cancel</button> -->
        <button type="submit" class="btn btn-success waves-effect waves-light" name="savebtn" id="savebtn" onclick="validateAllRequiredFields()">Submit</button>
        
    </div>
</div>
</form>
</div>
</div>
</div>
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
function validatePasswordOnBlur(input) {
    validatePassword(input);
}
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var showPasswordIcon = document.getElementById("showPasswordIcon");
   
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        showPasswordIcon.classList.remove("fa-eye-slash");
        showPasswordIcon.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        showPasswordIcon.classList.remove("fa-eye");
        showPasswordIcon.classList.add("fa-eye-slash");
    }
}
function validatePassword(input) {
    var password = input.value;
    var passwordPattern = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}/;
    var errorText = document.getElementById("errorText");

    if (!passwordPattern.test(password)) {
        // Display the error message in the modal
        errorText.textContent = "Must contain at least one number and one uppercase and lowercase letter, and be at least 8 characters long.";
        $('#errorModal').modal('show');
    } else {
        // Clear the error message and hide the modal
        errorText.textContent = "";
        $('#errorModal').modal('hide');
    }
}   
</script>

<script>

 
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



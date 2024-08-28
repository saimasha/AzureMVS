<!-- Jidnyasa Patil ///27/09/2023 -- -->
<style>
label.control-label {
  white-space: nowrap;
 
}
hr.hr1{

    margin-bottom: 0px;
    margin-top: -21px;
    background: grey;
    opacity: 0.5;
}
#mapCanvas {
    height: 300px;
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
#image-preview {
    max-width: 134px;
    max-height: 220px;
    margin-left: 10px;
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
<?php
date_default_timezone_set('Asia/Kolkata');
// session_start();
$RoleID = $_SESSION['fdRoleID'];
$RoleUniqueID = $_SESSION['fdRoleUniqueID'];
require("function.php");

// Initialize variables to store fetched IDs
$ManufacturerID = '';
$StockistID = '';
$DealerID = '';

// Logic to fetch IDs based on the logged-in user's role
if ($RoleID == 'MNFR') {
    $ManufacturerID = $RoleUniqueID;

    // Fetch Stockist ID for Manufacturer
    $query = "SELECT fdStockistID FROM `tbStockistMaster` WHERE fdManufacturerID = '$ManufacturerID'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $StockistID = $data['fdStockistID'];

    // Fetch Distributor ID for Manufacturer
    $query = "SELECT fdDistributorID FROM `tbDistributorMaster` WHERE fdManufacturerID = '$ManufacturerID'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $DistributorID = $data['fdDistributorID'];
    }

    // Fetch Dealer ID for Manufacturer
    $query = "SELECT fdDealerID FROM `tbDealerMaster` WHERE fdManufacturerID = '$ManufacturerID'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $DealerID = $data['fdDealerID'];
    }

} elseif ($RoleID == 'STKS') {
    // Fetch Manufacturer ID and Stockist ID based on logged-in Stockist
    $query = "SELECT fdManufacturerID, fdStockistID FROM `tbStockistMaster` WHERE fdStockistID = '$RoleUniqueID'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $ManufacturerID = $data['fdManufacturerID'];
        $StockistID = $RoleUniqueID;

        // Fetch Distributor ID for Stockist
        $query = "SELECT fdDistributorID FROM `tbDistributorMaster` WHERE fdStockistID = '$StockistID'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            $DistributorID = $data['fdDistributorID'];
        }

        // Fetch Dealer ID for Stockist
        $query = "SELECT fdDealerID FROM `tbDealerMaster` WHERE fdStockistID = '$StockistID'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            $DealerID = $data['fdDealerID'];
        }
    }
} elseif ($RoleID == 'DELR') {
    // Fetch Manufacturer ID, Stockist ID, Distributor ID, and Dealer ID based on logged-in Dealer
    $query = "SELECT fdManufacturerID, fdStockistID, fdDistributorID FROM `tbDealerMaster` WHERE fdDealerID = '$RoleUniqueID'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $ManufacturerID = $data['fdManufacturerID'];
    $StockistID = $data['fdStockistID'];
    $DistributorID = $data['fdDistributorID'];
    $DealerID = $RoleUniqueID;
}

// Function to fetch Manufacturer ID options
function fetchManufacturerOptions($conn)
{
    $options = '';
    $query = "SELECT fdManufacturerID FROM `tbManufacturerMaster`";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row["fdManufacturerID"] . '"> ' . $row["fdManufacturerID"] . ' </option>';
    }
    return $options;
}

if(isset($_POST['savebtn'])){
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
      $Pass = $_POST['pass'];
      $roleid = $_POST['roleid'];
      $companyid = $_POST['cid'];
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
    
        
        $sql = "INSERT INTO tbDistributorMaster (fdDistributorID,fdManufacturerID,fdStockistID, fdDistributorName, fdHeadOfficeName, fdHeadOfficeAddressLine1, fdHeadOfficeAddressLine2, fdHeadOfficeCity, fdHeadOfficeState, fdHeadOfficeCountry, fdHeadOfficePostalCode, fdHeadOfficePhoneNumber, fdHeadOfficeEmail, fdOwnerName, fdOwnerPhoneNumber, fdOwnerEmail, fdContactPerson1Name, fdContactPerson1PhoneNumber, fdContactPerson1Email, fdContactPerson2Name, fdContactPerson2PhoneNumber, fdContactPerson2Email, fdWebsiteURL, fdDistrLat, fdDistrLong, fdNotes,fdDate,fdTime,fdProfileImage) VALUES ('$Did', '$Mid', '$sid','$DName','$HOName', '$HOAddress1', '$HOAddress2', '$HOCity', '$HOState', '$HOCountry',
        '$HOPostcode', '$HOPhone', '$HOEmail', '$OName', '$OPhonenumber', '$OEmail', '$CP1Name', '$CP1Phonenumber', '$CP1Email', '$CP2Name', '$CP2Phonenumber', '$CP2Email', '$HOWeb','$DLlatitude','$DLlongitude','$Notes', CURDATE() , '$currentTime','$newfilename' )";
        
        if (mysqli_query($conn,$sql)) {
            $sql1 = "INSERT INTO tbUserMaster (fdRoleUniqueID, fdUserFName, fdEmailAsUserID, fdPassword, fdPhoneNumber, fdRoleID, fdCountry, fdCity, fdState, fdZipCode, fdLatitude, fdLongitude,fdRegistrationDate,fdProfileImage,fdCompanyID)
             VALUES ('$Did', '$OName', '$OEmail', '$Pass', '$OPhonenumber', '$roleid', '$HOCountry', '$HOCity', '$HOState', '$HOPostcode', '$DLlatitude', '$DLlongitude', CURDATE(), '$newfilename', '$companyid')";
            
            if (mysqli_query($conn,$sql1)) {
            sendEmail($conn, 3, $OEmail);
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>

<div class="row" >
    <div class="col-12" >
        <div class="card">
                <div class="card-header" style="background-color:#1e88e566;">
                <h4 class="card-title mb-0 text-white"><strong>CREATE DISTRIBUTOR</strong></h4>
                </div>
            <hr style="margin-top:0; margin-bottom:0;  background: grey; opacity: 0.5;"> 
             <form class="form-horizontal"  method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <h4 class="card-title">Distributor User</h4>
                        <div class="card-body">
                                    <div class="row">  
                                      <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Distributor Name <code>*</code></label>
                                                <div class="col-sm-8">
                                                
                                                <input type="text" class="form-control required-field" id="DName" name="DName" placeholder="Enter Distributor Name" onblur="validateField(this)" oninput="validateField(this)">
                                                <span class="error-message"></span>
                                                
                                          
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Manufacture ID <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input name="Mid" id="Mid" class="form-control required-field" value="<?php echo $ManufacturerID; ?>" readonly>
                                        <span class="error-message"></span>
                                    </div> 
                                </div>
                            </div> 
                            <div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="nname" class="col-sm-4 text-right control-label col-form-label">Role ID <code>*</code></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="Distributor" readonly>
            <input type="hidden" name="roleid" value="DSTR">
            <span class="error-message"></span>
        </div>
    </div>
</div>
                        <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Distributor ID <code>*</code></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control required-field" id="Did" name="Did" placeholder="Enter Distributor ID" onblur="validateField(this)" oninput="validateField(this)" readonly> 
                                    <span class="error-message"></span> 
                                </div>                                  
                            </div>
                        </div>
                        <script>
function generateUniqueID() {
    var selectedRole = 'DSTR'; 
    var randomUniqueID = Math.floor(Math.random() * 10000); 
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth() + 1; 
    var currentYear = currentDate.getFullYear();
    
    var roleUniqueID = selectedRole + currentMonth + currentYear + randomUniqueID;
    return roleUniqueID;
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('Did').value = generateUniqueID();
});
</script>
                                   <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Stockist ID<code>*</code></label>
                                    <div class="col-sm-8">
                                        <input name="sid" id="sid" class="form-control required-field" value="<?php echo $StockistID; ?>" readonly>
                                        <span class="error-message"></span>
                                    </div> 
                                </div>
                            </div>     
                  </div>
                    </div>
                    <hr class="hr1">      
                    <div class="card-body"> 
                    <h4 class="card-title mb-0">Head Office Details</h4>
                <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="fname2" class="col-sm-4 text-right control-label col-form-label ">Head Office Name <code>*</code></label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control required-field" id="HOName" name="HOName" placeholder="Head Office Name Here" onblur="validateField(this)" oninput="validateField(this)"> 
                                    <span class="error-message"></span>                                  
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row ">
                                    <label for="web1" class="col-sm-4 text-right control-label col-form-label">Website</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" id="HOWeb" name="HOWeb" placeholder="http://">                                   
                                    </div>
                                </div>
                            </div>
                </div>
                    <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number <code>*</code></label>
                                    <div class="col-sm-8">   
                                    <input type="tel" class="form-control required-field" name="HOPhone" id="HOPhone" placeholder="Contact No Here"  onblur="validateField(this)" oninput="validateField(this)"> 
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
                                <input type="email" class="form-control " id="HOEemail" name="HOEemail" placeholder="Email Here">            
                                </div>    
                            </div>
                            </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label">Country <code>*</code></label>
                            <div class="col-sm-8">   
                            <select class="form-control required-field " id="HOCountry" name="HOCountry" placeholder="Country Name Here"  onblur="validateField(this)" oninput="validateField(this)"  required>
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
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label">State <code>*</code></label>
                            <div class="col-sm-8">
          <select class="form-control required-field selectpicker" id="HOState" name="HOState" placeholder="State Name Here"  onblur="validateField(this)" oninput="validateField(this)"  required>
            <option value="">Select State</option> 
            
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
                                <label class="col-sm-4 text-right control-label col-form-label">City <code>*</code></label>
                                <div class="col-sm-8">
                                <select class="form-control required-field"  id="HOCity" name="HOCity"  placeholder="City Name Here"  onblur="validateField(this)" oninput="validateField(this)"  required >
            <option value="">Select City</option>  
                      </select>
                                <span class="error-message"></span>                                                   
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 text-right control-label col-form-label">Post Code <code>*</code></label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control required-field" id="HOPostcode" name="HOPostcode" placeholder="Post code Here" onblur="validateField(this)" oninput="validateField(this)">
                                <span class="error-message"></span>                                                    
                                </div>
                            </div>
                        </div>   
                    </div>  
                    <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label">Address 1 <code>*</code></label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control required-field" id="HOAddress1" name="HOAddress1" placeholder="Address1 Here" onblur="validateField(this)" oninput="validateField(this)">  
                                        <span class="error-message"></span>                                                  
                                        </div>
                                    </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 text-right control-label col-form-label">Address 2</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" id="haddress2" name="HOAddress2"  placeholder="Address2 Here" >                                                    
                                    </div>
                                </div>
                             </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 text-right control-label col-form-label">Location Latitude <code>*</code></label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control required-field" id="DLlatitude" name="DLlatitude" placeholder="Distributor Latitude Here" onblur="validateField(this)" oninput="validateField(this)"> 
                                    <span class="error-message"></span>                                                  
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 text-right control-label col-form-label">Location Longitude <code>*</code></label>
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
  
            <!-- <div id="panel" class="d-flex justify-contain-center" style="margin-left: 45px;">
        <input type="button" class="btn btn-primary btn-sm" value="Locate Me" onclick="initMap()">
        <input id="searchInput" class="input-controls input-sm" type="text" placeholder="Enter a location" style="margin-left: 10px;">
    </div><br>
    <div class="col-12">
    <label for="location" class="control-label">Current address</label>
    <input type="text" name="mapadd" id="location" style="margin-bottom:2px; border:1px solid white; width:400px;" class="form-control"><br>
</div><br>
    <div id="mapCanvas"></div> -->
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

                           
                            </div>           
                    </div>
                    <hr class="hr1">
                    <div class="card-body">
                    <h4 class="card-title mb-0">Profile Picture</h4>                                        
                    <div class="card-body">                                        
                    <div class="row mb-0">
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group row">
                            <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Upload Image</label>
                                <div class="input-group col-sm-8">
                                  <div class="input-group-prepend">
                                    <input type="file" id="P_image" name="P_image" class="form-control" onchange="previewImage(this)">
                                    <span class="input-group-text">Upload</span> 
                                  </div>
                                </div>         
                        </div>
                    </div> 
                    <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                            <img id="image-preview" src="#" alt="Image Preview" style="display: none;">
                            </div>
                    </div> 
                    </div>
                    </div>
                    </div>
                                            <script>
      
                                                    function previewImage() {
                                                    var input = document.getElementById('P_image');
                                                    var preview = document.getElementById('image-preview');

                                                    var file = input.files[0];
                                                    var reader = new FileReader();

                                                    reader.onload = function (e) {
                                                        preview.src = e.target.result;
                                                        preview.style.display = 'block'; 
                                                    };

                                                    if (file) {
                                                        reader.readAsDataURL(file);
                                                    } else {
                                                        preview.src = '#';
                                                        preview.style.display = 'none'; 
                                                    }
                                                }
                                        </script>
                    <hr class="hr1">
                    <div class="card-body">
                    <h4 class="card-title mb-0">Owner Details</h4>                 
                                    
                    <div class="card-body">                                        
                    <div class="row mb-0">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Owner Name <code>*</code></label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control required-field" id="OName"  name="OName" placeholder=" Owner Name Here" onblur="validateField(this)" oninput="validateField(this)" >  
                                <span class="error-message"></span>                             
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number <code>*</code></label>
                                <div class="col-sm-8">
                                <input type="tel" class="form-control required-field" name="OPhonenumber" id="OPhonenumber" placeholder="Contact No Here"  onblur="validateField(this)" oninput="validateField(this)">
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
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email <code>*</code></label>
                                <div class="col-sm-8">
                                <input type="email" class="form-control required-field" id="OEmail" name="OEmail" placeholder="Email Here" onblur="validateField(this); checkEmail()" oninput="validateField(this); checkEmail()" required>
                                <span class="error-message" id="error-message"></span>                                   
                                </div>  
                            </div>
                            </div>
                            <script>
function checkEmail() {
    const emailInput = document.getElementById('OEmail');
    const errorMessage = document.getElementById('error-message');
    const submitButton = document.getElementById('savebtn');
    const email = emailInput.value;

    if (email) {
        // Make an AJAX request to the server
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/checkemail.php', true); // Change to your PHP script's URL
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.exists) {
                    errorMessage.textContent = 'Email already exists.';
                    emailInput.setCustomValidity('Email already exists.');
                    submitButton.disabled = true;
                } else {
                    errorMessage.textContent = '';
                    emailInput.setCustomValidity('');
                    submitButton.disabled = false;
                }
            }
        };
        xhr.send(JSON.stringify({ email: email, action: 'createDistributor' })); // Change action based on your needs
    } else {
        submitButton.disabled = true; // Disable button if email is empty
    }
}

function validateField(field) {
    if (field.checkValidity()) {
        field.setCustomValidity('');
    } else {
        field.setCustomValidity('Invalid field.');
    }
}

function validateForm() {
    const emailInput = document.getElementById('OEmail');
    return emailInput.checkValidity();
}
</script>


                    
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
<div class="row">
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="nname" class="col-sm-4 text-right control-label col-form-label">Company ID <code>*</code></label>
        <div class="col-sm-8">
        <select name="cid" id="cid" class="form-control required-field" onblur="validateField(this)" oninput="validateField(this)"  required >
        
    <option selected value="">Select Company</option>
    <?php
    $query = "SELECT * FROM `tbCompaniesMaster`";
    $result = mysqli_query($conn, $query);

    foreach ($result as $row) {
        echo '<option value="' . $row["fdCompanyType"] . '"> ' . $row["fdName"] . ' </option>';
    }

    ?>
</select>
<span class="error-message"></span>
            </div>                                    
    </div>
</div>

</div>
                </div>
                </div>
                <hr class="hr1">
                <div class="card-body">
                    <h4 class="card-title mb-0">Contact Person1 Details</h4>
                     <div class="card-body">
                                       
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Person1 Name </label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control required-field" id="CP1Name"  name="CP1Name" placeholder=" Contact Person1 Name Here">  
                                                            
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number </label>
                                <div class="col-sm-8">
                                <input type="tel" class="form-control required-field" name="CP1Phonenumber" id="CP1Phonenumber" placeholder="Contact Person1 No Here" >  
                                                           
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
                                <label for="email2" class="col-sm-4 text-right col-sm-3 text-right control-label col-form-label">Email</label>
                                <div class="col-sm-8">
                                <input type="email" class="form-control" id="CP1Email" name="CP1Email" placeholder="Email Here">    
                                      
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
                                <label for="fname2" class="col-sm-4 text-right col-sm-3 text-right col-sm-3 text-right col-sm-3 text-right control-label col-form-label">Person2 Name</label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control" id="CP2Name"  name="CP2Name" placeholder=" Contact Person2 Name Here" >                                
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number</label>
                                <div class="col-sm-8">
                                <input type="tel" class="form-control" name="CP2Phonenumber" id="CP2Phonenumber" placeholder="Contact Person2 No Here" >                                
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
                                <input type="email" class="form-control" id="CP2Email" name="CP2Email" placeholder="Email Here" >                                    
                                </div>    
                            </div>
                            </div>
                    </div>
                </div>
             </div>
                <hr class="hr1">
                <h4 class="card-title ml-4 pt-3">Notes</h4>
                <div class="card-body">
                 <div class="row">      
                           <div class="col-sm-12 col-lg-12">
                                <div class="form-group row">
                                <label for="notes" class="col-sm-2 text-right control-label col-form-label mr-2">Notes</label>
                                <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="Notes" name="Notes" placeholder="Notes Here" >  </textarea>                                  
                                </div>   
                                </div>
                            </div> 
                    </div>
                 </div>

                <div class="card-body">
                    <div class="form-group pb-3">
                            <button type="submit" class="btn waves-effect waves-light btn-success float-left" name="savebtn" id="savebtn" disabled onclick="validateAllRequiredFields()" onblur="validateEmail()" oninput="validateEmail()">Submit</button>
                            <!-- <button type="submit" class="btn waves-effect waves-light btn-danger float-left">Cancel</button> -->
                        </div>
                </form>
                </div>
            </div>
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
        
        alert('Please fill in all required fields.');
       
    } else {
        
        document.querySelector('form').submit();
        
    }
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
function validatePasswordOnBlur(input) {
    validatePassword(input);
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
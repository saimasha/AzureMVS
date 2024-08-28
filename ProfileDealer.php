<?php
 require "function.php"; 
//session_start();
$RoleUniqueID=$_SESSION['fdRoleUniqueID'] ;

date_default_timezone_set('Asia/Kolkata');

$currentDateTime = date('Y-m-d H:i:s');

// Split the date and time into separate variables
$date = date('Y-m-d', strtotime($currentDateTime));
$time = date('H:i:s', strtotime($currentDateTime));

       $sql = "SELECT * FROM tbDealerMaster WHERE fdDealerID = '$RoleUniqueID'";
      
       $result = mysqli_query($conn, $sql);
       if(!$result){
           die("Query Failed.");
       }
       if (mysqli_num_rows($result) > 0) {
       $rows = mysqli_fetch_assoc($result);
       $manufacturerID = $rows['fdManufacturerID'];
       $stockistID = $rows['fdStockistID'];
       $distributorID = $rows['fdDistributorID'];
       }
   

   
if(isset($_POST['Updatebtn'])){
    
    $dealid=$_POST['dealid'];
    $dname = $_POST['dname'];
    $did = $_POST['did'];
    $sid = $_POST['sid'];
    $hname = $_POST['hname'];
    $haddress1 = $_POST['haddress1'];
    $haddress2 = $_POST['haddress2'];
    $hcity = $_POST['hcity'];
    $hstate = $_POST['hstate'];
    $hcountry = $_POST['hcountry'];
    $hpostcode = $_POST['hpostcode'];
    $hphone = $_POST['hphone'];
    $hemail = $_POST['hemail'];
    $oname = $_POST['oname'];
    $ophonenumber = $_POST['ophonenumber'];
    $oemail = $_POST['oemail'];
    $cp1name = $_POST['cp1name'];
    $cp1phonenumber = $_POST['cp1phonenumber'];
    $cp1email = $_POST['cp1email'];
    $cp2name = $_POST['cp2name'];
    $cp2phonenumber = $_POST['cp2phonenumber'];
    $cp2email = $_POST['cp2email'];
    $hweb1 = $_POST['hweb1'];
    $notes = $_POST['notes'];
    $dlatitude = $_POST['dlatitude'];
    $dlongitude = $_POST['dlongitude'];
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
 

    // Update the record in the database
    $updatesql = "UPDATE tbDealerMaster SET fdDealerName='$dname', fdDistributorID='$did', fdStockistID='$sid',  fdHeadOfficeName = '$hname', fdHeadOfficeAddressLine1 = '$haddress1', fdHeadOfficeAddressLine2 = '$haddress2', fdHeadOfficeCity ='$hcity', fdHeadOfficeState = '$hstate', fdHeadOfficeCountry = '$hcountry', fdHeadOfficePostalCode = '$hpostcode', fdHeadOfficePhoneNumber = '$hphone', fdHeadOfficeEmail = '$hemail', fdOwnerName = '$oname', fdOwnerPhoneNumber = '$ophonenumber', fdOwnerEmail = '$oemail', fdContactPerson1Name = '$cp1name', fdContactPerson1PhoneNumber = '$cp1phonenumber', fdContactPerson1Email = '$cp1email', fdContactPerson2Name = '$cp2name', fdContactPerson2PhoneNumber = '$cp2phonenumber',  fdContactPerson2Email = '$cp2email', fdWebsiteURL = '$hweb1', fdNotes = '$notes', fdDealerLat = '$dlatitude', fdDealerLong = '$dlongitude', fdDate='$date', fdTime='$time', fdProfileImage='$newfilename' WHERE fdDealerID = '$RoleUniqueID'";

    if ($result = mysqli_query($conn, $updatesql)){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the value of emailChanged
            $emailChanged = ($_POST['emailChanged'] == 0) ? 0 : 1;
            $fdtstatus = $emailChanged;
            if ($emailChanged == 1) {
                $fdstatus = 0;
        
                // Call sendEmail function
                sendEmail($conn, 4, $_POST['oemail']);
            } else {
                // If emailChanged is 1, update fdstatus to 1
                $fdstatus = 1;
            }
        $sql1 = "UPDATE tbUserMaster SET fdUserFName='$oname', fdEmailAsUserID='$oemail',fdPhoneNumber='$ophonenumber', fdCountry='$hcountry', fdCity='$hcity', fdState='$hstate', fdZipCode='$hpostcode', fdLatitude='$dlatitude', fdLongitude='$dlongitude', fdProfileImage ='$newfilename',fdStatus='$fdstatus' WHERE fdRoleUniqueID= '$dealid'";
        if (mysqli_query($conn,$sql1)) {
        echo'<script>Swal.fire({
            icon: "success",
            title: "Updated successfully!..",
          }).then(function(){
          window.location ="?ProfileDealer";
              });
          </script>';            
      } else {
          echo'<script> swal.fire({ 
              icon: "error",
              title:"Failed  to update !"});
          </script>';
      }
    }
  }else {
    echo'<script>Swal.fire({ 
        icon: "error",
        title:"Failed  to Create!"});
    </script>';
}
}
if(isset($_POST['password'])){
    $Email = $_POST['oemail'];
    $roleid = $_POST['dealid'];
    $Sql = "SELECT COUNT(*) FROM tbUserMaster WHERE fdEmailAsUserID='$Email' AND fdRoleUniqueID='$roleid'";
    if (mysqli_query($conn, $Sql)) {
        sendResetMail($conn, 30, $Email, $roleid);
        echo '<script>
        swal.fire({
            title: "Reset link has been sent to your email id.",
            text: "Kindly check your email.",
            icon: "success"
        });
        </script>';
    }
    else
    {
        echo '<script>
        swal.fire({
            title: "Email not sending",
            icon: "error"
        });
        </script>';
}
}
?> 
<script>
function checkEmailChange() {
    var previousEmail = document.getElementById('previousEmail').value;
    var newEmail = document.getElementById('oemail').value;

    if (previousEmail !== newEmail) {
        // Email has changed, set the hidden input field value to 1
        document.getElementById('emailChanged').value = 1;
    } else {
        // Email has not changed, set the hidden input field value to 0
        document.getElementById('emailChanged').value = 0;
    }
}
</script>
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <div class="row">
        <div class="col-12">
        <div class="card">
                <!-- <div class="card-body"> -->
                <div class="card-header " style="background-color:#1e88e566;">
                    <h4 class="mb-0 text-white"><strong>UPDATE DEALER PROFILE</strong></h4>
               </div>
                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <h4 class="card-title">Dealer User</h4>
                        <div class="row">                    
                            <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname3" class="col-sm-3 text-right control-label col-form-label">Dealer Name <code>*</code></label>
                                                <div class="col-sm-9">
                                                <input type="text" class="form-control required-field" id="dname" name="dname" placeholder="Enter Dealer Name" value="<?php echo $rows["fdDealerName"]; ?>" onblur="validateField(this)" oninput="validateField(this)" required>
                                                <span class="error-message"></span>    
                                            </div>
                                            </div>
                            </div>
                            
                             <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="uname1" class="col-sm-3 text-right control-label col-form-label ">Manufacture ID <code>*</code></label>
                                    <div class="col-sm-9">
                                        
                                    <input name="mid" id="mid" class="form-control "  value="<?php echo $manufacturerID?>" readonly >
                                 
                        </div>                                                 
                                </div>
                            </div>
                            </div>
                           
                            <div class="row">
                            <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                            <!-- <div class="form-group row"> -->
                                <label for="uname1" class="col-sm-3 text-right control-label col-form-label">Distributor ID <code>*</code></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="did" name="did" value="<?php echo $distributorID ?>" readonly> 
                            
                                </div>                                    
                                </div> 
                        </div>
                    <!-- </div> -->

                    <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-3 text-right control-label col-form-label">Stockist ID<code>*</code></label>
                                    <div class="col-sm-9">
                                    <input name="sid" id="sid" class="form-control "  value="<?php echo $stockistID?>" readonly >
                            
                              </div>                                    
                                </div>
                            </div>
                            </div>
                        <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="uname" class="col-sm-3 text-right control-label col-form-label">Dealer ID <code>*</code></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="dealid" name="dealid" value="<?php echo $RoleUniqueID; ?>" readonly> 
                                </div>                                    
                                </div>
                            </div>
</div>
                            </div> 
                      
                    <hr style=" margin-top: -5px; margin-bottom: -4px; background: grey; opacity: 0.5; ">
                    <div class="card-body">
                    <h4 class="card-title">Head Office Details</h4>
                    <div class="card-body">
                     <div class="row">
                    <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="fname2" class="col-sm-3 text-right control-label col-form-label ">Name <code>*</code></label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control required-field" id="hname" name="hname" placeholder="Enter Head Office Name Here" value="<?php echo $rows["fdHeadOfficeName"]; ?> " onblur="validateField(this)" oninput="validateField(this)" required >   
                                    <span class="error-message"></span>    
                                </div>                                
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row ">
                                    <label for="web1" class="col-sm-3 text-right control-label col-form-label">Website</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="hweb1" name="hweb1" placeholder="http://" value="<?php echo $rows["fdWebsiteURL"]; ?>">     
                                    </div>                              
                                </div>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="cono12" class="col-sm-3 text-right control-label col-form-label">Phone Number <code>*</code></label>
                                    <div class="col-sm-9">
                                    <input type="tel" class="form-control required-field" name="hphone" id="hphone" placeholder="Contact No Here" value="<?php echo $rows["fdHeadOfficePhoneNumber"]; ?>" onblur="validateField(this)" oninput="validateField(this)" required >     
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
                    <label for="email2" class="col-sm-3 text-right control-label col-form-label">Email</label>
                    <div class="col-sm-9">
                    <input type="email" class="form-control required-field" id="hemail" name="hemail" placeholder="Email Here" value="<?php echo $rows["fdHeadOfficeEmail"]; ?>"  pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$">  
                       
                </div>                                 
                    </div>
                </div>
            </div>
    
        <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Country <code>*</code></label>
                    <div class="col-sm-9">
                    
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
                            <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">State <code>*</code></label>
                            <div class="col-sm-9">
                            <select class="form-control required-field selectpicker" id="hstate" name="hstate" onblur="validateField(this)" oninput="validateField(this)" required>
                            <!-- <option value="">Select State</option> -->
                            <!-- <option value="<?php echo $rows["fdHeadOfficeState"]; ?>"><?php echo $rows["fdHeadOfficeState"]; ?></option> -->
                            <?php
                    $selectedCountryId = $rows["fdHeadOfficeCountry"];
                    $selectedStateId = $rows["fdHeadOfficeState"];

                    // Fetch states related to the selected country
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
                                <label class="col-sm-3 text-right control-label col-form-label">City <code>*</code></label>
                                <div class="col-sm-9">
                                <select class="form-control required-field" id="hcity" name="hcity" onblur="validateField(this)" oninput="validateField(this)" required>
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
                        <label class="col-sm-3 text-right control-label col-form-label">Postal Code <code>*</code></label>
                               <div class="col-sm-9">
                                <input type="text" class="form-control required-field" id="hpostcode" name="hpostcode" placeholder="Post code Here" value="<?php echo $rows["fdHeadOfficePostalCode"]; ?>" onblur="validateField(this)" oninput="validateField(this)" required >               
                                <span class="error-message"></span>    
                            </div>                        
                        </div>
                    </div>                                
                    </div>                                    
                    <div class="row">
                      <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Address 1 <code>*</code></label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control required-field" id="haddress1" name="haddress1" placeholder="Address1 Here" value="<?php echo $rows["fdHeadOfficeAddressLine1"]; ?>" onblur="validateField(this)" oninput="validateField(this)" required >            
                        <span class="error-message"></span>
                        </div>       
                      </div> 
                      </div>                                            
                      <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 text-right control-label col-form-label">Address 2</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="haddress2" name="haddress2" placeholder="Address2 Here" value="<?php echo $rows["fdHeadOfficeAddressLine2"]; ?>">            
                        </div>   
                     </div>
                     </div>                                                 
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Latitude <code>*</code></label>
                                    <div class="col-sm-9" style="display: flex;">
                                    <input type="text" class="form-control required-field" id="dlatitude" name="dlatitude" placeholder="Dealer Latitude Here" value="<?php echo $rows["fdDealerLat"]; ?>" onblur="validateField(this)" oninput="validateField(this)" required >  
                                    <span class="error-message"></span>
                                    <button class="btn btn-outline-secondary" type="button" onclick="refreshLatitude()" style="border-color: #80808000;">
                                    <i class="fas fa-sync-alt"></i>
                                </button>                         
                                       
                            </div>                        
                                
                            </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Longitude <code>*</code></label>
                                    <div class="col-sm-9" style="display: flex;">
                                    
                                    <input type="text" class="form-control required-field" id="dlongitude" name="dlongitude" placeholder="Dealer Longitude Here" value="<?php echo $rows["fdDealerLong"]; ?>" onblur="validateField(this)" oninput="validateField(this)" required >  
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
                <label class="col-sm-3 text-right control-label col-form-label">Enter Location</label>
                <div class="col-sm-9">
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
    var updatedLatitude = <?php echo $rows["fdDealerLat"]; ?>;
    document.getElementById('dlatitude').value = updatedLatitude;
}

function refreshLongitude() {
    // Get the updated longitude value from your data source and set it in the input field
    var updatedLongitude = <?php echo $rows["fdDealerLong"]; ?>;
    document.getElementById('dlongitude').value = updatedLongitude;
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
            center: { lat: <?php echo $rows['fdDealerLat']; ?>, lng: <?php echo $rows['fdDealerLong']; ?> },
            zoom: 16
        });
        infoWindow = new google.maps.InfoWindow;

        // Add marker to the map
        marker = new google.maps.Marker({
            position: { lat: <?php echo $rows['fdDealerLat']; ?>, lng: <?php echo $rows['fdDealerLong']; ?> },
            map: map,
            draggable: true,
            title: 'Dealer Location'
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
        document.getElementById('dlatitude').value = latLng.lat();
        document.getElementById('dlongitude').value = latLng.lng();
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
<h4 class="card-title">Profile Picture</h4>

<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Upload Image</label>
        <div class="input-group col-sm-8">
            <div class="input-group-prepend">
                <input type="file" id="P_image" name="P_image" class="form-control" onchange="displayUserPhoto(this)">
                <span class="input-group-text">Browse</span>
            </div>

            <div class="col-sm-4">
                <!-- Display the user photo from the database -->
                <img id="userPhoto" src="<?php echo !empty($rows["fdProfileImage"]) ? 'image/profile/'.$rows["fdProfileImage"] : ''; ?>" width="100" align="right" style="float: left;margin-top:-40px; margin-left:410%;">
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
                    <hr style=" margin-top: -5px; margin-bottom: -4px; background: grey; opacity: 0.5;">
                    <div class="card-body">
                    <h4 class="card-title">Owner Details</h4>                 
                                    
                    <div class="card-body">                                        
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Owner Name <code>*</code></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control required-field" id="oname"  name="oname" placeholder="Owner Name Here" value="<?php echo $rows["fdOwnerName"]; ?>" onblur="validateField(this)" oninput="validateField(this)" required >                               
                                <span class="error-message"></span>   
                            </div>
                            </div>                           
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-3 text-right control-label col-form-label">Phone Number <code>*</code></label>
                                <div class="col-sm-9">
                                <input type="tel" class="form-control required-field" name="ophonenumber" id="ophonenumber" placeholder="Contact No Here" value="<?php echo $rows["fdOwnerPhoneNumber"]; ?>" onblur="validateField(this)" oninput="validateField(this)" required >              
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
                                <label for="email2" class="col-sm-3 text-right control-label col-form-label">Email <code>*</code></label>
                                <div class="col-sm-9">
                                <input type="hidden" id="previousEmail" name="previousEmail" value="<?php echo $rows['fdOwnerEmail'];?>">
                                <input type="hidden" id="emailChanged" name="emailChanged" value="0">
                                <input type="email" class="form-control required-field" id="oemail" name="oemail" placeholder="Email Here" value="<?php echo $rows["fdOwnerEmail"]; ?>"  pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" onblur="validateField(this)" oninput="validateField(this)" onchange="checkEmailChange()" required >                              
                                <span class="error-message"></span>   
                            </div>     
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="nname" class="col-sm-3 text-right control-label col-form-label">Password </label>
                                <div class="col-sm-9">
                                <button  type="submit" class="btn btn-secondary waves-effect waves-light" name="password" id="password" style="height:35px; weight:60%; ">Change Password</button>      
                                                              
                                </div>                                    
                        </div>
                    </div>
                        </div>                                    
                    </div>
                    </div>
                   
                    <hr style=" margin-top: -5px; margin-bottom: -4px; background: grey; opacity: 0.5;">
                    <div class="card-body">
                    <h4 class="card-title">Contact Person1 Details</h4>
                     <div class="card-body">
                                       
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Person1 Name </label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control required-field" id="cp1name"  name="cp1name" placeholder="Contact Person1 Name Here" value="<?php echo $rows["fdContactPerson1Name"]; ?>" >                    
                                   
                            </div>            
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-3 text-right control-label col-form-label">Phone Number </label>
                                <div class="col-sm-9">
                                <input type="tel" class="form-control required-field" name="cp1phonenumber" id="cp1phonenumber" placeholder="Contact Person1 No Here" value="<?php echo $rows["fdContactPerson1PhoneNumber"]; ?>" >
                                 
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
                                <label for="email2" class="col-sm-3 text-right control-label col-form-label">Email </label>
                                <div class="col-sm-9">
                                <input type="email" class="form-control required-field" id="cp1email" name="cp1email" placeholder="Email Here" value="<?php echo $rows["fdContactPerson1Email"]; ?>"  pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" >                 
                                   
                            </div>                   
                                </div>
                            </div>
                    </div>
                    </div>
                    </div>
                    <hr style=" margin-top: -5px; margin-bottom: -4px; background: grey; opacity: 0.5;">
                    
                    <div class="card-body">
                    <h4 class="card-title">Contact Person2 Details</h4>
                     <div class="card-body">
                                        
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-3 text-right control-label col-form-label">Person2 Name</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="cp2name"  name="cp2name" placeholder="Contact Person2 Name Here" value="<?php echo $rows["fdContactPerson2Name"]; ?>">                     
                                </div>           
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-3 text-right control-label col-form-label">Phone Number</label>
                                <div class="col-sm-9">
                                <input type="tel" class="form-control" name="cp2phonenumber" id="cp2phonenumber" placeholder="Contact Person2 No Here" value="<?php echo $rows["fdContactPerson2PhoneNumber"]; ?>">
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
                                <label for="email2" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                <div class="col-sm-9">
                                <input type="email" class="form-control" id="cp2email" name="cp2email" placeholder="Email Here" value="<?php echo $rows["fdContactPerson2Email"]; ?>"  pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" >                 
                                </div>                   
                                </div>
                            </div>
                    </div>
                    </div>
                    </div>
                    <hr style="margin-top: -30px; margin-bottom: -4px; background: grey; opacity: 0.5;">
        <div class="card-body">
            <h4 class="card-title">NOTES</h4>
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
                <button type="submit" class="btn btn-warning waves-effect waves-light float-left" name="Updatebtn" id="Updatebtn" onclick="validateAllRequiredFields()">Update</button>
                </td>
            </div>
        </div>
    </form><br><br>
</div>
</div>
</div>
</div>

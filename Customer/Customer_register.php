<?php
require "Custmoer_header.php";
require "Customer_lognav.php";
require "connection.php"; 
date_default_timezone_set('Asia/Kolkata'); 
// $roleuniqueid = "#" . date('m') . "/" . date('y') . mt_rand(100000,999999);
require("../function.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['savebtn'])){
    $CustId = $_POST['fdCustomerID'];
    $Firstname = $_POST['fname'];
    $Lastname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $phonenum = $_POST['phone'];
   
    $country = $_POST['country'];
    $state = $_POST['state'];  
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
   

    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
        // Google reCAPTCHA API secret key 
        $secret_key = '6LdZvfAoAAAAAC6aFEGlEsrj8Stua6hR_81pNqwL'; 
            
        // reCAPTCHA response verification
        $verify_captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']); 
            
        // Decode reCAPTCHA response 
        $verify_response = json_decode($verify_captcha); 
            
        // Check if reCAPTCHA response returns success 
        if($verify_response->success){ 
            
        $sql = "INSERT INTO tbCustomerMaster (fdCustomerID,fdUserFName, fdUserLName, fdEmailAsUserID, fdPassword, fdPhoneNumber, fdCountry, fdCity, fdState, fdZipCode, fdLatitude, fdLongitude, fdRegistrationDate)
        VALUES ('$CustId','$Firstname', '$Lastname', '$email', '$pass', '$phonenum', '$country', '$city', '$state', '$zipcode', '$latitude', '$longitude', CURDATE())";
       
            if (mysqli_query($conn, $sql)) {
                CustomerEmail($conn, 31, $email);
                echo '<script> swal.fire({
                    title: "Done! You are registered now!",
                    text: "",
                    icon: "success",
                    
                    });
                    </script>';
            } else {
                echo '<script> swal.fire({
                    title: "Registration Failed!",
                    text: "",
                    icon: "error"
                    })
                    </script>';
            }
        
        } else {
            echo '<script> swal.fire({
                title: "Registered Failed now!",
                text: "",
                icon: "error"
                })
                </script>';
        }
                
            }
    else {
            echo '<script> swal.fire({
                title: "Registered Failed",
                text: "Recaptcha Needed",
                icon: "error"
                })
                </script>';
        }
    }
?>
<style>
        .error-message {
            color:#e83e8c;
            font-size: 14px;
            /* position: relative;  */
             /* bottom: 3;
            left: 0;
            width: 100%;
            text-align: center;
           border-color: red; */
        } 
        #mapCanvas {
      height: 300px;
}
label.control-label{
    white-space:nowrap;
}
.btn-info{
    background-color:#007bff;
    border-color:#007bff;

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
img[src='captcha.php'] {
    margin-bottom: 10px;
}

/* CSS for styling the CAPTCHA input field */
input[name='captcha'] {
    margin-bottom: 10px;
}

/* Style to change the cursor to a pointer when hovering over the icon */
#showPasswordIcon:hover {
    color:#007bff;
}

 /* Dark theme styling for the dropdown */
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
    
    /* Custom styles for dark theme */
    .iti .iti__flag-container {
      background-color: #333; /* Change this to your desired background color */
    }

    .iti.dark .iti__country-list {
      background-color: #333; /* Change this to your desired background color */
    }

    .iti.dark .iti__country-list .iti__country {
      color: #fff; /* Change this to your desired text color */
    }
</style>


<script>
$(document).ready(function() {
    $('#country').on('change', function() {
        var country_id = this.value;
        $.ajax({
            url: "get_country.php",
            type: "POST",
            data: {
                country_id: country_id
            },
            cache: false,
            success: function(result){
                $("#state").html(result);
                $('#city').html('<option value="">Select State First</option>'); 
            }
        });
    });
        
});    
 
$(document).ready(function() {
$('#country').on('change', function() {
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
            $('#state')
                .empty()
                .append(result)
                .selectpicker('refresh'); // Refresh the Bootstrap Select
            $('#city').html('<option value="">Select State First</option>');
        }
    });
});
});
$(document).ready(function() {
    $('#state').on('change', function() {
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
                    $('#city').html(result);
                }
            });
        } else {
            // Clear the city dropdown if no state is selected
            $('#city').html('<option value="">Select City</option>');
        }
    });
});
</script>
<script src="https://www.google.com/recaptcha/api.js?render=6LcYrPAoAAAAALl78lTO33vR0Pl-Lh7NqREMPpIT"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


<div class="container" >
<div class="row" style="max-width:90%; margin-top:20px; margin-left:50px;">
    <div class="col-12">
        <div class="card"> 
            <div class="card-header"  style="background-color:#1e88e566;">
                <h4 class="card-title mb-0 text-white"><strong>REGISTRATION</strong></h4>
</div>
<!-- <hr style="margin-top: -5px; margin-bottom: -4px; background: grey; opacity: 0.5;"> -->
<form class="form-horizontal" id="myForm" onsubmit="return validateRecaptcha()" method="POST" enctype="multipart/form-data" >
<div class="card-body">
<h4 class="card-title">PERSON DETAILS</h4>
<div class="card-body">
<div class="row">                    
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">First Name <code>*</code></label>
            <div class="col-sm-8">
                <input type="text" class="form-control required-field" id="fname" name="fname" placeholder="First Name Here" onblur="validateField(this)" oninput="validateField(this)"
                required>
                <span class="error-message"></span>
                </div>  
        </div>
    </div> 
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="nname" class="col-sm-4 text-right control-label col-form-label">Last Name <code>*</code></label>
            <div class="col-sm-8">
                <input type="text" class= "form-control required-field" id= "lname" name= "lname" placeholder= "Last Name Here" onblur="validateField(this)" oninput="validateField(this)"  required>
                <span class="error-message"></span>
                </div>                                    
        </div>
    </div>
</div>

<div class="row">                    
<div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email <code>*</code></label>
            <div class="col-sm-8">
                <input type="email" class="form-control required-field" id="hemail" name="email" placeholder="Email Here" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" onblur="checkEmailAvailability()" oninput="checkEmailAvailability()">
                        <span id="emailError" class="error-message"></span>
                </div>                                   
        </div>
    </div>
<script>
function checkEmailAvailability() {
    var email = document.getElementById("hemail").value;
    var emailErrorElement = document.getElementById("emailError");

    // Make an AJAX request to check email availability
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/check_email.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if (response === "exists") {
                emailErrorElement.textContent = "Email already exists in the database.";
                savebtn.disabled = true; 
            } else {
                emailErrorElement.textContent = "";
                savebtn.disabled = false; 
            }
        }
    };
    xhr.send("email=" + email);
}
</script>
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="nname" class="col-sm-4 text-right control-label col-form-label">Password <code>*</code></label>
        <div class="col-sm-8">
        <input type="password" class="form-control required-field" id="password" name="password" placeholder="Password Here"  onblur="validatePassword(this)" oninput="validatePassword(this)" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and be at least 8 characters long">
    <i class="fa fa-eye-slash" id="showPasswordIcon" onclick="togglePasswordVisibility()"></i>   
    <span class="error-message" id="errorText"></span>                                 
            </div>                                    
    </div>
</div>
</div>

<div class="row">
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
    <label for="cono12" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Phone Number <code>*</code></label>
        <div class="col-sm-8">
            <input type="tel" class="form-control required-field" name="phone" id="phone" placeholder="Contact No Here" required onblur="validateField(this)" oninput="validateField(this)" >
            <span class="error-message"></span>
            </div>
    </div>
</div>

<script>
    const phoneInputField = document.querySelector("#phone");
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

</div>

</div>
</div>

    
<hr style=" margin-top: -5px; margin-bottom: -4px; background: grey; opacity: 0.5;">
<div class="card-body">
<h4 class="card-title">ADDRESS DETAILS</h4>
<div class="card-body">
<div class="row">
    <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label class="control-label text-right col-sm-4">Country <code>*</code></label>
                <div class="col-sm-8">
                <select class="form-control required-field" id="country" name="country" placeholder="Country Name Here" required onblur="validateField(this)" oninput="validateField(this)" >
                
                <option value="">Select Country</option>  
                <?php
require_once "connection.php";

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
<select class="form-control required-field"id="state" name="state" placeholder="State Name Here" required onblur="validateField(this)" oninput="validateField(this)" >
<option value="">Select State</option> 
    
    </select>
    <span class="error-message"></span>   
</div>                                            
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label class="col-sm-4 text-right control-label col-form-label">City <code>*</code></label>
        <div class="col-sm-8">
            <select class="form-control required-field" id="city" name="city"  placeholder="City Name Here" required onblur="validateField(this)" oninput="validateField(this)"  >
            <option value="">Select City</option>  
</select>
            <span class="error-message"></span>
</div>                                                    
</div>
</div>

<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label class="col-sm-4 text-right control-label col-form-label">Zip Code <code>*</code></label>
        <div class="col-sm-8">
            <input type="text" class="form-control required-field" id="zipcode" name="zipcode" placeholder="Zip code Here" required onblur="validateField(this)" oninput="validateField(this)" >
            <span class="error-message"></span>
    </div>                                                    
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Latitude <code>*</code></label>
        <div class="col-sm-8">
            <input type="text" class="form-control required-field" id="latitude" name="latitude" placeholder=" Latitude Here" required onblur="validateField(this)" oninput="validateField(this)" >
            <span class="error-message"></span>
</div>                                                   
    </div>
</div>
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label class="col-sm-4 text-right control-label col-form-label" style="white-space: nowrap;">Longitude <code>*</code></label>
        <div class="col-sm-8">
            <input type="text" class="form-control required-field" id="longitude" name="longitude" placeholder=" Longitude Here" required onblur="validateField(this)" oninput="validateField(this)" >
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
    document.getElementById('latitude').value = latLng.lat();
    document.getElementById('longitude').value = latLng.lng();
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
}

</script>
<script>
function validateRecaptcha() {
    var recaptcha = grecaptcha.getResponse();
    if (recaptcha.length === 0) {
        alert('Please complete the reCAPTCHA.');
        return false;
    }
    return true;
}
</script>
<div class="container mt-3">
<div class="g-recaptcha" id="recaptcha" data-sitekey="6LdZvfAoAAAAAMcKCfvXfw8cvtDWh8nOEew9IYrB" onblur="validateField(this)" oninput="validateField(this)"  required></div>
</div>

<div class="card-body">
<div class="form-group mb-0 ">
<button  href="Customer_login.php" type="submit" class="btn waves-effect waves-light btn-rounded btn text-white" style="background-color:#1e88e566;" name="savebtn" id="savebtn"disabled onblur="checkEmailAvailability()" oninput="checkEmailAvailability()" onfocus="validatePassword()">Register</button>
<br><br>
<p> Already Have An Account! 
<a href="Customer_login.php"><u>Click Here</u></a></p>
</div>
</div>
</div>


</div>
</div>
</div>
</div>
<!--script to add manufacturerid-->
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

document.getElementById("hemail").addEventListener("input", function () {
  var email = this.value;
  var savebtn = document.getElementById("savebtn");

  if (isValidEmail(email)) {
    savebtn.disabled = false;
  } else {
    savebtn.disabled = true;
  }
});
function isValidEmail(email) {
 
  var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  return emailPattern.test(email);
}
    
</script>

<?php
require("footer.php");
?>
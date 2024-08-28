<style>
        .dt-button {
            display: none;
        }

        @media (max-width: 30em) {
    /* Add your responsive styles here */
    .container-fluid.my-5 {
        padding-left: 5px;
        padding-right: 5px;
        padding-top: 30px;
    }
    
    .card-body {
        padding: 10px;
    }

    .col-sm-12,
    .col-lg-5 {
        width: 100%;
        margin-bottom: 10px;
    }

    .generate-qrcode {
        width: auto;
        margin-top: 10px;
    }

    #tableContainer {
        padding-left: 5px;
        padding-right: 5px;
    }

    .btn-info {
        width: 90%;
        margin: 0 auto;
    }

    #hashInButton {
        width: 100%;
        float: none;
    }

    .table-responsive {
        overflow-x: auto;
    }
    .text-center {
        padding-top: 20px;
    }
}
    </style>
<?php
$roleid = $_SESSION['fdRoleID'];

?>
<div class="container-fluid my-5">
    <div class="card">
        <div class="card-body">
        <h4 class="mb-3">Out-Scan Details</h4>
            <div class="row">
                <!-- Existing code for scanning QR -->
                <div class="col-sm-12 col-lg-5">
                    
                    <form method="POST" id="scanForm">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search QR" name="qrcode" id="qrcode" required>
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                                </div>
                        </div>
                </div>

                <div class="col-sm-12 col-lg-5">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="QR Code" id="qrcode1" name="qrcode1">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-info generate-qrcode" type="submit" name="submit" style="height: 38px;">Scan</button>
                    </form>
                    </div>
            
                <!-- New code for additional QR code scanning -->
                
            
        </div>
    </div>
</div>


    <div class="container-fluid" id="tableContainer" style="display:none;">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead style="text-align: center; background: #1e88e566;color: white;">
                                    <tr>
                                        <th>Package ID</th>
                                        <th>Medicine ID</th>
                                        <th>Trxn Owner ID</th>
                                        <th>Medicine Type</th>
                                        <th>Medicine Batch ID</th>
                                        <th>Medicine Expiry Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                </tbody>
                            </table>
                            <form method="POST" id="hashForm">
                            <input type="hidden" id="searchText" name="searchText">
                            <input type="hidden" id="status" name="status">
                            <input type="hidden" id="roleUniqueId" name="roleUniqueId" value="<?php echo $RoleUniqueID; ?>">
                            <input type="hidden" id="roleid" name="roleid" value="<?php echo $roleid; ?>">
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">
                            <input type="hidden" id="address" name="address">
                            <button id="hashInButton" class="btn btn-info" type="submit" name="submit1" style="width:10%; float: right; display: none;">Hash Out</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <script>
    // Function to fetch and display the encrypted QR code
    function fetchEncryptedQR() {
        var qrCode = document.getElementById('qrcode').value;
        
        // Perform an AJAX request to fetch the encrypted QR code
        $.ajax({
            type: 'POST',
            url: 'fetch_QREncrypt.php',
            data: { qrcode: qrCode },
            success: function(response) {
                // Update the value of the second input field with the fetched encrypted QR code
                document.getElementById('qrcode1').value = response;
                
                // Make AJAX request to fetch data and display table
                fetchDataAndDisplayTable();
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + error);
                
                // Hide the table when there's an error
                $('#tableContainer').hide();
            }
        });
    }

    // Function to fetch data and display the table
    function fetchDataAndDisplayTable() {
        var searchText = $('#qrcode1').val();
        var roleID = $('#roleid').val();
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var address = $('#address').val();

        // Make AJAX request
        $.ajax({
            type: 'POST',
            url: 'ajax/fetch_data.php',
            data: { search: true, qrcode1: searchText, latitude: latitude, longitude: longitude},
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#tableBody').empty(); // Clear previous data
                    $.each(response.data, function(index, row) {
                        var packageId = searchText.split('|')[3].trim();
                        // Get the unique ID from session
                        var roleUniqueId = '<?php echo $RoleUniqueID; ?>';

                        $('#tableBody').append('<tr>' +
                            '<td>' + packageId + '</td>' +
                            '<td>' + row.fdMedicineID + '</td>' +
                            '<td>' + roleUniqueId + '</td>' +
                            '<td>' + row.fdMedicineType + '</td>' +
                            '<td>' + row.fdBatchID + '</td>' +
                            '<td>' + row.fdExpiryDate + '</td>' +
                            '<td style="background: #5af167; color: black;">Out-Scan</td>' +
                            '</tr>');
                    });

                    // Populate hidden input field with searchText
                    $('#searchText').val(searchText);
                    $('#roleid').val(roleID);
                    $('#tableContainer').show(); // Show table
                    $('#hashInButton').show(); // Show "Hash In" button
                    $('#latitude').val(latitude);
                    $('#longitude').val(longitude);
                    $('#address').val(address);

                    // Set status based on roleid
                    var status = '';
                    if ('<?php echo $roleid ?>' === 'MNFR') {
                        status = 'MNFROUT';
                    } else if ('<?php echo $roleid ?>' === 'STKS') {
                        status = 'STKSOUT';
                    } else if ('<?php echo $roleid ?>' === 'DSTR') {
                        status = 'DSTROUT';
                    } else if ('<?php echo $roleid ?>' === 'DELR') {
                        status = 'DELROUT';
                    } else if ('<?php echo $roleid ?>' === 'RTLR') {
                        status = 'RTLROUT';
                    }
                    // Set status value to the hidden input field
                    $('#status').val(status);
                } else {
                    // Show error message when data retrieval fails
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });

                    // Hide the table when there's an error
                    $('#tableContainer').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + error);
                
                // Hide the table when there's an error
                $('#tableContainer').hide();
            }
        });
    }

    // Event listener to trigger fetchEncryptedQR function when the value of the first input field changes
    document.getElementById('qrcode').addEventListener('input', fetchEncryptedQR);

    // Submit the form to blockchain_hash.php when the "Hash In" button is clicked
    $('#hashInButton').click(function() {
        $('#hashForm').attr('action', 'blockchain_hash.php');
        $('#hashForm').submit();
    });
</script>
<script>
    // Function to fetch address based on latitude and longitude
    function fetchAddress(latitude, longitude) {
        // Construct the LatLng object
        var latlng = new google.maps.LatLng(latitude, longitude);

        // Create a geocoder object
        var geocoder = new google.maps.Geocoder();

        // Perform reverse geocoding
        geocoder.geocode({ 'location': latlng }, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    // Extract the formatted address
                    var formattedAddress = results[0].formatted_address;

                    // Update the value of the address input field
                    $('#address').val(formattedAddress);
                } else {
                    console.log('No results found');
                }
            } else {
                console.log('Geocoding failed: ' + status);
            }
        });
    }

    // Function to get the geolocation and update address
    function updateAddress() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // Set values in span tags for latitude and longitude
                $('#latitude').text(latitude);
                $('#longitude').text(longitude);

                localStorage.setItem('latitude', latitude);
            localStorage.setItem('longitude', longitude);

            // Set values in input tags
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;


                // Fetch and update address based on current location
                fetchAddress(latitude, longitude);
            });
        }
    }

    // Call the updateAddress function when the page loads
    $(document).ready(function() {
        updateAddress();
    });
</script>

<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDonb2ULBup0rFfk6C8CSbGx2rcR52vm2o&callback=initMap&libraries=places&v=weekly&channel=2"
        async
    ></script> 
</body>
</html>


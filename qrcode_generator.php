
<style>
#qrcode{
    margin-top: 5px;
   
}
#download-qr{
    margin-top: 15px;;
    width: 227px;
    height: 40px;
}
/* #details {
    margin-top: 6px;
    padding: 7px;
    padding-right: 4px;
    padding-top: 3px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    white-space: pre-line; 
} */
/* .collapse-container {
    border: 1px ; 
    border-radius: 5px; 
    padding: 10px; 
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
} */
.collapse-container {
        margin-top: 20px;
    }

    .card {
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* .btn {
        margin-top: 10px;
    } */

    .container1 {
    max-width: 63rem;
    margin: 0px 35px 0px;
    padding: 2rem;
    /* border: 1px solid #4f5467;
    border-radius: 2.375rem; */
    overflow-x: auto; 
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed; /* Fix the table layout */
}


.table td {
    border-bottom: 1px solid #e2e8f0;
    padding: 0.75rem 1rem;
    padding: 7px; /* Add padding */
    border: 1px solid #ccc;
}



/* Set specific widths for columns */
.table th:nth-child(1),
.table td:nth-child(1) {
    width: 150px; /* ManufacturerID and other first columns */
}

.table th:nth-child(2),
.table td:nth-child(2) {
    width: 150px; /* Value columns */
}

 </style>
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedStrip=$_POST['strip_id'];

}
  ?>          
 <div class="card"> 
    <div class="card-body">
        <div class="container my-5">
            <form method="POST">
                <div>
                    <h4 class="mb-5 text-white"><strong>QR Code Generation</strong></h4>
                </div>
              
                 <div class="row">
                        <div class="col-sm-12 col-lg-4">
                        <div class="form-group row">
                            <div class="col-sm-12">
                    <label for="">Select Package Type:</label>
                        <select class="form-control required-field selectpicker" id="packet_id" name="packet_id" onblur="validateField (this)" oninput="validateField(this)" required>
                        <option selected value="0">Select Package Type</option>
                            <?php
                            include "include/connection.php";
                            $query = "SELECT fdPackageID, fdPackageName FROM tbPackageType";
                            $result = mysqli_query($conn, $query);
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                $selected = ($row["fdPackageID"] == $_POST["packet_id"]) ? 'selected' : '';
                                echo '<option value="' . $row["fdPackageID"] . '" ' . $selected . '> ' . $row["fdPackageName"] . ' </option>';
                            }
                            
                            ?>
                        </select>
                    </div>
                </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="form-group row">
                        <div class="col-sm-12">
                        <label for="">Select Package ID :</label>
                            <select class="form-control required-field selectpicker" id="strip_id" name="strip_id" required>
                            <option selected value="0">Select Package ID</option>

                        </select>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success waves-effect waves-light" name="submit" id="submit" onclick="validateAllRequiredFields()" style="margin-top: 24px;">View Details</button>
                    </div>
                </div>
      </div>    
      </form>
            
      
     
            <?php
        
             include "include/connection.php";
             
             // Handle form submission
             if(isset($_POST['submit'])) {
                 // Fetch selected package ID and type
                 $strip_id = $_POST['strip_id'];
                 $packageType = $_POST['packet_id'];

                $fdQRCodeCreated = 0;

                if ($packageType == 'C') {
                    $query1 = "SELECT fdQRCodeCreated,fdEncryptQRCode FROM tbCarton WHERE fdCartonID = '$strip_id'";
                } elseif ($packageType == 'P') {
                    $query1 = "SELECT fdQRCodeCreated ,fdEncryptQRCode FROM tbPacket WHERE fdPacketID = '$strip_id' ";
                } elseif ($packageType == 'S') {
                    $query1 = "SELECT fdQRCodeCreated , fdEncryptQRCode FROM tbMedicineStripTest WHERE fdStripID = '$strip_id'";
                }
    
                $result1 = mysqli_query($conn, $query1);
    
                if ($result1) {
                    $row = mysqli_fetch_assoc($result1);
                    $fdQRCodeCreated = $row['fdQRCodeCreated'];
                    $encrptedQR = $row['fdEncryptQRCode'];
                }
                
             
                 // Fetch associated packets and strips for the selected carton ID
                 $query = "SELECT * FROM tbMedicineStripTest WHERE fdCartonID = '$strip_id' 
                    OR fdPacketID = '$strip_id' OR fdStripID = '$strip_id' limit 1";



             
                 $result = mysqli_query($conn, $query);
             
                 if ($result) {
                    
                                 while ($row = mysqli_fetch_assoc($result)) {


                                     $packageTypeName = '';
                                     switch ($packageType) {
                                         case 'C':
                                             $packageTypeName = 'Carton';
                                             break;
                                         case 'P':
                                             $packageTypeName = 'Packet';
                                             break;
                                         case 'S':
                                             $packageTypeName = 'Strip';
                                             break;
                                         default:
                                             $packageTypeName = '';
                                             break;
                                     }
                                     $medicineTypeQuery = "SELECT fdMedicineType FROM tbMedicineMaster WHERE fdMedicineID = '{$row['fdMedicineID']}'";
                                     $medicineTypeResult = mysqli_query($conn, $medicineTypeQuery);
                                     $medicineTypeRow = mysqli_fetch_assoc($medicineTypeResult);
                                     $medicineType = $medicineTypeRow['fdMedicineType'];
            ?>
            <div class="container1">
                <table class="table">
                <tbody>
                        <?php
                        $heading = '';
                if ($packageType === 'C') {
                    $heading = 'Carton ID Details';
                } elseif ($packageType === 'P') {
                    $heading = 'Packet ID Details';
                } elseif ($packageType === 'S') {
                    $heading = 'Strip ID Details';
                }
                ?>

            <tr>
                <td colspan="2" style="background-color: #1e88e566;">
                    <h4 style="color: white; text-align: center;"><?php echo $heading; ?></h4>
                </td>
            </tr>
            
             <tr>
                <td><strong>ManufacturerID:</strong> </td>
                <td><?php echo $row['fdManufacturerID']; ?></td>
            </tr>
            <tr>
            <?php
    // First conditionally show the QR code row
    if ($fdQRCodeCreated == 1) {
        ?>
        <tr id="qr-code-row">
            <td><strong>QR Code:</strong></td>
            <td>
                <input type="hidden" id="qrcodegen"/>
                <img id="myImage" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data= + <?php echo $encrptedQR; ?>">
                <div d-flex style="display: flex; flex-direction: column; align-items: flex-start;">
                    <button id="downloadBtn" class="btn btn-primary btn-md" type="button" style="margin-top: 10px;">Download QR Code</button>
                </div>
            </td>
        </tr>
        <?php
    }

    // Conditionally show the QR code row again if fdQRCodeCreated is 0
    if ($fdQRCodeCreated == 0) {
        ?>
        <tr id="qr-code-row" style="display: none;">
            <td><strong>QR Code:</strong></td>
            <td>
                <input type="hidden" id="qrcodegen"/>
                <img id="myImage">
                <div d-flex style="display: flex; flex-direction: column; align-items: flex-start;">
                    <button id="downloadBtn" class="btn btn-primary btn-md" type="button" style="margin-top: 10px;">Download QR Code</button>
                </div>
            </td>
        </tr>
        <?php
    }

?>
                <td> <strong>MedicineID:</strong></td>
                <td><?php echo $row['fdMedicineID']; ?></td>
            </tr>
            <tr>
                <td><strong>Package type:</strong> </td>
                <td><?php echo $packageTypeName; ?></td>
            </tr>
            <tr>
                <td> <strong>Package ID:</strong></td>
                <td><?php echo $strip_id; ?></td>
            </tr>
            <?php
                            // Fetch associated packets and strips for the selected carton ID
                            if ($packageType == 'P') {
                                $query = "SELECT *,                               
                                (SELECT COUNT(fdStripID) FROM tbMedicineStripTest WHERE fdPacketID = '$strip_id') as No_of_Strips 
                            FROM tbMedicineStripTest WHERE fdPacketID = '$strip_id' OR fdStripID = '$strip_id' LIMIT 1";
                              $result = mysqli_query($conn, $query);
                              $row = mysqli_fetch_assoc($result);
                                echo '<td><strong>No Of strips:</strong></td>';
                                echo '<td>' . $row['No_of_Strips'] . '</td>';

                            } elseif ($packageType == 'C') {
                                $query = "SELECT *, 
                                (SELECT COUNT(DISTINCT fdPacketID) FROM tbMedicineStripTest WHERE fdCartonID = '$strip_id') as No_of_Packets,
                                (SELECT COUNT(fdStripID) FROM tbMedicineStripTest WHERE fdCartonID = '$strip_id') as No_of_Strips
                                FROM tbMedicineStripTest 
            WHERE fdCartonID = '$strip_id' OR fdPacketID = '$strip_id' LIMIT 1";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            echo '<tr>';
                            echo '<td><strong>No Of strips:</strong></td>';
                            echo '<td>' . $row['No_of_Strips'] . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td><strong>No Of Packets:</strong></td>';
                            echo '<td>' . $row['No_of_Packets'] . '</td>';
                            echo '</tr>';

                            }
                            ?>
            <tr>
                <td><strong>MedicineType:</strong></td>
                <td><?php echo $medicineType; ?></td>
            </tr>
            <tr>
                <td>  <strong>Medicine BatchID:</strong></td>
                <td><?php echo $row['fdBatchID']; ?></td>
            </tr>
            <tr>
                <td><strong>Medicine ExpiryDate:</strong> </td>
                <td><?php echo $row['fdExpiryDate']; ?></td>
            </tr>
            <tr>
                <td><strong>Country of Origin:</strong> </td>
                <td>India</td>
            </tr>
            <tr id="generateQRCodeRow" <?php echo ($fdQRCodeCreated == 1) ? 'style="display: none;"' : ''; ?> >
            <td><strong>Action:</strong></td>
            <td>
                <button class="btn btn-primary btn-sm generate-qrcode">Generate QR Code</button>
            </td>
        </tr>
    </tbody>
    </table>
</div>
<?php
        }
    } else {
        echo "No data found.";
    }
}
?>
       
</div>
        </div>
    </div>
 </div>
   
 <script>
    // Hide or show the 'Generate QR Code' row based on fdQRCodeCreated value
    $(document).ready(function() {
        if ($fdQRCodeCreated == 1) {
            $('#generateQRCodeRow').hide();
        } else {
            $('#generateQRCodeRow').show();
        }
    });
</script>

<!-- 16/04/24 add jidnyasa Patil for Genrateqr code button  -->


<!-- <div class="collapse-container" style="display: none;">
                <div class="card card-body">
               
                    <div class="row">
                        <div class="col-md-3">
                        <input type="hidden" id="qrcodegen"/>
                        <img id='myImage'  download>
                        </div>
                    </div>
                    <div d-flex style="display: flex; flex-direction: column; align-items: flex-start;">
        <button id="downloadBtn" class='btn btn-primary btn-md' type="button" style="margin-top: 10px;">Download QR Code</button>
    </div>

</div>              
</div> -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    
    // $('#showQRCodeRow').hide();
    // $('#generateQRCodeRow').show();   

    $('.generate-qrcode').click(function(e) {
        e.preventDefault(); 
        var strip_id = '<?php echo $strip_id; ?>'; 
        var apiUrl =  'https://schedarcloud.com/api/qrencrypt.php';
        var packageType = '<?php echo $packageType; ?>'; 
        
        $.ajax({
            type: 'POST',
            url: 'UpdateAndFetchQR.php',
            data: {
                strip_id: strip_id,
                packageType: packageType,
                apiUrl: apiUrl
            },
            success: function(response) {
              
                switch (packageType) {
                    case 'C':
                        Swal.fire({
                            icon: 'success',
                            title: 'Carton QR Code updated successfully'
                        });
                        break;
                    case 'P':
                        Swal.fire({
                            icon: 'success',
                            title: 'Packet QR Code updated successfully'
                        });
                        break;
                    case 'S':
                        Swal.fire({
                            icon: 'success',
                            title: 'Strip QR Code updated successfully'
                        });
                        break;
                    default:
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Invalid package type'
                        });
                        break;
                }

                // Fetch the updated QR code after generation
                $.ajax({
                    type: 'POST',
                    url: 'UpdateAndFetchQR.php',
                    data: {
                        strip_id: strip_id,
                        packageType: packageType
                    },
                    success: function(response) {
                
                        $('#qrcodegen').val(response);
                        $('#myImage').attr('src', 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' + response);
                        $('#qr-code-row').show(); 
                        $('#myImage').show(); 

                        // document.querySelector(".collapse-container").style.display = "block";
                        // $('#showQRCodeRow').show(); 
                         $('#generateQRCodeRow').hide(); 


                    },
                    error: function(xhr, status, error) {
                        console.log('Error fetching QR code: ' + error);
                    }
                });
            },
            error: function(xhr, status, error) {
                // Handle error response for QR code generation
                console.log('Error generating QR code: ' + error);
            }
        });
    });
});
</script>


<script>
    document.getElementById("downloadBtn").addEventListener("click", function() {
        // Get the image source
        var imgSrc = document.getElementById("myImage").src;
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();
        // Open the request for the image source URL
        xhr.open("GET", imgSrc, true);
        // Set the responseType to 'blob' to handle binary data
        xhr.responseType = "blob";
        // Function to handle the onload event of the XMLHttpRequest
        xhr.onload = function() {
            // Check if the request was successful
            if (this.status === 200) {
                // Create a Blob from the response
                var blob = new Blob([this.response], { type: "image/png" });
                // Create a URL for the Blob
                var url = window.URL.createObjectURL(blob);
                // Create a temporary link element
                var link = document.createElement("a");
                // Set the href attribute to the Blob URL
                link.href = url;
                // Set the download attribute with the desired file name
                link.download = "QR_Code_<?php echo $strip_id;?>.png";
                // Programmatically trigger a click event on the link
                link.click();
                // Cleanup: Revoke the Blob URL to release memory
                window.URL.revokeObjectURL(url);
            }
        };
        // Send the XMLHttpRequest
        xhr.send();
    });
</script>

<script>
    $(document).ready(function() {
        // Function to populate dropdown options
        function populateStripIDs(selectedPacket) {
            var url = '';
            if (selectedPacket == 'C') {
                url = 'get_carton.php';
            } else if (selectedPacket == 'S') {
                url = 'get_strip.php';
            } else if (selectedPacket == 'P') {
                url = 'get_packet.php';
            }
            $.ajax({
                url: url,
                type: 'GET',
                data: { packet_type: selectedPacket },
                success: function(data) {
                    $('#strip_id').html(data);
                    // After loading options, select the stored value
                    if (selectedStripID) {
                        $('#strip_id').val(selectedStripID);
                    }
                }
            });
        }

        $('#packet_id').change(function() {
            var selectedPacket = $(this).val();
            populateStripIDs(selectedPacket);
        });

        // Check if a strip ID is stored in session and pre-select it
        var selectedStripID = '<?php echo isset($_POST['strip_id']) ? $_POST['strip_id'] : '' ?>';
        var selectedPacketID = '<?php echo isset($_POST['packet_id']) ? $_POST['packet_id'] : '' ?>';
        if (selectedStripID && selectedPacketID) {
            populateStripIDs(selectedPacketID);
        }
    });
    
</script>
<script src="path/to/qrcode.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.js" integrity="sha512-is1ls2rgwpFZyixqKFEExPHVUUL+pPkBEPw47s/6NDQ4n1m6T/ySeDW3p54jp45z2EJ0RSOgilqee1WhtelXfA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>

<script src="path/to/qrcode.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.js" integrity="sha512-is1ls2rgwpFZyixqKFEExPHVUUL+pPkBEPw47s/6NDQ4n1m6T/ySeDW3p54jp45z2EJ0RSOgilqee1WhtelXfA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
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
            <tr>
                <td><strong>Action:</strong> </td>
                <td>
                <button class="btn btn-primary btn-sm generate-qrcode">Generate QR Code</button>
                </td>
            </tr>
            <tr >
                <td><strong>Show Qr code:</strong> </td>
                <td>
                <button  id="showQRCodeBtn"  class="btn btn-primary btn-sm">Show QR Code</button>
                </td>
            </tr>
            <?php
                    }
                } else {
                    echo "No data found.";
                }
            }
                ?>
        </tbody>
    </table>
</div>

   


<!-- 16/04/24 add jidnyasa Patil for Genrateqr code button  -->

<?php
// Include your database connection and other necessary files here

if(isset($_POST['strip_id']) && isset($_POST['packageType']) && isset($_POST['apiUrl'])){
    $strip_id = $_POST['strip_id'];
    $packageType = $_POST['packageType'];
    $apiUrl = $_POST['apiUrl'];

    switch ($packageType) {
            case 'C':
                generateQRCodeAndUpdate($conn, $strip_id, 'tbMedicineStripTest', 'fdCartonID', $apiUrl, 'Carton');
                break;
            case 'P':
                generateQRCodeAndUpdate($conn, $strip_id, 'tbMedicineStripTest', 'fdPacketID', $apiUrl, 'Packet');
                break;
            case 'S':
                generateQRCodeAndUpdate($conn, $strip_id, 'tbMedicineStripTest', 'fdStripID', $apiUrl, 'Strip');
                break;
            default:
                // Handle invalid package type
                echo "Invalid package type";
                break;
        }
}

//function for calling Api
function fnCallApi($varQRData){
    include "include/connection.php";

    // Encode the modified details
    $apiUrl = 'https://smartiot.mirachinnovations.com/MtsWebservice/QR/qrencrypt.php';

    // Encode the $varQRData as JSON
    $jsonData = json_encode(array("data" => $varQRData));
    
    // Make API call to generate QR code
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n" . "Content-Length: " . strlen($jsonData) . "\r\n",
            'content' => $jsonData
        )
    ));
    $response = file_get_contents($apiUrl, false, $context);
    $responseData = json_decode($response, true);

    if ($responseData === null && json_last_error() !== JSON_ERROR_NONE) {
        echo "Error decoding API response: " . json_last_error_msg();
    } else {
        // Check if the API response contains the data field
        if (isset($responseData['data']) && $responseData['status'] == 200) {
            $encrypt = $responseData['data'];
            $_SESSION['qr_data'] = $encrypt;
            return $encrypt;
        } else {
            echo "Error: Invalid API response or hash not present";
        }
    }
}


 function fnUpdateCartonQRCode($fdManufacturerID,$fdMedicineID,$Packet,$packageID,$fdMedicineType,$fdBatchID,$fdExpiryDate,$Countryoforigin,$resultApi,$fdQRCode,$secretkey){
            include "include/connection.php";

        // Fetch fdPacketID and fdStripID from tbRelation
           
        // Update tbCarton
        $updateQueryCarton = "UPDATE tbCarton SET fdQRCode = '$fdQRCode', fdSecretKey = '$secretkey', fdEncryptQRCode = '$resultApi' WHERE fdCartonID = '$packageID'";
        $updateResultCarton = mysqli_query($conn, $updateQueryCarton);

        if ($updateResultCarton) {
            echo "Carton QR codes updated successfully.";
        } else {
            echo "Error updating QR codes: " . mysqli_error($conn);
        }

    
}
//function for updatePacketqrcode
      function fnUpdatePacketQRCode($fdManufacturerID,$fdMedicineID,$Packet,$packageID,$fdMedicineType,$fdBatchID,$fdExpiryDate,$Countryoforigin,$resultApi,$fdQRCode,$secretkey){
       include "include/connection.php";

        // Update tbPacket
          $updateQueryPacket = "UPDATE tbPacket SET fdQRCode = '$fdQRCode', fdSecretKey = '$secretkey', fdEncryptQRCode = '$resultApi' WHERE fdPacketID = '$packageID'";
        $updateResultPacket = mysqli_query($conn, $updateQueryPacket);
       
        if ($updateResultPacket) {
            echo "Packet QR code updated successfully.";
        } else {
            echo "Error updating Packet QR codes: " . mysqli_error($conn);
        }
           
       }
       
       
       //function for updateStripqrcode

       function fnUpdateStripQRCode($fdManufacturerID,$fdMedicineID,$Packet,$fdStripID,$fdMedicineType,$fdBatchID,$fdExpiryDate,$Countryoforigin,$resultApi,$fdQRCode,$secretkey){
        include "include/connection.php";

        // Update tbMedicineStripTest
         $updateQueryStrip = "UPDATE tbMedicineStripTest SET fdQRCode = '$fdQRCode', fdSecretKey = '$secretkey', fdEncryptQRCode = '$resultApi' WHERE fdStripID = '$fdStripID'";
        $updateResultStrip = mysqli_query($conn, $updateQueryStrip);

        if ($updateResultStrip) {
            echo "Strip QR codes updated successfully.";
        } else {
            echo "Error updating Strip QR codes: " . mysqli_error($conn);
        }

}

// Function to generate QR code and update the database
function generateQRCodeAndUpdate($conn, $packageID, $table, $field, $apiUrl,$packagetype) {
    // Fetch package details
    // $details1 = array();
    if($packagetype == "Carton"){
       //count no. of packets
       global $i;
        $i=0;    
        echo $query = "SELECT * FROM $table WHERE $field IN ('$packageID')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query Error: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_assoc($result)) {
        if($i==0){
        $details = json_encode([
            'ManufacturerID' => $row['fdManufacturerID'],
            'MedicineID' => $row['fdMedicineID'],
            'PackageType' => 'Carton',
            'PackageID' => $packageID, 
            'MedicineType' => $row['fdMedicineType'],
            'MedicineBatchID' => $row['fdBatchID'],
            'MedicineExpiryDate' => $row['fdExpiryDate'],
            'Countryoforigin' => 'India'
        ]);
        // global $details1;

        $details1 = implode('|', array_values(json_decode($details, true)));
        $resultApi = fnCallApi($details1);
        $secretkey = substr($resultApi, 0, 6);

        if($resultApi != " "){
           $varUpdatePacket = fnUpdateCartonQRCode($row['fdManufacturerID'],$row['fdMedicineID'],'Carton',$packageID,$row['fdMedicineType'],$row['fdBatchID'],$row['fdExpiryDate'],'India',$resultApi,$details1,$secretkey);
            
        }
}
            $details = json_encode([
            'ManufacturerID' => $row['fdManufacturerID'],
            'MedicineID' => $row['fdMedicineID'],
            'PackageType' => 'Packet',
            'PackageID' => $row['fdPacketID'], 
            'MedicineType' => $row['fdMedicineType'],
            'MedicineBatchID' => $row['fdBatchID'],
            'MedicineExpiryDate' => $row['fdExpiryDate'],
            'Countryoforigin' => 'India'
        ]);
        // global $details1;

        $details1 = implode('|', array_values(json_decode($details, true)));
        $resultApi = fnCallApi($details1);
        $secretkey = substr($resultApi, 0, 6);

        if($resultApi != " "){
           $varUpdatePacket = fnUpdatePacketQRCode($row['fdManufacturerID'],$row['fdMedicineID'],'Packet',$row['fdPacketID'],$row['fdMedicineType'],$row['fdBatchID'],$row['fdExpiryDate'],'India',$resultApi,$details1,$secretkey);
            
        }
        $details = json_encode([
            'ManufacturerID' => $row['fdManufacturerID'],
            'MedicineID' => $row['fdMedicineID'],
            'PackageType' => 'Strip',
            'PackageID' => $row['fdStripID'], 
            'MedicineType' => $row['fdMedicineType'],
            'MedicineBatchID' => $row['fdBatchID'],
            'MedicineExpiryDate' => $row['fdExpiryDate'],
            'Countryoforigin' => 'India'
        ]);
        // global $details1;
        $details1 = implode('|', array_values(json_decode($details, true)));
        $resultApi = fnCallApi($details1);
        $secretkey = substr($resultApi, 0, 6);

        if($resultApi != " "){
           $varUpdateStrip = fnUpdateStripQRCode($row['fdManufacturerID'],$row['fdMedicineID'],'Packet',$row['fdStripID'],$row['fdMedicineType'],$row['fdBatchID'],$row['fdExpiryDate'],'India',$resultApi,$details1,$secretkey);
            
        
        
    }
    $i++;
            
        }
        
    }
    
    if($packagetype == "Packet"){
        global $i;
        $i=0;    
        $query = "SELECT * FROM $table WHERE $field IN ('$packageID')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query Error: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_assoc($result)) {
        if($i==0){
        $details = json_encode([
            'ManufacturerID' => $row['fdManufacturerID'],
            'MedicineID' => $row['fdMedicineID'],
            'PackageType' => 'Packet',
            'PackageID' => $packageID, 
            'MedicineType' => $row['fdMedicineType'],
            'MedicineBatchID' => $row['fdBatchID'],
            'MedicineExpiryDate' => $row['fdExpiryDate'],
            'Countryoforigin' => 'India'
        ]);
        // global $details1;

        $details1 = implode('|', array_values(json_decode($details, true)));
        $resultApi = fnCallApi($details1);
        $secretkey = substr($resultApi, 0, 6);

        if($resultApi != " "){
           $varUpdatePacket = fnUpdatePacketQRCode($row['fdManufacturerID'],$row['fdMedicineID'],'Packet',$packageID,$row['fdMedicineType'],$row['fdBatchID'],$row['fdExpiryDate'],'India',$resultApi,$details1,$secretkey);
            
        }
}
        $details = json_encode([
            'ManufacturerID' => $row['fdManufacturerID'],
            'MedicineID' => $row['fdMedicineID'],
            'PackageType' => 'Strip',
            'PackageID' => $row['fdStripID'], 
            'MedicineType' => $row['fdMedicineType'],
            'MedicineBatchID' => $row['fdBatchID'],
            'MedicineExpiryDate' => $row['fdExpiryDate'],
            'Countryoforigin' => 'India'
        ]);
        // global $details1;
        $details1 = implode('|', array_values(json_decode($details, true)));
        $resultApi = fnCallApi($details1);
        $secretkey = substr($resultApi, 0, 6);

        if($resultApi != " "){
           $varUpdateStrip = fnUpdateStripQRCode($row['fdManufacturerID'],$row['fdMedicineID'],'Packet',$row['fdStripID'],$row['fdMedicineType'],$row['fdBatchID'],$row['fdExpiryDate'],'India',$resultApi,$details1,$secretkey);
            
        
        
    }
    $i++;
            
        }
        
    }
    
    if($packagetype == "Strip"){
        $query = "SELECT * FROM $table WHERE $field IN ('$packageID')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
    
            $details = json_encode([
                'ManufacturerID' => $row['fdManufacturerID'],
                'MedicineID' => $row['fdMedicineID'],
                'PackageType' => 'Strip',
                'PackageID' => $row[$field], 
                'MedicineType' => $row['fdMedicineType'],
                'MedicineBatchID' => $row['fdBatchID'],
                'MedicineExpiryDate' => $row['fdExpiryDate'],
                'Countryoforigin' => 'India'
            ]);
            $details1 = implode('|', array_values(json_decode($details, true)));
            $resultApi = fnCallApi($details1);
            $secretkey = substr($resultApi, 0, 6);
    
            if($resultApi != " "){
               $varUpdateStrip = fnUpdateStripQRCode($row['fdManufacturerID'],$row['fdMedicineID'],'Strip',$row['fdStripID'],$row['fdMedicineType'],$row['fdBatchID'],$row['fdExpiryDate'],'India',$resultApi,$details1,$secretkey);
                
        }
            
        }
    
        } 
  

} 
  

 
?>


<?php

$fdQRCode = '';

if(isset($_POST['strip_id']) && isset($_POST['packet_id']) ){
    $strip_id = $_POST['strip_id'];
     $packageType = $_POST['packet_id'];
   
    $table='';
    $attribute = '';
   
    
    switch ($packageType) {
        case 'C':
            $table = 'tbCarton';
            $attribute = 'fdCartonID';
            break;
        case 'P':
            $table = 'tbPacket';
            $attribute = 'fdPacketID';
            break;
        case 'S':
            $table = 'tbMedicineStripTest';
            $attribute = 'fdStripID';
            break;
        default:
            echo "Invalid package type";
            exit; // Exit script
            break;
    }

    $query = "SELECT fdEncryptQRCode FROM $table WHERE $attribute = '$strip_id'";
    $result = mysqli_query($conn, $query);

    if(!$result) {
        echo "Error executing query: " . mysqli_error($conn);
        exit;
    }

    if ($result && mysqli_num_rows($result) > 0) {                
        $row = mysqli_fetch_assoc($result);
      
        if(isset($row['fdEncryptQRCode'])){
          echo  $fdQRCode = $row['fdEncryptQRCode'];
        } else {
            echo "QR code not found"; 
        }
    } else {
        echo "QR code not found"; 
    }  
    
 }

 ?> 
<div class="collapse-container" style="display: none;">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-3">
                        <input type="hidden" id="qrcodegen" value="<?php echo $fdQRCode; ?>" />
                        <img id='myImage' src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo $fdQRCode; ?>' download>
                        </div>
                    </div>
                    <div d-flex style="display: flex; flex-direction: column; align-items: flex-start;">
              <div id="details"></div>
        <button id="downloadBtn" class='btn btn-primary btn-md' type="button" style="margin-top: 10px;">Download QR Code</button>
    </div>
</div>              
</div>
        </div>
    </div>
 </div>

 <script>
    document.addEventListener("DOMContentLoaded", function() {
        var showQRCodeBtn = document.getElementById("showQRCodeBtn");
        showQRCodeBtn.addEventListener("click", function() {
            var qrcodegen = document.getElementById("qrcodegen").value;
            if (qrcodegen) {
                document.querySelector(".collapse-container").style.display = "block";
            } else {
                alert("QR code not found");
            }
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('.generate-qrcode').click(function(e){
        e.preventDefault(); 
        var strip_id = '<?php echo $strip_id; ?>'; 
        var apiUrl =  'https://smartiot.mirachinnovations.com/MtsWebservice/QR/qrencrypt.php';
        var packageType = '<?php echo $packageType; ?>'; 
        const collapseContainer = document.querySelector('.collapse-container');
        const showQRCodeButton = document.querySelector('.show-qr-code');
        // Send AJAX request to PHP server
        $.ajax({
            type: 'POST',
            url: 'qrcode_generator.php',
            data: {
                strip_id: strip_id,
                packageType: packageType,
                apiUrl: apiUrl
            },
            success: function(response){
                // Handle success response
                // console.log(response);

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
                        title: 'Strip QR Code updated successfully',
                        
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
            location.reload(); 
         
            },
            error: function(xhr, status, error){
                // Handle error response
                console.log(error);
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

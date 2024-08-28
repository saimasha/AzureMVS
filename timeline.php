<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
@import url("https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700");

/* Variables */
:root {
  --bg-body: #f9f9f9;
  --red: #ee4d4d;
  --blue: #2b2e48;
  --primary-color: #7d7d7d;
  --secondary-color: var(--blue);
}
#legend {
  /*background-color: white;*/
  padding: 10px;
  /*border: 1px solid #ccc;*/
  border-radius: 5px;
  position: absolute;
  bottom: -6px;
  left: 25%;
  z-index: 1000;
  display: flex;
}

.legend-marker {
    width: 20px;
    height: 20px;
    display: inline-block;
    margin-right: 7px;
    border: 1px solid #000;
    padding: 10px;
    margin-left: 10px;
}
/* Typography */
/* body,
html {
  height: 100%;
}

body {
  background: var(--bg-body);
  background-size: cover;
  margin: 0;
  padding: 0;
  font-family: helvetica, arial, tahoma, verdana;
  line-height: 20px;
  font-size: 14px;
  color: #726f77;
} */

/* img {
  max-width: 100%;
} */

a {
  text-decoration: none;
}

.container1 {
  max-width: 1100px;
  margin: 0 auto;
  
}

/* h1,
h2,
h3,
h4 {
  font-family: "Dosis", arial, tahoma, verdana;
  font-weight: 500;
} */

.project-name {
  text-align: center;
  padding: 10px 0;
}

/* header::after,
header::before {
  content: '';
  display: block;
  width: 100%;
  clear: both;
} */

.logo {
  color: var(--primary-color);
  float: left;
  font-family: "Dosis";
  font-size: 22px;
  font-weight: 500;
}

.logo > span {
  color: lighten(var(--primary-color), 20%);
  font-weight: 300;
}

.social {
  float: right;
}

.social .btn {
  font-family: "Dosis";
  font-size: 14px;
  margin: 10px 5px;
}

/* Timeline */
#timeline {
  width: 100%;
  margin: 30px auto;
  position: relative;
  padding: 0 10px;
  transition: all 0.4s ease;
}

#timeline::before {
  content: "";
  width: 3px;
  height: 100%;
  background: var(--primary-color);
  left: 50%;
  top: 0;
  position: absolute;
}

#timeline::after {
  content: "";
  clear: both;
  display: table;
  width: 100%;
}

.timeline-item {
  margin-bottom: 50px;
  position: relative;
}

.timeline-item::after,
.timeline-item::before {
  content: '';
  display: table;
}

.timeline-item .timeline-icon {
  background: var(--primary-color);
  width: 50px;
  height: 50px;
  position: absolute;
  top: 0;
  left: 50%;
  overflow: hidden;
  margin-left: -23px;
  border-radius: 50%;
}

.timeline-item .timeline-icon svg {
  position: relative;
  top: 14px;
  left: 14px;
}

.timeline-item .timeline-content {
  width: 45%;
  background: #25292d;
  padding: 20px;
  box-shadow: 0 3px 0 rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  transition: all 0.3s ease;
}

.timeline-item .timeline-content h2 {
  padding: 10px;
  background: var(--primary-color);
  color: #fff;
  margin: -20px -20px 0 -20px;
  font-weight: 300;
  border-radius: 3px 3px 0 0;
  font-weight: bold;
}

.timeline-item .timeline-content::before {
  content: '';
  position: absolute;
  left: 45%;
  top: 20px;
  width: 0;
  height: 0;
  border-top: 7px solid transparent;
  border-bottom: 7px solid transparent;
  border-left: 7px solid #0b4549;
}

.timeline-item .timeline-content.right::before {
  content: '';
  right: 45%;
  left: inherit;
  border-left: 0;
  border-right: 7px solid #07344f;
}

.timeline-content td, .timeline-content th {
  border: 0px solid #dddddd;
  text-align: left;
  padding: 0px;
}

.timeline-content tr:nth-child(even) {
  background-color: transparent;
}




@media screen and (max-width: 768px) {
  #timeline {
    margin: 30px;
    padding: 0px;
    width: 90%;
  }

  #timeline::before {
    left: 0;
  }

  .timeline-item .timeline-content {
    width: 90%;
    float: right;
  }

  .timeline-item .timeline-content::before,
  .timeline-item .timeline-content.right::before {
    left: 10%;
    margin-left: -6px;
    border-left: 0;
    border-right: 7px solid var(--primary-color);
  }

  .timeline-item .timeline-icon {
    left: 0;
  }
}
.timeline-item .timeline-content.right {
    width: 45%;
    background: #25292d;
    padding: 20px;
    box-shadow: 0 3px 0 rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    transition: all 0.3s ease;
    float: right;}
.scanin{
    font-size: 16px;
    margin-left: 85px;
}
@media screen and (max-width: 48em) {
  /* Adjustments for 48em (768px) screen width */
  .timeline-item .timeline-content.right {
    width: 90%; /* Adjusted width */
    margin-left: 0; /* Remove the specific margin */
  }
}
#map {
            height: 400px;
            width: 100%;
        }
        .custom-marker-label {
      color: white; /* Text color */
      width: 30px;  
      height: 30px; /* Height of the label */
      margin-bottom:50px;
      /*border: 2px solid black; */
      border-radius: 50%; /* Make it a circle */
      line-height: 26px; /* Center the text vertically */
      cursor: pointer;
      margin-top:-45px;
      position: relative;
      text-align: center; /* Center the text horizontally */
      text-shadow: 0px 0px 2px #000000;
        }
/* Custom styles for info window to hide the close button */
.gm-style-iw {
            padding: 10px !important;
            overflow: hidden !important;
            max-width: none !important;
            width: auto !important;
        }

        .gm-style-iw button {
            display: none !important;
}
</style>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $selectedPacket = $_POST['packet_id'];
    $selectedStrip=$_POST['strip_id'];
   
}
?>
<div class="card"> 
    <div class="card-body">
        <div class="container my-5">
            <form method="POST" onsubmit="return validateAllRequiredFields()">
                <div>
                    <h4 class="mb-3 text-white"><strong>Scan Details</strong></h4>
                </div>
               
                <div class="row">
                            <div class="col-sm-12 col-lg-4">
                                    <div class="form-group row">
                                   
                                        <div class="col-sm-12">
                                        <div class="input-group">
    <input type="text" class="form-control" placeholder="Encrypted QR Value"  id="qrcode" name="qrcode">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
    </div>
    </div>                
                    </div>                                                
                </div>
               
            </div> 
            <div class="col-sm-12 col-lg-4">
                                    <div class="form-group row">
                                   
                                        <div class="col-sm-12">
                                        <div class="input-group">
    <input type="text" class="form-control" placeholder="Decrypted QR Value"  id="qrcode1" name="qrcode1" >
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
    </div>
</div>       


                    </div>                                                
                </div>
               
            </div> 
            
            <div class="col-sm-12 col-lg-1">
                                    <div class="form-group row">
                                    
                                        <div class="col-sm-12">
                                       
                                       <span>OR</span>
                  

                    </div>                                                
                </div>
               
            </div> 
            <div class="col-sm-12 col-lg-4">
    <div class="form-group row">
        <div class="col-sm-12">
        <select class="form-control required-field selectpicker" id="packet_id" name="packet_id" >
            <option value="">Select Package type</option>
            <option value="Carton" <?php if(isset($selectedPacket) && $selectedPacket == 'Carton') echo 'selected'; ?>>Carton</option>
            <option value="Packet" <?php if(isset($selectedPacket) && $selectedPacket == 'Packet') echo 'selected'; ?>>Packet</option>
            <option value="Strip" <?php if(isset($selectedPacket) && $selectedPacket == 'Strip') echo 'selected'; ?>>Strip</option>
        </select>
            <span class="error-message"></span>
        </div>
    </div>
</div>

<div class="col-sm-12 col-lg-4">
    <div class="form-group row">
        <div class="col-sm-12">
            <select class="form-control required-field selectpicker" id="strip_id" name="strip_id" >
                        <option>Select Package ID</option>
                        </select>
        </div>
    </div>
</div>
<div class="card-body col-sm-12 col-lg-12">
    <div class="form-group mb-0 d-flex justify-content-between align-items-center">
     <!-- <button type="submit" class="btn btn-danger waves-effect waves-light">Cancel</button>  -->
        <button type="submit" class="btn btn-success waves-effect waves-light" name="submit" id="submit" onclick="validateAllRequiredFields()">View Timeline</button>
        
    </div>
 </div>
</form>
 

         

<?php
session_start(); 
$RoleUniqueID = ""; 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
 
    $selectedPacket = $_POST['packet_id'];
    $selectedStrip = $_POST['strip_id'];
    $search = isset($_POST['qrcode1']) ? $_POST['qrcode1'] : "";
    $strip_id = isset($_POST['strip_id']) ? $_POST['strip_id'] : "";

    
    require_once("include/connection.php");
    if(isset($_SESSION['fdRoleUniqueID'])) {
        $RoleUniqueID = $_SESSION['fdRoleUniqueID'];
    } else {
       
        $RoleUniqueID = "Unknown";
    }
   
    
    // Execute the query to get the $manufacturerID
 
    
        // Construct the main query with QR code search and manufacturer ID filter
        $sql = "";
    if (!empty($search)) {
       
        $sql = "SELECT 'Carton' AS package_type, fdCartonID AS package_id, fdMedicineID FROM tbCarton WHERE fdQRCode = '$search'  ";
        $sql .= " UNION ALL ";
        $sql .= "SELECT 'Packet' AS package_type, fdPacketID AS package_id, fdMedicineID FROM tbPacket WHERE fdQRCode = '$search'";
        $sql .= " UNION ALL ";
        $sql .= "SELECT 'Strip' AS package_type, fdStripID AS package_id, fdMedicineID FROM tbMedicineStripTest WHERE fdQRCode = '$search' ";
  
    } elseif (!empty($strip_id)) {
   
        switch ($selectedPacket) {
            case "Carton":
            $sql = "SELECT 'Carton' AS package_type, fdCartonID AS package_id, fdMedicineID FROM tbCarton WHERE fdCartonID = '$strip_id' LIMIT 1";
                break;
            case "Packet":
                $sql = "SELECT 'Packet' AS package_type, fdPacketID AS package_id, fdMedicineID FROM tbPacket WHERE fdPacketID = '$strip_id' LIMIT 1";
                break;
            case "Strip":
                $sql = "SELECT 'Strip' AS package_type, fdStripID AS package_id, fdMedicineID FROM tbMedicineStripTest WHERE fdStripID = '$strip_id' LIMIT 1";
                break;
            default:
                echo "Invalid package type";
        }
        
    
}    
        $result = mysqli_query($conn, $sql);    
        if ($result && mysqli_num_rows($result) > 0) {
          
                    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered display">
                            <thead style="background: #1e88e566;color: white;">
                                <tr style="white-space: nowrap;">
                      
                                    <th>Medicine ID</th>
                                    <th>Manufacture ID</th>
                                    <th>Package Type</th>
                                    <th>Package ID</th>   
                                    <!-- <th>Carton ID</th>    -->
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               while ($rows = mysqli_fetch_assoc($result)) {
                                $packageType = $rows['package_type'];
                                $packageID = $rows['package_id'];
                                $medicineID = $rows['fdMedicineID'];
                
                                    // table data
                                    ?><tr>
                                    
                                    <td><?php echo $medicineID; ?></td>
                                    <td><?php echo $RoleUniqueID; ?></td>
                                    
                                    <td><?php echo $packageType; ?></td>
                                                    <td><?php 
                                                        // Determine which ID to display based on package type
                                                        switch ($packageType) {
                                                            case "Carton":
                                                                echo $packageID;
                                                                break;
                                                            case "Packet":
                                                                echo $packageID;
                                                                break;
                                                            case "Strip":
                                                                echo $packageID;
                                                                break;
                                                            default:
                                                                echo "Unknown";
                                                        }
                                                    // }
                                                        ?>
                                    </td>
                               </tr>
                               <?php  
                              }
                             ?>
                            </tbody>      
                                                 
                        </table>
                        </div>      
    </div>
  </div>
</div>
            </div> 
                    
                           
   
  </div>
</div>

                            </div>
                          

                        <!-- </div> -->
                        <?php
                      
 $sqlScanLog = "SELECT * FROM tbScanlog WHERE (fdStripID = ? OR fdCartonID = ? OR fdPacketID = ?) AND fdTrxnType IN ('MNFRIN', 'MNFROUT', 'STKSIN', 'STKSOUT', 'DSTRIN', 'DSTROUT', 'DELRIN', 'DELROUT','RTLRIN','RTLROUT') GROUP BY fdTrxnType ORDER BY fdScanDate";

 $stmtScanLog = mysqli_prepare($conn, $sqlScanLog);
 if ($stmtScanLog) {
     mysqli_stmt_bind_param($stmtScanLog, "sss", $packageID, $packageID, $packageID);
     mysqli_stmt_execute($stmtScanLog);
     $resultScanLog = mysqli_stmt_get_result($stmtScanLog);
 
     if ($resultScanLog && mysqli_num_rows($resultScanLog) > 0) {
         while ($scanLogData = mysqli_fetch_assoc($resultScanLog)) {
             $medicineId = $scanLogData['fdMedicineID'];
             $sqlMedicine = "SELECT fdMedicineName FROM tbMedicineMaster WHERE fdMedicineID=?";
             $stmtMedicine = mysqli_prepare($conn, $sqlMedicine);
 
             if ($stmtMedicine) {
                 mysqli_stmt_bind_param($stmtMedicine, "s", $medicineId);
                 mysqli_stmt_execute($stmtMedicine);
                 $resultMedicine = mysqli_stmt_get_result($stmtMedicine);
                 
                 if ($resultMedicine && mysqli_num_rows($resultMedicine) > 0) {
                     $medicineData = mysqli_fetch_assoc($resultMedicine);
                     $medicineName = $medicineData['fdMedicineName'];
                 }
                     $countsData = array();
                     if ($packageType === 'Carton') {
                        $sqlCounts = "SELECT 
                        COUNT(DISTINCT fdPacketID) AS packetCount,
                        COUNT(DISTINCT fdStripID) AS stripCount 
                  FROM tbMedicineStripTest 
                  WHERE fdCartonID = '$packageID'";
                  $stmtCounts = mysqli_prepare($conn, $sqlCounts);
                  if ($stmtCounts) {
                      mysqli_stmt_execute($stmtCounts);
                      $resultCounts = mysqli_stmt_get_result($stmtCounts);
                      if ($resultCounts && mysqli_num_rows($resultCounts) > 0) {
                          $countsData = mysqli_fetch_assoc($resultCounts);
                          $packetCount = $countsData['packetCount'];
                          $stripCount = $countsData['stripCount'];
                      }
                      }
                      
                    } elseif ($packageType === 'Packet') {
                        $sqlScanLog = "SELECT s.fdPacketID  AS s.fdTrxnOwner, s.fdMedicineID, s.fdScanDate
                                       FROM tbScanlog s
                                       WHERE s.fdPacketID = '$packageID' 
                                       AND s.fdTrxnType IN ('MNFRIN', 'MNFROUT', 'STKSIN', 'STKSOUT', 'DSTRIN', 'DSTROUT', 'DELRIN', 'DELROUT','RTLRIN','RTLROUT') 
                                       GROUP BY s.fdPacketID";
                                        $sqlCounts = "SELECT 
                                      
                                        COUNT(DISTINCT fdStripID) AS stripCount 
                                  FROM tbScanlog 
                                  WHERE fdPacketID = '$packageID'";
                                      $stmtCounts = mysqli_prepare($conn, $sqlCounts);
                                      if ($stmtCounts) {
                                          mysqli_stmt_execute($stmtCounts);
                                          $resultCounts = mysqli_stmt_get_result($stmtCounts);
                                          if ($resultCounts && mysqli_num_rows($resultCounts) > 0) {
                                              $countsData = mysqli_fetch_assoc($resultCounts);
                                             
                                              $stripCount = $countsData['stripCount'];
                                          }
                                          }
                 } 
                // }

                
                            switch ($scanLogData['fdTrxnType']) {
                                case 'MNFRIN':
                                   
                                  ?>
                         
                         <div class="container1">
        <div id="timeline">
            <div class="timeline-item">
                <div class="timeline-icon" style="background: #0b4549;">
                    <i class="fa fa-sign-in" style="font-size: 26px;position: relative; top: 14px; left: 14px;"></i>
                </div>
                <div class="timeline-content">
                    <?php if ($packageType === 'Carton') { ?>
                        <h2 style="background:#0b4549;">MANUFACTURER <span class="scanin">Scan In</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Manufacture ID:</th>
                                        <td><?php echo $scanLogData['fdTrxnOwner']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Carton ID:</th>
                                        <td><?php echo $scanLogData['fdCartonID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No.of Packets:</th>
                                        <td><?php echo $countsData['packetCount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                    <?php } elseif ($packageType === 'Packet') { ?>
                        <h2 style="background:#0b4549;">MANUFACTURER <span class="scanin">Scan In</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Packet ID:</th>
                                        <td><?php echo $scanLogData['fdPacketID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                                    <?php } elseif ($packageType === 'Strip') { ?>
                        <h2 style="background:#0b4549;">MANUFACTURER <span class="scanin">Scan In</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Strip ID:</th>
                                        <td><?php echo $scanLogData['fdStripID']; ?></td>
                                    </tr>
                                    
                    <?php } ?>
             
                    <tr>
                        <th>Medicine ID:</th>
                        <td><?php echo $scanLogData['fdMedicineID']; ?></td>
                    </tr>
                    <tr>
                        <th>Medicine Name:</th>
                        <td>
        <?php echo isset($medicineName) ? $medicineName : ''; ?>
    </td>
                    </tr>
                    <tr>
                        <th>Scan Date:</th>
                        <td><?php echo $scanLogData['fdScanDate']; ?></td>
                    </tr>
                </thead>
                </table>
            
               <?php
               
  $link = "?timeline";
 

  if (isset($scanLogData['fdStripID'])) {
    $link .= "&fdStripID=" . $scanLogData['fdStripID'];
}
if (isset($scanLogData['fdCartonID'])) {
    $link .= "&fdCartonID=" . $scanLogData['fdCartonID'];
}
if (isset($scanLogData['fdPacketID'])) {
    $link .= "&fdPacketID=" . $scanLogData['fdPacketID'];
}

?>
<a class="read-more" href="<?php echo $link; ?>" data-toggle="modal" data-target="#exampleModalCenter">View Location on Map ></a>



            </div>
        </div>
    </div>

<?php
                break;

            case 'MNFROUT':
                ?>

                                  
    <div class="timeline-item">
        
    <div class="timeline-icon" style="background:#07344f;">
    <i class="fa fa-sign-out" style="font-size: 26px;position: relative; top: 14px; left: 14px;"></i>
    </div>
    <div class="timeline-content right">
    <?php if ($packageType === 'Carton') { ?>
      <h2 style="background: #07344f;">MANUFACTURER<span class="scanin">Scan Out</span></h2>
      <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                    <table id="zero_config">
                        <thead style="white-space: nowrap;">
                        <tr>
                                        <th>Manufacture ID:</th>
                                        <td><?php echo $scanLogData['fdTrxnOwner']; ?></td>
                                    </tr>
                        <tr>
                                        <th>Carton ID:</th>
                                        <td><?php echo $scanLogData['fdCartonID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No.of Packets:</th>
                                        <td><?php echo $countsData['packetCount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                    <?php } elseif ($packageType === 'Packet') { ?>
                        <h2 style="background: #07344f;">MANUFACTURER <span class="scanin">Scan Out</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Packet ID:</th>
                                        <td><?php echo $scanLogData['fdPacketID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                                    <?php } elseif ($packageType === 'Strip') { ?>
                        <h2 style="background: #07344f;">MANUFACTURER <span class="scanin">Scan Out</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Strip ID:</th>
                                        <td><?php echo $scanLogData['fdStripID']; ?></td>
                                    </tr>
                                    
                    <?php } ?>
                                <tr>
                                    <th>Medicine ID:</th>
                                    <td><?php echo $scanLogData['fdMedicineID']; ?></td>
                                </tr>
                                <tr>
                                    <th>Medicine Name:</th>
                                       <td>
        <?php echo isset($medicineName) ? $medicineName : ''; ?>
    </td>                                </tr>
                                <tr>
                                    <th>Scan Date:</th>
                                    <td><?php echo $scanLogData['fdScanDate']; ?></td>
                                </tr>
                        </thead>
                        
            </table>
            <?php
    $link = "?timeline";
    
    if (isset($scanLogData['fdStripID'])) {
        $link .= "&fdStripID=" . $scanLogData['fdStripID'];
    }
    if (isset($scanLogData['fdCartonID'])) {
        $link .= "&fdCartonID=" . $scanLogData['fdCartonID'];
    }
    if (isset($scanLogData['fdPacketID'])) {
        $link .= "&fdPacketID=" . $scanLogData['fdPacketID'];
    }
?>
<a class="read-more" href="<?php echo $link; ?>" data-toggle="modal" data-target="#exampleModalCenter">View Location on Map ></a>

    </div>
  
  </div>                                               
</div>
</div>

  <?php
                                    break;
                                case 'STKSIN':
                                    ?>
               <div id="timeline">

    <div class="timeline-item">
    <div class="timeline-icon" style="background: #0b4549;">
      <i class="fa fa-sign-in" style="font-size: 26px;position: relative; top: 14px; left: 14px;"></i>

      </div>
      <div class="timeline-content">
      <?php if ($packageType === 'Carton') { ?>
      <h2 style="background:#0b4549;">STOCKIST<span class="scanin">Scan In</span></h2>
      <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
        <table id="zero_config">
            <thead style="white-space: nowrap;">
            <tr>
                            <th>Stockist ID:</th>
                            <td><?php echo $scanLogData['fdTrxnOwner']; ?></td>
                        </tr>
            <tr>
                            <th>Carton ID:</th>
                            <td><?php echo $scanLogData['fdCartonID']; ?></td>
                        </tr>
                      
                        <tr>
                                        <th>No.of Packets:</th>
                                        <td><?php echo $countsData['packetCount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                            <?php } elseif ($packageType === 'Packet') { ?>
                        <h2 style="background:#0b4549;">STOCKIST <span class="scanin">Scan In</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Packet ID:</th>
                                        <td><?php echo $scanLogData['fdPacketID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                                    <?php } elseif ($packageType === 'Strip') { ?>
                        <h2 style="background:#0b4549;">STOCKIST <span class="scanin">Scan In</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Strip ID:</th>
                                        <td><?php echo $scanLogData['fdStripID']; ?></td>
                                    </tr>
                                    
                    <?php } ?>
                                    <tr>
                                        <th>Medicine ID:</th>
                                        <td><?php echo $scanLogData['fdMedicineID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Medicine Name:</th>
                                           <td>
        <?php echo isset($medicineName) ? $medicineName : ''; ?>
    </td>
                                    </tr>
                                    <tr>
                                        <th>Scan Date:</th>
                                        <td><?php echo $scanLogData['fdScanDate']; ?></td>
                                    </tr>
                        </thead>
            </table>
            <?php
    $link = "?timeline";
    if (isset($scanLogData['fdStripID'])) {
        $link .= "&fdStripID=" . $scanLogData['fdStripID'];
    }
    if (isset($scanLogData['fdCartonID'])) {
        $link .= "&fdCartonID=" . $scanLogData['fdCartonID'];
    }
    if (isset($scanLogData['fdPacketID'])) {
        $link .= "&fdPacketID=" . $scanLogData['fdPacketID'];
    }
?>
<a class="read-more" href="<?php echo $link; ?>" data-toggle="modal" data-target="#exampleModalCenter">View Location on Map ></a>


      </div>
      </div>
    </div>
    <?php
                                    break;
                                case 'STKSOUT':
                                   
                                    ?>
<div class="timeline-item">
        
        <div class="timeline-icon" style="background:#07344f;">
          <i class="fa fa-sign-out" style="font-size: 26px;position: relative; top: 14px; left: 14px;"></i>
          </div>
          <div class="timeline-content right">
          <?php if ($packageType === 'Carton') { ?>
          <h2 style="background: #07344f;">STOCKIST<span class="scanin">Scan Out</span></h2>
          <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
        <table id="zero_config">
            <thead style="white-space: nowrap;">
            <tr>
                        <th>Stockist ID:</th>
                        <td><?php echo $scanLogData['fdTrxnOwner']; ?></td>
                    </tr>
            <tr>
                        <th>Carton ID:</th>
                        <td><?php echo $scanLogData['fdCartonID']; ?></td>
                    </tr>
                    <tr>
                                        <th>No.of Packets:</th>
                                        <td><?php echo $countsData['packetCount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                            <?php } elseif ($packageType === 'Packet') { ?>
                        <h2 style="background: #07344f;">STOCKIST <span class="scanin">Scan Out</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Packet ID:</th>
                                        <td><?php echo $scanLogData['fdPacketID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                                    <?php } elseif ($packageType === 'Strip') { ?>
                        <h2 style="background: #07344f;">STOCKIST <span class="scanin">Scan Out</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Strip ID:</th>
                                        <td><?php echo $scanLogData['fdStripID']; ?></td>
                                    </tr>
                                    
                    <?php } ?>
                                        <tr>
                                            <th>Medicine ID:</th>
                                            <td><?php echo $scanLogData['fdMedicineID']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Medicine Name:</th>
                                               <td>
        <?php echo isset($medicineName) ? $medicineName : ''; ?>
    </td>
                                        </tr>
                                        <tr>
                                            <th>Scan Date:</th>
                                            <td><?php echo $scanLogData['fdScanDate']; ?></td>
                                        </tr>
                                </thead>
                    </table>
                    <?php
    $link = "?timeline";
    if (isset($scanLogData['fdStripID'])) {
        $link .= "&fdStripID=" . $scanLogData['fdStripID'];
    }
    if (isset($scanLogData['fdCartonID'])) {
        $link .= "&fdCartonID=" . $scanLogData['fdCartonID'];
    }
    if (isset($scanLogData['fdPacketID'])) {
        $link .= "&fdPacketID=" . $scanLogData['fdPacketID'];
    }
?>
<a class="read-more" href="<?php echo $link; ?>" data-toggle="modal" data-target="#exampleModalCenter">View Location on Map ></a>

          </div>
          </div>
        </div>        </div>

        <?php
                                    break;
                                case 'DSTRIN':
                                    // Display both Manufacturer "Scan In" and "Scan Out" cards
                                    ?> 
                                    <div id="timeline">

                                    <div class="timeline-item">
    <div class="timeline-icon" style="background: #0b4549;">
      <i class="fa fa-sign-in" style="font-size: 26px;position: relative; top: 14px; left: 14px;"></i>

      </div>
      <div class="timeline-content">
      <?php if ($packageType === 'Carton') { ?>
      <h2 style="background:#0b4549;">DISTRIBUTOR<span class="scanin">Scan In</span></h2>
      <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
        <table id="zero_config">
            <thead style="white-space: nowrap;">
            <tr>
                            <th>Distributor ID:</th>
                            <td><?php echo $scanLogData['fdTrxnOwner']; ?></td>
                        </tr>
            <tr>
                            <th>Carton ID:</th>
                            <td><?php echo $scanLogData['fdCartonID']; ?></td>
                        </tr>
                        <tr>
                                        <th>No.of Packets:</th>
                                        <td><?php echo $countsData['packetCount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                            <?php } elseif ($packageType === 'Packet') { ?>
                        <h2 style="background:#0b4549;">DISTRIBUTOR <span class="scanin">Scan In</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Packet ID:</th>
                                        <td><?php echo $scanLogData['fdPacketID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                                    <?php } elseif ($packageType === 'Strip') { ?>
                        <h2 style="background:#0b4549;">DISTRIBUTOR <span class="scanin">Scan In</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Strip ID:</th>
                                        <td><?php echo $scanLogData['fdStripID']; ?></td>
                                    </tr>
                                    
                    <?php } ?>
                            <tr>
                                <th>Medicine ID:</th>
                                <td><?php echo $scanLogData['fdMedicineID']; ?></td>
                            </tr>
                            <tr>
                                <th>Medicine Name:</th>
                                   <td>
        <?php echo isset($medicineName) ? $medicineName : ''; ?>
    </td>
                            </tr>
                            <tr>
                                <th>Scan Date:</th>
                                <td><?php echo $scanLogData['fdScanDate']; ?></td>
                            </tr>
                </thead>
    </table>
    <?php
    $link = "?timeline";
    if (isset($scanLogData['fdStripID'])) {
        $link .= "&fdStripID=" . $scanLogData['fdStripID'];
    }
    if (isset($scanLogData['fdCartonID'])) {
        $link .= "&fdCartonID=" . $scanLogData['fdCartonID'];
    }
    if (isset($scanLogData['fdPacketID'])) {
        $link .= "&fdPacketID=" . $scanLogData['fdPacketID'];
    }
?>
<a class="read-more" href="<?php echo $link; ?>" data-toggle="modal" data-target="#exampleModalCenter">View Location on Map ></a>


      </div>
      </div>
    </div>   
    <?php
                                    break;
                                case 'DSTROUT':
                                    // Display both Manufacturer "Scan In" and "Scan Out" cards
                                    ?>  
                                      <div class="timeline-item">
        
        <div class="timeline-icon" style="background:#07344f;">
          <i class="fa fa-sign-out" style="font-size: 26px;position: relative; top: 14px; left: 14px;"></i>
          </div>
          <div class="timeline-content right">
          <?php if ($packageType === 'Carton') { ?>
          <h2 style="background: #07344f;">DISTRIBUTOR<span class="scanin">Scan Out</span></h2>
          <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
        <table id="zero_config">
            <thead style="white-space: nowrap;">
            <tr>
                        <th>Distributor ID:</th>
                        <td><?php echo $scanLogData['fdTrxnOwner']; ?></td>
                    </tr>
            <tr>
                        <th>Carton ID:</th>
                        <td><?php echo $scanLogData['fdCartonID']; ?></td>
                    </tr>
                    <tr>
                                        <th>No.of Packets:</th>
                                        <td><?php echo $countsData['packetCount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                            <?php } elseif ($packageType === 'Packet') { ?>
                        <h2 style="background: #07344f;">DISTRIBUTOR <span class="scanin">Scan Out</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Packet ID:</th>
                                        <td><?php echo $scanLogData['fdPacketID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                                    <?php } elseif ($packageType === 'Strip') { ?>
                        <h2 style="background: #07344f;">DISTRIBUTOR <span class="scanin">Scan Out</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Strip ID:</th>
                                        <td><?php echo $scanLogData['fdStripID']; ?></td>
                                    </tr>
                                    
                    <?php } ?>
                                <tr>
                                    <th>Medicine ID:</th>
                                    <td><?php echo $scanLogData['fdMedicineID']; ?></td>
                                </tr>
                                <tr>
                                    <th>Medicine Name:</th>
                                    <td>
        <?php echo isset($medicineName) ? $medicineName : ''; ?>
    </td>
                                </tr>
                                <tr>
                                    <th>Scan Date:</th>
                                    <td><?php echo $scanLogData['fdScanDate']; ?></td>
                                </tr>
                        </thead>
            </table>
            <?php
    $link = "?timeline";
    if (isset($scanLogData['fdStripID'])) {
        $link .= "&fdStripID=" . $scanLogData['fdStripID'];
    }
    if (isset($scanLogData['fdCartonID'])) {
        $link .= "&fdCartonID=" . $scanLogData['fdCartonID'];
    }
    if (isset($scanLogData['fdPacketID'])) {
        $link .= "&fdPacketID=" . $scanLogData['fdPacketID'];
    }
?>
<a class="read-more" href="<?php echo $link; ?>" data-toggle="modal" data-target="#exampleModalCenter">View Location on Map ></a>

          </div>
          </div>
        </div></div>
        <?php
                                    break;
                                case 'DELRIN':
                                 
                                    ?>                                      
                                    <div id="timeline">

                                       <div class="timeline-item">
    <div class="timeline-icon" style="background: #0b4549;">
      <i class="fa fa-sign-in" style="font-size: 26px;position: relative; top: 14px; left: 14px;"></i>

      </div>
      <div class="timeline-content">
      <?php if ($packageType === 'Carton') { ?>
      <h2 style="background:#0b4549;">DEALER<span class="scanin">Scan In</span></h2>
      <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
        <table id="zero_config">
            <thead style="white-space: nowrap;">
            <tr>
                            <th>Dealer ID:</th>
                            <td><?php echo $scanLogData['fdTrxnOwner']; ?></td>
                        </tr>
            <tr>
                            <th>Carton ID:</th>
                            <td><?php echo $scanLogData['fdCartonID']; ?></td>
                        </tr>
                        <tr>
                                        <th>No.of Packets:</th>
                                        <td><?php echo $countsData['packetCount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                            <?php } elseif ($packageType === 'Packet') { ?>
                        <h2 style="background:#0b4549;">DEALER <span class="scanin">Scan In</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Packet ID:</th>
                                        <td><?php echo $scanLogData['fdPacketID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                                    <?php } elseif ($packageType === 'Strip') { ?>
                        <h2 style="background:#0b4549;">DEALER <span class="scanin">Scan In</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Strip ID:</th>
                                        <td><?php echo $scanLogData['fdStripID']; ?></td>
                                    </tr>
                                    
                    <?php } ?>
                    <tr>
                        <th>Medicine ID:</th>
                        <td><?php echo $scanLogData['fdMedicineID']; ?></td>
                    </tr>
                    <tr>
                        <th>Medicine Name:</th>
                        <td>
        <?php echo isset($medicineName) ? $medicineName : ''; ?>
    </td>
                    </tr>
                    <tr>
                        <th>Scan Date:</th>
                        <td><?php echo $scanLogData['fdScanDate']; ?></td>
                    </tr>
        </thead>
</table>
<?php
    $link = "?timeline";
    if (isset($scanLogData['fdStripID'])) {
        $link .= "&fdStripID=" . $scanLogData['fdStripID'];
    }
    if (isset($scanLogData['fdCartonID'])) {
        $link .= "&fdCartonID=" . $scanLogData['fdCartonID'];
    }
    if (isset($scanLogData['fdPacketID'])) {
        $link .= "&fdPacketID=" . $scanLogData['fdPacketID'];
    }
?>
<a class="read-more" href="<?php echo $link; ?>" data-toggle="modal" data-target="#exampleModalCenter">View Location on Map ></a>


      </div>
      </div>
    </div>
    <?php
                                    break;
                                case 'DELROUT':
                                    // Display both Manufacturer "Scan In" and "Scan Out" cards
                                    ?>
                                    <div class="timeline-item">
    <div class="timeline-icon" style="background:#07344f;">
      
      <i class="fa fa-sign-out" style="font-size: 26px;position: relative; top: 14px; left: 14px;"></i>
      </div>
      <div class="timeline-content right">
      <?php if ($packageType === 'Carton') { ?>
      <h2 style="background: #07344f;">DEALER<span class="scanin">Scan Out</span></h2>
      <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
        <table id="zero_config">
            <thead style="white-space: nowrap;">
            <tr>
                            <th>Dealer ID:</th>
                            <td><?php echo $scanLogData['fdTrxnOwner']; ?></td>
                        </tr>
            <tr>
                            <th>Carton ID:</th>
                            <td><?php echo $scanLogData['fdCartonID']; ?></td>
                        </tr>
                        <tr>
                                        <th>No.of Packets:</th>
                                        <td><?php echo $countsData['packetCount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                            <?php } elseif ($packageType === 'Packet') { ?>
                        <h2 style="background: #07344f;">DEALER <span class="scanin">Scan Out</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Packet ID:</th>
                                        <td><?php echo $scanLogData['fdPacketID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                                    <?php } elseif ($packageType === 'Strip') { ?>
                        <h2 style="background: #07344f;">DEALER <span class="scanin">Scan Out</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Strip ID:</th>
                                        <td><?php echo $scanLogData['fdStripID']; ?></td>
                                    </tr>
                                    
                    <?php } ?>
                        <tr>
                            <th>Medicine ID:</th>
                            <td><?php echo $scanLogData['fdMedicineID']; ?></td>
                        </tr>
                        <tr>
                            <th>Medicine Name:</th>
                            <td><?php echo isset($medicineName) ? $medicineName : ''; ?></td>
                        </tr>
                        <tr>
                            <th>Scan Date:</th>
                            <td><?php echo $scanLogData['fdScanDate']; ?></td>
                        </tr>
            </thead>
</table>
<?php
    $link = "?timeline";
    if (isset($scanLogData['fdStripID'])) {
        $link .= "&fdStripID=" . $scanLogData['fdStripID'];
    }
    if (isset($scanLogData['fdCartonID'])) {
        $link .= "&fdCartonID=" . $scanLogData['fdCartonID'];
    }
    if (isset($scanLogData['fdPacketID'])) {
        $link .= "&fdPacketID=" . $scanLogData['fdPacketID'];
    }
?>
<a class="read-more" href="<?php echo $link; ?>" data-toggle="modal" data-target="#exampleModalCenter">View Location on Map ></a>

      </div>
      </div>
    </div></div>

    <?php
                                    break;
                                case 'RTLRIN':
                                    // Display both Manufacturer "Scan In" and "Scan Out" cards
                                    ?>
                                    <div id="timeline">
                                    <div class="timeline-item">
    <div class="timeline-icon" style="background: #0b4549;">
      <i class="fa fa-sign-in" style="font-size: 26px;position: relative; top: 14px; left: 14px;"></i>

      </div>
      <div class="timeline-content">
      <?php if ($packageType === 'Carton') { ?>
      <h2 style="background:#0b4549;">RETAILER<span class="scanin">Scan In</span></h2>
      <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
    <table id="zero_config">
        <thead style="white-space: nowrap;">
        <tr>
                        <th>Retailer ID:</th>
                        <td><?php echo $scanLogData['fdTrxnOwner']; ?></td>
                    </tr>
        <tr>
                        <th>Carton ID:</th>
                        <td><?php echo $scanLogData['fdCartonID']; ?></td>
                    </tr>
                    <tr>
                                        <th>No.of Packets:</th>
                                        <td><?php echo $countsData['packetCount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                            <?php } elseif ($packageType === 'Packet') { ?>
                        <h2 style="background:#0b4549;">RETAILER <span class="scanin">Scan In</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Packet ID:</th>
                                        <td><?php echo $scanLogData['fdPacketID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                                    <?php } elseif ($packageType === 'Strip') { ?>
                        <h2 style="background:#0b4549;">RETAILER <span class="scanin">Scan In</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Strip ID:</th>
                                        <td><?php echo $scanLogData['fdStripID']; ?></td>
                                    </tr>
                                    
                    <?php } ?>
                            <tr>
                                <th>Medicine ID:</th>
                                <td><?php echo $scanLogData['fdMedicineID']; ?></td>
                            </tr>
                            <tr>
                                <th>Medicine Name:</th>
                                <td><?php echo isset($medicineName) ? $medicineName : ''; ?></td>
                            </tr>
                            <tr>
                                <th>Scan Date:</th>
                                <td><?php echo $scanLogData['fdScanDate']; ?></td>
                            </tr>
                </thead>
    </table>
    <?php
    $link = "?timeline";
    if (isset($scanLogData['fdStripID'])) {
        $link .= "&fdStripID=" . $scanLogData['fdStripID'];
    }
    if (isset($scanLogData['fdCartonID'])) {
        $link .= "&fdCartonID=" . $scanLogData['fdCartonID'];
    }
    if (isset($scanLogData['fdPacketID'])) {
        $link .= "&fdPacketID=" . $scanLogData['fdPacketID'];
    }
?>
<a class="read-more" href="<?php echo $link; ?>" data-toggle="modal" data-target="#exampleModalCenter">View Location on Map ></a>

      </div>
      </div>
    </div>
    <?php
                                    break;
                                case 'RTLROUT':
                                    // Display both Manufacturer "Scan In" and "Scan Out" cards
                                    ?>
                                     <div class="timeline-item">
    <div class="timeline-icon" style="background:#07344f;">
      <i class="fa fa-sign-out" style="font-size: 26px;position: relative; top: 14px; left: 14px;"></i>
      </div>
      <div class="timeline-content right">
      <?php if ($packageType === 'Carton') { ?>
      <h2 style="background: #07344f;">RETAILER<span class="scanin">Scan Out</span></h2>
      <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
        <table id="zero_config">
            <thead style="white-space: nowrap;">
            <tr>
                            <th>Retailer ID:</th>
                            <td><?php echo $scanLogData['fdTrxnOwner']; ?></td>
                        </tr>
            <tr>
                            <th>Carton ID:</th>
                            <td><?php echo $scanLogData['fdCartonID']; ?></td>
                        </tr>
                        <tr>
                                        <th>No.of Packets:</th>
                                        <td><?php echo $countsData['packetCount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                            <?php } elseif ($packageType === 'Packet') { ?>
                        <h2 style="background: #07344f;">RETAILER <span class="scanin">Scan Out</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Packet ID:</th>
                                        <td><?php echo $scanLogData['fdPacketID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. of Strips:</th>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    </tr>
                                    <?php } elseif ($packageType === 'Strip') { ?>
                        <h2 style="background: #07344f;">RETAILER <span class="scanin">Scan Out</span></h2>
                        <div class="table-responsive scroll-sidebar  col-md-12 col-sm-12">
                            <table id="zero_config">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th>Strip ID:</th>
                                        <td><?php echo $scanLogData['fdStripID']; ?></td>
                                    </tr>
                                    
                    <?php } ?>
                            <tr>
                                <th>Medicine ID:</th>
                                <td><?php echo $scanLogData['fdMedicineID']; ?></td>
                            </tr>
                            <tr>
                                <th>Medicine Name:</th>
                                <td><?php echo isset($medicineName) ? $medicineName : ''; ?></td>
                            </tr>
                            <tr>
                                <th>Scan Date:</th>
                                <td><?php echo $scanLogData['fdScanDate']; ?></td>
                            </tr>
                </thead>
    </table>
    <?php
    $link = "?timeline";
    if (isset($scanLogData['fdStripID'])) {
        $link .= "&fdStripID=" . $scanLogData['fdStripID'];
    }
    if (isset($scanLogData['fdCartonID'])) {
        $link .= "&fdCartonID=" . $scanLogData['fdCartonID'];
    }
    if (isset($scanLogData['fdPacketID'])) {
        $link .= "&fdPacketID=" . $scanLogData['fdPacketID'];
    }
?>
<a class="read-more" href="<?php echo $link; ?>" data-toggle="modal" data-target="#exampleModalCenter">View Location on Map ></a>


      </div>
      </div>
    </div>
      
      </div>                          
    
  <?php
                        //    }
                         }
                    }
                }
            }
        }   
        // }      ?>
                

                       
        </div>
      </div>
    </div>
<!-- Button trigger modal -->
<?php
// Start the session
session_start();

function get_locations_by_id_and_type($id, $type) {
    require("include/connection.php");

    $query = "";

    // Construct the SQL query based on the chosen ID type
    switch ($type) {
  
        case 'Carton':
              $query = "SELECT fdScanLat, fdScanLong, fdTrxnType, fdCreatedOn, fdTrxnOwner FROM tbScanlog WHERE fdCartonID = ?";
              $medicineQuery = "SELECT tbMedicineMaster.fdMedicineID, tbMedicineMaster.fdMedicineName 
                              FROM tbCarton 
                              JOIN tbMedicineMaster ON tbCarton.fdMedicineID = tbMedicineMaster.fdMedicineID 
                              WHERE tbCarton.fdCartonID = ?";
            break;
        case 'Packet':
            $query = "SELECT fdScanLat, fdScanLong, fdTrxnType, fdCreatedOn,fdTrxnOwner FROM tbScanlog WHERE fdPacketID = ?";
            $medicineQuery = "SELECT tbMedicineMaster.fdMedicineID, tbMedicineMaster.fdMedicineName 
                              FROM tbPacket 
                              JOIN tbMedicineMaster ON tbPacket.fdMedicineID = tbMedicineMaster.fdMedicineID 
                              WHERE tbPacket.fdPacketID=?";
            break;
        case 'Strip':
            $query = "SELECT fdScanLat, fdScanLong, fdTrxnType, fdCreatedOn,fdTrxnOwner FROM tbScanlog WHERE fdStripID = ?";
            $medicineQuery = "SELECT tbMedicineMaster.fdMedicineID, tbMedicineMaster.fdMedicineName 
                              FROM tbMedicineStripTest 
                              JOIN tbMedicineMaster ON tbMedicineStripTest.fdMedicineID = tbMedicineMaster.fdMedicineID 
                              WHERE tbMedicineStripTest.fdStripID = ?";
            break;
        default:
            // Handle invalid type
            break;
    }
    

    // Prepare and execute the SQL query
    if ($query !== "" && $medicineQuery !== "") {
        // Fetching locations
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $locations = [];
            while ($row = mysqli_fetch_assoc($result)) {
                // Only include locations with valid latitude and longitude
                if (!empty($row['fdScanLat']) && !empty($row['fdScanLong'])) {
                    $locations[] = array(
                        'fdLat' => $row['fdScanLat'],
                        'fdLong' => $row['fdScanLong'],
                        'fdTrxnType' => $row['fdTrxnType'],
                        'fdCreatedOn' => $row['fdCreatedOn'],
                        'fdTrxnOwner' => $row['fdTrxnOwner']
                    );
                }
            }
            mysqli_stmt_close($stmt);

            // Fetching medicine details
            $stmt = mysqli_prepare($conn, $medicineQuery);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $medicine = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

                return array('locations' => $locations, 'medicine' => $medicine);
            } else {
                // Error in preparing the statement
                die("Query Error: " . mysqli_error($conn));
            }
        } else {
            // Error in preparing the statement
            die("Query Error: " . mysqli_error($conn));
        }
    } else {
        // Invalid type
        return null;
    }
}
// $packageType = $_POST['package_type'];
// $packageID = $_POST['package_id'];
$search = $_POST['qrcode1'] ?? ''; 
$strip_id = $_POST['strip_id'] ?? ''; 
$packet_id = $_POST['packet_id'] ?? ''; 
                                                   
if (!empty($search)) {
  
  $id = $packageID; 
    $type = $packageType; 

} elseif (!empty($strip_id) && !empty($packet_id)) {
    // Handle the case when selecting by strip_id and packet_id
    $id = $strip_id; // Assuming $strip_id is used for ID
    $type = $packet_id; // Assuming 'Packet' type based on the selected IDs
} else {
    // No valid inputs provided
    $id = null;
    $type = null;
}

// Call the function if $id and $type are set
if (isset($id) && isset($type)) {
    $data = get_locations_by_id_and_type($id, $type);
    $locations = $data['locations'];
    $medicine = $data['medicine'];
}
?>



<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
      
  


<link href="dist/css/style.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

     <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDonb2ULBup0rFfk6C8CSbGx2rcR52vm2o&callback=initMap&libraries=places&v=weekly&channel=2"
      async defer
    ></script> 


    <link href="dist/css/style.min.css" rel="stylesheet">

                    <h4 class="card-title mb-0"><strong><i class="fas fa-map-marker-alt"></i> LOCATION</strong></h4><br>
                    <!-- Create a div element to hold the map -->
                    <div id="map"></div><br>
                    <div id="legend">
                    <div style="display: contents;"><span class="legend-marker" style="background-color: #e82020;"></span> Manufacturer</div>
                    <div style="display: contents;"><span class="legend-marker" style="background-color: #77f279;"></span> Stockist</div>
                    <div style="display: contents;"><span class="legend-marker" style="background-color: #9290e0;"></span> Distributor</div>
                    <div style="display: contents;"><span class="legend-marker" style="background-color: #f5f264;"></span> Dealer</div>
                    <div style="display: contents;"><span class="legend-marker" style="background-color: orange;"></span> Retailer</div>
                </div>
                

<script>
    var map;
   
    function initMap() {
        var packetLocations = <?php echo json_encode($locations); ?>;
        var medicine = <?php echo json_encode($medicine); ?>;
        console.log("Packet Locations: ", packetLocations); // Debugging line

        if (packetLocations.length === 0) {
            // No valid locations, set a default center
            var defaultLocation = {lat: 0, lng: 0};
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center: defaultLocation
            });
            return;
        }

        // Initialize map
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: {lat: parseFloat(packetLocations[0].fdLat), lng: parseFloat(packetLocations[0].fdLong)} // Center map on first location
        });

        // Create a LatLngBounds object
        var bounds = new google.maps.LatLngBounds();

        // Define marker properties based on transaction type
        function getMarkerProperties(trxnType) {
            var color = '';
            var markerLabel = '';
            var tooltipContent = '';

            switch(trxnType) {
                case 'MNFRIN':
                case 'MNFROUT':
                    color = '#e82020';
                    markerLabel = '\uf1ad'; // Unicode for Manufacturer icon
                    tooltipContent = 'Manufacturer';
                    break;
                case 'STKSIN':
                case 'STKSOUT':
                    color = '#77f279';
                    markerLabel = '\uf5fd'; // Unicode for Stockist icon
                    tooltipContent = 'Stockist';
                    break;
                case 'DSTRIN':
                case 'DSTROUT':
                    color = '#9290e0';
                    markerLabel = '\uf362'; // Unicode for Distributor icon
                    tooltipContent = 'Distributor';
                    break;
                case 'DELRIN':
                case 'DELROUT':
                    color = '#f5f264';
                    markerLabel = '\uf2b5'; // Unicode for Dealer icon
                    tooltipContent = 'Dealer';
                    break;
                case 'RTLRIN':
                case 'RTLROUT':
                    color = 'orange';
                    markerLabel = '\uf0f8'; // Unicode for Retailer icon
                    tooltipContent = 'Retailer';
                    break;
                default:
                    color = 'gray';
                    markerLabel = '\uf1f3'; // Default icon
                    tooltipContent = 'Unknown';
            }

            return {
                color: color,
                markerLabel: markerLabel,
                tooltipContent: tooltipContent
            };
        }

        // Add markers for packet locations
        for (var i = 0; i < packetLocations.length; i++) {
            console.log("Processing: ", packetLocations[i]); // Debugging line
            var position = {lat: parseFloat(packetLocations[i].fdLat), lng: parseFloat(packetLocations[i].fdLong)};
            var trxnType = packetLocations[i].fdTrxnType;
            var markerProps = getMarkerProperties(trxnType);

            var marker = new google.maps.Marker({
                position: position,
                map: map,
                animation: google.maps.Animation.DROP,
            
                label: {
                    fontFamily: 'Fontawesome',
                    text: markerProps.markerLabel,
                    className :'custom-marker-label',
                    color: "black",
                    fontSize: "20px",
                   
                },
                icon: {
                    path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
                    fillColor: markerProps.color,
                    fillOpacity: 3,
                    scale: 1.6,
                },
            });

            // Extend the bounds to include this marker's position
            bounds.extend(position);

            // Add event listeners for mouseover and mouseout to show tooltips
            (function(marker, tooltipContent, fdCreatedOn, fdTrxnOwner, fdUserFName) {
    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'mouseover', function() {
        var content = '<div style="font-size: 16px; color: black;width:200px;">' + 
                      tooltipContent + '<br>' +
                      'ID: ' + fdTrxnOwner + '<br>' +
                      'Medicine ID: ' +medicine.fdMedicineID + '</a><br>' +
                      'Medicine Name: ' + medicine.fdMedicineName + '<br>' +
                      'Date & Time: ' + fdCreatedOn + 
                      '</div>';
        infowindow.setContent(content);
        infowindow.open(map, marker);
    });
    google.maps.event.addListener(marker, 'mouseout', function() {
        infowindow.close();
    });
})(marker, markerProps.tooltipContent, packetLocations[i].fdCreatedOn, packetLocations[i].fdTrxnOwner, packetLocations[i].fdUserFName);

        }

        // Fit the map to the bounds
        map.fitBounds(bounds);

        // Draw polyline to connect locations
        var lineCoordinates = packetLocations.map(function(location) {
            return {lat: parseFloat(location.fdLat), lng: parseFloat(location.fdLong)};
        });

        var lineSymbol = {
            path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
            scale: 4,
            strokeColor: '#FF0000'
        };

        var polyline = new google.maps.Polyline({
            path: lineCoordinates,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2,
            icons: [{
                icon: lineSymbol,
                offset: '100%',
                repeat: '100px'
            }]
        });

        polyline.setMap(map);
    }
</script>


<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDonb2ULBup0rFfk6C8CSbGx2rcR52vm2o&callback=initMap&libraries=places&v=weekly&channel=2"
      async
    ></script> 



      
    </div>
  </div>
</div>
</div>
                    <style>
ul, #myUL {
  list-style-type: none;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #545a67;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #32353d;
}
#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>
<?php

function getPacketIDs($conn, $cartonID) {
    $packetIDs = array();
    $result = mysqli_query($conn, "SELECT DISTINCT fdPacketID FROM tbMedicineStripTest WHERE fdCartonID='$cartonID'");
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $packetIDs[] = $row['fdPacketID'];
        }
    }
    return $packetIDs;
}

function getStripIDs($conn, $packetID) {
    $stripIDs = array();
    $result = mysqli_query($conn, "SELECT DISTINCT fdStripID FROM tbMedicineStripTest WHERE fdPacketID='$packetID'");
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $stripIDs[] = $row['fdStripID'];
        }
    }
    return $stripIDs;
}

$result1 = mysqli_query($conn, "SELECT  * FROM tbMedicineStripTest WHERE fdCartonID='$packageID' OR fdPacketID='$packageID' OR fdStripID='$packageID' ");

?>
<div class="container-fluid">
<div class="card"> 
    <div class="card-body">
        <div class="container my-5">
			<div class="row">
				<div class="col-sm-12 col-lg-12">
					<?php
$heading = '';
if ($packageType === 'Carton') {
    $heading = 'Carton ID Details';
} elseif ($packageType === 'Packet') {
    $heading = 'Packet ID Details';
} elseif ($packageType === 'Strip') {
    $heading = 'Strip ID Details';
}
?>

<h4><center><?php echo $heading; ?></center></h4>

<?php
  $RoleUniqueID = $_SESSION['fdRoleUniqueID'];
 
            require ("include/connection.php");
            //$packageType = $_POST['packet_id'];
           // $sql = "";
           if (!empty($search)) {
            // Search in tbcarton, tbpacket, and tbmedicinestriptest for the QR code
            require("include/connection.php");
            $sql = "SELECT 'Carton' AS package_type, fdCartonID AS package_id, fdMedicineID FROM tbCarton WHERE fdQRCode = '$search'";
            $sql .= " UNION ALL ";
            $sql .= "SELECT 'Packet' AS package_type, fdPacketID AS package_id, fdMedicineID FROM tbPacket WHERE fdQRCode = '$search'";
            $sql .= " UNION ALL ";
            $sql .= "SELECT 'Strip' AS package_type, fdStripID AS package_id, fdMedicineID FROM tbMedicineStripTest WHERE fdQRCode = '$search'";
        }  elseif (!empty($strip_id)) {
            // Search based on provided strip ID
            $packageType = $_POST['packet_id'];
            switch ($packageType) {
                case "Carton":
                    $sql = "SELECT 'Carton' AS package_type, fdCartonID AS package_id, fdMedicineID FROM tbCarton WHERE fdCartonID = '$strip_id' LIMIT 1";
                    break;
                case "Packet":
                    $sql = "SELECT 'Packet' AS package_type, fdPacketID AS package_id, fdMedicineID FROM tbPacket WHERE fdPacketID = '$strip_id' LIMIT 1";
                    break;
                case "Strip":
                    $sql = "SELECT 'Strip' AS package_type, fdStripID AS package_id, fdMedicineID FROM tbMedicineStripTest WHERE fdStripID = '$strip_id'";
                    break;
                default:
                    echo "Invalid package type";
            }
        }
            
        // $sql="SELECT * FROM tbMedicineStripTest WHERE fdQRCode ='$search' OR fdStripID='$strip_id' OR fdCartonID ='$strip_id' OR fdPacketID ='$strip_id'";
        //     if ($packageType == "Carton") {
        //         $sql .= " OR fdCartonID ='$strip_id' LIMIT 1";
        //     } elseif ($packageType == "Packet") {
        //         $sql .= " OR fdPacketID ='$strip_id' LIMIT 1";
        //     } elseif ($packageType == "Strip") {
        //         // No need to append anything for Strip
        //     }
        if ($packageType === 'Carton') {
            $sqlCounts = "SELECT 
            COUNT(DISTINCT fdPacketID) AS packetCount,
            COUNT(DISTINCT fdStripID) AS stripCount 
      FROM tbMedicineStripTest 
      WHERE fdCartonID = '$packageID'";
      $stmtCounts = mysqli_prepare($conn, $sqlCounts);
      if ($stmtCounts) {
          mysqli_stmt_execute($stmtCounts);
          $resultCounts = mysqli_stmt_get_result($stmtCounts);
          if ($resultCounts && mysqli_num_rows($resultCounts) > 0) {
              $countsData = mysqli_fetch_assoc($resultCounts);
              $packetCount = $countsData['packetCount'];
              $stripCount = $countsData['stripCount'];
          }
          }
        } elseif ($packageType === 'Packet') {
            $sqlCounts = "SELECT 
            COUNT(DISTINCT fdPacketID) AS packetCount,
            COUNT(DISTINCT fdStripID) AS stripCount 
      FROM tbMedicineStripTest
      WHERE fdPacketID = '$packageID'";
                      $stmtCounts = mysqli_prepare($conn, $sqlCounts);
                      if ($stmtCounts) {
                          mysqli_stmt_execute($stmtCounts);
                          $resultCounts = mysqli_stmt_get_result($stmtCounts);
                          if ($resultCounts && mysqli_num_rows($resultCounts) > 0) {
                              $countsData = mysqli_fetch_assoc($resultCounts);
                             
                              $stripCount = $countsData['stripCount'];
                          }
                          }
        }
      
        $result = mysqli_query($conn, $sql);    
        if ($result && mysqli_num_rows($result) > 0) {
            // Iterate through the results
          
                    ?>
<div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered display">
                            <thead style="background: #1e88e566;color: white;">
                                <tr style="white-space: nowrap;">
                      
                                    <th>Medicine ID</th>
                                    <th>Manufacture ID</th>
                                    <th>Package Type</th>
                                    <th>Package ID</th>   
                                   <?php if ($packageType === 'Carton') { ?>
                                    <th>No.of Packets</th>
                                    <th>No.of Strips</th>
                                    <?php } elseif ($packageType === 'Packet') { ?>
                                        <th>No. of Strips</th>
                                    <?php } elseif ($packageType === 'Strip') { ?>

                                    
                    <?php } ?>
                          
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               while ($rows = mysqli_fetch_assoc($result)) {
                                $packageType = $rows['package_type'];
                                $packageID = $rows['package_id'];
                                $medicineID = $rows['fdMedicineID'];
                
                                    // table data
                                    ?><tr>
                                    
                                    <td><?php echo $medicineID; ?></td>
                                    <td><?php echo $RoleUniqueID; ?></td>
                                    
                                    <td><?php echo $packageType; ?></td>
                                                    <td><?php 
                                                        // Determine which ID to display based on package type
                                                        switch ($packageType) {
                                                            case "Carton":
                                                                echo $packageID;
                                                                break;
                                                            case "Packet":
                                                                echo $packageID;
                                                                break;
                                                            case "Strip":
                                                                echo $packageID;
                                                                break;
                                                            default:
                                                                echo "Unknown";
                                                        }
                                                    // }
                                                        ?>
                                    </td>
                                    <?php if ($packageType === 'Carton') { ?>
                                        <td><?php echo $countsData['packetCount']; ?></td>
                                        <td><?php echo $countsData['stripCount']; ?></td>
                                    <?php }elseif ($packageType === 'Packet') { ?>
                       <td><?php echo $countsData['stripCount']; ?></td>
                  
                   <?php } elseif ($packageType === 'Strip') { ?>
      

                   
   <?php } ?>
                               </tr>
                               <?php  
                              }
                             ?>
                            </tbody>      
                                                 
                        </table>
                        </div>      
    </div>
  </div>
</div>
            </div> 
                    
                    <?php
        } ?>       
   
  </div>

  <ul id="myUL">
    <li>
        <span class="caret"><?php echo $packageID; ?></span>
        <ul class="nested">
            <?php 
            if ($result1 && mysqli_num_rows($result1) > 0) { 
                
                $uniquePacketIDs = array(); // Array to store unique packet IDs
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    // Add packet ID to the array only if it's not already present
                    if (!in_array($row1['fdPacketID'], $uniquePacketIDs)) {
                        $uniquePacketIDs[] = $row1['fdPacketID'];
                    }
                }
                
                foreach ($uniquePacketIDs as $uniquePacketID) { // Iterate through unique packet IDs 
            ?>
                    <li>
                    <?php if ($packageType === 'Carton') { ?>
                   
                        <span class="caret"><?php echo $uniquePacketID; ?></span>
                        <ul class="nested">
                        <?php
                        // Fetch and display packet details for the current packet ID
                        $resultMedicinepacket = mysqli_query($conn, "SELECT * FROM tbPacket WHERE fdPacketID='$uniquePacketID'");
                        
                        // Check if the query executed successfully
                        if ($resultMedicinepacket) {
                            $medicineData = array(); // Array to store medicine data
                        
                            // Fetch all rows of data from the result set and store them in the array
                            while ($rowMedicinepacket = mysqli_fetch_assoc($resultMedicinepacket)) {
                                $medicineData[] = $rowMedicinepacket;
                            }
                        
                            // Check if there is any data in the array
                            if (!empty($medicineData)) {
                                // Output the table header
                        ?>
                                <table style="margin:10px 0;">
                                    <tr>
                                        <th>Medicine ID</th>
                                        <th>Manufacturer ID</th>
                                        <th>Packet ID</th>
                                        <th>QR Code</th>
                                    </tr>
                        <?php
                                // Loop through the medicine data array and generate table rows
                                foreach ($medicineData as $rowMedicinepacket) {
                        ?>
                                    <tr>
                                        <td><?php echo $rowMedicinepacket['fdMedicineID']; ?></td>
                                        <td><?php echo $rowMedicinepacket['fdManufacturerID']; ?></td>
                                        <td><?php echo $rowMedicinepacket['fdPacketID']; ?></td>
                                        <td><?php echo $rowMedicinepacket['fdQRCode']; ?></td>
                                    </tr>
                        <?php
                                }
                        ?>
                                </table>
                        <?php
                            } else {
                                // Handle the case when no data is found
                                echo "No data found for packet ID: $uniquePacketID";
                            }
                        } else {
                            // Handle the case when the query fails
                            echo "Error: " . mysqli_error($conn);
                        }
                        ?>

                        <!-- Fetch and display all strips for the current packet ID in one table -->
                        <?php
                        // Fetch and display strip IDs for the current packet ID
                        $stripIDs = getStripIDs($conn, $uniquePacketID);
                        ?> <span class="caret">Strips </span>
                        <?php
                        if (!empty($stripIDs)) {
                        ?>
                            <table style="margin:10px 0;">
                                <tr>
                                    <th>Medicine ID</th>
                                    <th>Manufacture ID</th>
                                    <th>Strip ID</th>
                                    <th>QR Code</th>
                                </tr>
                        <?php
                            foreach ($stripIDs as $stripID) {
                                // Fetch and display medicine details for the current strip ID
                                $resultMedicine1 = mysqli_query($conn, "SELECT * FROM tbMedicineStripTest WHERE fdStripID='$stripID'");
                                while ($rowMedicine = mysqli_fetch_assoc($resultMedicine1)) {
                        ?>
                                    <tr>
                                        <td><?php echo $rowMedicine['fdMedicineID']; ?></td>
                                        <td><?php echo $rowMedicine['fdManufacturerID']; ?></td>
                                        <td><?php echo $rowMedicine['fdStripID']; ?></td>
                                        <td><?php echo $rowMedicine['fdQRCode']; ?></td>
                                    </tr>
                        <?php
                                }
                            }
                        ?>
                            </table>
                        <?php
                        } else {
                            echo "No strip data found for packet ID: $uniquePacketID";
                        }
                        ?>

                        </ul>
                    <?php } ?>
                         
                    </li>
                    
                    
                    <?php if ($packageType === 'Packet') { ?>
                        <table style="margin:10px 0;">
                            <tr>
                                <th>Medicine ID</th>
                                <th>Manufacturer ID</th>
                                <th>Packet ID</th>
                                <th>QR Code</th>
                            </tr>
                        <?php
                        // Fetch and display packet details for the current packet ID
                        $resultMedicinepacket = mysqli_query($conn, "SELECT * FROM tbPacket WHERE fdPacketID='$uniquePacketID'");
                        
                        // Check if the query executed successfully
                        if ($resultMedicinepacket) {
                            $medicineData = array(); // Array to store medicine data
                        
                            // Fetch all rows of data from the result set and store them in the array
                            while ($rowMedicinepacket = mysqli_fetch_assoc($resultMedicinepacket)) {
                                $medicineData[] = $rowMedicinepacket;
                            }
                        
                            // Check if there is any data in the array
                            if (!empty($medicineData)) {
                                // Loop through the medicine data array and generate table rows
                                foreach ($medicineData as $rowMedicinepacket) {
                        ?>
                                    <tr>
                                        <td><?php echo $rowMedicinepacket['fdMedicineID']; ?></td>
                                        <td><?php echo $rowMedicinepacket['fdManufacturerID']; ?></td>
                                        <td><?php echo $rowMedicinepacket['fdPacketID']; ?></td>
                                        <td><?php echo $rowMedicinepacket['fdQRCode']; ?></td>
                                    </tr>
                        <?php
                                }
                            } else {
                                // Handle the case when no data is found
                                echo "<tr><td colspan='4'>No data found for packet ID: $uniquePacketID</td></tr>";
                            }
                        } else {
                            // Handle the case when the query fails
                            echo "<tr><td colspan='4'>Error: " . mysqli_error($conn) . "</td></tr>";
                        }
                        ?>
                        </table>
                        <table style="margin:10px 0;">
                            <tr>
                                <th>Medicine ID</th>
                                <th>Manufacturer ID</th>
                                <th>Strip ID</th>
                                <th>QR Code</th>
                            </tr>
                        <?php
                        // Fetch and display strip IDs for the current packet ID
                        $stripIDs = getStripIDs($conn, $uniquePacketID); ?>

                        <span class="caret">Strips </span>
                        <?php
                        foreach ($stripIDs as $stripID) {
                            $resultMedicine1 = mysqli_query($conn, "SELECT * FROM tbMedicineStripTest WHERE fdStripID='$stripID'");
                            while ($rowMedicine = mysqli_fetch_assoc($resultMedicine1)) {
                        ?>
                                    <tr>
                                        <td><?php echo $rowMedicine['fdMedicineID']; ?></td>
                                        <td><?php echo $rowMedicine['fdManufacturerID']; ?></td>
                                        <td><?php echo $rowMedicine['fdStripID']; ?></td>
                                        <td><?php echo $rowMedicine['fdQRCode']; ?></td>
                                    </tr>
                        <?php
                            }
                        }
                        ?>
                        
                        </table>
                    <?php } ?>
                    
                    
                    <?php if ($packageType === 'Strip') { ?>
                        <table style="margin:10px 0;">
                            <tr>
                                <th>Medicine ID</th>
                                <th>Manufacture ID</th>
                                <th>Strip ID</th>
                                <th>QR Code</th>
                            </tr>
                            <?php
                    // Fetch and display medicine details for the current strip ID
                    $resultMedicine1 = mysqli_query($conn, "SELECT * FROM tbMedicineStripTest WHERE fdStripID='$packageID'");
                    while ($rowMedicine = mysqli_fetch_assoc($resultMedicine1)) {
                ?>
                            <tr>
                                <td><?php echo $rowMedicine['fdMedicineID']; ?></td>
                                <td><?php echo $rowMedicine['fdManufacturerID']; ?></td>
                                <td><?php echo $rowMedicine['fdStripID']; ?></td>
                                <td><?php echo $rowMedicine['fdQRCode']; ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </ul>
</li>
</ul>

				</div>
			</div>
		</div>
	</div>
</div>
</div>
    
<script>
    var toggler = document.getElementsByClassName("caret");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
        });
}
</script>

        <!-- </div>
    </div> -->
<!-- </div> -->
                         <!-- </div> -->
            <?php  
                              //}

                                //}   
                                                         
}else{
    echo '<script>Swal.fire ({ 
            icon: "error",
            title:"Data Not Found!"
        });
        </script>';
    }
    
    
}
  
//} 
           
//}     
        ?>
      </div>     
<!--                
    </div>
</div> -->

<script>
    $(document).ready(function() {
        // Function to populate dropdown options
        function populateStripIDs(selectedPacket) {
            var url = '';
            if (selectedPacket == 'Carton') {
                url = 'get_carton.php';
            } else if (selectedPacket == 'Strip') {
                url = 'get_strip.php';
            } else if (selectedPacket == 'Packet') {
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

 
                 

<script>
    
    document.getElementById('qrcode').addEventListener('input', function() {
        document.getElementById('packet_id').selectedIndex = 0; // Clear packet ID selection
        document.getElementById('strip_id').selectedIndex = 0; // Clear strip ID selection
    });

    document.getElementById('qrcode1').addEventListener('input', function() {
        document.getElementById('packet_id').selectedIndex = 0; // Clear packet ID selection
        document.getElementById('strip_id').selectedIndex = 0; // Clear strip ID selection
    });
</script>
<script>
    
    function fetchEncryptedQR() {
        var qrCode = document.getElementById('qrcode').value;
        // Perform an AJAX request to fetch the encrypted QR code
        // Replace 'fetch_encrypted_qr.php' with the appropriate PHP script that fetches the encrypted QR code
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetch_QREncrypt.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Update the value of the second input field with the fetched encrypted QR code
                document.getElementById('qrcode1').value = xhr.responseText;
            }
        };
        xhr.send('qrcode=' + qrCode);
    }

    // Event listener to trigger fetchEncryptedQR function when the value of the first input field changes
    document.getElementById('qrcode').addEventListener('input', fetchEncryptedQR);

    function validateAllRequiredFields() {
        var packetId = document.getElementById('packet_id').value;
        var stripId = document.getElementById('strip_id').value;
        var qrCode = document.getElementById('qrcode').value;

        // If QR code is entered, allow submission regardless of packet ID and strip ID
        if (qrCode !== '') {
            return true;
        }

        // If both packet ID and strip ID are selected, allow submission
        if (packetId !== '' && stripId !== '') {
            return true;
        }

        // Otherwise, show an error message and prevent submission
        alert('Please enter a QR code or select both Package type and Strip ID.');
        return false;
    }
</script>
<script src="path/to/qrcode.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.js" integrity="sha512-is1ls2rgwpFZyixqKFEExPHVUUL+pPkBEPw47s/6NDQ4n1m6T/ySeDW3p54jp45z2EJ0RSOgilqee1WhtelXfA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
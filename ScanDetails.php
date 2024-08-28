
<?php require "include/connection.php"; 
session_start();

if (isset($_SESSION['hide_qr']) && $_SESSION['hide_qr']) {
    // Hide the QR code using CSS or JavaScript
    echo "<style>#qrcode { display: none; }</style>";
}

$scannedStatus = isset($_SESSION['scan_status']) ? $_SESSION['scan_status'] : 'Pending';

if(!$_SESSION['fdRoleID']){
	header("Location: login.php");
}

// $RoleUniqueID = $_SESSION['fdRoleUniqueID'];
// $roleid = $_SESSION['fdRoleID'];

$checkQuery = "SELECT * FROM tbScanlog WHERE fdManufacturerID = '$RoleUniqueID' OR fdStockistID = '$RoleUniqueID' OR fdDistributorID = '$RoleUniqueID' OR fdDealerID = '$RoleUniqueID' OR fdRetailerID = '$RoleUniqueID'";
$checkResult = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    $_SESSION['hide_qr'] = true; 
    $scannedStatus = 'Scanned'; 
} else {
    $_SESSION['hide_qr'] = false; 
    $scannedStatus = 'Pending'; 
}

?>
<div id="main-wrapper">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.min.js"></script>
    <div class="container-fluid"> 
        <div id="qrcode" style="text-align: -webkit-center; margin-top:96px;">
        <?php if ($_SESSION['hide_qr']) : ?></div>

            <script>
                document.getElementById("qrcode").style.display = "none";
            </script>

        <?php else: ?>
            <script>
                // Generate QR code with the payload as text
                const qrc = new QRCode(document.getElementById("qrcode"), {
                    text: 'https://schedarcloud.com/medicineverifications/demo1.php',
                    width: 250,
                    height: 250,
                    correctLevel: QRCode.CorrectLevel.H
                });
            </script>
        <?php endif; ?>
        <br>

<?php
$RoleUniqueID = $_SESSION['fdRoleUniqueID'];
$roleid = $_SESSION['fdRoleID'];
require("include/connection.php");

switch ($roleid) {
    case 'MNFR':
        $query = "SELECT * FROM tbMedicineStrip WHERE fdManufacturerID = '$RoleUniqueID'";
        break;
    case 'STKS':
        $query = "SELECT * FROM tbMedicineStrip WHERE fdStockistID ='$RoleUniqueID'";
        break;
    case 'DSTR':
        $query = "SELECT * FROM tbMedicineStrip WHERE fdDistributorID ='$RoleUniqueID'";
        break;
    case 'DELR':    
         $query = "SELECT * FROM tbMedicineStrip WHERE fdDealerID ='$RoleUniqueID'";
        break;
    case 'RTLR':
        $query = "SELECT * FROM tbMedicineStrip WHERE fdRetailerID ='$RoleUniqueID'";
        break;
    default:
        die("Invalid Role");
}
// $query = "SELECT * FROM `tbMedicineStrip` WHERE fdManufacturerID ='$RoleUniqueID'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Manufacturer Query Error: " . mysqli_error($conn));
}

while ($rows = mysqli_fetch_assoc($result)) {
    $fdMedicineID = $rows['fdMedicineID'];
    $fdCartonID = $rows['fdCartonID'];
    $fdPacketID = $rows['fdPacketID'];
    $fdStripID = $rows['fdStripID'];
    $fdManufacturerID = $rows['fdManufacturerID'];

}

?>
<article class="card" id="article" >
<div class="card-body row" style="display: flex; flex-wrap: wrap;">
<div class="col-sm-4 col-md-4"> <strong>Medicine ID:</strong> <br><?php echo $fdMedicineID; ?></div>
        <div class="col-sm-4 col-md-4"> <strong>Carton ID:</strong> <br><?php echo $fdCartonID; ?></div>
        <div class="col-sm-4 col-md-4"> <strong>Packet ID:</strong><br><?php echo $fdPacketID; ?></div>
        <div class="col-sm-4 col-md-4"> <strong>Strip ID:</strong> <br><?php echo $fdStripID; ?></div>
        <div class="col-sm-4 col-md-4"> <strong>Manufacturer ID:</strong> <br><?php echo $fdManufacturerID; ?></div>
        <div class="col-sm-4 col-md-4"> <strong>Status:</strong> <br>
        <?php
            $statusColor = ($scannedStatus === 'Scanned') ? 'green' : 'f1c21b';
            ?>
            <button style="background-color: <?php echo $statusColor; ?>; color:white;" disabled><?php echo $scannedStatus; ?></button>
        </div>
</div>
    </div>
</article>
 </div> 

 </div>
<!-- </div>  -->
<?php require "include/footer.php"; ?>

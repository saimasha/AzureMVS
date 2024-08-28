
<?php require "include/connection.php"; 
session_start();
if(!$_SESSION['fdStripID']){
	header("Location: login.php");
}
?>
<?php require "include/header.php"; ?> 
            <div id="main-wrapper">

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include the QRCode library -->
    <!-- Include the QRCode library -->
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
        <div class="page-wrapper">
            <div class="container-fluid">


<div id="qrcode" style="text-align: -webkit-center;"></div>

<script>

     // Generate QR code with the payload as text
    const qrc = new QRCode(document.getElementById("qrcode"), {
        text: 'https://schedarcloud.com/medicineverifications/CustomerDemo1.php',
        width: 250,
        height: 250,
        correctLevel: QRCode.CorrectLevel.H
    });
//  // Redirect to scan-handler.php after a simulated QR code scan
//     document.getElementById("qrcode").addEventListener("click", function () {
//         e.preventDefault();
//         window.location.href = "demo1.php";
        
//     });
</script>

</div>
<?php
$query = "SELECT * FROM tbCustomerScanlog WHERE fdCustomerID = 'CSTM3244523'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Manufacturer Query Error: " . mysqli_error($conn));
}

$data = array();
$prevHash = ''; // Initialize previous hash

while ($rows = mysqli_fetch_assoc($result)) {
    $fdMedicineID = $rows['fdMedicineID'];
    $fdCartonID = $rows['fdCartonID'];
    $fdPacketID = $rows['fdPacketID'];
    $fdStripID = $rows['fdStripID'];
    $fdManufacturerID = $rows['fdManufacturerID'];
    $fdStockistID = $rows['fdStockistID'];
    $fdDistributorID = $rows['fdDistributorID'];
    $fdDealerID = $rows['fdDealerID'];
    $fdRetailerID = $rows['fdRetailerID'];
    $fdCustomerID = $rows['fdCustomerID'];

$prevHashQuery = "SELECT fdBlockchainRecordID FROM tbCustomerScanlog WHERE fdMedicineID = '$fdMedicineID' AND fdCartonID = '$fdCartonID' AND fdPacketID = '$fdPacketID' AND fdStripID = '$fdStripID' AND fdManufacturerID = '$fdManufacturerID' AND fdStockistID = '$fdStockistID' AND fdDistributorID = '$fdDistributorID' AND fdDealerID = '$fdDealerID' AND fdRetailerID = '$fdRetailerID' AND fdCustomerID = '$fdCustomerID' ORDER BY fdSlNo DESC LIMIT 1";
    $prevHashResult = mysqli_query($conn, $prevHashQuery);
    $prevHashRow = mysqli_fetch_assoc($prevHashResult);
    $prevHash = $prevHashRow['fdBlockchainRecordID'];

    // Concatenate each attribute within an entry with ","
    $entry = $fdMedicineID . ',' . $fdCartonID . ',' . $fdPacketID . ',' . $fdStripID . ',' . $fdManufacturerID;

    // Add each entry to the $data array, concatenating with the previous hash
    $data[] = $entry . ',' . $prevHash;
}
    ?>
<article class="card" id="article">
<div class="card-body row">
<div class="col-sm-4 col-md-4"> <strong>Medicine ID:</strong> <br><?php echo $fdMedicineID; ?></div>
        <div class="col-sm-4 col-md-4"> <strong>Carton ID:</strong> <br><?php echo $fdCartonID; ?></div>
        <div class="col-sm-4 col-md-4"> <strong>Packet ID:</strong><br><?php echo $fdPacketID; ?></div>
        <div class="col-sm-4 col-md-4"> <strong>Strip ID:</strong> <br><?php echo $fdStripID; ?></div>
        <div class="col-sm-4 col-md-4"> <strong>Manufacturer ID:</strong> <br><?php echo $fdManufacturerID; ?></div>
    </div>
</article>
    </div>
</div>

<?php require "include/footer.php"; ?>


<?php require "include/connection.php"; 
session_start();
if(!$_SESSION['fdRoleID']){
	header("Location: login.php");
}
?>
<?php require "include/header.php"; ?>
            <div id="main-wrapper">
<?php require "include/navbar.php"; ?>

        <?php require "include/sidebar.php"; ?>
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
        text: 'https://schedarcloud.com/medicineverifications/demo1.php',
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

    </div>
</div>

<?php require "include/footer.php"; ?>

<?php
require("include/connection.php"); // Include your database connection file.
require "include/Login_navbar.php";
require("include/header.php");
require("function.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$email = $_GET['email']; 
//echo $email;
function displayError($title,$link) {
    echo '<script>Swal.fire({
	icon: "success",
    title: "' . $title . '",
    html: `' . $link . '`
    }).then((value) => {
     if (value) {
         window.location.href = "login.php";
     }
 });
    </script>';
}

if (isset($_POST['activate'])) {
    
    $sql = "UPDATE tbUserMaster SET fdStatus = '1' WHERE fdEmailAsUserID = '$email'";
    //echo $sql;
    //mysqli_query($conn, $sql);
    if (mysqli_query($conn, $sql)) {
        sendEmail1($conn, 6, $email);
        displayError("Click the following link to log in to your account:", '<a href="https://schedarcloud.com/medicineverifications_new/login.php">https://schedarcloud.com/medicineverifications_new/login.php</a>');
    } else {
        echo '<script> swal.fire({
            title: "Activation Failed!",
            text: "",
            icon: "error"
            })
            </script>';
    }
}
?>

<div class="container mt-5" style="text-align:center;">
    <h2>Activate Your Account</h2>
    <form method="POST">
        
    <button type="submit" class="btn btn-primary btn-lg" name="activate" id="activate">Activate</button>
    <!-- <button type="submit" class="btn btn-danger" name="deactivate" id="deactivate">Deactivate</button> -->
</form>
</div>
<?php
require("include/footer.php"); ?>

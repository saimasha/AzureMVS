
<?php 
session_start();
require "include/header.php";
require "include/Login_navbar.php";
require "include/connection.php"; 


date_default_timezone_set('Asia/Kolkata');

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');

function displayError($title, $message) {
    echo '<script>Swal.fire({
        icon: "error",
        title: "' . $title . '",
        html: "' . $message . '"
    });
    </script>';
}

if(isset($_POST['login'])){
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Pass = mysqli_real_escape_string($conn, $_POST['Pass']);
    $sql="SELECT * FROM tbUserMaster WHERE fdEmailAsUserID = '$Email' AND fdPassword ='$Pass' AND fdStatus = '1'";
    $res=mysqli_query($conn,$sql);

    if(mysqli_num_rows($res)>0){
        while($row=mysqli_fetch_assoc($res)){
            // Setting session variables
            $_SESSION['fdRoleID'] =  $row['fdRoleID']; 
            $_SESSION['fdRoleUniqueID'] =  $row['fdRoleUniqueID']; 

            // Update the last login date
            $updateSql = "UPDATE tbUserMaster SET fdLastLoginDate = '$currentDateTime' WHERE fdEmailAsUserID = '$Email' AND fdPassword ='$Pass'";
            if (!mysqli_query($conn, $updateSql)) {
                // Log error or send an error response if needed
                error_log("Failed to update last login date for user: $Email, Error: " . mysqli_error($conn));
            }

            echo "<script>window.location.href = 'https://medicineverification.com/index.php';</script>";
        }
    } else {
        $Sql = "SELECT * FROM tbUserMaster WHERE fdEmailAsUserID = '$Email' AND fdPassword ='$Pass' AND fdStatus = '0'";
        $Result = mysqli_query($conn, $Sql);
        if (mysqli_num_rows($Result) > 0) {
            displayError("Login failed", "Check Your Email to Approve Your Account...!");
        } else {
            displayError("Login failed", "Please Enter Valid Email ID or Password");
        }
    }
    
}
?>
<style>
body {
    overflow: hidden;
}
.container-login100 {
    width: 100%;
    min-height: 100vh;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding: 15px;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-color: #f2f2f2;
}
.wrap-login100 {
    width: 960px;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    display: -webkit-box;
    display: -webkit-flex;
    /* display: -moz-box;
    display: -ms-flexbox; */
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 177px 130px 33px 95px;
}

.wrap-input100 {
    position: relative;
    width: 100%;
    z-index: 1;
    margin-bottom: 10px;
}

.login100-pic img{
    width: 100%;
    
}
.login100-pic p{
    font-size: 34px;
    color: #007bff;
    margin-left: 182px;
    font-weight: bold;
    margin-top: -115px;
}

.input100 {
    font-family: "Poppins";
    font-size: 17px;
    line-height: 1.5;
    color: #666666;
    display: block;
    width: 100%;
    background: #e6e6e6;
    height: 50px;
    border-radius: 25px;
    padding: 0 30px 0 68px;
    touch-action: manipulation;
}
input {
    outline: none;
    border: none;
}

input[type="text" i] {
    writing-mode: horizontal-tb !important;
    /* padding-block: 1px;
    padding-inline: 2px; */
}

.login100-form-title {
    font-family: 'Poppins';
    font-weight: bold;
    font-size: 30px;
    color: #333333;
    line-height: 1.2;
    text-align: center;
    width: 100%;
    display: block;
    padding-bottom: 30px;
}

.focus-input100 {
    display: block;
    position: absolute;
    border-radius: 25px;
    bottom: 0;
    left: 0;
    z-index: -1;
    width: 100%;
    height: 100%;
    box-shadow: 0px 0px 0px 0px;
    color: rgba(87,184,70, 0.8);
}
.symbol-input100 {
    font-size: 15px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    align-items: center;
    position: absolute;
    border-radius: 25px;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding-left: 35px;
    pointer-events: none;
    color: #666666;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}
.login100-form-btn {
    font-family: 'Montserrat';
    font-weight: bold;
    font-size: 17px;
    line-height: 1.5;
    color: #fff;
    text-transform: uppercase;
    width: 100%;
    height: 50px;
    border-radius: 25px;
    background: #57b846;
    /* display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox; */
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 25px;
    /* -webkit-transition: all 0.4s; */
    /* /* -o-transition: all 0.4s;
    -moz-transition: all 0.4s;*/
    transition: all 0.4s;
	outline: none;
    border: none;
	/* margin-bottom: 2px; */
}

.txt2 {
    font-family: 'Poppins';
    font-size: 17px;
    line-height: 1.5;
    color: #666666;
}
.text-center {
    text-align: center!important;
}
img {
    vertical-align: middle;
    border-style: none;
	/* overflow-clip-margin: content-box; */
    overflow: clip;
	
}
.p-t-136 {
    padding-top: 91px;
}
.p-t-12 {
    padding-top: 9px;
}
.container-login100-form-btn {
    width: 100%;
    /* display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex; */
    flex-wrap: wrap;
    justify-content: center;
    padding-top: 20px;
}
.validate-input {
    position: relative;
}

.input100:focus + .focus-input100 + .symbol-input100 {
    color: #57b846;
    padding-left: 28px;
}

.input100:focus + .focus-input100 {
  -webkit-animation: anim-shadow 0.5s ease-in-out forwards;
  animation: anim-shadow 0.5s ease-in-out forwards;
}

@-webkit-keyframes anim-shadow {
  to {
    box-shadow: 0px 0px 70px 25px;
    opacity: 0;
  }
}

@keyframes anim-shadow {
  to {
    box-shadow: 0px 0px 70px 25px;
    opacity: 0;
  }
}

@media (max-width: 992px) {
  .wrap-login100 {
    padding: 177px 90px 33px 85px;
  }

  .login100-pic {
    width: 35%;
  }

  .login100-form {
    width: 50%;
  }
}

@media (max-width: 768px) {
  .wrap-login100 {
    padding: 100px 80px 33px 80px;
  }

  .login100-pic {
    display: none;
  }

  .login100-form {
    width: 100%;
  }
}

@media (max-width: 576px) {
  .wrap-login100 {
    padding: 100px 15px 33px 15px;
  }
}

/* .login100-form-btn:hover {
  background:cornflowerblue;
} */
#showPasswordIcon {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #666666;
    font-size: 15px;
}

#showPasswordIcon:hover {
    color: #333333;
}
</style>
<body>

<div id="warning" class="p-3 mb-2 text-black" style="padding: 10px; display: none; background-color:rgba(225,220,225,.3);">
</div>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('image/siteImg/loginback.jpeg');">
            <div class="wrap-login100" style="opacity: 0.7;">
                <!-- <b style="color: rgb(62,140,76);"><u>Blorified</u> is steps ahead of being verified </b> -->
                <!-- <br> -->
				<div class="login100-pic">
                    <img src="image/siteImg/logo.png" alt="MVS logo" alt="logo" style=" margin-top:50px;margin-left: 10px;height:200px;width: 200px;">
                    <h1><p>MVS</p></h1>
				</div>
				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title">
						Account Login
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="Email" placeholder="Email" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						<i class="fas fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="Pass" id="password" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fas fa-lock" aria-hidden="true"></i>
						</span>
                        <i class="fa fa-eye-slash" id="showPasswordIcon" onclick="togglePasswordVisibility()"></i>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn"  name="login" type="submit">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<!-- <span class="txt1">
							Forgot
						</span> --> 
						<a class="txt2" href="forgetPassword.php">
							Forgot Password
						</a> <br>
                        <a class="txt2" href="register.php">
							Create your Account ? 
							<!-- <i class="fa fa-long-arrow-right" aria-hidden="true"></i> -->
						</a>
					</div>

					<div class="text-center p-t-136">
						<!-- <a class="txt2" href="register.php">
							Create your Account ? -->
							<!-- <i class="fa fa-long-arrow-right" aria-hidden="true"></i> -->
						<!-- </a> -->
					</div>
                    <script>
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
</script>
		</form>
			</div>
		</div>
	</div>
	<?php require "include/footer.php"; ?>	

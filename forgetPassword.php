
<?php require "include/header.php"; 
require "include/Login_navbar.php";
require_once("function.php");
require "include/connection.php"; 
// session_start();

?>


 <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

<style>
* {
	margin: 0px; 
	padding: 0px; 
	box-sizing: border-box;
}
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
    /* display: flex; */
    /* flex-wrap: wrap; */
    justify-content: center;
    align-items: center;
    padding: 20px;
    background-repeat: no-repeat;
    /* background-attachment: fixed; */
    background-size: cover;
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
    padding:90px 110px 30px 80px;
}

.wrap-input100 {
    position: relative;
    width: 100%;
    z-index: 1;
    margin-bottom: 10px;
}

.login100-pic img{
   width: 350px;
    height: 350px;
    margin-bottom: 40px;
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
    padding-top: 70px;
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
    color:#fff;
    text-transform: uppercase;
    width: 100%;
    height: 50px;
    border-radius: 25px;
    background:blue;
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
	/* padding-bottom: 2px; */
}

.text-center {
    text-align: center!important;
}
img {
    vertical-align: middle;
    border-style: none;
   
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
    padding-top: 5px;
    padding-bottom: 100px;
}
.validate-input {
    position: relative;
}

.input100:focus + .focus-input100 + .symbol-input100 {
    color:#666666;
    padding-left: 28px;
}

.input100:focus + .focus-input100 {
  color:cadetblue;
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


.login100-form-btn:hover {
  background: #333333;
}
.show-password-icon {
    position: absolute;
    right: 20px; /* Adjust as needed */
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #666666;
    font-size: 15px;
}
.show-password-icon:hover {
    color: #333333;
}


/* Additional CSS for the dropdown */
.wrap-input100 select {
    font-family: "Poppins";
    line-height: 1.5;
    color: #666666;
    display: block;
    width: 100%;
    background: #e6e6e6;
    height: 50px;
    border-radius: 25px;
    padding: 0 69px;
    appearance: none; /* Removes default appearance */
    -webkit-appearance: none; /* For older versions of Safari */
    -moz-appearance: none; /* For older versions of Firefox */
    outline: none;
    border: none;
    cursor: pointer;
}

.wrap-input100 select:focus {
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.wrap-input100 .symbol-input100 {
    display: flex;
    align-items: center;
    position: absolute;
    border-radius: 25px;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    
    pointer-events: none;
    color: #666666;
    transition: all 0.4s;
}
</style>
<body>
<div id="warning" class="p-3 mb-2 text-black" style="padding: 10px; display: none; background-color:rgba(225,220,225,.3);">
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var resetToken = getParameterByName('reset_token');
    
    if (resetToken) {
        // Hide the forgot password form
        document.getElementById('forgotPasswordForm').style.display = 'none';

        // Show the reset password form
        document.getElementById('resetPasswordForm').style.display = 'block';
    }
});

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
</script>

<div class="limiter" id='resetPasswordForm' style="display: none;">
<div class="container-login100" style="background-image: url('image/products/FPbackgroundimg.jpg');">
                    <div class="wrap-login100">
                        <div class="login100-pic">
					<img src="image/products/FPLogo.png">
				</div>
                        <!-- Password Reset Form -->
                        <form class="login100-form validate-form" method="POST">
                            <span class="login100-form-title">
						Reset Password 
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="NewPassword" id="newPassword" placeholder="New Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                        <i class="fa fa-eye-slash show-password-icon" onclick="togglePasswordVisibility('newPassword', 'showNewPasswordIcon')"></i>
					</div>
                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="confirmnewpassword" id="confirmPassword" placeholder="Confirm New Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-key icon" aria-hidden="true"></i>
						</span>
                        <i class="fa fa-eye-slash show-password-icon" onclick="togglePasswordVisibility('confirmPassword', 'showConfirmPasswordIcon')"></i>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn"  name="resetBtn"  id="resetBtn" type="submit">
							Reset
						</button>
					</div>
                        </form>
                    </div>
                </div>
            </div>
 
    
<div class="limiter" id='forgotPasswordForm'>
    <div class="container-login100" style="background-image: url('image/products/FPbackgroundimg.jpg');">
			<div class="wrap-login100">
				<div class="login100-pic">
					<img src="image/products/FPLogo.png">
				</div>
				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title">
						Forgot Password 
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="Email" placeholder="Enter Email Id" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
</div>

<div class="wrap-input100 validate-input" data-validate="Please select an option">
                    <select class="input100" name="RoleID" id="RoleID" required>
                        <option value="">Select Role</option>
                        <?php
        $query = "SELECT * FROM tbRoleMaster";
        $result = mysqli_query($conn, $query);

        foreach ($result as $row) {
            echo '<option value="' . $row["fdRoleID"] . '"> ' . $row["fdRoleName"] . ' </option>';
        }

        ?>
                    </select>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </span>
                </div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn"  name="updateBtn"  id="updateBtn" type="submit">
							Reset
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
    <?php
    if(isset($_POST['updateBtn'])){
$Email = $_POST['Email'];
$RoleID = $_POST['RoleID']; 
$Sql = "SELECT COUNT(*) FROM tbUserMaster WHERE fdEmailAsUserID = '$Email' AND fdRoleID = '$RoleID'";
$result = mysqli_query($conn, $Sql);
$row = mysqli_fetch_array($result);
if ($row[0] == 0) {
    echo '<script>
    swal.fire({
     title: "No User Found",
     text: "Do you want to sign up?",
     icon: "error",
     buttons: {
         cancel: "No",
         confirm: {
             text: "Yes, Sign Up",
             value: true,
         },
     },
 }).then((value) => {
     if (value) {
         // Redirect to the register page
         window.location.href = "login.php";
     }
 });
</script>';
} 
else
{
   sendEmailforgot($conn, 30, $Email, $RoleID);
     echo '<script>swal.fire({
       title: "Reset link has been sent to your email id.",
       text: "Kindly check your email.",
       icon: "success"
   })</script>';
   
   ?>
           <p style="font-size: 20px;text-align: center;color: cornflowerblue;">
                   We sent an email to  <b><?php echo $Email; ?></b> to help you recover your account. 
           <br>
     Please login into your email account and click on the link we sent to reset your password</p>

   
<?php   
} 
}    
?>
<?php
if(isset($_POST['resetBtn'])){
    $email = $_GET['email'];
    $RoleID = $_GET['RoleID'];
    $newpassword = $_POST['NewPassword'];
    $confirmnewpassword = $_POST['confirmnewpassword'];
    $sql = "UPDATE tbUserMaster SET fdPassword ='$newpassword' WHERE fdEmailAsUserID = '$email' AND fdRoleID = '$RoleID'";
    if ($res=mysqli_query($conn, $sql)) {  
      ?>
      <script>swal.fire({
        icon: "success",
        title: "Password Reset Successfully !",
      })
      .then(function(){ 
      window.location="login.php"; 
  });
    </script>;
    <?php
  }  
  else{
   echo'<script>swal.fire({
        icon: "error",
        title: "Failed to Reset Password",
      })</script>';
  }   
} 

?>  	

    <script>
    function togglePasswordVisibility(inputId, iconId) {
    var passwordInput = document.getElementById(inputId);
    var showPasswordIcon = document.querySelector('#' + iconId);

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

<?php require "include/footer.php"; ?>	

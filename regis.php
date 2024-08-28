
<h3>Seller Login</h3>
                        <!-- registration form starts-->
                        <form  method="POST">

                            <div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email <code>*</code></label>
        <div class="col-sm-8">
            <input type="email" class="form-control" name="email" placeholder="Email Here"  required>
        </div>
    </div>
</div>
                            
                            <!-- new -->
                            <input type="submit" class="btn btn-primary" name="submitr" value="Register Now">
                        </form>
<?php
require("verifyEmail.php"); // Include the verifyEmail class file
?>
<?php

if (isset($_POST["submitr"])) {
    $email = $_POST['email'];
    // Check if the email address exists using the verifyEmail class
    $vmail = new verifyEmail();
    $vmail->setStreamTimeoutWait(50);
    $vmail->Debug = TRUE;
    $vmail->Debugoutput = 'html';
    $vmail->setEmailFrom('saimashadmani1999@gmail.com');

    if ($vmail->check($email)) {
        // Gmail address exists
        echo "exists";
    } else {
        // Gmail address does not exist
        echo "not_exists";
    }
}
?>

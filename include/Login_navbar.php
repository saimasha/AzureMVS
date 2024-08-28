<?php 
session_start();
$fdRoleID = $_SESSION['fdRoleID'] ?? null;
error_reporting(E_ALL & ~E_NOTICE);

?>

<style>
    header ul.nav li a {
    font-size: 14px;
    border: none;
    font-weight: 700;
    text-transform: uppercase;
    color:black;
}
/* Default styles */

@media (max-width: 767px) {
        #navbarNav {
            display: none;
        }
    }


</style>
<header class="topbar">
    <nav class="navbar navbar-expand-lg" style="background-color: white;">
        <div class="container-fluid">
            <a href="login.php" class="" href="index.html">
                <img src="image/siteImg/logo.png" alt="sewa logo" style="height:60px;" alt="logo"> 
                <b> MVS </b>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <h4 class="mb-3" style="color: black;"><b class="bfont">1st Blockchain based Medicine Verification System<br><small style="position: absolute;margin-left: 70px;"><b style="color: rgb(62,140,76);">Blorified</b> is steps ahead of being verified </small></b> </h4>
            </div>

            <a href="index.php" class="" href="https://www.mirachinnovations.com/">
                <img src="https://www.mirachinnovations.com/img/logo.png" style="height:40px;" alt="Mirach innovations logo">
            </a>
        </div>
    </nav>
</header>

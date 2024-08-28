<?php session_start();
 $roleid = $_SESSION['fdRoleID'];
 $RoleUniqueID = $_SESSION['fdRoleUniqueID'];


?>
<style>
    header ul.nav li a {
    font-size: 14px;
    border: none;
    font-weight: 700;
    text-transform: uppercase;
    color:black;
}
</style>

<style>
    .dropdown-submenu .dropdown-toggle::after {
        float: right;
        margin-left: auto;
        margin-right: 0.5rem;
        margin-top: 10px;
    }

    .dropdown-submenu .dropdown-menu {
        left: auto !important;
        right: 0 !important;
    }
</style>
<header class="topbar">
    <nav class="navbar navbar-expand-lg" style="background-color: white;">
        <div class="container-fluid">
            <a href="?dashboard" class="" href="index.html">
                <img src="image/siteImg/logo.png" alt="sewa logo" style="height:60px;" alt="logo"> 
                <b> MVS </b>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
                <!-- added by aishwarya jadhav -->
            <div class="">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="nav navbar-nav">
                       <?php if ($roleid == 'MNFR') { ?>
                        

                       <!-- <li><div class="dropdown p-1">
                                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                   Manufacturer Details </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">  -->
                                <!-- <li><a class="dropdown-item" href="?ProfileManufacture">Update Manufacture</a></li> -->
                                    <!-- <li><a class="dropdown-item" href="?ListManufacture">Manufacture List</a></li> -->
                                    <!-- <li><a class="dropdown-item" href="?SearchManufacture">Update & Delete</a></li>
                                </ul>
                            </div>
                        </li> -->
                        <li><div class="dropdown p-1">
                                <a class="btn"  href="?LocationManufacture" style='color:black;'>
                                Locations                                
                                </a>
                                
                            </div>
                        </li>
                        <li>
                    <div class="dropdown p-1">
                        <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            Generate QR Codes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="?qrcode_generator">Individual</a></li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Bulk</a>
                                <ul class="dropdown-menu ">
                                    <li><a class="dropdown-item" href="?bulkstrip">Strip</a></li>
                                    <li><a class="dropdown-item" href="?bulkPacket">Packet</a></li>
                                    <li><a class="dropdown-item" href="?bulkcarton">Carton</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>


                        <?php }if ($roleid == 'STKS') { ?>

                        <!-- <li><div class="dropdown p-1">
                                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style>
                                  Stockist Details </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                               <li><a class="dropdown-item" href="?ProfileStockist">Update Stockist</a></li> -->
                                    <!-- <li><a class="dropdown-item" href="?ListStockist">Stockist List</a></li>
                                    <li><a class="dropdown-item" href="?SearchStockist">Update & Delete Stockist</a></li> -->
                                    <!--<li><a class="dropdown-item" href="configuration.php">OTA CONFIGURATION</a></li>-->
                                <!-- </ul>
                            </div>    
                                  </li> -->
                        <li><div class="dropdown p-1">
                                <a class="btn" href="?LocationStockist" style='color:black;'>
                                Locations                                
                                </a>
                                
                            </div>
                        </li>
                        <?php } if ($roleid == 'DSTR') {?>

                        <!-- <li><div class="dropdown p-1">
                                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Distributor Details
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                 <li><a class="dropdown-item" href="?ViewDistributor">View Distributor</a></li> -->
                                    <!-- <li><a class="dropdown-item" href="?ListDistributor">List Distributor</a></li>
                                    <li><a class="dropdown-item" href="?SearchDistributor">Update & Delete Distributor</a></li>
                                </ul>
                            </div> -->
                        <!-- </li> --> 
                        <li><div class="dropdown p-1">
                                <a class="btn"  href="?LocationDistributor" style='color:black;'>
                                Locations                                
                                </a>
                                
                            </div>
                        </li>
                        <?php } if ($roleid == 'DELR') {?>
                        <!-- <li><div class="dropdown p-1">
                                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style>
                                    Dealer Details
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> -->
                                <!-- <li><a class="dropdown-item" href="?ProfileDealer">Update Dealer</a></li> -->
                                    <!-- <li><a class="dropdown-item" href="?ListDealer">Dealer List</a></li>
                                    <li><a class="dropdown-item" href="?SearchDealer">Update & Delete Dealer</a></li> -->
                                    <!--<li><a class="dropdown-item" href="configuration.php">OTA CONFIGURATION</a></li>-->
                                <!-- </ul>
                            </div>
                        </li> -->
                        <li><div class="dropdown p-1">
                                <a class="btn"  href="?LocationDealer" style='color:black;'>
                                Locations                                
                                </a>
                                
                            </div>
                        </li>
                        <?php } if ($roleid == 'RTLR') {?>
                        <!-- <li><div class="dropdown p-1">
                                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style>
                                    Retailer Details
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="?ProfileRetailer">Retailer Profile</a></li>
                                    <li><a class="dropdown-item" href="?ListRetailer">Retailer List</a></li>
                                    <li><a class="dropdown-item" href="?SearchRetailer">Update & Delete</a></li>
                                    <li><a class="dropdown-item" href="configuration.php">OTA CONFIGURATION</a></li>
                                </ul>
                            </div>
                        </li> -->
                        <li><div class="dropdown p-1">
                                <a class="btn"   href="?LocationRetailer" style='color:black;'>
                                Locations                                
                                </a>
                                
                            </div>
                        </li>
                        <?php }?>
                        <!-- <li><div class="dropdown p-1">
                                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style>
                                    product Details
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="?AddProduct">ADD PRODUCT</a></li>
                                    <li><a class="dropdown-item" href="?ProductList">PRODUCT LIST</a></li>
                                   <li><a class="dropdown-item" href="curentbtumeterdata.php">CURRENT READINGS</a></li>-->
                                    <!--<li><a class="dropdown-item" href="configuration.php">OTA CONFIGURATION</a></li>-->
                                <!-- </ul>
                            </div> -->
                        <!-- </li>  -->
                        <!-- <li><div class="dropdown p-1">
                                <a class="btn"  href="?qrcode_generator" style='color:black;'>
                                QR Code Generation                                 
                                </a>
                                
                            </div>
                        </li> -->
                        <li><div class="dropdown p-1">
                                <a class="btn" href="?timeline" style='color:black;'>
                                Scan Details                                  
                                </a>
                                
                            </div>
                        </li>
                        <li>
                        <div class="dropdown p-1">
                                <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style>
                                    SCAN
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="?ScanIn">IN-SCAN</a></li>
                                    <li><a class="dropdown-item" href="?ScanOut">OUT-SCAN</a></li>
                                    
                                </ul>
                            </div>
                        </li>
                        <li><div class="dropdown p-1">
                                <a class="btn" href="?ContactUs" style='color:black;'>
                                Contact Us                                
                                </a>
                                
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
<script>
    // Custom jQuery to enable dropdown-submenu behavior
    $(document).ready(function () {
        $(".dropdown-submenu a.dropdown-toggle").on("click", function (e) {
            $(this).next("ul").toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
</script>
<div class="dropdown p-1">
<?php if ($roleid == 'MNFR') {?>
        <?php if (isset($_SESSION['success'])) : ?>
                <?php endif ?> 
            <?php  if (isset($_SESSION['fdRoleUniqueID'])) : ?>
        <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style>
            <i class="fa fa-user text-primary"></i> <?php echo $_SESSION['fdRoleUniqueID']; ?> </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    
    <li><a class="dropdown-item" href="?ProfileManufacture">Update Profile</a></li>
        <li><a class="dropdown-item" href="?ViewManufacture&mid=<?php echo $_SESSION['fdRoleUniqueID']; ?>">View Profile</a></li>
            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
        </ul>   
</div> 


<?php endif ?>
<div class="dropdown p-1">
<?php }if ($roleid == 'STKS'){ ?>
<?php  if (isset($_SESSION['fdRoleUniqueID'])) : ?>
            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style>
                <i class="fa fa-user text-primary"></i> <?php echo $_SESSION['fdRoleUniqueID']; ?> </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li><a class="dropdown-item" href="?ProfileStockist">Update Profile</a></li>
            <li><a class="dropdown-item" href="?ViewStockist&sid=<?php echo $_SESSION['fdRoleUniqueID']; ?>">View Profile</a></li>
            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
        </ul>
        </div>

<?php endif ?>
    <div class="dropdown p-1">
    <?php } if ($roleid == 'DSTR') {?>
<?php  if (isset($_SESSION['fdRoleUniqueID'])) : ?>
            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style>
                <i class="fa fa-user text-primary"></i> <?php echo $_SESSION['fdRoleUniqueID']; ?> </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li><a class="dropdown-item" href="?ProfileDistributor">Update Profile</a></li>
            <li><a class="dropdown-item" href="?ViewDistributor&did=<?php echo $_SESSION['fdRoleUniqueID']; ?>">View Profile</a></li>
            <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
        </ul>
    </div>

<?php endif ?>
<div class="dropdown p-1">   
<?php } if ($roleid == 'DELR') {?>
<?php  if (isset($_SESSION['fdRoleUniqueID'])) : ?>
            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style>
                <i class="fa fa-user text-primary"></i> <?php echo $_SESSION['fdRoleUniqueID']; ?> </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="?ProfileDealer">Update Profile</a></li>
                <li><a class="dropdown-item" href="?ViewDealer&dealid=<?php echo $_SESSION['fdRoleUniqueID']; ?>">View Profile</a></li>
                <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                <!--<li><a class="dropdown-item" href="configuration.php">OTA CONFIGURATION</a></li>-->
            </ul>
        </div>
        <?php endif ?>

<div class="dropdown p-1">
<?php } if ($roleid == 'RTLR') {?>
<?php  if (isset($_SESSION['fdRoleUniqueID'])) : ?>
            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style>
                <i class="fa fa-user text-primary"></i> <?php echo $_SESSION['fdRoleUniqueID']; ?> </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="?ProfileRetailer">Update Profile</a></li>
                                    <li><a class="dropdown-item" href="?ViewRetailer&rid=<?php echo $_SESSION['fdRoleUniqueID']; ?>">View Profile</a></li>
                                     <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                                    <!--<li><a class="dropdown-item" href="configuration.php">OTA CONFIGURATION</a></li>-->
                                </ul>
                            <!-- </div> -->
                            <?php endif ?>
                        <?php } ?>
        </div>

            <a href="index.php" class="" href="https://www.mirachinnovations.com/">
                <img src="https://www.mirachinnovations.com/img/logo.png" style="height:40px;" alt="Mirach innovations logo">
            </a>
        </div>
    </nav>
</header>
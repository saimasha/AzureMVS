<?php session_start();
 $_SESSION['fdCustomerID'] = $row['fdCustomerID'];

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
<header class="topbar">
    <nav class="navbar navbar-expand-lg" style="background-color: white;">
        <div class="container-fluid">
            <a href="/medicineverifications/" class="" href="index.html">
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
                      
                        <li><div class="dropdown p-1">
                                <a class="btn"   href="?LocationRetailer" style='color:black;'>
                                Locations                                
                                </a>
                                
                            </div>
                        </li>
                       
                        <li><div class="dropdown p-1">
                                <a class="btn"  href="?CustomerScanDetails" style='color:black;'>
                                Scan Details                                
                                </a>
                                
                            </div>
                        </li>
                        <li><div class="dropdown p-1">
                                <a class="btn" href="Contactus.php" style='color:black;'>
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

            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style>
                <i class="fa fa-user text-primary"></i> <?php echo $_SESSION['fdCustomerID']; ?> </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="?ProfileRetailer">Update Profile</a></li>
                                    <li><a class="dropdown-item" href="?ViewRetailer&rid=<?php echo $_SESSION['fdCustomerID']; ?>">View Profile</a></li>
                                     <li><a class="dropdown-item" href="Customer_logout.php">Log Out</a></li>
                                    <!--<li><a class="dropdown-item" href="configuration.php">OTA CONFIGURATION</a></li>-->
                                </ul>
                            <!-- </div> -->
                       
        </div>

            <a href="index.php" class="" href="https://www.mirachinnovations.com/">
                <img src="https://www.mirachinnovations.com/img/logo.png" style="height:40px;" alt="Mirach innovations logo">
            </a>
        </div>
    </nav>
</header>
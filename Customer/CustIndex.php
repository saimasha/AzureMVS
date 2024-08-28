<?php require "connection.php"; 
session_start();
if(!$_SESSION['fdCustomerID']){

// header("Location: Customer_login.php");
}
?>
<?php require "Custmoer_header.php"; ?>
            <div id="main-wrapper">
<?php require "Customer_navbar.php"; ?>

        <?php require "Customer_Sidebar.php"; ?>
        <div class="page-wrapper">
            <div class="container-fluid">

        <?php 
        // $dash = $_GET['energyMeter'];
        if(isset($_GET['dashboard'])){
            include('dashboard.php');
        }
        elseif(isset($_GET['timeline'])){
            include('timeline.php');
        }
        elseif(isset($_GET['CustomerLocation'])){
            require "CustomerLocation.php"; 
        }
        elseif(isset($_GET['CustomerScanDetails1'])){
            require "CustomerScanDetails.php"; 
        }
        // elseif(isset($_GET['Customer_register'])){
        //     require "Customer_register.php"; 
        // }
        else{
             require "dashboard.php"; 

        }           // if(isset($_GET['active'])){
        //     require "active.php"; 
        // } 
        ?>
            </div>

    </div>
</div>

<?php require "footer.php"; ?>
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
        elseif(isset($_GET['TrackLocation'])){
            include('TrackingLocation.php');
        }
        elseif(isset($_GET['ScanDetails'])){
            include('ScanDetails.php');
        }
        elseif(isset($_GET['qrcode_generator'])){
            include('qrcode_generator.php');
        }
        elseif(isset($_GET['getQr_details'])){
            include('getQr_details.php');
        }
        elseif(isset($_GET['bulkstrip'])){
            include('UpdateBulkStrip.php');
        }
        elseif(isset($_GET['bulkcarton'])){
            include('UpdateBulkCarton.php');
        }
        elseif(isset($_GET['bulkPacket'])){
            include('UpdateBulkPacket.php');
        }
        elseif(isset($_GET['ContactUs'])){
            include('Contactus.php');
        }
        elseif(isset($_GET['testMaterial'])){
            require "testMaterial.php"; 
        }
        elseif(isset($_GET['CreateManufacture'])){
            require "CreateManufacture.php"; 
        }
        
        elseif(isset($_GET['SearchManufacture'])){
            require "SearchManufacture.php"; 
        }
        elseif(isset($_GET['ProfileManufacture'])){
            require "ProfileManufacture.php"; 
        }
        elseif(isset($_GET['LocationManufacture'])){
            require "LocationManufacture.php"; 
        }
        elseif(isset($_GET['UpdateManufacture'])){
            require "UpdateManufacture.php"; 
        }
        elseif(isset($_GET['ListManufacture'])){
            require "ListManufacture.php"; 
        }
        elseif(isset($_GET['CreateStokist'])){
            require "CreateStockist.php"; 
        }
        elseif(isset($_GET['ListStockist'])){
            require "ListStockist.php"; 
        }
        elseif(isset($_GET['SearchStockist'])){
            require "SearchStockist.php"; 
        }
        elseif(isset($_GET['UpdateStockist'])){
            require "UpdateStockist.php"; 
        }
        elseif(isset($_GET['ProfileStockist'])){
            require "ProfileStockist.php"; 
        }
        elseif(isset($_GET['ViewStockist'])){
            require "ViewStockist.php"; 
        }
        elseif(isset($_GET['LocationStockist'])){
            require "LocationStockist.php"; 
        }
        elseif(isset($_GET['ViewManufacture'])){
            require "ViewManufacture.php"; 
        }
        elseif(isset($_GET['CreateDistributor'])){
            require "CreateDistributor.php"; 
        }
        elseif(isset($_GET['ListDistributor'])){
            require "ListDistributor.php"; 
        }
        elseif(isset($_GET['ProfileDistributor'])){
            require "ProfileDistributor.php"; 
        }
        elseif(isset($_GET['SearchDistributor'])){
            require "SearchDistributor.php"; 
        }
        elseif(isset($_GET['UpdateDistributor'])){
            require "UpdateDistributor.php"; 
        }
        elseif(isset($_GET['ViewDistributor'])){
            require "ViewDistributor.php"; 
        }
        elseif(isset($_GET['LocationDistributor'])){
            require "LocationDistributor.php"; 
        }
        elseif(isset($_GET['CreateDealer'])){
            require "CreateDealer.php"; 
        }
        elseif(isset($_GET['ListDealer'])){
            require "ListDealer.php"; 
        }
        elseif(isset($_GET['SearchDealer'])){
            require "SearchDealer.php"; 
        }
        elseif(isset($_GET['UpdateDealer'])){
            require "UpdateDealer.php"; 
        }
        elseif(isset($_GET['ProfileDealer'])){
            require "ProfileDealer.php"; 
        }
        elseif(isset($_GET['ViewDealer'])){
            require "ViewDealer.php"; 
        }
        elseif(isset($_GET['LocationDealer'])){
            require "LocationDealer.php"; 
        }
        elseif(isset($_GET['CreateRetailer'])){
            require "CreateRetailer.php"; 
        }
        elseif(isset($_GET['ListRetailer'])){
            require "ListRetailer.php"; 
        }
        elseif(isset($_GET['SearchRetailer'])){
            require "SearchRetailer.php"; 
        }
        elseif(isset($_GET['ProfileRetailer'])){
            require "ProfileRetailer.php"; 
        }
        elseif(isset($_GET['UpdateRetailer'])){
            require "UpdateRetailer.php"; 
        }
        elseif(isset($_GET['LocationRetailer'])){
            require "LocationRetailer.php"; 
        } 
        elseif(isset($_GET['ViewRetailer'])){
            require "ViewRetailer.php"; 
        } 
        elseif(isset($_GET['ScanDetails'])){
            require "ScanDetails.php"; 
        } 
        elseif(isset($_GET['AddProduct'])){
            require "AddProduct.php"; 
        }
        elseif(isset($_GET['ProductList'])){
            require "ProductList.php"; 
        }
        elseif(isset($_GET['UpdateAddProduct'])){
            require "UpdateAddProduct.php"; 
        }
        elseif(isset($_GET['CustomerScanDetails'])){
            require "CustomerScanDetails.php"; 
        }
        elseif(isset($_GET['CustomerLocation'])){
            require "CustomerLocation.php"; 
        }
        elseif(isset($_GET['ScanIn'])){
            require "ScanIn.php"; 
        }
        elseif(isset($_GET['ScanOut'])){
            require "ScanOut.php"; 
        }
        elseif(isset($_GET['TrackingLocation'])){
            require "TrackingLocation.php"; 
        }
       
        else{
             require "dashboard.php"; 

        }           // if(isset($_GET['active'])){
        //     require "active.php"; 
        // } 
        ?>
            </div>

    </div>
</div>

<?php require "include/footer.php"; ?>
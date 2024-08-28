<?php
session_start();
$roleid = $_SESSION['fdRoleID'];
$RoleUniqueID = $_SESSION['fdRoleUniqueID'];
$medicineid= $_GET['medid'];
date_default_timezone_set('Asia/Kolkata');

$currentDateTime = date('Y-m-d H:i:s');

$date = date('Y-m-d', strtotime($currentDateTime));
$time = date('H:i:s', strtotime($currentDateTime));
$sql1 = "SELECT * FROM tbMedicineMaster WHERE fdMedicineID = '$medicineid' ";
        $result = mysqli_query($conn, $sql1);
        if(!$result){
            die("Query Failed.");
        }
        if (mysqli_num_rows($result) > 0) {
        $rows = mysqli_fetch_assoc($result);
        }

//$manufacture_id= $_GET['mid'];
  if(isset($_POST['updatebtn'])){
    $medid = $_POST['medid'];
    $batchid = $_POST['batchid'];
    $medicinen = $_POST['medicinen'];
    $mid = $_POST['mid'];
    $dosage = $_POST['dosage'];
    $strength = $_POST['strength'];
    $presc = $_POST['presc'];
    $tprice = $_POST['tprice'];
    $tquanitity = $_POST['tquanitity'];	
    $store = $_POST['store'];
    $discrip = $_POST['discrip'];
    $skuid = $_POST['skuid'];
    $skuquan = $_POST['skuquan'] ;
    $skup = $_POST['skup'] ;
    $edate = $_POST['edate'];
    $date=$conn->real_escape_string($date);
    $time=$conn->real_escape_string($time); 
    $newfilename = "";
    if (isset($_FILES["P_image"]) && $_FILES["P_image"]["error"] == 0) {
    $filename = $_FILES["P_image"]["name"];
    $tempname = $_FILES["P_image"]["tmp_name"];

    $filepath_info = pathinfo($filename);

    $filename = $filepath_info['filename'];
    $curentTimeStam = date("m/d/Y H:i:s a", time());
    $newfilename = md5($filename . $curentTimeStam);

    $extension = $filepath_info['extension'];
    $newfilename = $newfilename. '.'.$extension;

    $folder = "image/profile/" . $newfilename;
    move_uploaded_file($tempname, $folder);
    }  
   
    
    
      $sql = "UPDATE tbMedicineMaster SET fdBatchID='$batchid',fdMedicineName='$medicinen',fdManufacturerID='$mid',fdDosageForm='$dosage',fdStrength='$strength',fdPrescriptionRequired='$presc',fdTotalPrice='$tprice',fdTotalQuantityInBatch='$tquanitity',fdStorageConditions='$store',fdDescription='$discrip',fdSKU_ID='$skuid',fdSKU_Quantity='$skuquan',fdSKUPrice='$skup',fdExpiryDate='$edate',fdTime='$time', fdDate='$date',fdProductImage='$newfilename' WHERE fdMedicineID = $medid ";
      if (mysqli_query($conn, $sql)) {
        echo'<script> swal.fire({
            icon: "success",
            title: "Product Updated Successfully!.." 
            });
            </script>';
            //echo"new added";
    }else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }      
    }
     
   

?>
<style>
    #image-preview {
    max-width: 200px;
    max-height: 200px;
    margin-left: 60px;
}
</style>

<div class="row">
<div class="col-12">
    <div class="card"> 
        <div class="card-header" style="background-color:#1e88e566;">
            <h4 class="mb-0 text-white"><strong>UPDATE PRODUCT</strong></h4>
        </div>
    <form class="form-horizontal"  method="POST" enctype="multipart/form-data" >
        <div class="card-body">
            <h5 class="card-title">Product Details</h5>
                <div class="card-body">
                    <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Medicine ID </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="medid" name="medid" value="<?php echo $rows["fdMedicineID"]; ?>" readonly  >
                                        
                                    </div>  
                            </div>
                        </div> 
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Batch ID </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="batchid" name="batchid" value="<?php echo $rows["fdBatchID"]; ?>"   >
                                        
                                    </div>  
                            </div>
                        </div> 
                </div>
                <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Medicine Name </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="medicinen" name="medicinen" value="<?php echo $rows["fdMedicineName"]; ?>" >
                                        
                                    </div>  
                            </div>
                        </div> 
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="nname" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Manufacturer ID </label>

                                <div class="col-sm-8">                      
                                <?php
                                if ($roleid === 'MNFR') {
                                    $query = "SELECT fdManufacturerID FROM tbManufacturerMaster WHERE fdManufacturerID = '$RoleUniqueID'";
                                }
                                elseif ($roleid === 'STKS') {
            $query = "SELECT fdManufacturerID FROM tbStockistMaster WHERE fdStockistID = '$RoleUniqueID'";
        } elseif ($roleid === 'DSTR') {
            $query = "SELECT fdManufacturerID FROM tbDistributorMaster WHERE fdDistributorID = '$RoleUniqueID'";
        }elseif ($roleid === 'DELR') {
            $query = "SELECT fdManufacturerID FROM tbDealerMaster WHERE fdDealerID = '$RoleUniqueID'";
        }elseif ($roleid === 'RTLR') {
            $query = "SELECT fdManufacturerID FROM tbRetailerMaster WHERE fdRetailerID = '$RoleUniqueID'";
        }
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $manufacture_id = $row['fdManufacturerID'];
            echo '<input type="text" class="form-control required-field" id="mid" name="mid" value="' . $manufacture_id . '" readonly>';
        } else {
            echo '<input type="text" class="form-control required-field" id="mid" name="mid" value="No Manufacturer Found" readonly>';
        }
        

            ?> 
                                <span class="error-message"></span>
                                   
                            </div>  
                            
                            </div>
                        </div>

                        </div>

                        <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Dosage Form </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="dosage" name="dosage" value="<?php echo $rows["fdDosageForm"]; ?>" >
                                        
                                    </div>  
                            </div>
                        </div> 
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Strength </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="strength" name="strength" value="<?php echo $rows["fdStrength"]; ?>" >
                                        
                                    </div>  
                            </div>
                        </div> 
                </div>  
                <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Total Price </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="tprice" name="tprice" value="<?php echo $rows["fdTotalPrice"]; ?>" >
                                        
                                    </div>  
                            </div>
                        </div> 
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Total Quantity </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="tquanitity" name="tquanitity" value="<?php echo $rows["fdTotalQuantityInBatch"]; ?>">
                                        
                                    </div>  
                            </div>
                        </div> 
                </div>   
                <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Prescription </label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control " id="presc" name="presc" value="<?php echo $rows["fdPrescriptionRequired"]; ?>" >
                                        
                                    </div>  
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Storage </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="store" name="store" value="<?php echo $rows["fdStorageConditions"]; ?> ">
                                        
                                    </div>  
                            </div>
                        </div>
                    </div>
                    <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">SKU ID </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="skuid" name="skuid" value="<?php echo $rows["fdSKU_ID"]; ?>" >
                                        
                                    </div>  
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">SKU Quantity </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="skuquan" name="skuquan" value="<?php echo $rows["fdSKU_Quantity"]; ?>" >
                                        
                                    </div>  
                            </div>
                        </div>
                    </div>
                        <div class="row"> 
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">SKU Price </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="skup" name="skup" value="<?php echo $rows["fdSKUPrice"]; ?>" >
                                        
                                    </div>  
                            </div>
                        </div>                   
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Expiry Date </label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control " id="edate" name="edate" value="<?php echo $rows["fdExpiryDate"]; ?>" >
                                        
                                    </div>  
                            </div>
                        </div>
            </div>   
        </div> 
        </div>  
        <hr style="margin-top: -25px; margin-bottom: -1px; background: grey;opacity: 0.5;">
        <div class="card-body">
        <h5 class="card-title mb-0">Product Image</h5>
        <div class="card-body">
        <div class="row mb-0">
        <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
    <label for="cono12" class="col-sm-4 text-right control-label col-form-label">User Photo</label>
        <div class="input-group col-sm-8">
        <div class="input-group-prepend">
                <input type="file" id="P_image" name="P_image" class="form-control" onchange="displayUserPhoto(this)">
                <span class="input-group-text">Upload</span>
            </div>

            <div class="col-sm-4">
                <!-- Display the user photo from the database -->
                <img id="userPhoto" src="image/profile/<?php echo $rows["fdProfileImage"]; ?>" width="100" align="right" style="float: left;margin-top:-40px; margin-left:410%;">
            </div>
        </div>
    </div>
</div>
</div>
<script>
function displayUserPhoto(input) {
    var reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById('userPhoto').src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
</div>
</div>
        <hr style="margin-top: -15px; margin-bottom: -4px; background: grey; opacity: 0.5;">
        <div class="card-body">
            <h5 class="card-title">Description</h5>
            <div class="card-body">
                <div class="row">                            
                    <div class="col-sm-12 col-lg-12">
                        <div class="form-group row">
                            <label for="discrip" class="col-sm-2 text-right control-label col-form-label">Description</label>
                            <div class="col-sm-8">
                            <input type="text" class= "form-control" id= "discrip" name= "discrip" value= "<?php echo $rows["fdDescription"]; ?>">                                    
                            </div>                                    
                        </div>
                    </div>
                </div>                              
        <div class="card-body">
            <div class="form-group mb-0 d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-success waves-effect waves-light" name="updatebtn" id="updatebtn">Update</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
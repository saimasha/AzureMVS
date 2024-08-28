<?php
date_default_timezone_set('Asia/Kolkata');
$currentTime = date('H:i:s');

session_start();
$RoleUniqueID = $_SESSION['fdRoleUniqueID'];
//$manufacture_id= $_GET['mid'];
  if(isset($_POST['savebtn'])){
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
    $currentTime = date('H:i:s');
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
   
    
    
      $sql = "INSERT INTO tbMedicineMaster(fdMedicineID,fdBatchID,fdMedicineName,fdManufacturerID,fdDosageForm,fdStrength,fdPrescriptionRequired,fdTotalPrice,fdTotalQuantityInBatch,fdStorageConditions,fdDescription,fdSKU_ID,fdSKU_Quantity,fdSKUPrice,fdExpiryDate,fdTime, fdDate,fdProductImage) VALUES ( '$medid', '$batchid', '$medicinen', '$mid', '$dosage', '$strength', '$presc', '$tprice', '$tquanitity', '$store',  '$discrip', '$skuid', '$skuquan', '$skup', '$edate', '$currentTime', CURDATE(),'$newfilename')";
      if (mysqli_query($conn, $sql)) {
        echo'<script> swal.fire({
            icon: "success",
            title: "Product Added Successfully!.." 
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
            <h4 class="mb-0 text-white"><strong>ADD PRODUCT</strong></h4>
        </div>
    <form class="form-horizontal"  method="POST" enctype="multipart/form-data" >
        <div class="card-body">
            <h5 class="card-title">PRODUCT DETAILS</h5>
                <div class="card-body">
                    <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Medicine ID </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="medid" name="medid" placeholder="Medicine ID Here" >
                                        
                                    </div>  
                            </div>
                        </div> 
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Batch ID </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="batchid" name="batchid" placeholder="Batch ID Here" >
                                        
                                    </div>  
                            </div>
                        </div> 
                </div>
                <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Medicine Name </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="medicinen" name="medicinen" placeholder="Medicine Name Here" >
                                        
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
                                        <input type="text" class="form-control " id="dosage" name="dosage" placeholder="Dosage Form Here" >
                                        
                                    </div>  
                            </div>
                        </div> 
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Strength </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="strength" name="strength" placeholder="Strength Here" >
                                        
                                    </div>  
                            </div>
                        </div> 
                </div>  
                <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Total Price </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="tprice" name="tprice" placeholder="Total Price Here" >
                                        
                                    </div>  
                            </div>
                        </div> 
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Total Quantity </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="tquanitity" name="tquanitity" placeholder="Total Quantity in batch Here" >
                                        
                                    </div>  
                            </div>
                        </div> 
                </div>   
                <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Prescription </label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control " id="presc" name="presc" placeholder="Prescription Required Here" >
                                        
                                    </div>  
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Storage </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="store" name="store" placeholder="Storage Condition Here" >
                                        
                                    </div>  
                            </div>
                        </div>
                    </div>
                    <div class="row">                    
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">SKU ID </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="skuid" name="skuid" placeholder="SKU ID Required Here" >
                                        
                                    </div>  
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">SKU Quantity </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="skuquan" name="skuquan" placeholder="SKU Quantity Here" >
                                        
                                    </div>  
                            </div>
                        </div>
                    </div>
                        <div class="row"> 
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">SKU Price </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " id="skup" name="skup" placeholder="SKU Price Here" >
                                        
                                    </div>  
                            </div>
                        </div>                   
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Expiry Date </label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control " id="edate" name="edate" placeholder="Expiry Date Here" >
                                        
                                    </div>  
                            </div>
                        </div>
            </div>   
        </div> 
        </div>  
        <hr style="margin-top: -25px; margin-bottom: -1px; background: grey;opacity: 0.5;">
        <div class="card-body">
        <h5 class="card-title mb-0">PRODUCT IMAGE</h5>
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
            <h5 class="card-title">DESCRIPTION</h5>
            <div class="card-body">
                <div class="row">                            
                    <div class="col-sm-12 col-lg-12">
                        <div class="form-group row">
                            <label for="discrip" class="col-sm-2 text-right control-label col-form-label">Description</label>
                            <div class="col-sm-8">
                            <textarea name="discrip" id="discrip" class="form-control"  placeholder="Discription Here"></textarea>                                    
                            </div>                                    
                        </div>
                    </div>
                </div>                              
        <div class="card-body">
            <div class="form-group mb-0 d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-success waves-effect waves-light" name="savebtn" id="savebtn">Submit</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
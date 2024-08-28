<style>
label.control-label {
  white-space: nowrap;
 
}
input.form-control-plaintext{
    color: #b2b9bf; 
}
</style>
<?php
//   if(isset($_POST['view'])){
//     $mid=$_POST['mid'];
//       $mname=$_POST['mname'];
//       $iid=$_POST['iid'];
//       $gid=$_POST['gid'];
//       $hname=$_POST['hname'];
//       $haddress1=$_POST['haddress1'];
//       $haddress2=$_POST['haddress2'];
//       $hcity=$_POST['hcity'];
//       $hstate=$_POST['hstate'];
//       $hcountry=$_POST['hcountry'];
//       $hpostcode=$_POST['hpostcode'];
//       $hphone=$_POST['hphone'];
//       $hemail=$_POST['hemail'];
//       $haname=$_POST['haname'];
//       $haposition=$_POST['haposition'];
//       $haphonenumber=$_POST['haphonenumber'];
//       $haemail=$_POST['haemail'];
//       $mlatitude=$_POST['mlatitude'];
//       $mlongitude=$_POST['mlongitude'];      
//       $cp1name=$_POST['cp1name'];
//       $cp1phonenumber=$_POST['cp1phonenumber'];
//       $cp1email=$_POST['cp1email'];
//       $cp2name=$_POST['cp2name'];
//       $cp2phonenumber=$_POST['cp2phonenumber'];
//       $cp2email=$_POST['cp2email'];
//       $mweb1=$_POST['mweb1'];
//       $mlatitude=$_POST['mlatitude'];
//       $mlongitude=$_POST['mlongitude'];    
//       $mnotes=$_POST['mnotes'];
//       $date=$conn->real_escape_string($date);
//       $time=$conn->real_escape_string($time); 
   

  if (isset($_GET['mid'])) {
    $manufacturer_id = $_GET['mid'];
    
    // Retrieve manufacturer data based on the manufacturer_id
    $sql = "SELECT * FROM tbManufacturerMaster WHERE fdManufacturerID = '$manufacturer_id' ";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die("Query Failed.");
    }
    if (mysqli_num_rows($result) > 0) {
    $rows = mysqli_fetch_assoc($result);
    }
}
  
?>
<!-- <div class="container-fluid"> -->
            
<div class="row">
<div class="col-lg-12">
    <div class="card">
        <div class="card-header" style="background-color:#1e88e566;">
            <h4 class="mb-0 text-white">Manufacturer Details</h4>
        </div>
        <form class="form-horizontal"  method="POST">
<div class="card-body">
<h4 class="card-title">Manufacturer User</h4>
<div class="card-body">
<div class="row">     
    <div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="fname3" class="col-sm-4 text-right control-label col-form-label">Manufacturer Name :</label>
        <div class="col-sm-8">
        <input type="text" class="form-control-plaintext" id="mname" name="mname" value="<?php echo $rows["fdManufacturerName"]; ?>" readonly>
        </div>
    </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
        <label for="fname3" class="col-sm-4 text-right control-label col-form-label">Manufacturer ID :</label>
        <div class="col-sm-8">
        <input type="text" class="form-control-plaintext" id="mid" name="mid"  value="<?php echo $rows["fdManufacturerID"]; ?>" readonly> 
        </div>                                   
        </div>
        </div> 
</div>

<div class="row">
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="uname1" class="col-sm-4 text-right control-label col-form-label">Industry ID :</label>
        <div class="col-sm-8">
        <?php
        $industryId = $rows["fdIndustryID"];
        $industryQuery = "SELECT fdIndustryName FROM tbIndustryMaster WHERE fdSlno = '$industryId'";
        $industryResult = mysqli_query($conn, $industryQuery);
        $industryRow = mysqli_fetch_assoc($industryResult);
        $industryName = $industryRow["fdIndustryName"];
        ?>
        <input type="text" class="form-control-plaintext" id="iid" name="iid" value="<?php echo $industryName; ?>" readonly> 
        </div>                                                
    </div>
</div>
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="nname" class="col-sm-4 text-right control-label col-form-label">Group ID :</label>
        <div class="col-sm-8">
        <?php
       
        $groupId =  $rows["fdGroupID"];
        $groupQuery = "SELECT fdGroupName FROM tbGroupMaster WHERE fdGroupID = $groupId";
        $groupResult = mysqli_query($conn, $groupQuery);
        $groupRow = mysqli_fetch_assoc($groupResult);
        $groupName =$groupRow["fdGroupName"];
        ?>
        <input type="text" class="form-control-plaintext" id="gid" name="gid"  value="<?php echo $groupName; ?>" readonly>
        </div>                                    
    </div>
</div>
</div>
</div>
</div>
        <!-- </div> -->
<hr style="margin-top:-25px; margin-bottom:-4px; background: grey;opacity: 0.5;">            
<div class="card-body">
<h4 class="card-title">Head Office Details</h4>
<div class="card-body">
<div class="row">
    <div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="fname2" class="col-sm-4 text-right control-label col-form-label ">Head Office Name :</label>
        <div class="col-sm-8">
        <input type="text" class="form-control-plaintext" id="hname" name="hname" value="<?php echo $rows["fdHeadOfficeName"]; ?>" readonly>
        </div>                                   
    </div>
    </div>
    <div class="col-sm-12 col-lg-6">
    <div class="form-group row ">
        <label for="web1" class="col-sm-4 text-right control-label col-form-label">Website :</label>
        <div class="col-sm-8">
        <input type="text" class="form-control-plaintext" id="mweb1" name="mweb1" value="<?php echo $rows["fdWebsiteURL"]; ?>" readonly> 
        </div>                                  
    </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number :</label>
        <div class="col-sm-8">
        <input type="tel" class="form-control-plaintext" name="hphone" id="hphone" pattern="[0-9]{10}" value="<?php echo $rows["fdHeadOfficePhoneNumber"]; ?>"  readonly>
        </div>                                   
    </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email:</label>
            <div class="col-sm-8">
            <input type="email" class="form-control-plaintext" id="hemail" name="hemail" value="<?php echo $rows["fdHeadOfficeEmail"]; ?>" readonly>
            </div>                                   
        </div>
    </div>
</div>                
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label">Country :</label>
            <div class="col-sm-8">
            <?php
    
    $selectedCountryId = $rows["fdHeadOfficeCountry"];
    require_once "include/connection.php";
    $result = mysqli_query($conn, "SELECT id, name FROM tbCountries WHERE id = '$selectedCountryId'");
    $countryRow = mysqli_fetch_assoc($result);
?>
    <input type="text" class="form-control-plaintext" value="<?php echo $countryRow['name']; ?>" readonly>
           
            </div>                                                   
        </div>
    </div>                     
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label">State :</label>
            <div class="col-sm-8">
            <?php 
    $selectedStateId = $rows["fdHeadOfficeState"];
    require_once "include/connection.php";
    $result = mysqli_query($conn, "SELECT id, name FROM tbStates WHERE id = '$selectedStateId'");
    $stateRow = mysqli_fetch_assoc($result);
?>
        <input type="text" class="form-control-plaintext" value="<?php echo $stateRow['name']; ?>" readonly>
            
            </div>                                                   
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label">City :</label>
            <div class="col-sm-8">
            <?php 
    $selectedStateId = $rows["fdHeadOfficeCity"];
    require_once "include/connection.php";
    $result = mysqli_query($conn, "SELECT id, name FROM tbCities WHERE id = '$selectedStateId'");
    $cityRow = mysqli_fetch_assoc($result);
?>
        <input type="text" class="form-control-plaintext" value="<?php echo $cityRow['name']; ?>" readonly>
            
            </div>                                                    
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label">Post Code :</label>
            <div class="col-sm-8">
            <input type="text" class="form-control-plaintext" id="hpostcode" name="hpostcode" value="<?php echo $rows["fdHeadOfficePostalCode"]; ?>" readonly> 
            </div>                                                   
        </div>
    </div>                                                             
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label class="col-sm-4 text-right control-label col-form-label">Address 1 :</label>
        <div class="col-sm-8">
        <input type="text" class="form-control-plaintext" id="haddress1" name="haddress1" value="<?php echo $rows["fdHeadOfficeAddressLine1"]; ?>" readonly>
        </div>                                                    
    </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label">Address 2 :</label>
            <div class="col-sm-8">
            <input type="text" class="form-control-plaintext" id="haddress2" name="haddress2"  value="<?php echo $rows["fdHeadOfficeAddressLine2"]; ?>" readonly>
            </div>                                                    
        </div>
    </div>
</div>                                             
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label">Latitude :</label>
            <div class="col-sm-8">
            <input type="text" class="form-control-plaintext" id="mlatitude" name="mlatitude" value="<?php echo $rows["fdManufacturerLat"]; ?>" readonly>
            </div>                                                   
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label">Longitude :</label>
            <div class="col-sm-8">
            <input type="text" class="form-control-plaintext" id="mlongitude" name="mlongitude" value="<?php echo $rows["fdManufacturerLong"]; ?>" readonly>
            </div>                                                    
        </div>
    </div>                                            
</div>                                        
        
</div>
</div>
<hr style="margin-top: -25px; margin-bottom: -1px; background: grey;opacity: 0.5;">
<div class="card-body">
    <h4 class="card-title">Profile Photo</h4>            
    <div class="card-body"> 
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="photo" class="col-sm-4 text-right control-label col-form-label">User Photo :</label>
            <div class="col-sm-8">
            <!-- <img id="userphoto" src="image/profile/<?php echo $rows["fdProfileImage"]; ?>" style="width:50%;" readonly>  -->
            <?php if (!empty($rows["fdProfileImage"])) : ?>
                <img id="userphoto" src="image/profile/<?php echo $rows["fdProfileImage"]; ?>" style="width:50%;">
            <?php else : ?>
                <label for="photo" style="margin-top: 7px;">Profile image Not Found </label>
            <?php endif; ?>
        
            </div>                                   
        </div>
    </div>
</div>
    </div>
</div>
<hr style="margin-top: -25px; margin-bottom: -1px; background: grey;opacity: 0.5;">

<div class="card-body">
    <h4 class="card-title">Highest Authority Details</h4>            
    <div class="card-body">                                        
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="form-group row">
                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Name :</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control-plaintext" id="haname"  name="haname" value="<?php echo $rows["fdHighestAuthorityName"]; ?>" readonly>
                    </div>                               
                    </div>
                    </div>
                        <div class="col-sm-12 col-lg-6">
                        <div class="form-group row">
                        <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Position :</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control-plaintext" name="haposition" id="haposition" value="<?php echo $rows["fdHighestAuthorityPosition"]; ?>" readonly>
                    </div>                                
            </div>
        </div>
    </div>
<div class="row">                            
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="email2" class="col-sm-4 text-right control-label col-form-label"> Phone Number :</label>
        <div class="col-sm-8">
        <input type="tel" class="form-control-plaintext" id="haphonenumber" name="haphonenumber" pattern="[0-9]{10}" value="<?php echo $rows["fdHighestAuthorityPhoneNumber"]; ?>" readonly>
        </div>                                   
    </div>
</div>
<div class="col-sm-12 col-lg-6">
    <div class="form-group row">
        <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email :</label>
        <div class="col-sm-8">
        <input type="email" class="form-control-plaintext" id="haemail" name="haemail" value="<?php echo $rows["fdHighestAuthorityEmail"]; ?>" readonly>
        </div>                                   
    </div>
</div>                          

</div>                          

</div>
</div>
<hr style="margin-top: -25px; margin-bottom: -1px; background: grey;">
<div class="card-body">
<h4 class="card-title">Contact Person1 Details</h4>
<div class="card-body">                        
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Person1 Name :</label>
            <div class="col-sm-8">
            <input type="text" class="form-control-plaintext" id="cp1name"  name="cp1name" value="<?php echo $rows["fdContactPerson1Name"]; ?>" readonly>
            </div>                                
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number :</label>
            <div class="col-sm-8">
            <input type="tel" class="form-control-plaintext" name="cp1phonenumber" id="cp1phonenumber" pattern="[0-9]{10}" value="<?php echo $rows["fdContactPerson1PhoneNumber"]; ?>" readonly>
            </div>                               
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email :</label>
            <div class="col-sm-8">
            <input type="email" class="form-control-plaintext" id="cp1email" name="cp1email" value="<?php echo $rows["fdContactPerson1Email"]; ?>" readonly> 
            </div>                                   
        </div>
    </div>
</div>
</div>
</div>
<hr style="margin-top: -25px; margin-bottom: -1px; background: grey;opacity: 0.5;">
<div class="card-body">
    <h4 class="card-title">Contact Person2 Details</h4>
    <div class="card-body">    
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="form-group row">
                    <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Person2 Name :</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control-plaintext" id="cp2name"  name="cp2name" value="<?php echo $rows["fdContactPerson2Name"]; ?>" readonly>
                    </div>                                
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="form-group row">
                    <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number :</label>
                    <div class="col-sm-8">
                    <input type="tel" class="form-control-plaintext" name="cp2phonenumber" id="cp2phonenumber" pattern="[0-9]{10}" value="<?php echo $rows["fdContactPerson2PhoneNumber"]; ?>" readonly>
                    </div>                                
                </div>
            </div>
        </div>
<div class="row">                            
    <div class="col-sm-12 col-lg-6">
        <div class="form-group row">
            <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email :</label>
            <div class="col-sm-8">
            <input type="email" class="form-control-plaintext" id="cp2email" name="cp2email" value="<?php echo $rows["fdContactPerson2Email"]; ?>" readonly>
            </div>                                    
        </div>
    </div>
</div>                                        
</div>
</div>
<hr style="margin-top:-34px; margin-bottom:-3px; background: grey;opacity: 0.5;">
<div class="card-body">
    <h4 class="card-title">Notes</h4>
    <div class="card-body">
    <div class="row">                            
        <div class="col-sm-12 col-lg-6">
            <div class="form-group row">
                <label for="email2" class="col-sm-3 text-right control-label col-form-label">Notes :</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control-plaintext" id="mnotes" name="mnotes" value="<?php echo $rows["fdNotes"]; ?>" readonly>                                    
                    </div>
                </div>
        </div>
    </div>
</div>   
</div> 
<div class="card-body">
<div class="form-group  mr-5 ml-5 pb-5">
        <a href="?dashboard" class="btn waves-effect waves-light btn-info"><i class="fas fa-arrow-left">&nbsp;&nbsp;Go Back</i></a>
    </div>                               
<!-- <div class="card-body">
    <div class="form-group mb-0 d-flex justify-content-between align-items-center">
    <button href="ListManufacture.php" type="submit" class="btn btn-danger waves-effect waves-light">Cancel</button>
    <button  type="submit" class="btn btn-warning waves-effect waves-light" name="updatebtn" id="updatebtn">Update</button>
    </div>
</div> -->
</form>


</div>
</div>
</div>


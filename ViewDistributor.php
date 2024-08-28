
<?php
session_start();

$RoleUniqueID = $_SESSION['fdRoleUniqueID'];

if(isset($_GET['did'])){
$did = $_GET['did'];
$sql = "SELECT * FROM tbDistributorMaster WHERE fdDistributorID = '$did' ";
$result = mysqli_query($conn, $sql);
if (!$result){
  die("qurey Failed");
}
if (mysqli_num_rows($result) > 0) {
  $rows = mysqli_fetch_assoc($result);   
}
}
// session_start();

// $RoleUniqueID = $_SESSION['fdRoleUniqueID'];

// if(isset($_GET['did'])){
//     $did = $_GET['did'];
//     $condition = "fdDistributorID = '$did'";
// } elseif(isset($RoleUniqueID)) {
//     $condition = "fdRoleUniqueID = '$RoleUniqueID'";
// } else {
    
//     die("Invalid parameters");
// }

// $sql = "SELECT * FROM tbDistributorMaster WHERE $condition";
// $result = mysqli_query($conn, $sql);

// if (!$result) {
//     die("Query Failed: " . mysqli_error($conn));
// }

// if (mysqli_num_rows($result) > 0) {
//     $rows = mysqli_fetch_assoc($result);
// } else {
//     // Handle the case when no records are found
//     echo "No records found";
// }
?>
<style>
label.control-label {
  white-space: nowrap;
}
hr.hr1{

   margin-bottom: 0px;
  
    margin-top: -30px;
   background: grey;
   opacity: 0.5;
}
input.form-control-plaintext{
    color:#b2b9bf; 
}

</style>

<div class="row">
    <div class="col-lg-12">
            <div class="card">
                       <div class="card-header" style="background-color:#1e88e566;">
                                <h4 class="mb-0 text-white">Distributor Details</h4>
                            </div>
                            <form class="form-horizontal">
                                <div class="form-body">
                                    <div class="card-body ">
                                         <h5 class="card-title mb-0"><b>Distributor User</b></h5>
                                         <div class="card-body">
                                <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="fname3" class="col-sm-4 text-right  control-label col-form-label">Distributor Name:</label>
                                                <div class="col-sm-8">
                                                <input type="text" value="<?php echo $rows["fdDistributorName"]; ?>" class="form-control-plaintext" id="DName" name="DName" readonly>
                                                </div>
                                            </div>
                                     </div>
                                 <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Manufacture ID:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext" id="Mid" name="Mid" value="<?php echo $rows["fdManufacturerID"]; ?>"readonly>         
                                    </div>                                  
                                </div>
                            </div>
                                <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Distributor ID:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext" id="Did" name="Did" value="<?php echo $rows["fdDistributorID"]; ?>" readonly>  
                                    </div>                                         
                                  </div>
                              </div>
                         <!-- <div class="row">  -->
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="uname1" class="col-sm-4 text-right control-label col-form-label">Hierarchy Level:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext" id="HierarchyLevel" name="HierarchyLevel" value="<?php echo $rows["fdHierarchyLevel"]; ?>"readonly> 
                                    </div>                                                       
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Stockist ID:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control-plaintext" id="sid" name="sid" value="<?php echo $rows["fdStockistID"]; ?>" readonly>

                                        </div>                                    
                                </div>
                            </div>
                            <!-- <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Upload Image<code>*</code></label>
                                            <div class="input-group col-sm-8">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                            </div>   
                    </div>
                  </div>    -->
                 </div>    
                 <br> 
                    <hr class=hr1>      
                    <!-- <hr> -->
                    <div class="card-body"> 
                    <h5 class="card-title mb-0"><b>Head Office Details</b></h5>
                    <div class="card-body">
                     <div class="row">
                    <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="fname2" class="col-sm-4 text-right control-label col-form-label ">Head Office Name:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext" id="HOName" name="HOName" value="<?php echo $rows["fdHeadOfficeName"]; ?>" readonly>       
                                    </div>                                   
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row ">
                                    <label for="web1" class="col-sm-4 text-right control-label col-form-label">Website:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext" id="HOWeb" name="HOWeb" value="<?php echo $rows["fdWebsiteURL"]; ?>" readonly>     
                                    </div>                                     
                                </div>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number:</label>
                                    <div class="col-sm-8">
                                    <input type="tel" class="form-control-plaintext" name="HOPhone" id="HOPhone" value="<?php echo $rows["fdHeadOfficePhoneNumber"]; ?>" pattern="[0-9]{10}" readonly>  
                                    </div>                                        
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email:</label>
                                <div class="col-sm-8">
                                <input type="email" class="form-control-plaintext" id="HOEemail" name="HOEemail" value="<?php echo $rows["fdHeadOfficeEmail"]; ?>" readonly>   
                                </div>                                       
                                </div>
                            </div>
                        </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label">Country:</label>
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
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label">State:</label>
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
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 text-right control-label col-form-label">City:</label>
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
                      
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 text-right control-label col-form-label">Post Code:</label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control-plaintext" id="HOPostcode" name="HOPostcode" value="<?php echo $rows["fdHeadOfficePostalCode"]; ?>" readonly>     
                                </div>                                                      
                            </div>
                        </div>                                            
                                                          
                    </div>      
                    <div class="row">   
                            <div class="col-md-6">
                                <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label">Address 1:</label>
                                        <div class="col-sm-8">
                                         <input type="text" class="form-control-plaintext" id="HOAddress1" name="HOAddress1"  value="<?php echo $rows["fdHeadOfficeAddressLine1"]; ?>"readonly>     
                                         </div>                                                      
                                </div>
                            </div>
                         <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 text-right control-label col-form-label">Address 2:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext" id="haddress2" name="HOAddress2" value="<?php echo $rows["fdHeadOfficeAddressLine2"]; ?>" readonly>                                                    
                                    </div>       
                                    </div>
                          </div>
                    </div>                                
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 text-right control-label col-form-label">Location Latitude:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext" id="DLlatitude" name="DLlatitude"  value="<?php echo $rows["fdDistrLat"]; ?>" readonly>    
                                    </div>                                                      
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 text-right control-label col-form-label">Location Longitude:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext" id="DLlongitude" name="DLlongitude" value="<?php echo $rows["fdDistrLong"]; ?>" readonly>     
                                    </div>                                                      
                                </div>
                            </div>                                            
                            </div>                                        
                            <!-- <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="cono12" class="control-label col-form-label">Ware House ID</label>
                                    <input type="text" class="form-control" name="whid" id="whid" placeholder="Ware House ID Here">                                
                                </div>
                            </div> -->
                                 </div>
                    </div>
            <hr class="hr1">
            <div class="card-body">
                <h4 class="card-title mb-0">Profile Picture</h4>
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
                    <hr class=hr1>
                    <div class="card-body">
                    <h5 class="card-title mb-0"><b>Owner Details</b></h5>                 
                                    
                    <div class="card-body">                                        
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Owner Name:</label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control-plaintext" id="OName"  name="OName" value="<?php echo $rows["fdOwnerName"]; ?>"  readonly>     
                                </div>                                 
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number:</label>
                                <div class="col-sm-8">
                                <input type="tel" pattern="[0-9]{10}" class="form-control-plaintext" name="OPhonenumber" id="OPhonenumber" value="<?php echo $rows["fdOwnerPhoneNumber"]; ?>" readonly>        
                                </div>                               
                            </div>
                        </div>
                    </div>
                    <div class="row">                            
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email:</label>
                                <div class="col-sm-8">
                                <input type="email" class="form-control-plaintext" id="OEmail" name="OEmail" value="<?php echo $rows["fdOwnerEmail"]; ?>"  readonly>      
                                </div>                                    
                                </div>
                            </div>
                        </div>                                    
            
                                    </div>
                    </div>
                    <hr class=hr1>
                    <div class="card-body">
                    <h5 class="card-title mb-0"><b>Contact Person1 Details</b></h5>
                     <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Person1 Name:</label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control-plaintext" id="CP1Name"  name="CP1Name" value="<?php echo $rows["fdContactPerson1Name"]; ?>" readonly>       
                                </div>                                
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number:</label>
                                <div class="col-sm-8">
                                <input type="tel" pattern="[0-9]{10}" class="form-control-plaintext" name="CP1Phonenumber" id="CP1Phonenumber"  value="<?php echo $rows["fdContactPerson1PhoneNumber"]; ?>" readonly>                        
                                </div>              
                            </div>
                        </div>
                    </div>

                    <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email:</label>
                                <div class="col-sm-8">
                                <input type="email" class="form-control-plaintext" id="CP1Email" name="CP1Email" value="<?php echo $rows["fdContactPerson1Email"]; ?>" readonly>    
                                </div>                                       
                                </div>
                            </div>
                    </div>
              </div>
                    </div>
                    <hr class=hr1>
                    
                    <div class="card-body">
                    <h5 class="card-title mb-0"><b>Contact Person2 Details</b></h5>
                     <div class="card-body">
                                        
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row" >
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Person2 Name:</label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control-plaintext" id="CP2Name"  name="CP2Name" value="<?php echo $rows["fdContactPerson2Name"]; ?>" readonly>   
                                </div>                                    
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number:</label>
                                <div class="col-sm-8">
                                <input type="tel" pattern="[0-9]{10}" class="form-control-plaintext" name="CP2Phonenumber" id="CP2Phonenumber" value="<?php echo $rows["fdContactPerson2PhoneNumber"]; ?>" readonly>       
                                </div>                               
                            </div>
                        </div>
                    </div>
                    <div class="row">                            
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Emai:</label>
                                <div class="col-sm-8">
                                <input type="email" class="form-control-plaintext" id="CP2Email" name="CP2Email" value="<?php echo $rows["fdContactPerson2Email"]; ?>"readonly>    
                                </div>                                       
                                </div>
                            </div>
                 </div>                    
                    </div>
                    </div>
                        <hr class=hr1>
                        <h5 class="card-title ml-4 pt-3"><b>Notes</b></h5>
                            <div class="card-body">
                                <div class="row">                            
                                <div class="col-sm-12 col-lg-12">
                                <div class="form-group row">
                                <label for="text" class="col-sm-2 text-right control-label col-form-label ">Notes:</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" id="Notes" name="Notes" value="<?php echo $rows["fdNotes"]; ?>" readonly>    
                                </div>                                
                                </div>
                            </div>
                           </div>
                            </div>
                     <div class="card-body">
                    <div class="form-group  mr-5 ml-5 ">
                         <a href="?dashboard" class="btn waves-effect waves-light btn-info"><i class="fas fa-arrow-left">&nbsp;&nbsp;Go Back</i></a>
                     </div>
                      </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

 


    



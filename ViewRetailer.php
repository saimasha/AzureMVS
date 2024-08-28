<style>
label.control-label {
  white-space: nowrap;
 
}
input.form-control-plaintext{
    color:#b2b9bf; 
}

</style>
<?php

if(isset($_GET['rid'])){
    $rid = $_GET['rid'];

$query = "SELECT * FROM tbRetailerMaster WHERE fdRetailerID = '$rid'";
$result = mysqli_query($conn, $query);
if(!$result){
    die("Query failed");
}
if(mysqli_num_rows($result)>0){
    $rows= mysqli_fetch_assoc($result);
}
}

?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="background-color:#1e88e566;">
            <h4 class="card-title mb-0 text-white"><strong> RETAILER DETAILS</strong></h4>
            </div>
            <!-- <hr style="margin-top: -5px; margin-bottom: -4px; background: grey; opacity:0.5;"> -->
                <form class="form-horizontal"  method="POST">
                    <div class="card-body">
                        <h4 class="card-title">Retailer User</h4>
                        <div class="row">                    
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="fname3" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Retailer Name :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class= "form-control-plaintext" id= "sname" name= "sname" value= "<?php echo $rows['fdRetailerName'];?>" readonly>
                                        </div>  
                                </div>
                            </div> 
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Retailer ID :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class= "form-control-plaintext" id= "rid" name= "rid" value= "<?php echo $rows['fdRetailerID'];?>" readonly>
                                        </div>                                    
                                </div>
                            </div>

                        </div>
                            <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Stockist ID :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class= "form-control-plaintext" id= "sid" name= "sid" value= "<?php echo $rows['fdStockistID'];?>" readonly>
                                        </div>                                    
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Distributor ID :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class= "form-control-plaintext" id= "disid" name= "disid" value= "<?php echo $rows['fdDistributorID'];?>" readonly>
                                        </div>                                    
                                </div>
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Dealer ID :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class= "form-control-plaintext" id= "deaid" name= "deaid" value= "<?php echo $rows['fdDealerID'];?>" readonly>
                                        </div>                                    
                                </div>
                            </div>
                        
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Manufacturer ID :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class= "form-control-plaintext" id= "mid" name= "mid" value= "<?php echo $rows['fdManufacturerID'];?>" readonly>
                                        </div>                                    
                                </div>
                            </div>
                            </div>
                    </div>
                    <hr style="margin-top: -15px; margin-bottom : -1px; background: grey; opacity: 0.5;">
                    
                    <div class="card-body">
                    <h4 class="card-title">Head Office Details</h4>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="fname2" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Head Office Name :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class= "form-control-plaintext" id= "hname" name= "hname" 
                                        value= "<?php echo $rows['fdHeadOfficeName'];?>" readonly>
                                        </div>                                   
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row ">
                                    <label for="web1" class="col-sm-4 text-right control-label col-form-label">Website :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class= "form-control-plaintext" id= "hweb1" name= "hweb1" value= "<?php echo $rows['fdWebsiteURL'];?>" readonly>
                                    </div>                                   
                                </div>
                            </div>
                            </div>
                       
                            <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="cono12" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Phone Number :</label>
                                    <div class="col-sm-8">
                                        <input type="Tel" class="form-control-plaintext" name= "hphone" id= "hphone" 
                                        value= "<?php echo $rows['fdHeadOfficePhoneNumber'];?>" readonly>
                                        </div>                                   
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email :</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control-plaintext" id= "hemail" name= "hemail" 
                                        value= "<?php echo $rows['fdHeadOfficeEmail'];?>" readonly>
                                        </div>                                   
                                </div>
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-sm-4">Country :</label>
                                        <div class="col-sm-8">
                                        <?php
                                    $selectedCountryId = $rows["fdHeadOfficeCountry"];
                                    require_once "include/connection.php";
                                    $result = mysqli_query($conn, "SELECT id, name FROM tbCountries WHERE id = '$selectedCountryId'");
                                    $countryRow = mysqli_fetch_assoc($result);
                                    ?>
                                    <input type="text" class="form-control-plaintext" value="<?php echo $countryRow['name']; ?>">
                                            </select>     
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
                                            <input type="text" class= "form-control-plaintext" id= "hpostcode" name= "hpostcode" value="<?php echo $rows['fdHeadOfficePostalCode'];?>" readonly>
                                 </div>                                                    
                                </div>
                                </div>                 
                            </div>
                                
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label">Address 1 :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control-plaintext" id= "haddress1" name= "haddress1" value= "<?php echo $rows['fdHeadOfficeAddressLine1'];?>" readonly>
                                            </div>                                                    
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label">Address 2 :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control-plaintext" id= "haddress2" name= "haddress2"  value= "<?php echo $rows['fdHeadOfficeAddressLine2'];?>" readonly>
                                 </div>                                                    
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Latitude :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class= "form-control-plaintext" id= "slatitude" name= "slatitude" value= "<?php echo $rows['fdRetailerLat'];?>" readonly>
                                 </div>                                                   
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Longitude :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class= "form-control-plaintext" id= "slangitude" name= "slagitude" value= "<?php echo $rows['fdRetailerLong'];?>" readonly>
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
                                    <!-- <img id="userPhoto" src="image/profile/<?php echo $rows["fdProfileImage"]; ?>" style="width:50%;" readonly>  -->
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
                    <hr style="margin-top : -30px; margin-bottom : -4px; background: grey; opacity: 0.5;">
                    <div class="card-body">
                    <h4 class="card-title">Owner Details</h4>                 
                                    
                    <div class="card-body">                                        
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Owner Name :</label>
                                <div class="col-sm-8">
                                    <input type="text" class= "form-control-plaintext" id= "oname"  name= "oname" value= "<?php echo $rows['fdOwnerName'];?>" readonly>
                                    </div>                               
                            </div>
                        </div>  
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Phone Number :</label>
                                <div class="col-sm-8">
                                    <input type="Tel" class="form-control-plaintext" name= "ophonenumber" id= "ophonenumber" value= "<?php echo $rows['fdOwnerPhoneNumber'];?>" readonly>
                                    </div>                                
                            </div>
                        </div> 
                    </div> 
                    <div class="row">                           
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email :</label>
                                <div class="col-sm-8">
                                    <input type="email" class= "form-control-plaintext" id= "oemail" name= "oemail" value= "<?php echo $rows['fdOwnerEmail'];?>" readonly>
                                    </div>                                   
                            </div>
                        </div>
                    </div>                                                        
                    </div>
                    </div>
                    
                    <hr style="margin-top: -30px; margin-bottom: -4px; background: grey; opacity: 0.5;">
                    <div class="card-body">
                    <h4 class="card-title">Contact Person1 Details</h4>
                    <div class="card-body">                  
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Person1 Name :</label>
                                <div class="col-sm-8">
                                    <input type= "text" class= "form-control-plaintext" id="cp1name"  name= "cp1name" 
                                    value= "<?php echo $rows['fdContactPerson1Name'];?>" readonly>
                                    </div>                                
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Phone Number :</label>
                                <div class="col-sm-8">
                                    <input type="Tel" class="form-control-plaintext" name= "cp1phonenumber" id= "cp1phonenumber" value= "<?php echo $rows['fdContactPerson1PhoneNumber'];?>" readonly>
                                    </div>                               
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email :</label>
                                <div class="col-sm-8">
                                    <input type="email" class= "form-control-plaintext" id="cp1email" name= "cp1email" value= "<?php echo $rows['fdContactPerson1Email'];?>" readonly>
                                    </div>                                    
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    
                    <hr style="margin-top: -30px; margin-bottom: -4px; background: grey; opacity: 0.5;">
                    <div class="card-body">
                    <h4 class="card-title">Contact Person2 Details</h4>
                    <div class="card-body">                  
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Person2 Name :</label>
                                <div class="col-sm-8">
                                    <input type="text" class= "form-control-plaintext" id= "cp2name"  name= "cp2name" 
                                    value= "<?php echo $rows['fdContactPerson2Name'];?>" readonly>
                                    </div>                                
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label" style= "white-space: nowrap;">Phone Number :</label>
                                <div class="col-sm-8">
                                    <input type="Tel" class="form-control-plaintext" name= "cp2phonenumber" id= "cp2phonenumber" value= "<?php echo $rows['fdContactPerson2PhoneNumber'];?>" readonly>
                                    </div>                                
                            </div>
                        </div> 
                    </div>
                    <div class="row">                         
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email :</label>
                                <div class="col-sm-8">
                                    <input type="email" class= "form-control-plaintext" id= "cp2email" name= "cp2email" value= "<?php echo $rows['fdContactPerson2Email'];?>" readonly>
                                    </div>                                    
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>

                    <hr style="margin-top: -30px; margin-bottom: -4px; background: grey; opacity: 0.5;">
                    <div class="card-body">
                    <h4 class="card-title">Notes</h4>
                    <div class="card-body">
                    <div class="row">                            
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="notes" class="col-sm-4 text-right control-label col-form-label">Notes :</label>
                                <div class="col-sm-8">
                                <input type="text" class= "form-control-plaintext" id= "notes" name= "notes" 
                                value= "<?php echo $rows['fdNotes'];?>" readonly>                                  
                                </div>                                    
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="card-body">
                   <div class="form-group  mr-5 ml-5 pb-5">
                         <a href="?dashboard" class="btn waves-effect waves-light btn-info"><i class="fas fa-arrow-left">&nbsp;&nbsp;Go Back</i></a>
                     </div>
                      </div>
                      
                    </div>                                
            </div>
        </div>
    </div>
    </div>



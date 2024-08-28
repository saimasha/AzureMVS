<style>
label.control-label {
  white-space: nowrap;
}
  input.form-control-plaintext{
    color: #b2b9bf; 
}
 
</style>
    <?php

        if(isset($_GET['sid'])){
            $sid = $_GET['sid'];

        $query = "SELECT * FROM tbStockistMaster WHERE fdStockistID = '$sid'";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Query failed");
        }
        if(mysqli_num_rows($result)>0){
            $rows= mysqli_fetch_assoc($result);
        }
    }

    ?>

<div class="row ">
        <div class="col-12 mt-2">
            <div class="card">
            <div class="card-header" style="background-color:#1e88e566;">
                <h4 class="mb-0 text-white"><strong>STOCKIST DETAILS</strong></h4>
</div>
                <form class="form-horizontal"  method="POST">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Stockist User</strong></h5>
                        <div class="card-body">
                        <div class="row">          
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="fname3" class="col-sm-4 text-right control-label col-form-label">Stockist Name :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control-plaintext" id="sname" name="sname" value="<?php echo $rows["fdStockistName"]; ?>" readonly>  
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="uname1" class="col-sm-4 text-right control-label col-form-label">Manufacture ID :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control-plaintext" id="mid" name="mid" value="<?php echo $rows["fdManufacturerID"]; ?>" readonly>                                                 
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="nname" class="col-sm-4 text-right control-label col-form-label">Stockist ID :</label>
                                    <div class="col-sm-8">
                                    <?php if (isset($rows["fdStockistID"])) : ?>
                                        <input type="text" class="form-control-plaintext" id="sid" name="sid" value="<?php echo $rows["fdStockistID"]; ?>" readonly>
                                    <?php else : ?>
                                        <input type="text" class="form-control-plaintext" id="sid" name="sid" value="<?php echo $sid; ?>"  readonly>
                                    <?php endif; ?> 
                                </div>
                            </div>
                        </div>                  
                              
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Ware House ID :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control-plaintext" name="whid" id="whid" value="<?php echo $rows["fdWareHouseID"]; ?>" readonly>                                
                                    </div>
                                </div>
                                </div>
                            </div>
                    </div>
                                    </div>
                    <hr style=" margin-top: -25px; margin-bottom: -1px; background: grey; opacity:0.5;">
                    
                    <div class="card-body">
                    <h5 class="card-title"><strong>Head Office Details</strong></h5>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="fname2" class="col-sm-4 text-right control-label col-form-label ">Name :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control-plaintext" id="hname" name="hname" value="<?php echo $rows["fdHeadOfficeName"]; ?>" readonly>                                   
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row ">
                                    <label for="web1" class="col-sm-4 text-right control-label col-form-label">Website :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control-plaintext" id="hweb1" name="hweb1" value="<?php echo $rows["fdWebsiteURL"]; ?>" readonly>                                   
                                    </div>
                                </div>
                            </div>
                            </div>
                       
                            <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number :</label>
                                    <div class="col-sm-8">
                                        <input type="tel" class="form-control-plaintext" name="hphone" id="hphone" value="<?php echo $rows["fdHeadOfficePhoneNumber"]; ?>" pattern="[0-9]{10}" readonly>                                   
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group row">
                                    <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email :</label>
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
    // Assuming fdHeadOfficeCountry is the ID of the country
                                            $selectedCountryId = $rows["fdHeadOfficeCountry"];
                                            require_once "include/connection.php";
                                            $result = mysqli_query($conn, "SELECT id, name FROM tbCountries WHERE id = '$selectedCountryId'");
                                            $countryRow = mysqli_fetch_assoc($result);
                                        ?>
                                            <input type="text" class="form-control-plaintext" value="<?php echo $countryRow['name']; ?>">
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
                                            <!--/span-->
                                
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label">Post Code :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control-plaintext" id="hpostcode" name="hpostcode" value="<?php echo $rows["fdHeadOfficePostalCode"]; ?>" readonly>                                                    
                                    </div>
                                </div>
                                </div>
                                            <!--/span-->
                            </div>
                                        <!--/row-->
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
                                            <!--/span-->
                                            
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label">Latitude :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control-plaintext" id="slatitude" name="slatitude" value="<?php echo $rows["fdStockistLat"]; ?>"  readonly>                                                   
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-right control-label col-form-label">Longitude :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control-plaintext" id="slangitude" name="slagitude" value="<?php echo $rows["fdStockistLong"]; ?>" readonly>                                                    
                                    </div>
                                </div>
                                </div>                                            
                            </div>
                            
                        </div>
                    </div>            
                    <hr style=" margin-top: -25px; margin-bottom: -1px; background: grey; opacity:0.5;">
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
                    <hr style=" margin-top: -25px; margin-bottom: -1px; background: grey; opacity:0.5;">

                    <div class="card-body">
                    <h5 class="card-title"><strong>Owner Details</strong></h5>                 
                                    
                    <div class="card-body">                                        
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Owner Name :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext" id="oname"  name="oname" value="<?php echo $rows["fdOwnerName"]; ?>" readonly>                               
                                    </div>
                                </div>
                        </div>  
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number :</label>
                                <div class="col-sm-8">
                                    <input type="tel" class="form-control-plaintext" name="ophonenumber" id="ophonenumber" value="<?php echo $rows["fdOwnerPhoneNumber"]; ?>" pattern="[0-9]{10}" readonly>                                
                                    </div>
                                </div>
                        </div> 
                    </div> 
                    <div class="row">                           
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Email :</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control-plaintext" id="oemail" name="oemail" value="<?php echo $rows["fdOwnerEmail"]; ?>" readonly>                                   
                                    </div>
                                </div>
                        </div>
                    </div>                                                        
                    </div>
                    </div>
                    
                    <hr style=" margin-top: -25px; margin-bottom: -1px; background: grey; opacity:0.5;">
                    <div class="card-body">
                    <h5 class="card-title"><strong>Contact Person1 Details</strong></h5>
                    <div class="card-body">                  
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Person1 Name :</label>
                                <div class="col-sm-8">
                                    <input type="tel" class="form-control-plaintext" id="cp1name"  name="cp1name" value="<?php echo $rows["fdContactPerson1Name"]; ?>" readonly>                                
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext" name="cp1phonenumber" id="cp1phonenumber" value="<?php echo $rows["fdContactPerson1PhoneNumber"]; ?>" pattern="[0-9]{10}" readonly>                               
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
                    
                    <hr style=" margin-top: -25px; margin-bottom: -1px; background: grey; opacity:0.5;">
                    
                    <div class="card-body">
                    <h5 class="card-title"><strong>Contact Person2 Details</strong></h5>
                    <div class="card-body">                  
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="fname2" class="col-sm-4 text-right control-label col-form-label">Person2 Name :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext" id="cp2name"  name="cp2name" value="<?php echo $rows["fdContactPerson2Name"]; ?>"readonly>                                
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="cono12" class="col-sm-4 text-right control-label col-form-label">Phone Number :</label>
                                <div class="col-sm-8">
                                    <input type="tel" class="form-control-plaintext" name="cp2phonenumber" id="cp2phonenumber" value="<?php echo $rows["fdContactPerson2PhoneNumber"]; ?>" pattern="[0-9]{10}" readonly>                                
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
                    <hr style=" margin-top: -25px; margin-bottom: -1px; background: grey; opacity:0.5;">
                    <div class="card-body">
                    <h5 class="card-title"><strong>Notes</strong></h4>
                    <div class="card-body">
                    <div class="row">                            
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="email2" class="col-sm-4 text-right control-label col-form-label">Notes :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control-plaintext" id="notes" name="notes" value="<?php echo $rows["fdNotes"]; ?>" readonly>                                    
                                    </div>
                                </div>
                        </div>
                    </div>
        </div>   
    </div>                                
                    <div class="card-body">
                    <div class="form-group">
                         <a href="?dashboard" class="btn waves-effect waves-light btn-info"><i class="fas fa-arrow-left">&nbsp;&nbsp;Go Back</i></a>
                     </div>
                    </div>
                </form>

<style>
    .custom-btn {
        height: 25px; /* Adjust the height as needed */
        width: 70px;
    }
</style>
<?php
if(isset($_POST['btnDelete'])){
    $manufacturerid = $_POST['btnDelete'];
    $sql="DELETE FROM tbManufacturerMaster WHERE fdManufacturerID = '$manufacturerid' ";
    if ($result = mysqli_query($conn, $sql)){
        $sql1="DELETE FROM tbUserMaster WHERE fdRoleUniqueID = '$manufacturerid'";
if ($result = mysqli_query($conn, $sql)){
    echo'<script>
    swal.fire({
        icon: "success",
        title: "Delete successfully!.." 
      }).then(function(){
        window.location="?ListManufacture";
      });
      </script>';
}
    }else{
        echo'<script> swal.fire({ 
          icon: "error",
          title:"Failed  to Delete !"});
       </script>';
    }  

}
?>
<script>
    function confirmDelete() {
        // Display a confirmation dialog
        var confirmation = confirm("Do you want to delete this record?");
        
        // If user confirms, return true to allow form submission
        if (confirmation) {
            return true;
        } else {
            // If user cancels, return false to prevent form submission
            return false;
        }
    }
</script>

<script>
    function show(id) {
    var NewName='NewName'+id;
    document.getElementById(NewName).style.visibility = "visible";
    }
    function hide(id) {
    var NewName='NewName'+id;
    document.getElementById(NewName).style.visibility = "hidden";
    }
</script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">MANUFACTURER LIST</h4>
              
<div class="table-responsive">
    <table id="file_export" class="table table-striped table-bordered display">
        <!-- addded by Saima-->

                        <!-- end-->

    <thead class="bg-info text-white">
        <tr style="white-space: nowrap;">
        
            <th>SI_No</th>
            <th>Manufacturer ID</th>
            <th>Manufacturer Name</th>
            <th>Industry ID</th>
            <th>Group ID</th>                                                   
            <th>Date</th>
            <th>Time</th>
            <th>Account Status</th>
            <th>Status</th>                                        
        </tr>
    </thead>
    <tbody>
    <?php 
    require ("include/connection.php");
    $k=1;
    $sql ="SELECT * FROM tbManufacturerMaster";
    if ($result = mysqli_query($conn, $sql))
    {
    while($rows=mysqli_fetch_assoc($result)) 
    {
    ?> 
    <tr style="white-space: nowrap;">
        <td>
                                    <!-- addded by Saima-->

            <style type="text/css">
      #NewNamehide<?php echo $k; ?> {  
        visibility: hidden; 
          position:absolute;
          height:386px;
          width:480px;
          z-index:100;
          border: black;
          top:160px;
          left:50px;
          /* border-radius:40px; */
          margin-left: 50px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      text-align: center;
      overflow: auto;
      }
    </style>
    <div  onMouseOver="show('hide<?php echo $k; ?>')" onMouseOut="hide('hide<?php echo $k; ?>')">
      <a  href="?ViewManufacture&mid=<?php echo $rows["fdManufacturerID"];?>" style="color: #b2b9bf;"><?php echo $k; ?></a>
    
      
                    
    <div id="NewNamehide<?php echo $k; ?>" class="scroll-sidebar">
    <table class="table-responsive table table-bordered">
      <tr><th colspan="2" style="text-align: center; background: #007bff;color: white;"> DETAILS </th></tr>
      <tr><td>QR Code Manufacturer ID : </td><td><?php echo $rows['fdQRCodeMnfrID']; ?></td>
      <tr><th>Hierarchy Level</th> <td><?php echo $rows["fdHierarchyLevel"]; ?></td></tr>
        <tr><th>Head Office Name</th><td><?php echo $rows["fdHeadOfficeName"]; ?></td></tr>
    
        <tr><th>Head Office Add 1</th><td><?php echo $rows["fdHeadOfficeAddressLine1"]; ?></td></tr>
        <tr><th>Head Office Add 2</th><td><?php echo $rows["fdHeadOfficeAddressLine2"]; ?></td></tr>

        <tr><th>Head Office City</th><td><?php 
                                            $selectedStateId = $rows["fdHeadOfficeCity"];
                                            require_once "include/connection.php";
                                            $result1 = mysqli_query($conn, "SELECT id, name FROM tbCities WHERE id = '$selectedStateId'");
                                            $cityRow = mysqli_fetch_assoc($result1);
                                        ?>
                                        <?php echo $cityRow['name']; ?></td></tr>
        <tr><th>Head Office State </th><td><?php 
                                            $selectedStateId = $rows["fdHeadOfficeState"];
                                            require_once "include/connection.php";
                                            $result1 = mysqli_query($conn, "SELECT id, name FROM tbStates WHERE id = '$selectedStateId'");
                                            $stateRow = mysqli_fetch_assoc($result1);
                                        ?>
                                        <?php echo $stateRow['name']; ?></td></tr>
        <tr>
        <tr>
    <th>Head Office Country</th>
    <td>
        <?php
        $selectedCountryId = $rows["fdHeadOfficeCountry"];
        require_once "include/connection.php";

        // Fetch country name from the database using the country ID
        $result1 = mysqli_query($conn, "SELECT id, name FROM tbCountries WHERE id = '$selectedCountryId'");
        $countryRow = mysqli_fetch_assoc($result1);

        if ($countryRow) {
            echo $countryRow['name']; // Display the country name
        } else {
            echo "Country not found"; // Handle the case if country ID doesn't exist in the database
        }
        ?>
    </td>
</tr>

        <tr><th>Head Office Postal Code</th><td><?php echo $rows["fdHeadOfficePostalCode"]; ?></td></tr>
        <tr><th>Head Office Phone Number</th><td><?php echo $rows["fdHeadOfficePhoneNumber"]; ?></td></tr>
        <tr><th>Head Office Email</th><td><?php echo $rows["fdHeadOfficeEmail"]; ?></td></tr>
        <tr><th>Highest Authority Name</th><td><?php echo $rows["fdHighestAuthorityName"]; ?></td></tr>
        <tr><th>Highest Authority Position</th><td><?php echo $rows["fdHighestAuthorityPosition"]; ?></td></tr>
        <tr><th>Highest Authority Phone Number</th><td><?php echo $rows["fdHighestAuthorityPhoneNumber"]; ?></td></tr>
        <tr><th>Highest Authority Email</th><td><?php echo $rows["fdHighestAuthorityEmail"]; ?></td></tr>
        <tr><th>Contact Person 1 Name</th> <td><?php echo $rows["fdContactPerson1Name"]; ?></td></tr>

        <tr><th>Contact Person 1 Phone Number</th><td><?php echo $rows["fdContactPerson1PhoneNumber"]; ?></td></tr>
        <tr><th>Contact Person 1 Email</th><td><?php echo $rows["fdContactPerson1Email"]; ?></td></tr>
        <tr><th>Contact Person 2 Name</th><td><?php echo $rows["fdContactPerson2Name"]; ?></td></tr>
        <tr><th>Contact Person 2 Phone Number</th><td><?php echo $rows["fdContactPerson2PhoneNumber"]; ?></td></tr>
        <tr><th>Contact Person 2 Email</th><td><?php echo $rows["fdContactPerson2Email"]; ?></td></tr>
        
        <tr><th>Website Url</th><td><?php echo $rows["fdWebsiteURL"]; ?></td></tr>
        <tr><th>Latitude</th><td><?php echo $rows["fdManufacturerLat"]; ?></td></tr>
        <tr><th>Longitude</th><td><?php echo $rows["fdManufacturerLong"]; ?></td></tr>
        <tr><th>Notes</th><td><?php echo $rows["fdNotes"]; ?></td></tr>                           
                            
    </table>
  </div> 
</div>                        <!-- end-->

</td>
    <td><?php echo $rows["fdManufacturerID"]; ?></td>
    <td><?php echo $rows["fdManufacturerName"]; ?></td>
    <td><?php echo $rows["fdIndustryID"]; ?></td>
    <td><?php echo $rows["fdGroupID"]; ?></td>        
    <td><?php echo $rows["fdDate"]; ?></td>
    <td><?php echo $rows["fdTime"]; ?></td>
    <td style="color: <?php echo getStatusColor($rows['fdManufacturerID'], $conn); ?>;"><?php echo getStatusButton($rows['fdManufacturerID'], $conn); ?></td>
    <td>
    <form method="POST" class="d-flex justify-contain-center">
        <button  name="btnDelete" id="btnDelete" value="<?php echo $rows["fdManufacturerID"]; ?>" class="d-inline btn btn-sm text-white p-1 m-1" type="submit" onclick="return confirmDelete();" style="background-color: #b60d0df7;"><i class="bi bi-trash-fill"></i></button>                                
    <a href="?UpdateManufacture&mid=<?php echo $rows["fdManufacturerID"]; ?>"><button  class="d-inline btn btn-sm text-white EditBtn p-1 m-1" name="updatebtn" id="updatebtn" type="button" style="background-color: #044d0b;"><i class="bi bi-pencil-square"></i></button></a>
    </td>
    </form>                                        
</tr>
    <?php
            $k++;

}
}?>
<?php
function getStatusColor($ManufacturerID, $conn) {
    $sql = "SELECT fdStatus FROM tbUserMaster WHERE fdRoleUniqueID = '$ManufacturerID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['fdStatus'] == 1 ? 'green' : 'red';
}
   
function getStatusButton($ManufacturerID, $conn) {
    $sql = "SELECT fdStatus, fdEmailAsUserID FROM tbUserMaster WHERE fdRoleUniqueID = '$ManufacturerID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
   // Part of your existing code where you generate the status button
   if ($result && mysqli_num_rows($result) > 0) {
        if ($row['fdStatus'] == 1) {
            // Active status display, adjust as needed
            echo '<div class="text-center"><button class="btn btn-sm text-white custom-btn" disabled style="background-color: #044d0b;">Active</button></div>';
        } else {
            // Link to make user active again or send an email when making inactive
            echo '<div class="text-center"><a href="updateStatus.php?fdManufacturerID=' . $ManufacturerID . '&newStatus=0" class="btn btn-sm text-white custom-btn" style="background-color: #b60d0df7;" onclick="return confirm(\'Are you sure you want to make this user active? Send Email\');">Resend Email</a></div>';
        }
    } else {
        echo '<div class="text-center"><a href="updateStatus.php?fdManufacturerID=' . $ManufacturerID . '&newStatus=0" class="btn btn-sm text-white custom-btn" style="background-color: #b60d0df7;" onclick="return confirm(\'Are you sure you want to make this user active? Send Email\');">Resend Email</a></div>';
    }

}
?>
</tbody>                        
</table>
</div>
</div>
        </div>
    </div>
</div>

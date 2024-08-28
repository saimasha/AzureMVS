
<?php
session_start();
$roleid = $_SESSION['fdRoleID'];
$RoleUniqueID = $_SESSION['fdRoleUniqueID'];
?>

<aside class="left-sidebar">
    <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
                <!-- User profile -->
                <!--<div class="user-profile position-relative" style="background: url(https://schedarcloud.com/medicineverifications/image/profile/profile.avif) no-repeat;background-size:contain;padding:42px;">-->
                <div class="user-profile position-relative">
                <?php
                        // session_start();
                        // $roleid = $_SESSION['fdRoleID'];
                        // $RoleUniqueID = $_SESSION['fdRoleUniqueID'];
                        $profilePhoto = '';

                        if ($roleid === "MNFR") {
                        $sql = "SELECT fdProfileImage FROM tbManufacturerMaster WHERE fdManufacturerID = '$RoleUniqueID'";
                        } elseif ($roleid === "STKS") {
                        $sql = "SELECT fdProfileImage FROM tbStockistMaster WHERE fdStockistID = '$RoleUniqueID'";
                        } elseif ($roleid === "DSTR") {
                        $sql = "SELECT fdProfileImage FROM tbDistributorMaster WHERE fdDistributorID = '$RoleUniqueID'";
                        } elseif ($roleid === "DELR") {
                        $sql = "SELECT fdProfileImage FROM tbDealerMaster WHERE fdDealerID = '$RoleUniqueID'";
                        } elseif ($roleid === "RTLR") {
                        $sql = "SELECT fdProfileImage FROM tbRetailerMaster WHERE fdRetailerID = '$RoleUniqueID'";
                        } else {
                        $profilePhoto = 'https://schedarcloud.com/medicineverifications/image/profile/user.png';
                        }
                        if (empty($profilePhoto)) {
                            $result = mysqli_query($conn, $sql);
                        
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $profilePhoto = $row['fdProfileImage'];
                                    break; 
                                }
                                mysqli_free_result($result);
                            } else {     
                                $profilePhoto = 'https://schedarcloud.com/medicineverifications/image/profile/user.png';
                            }
                        }else {
                            $profilePhoto = 'https://schedarcloud.com/medicineverifications/image/profile/user.png';
                        }
?>
                   <img src="<?php echo !empty($profilePhoto) ? 'image/profile/' . $profilePhoto : 'https://schedarcloud.com/medicineverifications/image/profile/user.png'; ?>" style="width: 100%;background: no-repeat;padding: 46px;margin-top: -22px;border-radius: 50%;">
                    <!-- User profile image -->
                    <!--<div class="profile-img"> </div>-->
                    <!-- User profile text-->
                    <!--<div class="profile-text pt-1"> -->
                        <!--<a href="#" class="dropdown-toggle u-dropdown w-100 text-white d-block position-relative" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Saima Shadmani</a>-->
                    <!--    <div class="dropdown-menu animated flipInY"> -->
                    <!--        <a href="profile.php" class="dropdown-item"><i class="fas fa-user"></i>-->
                    <!--            My Profile</a> -->
                    <!--        <a href="#" class="dropdown-item"><i class="fas fa-wallet"></i> My-->
                    <!--            Balance</a>-->
                    <!--        <a href="#" class="dropdown-item"><i class="far fa-envelope"></i> Inbox</a>-->
                    <!--        <div class="dropdown-divider"></div> -->
                    <!--        <a href="#" class="dropdown-item"><i class="fas fa-cog"></i> Account Setting</a>-->
                    <!--        <div class="dropdown-divider"></div> -->
                    <!--        <a href="authentication-login1.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>-->
                    <!--    </div>-->
                    <!--</div>-->
        </div>
        <nav class="sidebar-nav" style="margin-top: -31px;">
            <ul id="sidebarnav">
                <!-- <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Personal</span>
                </li> -->
                <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="?dashboard" aria-expanded="false"><i class="mdi mdi-calendar"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
               <?php session_start();
 $roleid = $_SESSION['fdRoleID'];

?>
                        <li class="sidebar-item" id="manufacturerMenu">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="fa fa-building"></i>
                            <span class="hide-menu">Manufacturer Details</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="?CreateManufacture" class="sidebar-link">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu"> Create Manufacturer </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="?ListManufacture" class="sidebar-link">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu">  Manufacturer List </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="?SearchManufacture" class="sidebar-link">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu"> Update And Delete </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="?LocationManufacture" class="sidebar-link">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu"> Location </span>
                                    </a>
                                </li>
                                
                                 
                            </ul>
                        </li>
                 

                <!--<li class="sidebar-item">-->
                <!--    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"-->
                <!--        aria-expanded="false">-->
                <!--        <i class="fas fa-file-medical"></i>-->
                <!--        <span class="hide-menu">Product Details </span>-->
                <!--    </a>-->
                <!--    <ul aria-expanded="false" class="collapse  first-level">-->
                <!--        <li class="sidebar-item">-->
                <!--            <a href="index.html" class="sidebar-link">-->
                <!--                <i class="mdi mdi-adjust"></i>-->
                <!--                <span class="hide-menu"> Add Product</span>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--        <li class="sidebar-item">-->
                <!--            <a href="?ProductList" class="sidebar-link">-->
                <!--                <i class="mdi mdi-adjust"></i>-->
                <!--                <span class="hide-menu">Product List </span>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--        <li class="sidebar-item">-->
                <!--            <a href="index3.html" class="sidebar-link">-->
                <!--                <i class="mdi mdi-adjust"></i>-->
                <!--                <span class="hide-menu"> Scan Details </span>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--        <li class="sidebar-item">-->
                <!--            <a href="index4.html" class="sidebar-link">-->
                <!--                <i class="mdi mdi-adjust"></i>-->
                <!--                <span class="hide-menu"> Locations</span>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--        </ul>-->
                <!--</li>-->
                <li class="sidebar-item" id="stockistMenu">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                    <i class="mdi mdi-layers"></i>
                        <span class="hide-menu">Stockist Details </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="?CreateStokist" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Create Stockist</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="?ListStockist" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu">Stockist List </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="?SearchStockist" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Update & Delete </span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="?timeline" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Scan Details </span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a href="?LocationStockist" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Locations</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item" id="distributorMenu">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="fas fa-exchange-alt"></i>
                        <span class="hide-menu">Distributors Details </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="?CreateDistributor" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Create Distributors</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="?ListDistributor" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu">Distributors List </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="?SearchDistributor" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Update & Delete </span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="index3.html" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Scan Details </span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a href="?LocationDistributor" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Locations</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="sidebar-item" id="dealerMenu">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="fas fa-handshake"></i>
                        <span class="hide-menu">Dealer Details </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="?CreateDealer" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Create Dealer</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="?ListDealer" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu">Dealer List </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="?SearchDealer" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Update & Delete </span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="index3.html" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Scan Details </span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a href="?LocationDealer" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Locations</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="sidebar-item" id="retailerMenu">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="mdi mdi-hospital-building"></i>
                        <span class="hide-menu">Retailer Details </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="?CreateRetailer" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Create Retailer</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="?ListRetailer" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu">Retailer List </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="?SearchRetailer" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Update & Delete </span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="index3.html" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Scan Details </span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a href="?LocationRetailer" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Locations</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <span class="hide-menu">Customer Details </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <!-- <li class="sidebar-item">
                            <a href="index.html" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Add Customer</span>
                            </a>
                        </li> -->
                        <!-- <li class="sidebar-item">
                            <a href="index2.html" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu">Customer List </span>
                            </a>
                        </li> -->
                        <!-- <li class="sidebar-item">
                            <a href="?CustomerScanDetails" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Scan Details </span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a href="?CustomerLocation" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Locations</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
</nav>
 </div>
<!-- </div> -->
        <!-- End Sidebar navigation -->
        <!--<div class="sidebar-footer"> -->
                <!-- item-->
        <!--        <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a> -->
                <!-- item-->
        <!--        <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a> -->
                <!-- item-->
        <!--        <a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> -->
        <!--</div>-->
</aside>
<script>
    // Get the user's role from PHP session or any other source
    var userRole = "<?php echo $_SESSION['fdRoleID']; ?>";

    // Function to hide a menu item by its ID
    function hideMenuItem(menuItemId) {
        var menuItem = document.getElementById(menuItemId);
        if (menuItem) {
            menuItem.style.display = "none";
        }
    }

    // Based on the user's role, hide specific menu items
    if (userRole === "MNFR") {
        // Hide Manufacturer Menu
        hideMenuItem("manufacturerMenu");
    } 
    else if (userRole === "STKS") {
        // Hide Manufacturer Menu
        hideMenuItem("manufacturerMenu");
        hideMenuItem("stockistMenu");

    } else if (userRole === "DSTR") {
        // Hide Manufacturer and Stockist Menus
        hideMenuItem("manufacturerMenu");
        hideMenuItem("stockistMenu");
        hideMenuItem("distributorMenu");

    }else if (userRole === "DELR") {
        // Hide Manufacturer and Stockist Menus
        hideMenuItem("manufacturerMenu");
        hideMenuItem("stockistMenu");
        hideMenuItem("distributorMenu");
        hideMenuItem("dealerMenu");

    }else if (userRole === "RTLR") {
        // Hide Manufacturer and Stockist Menus
        hideMenuItem("manufacturerMenu");
        hideMenuItem("stockistMenu");
        hideMenuItem("distributorMenu");
        hideMenuItem("dealerMenu");
        hideMenuItem("retailerMenu");


    }
    // Add more conditions as needed for other roles
</script>
       
       
       
       
       
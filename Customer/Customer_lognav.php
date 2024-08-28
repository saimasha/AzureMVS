<?php 
session_start();
$roleid = $_SESSION['fdRoleID'];
?>
<style>
    header ul.nav li a {
        font-size: 14px;
        border: none;
        font-weight: 700;
        text-transform: uppercase;
        color: black;
    }

    .topbar img {
        height: 60px; 
    }

    .topbar h4 {
        margin-bottom: 3px; /* Adjusted margin for better spacing */
        /* color: black; */
    }

    /* Responsive Styles */
    @media (max-width: 30em) { /* 480px and below */
        .navbar-toggler {
            display: block; /* Show toggle button on small screens */
        }

        .topbar img {
            height: 40px; /* Smaller logo on smaller screens */
        }

        .topbar h4 {
            font-size: 12px; /* Smaller text on smaller screens */
            text-align: center;
        }

        .topbar h4 small {
            display: block; /* Make 'small' text block to avoid overflow */
            margin-left: 0; /* Reset left margin */
            text-align: center;
        }

        .container-fluid {
            padding: 0 10px; /* Reduce padding on smaller screens */
        }
      
}
</style>

<header class="topbar">
    <nav class="navbar navbar-expand-lg" style="background-color: white;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/medicineverifications/">
                <img src="../image/siteImg/logo.png" alt="MVS logo"> 
                <b> MVS </b>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="d-flex justify-content-center">
                <h4><b class="bfont" style="color:black;">Welcome to Medicine Verification System<br><small>Building The Future On The Blockchain</small></b></h4>
            </div>

            <a class="navbar-brand" href="https://www.mirachinnovations.com/">
                <img src="https://www.mirachinnovations.com/img/logo.png" alt="Mirach Innovations logo">
            </a>
        </div>
    </nav>
</header>

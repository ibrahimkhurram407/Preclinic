<?php 
include('./admin/include/config.php');
include('func.php');  
include('newfunc.php');

if (!(isset($_SESSION['pid'],$_SESSION['fname'] ,$_SESSION['lname'], $_SESSION['email'], $_SESSION['fname'], $_SESSION['lname'], $_SESSION['contact']))){
    header("location: ./login.php");
    die("You are not authorised");
}

  $pid = $_SESSION['pid'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $email = $_SESSION['email'];
  $fname = $_SESSION['fname'];
  $gender = $_SESSION['gender'];
  $lname = $_SESSION['lname'];
  $contact = $_SESSION['contact'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>CARE GROUP - We help you!</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: CARE GROUP
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/CARE GROUP-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Top Bar ======= -->
    <div id="topbar" class="d-flex align-items-center fixed-top">
    </div>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="index.php" class="logo me-auto"><img src="assets/img/logo-dark.png"
                        width="35" height="35" alt=""> CARE GROUP</a></h1>


            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#appointment">Book Appointment</a></li>
                    <li><a class="nav-link scrollto" href="#appointment-history">Appointment</a></li>
                    <li><a class="nav-link scrollto" href="#prescription-history">Prescription</a></li>
                    <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li class="nav-parent">
                        <div class="nav-item">
                            <img src="https://uxwing.com/wp-content/themes/uxwing/download/peoples-avatars/account-icon.png"
                                alt="Profile" class="profile-img" id="profile-img">
                            <div class="dropdown" id="dropdown">
                                <button class="dropbtn">Account</button>
                                <div class="dropdown-content">
                                    <a href="<?php echo "account-details.php?table=patreg&id=$pid&page=index.php";?>">Account Details</a>
                                    <a href="logout.php">Logout</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <style>
    .nav-item {
    display: flex;
    align-items: center;
    margin-right: 20px;
}

.profile-img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    color: #2C4964;
    font-family: "Open Sans", sans-serif;
    padding: 10px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    transform: translateX(0); /* Reset translation */
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* Media query for responsiveness */
@media (max-width: 768px) {
    .nav-item {
        margin-right: 0;
    }

    .dropdown-content {
        min-width: 100%; /* Full width on small screens */
        left: 0;
        transform: translateX(0);
    }
}

    </style>

    <script>
    document.getElementById("profile-img").addEventListener("click", function() {
        document.getElementById("dropdown").classList.toggle("show");
    });

    // Close the dropdown if the user clicks outside of it
    window.addEventListener("click", function(event) {
        if (!event.target.matches('.profile-img')) {
            var dropdown = document.getElementById("dropdown");
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        }
    });
    </script>
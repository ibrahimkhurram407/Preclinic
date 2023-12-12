<?php 
include(__DIR__ . '/../../admin/include/config.php');
error_reporting(0);
session_start();
if (!isset($_SESSION['dname'])) {
    header("location: ./login.php");
    die("You are not authorised");
}
$doctor = $_SESSION['dname'];
if (isset($_SESSION['dID'])) {
  $doctor_id = $_SESSION['dID'];
}else {
  $id_query = mysqli_query($con, "SELECT id FROM doctb WHERE username = '" . $doctor . "';");
  if ($id_query) {
    // Fetch the result as an associative array
    $id_row = mysqli_fetch_assoc($id_query);

    // Access the 'id' column
    $doctor_id = $id_row['id'];
  } else {
    echo "Error: " . mysqli_error($con);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>CARE GROUP - We help you!</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="index.php" class="logo">
                    <img src="assets/img/logo.png" width="35" height="35" alt=""> <span>CARE GROUP</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40"
                                alt="Admin">
                            <span class="status online"></span></span>
                        <span><?php echo $doctor; ?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"
                            href="<?php global $doctor_id; echo "account-details.php?table=doctb&id=$doctor_id&page=index.php";?>">My
                            Profile</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item"
                        href="<?php echo "account-details.php?table=doctb&id=$doctor_id&page=index.php";?>">My
                        Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
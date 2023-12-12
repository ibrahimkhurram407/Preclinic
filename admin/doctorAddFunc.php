<?php
include('newfunc.php');
session_start();
if (!isset($_SESSION['username'])) {
    die('You are not authorized.');
}

if (isset($_POST['doctor'])) {
    // Get form data
    $doctor = $_POST['doctor'];
    $dpassword = $_POST['dpassword'];
    $demail = $_POST['demail'];
    $spec = $_POST['special'];
    $docFees = $_POST['docFees'];

    // Insert into doctb table
    $query = "INSERT INTO doctb(username, password, email, spec, docFees) VALUES ('$doctor', '$dpassword', '$demail', '$spec', '$docFees')";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('Doctor added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding doctor: " . mysqli_error($con) . "');</script>";
        error_log('Error adding doctor: ' . mysqli_error($con)); // Log the error
    }
}
?>

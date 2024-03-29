<?php
// Get the id variable from the GET function 
include(__DIR__ . '/../admin/include/config.php');

if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
} else {
    // If id is not provided, redirect to appointments.php 
    header("Location: appointments.php");
    exit();
}

// Include the config.php file which contains database connection details
include(__DIR__ . '/../admin/include/config.php'); // Fix the typo here

// Change the doctor status column value from 1 to 0 using the fetched id
$stmt = $con->prepare("UPDATE appointmenttb SET doctorStatus = 0 WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Redirect to appointments.php after updating the doctor status column 
header("Location: appointments.php");
exit();
?>

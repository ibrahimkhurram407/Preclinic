<?php
  require_once './include/config.php';
  session_start();
  if (!isset($_SESSION['username'])) {
    header("location: ./login.php");
    die("You are not authorised");
}
$table = $_GET['table'];
$id = $_GET['id'];
$page = $_GET['page'];
if (isset($_GET['table']) && isset($_GET['id']) && isset($_GET['page'])) {
    // Handle the deletion when the form is submitted
    $delete_id = $id;
    echo $table;
    echo $delete_id;
    echo $page;
    if ($table == 'patreg') {
        $delete_query = "DELETE FROM $table WHERE pid = $delete_id";
    }else {
        $delete_query = "DELETE FROM $table WHERE id = $delete_id";
    }
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {
        echo "<script>alert('Doctor deleted successfully');</script>";
        echo "<a href='doctors.php'>Go Back<a>";
        echo "<script>window.location.href='$page'";
        header("location: $page");
    } else {
        echo "<script>alert('Error deleting doctor: " . mysqli_error($con) . "');</script>";
    }
    
}else {
    echo "Invalid parameters.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
         <?php echo "<a href='$page'>Go Back</a>"; ?>
</body>
</html>
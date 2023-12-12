<?php 
include('./include/config.php');
session_start();
$admin_user = $_SESSION['username'];
if (isset($_SESSION['id'])) {
    $admin_id = $_SESSION['id'];
}else {
    $id_query = mysqli_query($con, "SELECT id FROM admintb WHERE username = " . $admin_user . ";");
  if ($id_query) {
    // Fetch the result as an associative array
    $id_row = mysqli_fetch_assoc($id_query);

    // Access the 'id' column
    $admin_id = $id_row['id'];
  } else {
    echo "Error: " . mysqli_error($con);
  }

}
?>
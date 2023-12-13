<?php 
    require_once "include/header.php";
    require_once "include/sidebar.php";
?>
<?php 
include('newfunc.php');
if (!isset($_SESSION['username'])) {
    header("location: ./login.php");
    die("You are not authorised");
}

// Query for Appointments
$check_query_appointments = mysqli_query($con, "SELECT * FROM appointmenttb;");

if ($check_query_appointments === false) {
    // Handle the error, print it for debugging purposes
    echo "Error in Appointments query: " . mysqli_error($con);
} else {
    // Successful query, proceed
    $AmountOfAppointments = mysqli_num_rows($check_query_appointments);
}

// Query for Prescriptions
$check_query_prescriptions = mysqli_query($con, "SELECT * FROM prestb;");

if ($check_query_prescriptions === false) {
    // Handle the error, print it for debugging purposes
    echo "Error in Prescriptions query: " . mysqli_error($con);
} else {
    // Successful query, proceed
    $AmountOfPrescriptions = mysqli_num_rows($check_query_prescriptions);
}

// Query for Doctors
$check_query_prescriptions = mysqli_query($con, "SELECT * FROM doctb;");

if ($check_query_prescriptions === false) {
    // Handle the error, print it for debugging purposes
    echo "Error in Prescriptions query: " . mysqli_error($con);
} else {
    // Successful query, proceed
    $AmountOfDoctors = mysqli_num_rows($check_query_prescriptions);
}

// Query for Patients
$check_query_prescriptions = mysqli_query($con, "SELECT * FROM patreg;");

if ($check_query_prescriptions === false) {
    // Handle the error, print it for debugging purposes
    echo "Error in Prescriptions query: " . mysqli_error($con);
} else {
    // Successful query, proceed
    $AmountOfPatients = mysqli_num_rows($check_query_prescriptions);
}

if(isset($_POST['docsub']))
{
  $doctor=$_POST['doctor'];
  $dpassword=$_POST['dpassword'];
  $demail=$_POST['demail'];
  $spec=$_POST['special'];
  $docFees=$_POST['docFees'];
  $query="insert into doctb(username,password,email,spec,docFees)values('$doctor','$dpassword','$demail','$spec','$docFees')";
  $result=mysqli_query($con,$query);
  if($result)
    {
      echo "<script>alert('Doctor added successfully!');</script>";
  }
}


if(isset($_POST['docsub1']))
{
  $demail=$_POST['demail'];
  $query="delete from doctb where email='$demail';";
  $result=mysqli_query($con,$query);
  if($result)
    {
      echo "<script>alert('Doctor removed successfully!');</script>";
  }
  else{
    echo "<script>alert('Unable to delete!');</script>";
  }
}
// Check if the form is submitted
if (isset($_POST['deleteCity'])) {
    // Get the city to delete
    $cityToDelete = $_POST['cityToDelete'];

    // Delete doctors with the specified city
    $deleteQuery = "DELETE FROM doctb WHERE city = '$cityToDelete'";
    $deleteResult = mysqli_query($con, $deleteQuery);

    if ($deleteResult) {
        echo "Doctors in $cityToDelete have been deleted successfully.";
    } else {
        echo "Error deleting doctors: " . mysqli_error($con);
    }
}

?>


<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Manage Cities</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-border table-striped custom-table datatable mb-0">
                        <div class="tab-pane fade" id="list-pat" role="tabpanel" aria-labelledby="list-pat-list">

                            <div class="col-md-8">
                                <form class="form-group" action="patientsearch.php" method="post">
                                    <div class="row">
                                        <div class="col-md-10"><input type="text" name="patient_contact"
                                                placeholder="Enter Contact" class="form-control"></div>
                                        <div class="col-md-2"><input type="submit" name="patient_search_submit"
                                                class="btn btn-primary" value="Search"></div>
                                    </div>
                                </form>
                            </div>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">City</th>
                                        <th scope="col">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                global $con;

                                // Query to get all unique cities
                                $query = "SELECT DISTINCT city FROM doctb";
                                $result = mysqli_query($con, $query);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $city = $row['city'];
                                ?>
                                        <tr>
                                            <td><?php echo $city; ?></td>
                                            <td>
                                                <form method="post" action="">
                                                    <input type="hidden" name="cityToDelete" value="<?php echo $city; ?>">
                                                    <button type="submit" name="deleteCity" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($con);
                                }
                                ?>
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="delete_patient" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="assets/img/sent.png" alt="" width="50" height="46">
                <h3>Are you sure want to delete this Patient?</h3>
                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
<script>
var Active = document.getElementById('manage-cities');
Active.classList.add('active');
</script>
</body>


<!-- patients23:19-->

</html>
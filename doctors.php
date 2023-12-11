<?php 
    require_once "include/header.php";
    require_once "include/sidebar.php";
?>
<?php 
include('./include/config.php');

include('newfunc.php');
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

?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Patients</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="add-patient.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i>
                    Add Patient</a>
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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Specialization</th>
                                        <th>Email</th>
                                        <th>City</th>
                                        <th>Password</th>
                                        <th>Doctor Fees</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    include('include/config.php');
                                    global $con;
                                    $query = "select * from doctb";
                                    $result = mysqli_query($con,$query);
                                    while ($row = mysqli_fetch_array($result)){
                                    $id = $row['id'];
                                    $username = $row['username'];
                                    $spec = $row['spec'];
                                    $email = $row['email'];
                                    $city = $row['city'];
                                    $password = $row['password'];
                                    $docFees = $row['docFees'];
                                    
                                    echo "<tr>
                                        <td>$id</td>
                                        <td><img width='28 height='28' src='assets/img/user.jpg' class='rounded-circle m-r-5' alt=''>$username</td>
                                        <td>$spec</td>
                                        <td>$email</td>
                                        <td>$city</td>
                                        <td>$password</td>
                                        <td>$docFees</td>
                                        <td class='text-right'>
                                            <div class='dropdown dropdown-action'>
                                                <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown'
                                                    aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                                                <div class='dropdown-menu dropdown-menu-right'>
                                                    <a class='dropdown-item' href='edit-patient.php'><i
                                                            class='fa fa-pencil m-r-5'></i> Edit</a>
                                                    <a class='dropdown-item' href='#' data-toggle='modal'
                                                        data-target='#delete_patient'><i class='fa fa-trash-o m-r-5'></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>";
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
<div class="sidebar-overlay" data-reff=""></div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/app.js"></script>
</body>

<script>
var Active = document.getElementById('doctors');
Active.classList.add('active');
</script>

<!-- doctors23:17-->

</html>
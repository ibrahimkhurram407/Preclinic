<?php 
    require_once "include/header.php";
    require_once "include/sidebar.php";
?>
<?php
include('newfunc.php');
include('./include/config.php');

if (!isset($_SESSION['username'])) {
    die("You are not authorised");
}
$doctor = $_SESSION['username'];
if (isset($_SESSION['id'])) {
  $doctor_id = $_SESSION['id'];
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
if (!isset($_SESSION['username'])) {
    die('You are not Authorized');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['docsub'])) {
    echo "something";
    $doctor = $_POST['doctor'];
    $dpassword = $_POST['dpassword'];
    $demail = $_POST['demail'];
    $spec = $_POST['special'];
    $docFees = $_POST['docFees'];
    $city = $_POST['city'];

    $query = "INSERT INTO doctb(username, password, email, spec, docFees, city) VALUES ('$doctor', '$dpassword', '$demail', '$spec', '$docFees', '$city')";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('Doctor added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding doctor: " . mysqli_error($con) . "');</script>";
        error_log('Error adding doctor: ' . mysqli_error($con)); // Log the error
    }
}
?>
<div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Doctor</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="add-doctor.php">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Doctor Name <span class="text-danger">*</span></label>
                                        <input class="form-control" required name="doctor" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input name="demail" class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Specializaiton <span class="text-danger">*</span></label>
                                        <select name="special" class="form-control" id="special" required="required">
                                            <option value="head" name="spec" disabled selected>Select Specialization
                                            </option>
                                            <option value="General" name="spec">General</option>
                                            <option value="Cardiologist" name="spec">Cardiologist</option>
                                            <option value="Neurologist" name="spec">Neurologist</option>
                                            <option value="Pediatrician" name="spec">Pediatrician</option>
                                            <option value="Dentist" name="spec">Dentist</option>
                                            <option value="ENT Specialist" name="spec">ENT Specialist</option>
                                            <option value="Psychiatrist" name="spec">Psychiatrist</option>
                                            <option value="Gynecologist" name="spec">Gynecologist</option>
                                            <option value="Dermatologist" name="spec">Dermatologist</option>
                                            <option value="Orthopedic Surgeon" name="spec">Orthopedic Surgeon</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="dpassword" class="form-control" type="password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input  name="cdpassword" class="form-control" type="password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Consultancy Fees</label>
                                        <input type="text" class="form-control" name="docFees" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group gender-select">
										<label class="gen-label">Gender:</label>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" class="form-check-input">Male
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" class="form-check-input">Female
											</label>
										</div>
									</div>
                                </div>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
												<label>City</label>
												<input type="text" name="city" class="form-control">
											</div>
										</div>
									</div>
								</div>
                            </div>
                            <div class="m-t-20 text-center">
                                <input type="submit" name="docsub" value="Add Doctor" class="btn btn-primary">
                            </div>
                        </form>
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
</html>
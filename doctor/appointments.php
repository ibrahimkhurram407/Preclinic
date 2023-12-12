<?php 
    require_once "include/header.php";
    require_once "include/sidebar.php";
?>
<?php

include('newfunc.php');
if (!isset($_SESSION['dname'])) {
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
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Appointments</h4>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table">
								<thead>
									<tr>
										<th>Appointment ID</th>
										<th>Patient ID</th>
										<th>Patient Name</th>
                                        <th>Gender</th>
										<th>Patient Email</th>
                                        <th>Contact</th>
										<th>Appointment Date</th>
										<th>Status</th>
                                        <th>Action</th>
                                        <th>Prescribe</th>
									</tr>
								</thead>
								<tbody>
            <?php 
                    global $con;
                    $dname = $_SESSION['dname'];
                    $query = "select pid,ID,fname,lname,gender,email,contact,appdate,userStatus,doctorStatus from appointmenttb where doctor='$dname';";
                    $result = mysqli_query($con,$query);
                    if(!$result){
                      echo mysqli_error($con);
                    }
                    while ($row = mysqli_fetch_array($result)){
                      ?>
                      <tr>
                      <td><?php echo $row['ID'];?></td>
                        <td><?php echo $row['pid'];?></td>
                        <td><?php echo $row['fname'] . " " . $row['lname'];?></td>
                        <td><?php echo $row['gender'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['contact'];?></td>
                        <td><?php echo $row['appdate'];?></td>  
                        <td><?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
                {
                echo "<span class='custom-badge status-green'>Active</span>";
                }
                if(($row['userStatus']==0) && ($row['doctorStatus']==1) or ($row['userStatus']==1) && ($row['doctorStatus']==0))  
                {
                echo "<span class='custom-badge status-red'>Inactive</span>";
                }
                ?></td><td>
                <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
                { ?>

                                            
                    <a href="doctor-panel.php?ID=<?php echo $row['ID']?>&cancel=update" 
                      onClick="return confirm('Are you sure you want to cancel this appointment ?')"
                      title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button class="btn status-red">Cancel</button></a>
                    <?php } else {

                        echo "Cancelled";
                        } ?>
                
                </td>

                <td>

                <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
                { ?>

                <a href="prescribe.php?pid=<?php echo $row['pid']?>&ID=<?php echo $row['ID']?>&fname=<?php echo $row['fname']?>&lname=<?php echo $row['lname']?>&appdate=<?php echo $row['appdate']?>"
                tooltip-placement="top" tooltip="Remove" title="prescribe">
                <button class="btn status-green">Prescibe</button></a>
                <?php } else {

                    echo "-";
                    } ?>
                
                </td>


              </tr></a>
            <?php } ?>
								</tbody>
							</table>
						</div>
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
    <script src="assets/js/app.js"></script>
	<script>
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
				$('#datetimepicker4').datetimepicker({
                    format: 'LT'
                });
            });
     </script>
     
<script>
    var Active = document.getElementById('appointments');
    Active.classList.add('active');
</script>
</body>


<!-- appointments23:20-->
</html>
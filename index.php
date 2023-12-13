<?php
  function generate_bill(){
    session_start();
    include('./admin/include/config.php');
    $pid = $_SESSION['pid'];
    $output='';
    $query=mysqli_query($con,"select p.pid,p.ID,p.fname,p.lname,p.doctor,p.appdate,p.disease,p.allergy,p.prescription,a.docFees from prestb p inner join appointmenttb a on p.ID=a.ID and p.pid = '$pid' and p.ID = '".$_GET['ID']."'");
    while($row = mysqli_fetch_array($query)){
      $output .= '
      <label> Patient ID : </label>'.$row["pid"].'<br/><br/>
      <label> Appointment ID : </label>'.$row["ID"].'<br/><br/>
      <label> Patient Name : </label>'.$row["fname"].' '.$row["lname"].'<br/><br/>
      <label> Doctor Name : </label>'.$row["doctor"].'<br/><br/>
      <label> Appointment Date : </label>'.$row["appdate"].'<br/><br/>
      <label> Disease : </label>'.$row["disease"].'<br/><br/>
      <label> Allergies : </label>'.$row["allergy"].'<br/><br/>
      <label> Prescription : </label>'.$row["prescription"].'<br/><br/>
      <label> Fees to be Paid : </label>'.$row["docFees"].'<br/>
      
      ';
  
    }
    
    return $output;
  }
  
  
  if(isset($_GET["generate_bill"])){
    require_once("TCPDF/tcpdf.php");
    $obj_pdf = new TCPDF('P',PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);
    $obj_pdf -> SetCreator(PDF_CREATOR);
    $obj_pdf -> SetTitle("Generate Bill");
    $obj_pdf -> SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
    $obj_pdf -> SetHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
    $obj_pdf -> SetFooterFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
    $obj_pdf -> SetDefaultMonospacedFont('helvetica');
    $obj_pdf -> SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf -> SetMargins(PDF_MARGIN_LEFT,'5',PDF_MARGIN_RIGHT);
    $obj_pdf -> SetPrintHeader(false);
    $obj_pdf -> SetPrintFooter(false);
    $obj_pdf -> SetAutoPageBreak(TRUE, 10);
    $obj_pdf -> SetFont('helvetica','',12);
    $obj_pdf -> AddPage();
  
    $content = '';
  
    $content .= '
        <br/>
        <h2 align ="center"> CARE GROUP</h2></br>
        <h3 align ="center"> Bill</h3>
        
  
    ';
   
    $content .= generate_bill();
    $obj_pdf -> writeHTML($content);
    ob_end_clean();
    $obj_pdf -> Output("bill.pdf",'I');
  
  }
  
  require_once "includes/header.php";
  
  // Query for Appointments
  $check_query_appointments = mysqli_query($con, "SELECT * FROM appointmenttb WHERE fname = '$fname' AND lname = '$lname'");
  
  if ($check_query_appointments === false) {
      // Handle the error, print it for debugging purposes
      echo "Error in Appointments query: " . mysqli_error($con);
  } else {
      // Successful query, proceed
      $AmountOfAppointments = mysqli_num_rows($check_query_appointments);
  }
  
  // Query for Prescriptions
  $check_query_prescriptions = mysqli_query($con, "SELECT * FROM prestb WHERE fname = '$fname' AND lname = '$lname'");
  
  if ($check_query_prescriptions === false) {
      // Handle the error, print it for debugging purposes
      echo "Error in Prescriptions query: " . mysqli_error($con);
  } else {
      // Successful query, proceed
      $AmountOfPrescriptions = mysqli_num_rows($check_query_prescriptions);
  }
  
  
    if (isset($_POST['app-submit'])) {
      $pid = $_SESSION['pid'];
      $username = $_SESSION['username'];
      $email = $_SESSION['email'];
      $fname = $_SESSION['fname'];
      $lname = $_SESSION['lname'];
      $gender = $_SESSION['gender'];
      $contact = $_SESSION['contact'];
      $doctor = $_POST['doctor'];
      $docFees = $_POST['docFees'];
      $appdate = $_POST['appdate'];
      
      // Get the current date
      $cur_date = date("Y-m-d");
  
      // Convert the appointment date to a timestamp
      $appdate_timestamp = strtotime($appdate);
      // Compare the appointment date with the current date
      if ($appdate_timestamp === false) {
          echo "<script>alert('Invalid date format!');</script>";
      } elseif ($appdate_timestamp >= strtotime($cur_date)) {
          $check_query = mysqli_query($con, "SELECT ID FROM appointmenttb WHERE doctor='$doctor' AND appdate='$appdate'");
  
          if (mysqli_num_rows($check_query) == 0) {
              $query = mysqli_query($con, "INSERT INTO appointmenttb (pid, fname, lname, gender, email, contact, doctor, docFees, appdate, userStatus, doctorStatus) VALUES ($pid, '$fname', '$lname', '$gender', '$email', '$contact', '$doctor', '$docFees', '$appdate', '1', '1')");
  
              if ($query) {
                  echo "<script>alert('Your appointment successfully booked');</script>";
              } else {
                  echo "<script>alert('Unable to process your request. Please try again!');</script>";
              }
          } else {
              echo "<script>alert('We are sorry to inform that the doctor is not available at this time or date. Please choose a different time or date!');</script>";
          }
      } else {
          echo "<script>alert('Select a time or date in the future!');</script>";
      }
  }
   elseif (isset($_GET['cancel'])) {
      $query = mysqli_query($con, "update appointmenttb set userStatus='0' where ID = '" . $_GET['ID'] . "'");
      if ($query) {
          echo "<script>alert('Your appointment successfully cancelled');</script>";
      }
  }

  function get_specs(){
    global $con;
    $query=mysqli_query($con,"select username,spec from doctb");
    $docarray = array();
      while($row =mysqli_fetch_assoc($query))
      {
          $docarray[] = $row;
      }
      return json_encode($docarray);
  }
  
  
?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <h1>Welcome <?php echo " " . $fname . " " . $lname; ?></h1>
        <h2>We are team of talented designers making websites with Bootstrap</h2>
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="content">
                        <h3>Why Choose CARE GROUP?</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                            Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus
                            optio ad corporis.
                        </p>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-receipt"></i>
                                    <h4>Corporis voluptates sit</h4>
                                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut
                                        aliquip</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Ullamco laboris ladore pan</h4>
                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                        deserunt</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-images"></i>
                                    <h4>Labore consequatur</h4>
                                    <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container-fluid">

            <div class="row">
                <div
                    class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
                    <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox play-btn mb-4"></a>
                </div>

                <div
                    class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                    <h3>Enim quis est voluptatibus aliquid consequatur fugiat</h3>
                    <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima
                        temporibus laudantium. Soluta voluptate sed facere corporis dolores excepturi. Libero laboriosam
                        sint et id nulla tenetur. Suscipit aut voluptate.</p>

                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-fingerprint"></i></div>
                        <h4 class="title"><a href="">Lorem Ipsum</a></h4>
                        <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias
                            excepturi sint occaecati cupiditate non provident</p>
                    </div>

                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-gift"></i></div>
                        <h4 class="title"><a href="">Nemo Enim</a></h4>
                        <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                            praesentium voluptatum deleniti atque</p>
                    </div>

                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-atom"></i></div>
                        <h4 class="title"><a href="">Dine Pad</a></h4>
                        <p class="description">Explicabo est voluptatum asperiores consequatur magnam. Et veritatis
                            odit. Sunt aut deserunt minus aut eligendi omnis</p>
                    </div>

                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Appointment Section ======= -->
    <section id="appointment" class="appointment section-bg">
        <div class="container" style="text-align: center;">

            <div class="section-title">
                <h2>Make an Appointment</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
                    fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <form style="max-width: 80vw;" class="form-group" method="post" action="index.php">
                <div class="row">
                    <?php
                                              global $con;
                                              $query = "SELECT id, username, city, spec, docFees FROM doctb";
                                              $result = mysqli_query($con, $query);
                                              $data = array();
                                              // Check if there are results
                                              if ($result->num_rows > 0) {
                                                  // Fetch each row and add it to the array
                                                  while ($row = $result->fetch_assoc()) {
                                                      $data[] = $row;
                                                  }
                                              }
                                              
                                              // Convert the PHP array to a JSON string
                                              $doctb = json_encode($data);
                                              $query = "SELECT * FROM availabilitytb;";
                                              $result1 = mysqli_query($con, $query);
                                              $data1 = array();

                                              // Check if there are results
                                              if ($result1->num_rows > 0) {
                                                  // Fetch each row and add it to the array
                                                  while ($row = $result1->fetch_assoc()) {
                                                      $data1[] = $row;
                                                  }
                                              }
                                              
                                              // Convert the PHP array to a JSON string
                                              $availabilitytb = json_encode($data1);
                                              ?>

                    <div class="col-md-4">
                        <label for="city">City:</label>
                    </div>
                    <div class="col-md-8">
                        <select name="city" id="city" class="form-control">
                            <option value="" disabled selected>Select City</option>
                            <?php display_cities($data); ?>
                        </select>
                    </div>
                    <br><br>

                    <div class="col-md-4">
                        <label for="spec">Specialization:</label>
                    </div>
                    <div class="col-md-8">
                        <select name="spec" class="form-control" id="spec">
                            <option value="" disabled selected>Select Specialization</option>
                            <?php display_specs($data); ?>
                        </select>
                    </div>
                    <br><br>
                    <div class="col-md-4">
                        <label for="doctor">Doctors:</label>
                    </div>
                    <div class="col-md-8">
                        <select name="doctor" class="form-control" id="doctor" required="required">
                            <option value="" disabled selected>Select Doctor</option>
                            <?php display_docs($data); ?>
                        </select>
                    </div><br /><br />
                    <div class="col-md-4">
                        <label for="docFees">Consultancy Fees:</label>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="docFees" id="docFees" readonly="readonly" />
                    </div><br><br>

                    <div class="col-md-4">
                        <label for="appdate">Appointment Date:</label>
                    </div>
                    <div class="col-md-8">
                        <!-- <input type="date" class="form-control datepicker" name="appdate" id="appdate"
                                                    required="required"> -->
                        <select class="form-control" id="appdate" name="appdate" required="required">
                            <option value="" disabled selected>Select Date</option>
                        </select>
                    </div><br><br>


                    <div class="col-md-4">
                        <input type="submit" name="app-submit" value="Create new entry" class="btn btn-primary"
                            id="inputbtn">
                    </div>
                    <div class="col-md-8"></div>

                    <script>
                    function getUniqueSpecsFromCity(city, doctb) {
                        let uniqueSpecs = [];

                        for (let doctorId in doctb) {
                            if (doctb.hasOwnProperty(doctorId) && doctb[doctorId].city === city) {
                                let spec = doctb[doctorId].spec;

                                // Check if the spec is not already in the array
                                if (!uniqueSpecs.includes(spec)) {
                                    uniqueSpecs.push(spec);
                                }
                            }
                        }

                        return uniqueSpecs;
                    }

                    function getUniqueCities(doctorTable) {
                        // Create an array to store unique cities
                        let uniqueCities = [];

                        // Iterate through each doctor entry in the doctorTable
                        for (const doctorId in doctorTable) {
                            if (doctorTable.hasOwnProperty(doctorId)) {
                                const doctor = doctorTable[doctorId];
                                const city = doctor.city;

                                // Check if the city is not already in the uniqueCities array
                                if (!uniqueCities.includes(city)) {
                                    uniqueCities.push(city);
                                }
                            }
                        }

                        return uniqueCities;
                    }

                    var doctb = <?php echo $doctb; ?>;
                    console.log(doctb);
                    var availabilitytb = <?php echo $availabilitytb; ?>;
                    console.log(availabilitytb);
                    // on change spec
                    document.getElementById('spec').onchange = function() {
                        // update doctors
                        let docs;
                        let spec = this.value;
                        docs = [...document.getElementById('doctor').options];

                        docs.forEach((el, ind, arr) => {
                            arr[ind].setAttribute("style", "");
                            if (el.getAttribute("data-spec") != spec) {
                                arr[ind].setAttribute("style", "display: none");
                            } else {
                                arr[ind].setAttribute("style", "display: block");
                            }
                        });

                        // update city
                        docs = [...document.getElementById('city').options];
                        AllowedCities = getUniqueCities(doctb);

                        docs.forEach((el, ind, arr) => {
                            arr[ind].setAttribute("style", "");
                            if (!AllowedCities.includes(el.value)) {
                                arr[ind].setAttribute("style", "display: none");
                            } else {
                                arr[ind].setAttribute("style", "display: block");
                            }
                        });

                    };

                    // on change city
                    document.getElementById('city').onchange = function() {
                        // update doctor
                        let city = this.value;
                        docs = [...document.getElementById('doctor').options];

                        docs.forEach((el, ind, arr) => {
                            arr[ind].setAttribute("style", "");
                            if (el.getAttribute("data-city") != city) {
                                arr[ind].setAttribute("style", "display: none");
                            }
                        });

                        // update spec
                        docs = [...document.getElementById('spec').options];
                        AllowedSpecialities = getUniqueSpecsFromCity(city, doctb)
                        docs.forEach((el, ind, arr) => {
                            arr[ind].setAttribute("style", "");
                            if (!AllowedSpecialities.includes(el.value)) {
                                arr[ind].setAttribute("style", "display: none");
                            } else {
                                arr[ind].setAttribute("style", "display: block");
                            }
                        });

                    };

                    document.getElementById('doctor').onchange = function() {
                        // update fees
                        var selection = document.querySelector(`[value=${this.value}]`).getAttribute('data-value');
                        document.getElementById('docFees').value = selection;

                        // update available dates
                        var id = document.querySelector(`[value=${this.value}]`).getAttribute('docID');
                        var dateInput = document.getElementById('appdate');

                        var availableDates = availabilitytb
                            .filter(function(item) {
                                return item.doctor_id === id;
                            })
                            .map(function(item) {
                                return item.date;
                            });

                        dateInput.innerHTML = '';

                        dateInput.setAttribute('disabled', 'disabled');

                        var defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.text = 'Select Date';
                        dateInput.add(defaultOption);

                        availableDates.forEach(function(date) {
                            var option = document.createElement('option');
                            option.value = date;
                            option.text = date;
                            dateInput.add(option);
                        });

                        if (availableDates.length > 0) {
                            dateInput.removeAttribute('disabled');
                        }

                        var spec = document.querySelector(`[value=${this.value}]`).getAttribute('data-spec');
                        var city = document.querySelector(`[value=${this.value}]`).getAttribute('data-city');

                        var spec_selector = document.getElementById("spec");
                        var city_selector = document.getElementById("city");

                        var spec_choice = Array.from(spec_selector.options).find(option => option.value === spec);
                        if (spec_choice) {
                            spec_choice.selected = true;
                        }
                        var city_choice = Array.form(city_selector.options).find(option => option.value === city);
                        if (city_choice) {
                            city_choice.selected = true;
                        }
                    };

                    // Initial call to set available dates when the page loads
                    document.getElementById('doctor').dispatchEvent(new Event('change'));
                    </script>
                </div>
            </form>

        </div>
    </section><!-- End Appointment Section -->


    <section id="appointment-history" style="margin-bottom:30px;">
        <div class="unique-table">
            <h4 style="margin-bottom:20px;">Appointment History</h4>
            <table class="table table-hover">
                <thead>
                    <tr>

                        <th scope="col">Doctor Name</th>
                        <th scope="col">Consultancy Fees</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Current Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    global $con;

                    $query = "select ID,doctor,docFees,appdate,userStatus,doctorStatus from appointmenttb where fname ='$fname' and lname='$lname';";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
              
                      #$fname = $row['fname'];
                      #$lname = $row['lname'];
                      #$email = $row['email'];
                      #$contact = $row['contact'];
                  ?>
                    <tr>
                        <td><?php echo $row['doctor'];?></td>
                        <td><?php echo $row['docFees'];?></td>
                        <td><?php echo $row['appdate'];?></td>

                        <td>
                            <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
                    {
                      echo "Active";
                    }
                    if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
                    {
                      echo "Cancelled by You";
                    }

                    if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
                    {
                      echo "Cancelled by Doctor";
                    }
                        ?></td>

                        <td>
                            <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
                        { ?>


                            <a href="index.php?ID=<?php echo $row['ID']?>&cancel=update"
                                onClick="return confirm('Are you sure you want to cancel this appointment ?')"
                                title="Cancel Appointment" tooltip-placement="top" tooltip="Remove"><button
                                    class="btn btn-danger">Cancel</button></a>
                            <?php } else {

                                echo "Cancelled";
                                } ?>

                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <style>
        .unique-table {
            display: flex;
            flex-direction: column;
            text-align: center;
            justify-content: center;
            width: 100%;
        }

        .unique-table table {
            text-align width: 80%;
            float: center;
        }
        </style>
    </section>

    <section id="prescription-history">
        <div class="unique-table">
            <h4 style="margin-bottom:20px;">Prescription History</h4>
            <table class="table table-hover">
                <thead>
                    <tr>

                        <th scope="col">Doctor Name</th>
                        <th scope="col">Appointment ID</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Diseases</th>
                        <th scope="col">Allergies</th>
                        <th scope="col">Prescriptions</th>
                        <th scope="col">Bill Payment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    global $con;

                    $query = "select doctor,ID,appdate,disease,allergy,prescription from prestb where pid='$pid';";
                    
                    $result = mysqli_query($con,$query);
                    if(!$result){
                      echo mysqli_error($con);
                    }
                    

                    while ($row = mysqli_fetch_array($result)){
                  ?>
                    <tr>
                        <td><?php echo $row['doctor'];?></td>
                        <td><?php echo $row['ID'];?></td>
                        <td><?php echo $row['appdate'];?></td>
                        <td><?php echo $row['disease'];?></td>
                        <td><?php echo $row['allergy'];?></td>
                        <td><?php echo $row['prescription'];?></td>
                        <td>
                            <form method="get">
                                <!-- <a href="index.php?ID=" 
                              onClick=""
                              title="Pay Bill" tooltip-placement="top" tooltip="Remove"><button class="btn btn-success">Pay</button>
                              </a></td> -->

                                <a href="index.php?ID=<?php echo $row['ID']?>">
                                    <input type="hidden" name="ID" value="<?php echo $row['ID']?>" />
                                    <input type="submit" name="generate_bill"
                                        class="btn btn-success" value="Show Bill" />
                                </a>
                            </form>
                        </td>

                    </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    
    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container">

            <div class="section-title">
                <h2>Gallery</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
                    fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row g-0">

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="assets/img/gallery/gallery-1.jpg" class="galelry-lightbox">
                            <img src="assets/img/gallery/gallery-1.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="assets/img/gallery/gallery-2.jpg" class="galelry-lightbox">
                            <img src="assets/img/gallery/gallery-2.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="assets/img/gallery/gallery-3.jpg" class="galelry-lightbox">
                            <img src="assets/img/gallery/gallery-3.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="assets/img/gallery/gallery-4.jpg" class="galelry-lightbox">
                            <img src="assets/img/gallery/gallery-4.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="assets/img/gallery/gallery-5.jpg" class="galelry-lightbox">
                            <img src="assets/img/gallery/gallery-5.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="assets/img/gallery/gallery-6.jpg" class="galelry-lightbox">
                            <img src="assets/img/gallery/gallery-6.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="assets/img/gallery/gallery-7.jpg" class="galelry-lightbox">
                            <img src="assets/img/gallery/gallery-7.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="assets/img/gallery/gallery-8.jpg" class="galelry-lightbox">
                            <img src="assets/img/gallery/gallery-8.jpg" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
    <div class="container">

        <div class="section-title">
        <h2>Contact</h2>
        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>
    </div>

    <div>
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="container">
        <div class="row mt-5">

        <div class="col-lg-4">
            <div class="info">
            <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>A108 Adam Street, New York, NY 535022</p>
            </div>

            <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>care.group890@gmail.com</p>
            </div>

            <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+1 5589 55488 55s</p>
            </div>

            </div>

        </div>

        <div class="col-lg-8 mt-5 mt-lg-0">

            <form method="post" action="contact.php">
            <div class="row">
                <div class="col-md-6 form-group">
                <input type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" onkeydown="return alphaOnly(event);" required/>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" name="txtEmail" class="form-control" placeholder="Your Email *" value="" required />
                </div>
            </div>
            <div class="form-group mt-3">
            <input type="tel" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" minlength="10" maxlength="10" required />
            </div>
            <div class="form-group mt-3">
            <textarea name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;" required></textarea>
            </div>
            <div class="text-center"><input type="submit" name="btnSubmit" class="btn btn-primary"   value="Send Message" /></div>
            </form>

        </div>

        </div>

    </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->


<?php
  require_once "includes/footer.php";
?>
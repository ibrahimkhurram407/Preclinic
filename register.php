<!DOCTYPE html>
<html lang="en">


<!-- register24:03-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>
    <link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="admin/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="admin/assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper  account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <form method="post" action="PatRegFunc.php" class="form-signin">
                        <div class="account-logo">
                            <a href="index.php"><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" placeholder="First Name *" name="fname"
                                onkeydown="return alphaOnly(event);" required />
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name *" name="lname"
                                onkeydown="return alphaOnly(event);" required />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Your Email *" name="email" />
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Address *" id="address"
                                name="address" required />
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" class="form-control" placeholder="Contact No. *" id="contact"
                                name="contact" required />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password *" id="password"
                                name="password" onkeyup='check();' required />
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password *"
                                name="cpassword" onkeyup='check();' required /><span id='message'></span>
                        </div>
                        <div class="form-group">
                            <div class="maxl">
                                <label class="radio inline">
                                    <input type="radio" name="gender" value="Male" checked>
                                    <span> Male </span>
                                </label>
                                <label class="radio inline">
                                    <input type="radio" name="gender" value="Female">
                                    <span>Female </span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group checkbox">
                            <label>
                                <input type="checkbox"> I have read and agree the Terms & Conditions
                            </label>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btnRegister" name="patsub1" onclick="return checklen();"
                                value="Register" />
                        </div>
                        <div class="text-center login-link">
                            Already have an account? <a href="login.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    var check = function() {
        if (document.getElementById('password').value ==
            document.getElementById('cpassword').value) {
            document.getElementById('message').style.color = '#5dd05d';
            document.getElementById('message').innerHTML = 'Matched';
        } else {
            document.getElementById('message').style.color = '#f55252';
            document.getElementById('message').innerHTML = 'Not Matching';
        }
    }

    function alphaOnly(event) {
        var key = event.keyCode;
        return ((key >= 65 && key <= 90) || key == 8 || key == 32);
    };

    function checklen() {
        var pass1 = document.getElementById("password");
        if (pass1.value.length < 6) {
            alert("Password must be at least 6 characters long. Try again!");
            return false;
        }
    }
    </script>

    <script src="admin/assets/js/jquery-3.2.1.min.js"></script>
    <script src="admin/assets/js/popper.min.js"></script>
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <script src="admin/assets/js/app.js"></script>
</body>


<!-- register24:03-->

</html>
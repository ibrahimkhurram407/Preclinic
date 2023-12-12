<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="admin/assets/img/favicon.ico">
    <title>Preclinic - Medical & Hospital</title>
    <link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="admin/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="admin/assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="admin/assets/js/html5shiv.min.js"></script>
		<script src="admin/assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    <form method="post" action="doctorLoginFunc.php" class="form-signin">
						<div class="account-logo">
                            <a href="index.php"><img src="admin/assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="User Name *"
                                            name="username3" onkeydown="return alphaOnly(event);" required />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password *"
                                            name="password3" required />
                        </div>
                        
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn"  name="docsub1" value="Login">Login</button>
                        </div>
                        <div class="text-center register-link">
                            Don’t have an account? <a href="register.php">Register Now</a>
                        </div>
                    </form>
                </div>
			</div>
        </div>
    </div>
    <script src="admin/assets/js/jquery-3.2.1.min.js"></script>
	<script src="admin/assets/js/popper.min.js"></script>
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <script src="admin/assets/js/app.js"></script>
</body>


<!-- login23:12-->
</html>
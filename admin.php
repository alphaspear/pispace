<?php
    include_once 'database.php';
    session_start();
    if(isset($_SESSION["email"]))
	{
		session_destroy();
    }
    
    $ref=@$_GET['q'];
    if(isset($_POST['submit']))
	{	
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = stripslashes($email);
        $email = addslashes($email);
        $password = stripslashes($password); 
        $password = addslashes($password);

        $email = mysqli_real_escape_string($con,$email);
        $password = mysqli_real_escape_string($con,$password);
        
        $result = mysqli_query($con,"SELECT email FROM admin WHERE email = '$email' and password = '$password'") or die('Error');
        $count=mysqli_num_rows($result);
        if($count==1)
        {
            session_start();
            if(isset($_SESSION['email']))
            {
                session_unset();
            }
            $_SESSION["name"] = 'Admin';
            $_SESSION["key"] ='admin';
            $_SESSION["email"] = $email;
            header("location:dashboard.php?q=0");
        }
        else
        {
            echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
            header("refresh:0;url=admin.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags-->
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="Colorlib Templates" />
		<meta name="author" content="Colorlib" />
		<meta name="keywords" content="Colorlib Templates" />

		<!-- Title Page-->
		<title>User Login</title>

		<!-- Icons font CSS-->
		<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all" />
		<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all" />
		<!-- Font special for pages-->
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

		<!-- Vendor CSS-->
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all" />
		<link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all" />

		<!-- Main CSS-->
		<link href="css/main.css" rel="stylesheet" media="all" />
	</head>

	<body>
		<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
			<div class="wrapper wrapper--w680">
				<div class="card card-4" style="margin-top:15%;">
					<div class="card-body">
						<h2 class="title">Admin Login</h2>
						<form method="post" action="admin.php" enctype="multipart/form-data">
							

							

							<div class="row row-space">
								<div class="col-2">
									<div class="input-group">
										<label class="label">Email</label>
										<input class="input--style-4" type="email" name="email" required />
									</div>
								</div>
								<div class="col-2">
									<div class="input-group">
										<label class="label">Password</label>
										<input class="input--style-4" type="password" name="password" required />
									</div>
								</div>
							</div>
							
							<div class="p-t-15">
								<button class="btn btn--radius-2 btn--blue" name="submit">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Jquery JS-->
		<script src="vendor/jquery/jquery.min.js"></script>
		<!-- Vendor JS-->
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/datepicker/moment.min.js"></script>
		<script src="vendor/datepicker/daterangepicker.js"></script>

		<!-- Main JS-->
		<script src="js/global.js"></script>
	</body>
	<!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
<!-- end document-->

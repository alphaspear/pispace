<?php
	include("database.php");
	session_start();
	
	if(isset($_POST['submit']))
	{	
		$name = $_POST['name'];
		$name = stripslashes($name);
		$name = addslashes($name);

		$email = $_POST['email'];
		$email = stripslashes($email);
		$email = addslashes($email);

		$password = $_POST['password'];
		$password = stripslashes($password);
		$password = addslashes($password);

		
		$str="SELECT email from user WHERE email='$email'";
		$result=mysqli_query($con,$str);
		
		if((mysqli_num_rows($result))>0)	
		{
            echo "<center><h3><script>alert('Sorry.. This email is already registered !!');</script></h3></center>";
            header("refresh:0;url=login.php");
        }
		else
		{
            $str="insert into user set name='$name',email='$email',password='$password'";
			if((mysqli_query($con,$str)))	
			echo "<center><h3><script>alert('Congrats.. You have successfully registered !!');</script></h3></center>";
			header('location: welcome.php?q=1');
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
		<title>User Registration Form</title>

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
				<div class="card card-4">
					<div class="card-body">
						<h2 class="title">User Registration Form</h2>
						<form method="post" action="register.php" enctype="multipart/form-data">
							<div class="row row-space">
								<div class="col-2">
									<div class="input-group">
										<label class="label">Name</label>
										<input class="input--style-4" type="text" name="name" required />
									</div>
								</div>

								
							</div>
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
								<button class="btn btn--radius-2 btn--blue" name="submit" >Submit</button>
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

<?php
	require('database.php');
	session_start();
	if(isset($_SESSION["email"]))
	{
		session_destroy();
	}
	
	$ref=@$_GET['q'];		
	if(isset($_POST['submit']))
	{	
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$email = stripslashes($email);
		$email = addslashes($email);
		$pass = stripslashes($pass); 
		$pass = addslashes($pass);
		$email = mysqli_real_escape_string($con,$email);
		$pass = mysqli_real_escape_string($con,$pass);					
		$str = "SELECT * FROM user WHERE email='$email' and password='$pass'";
		$result = mysqli_query($con,$str);
		if((mysqli_num_rows($result))!=1) 
		{
			echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
			header("refresh:0;url=login.php");
		}
		else
		{
			$_SESSION['logged']=$email;
			$row=mysqli_fetch_array($result);
			$_SESSION['name']=$row[1];
			$_SESSION['id']=$row[0];
			$_SESSION['email']=$row[2];
			$_SESSION['password']=$row[3];
			header('location: welcome.php?q=1'); 					
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="Colorlib Templates" />
		<meta name="author" content="Colorlib" />
		<meta name="keywords" content="Colorlib Templates" />
		<title>User Login</title>
		<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all" />
		<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all" />
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all" />
		<link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all" />
		<link href="css/main.css" rel="stylesheet" media="all" />
	</head>
	<body>
		<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
			<div class="wrapper wrapper--w680">
				<div class="card card-4" style="margin-top:15%;">
					<div class="card-body">
						<h2 class="title">User Login</h2>
						<form method="post" action="login.php" enctype="multipart/form-data">
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
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/datepicker/moment.min.js"></script>
		<script src="vendor/datepicker/daterangepicker.js"></script>
		<script src="js/global.js"></script>
	</body>
</html>

<?php
    include_once 'database.php';
    session_start();
    if(!(isset($_SESSION['email'])))
    {
        header("location:login.php");
    }
    else
    {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        include_once 'database.php';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ONGC Quiz System</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link  rel="stylesheet" href="css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="css/welcome.css">
    <link  rel="stylesheet" href="css/font.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"  type="text/javascript"></script>
    <script type="text/javascript">

</script>
    <style>
@media screen and (max-width: 600px) {
  .col-md-12 {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}
</style>
</head>
<body style=" background-color:#4c0000" onload="countdown()">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">PI SPACE</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		<li <?php if(@$_GET['q']==1) echo'class="active"'; ?> class="nav-item active">
        <a class="nav-link" href="welcome.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a>
      </li>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
        <li <?php echo''; ?> > <a href="logout.php?q=welcome.php" style="color:black;"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Log out</a></li>
        </ul>
	  </div>
</nav>
<h1>welcome <?php echo $name ?><h1>
    <div>
<?php
$str="SELECT structure FROM `user` WHERE email = '$email'";
$result = $con->query($str);
if ($result->num_rows > 0) 
{
  // output data of each row
  while($row = $result->fetch_assoc()) 
  {
    echo $row["structure"];
  }
}
?>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>                
</body>
</html>
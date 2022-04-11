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
    window.onbeforeunload = function() {
        return "Dude, are you sure you want to leave? Think of the kittens!";
    }
</script>

    <script type="text/javascript">
        var ss = 60*<?php $timelimit=@$_GET['timelimit'];echo($timelimit);?>;
        function countdown() 
        {
            ss = ss-1;
            if (ss<0) 
            {
                document.getElementById('abhilash').click();
            }
            else 
            {
                var h = Math.floor(ss / 3600);
                var m = Math.floor(ss % 3600 / 60);
                var s = Math.floor(ss % 3600 % 60);
                var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
                var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
                var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
                document.getElementById("countdown").innerHTML=hDisplay + mDisplay + sDisplay;
                window.setTimeout("countdown()", 1000);
            }   
        }
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
<body style=" background-color:#4c0000"  onload="countdown()">

    <br><br>
                <?php
                    if(@$_GET['q']== 'quiz') 
                    {
                        $eid=@$_GET['eid'];
                        
                        $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0',NOW() )")or die('Error137');

                        $q=mysqli_query($con,"SELECT * FROM question WHERE eid='$eid' ORDER BY sn " );
                    
                        echo'<h1 style="position: Absolute; top: 20px; color:white;" id="countdown"></h1>';////timer placement
                        echo '<form action="update.php?q=evaluation&eid='.$eid.'" method="POST"  class="form-horizontal"><br />';
                        
                        while($row=mysqli_fetch_array($q) )
                        {
                            echo'<h1 style="position: Absolute; top: 20px; color:white;" id="countdown"></h1>';////timer placement
                            echo '<div class="panel" style="margin:5%">';
                            $qns=$row['qns'];
                            $sn=$row['sn'];
                            $qid=$row['qid'];
                            $optiona=$row['optiona'];
                            $optionb=$row['optionb'];
                            $optionc=$row['optionc'];
                            $optiond=$row['optiond'];
                            
                            
                            echo '<b>Question &nbsp;'.$sn.'&nbsp; <br/><br/>'.$qns.'</b>';
                            echo'<br/><br/>
                                        <input type="radio" name="'.$qid.'ans" value="a">&nbsp;'.$optiona.'<br /><br />
                                        <input type="radio" name="'.$qid.'ans" value="b">&nbsp;'.$optionb.'<br /><br />
                                        <input type="radio" name="'.$qid.'ans" value="c">&nbsp;'.$optionc.'<br /><br />
                                        <input type="radio" name="'.$qid.'ans" value="d">&nbsp;'.$optiond.'<br /><br />
                            </div>';
                            
                        }
                        echo '<div class="panel" style="margin:5%">';
                        
                        echo'<button id="abhilash" type="submit" style="color:black;background-color:#cccccc;"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></div>';
                        
                        echo'</form>';
                        
                    
                    }


                    if(@$_GET['q']== 'result' && @$_GET['eid']) 
                    {
                        echo '<h1 style="color:white; font-size:40px;text-shadow:5px 5px 5px black;" ><i>YOUR ANSWERS ARE SUBMITTED!!</i></h1>';
                    }
                ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>                
</body>
</html>
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
<html>
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
</head>

<body style=" background-color:#4c0000">
<nav class="navbar navbar-expand-lg navbar-expand-lg-md navbar-light bg-light">
  <a class="navbar-brand" href="#"><b>ONGC QUIZ SYSTEM</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li <?php if(@$_GET['q']==0) echo'class="active"'; ?>><a href="dashboard.php?q=0" style="color:#827b7b;font-size: 15px; ">HOME<span class="sr-only">(current)</span></a></li>
                    <li style="padding-left :20px;"<?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="dashboard.php?q=1" style="color:#827b7b;font-size: 15px;">USERS</a></li>
                    <li style="padding-left :20px;" <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="dashboard.php?q=2"style="color:#827b7b;font-size: 15px;">QUIZ OPTIONS</a></li>
                    <li style="padding-left :20px;" class="dropdown <?php if(@$_GET['q']==4 || @$_GET['q']==5) echo'active"'; ?>">
                    <li style="padding-left :20px;" ><a href="dashboard.php?q=4" style="color:#827b7b;font-size: 15px;">CREATE QUIZ</a></li>
                    <li style="padding-left :20px; padding-right:600px;color:#827b7b;font-size: 15px;"><a href="dashboard.php?q=5" style="color:#827b7b;">CREATE ADMIN USER</a></li>
                    <li  <?php echo''; ?> > <a href="logout.php?q=dashboard.php" style="color:#827b7b;font-size: 15px;"><span class="glyphicon glyphicon-log-out" aria-hidden="true" style="color:#827b7b;"></span>&nbsp;LOGOUT</a></li>
    </ul>
  </div>
</nav>



    <div class="container">
        <div class="row">

                <?php if(@$_GET['q']==0)
                {
                   echo '<h1 style="color:white; font-size:40px;text-shadow:5px 5px 5px black;"><i><b>WELCOME TO ADMIN PAGE!!</b></i></h1>';
					
                }
                ?>
                <?php if(@$_GET['q']==2) 
                {
                    ////////////////////////////////////////////////////////////////////////
                    $qu = "SELECT * FROM quiz ";
                    $re = mysqli_query($con, $qu);
                    $ro = mysqli_fetch_array($re, MYSQLI_ASSOC);
                    if(! $ro) {
                        echo '<h1 style="color:white;font-size:40px;text-shadow:5px 5px 5px black;">No Quiz Available</h1>';
                    } 
                    else {

                        
                    ////////////////////////////////////////////////////////////////////////
                    $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
                    $c=1;
                    while($row = mysqli_fetch_array($result)) {
                        $title = $row['title'];
                        $total = $row['total'];
                        $timelimit=$row['timelimit'];
                        $status=$row['status'];
                        $eid = $row['eid'];
                    $q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
                    $rowcount=mysqli_num_rows($q12);	
                    if($rowcount == 0){
                    
                ///////////////////////////////////////////////////////
                $c++;
                echo'<div class="col-12 col-sm-6 col-md-4">
				<div class="card mx-2 my-2" href="google.com">
						<div class="card-body">
							<h4><b>'.$title.'</b></h4> 
							<p>Number Of Questions: '.$total.'</p>
							<p>Max Marks:'.$total.' </p>
                            <p>Time Limit: '.$timelimit.' minutes </p>
                            <p>Status:'. $status.' </p>
							<p><a href="dashboard.php?q=result2&eid='.$eid.'" class="btn sub1" style="color:black;margin:0px;background:#cccccc"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b >VIEW RESULTS</b></span></a>   <a href="update.php?q=rmquiz&eid='.$eid.'" class="pull-right btn sub1" style="margin:0px;background:#cccccc;color:black"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>REMOVE QUIZ</b></span></a></p>
                            <p><center><a href="update.php?q=changestatus&eid='.$eid.'" class="pull-center btn sub1" style="margin:0px;background:#cccccc;color:black"><span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>&nbsp;<span class="title1"><b>CHANGE STATUS</b></span></a></center></p></center>
                        </div>
					</div>
					</div>';
                    ///////////////////////////////////////////////////
                    }
                    }
                    $c=0;
                    echo '</table></div></div>';
                }}?>
                <!--result functionalitty&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
                <?php
                    if(@$_GET['q']== 'result2') 
                    {
                        $eid=@$_GET['eid'];
                        $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' " );
                        
                        echo'<div class="panel title"><div class="table-responsive"><table class="table table-striped title1"">
                        <tr>
                          <th>Email</th>
                          <th>Marks</th>
                        </tr>';
                        
                        while($row=mysqli_fetch_array($q) )
                        {
                            $email=$row['email'];
                            $score=$row['score'];
                        echo'<tr>
                            <td>'.$email.'</td>
                            <td>'.$score.'</td>
                          </tr>';
                        }
                        echo'</table></div></div>';
                    }

                    if(@$_GET['q']== 'result' && @$_GET['eid']) 
                    {
                        $eid=@$_GET['eid'];
                        $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
                        echo  '<div class="panel">
                        <center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

                        while($row=mysqli_fetch_array($q) )
                        {
                            $s=$row['score'];
                            $w=$row['wrong'];
                            $r=$row['correct'];
                            $qa=$row['level'];
                            echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
                                <tr style="color:#99cc32"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
                                <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
                                <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
                        }
                        $q=mysqli_query($con,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');
                        while($row=mysqli_fetch_array($q) )
                        {
                            $s=$row['score'];
                            echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
                        }
                        echo '</table></div>';
                    }
                ?>
                <!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
                <?php 
                    if(@$_GET['q']==1) 
                    {
                        $result = mysqli_query($con,"SELECT * FROM user") or die('Error');
                        echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
                        <tr><td><center><b>NAME</b></center></td><td><center><b>DEPARTMENT</b></center></td><td><center><b>EMAIL</b></center></td><td><center><b>ACTIONS</b></center></td></tr>';
                        $c=1;
                        while($row = mysqli_fetch_array($result)) 
                        {
                            $name = $row['name'];
                            $email = $row['email'];
                            $department = $row['department'];
                            $c++;
                            echo '<tr><td><center>'.$name.'</center></td><td><center>'.$department.'</center></td><td><center>'.$email.'</center></td><td><center><a title="Delete User" href="update.php?demail='.$email.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></center></td></tr>';
                        }
                        $c=0;
                        echo '</table></div></div>';
                    }
                ?>

                <?php
                    if(@$_GET['q']==4 && !(@$_GET['step']) ) 
                    {
                        echo '<div class="row"><center><span class="title1" style="font-size:30px;color:#fff;"><b>Enter Quiz Details</b></span></center><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6">   
                        <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="name"></label>  
                                    <div class="col-md-12">
                                        <input id="name" name="name" placeholder="QUIZ TITLE" class="form-control input-md" type="text" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="total"></label>  
                                    <div class="col-md-12">
                                        <input id="total" name="total" placeholder="NUMBER OF QUESTIONS" class="form-control input-md" type="number" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="timelimit"></label>  
                                    <div class="col-md-12">
                                        <input id="right" name="timelimit" placeholder="ENTER TIMELIMIT IN MINUTES" class="form-control input-md" min="0" type="number" required>
                                    </div>
                                </div>

                                
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for=""></label>
                                    <div class="col-md-12"> 
                                        <input  type="submit" style="margin-left:45%; color:black; background:#cccccc" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                                    </div>
                                </div>

                            </fieldset>
                        </form></div>';
                    }
                ?>
                <?php
                    if(@$_GET['q']==5) 
                    {
                        echo '<div class="row"><center><span class="title1" style="font-size:30px;color:#fff;"><b>Enter User Details</b></span></center><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6">   
                        <form class="form-horizontal title1" name="form" action="update.php?q=addadmin"  method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="name"></label>  
                                    <div class="col-md-12">
                                        <input id="name" name="name" placeholder="NAME" class="form-control input-md" type="text" required >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="email"></label>  
                                    <div class="col-md-12">
                                        <input id="total" name="email" placeholder="EMAIL" class="form-control input-md" type="email" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="password"></label>  
                                    <div class="col-md-12">
                                        <input id="right" name="password" placeholder="PASSWORD" class="form-control input-md" min="0" type="password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 control-label" for="cpassword"></label>  
                                    <div class="col-md-12">
                                        <input id="right" name="cpassword" placeholder="CONFIRM PASSWORD" class="form-control input-md" min="0" type="password" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for=""></label>
                                    <div class="col-md-12"> 
                                        <input  type="submit" style="margin-left:45%; color:black; background:#cccccc" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                                    </div>
                                </div>

                            </fieldset>
                        </form></div>';
                    }
                ?>
                <?php
                    if(@$_GET['q']==4 && (@$_GET['step'])==2 ) 
                    {
                        echo ' 
                        <div class="row">
                        <span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4 "  method="POST">
                        <fieldset>
                        ';
                
                        for($i=1;$i<=@$_GET['n'];$i++)
                        {
                            echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
                                        <div class="col-md-12">
                                            <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="QUESTION '.$i.' "></textarea>  
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'1"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'1" name="'.$i.'1" placeholder="OPTION A" class="form-control input-md" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'2"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'2" name="'.$i.'2" placeholder="OPTION B" class="form-control input-md" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'3"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'3" name="'.$i.'3" placeholder="OPTION C" class="form-control input-md" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for="'.$i.'4"></label>  
                                        <div class="col-md-12">
                                            <input id="'.$i.'4" name="'.$i.'4" placeholder="OPTION D" class="form-control input-md" type="text" required>
                                        </div>
                                    </div>
                                    <br />
                                    <b>Correct answer</b>:<br />
                                    <select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" >
                                    <option value="a">QUESTION '.$i.' ANSWER</option>
                                    <option value="a"> OPTION A</option>
                                    <option value="b"> OPTION B</option>
                                    <option value="c"> OPTION C</option>
                                    <option value="d"> OPTION D</option> </select><br /><br />'; 
                        }
                        echo '<div class="form-group">
                                <label class="col-md-12 control-label" for=""></label>
                                <div class="col-md-12"> 
                                    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                                </div>
                              </div>

                        </fieldset>
                        </form></div>';
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>                
</body>
</html>

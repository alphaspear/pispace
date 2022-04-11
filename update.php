<?php
  include_once 'database.php';
  session_start();
  $email=$_SESSION['email'];

  if(isset($_SESSION['key']))
  {
    if(@$_GET['demail']) 
    {
      $demail=@$_GET['demail'];
      $r1 = mysqli_query($con,"DELETE FROM rank WHERE email='$demail' ") or die('Error');
      $r2 = mysqli_query($con,"DELETE FROM history WHERE email='$demail' ") or die('Error');
      $result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
      header("location:dashboard.php?q=1");
    }
  }

  if(isset($_SESSION['key']))
  {
    if(@$_GET['q']== 'changestatus') 
    {
      $eid=@$_GET['eid'];

      $w=mysqli_query($con,"SELECT `status` FROM `quiz` WHERE eid='$eid'");
      $row = mysqli_fetch_array($w);
      $status=$row['status'];
        if($status=='enabled')
        {
          $q=mysqli_query($con,"UPDATE `quiz` SET `status`='disabled' WHERE eid = '$eid'")or die('Error147');
        }
        else
        {
          $q=mysqli_query($con,"UPDATE `quiz` SET `status`='enabled' WHERE eid = '$eid'")or die('Error147');    
        }
      header("location:dashboard.php?q=2");
    }
  }


  if(isset($_SESSION['key']))
  {
    if(@$_GET['q']== 'rmquiz') 
    {
      $eid=@$_GET['eid'];
      $r3 = mysqli_query($con,"DELETE FROM question WHERE eid='$eid' ") or die('Error');
      $r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
      $r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');
      header("location:dashboard.php?q=2");
    }
  }

  if(isset($_SESSION['key']))
  {
    if(@$_GET['q']== 'addadmin') 
    {
      $name=@$_POST['name'];
      $email=@$_POST['email'];
      $password=@$_POST['password'];
      $r3 = mysqli_query($con,"INSERT INTO admin (name,email,password) VALUES ('$name','$email','$password')  ") or die('Error4');
      header("location:dashboard.php?q=0");
    }
  }

  if(isset($_SESSION['key']))
  {
    if(@$_GET['q']== 'addquiz') 
    {
      $name = $_POST['name'];
      $name= ucwords(strtolower($name));
      $total = $_POST['total'];
      $correct = $_POST['right'];
      $wrong = $_POST['wrong'];
      $timelimit=$_POST['timelimit'];
      $id=uniqid();
      $q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('$id','$name','$total', NOW(),'$timelimit','enabled')");
      header("location:dashboard.php?q=4&step=2&eid=$id&n=$total");
    }
  }

  if(isset($_SESSION['key']))
  {
    if(@$_GET['q']== 'addqns') 
    {
      $n=@$_GET['n'];
      $eid=@$_GET['eid'];
      $ch=@$_GET['ch'];
      for($i=1;$i<=$n;$i++)
      {
        $qid=uniqid();
        $qns=$_POST['qns'.$i];
        $oaid=uniqid();
        $obid=uniqid();
        $ocid=uniqid();
        $odid=uniqid();
        $a=$_POST[$i.'1'];
        $b=$_POST[$i.'2'];
        $c=$_POST[$i.'3'];
        $d=$_POST[$i.'4'];
        $e=$_POST['ans'.$i];
        switch($e)
        {
          case 'a': $ansid='a'; break;
          case 'b': $ansid='b'; break;
          case 'c': $ansid='c'; break;
          case 'd': $ansid='d'; break;
          default: $ansid='a';
        }
        $qd=mysqli_query($con,"INSERT INTO question VALUES  ('$eid','$qid','$i','$qns','$a','$b','$c','$d','$ansid')") or die('Error64');
      }
      header("location:dashboard.php?q=0");
    }
  }

  

function append_string ($str1, $str2)
{
    $str1 .=$str2;
    return $str1;
}
///////////////////////////////////
if(@$_GET['q']== 'evaluation' && @$_GET['eid'] ) 
{
  $eid=@$_GET['eid'];
  $current_score=0;
  $q=mysqli_query($con,"SELECT * FROM question WHERE eid='$eid'" )or die('Error156');
  while($row=mysqli_fetch_array($q))
  {
      $correct_answer= $row['ansid'];
      echo $correct_answer;
      $a=$row['qid'];
      $b='ans';
      $ooo=append_string($a,$b);
      $user_answer= $_POST[$ooo];
      echo $user_answer;
      if($correct_answer==$user_answer)
      {
          $current_score=$current_score+1;
      }

  }
  echo $current_score;
  $upd=mysqli_query($con,"UPDATE history SET score='$current_score' WHERE email='$email' AND eid='$eid' " )or die('Error156');
  header("location:welcome.php?q=result&eid=$eid");
}
/////////////////////////////////
?>
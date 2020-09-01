<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
  $_SESSION['alogin']='';
}
if(isset($_POST['login']))
{
$uname=$_POST['username'];
$password=md5($_POST['password']);

$sql ="SELECT UserName,Password ,pid FROM customer WHERE UserName=:uname and Password=:password";

$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
foreach($results as $result)
{ 
  $_SESSION['userpid']=$result->pid;
}

echo "<script type='text/javascript'> document.location = 'MainPage.php'; </script>";
} else{
  $sql ="SELECT UserName,Password ,pid,id FROM farmer WHERE UserName=:uname and Password=:password";

  $query= $dbh -> prepare($sql);
  $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
  $query-> bindParam(':password', $password, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
  $_SESSION['alogin']=$_POST['username'];
  foreach($results as $result)
  {
  $_SESSION['userpid']=$result->pid;
  $_SESSION['userid']=$result->id;
  } 
  echo "<script type='text/javascript'> document.location = 'MainPage.php'; </script>";
    

}else{
  $sql ="SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";

  $query= $dbh -> prepare($sql);
  $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
  $query-> bindParam(':password', $password, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
  $_SESSION['alogin']=$_POST['username'];
  foreach($results as $result)
  {
  $_SESSION['userid']=$result->id;
  } 
  echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
}else{
  $sql ="SELECT UserName,Password FROM logistic WHERE UserName=:uname and Password=:password";

  $query= $dbh -> prepare($sql);
  $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
  $query-> bindParam(':password', $password, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
  $_SESSION['alogin']=$_POST['username'];
  foreach($results as $result)
  {
  $_SESSION['userid']=$result->id;
  } 
  echo "<script type='text/javascript'> document.location = 'mainPageLogistic.php'; </script>";
  }else{
    echo "<script>alert('Invalid Details');</script>";
  }

}
}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/mystyle.css" rel="stylesheet">
</head>

<body>

  <!-- Start your project here-->
<form action="" method="post">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center dusty-grass-gradient">
        <h4 class="modal-title w-100 font-weight-bold dark-grey-text">Login</h4>
     
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input type="text" id="orangeForm-name" class="form-control validate" name="username">
          <label data-error="wrong" data-success="right" for="orangeForm-name">Username</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" class="form-control validate" name="password">
          <label data-error="wrong" data-success="right" for="orangeForm-pass">Password</label>
        </div>
      <!-- modal-body -->
      </div>
      
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn dusty-grass-gradient btn_login" name="login">LOGIN</button>
      </div>

      <p class="font-small grey-text d-flex justify-content-center">Don't have an account?<a href="register.php" class="text-success ml-1">
        Sign Up</a></p>


    <!-- modal-content -->
    </div>
  <!-- modal-dialog -->
  </div>

</form>


<!-- <div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalRegisterForm">Launch
    Modal Register Form</a>
</div> -->

  <!-- Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="js/style.js"></script>
</body>

</html>
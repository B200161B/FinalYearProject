<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['login']!=''){
    $_SESSION['login']='';
}

if(isset($_POST['login'])){
   
    $uname=$_POST['username'];
    $password=md5($_POST['password']);  
    $sql ="SELECT admin.UserName,admin.Password FROM admin WHERE UserName=:uname and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
  
    if($query->rowCount()>0){
        $_SESSION['login']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    }
    else{
    
        echo "<script>alert('Invalid Details');</script>";
    
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
        <style>
            .container{
                background-color:powderblue;
                width:60%;
            }
        </style>
    <title>Document</title>
</head>
<body >
<div class="container" >
    <h1 align="center">Vegetarian Distribution</h1>
    <form method="post"class="form-horizontal">
        
            <div class="form-group">
               <label for="username" class="col-sm-2 control-label">Username</label>
               <div class="col-sm-10">
               <input type="text" name="username" placeholder="username" class="form-control">
               </div>
               <!-- col-sm-10 -->
            </div>
            <!-- form-group -->

               <div class="form-group">
               <label for="username" class="col-sm-2 control-label">Password</label>
               <div class="col-sm-10">
               <input type="password" name="password" placeholder="password" class="form-control">
               </div>
               <!-- col-sm-10 -->
               </div>
            
            <!-- form-group -->

            <div class="form-group  mt-20" >
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="login" class="btn btn-success btn-labeled pull-right">Sign in<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
            </div>
            </div>
        
    </form>
    </div> <!-- container -->
</body>
</html>
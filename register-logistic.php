
<?php

session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{

      ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register</title>
        <script src="js/modernizr/modernizr.min.js"></script>
        <link rel="icon" href="icon.png">
  <style>
  .flex-container{
    display:flex;
    flex-wrap: wrap;
  }
  .flex-container div {
    margin-right:20px;
  }
    </style>
  </style>
</head>
<body>

<?php include('leftbar.php');  
      include('headerForAdmin.php');
?>

<div style="width:79%;margin-left:21%">

<h1>Register Logistic Company</h1>
    <div><a href="dashboard.php"><span>Home</span></a><span> / Register </span></div>
    <div class="flex-container">
    <div>
    <div><span> Full Name
    <input type="text" name="FullName" id="FullName" class="form-control"></span></div>
    <div><span> License</span></div>
    <input type="text" name="license" id="license" class="form-control">
    <div><span> Phone Number</span></div>
    <input type="number" name="phoneNumber" id="phoneNumber" class="form-control">
    <div><span> Username</span></div>
    <input type="text" name="username" id="username" class="form-control"> 
  
    </div>
    <!-- first child -->

    <div>
   
    <div><span> Password</span> </div>
    <input type="password" name="password" id="password" class="form-control">
    <div><span> Company Name</span> </div>
    <input type="text" name="companyName" id="companyName" class="form-control">
    <div><span> Company Address</span> </div>
    <input type="text" name="companyAddress" id="companyAddress" class="form-control">
   
    </div>
    
    <!-- second child -->
    </div>
    <!-- flex-container -->

    <div style="margin-left:30.5%">
        <input type="submit" name="submit" id="submit" class="btn btn-success">
    </div>

    </div>
    <!-- biggest -->
    <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
    <script>
      $("#submit").click(function(){
        var username = $("#username").val();
        var password = $("#password").val();
        var companyName = $("#companyName").val();
        var companyAddress = $("#companyAddress").val();
        var FullName = $("#FullName").val();
        var licenseID = $("#license").val();
        var PhoneNumber = $("#phoneNumber").val();
        $.ajax({
          url:"server.php",
          method:"post",
          data:
          {
            logisticusername:username,
            personInCharge:FullName,
            licenseID:licenseID,
            PhoneNumber:PhoneNumber,
            password:password,
            companyName:companyName,
            companyAddress:companyAddress
          },
          success:function(response)
          {
            alert("Logistic worker added");
            console.log(response);
          }
        });
      });
    </script>
</body>
</html>
    <?php } ?>
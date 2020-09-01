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
      <link rel="icon" href="icon.png">
        <title>Change password</title>
  <style>
  .flex-container{
    display:flex;
  }
  .flex-container div {
      padding:12px;
  }
    </style>
  </style>
</head>
<body>


<?php include('leftbar.php');  
      include('headerForAdmin.php');
?>

<div style="width:79%;margin-left:21%">

<h1>Change Password</h1>
    <div><a href="dashboard.php"><span>Home</span></a><span> / Change Password </span></div>
    <div class="flex-container">

    <div>
    <div><span> Old Password</span></div>
    <div><span> New Password</span> </div>
    <div><span> Confirm Password</span> </div>
    </div>
    <!-- first child -->

    <div>
    <input type="password" name="oldPassword" id="oldPassword" class="form-control">
    <input type="password" name="newPassword" id="newPassword" class="form-control">
    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
    </div>
    <!-- second child -->

    </div>
    <!-- flex-container -->

    <div style="margin-left:26%">
        <input type="submit" name="submit" id="submit" class="btn btn-success">
    </div>
    <!-- submit -->

    </div>
    <!-- biggest -->


    <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
    <script>
        $("#submit").click(function(){
          var oldPassword = $("#oldPassword").val();
          var newPassword = $("#newPassword").val();
          var confirmPassword = $("#confirmPassword").val();

          if(newPassword == confirmPassword){
            $.ajax({
              url:'server.php',
              method:'post',
              data:
              {
                oldPassword:oldPassword,
                newPassword:newPassword,
                confirmPassword:confirmPassword
              },
            success:function(response){
              alert(response);
              $("#oldPassword").val("");
              $("#newPassword").val("");
              $("#confirmPassword").val("");
            }
            });
          }
          else{
            alert("Not same password as confirm password");
            $("#oldPassword").val("");
              $("#newPassword").val("");
              $("#confirmPassword").val("");
          }
        });
        
    </script>
</body>
</html>

      <?php } ?>
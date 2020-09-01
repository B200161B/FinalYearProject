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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Details</title>
        <link rel="icon" href="icon.png">
        <style>
        .info > div{
            padding:10px;
           
        }
        .flex-container{
            display:flex;
        }
        </style>
    </head>
    <body>
    <?php include('leftbar.php');  
      include('headerForAdmin.php');
?>
        <form action="">
        <div style="width:79%;margin-left:21%">
      
        <h1>Logistic Details</h1>
        <div  class="flex-container">
        
        <div  class="info">
        <div>Person In Charge:</div>
        <div>License:</div>
        <div>PhoneNumber:</div>
        <div>Username:</div>
        <div>Company Name:</div>
        <div>Company Address:</div>
        </div>
        <!-- info -->

        <div class="info">
            <div id="personInCharge">None</div>
            <div id="license">None</div>
            <div id="phoneNumber">None</div>
            <div id="username">None</div>
            <div id="companyName">None</div>
            <div id="companyAddress">None</div>
        </div>
        </div>
        <!-- flex-container -->


        </div>
        <!-- biggest -->
        </form>
        <script src="js/jquerysession.js"></script> 
        <script>
            var id = <?php echo $_GET['id']; ?>;
          $.ajax({
            type:"GET",
            url:"server.php?logisticIDS='"+id+"'",
            dataType:'json',
            success:function(data)
            {           
            for(var i =0;i<data.length;i++){
               
                    $("#username").text(data[i].UserName+"");
                    $("#personInCharge").text((data[i].personInCharge+""));
                    $("#license").text(data[i].license+"");
                    $("#phoneNumber").text(0+data[i].PhoneNumber+"");
                    $('#companyName').text(data[i].companyName+"");
                    $("#companyAddress").text(data[i].companyAddress+"");
                }
                
            }
            });
               
     </script>
    </body>
    </html>
<?php
    }
?>
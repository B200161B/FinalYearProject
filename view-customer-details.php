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

        <div style="width:79%;margin-left:21%">
      
        <h1>Customer Details</h1>
        <div  class="flex-container">
 
         <img src="" style="border-radius:50%;height:40vh;margin-right:20vh" id="profilePic">

        <div  class="info">
        <div>Full Name:</div>
        <div>Username:</div>
        <div>Phone Number:</div>
        <div>IC Number:</div>
        <div>Gmail:</div>
        <div>Status:</div>
        <div>Address:</div>
        </div>
        <!-- info -->

        <div class="info">
        <div id="fullName">None</div>
        <div id="username">None</div>
        <div id="phoneNumber">None</div>
        <div id="icNumber">None</div>
        <div id="gmail">None</div>
        <div id="status">None</div>
        <div id="address">None</div>
        </div>
        </div>
        <!-- flex-container -->

        <div style="float:right">
        <input type="submit" value="Block" name="blockCustomer" id="block" class="btn btn-danger">
            </div>

        </div>
        <!-- biggest -->
      


        <script>
        var current=0;
        var id =0;
         $.ajax({
        type:"GET",
        url:"server.php?customerIDS=<?php echo $_GET['id'] ?>",
        dataType:'json',
        success:function(data)
        {           
            for(var i =0;i<data.length;i++){
                var cnt="Dont'know";
                    if(data[i].status==0){
                    cnt = "Active";
                    }
                    else if(data[i].status==1){
                    cnt = "Block";
                    $("#block").val("Active");
                    $("#block").addClass('btn-success').removeClass('btn-danger');
                    }
                    $("#fullName").text(data[i].FullName+"");
                    $("#username").text(data[i].UserName+"");
                    $("#phoneNumber").text((data[i].PhoneNumber+""));
                    $('#icNumber').text(data[i].ICNumber+"");
                    $("#gmail").text(data[i].gmail+"");
                    $("#address").text(data[i].address+"");
                    $("#status").text(cnt);

                    $("#profilePic").attr("src", "Upload/profilePic"+data[i].picture);
                    current = data[i].status;
                    id = data[i].id;
                }
                
            }
    });
     $("#block").click(function(){
        var responses = "";
        if(current== 1){
               current = 0;
               responses = "Active";
           }
           else{
               current = 1;
               responses = "Block";
           }
        $.ajax({
           
            url:'server.php',
            method:'post',
            data:{customerID: id,status: current,blockOrActiveCustomer:0},
            success:function(response){
                alert("The customer has been "+responses);
                window.location.href=('view-customer-details.php?id='+id);
            }
        });

     });
    
     </script>
    </body>
    </html>

    <?php } ?>

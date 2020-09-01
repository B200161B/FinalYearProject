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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
      
        <h1>Farmer Details</h1>
        <div  class="flex-container">
         <img src="" style="border-radius:50%;height:40vh;margin-right:20vh" id="profilePic">
        <div  class="info">
        <div>Full Name:</div>
        <div>Username:</div>
        <div>Phone Number:</div>
        <div>IC Number:</div>
        <div>Shop Name:</div>
        <div>Shop Adress:</div>
        <div>Gmail:</div>
        </div>
        <!-- info -->

        
        <div class="info">
        <div id="fullName">None</div>
        <div id="username">None</div>
        <div id="phoneNumber">None</div>
        <div id="icNumber">None</div>
        <div id="shopName"></div>
        <div id="shopAddress">None</div>
        <div id="gmail">None</div>
        <input type="hidden" name="password" id="password">
        </div>
        </div>
        <!-- flex-container -->

        <div style="float:right">
        <input type="submit" value="Accept"  class="btn btn-success" data-toggle="modal" data-target="#myModal"> 
        <input type="submit" value="Reject" name="reject" id = "reject" class="btn btn-danger">
            </div>
        </div>
        <!-- biggest -->

        <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Receive By</h4>
        </div>
        <div class="modal-body">
          <p>Delevery Company</p>
          <select name="deliveryCompany" id="deliveryCompany" class="form-control">
            <?php
                $sql = "SELECT companyName,id from logistic";
                $query = $dbh->prepare($sql);
                $query ->execute();
                $results =$query->fetchAll();

                foreach($results as $result){
                    ?><option value="<?php echo $result['id']?>"><?php echo $result['companyName'] ?></option><?php
                }
            ?>
          </select>
          
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" data-dismiss="modal" name="accept" id ="accept">
        </div>

        </div>
        </div>
    </div>
        <script>
        var id = 0;
         $.ajax({
        type:"GET",
        url:"server.php?verifyFarmerIDS=<?php echo $_GET['id'] ?>",
        dataType:'json',
        success:function(data)
        {           
            for(var i =0;i<data.length;i++){
               
                    $("#fullName").text(data[i].FullName+"");
                    $("#username").text(data[i].UserName+"");
                    $("#phoneNumber").text((data[i].PhoneNumber+""));
                    $('#icNumber').text(data[i].ICNumber+"");
                    $("#gmail").text(data[i].gmail+"");
                    $("#shopAddress").text(data[i].shopAddress+"");
                    $("#shopName").text(data[i].shopName+"");
                    $("#password").val(data[i].password);
                    $("#profilePic").attr("src", "Upload/profilePic"+data[i].picture);
                   
                    id = data[i].id;
                }
                
        },
        error:function(data,aa,throwsss){
            console.log(throwsss);
        }
    });
                
     $("#accept").click(function(){
         var FullName = $("#fullName").text();
         var userName = $("#username").text();
         var phoneNumber = parseInt($("#phoneNumber").text());
         var icNumber = $("#icNumber").text();
         var gmail = $("#gmail").text();
         var shopAddress = $("#shopAddress").text();
         var shopName = $("#shopName").text();
         var profilePic = $("#profilePic").attr("src");
         var password = $("#password").val();
         var deliveryCompany=$("#deliveryCompany").val();
        $.ajax({
           
           url:'server.php',
           method:'post',
           data:{
               deleteVerifyIDandAddOn: id,
               FullName:FullName,
               userName:userName,
               deliveryCompany:deliveryCompany,
               phoneNumber:phoneNumber,
               icNumber:icNumber,
               gmail:gmail,
               shopAddress:shopAddress,
               shopName:shopName,
               profilePic:profilePic,
               password:password,
           },
           success:function(response){
               alert("The farmer has been added");
               console.log(response);
                window.location.href=('view-farmer.php');
           }
       });
     });

     $("#reject").click(function(){
        $.ajax({
            url:'server.php',
            method:'post',
            data:{
                deleteVerifyIDandReject:id
            },
            success:function(response){
                alert("The farmer has been rejected");
                ocation.href=('verify-farmer.php');
            }
        });
     });


     </script>
    </body>
    </html>
<?php
    }
?>
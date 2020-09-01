<?php include ("includes/config.php") ?>
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
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <div style="width:79%;margin-left:21%">
      
        <h1>Order Details</h1>
        <div  class="flex-container">
        
        <div  class="info">
        <div>Quantity:</div>
        <div>Description:</div>
        <div>UnitPrce:</div>
        <div>Total Price:</div>
        <div>Status:</div>
        </div>
        <!-- info -->

        <div class="info">
            <div id="quantity1">None</div>
            <div id="description">None</div>
            <div id="unitPrice">None</div>
            <div id="totalPrice">None</div>
            <div id="status">Received</div>

        <!-- IPN Url -->

        <!-- Return URLs -->
        <input type='hidden' name='cancel_return' value='<?php echo $payment_return_cancel; ?>'>
        <input type='hidden' name='return' value='<?php echo $payment_return_success; ?>'>

        <!-- Submit Button -->
        <input type="hidden" name="cmd" value="_xclick">
        <input type="submit" value="Confirm" name="submit" class="btn btn-primary">
        </div>
        </div>
        <!-- flex-container -->

        <input type="hidden" name="business" id="business" >
        <input type="hidden" name="item_name" id="item_name">

        <input type="hidden" name="quantity" id="item_number">
        <input type="hidden" name="amount" id="amount">
        <input type="hidden" name="currency_code" value="MYR">

        <input type='hidden' name='notify_url' value='http://f278905e.ngrok.io/fyp3/paypal_ipn.php'>
        </div>
        <!-- biggest -->

     

        </form>
        <script src="js/jquerysession.js"></script> 
        <script>
            var id = <?php echo $_GET['id']; ?>;
            $.ajax({
            type:"GET",
            url:"server.php?order_details="+id,
            dataType:'json',
            success:function(data)
            {           
            for(var i =0;i<data.length;i++){
               
                    $("#quantity1").text(data[i].quantity+"");
                    $("#description").text(data[i].productName+"");
                    $("#unitPrice").text(data[i].unitPrice+"");
                    $("#totalPrice").text(data[i].quantity*data[i].unitPrice);

                    $("#quantity").val(data[i].quantity);
                    $("#item_name").val(data[i].farmerID);
                    $("#item_number").val(data[i].id);
                    $("#business").val(data[i].farmerEmail);
                    $("#amount").val(data[i].unitPrice);
                }
                
            },
            error:function(data,dd,dd1){
                console.log(dd1);
            }
            });
               
     </script>
    </body>
    </html>
<?php
    }
?>
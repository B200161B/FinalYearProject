
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
            justify-content: space-around;
        }
        </style>
    </head>
    <body>
    <?php include('leftbar.php');  
      include('headerForAdmin.php');
?>
      
        <div style="width:79%;margin-left:21%">
        <h1>Payment Details</h1>
      <div class="flex-container">
        <div>
        <div>Ship To: </div>
        <span id="customerAddress"></span>
        </div>
 
        <div>
            <div>ID: </div>
            <div>Date: </div>
            <div>Due Date: </div>
        </div>

        <div>
            <div id="id"><span>None</span></div>
            <div id="date"><span>None</span></div>
            <div id="dueDate"><span>None</span></div>
        </div>
      </div>
     
    <table id="example" class="display table table-striped table-bordered" cellspacing="0">

    <thead>
    <tr>
    <th>Qty</th>
    <th>Description</th>
    <th>UnitPrice</th>  
    <th>Total Price(RM)</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    </table>

    <h5 style="float:right">Total Price: <span id="totalPrice"></span></h5>
  

        </div>
        <!-- biggest -->

            <script>
    var id = <?php echo $_GET['id'] ?>;
    var totalPrice = 0.00;
$.ajax({
        type:"GET",
        url:"server.php?payment_details="+id,
        dataType:'json',
        success:function(data)
        {
            $("#customerAddress").text(data[0].customerAddress);
            $("#id").text(data[0].id);
            $("#date").text((data[0].creationDate));
            $("#dueDate").text(data[0].shipmentDate);
            for(var i =0;i<data.length;i++){

                totalPrice +=(data[i].unitPrice)*(data[i].quantity);
                var itemDataid=data[i].id;
                var cnt="";
                var text="";
                if(data[i].status==1){
                    cnt = "Paid";
                }
                else if(data[i].status==2){
                    cnt = "Sent";
                }
                else if(data[i].status==3){
                    cnt = "Received";
                    text='<a href="view-order-details.php?id='+data[i].id+'" class="btn btn-primary">Transfer</a>';
                }
                else if(data[i].status==4){
                    cnt = "Transfered";
                }
                $('#example ').append('<tr>'+
                '<td>'+data[i].quantity+'</td>'+
                '<td>'+data[i].name+'</td>'+    
               '<td>'+data[i].unitPrice+'</td>'+
               '<td>'+(data[i].quantity*data[i].unitPrice+".00")+'</td>'+
                '<td>'+cnt+'</td>'+ 
                '<td>'+text+'</td>'+
                '</tr>');

                }
                $("#totalPrice").text("RM"+totalPrice+".00");
                
            },
            error:function(jqXHR, textStatus, errorThrown)
            {
               console.log(errorThrown);
            }
    });
     
            </script>
    </body>
    </html>

<?php } ?>
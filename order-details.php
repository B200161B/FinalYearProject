

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

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
        <?php include('leftbar.php'); ?>
        <form action="">
        <div style="width:79%;margin-left:21%">
      
        <h1>Order Details</h1>
        <div  class="flex-container">

        <div  class="info">
        <div>Deliver To:</div>
        <div>From:</div>
        <div>Delivery Address:</div>
        <div>Product:</div>
        <div>Quantity</div>
        <div>Unit Price:</div>
        <div>Total Price:</div>
        <div>Status:</div>
        <div>Customer Phone Number：</div>
        <div>Shipment Date:</div>
        </div>
        <!-- info -->

        <div class="info">
            <div  id="deliverTo">None</div>
            <div id="from">None</div>
            <div id="address">None</div>
            <div id="product">None</div>
            <div id="quantity">None</div>
            <div id="unitPrice">None</div>
            <div id="totalPrice">None</div>
            <div id="status">None</div>
            <div id="phoneNumber">None</div>
            <div id="shipmentDate">None</div>
        </div>
        <!-- textbox -->
        </div>
        <!-- flex-container -->

        </div>
        <!-- biggest -->
        </form>
            <script>

            $.ajax({
            type:"GET",
            url:"server.php?id=<?php echo $_GET['id'] ?> & customerID=<?php echo $_GET['customerID']?>",
            dataType:'json',
            success:function(data)
            {           
            for(var i =0;i<data.length;i++){
               
                     var cnt="Dont'know";
                    if(data[i].status==1){
                    cnt = "Paid";
                    }
                    else if(data[i].status==2){
                    cnt = "Sent";
                    }
                    else if(data[i].status==3){
                    cnt = "Received";
                    }

                    $("#deliverTo").text(data[i].customerName);
                    $("#from").text(data[i].farmerName);
                    $("#address").text((data[i].customerAddress+""));
                    $('#product').text(data[i].productName);
                    $("#quantity").text(data[i].quantity);
                    $("#unitPrice").text(data[i].unitPrice);
                    $("#totalPrice").text(data[i].totalPrice);
                    $("#status").text(cnt);
                    $("#phoneNumber").text(data[i].phoneNumber);
                    $("#shipmentDate").text(data[i].shipmentDate);
                }
                
            }
            });
            </script>
    </body>
    </html>
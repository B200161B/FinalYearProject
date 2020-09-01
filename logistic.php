
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="icon.png">
        <style>
            .container div div{
                padding:7px;
            }
            input[readonly] {background-color: white !important;}

        </style>
</head>
<body class="jumbotron">
<h1 style="text-align:center">Order details</h1>
    <div class="container" style="display:flex">
    
        <div>
            <div>Customer name</div>
            <div>Farmer name</div>
            <div>Product</div>
            <div>Quantity</div>
            <div>Unit Price</div>
            <div>Status</div>
            <div>Payment ID</div>
            <div>Shipment Date</div>
            <div>Phone Number</div>
            <div>Customer Address</div>
        </div>

        <div>
        <input type="text" id="buyByName"class="form-control form-control-sm" value="none" readonly>
        <input type="text" id="farmerName"class="form-control form-control-sm" value="none" readonly>
        <input type="text" id="productName"class="form-control form-control-sm" value="none" readonly>
        <input type="text" id="quantity"class="form-control form-control-sm" value="none" readonly>
        <input type="text" id="unitPrice"class="form-control form-control-sm" value="none" readonly>
        <input type="text" id="status"class="form-control form-control-sm" value="none" readonly>
        <input type="text" id="paymentID"class="form-control form-control-sm" value="none" readonly>
        <input type="text" id="shipmentDate"class="form-control form-control-sm" value="none" readonly>
        <input type="text" id="phoneNumber"class="form-control form-control-sm" value="none" readonly>
        <input type="text" id="customerAddress"class="form-control form-control-sm" value="none" readonly>

        <input type="hidden" id="id">
        <input type="hidden" id="farmerID">
        <input type="hidden" id="productID">
        <input type="hidden" id="logisticID">
        </div>
    </div>
    <br><br>
    <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#myModal">Receive</button>
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Receive By</h4>
        </div>
        <div class="modal-body">
          <p>Name</p>
          <input type="text" name="name" class="form-control" id="username">
        </div>

        <div class="modal-body">
            <p>IC Number</p>
            <input type="text" name="ICNumber" class="form-control" id="icnumber">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" data-dismiss="modal" name="submit" id="submit">
        </div>

    </div>
</div>
    </div>
    <script>
    var id = <?php echo $_GET['id'] ?>;
   
                 $.ajax({
        type:"GET",
        url:"server.php?logisticViewOrderDetails="+id,
        dataType:'json',
        success:function(data)
        {              
            for(var i =0;i<data.length;i++){
                var cnt="Dont'know";
                    if(data[i].status==0){
                    cnt = "Unpaid";
                    }
                    else if(data[i].status==1){
                    cnt = "Paid";
                    $("#block").val("Active");
                    }
                    else if(data[i].status ==2){
                        cnt ="Sent"
                    }
                    else{
                        cnt ="Received"
                    }
                    $("#id").val(data[i].id+"");
                    $("#customerID").val(data[i].customerID+"");
                    $("#farmerName").val((data[i].farmerName));
                    $('#productName').val(data[i].productName+"");
                    $("#buyByName").val(data[i].buyByName+"");
                    $("#quantity").val(data[i].quantity+"");
                    $("#unitPrice").val(data[i].unitPrice);
                    $("#paymentID").val(data[i].paymentID);
                    $("#shipmentDate").val(data[i].shipmentDate);
                    $("#phoneNumber").val(0+data[i].phoneNumber);
                    $("#customerAddress").val(data[i].customerAddress);
                   
                    $("#status").val(cnt);
                    $("#farmerID").val(data[i].farmerID);
                    $("#logisticID").val(data[i].logisticID);
                    $("#productID").val(data[i].productID);


                    current = data[i].status;
                    id = data[i].id;
                }
                
            },
            error:function(data){
                console.log(data);
            }
    });

    $("#submit").click(function(){

            var customerID = $("#customerID").val();
            var farmerID = $("#farmerID").val();
            var logisticID =$("#logisticID").val();
            var customerLocation =  $("#customerAddress").val();
            var productID =  $("#productID").val();
            var quantity =  $("#productID").val();
            var receiveByName = $("#username").val();
            var receiveByIC = $("#icnumber").val();
            var id=$("#id").val();

        $.ajax({
           url:'server.php',
           method:'post',
           data:{
               id: id,
               customerID:customerID,
               farmerID:farmerID,
               logisticID:logisticID,
               customerLocation:customerLocation,
               productID:productID,
               quantity:quantity,
               receiveByName:receiveByName,
               receiveByIC:receiveByIC
           },
           success:function(response){
               console.log(response);
               window.location.href=('mainPageLogistic.php');
           }
       });
     });

   
    </script>
    <script src="js/prism/prism.js"></script>
    <script src="js/DataTables/datatables.min.js"></script>
</body>
</html>
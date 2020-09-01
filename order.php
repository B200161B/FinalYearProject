<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Manage Students</title>
        <script src="js/modernizr/modernizr.min.js"></script>
  <script>

  </script>
</head>
<body>

<?php include('leftbar.php');  ?>

<div style="width:79%;margin-left:21%">
<h1>Order</h1>
    <div><a href="dashboard.php"><span>Home</span></a><span> / Order </span></div>

   

    <table id="example" class="display table table-striped table-bordered" cellspacing="0">

    <thead>
    <tr>
    <th>ID</th>
    <th>Customer ID</th>
    <th>Farmer</th>
    <th>Price</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    </table>

    </div>
    <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
    <script>
        $.ajax({
        type:"GET",
        url:"server.php?order",
        dataType:'json',
        success:function(data)
        {           
            for(var i =0;i<data.length;i++){
                var itemDataid=data[i].id;
                var cnt="";
                if(data[i].status==1){
                    cnt = "Paid";
                }
                else if(data[i].status==2){
                    cnt = "Sent";
                }
                else if(data[i].status==3){
                    cnt = "Received";
                }
                $('#example ').append('<tr>'+
                '<td>'+data[i].id+'</td>'+
                '<td>'+data[i].buyByName+'</td>'+
               '<td>'+data[i].farmerName+'</td>'+
                '<td>'+data[i].unitPrice+'</td>'+
                '<td>'+cnt+'</td>'+
                '<td>'+'<a href="order-details.php?id='+itemDataid+'&customerID='+data[i].customerID+'"><i class="fa fa-edit" title="Edit Record"></a>'+'</td>'+
                '</tr>');  
                }
                $('#example').DataTable();
            }
    });
     
    </script>
    <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
</body>
</html>
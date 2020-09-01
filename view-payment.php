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
        <title>Payment</title>
        <script src="js/modernizr/modernizr.min.js"></script>
        <link rel="icon" href="icon.png">
  <script>

  </script>
</head>
<body>

<?php include('leftbar.php');  
      include('headerForAdmin.php');
?>

<div style="width:79%;margin-left:21%">
<h1>Payment</h1>
    <div><a href="dashboard.php"><span>Home</span></a><span> / Payment </span></div>

   

    <table id="example" class="display table table-striped table-bordered" cellspacing="0">

    <thead>
    <tr>
    <th>ID</th>
    <th>Price</th>
    <th>Customer</th>
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
        url:"server.php?payment",
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
                else if(data[i].status==4){
                    cnt="Transfered";
                }
                $('#example ').append('<tr>'+
                '<td>'+data[i].id+'</td>'+
                '<td>'+data[i].totalPrice+'</td>'+
               '<td>'+data[i].customerID+'</td>'+
                '<td>'+cnt+'</td>'+ 
                '<td>'+'<a href="view-payment-details.php?id='+itemDataid+'"><i class="fa fa-edit" title="Edit Record"></a>'+'</td>'+
                '</tr>');  
                }
                $('#example').DataTable();
            },
            error:function(jqXHR, textStatus, errorThrown)
            {
               console.log(errorThrown);
            }
    });
     
    </script>
    <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
</body>
</html>
    <?php } ?>
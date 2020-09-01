<?php

session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
        $id = $_SESSION['userid'];
      ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="icon" href="icon.png">
    <title>Farmer</title>
    <style>
        .nav{
            padding:10px;
            background-color:lightblue;
            border-radius:5%;
        }
        .nav span a{
            padding:3px;
            font-size:20px;
        }
        .active{
           color:white;
        }
    </style>
</head>
<body> 
<div class="nav">
<span><a href="mainPageLogistic.php">Orders</a></span>
<span>|</span>
<span><a href="logisticFarmer.php" class="active">Farmer</a></span>
<input type="text" style="margin-left:10%" placeholder="Search">
</div>


<table id ="example" class="table table-striped" >
   <thead>
   <tr>
   <th>Receiver</th>
   <th>Product</th>
   <th>Farmer</th>
   <th>Action</th>
   </tr>
   </thead>
</table>
</div>
<script>
var id= <?php echo $id ?>;
$.ajax({
        type:"GET",
        url:"server.php?logisticFarmer="+id,
        dataType:'json',
        success:function(data)
        {   
            for(var i =0;i<data.length;i++){
             $('#example ').append('<tr>'+
           '<td>'+data[i].buyByName+'</td>'+
           '<td>'+data[i].productName+'</td>'+
           '<td>'+data[i].farmerName+'</td>'+
           '<td>'+'<a href="logisticFarmerDetails.php?id='+data[i].ID+'"><i class="fa fa-edit" title="Edit Record"></a>'+'</td>'+
           '</tr>');   
            }
        }
    });
</script>
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
</body>
</html>
<?php } ?>
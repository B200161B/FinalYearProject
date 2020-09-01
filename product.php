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
        <title>Product</title>
        <link rel="icon" href="icon.png">
</head>
<body>

<?php include('leftbar.php');  
      include('headerForAdmin.php');
?>

<div style="width:79%;margin-left:21%">
<h1>Product</h1>
    <div><a href="dashboard.php"><span>Home</span></a><span> / Product </span></div>
    <table id="example" class="display table table-striped table-bordered" cellspacing="0">
    <thead>
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Owned By</th>
    <th>Quantity</th>
    <th>Unit Price</th>
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
        url:"server.php?product",
        dataType:'json',
        success:function(data)
        {
            for(var i =0;i<data.length;i++){
             $('#example ').append('<tr>'+
           '<td>'+data[i].id+'</td>'+
           '<td>'+data[i].name+'</td>'+
           '<td>'+data[i].FullName+'</td>'+
          '<td>'+data[i].quantity+'</td>'+
           '<td>'+data[i].unitPrice+'</td>'+
           '<td>'+'<a href="product_info.php?productid='+data[i].id+'"><i class="fa fa-edit" title="Edit Record"></a>'+'</td>'+
           '</tr>');   
            }
            $('#example').DataTable();
            
        }
    });

      
    </script>
</body>
</html>
    <?php } ?>
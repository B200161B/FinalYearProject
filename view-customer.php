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
        <title>Customer</title>
        <link rel="icon" href="icon.png">
</head>
<body>

<?php include('leftbar.php');  
      include('headerForAdmin.php');
?>

<div style="width:79%;margin-left:21%">
<h1>Manage Customers</h1>
    <div><a href="dashboard.php"><span>Home</span></a><span> / User / manage customer</span></div>

    <div>Customer Infomation</div>

    <table id="example" class="display table table-striped table-bordered" cellspacing="0">

    <thead>
    <tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Username</th>
    <th>Phone Number</th>
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
        url:"server.php?customer",
        dataType:'json',
        success:function(data)
        {   
            
            for(var i =0;i<data.length;i++){
                var status ="Active";
                if(data[i].status==1){
                    status = "Block";
                }

             $('#example ').append('<tr>'+
           '<td>'+data[i].id+'</td>'+
           '<td>'+data[i].FullName+'</td>'+
          '<td>'+data[i].UserName+'</td>'+
           '<td>'+data[i].PhoneNumber+'</td>'+
           '<td>'+status+'</td>'+
           '<td>'+'<a href="view-customer-details.php?id='+data[i].id+'"><i class="fa fa-edit" title="Edit Record"></a>'+'</td>'+
           '</tr>');   
            }
            $('#example').DataTable();
            
        }
    });


</script>
</body>
</html>
    <?php } ?>
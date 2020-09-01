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
        <title>Verify</title>
        <link rel="icon" href="icon.png">
</head>
<body>
<?php include('leftbar.php');  
      include('headerForAdmin.php');
?>

<div style="width:79%;margin-left:21%">
<h1>Verify Sign Up</h1>
    <div><a href="dashboard.php"><span>Home</span></a><span> / User / Verify user</span></div>

    <div>View User Infomation</div>

    <table id="example" class="display table table-striped table-bordered" cellspacing="0">

    <thead>
    <tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Username</th>
    <th>Phone Number</th>
    <th>Shop Name</th>
    <th>Action</th>
    </tr>
    </thead>

    <tbody>
    </tbody>
    </table>

    </div>
    <script>
     $.ajax({
        type:"GET",
        url:"server.php?verifyFarmer",
        dataType:'json',
        success:function(data)
        {
            for(var i =0;i<data.length;i++){
             $('#example ').append('<tr>'+
           '<td>'+'<a href="verify-farmer-details.php?id='+data[i].id+'">'+data[i].id+'</a>'+'</td>'+
           '<td>'+'<a href="verify-farmer-details.php?id='+data[i].id+'">'+data[i].FullName+'</a>'+'</td>'+
          '<td>'+'<a href="verify-farmer-details.php?id='+data[i].id+'">'+data[i].UserName+'</a>'+'</td>'+
           '<td>'+'<a href="verify-farmer-details.php?id='+data[i].id+'">'+data[i].PhoneNumber+'</a>'+'</td>'+
           '<td>'+'<a href="verify-farmer-details.php?id='+data[i].id+'">'+data[i].shopName+'</a>'+'</td>'+
           '<td>'+'<a href="verify-farmer-details.php?id='+data[i].id+'"><i class="fa fa-edit" title="Edit Record"></a>'+'</td>'+
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

    <?php } ?>
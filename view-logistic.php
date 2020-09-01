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
        <title>Logistic</title>
        <link rel="icon" href="icon.png">
</head>
<body>

<?php include('leftbar.php');  
      include('headerForAdmin.php');
?>

<div style="width:79%;margin-left:21%">
<h1>Manage Logictic worker</h1>
    <div><a href="dashboard.php"><span>Home</span></a><span> / User / manage customer</span></div>

    <div>Logistic Infomation</div>

    <table id="example" class="display table table-striped table-bordered" cellspacing="0">

    <thead>
    <tr>
    <th>ID</th>
    <th>personInCharge</th>
    <th>Company Name</th>
    <th>Company Adress</th>
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
        url:"server.php?logistic",
        dataType:'json',
        success:function(data)
        {
            for(var i =0;i<data.length;i++){
             $('#example ').append('<tr>'+
           '<td>'+data[i].id+'</td>'+
           '<td>'+data[i].personInCharge+'</td>'+
           '<td>'+data[i].companyName+'</td>'+
          '<td>'+data[i].companyAddress+'</td>'+
          '<td>'+'<a href="view-logistic-details.php?id='+data[i].id+'"><i class="fa fa-edit" title="Edit Record"></a>'+'</td>'+
           '</tr>');   
            }
   
            
        }
    });

    $("#submit").click(function(){
        console.log("yeah");
    });
</script>
</body>
</html>

    <?php } ?>
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
        <title>Comment</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="icon.png">
        <style>
        .checked {
        color: orange;
        }
        </style>
</head>
<body>

<?php include('leftbar.php'); 
include('headerForAdmin.php');
?>

<div style="width:79%;margin-left:21%">
<h1>Comment</h1>
    <div><a href="dashboard.php"><span>Home</span></a><span> / Comment </span></div>
    <table id="example" class="display table table-striped table-bordered" cellspacing="0">
    <thead>
    <tr>
    <th>ID</th>
    <th>Rating</th>
    <th>Comment</th>
    <th>Product</th>
    <th>Comment by</th>
    <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    </table>
    </div>
    <script>
     $.ajax({
        type:"GET",
        url:"server.php?comment",
        dataType:'json',
        success:function(data)
        {   
            var one ="";
            var two ="";
            var three ="";
            var four ="";
            var five ="";
            for(var i =0;i<data.length;i++){
                var status ="Active";
                if(data[i].status==1){
                    status = "Block";
                }
                for(var j =0;j<data[i].rates;j++){
                    if(j == 0){
                        var one ='<span class="fa fa-star checked"></span>';
                    }
                    if(j==1){
                        var two = '<span class="fa fa-star checked"></span>';
                    }
                    if(j==2){
                        var three = '<span class="fa fa-star checked"></span>';
                    }
                    if(j==3){
                        var four = '<span class="fa fa-star checked"></span>';
                    }
                    if(j==4){
                        var five = '<span class="fa fa-star checked"></span>';
                    }
                }
                

             $('#example ').append('<tr>'+
           '<td>'+data[i].id+'</td>'+
           '<td>'+one+two+three+four+five+'</td>'+
          '<td>'+data[i].comment+'</td>'+
           '<td>'+data[i].productName+'</td>'+
           '<td>'+data[i].commentByName+'</td>'+
           '<td>'+'<a href="product_info.php?productid='+data[i].id+'"><i class="fa fa-edit" title="Edit Record"></a>'+'</td>'+
           '</tr>');   
            }
            $('#example').DataTable();
            
        }
    });

    </script>
    <?php include ('footer.php'); ?>
</body>
</html>

    <?php } ?>
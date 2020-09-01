<?php
session_start();
error_reporting(1);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{

$pid=$_SESSION['userpid'];
$id=$_SESSION['userid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="icon.png">
  <title>My Product</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php 
        if(isset($_GET['remove'])){
            $delete_id=$_GET['remove'];
            $sql_delete="UPDATE product SET status=1 where id='$delete_id'";
            $query_delete=$dbh->prepare($sql_delete);
            $query_delete->execute();
            if($query_delete){
                ?>
                <script>
               // document.location="myProduct.php";
                </script>
                
                <?php
            }
        }
    
    ?>
    <div class="container"  style="margin-left:20px">
<table id="example" >
<thead>
            <th></th>
        </thead>

<body>
      
      <div class="container-fluid " style="margin-top:20px;text-align:center;">
      <?php 
   
      $sql1 ="SELECT id,name,unitPrice,picture from product Where farmerID = $id AND status=0";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);  

foreach($results1 as $result)
{   
    
    ?>
    <tr>
            <td>
    <div class="card sm-3" style="max-width: 300px;margin-bottom:10px;">
    <div class="row no-gutters"  style="width: 250px">
        <div class="col" style="background: #868e96;">
            <img src="Upload/product/<?php echo ($result->picture)?>" style="max-width: 150px;" class="card-img-top h-100" alt="<?php echo ($result->name)?>">
        </div>
        <div class="col">
            <div class="card-body">
                <h5 class="card-title"><?php echo ($result->name)?></h5>
                <p class="card-text"><?php echo ($result->unitPrice)?></p>
                <a  href="product_info.php?productid=<?php echo ($result->id)?>" ><i class="fas fa-eye"></i></a>
               <a href="edit_product_info.php?productid=<?php echo ($result->id)?>" > <i class="fas fa-edit"></i></a>
               <a onclick='javascript:confirmationDelete($(this));return false;' href='myProduct.php?remove=<?php echo ($result->id)?>'><i class="fas fa-trash-alt"></i></a>

               
            </div>
        </div>
    </div>
</div>
</td>
</tr>
    <?php } ?>
</table>
</div>
<?php include("includes/footer.php") ?>
 <!-- ========== COMMON JS FILES ========== -->
 <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {
               

                $('#example').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

            });</script>
            <script type = "text/javascript">
      
      function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete this record?');
   if(conf)
      window.location=anchor.attr("href");
}
         //-->
           
        </script>
</body>
<?php } ?>
</html>
<?php
session_start();
error_reporting(0);
include('includes/config.php');

$pid= $_SESSION['userpid'];
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location:login.php"); 
    }
    else{
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="icon.png">
  <title>Home Page</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

</head>
<?php include('includes/header.php')?>
<body>



  
 
      
      <div class="container-fluid" style="margin-top:20px" >
          <div class="row m-1">
              <h2 id="suggest" class="text-success ml-1">Suggestion</h2>
              </div>
    

    
              <div id="carousel-example-multi" class="carousel slide carousel-multi-item v-2" data-ride="carousel">

<!-- Indicators -->
<ol class="carousel-indicators">
  <li data-target="#carousel-example-multi" data-slide-to="0" class="active"></li>
  <li data-target="#carousel-example-multi" data-slide-to="1"></li>
  <li data-target="#carousel-example-multi" data-slide-to="2"></li>

</ol>
<!--/.Indicators-->

<div class="d-flex align-items-center">
<div class="">
     <a class="btn-floating" href="#carousel-example-multi" data-slide="prev"><i
      class="fas fa-chevron-left"></i></a></div>
<div class="col-10">
<div class="carousel-inner v-2 " role="listbox">
    
<?php 
$sql1 ="SELECT id,name,unitPrice,picture from product ";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$count=1;
foreach($results1 as $result)
{   
if($count==1){
    ?>
     <div class="carousel-item active  flex-fill">
    <div class="col-12">
      <div class="card mb-2">
        <img class="card-img-top" src="Upload/product/<?php echo ($result->picture)?>"
          alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title font-weight-bold"><?php echo ($result->name)?></h4>
          <p class="card-text"><?php echo ($result->unitPrice)?></p>
          <a class="btn btn-primary btn-md btn-rounded" href="product_info.php?productid=<?php echo ($result->id)?>">View</a>
        </div>
      </div>
    </div>
  </div>

 <?php } 

 else{ ?>
    <div class="carousel-item  flex-fill ">
    <div class="col-12">
      <div class="card mb-2">
        <img class="card-img-top" src="Upload/product/<?php echo ($result->picture)?>"
          alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title font-weight-bold"><?php echo ($result->name)?></h4>
          <p class="card-text"><?php echo ($result->unitPrice)?></p>
          <a class="btn btn-primary btn-md btn-rounded" href="product_info.php?productid=<?php echo ($result->id)?>"> View</a>

        </div>
      </div>
    </div> 
  </div>  
  <?php } ?>

<?php $count++; } ?>
</div>
</div>
<div class="pull-right align-middle"> <a class="btn-floating" href="#carousel-example-multi" data-slide="next"><i
      class="fas fa-chevron-right"></i></a>
</div>
</div>

</div>



      
      
          <div class="row m-1">
              <h2 class="text-success ">Categories</h2> 
          </div>
          
        <div class="row">
          <div class="col-4"><a href="category.php?category=Fruit_Vegetable">Fruit Vegetables</a></div>
          <div class="col-4"><a href="category.php?category=Garlic_Chilies_Onions">Garlic, Chilies & Onions</a></div>
          <div class="col-4"><a href="category.php?category=Leafy_Vegetable">Leafy Vegetables</a></div>
        </div>
      
        <div class="row">
          <div class="col-4"><a href="category.php?category=Other_Vegetable">Other Vegetables</a></div>
          <div class="col-4"><a href="category.php?category=Mushroom">Mushrooms</a></div>
          <div class="col-4"><a href="category.php?category=Potatoes">Potatoes</a></div>
        </div>
      
        <div class="row mb-5">
          <div class="col-4"><a href="category.php?category=Root_Vegetables">Root Vegetables</a></div>
          <div class="col-4"><a href="category.php?category=Shoot_Vegetables">Shoot Vegetables</a></div>
          <div class="col-4"><a href="category.php?category=Dried_Beans_Nuts">Dried Beans & Nuts</a></div>
        </div>

        
      </div>
      <?php include('includes/footer.php')?>
  <!-- Start your project here-->

  <!-- SCRIPTS -->
  <script src="js/myJavascript.js"></script>
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="js/style1.js"></script>
</body>
<?php } ?>
</html>


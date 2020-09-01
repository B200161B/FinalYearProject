  <?php
  session_start();
  error_reporting(0);
  include('includes/config.php');
  if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
      $pid = $_SESSION['userpid'];

  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="icon.png">
  <title>My Order</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">  
  </head>
  <header>
      <nav class="navbar fixed-top navbar-expand-sm navbar-light green lighten-3 p-2">
      <div class="row">
        <div class=" pull-right">
      <i class="fa fa-chevron-left"></i>
        </div>
    </div>
    </nav>
  </header>
  <body>

  <div class="container mt-5">
  <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#All">All</a></li>
      <li><a data-toggle="tab" href="#ship">To Ship</a></li>
      <li><a data-toggle="tab" href="#receive">To Receive</a></li>
      <li><a data-toggle="tab" href="#review">To Review</a></li>
    </ul>
    <div class="tab-content">
      <div id="All" class="tab-pane fade in active">
      <?php 
    
   $sql_all ="SELECT orderdetails.id,orderdetails.paymentID,orderdetails.productID,product.name,orderdetails.status,product.picture ,orderdetails.quantity ,orderdetails.unitPrice from orderdetails JOIN product On orderdetails.productID=product.id  WHERE orderdetails.customerID = '$pid'";
  $query_all = $dbh -> prepare($sql_all);
  $query_all->execute();
  $results_all=$query_all->fetchAll(PDO::FETCH_OBJ);
  foreach($results_all as $result)
  {  if($result->status!=4){
    ?>
    
    <div class="card" style="margin-bottom:10px">
    <h5 class="p-1">Payment#<?php echo ($result->paymentID)?></h5>
    <div class="row ml-2">
    <h6>Order#<?php echo ($result->id)?></h6>
    </div>
    <div class="card sm-3" style="max-width: 300px;text-align:center;margin-left:22px">
    <div class="row no-gutters">
        <div class="col" style="background: #868e96;">
            <img src="Upload/<?php echo ($result->picture)?>" style="max-width: 150px;" class="card-img-top ml-1 h-100" alt="<?php echo ($result->name)?>">
        </div>
        <div class="col">
            <div class="card-body">
                <h5 class="card-title"><?php echo ($result->name)?></h5>
                <p class="card-text"><?php echo ($result->quantity)?>
                <?php echo ($result->unitPrice)?>
                </p>
                
                <a  class="btn btn-primary stretched-link" href="order_details.php?id=<?php echo ($result->id)?>">View</a>
            </div>
        </div>
    </div>
  </div>
      </div>
      <?php }} ?>
    </div>
    <div id="ship" class="tab-pane fade in">

      
        <?php 
    
    $sql_ship ="SELECT orderdetails.id,orderdetails.paymentID,orderdetails.productID,product.name,orderdetails.status,product.picture ,orderdetails.quantity ,orderdetails.unitPrice from orderdetails JOIN product On orderdetails.productID=product.id Where orderdetails.status=1 AND orderdetails.customerID = '$pid'";
    $query_ship = $dbh -> prepare($sql_ship);
    $query_ship->execute();
    $results_ship=$query_ship->fetchAll(PDO::FETCH_OBJ);
    foreach($results_ship as $result)
    {  
      ?>
      <div class="card"  style="margin-bottom:10px">
    <h5 class="p-1">Payment#<?php echo ($result->paymentID)?></h5>
    <div class="row ml-2">
    <h6>Order#<?php echo ($result->id)?></h6>
    </div>
    <div class="card sm-3" style="max-width: 300px;text-align:center;margin-left:22px">
    <div class="row no-gutters">
        <div class="col" style="background: #868e96;">
            <img src="Upload/<?php echo ($result->picture)?>" style="max-width: 150px;" class="card-img-top ml-1 h-100" alt="<?php echo ($result->name)?>">
        </div>
        <div class="col">
            <div class="card-body">
                <h5 class="card-title"><?php echo ($result->name)?></h5>
                <p class="card-text"><?php echo ($result->quantity)?>
                <?php echo ($result->unitPrice)?>
                </p>
                
                <a  class="btn btn-primary stretched-link" href="order_details.php?id=<?php echo ($result->id)?>">View</a>
            </div>
        </div>
    </div>
  </div>
      </div>
      <?php } ?>
    </div>
    <div id="receive" class="tab-pane fade in">
  <?php 

  $sql_receive ="SELECT orderdetails.id,orderdetails.paymentID,orderdetails.productID,product.name,orderdetails.status,product.picture ,orderdetails.quantity ,orderdetails.unitPrice from orderdetails JOIN product On orderdetails.productID=product.id Where orderdetails.status=2 AND orderdetails.customerID = '$pid'";
  $query_receive = $dbh -> prepare($sql_receive);
  $query_receive->execute();
  $results_receive=$query_receive->fetchAll(PDO::FETCH_OBJ);
  foreach($results_receive as $result)
  {  
  ?>
  <div class="card"  style="margin-bottom:10px">
  <h5 class="p-1">Payment#<?php echo ($result->paymentID)?></h5>
  <div class="row ml-2">
  <h6>Order#<?php echo ($result->id)?></h6>
  </div>
  <div class="card sm-3" style="max-width: 300px;text-align:center;margin-left:22px">
  <div class="row no-gutters">
  <div class="col" style="background: #868e96;">
      <img src="Upload/<?php echo ($result->picture)?>" style="max-width: 150px;" class="card-img-top ml-1 h-100" alt="<?php echo ($result->name)?>">
  </div>
  <div class="col">
      <div class="card-body">
          <h5 class="card-title"><?php echo ($result->name)?></h5>
          <p class="card-text"><?php echo ($result->quantity)?>
          <?php echo ($result->unitPrice)?>
          </p>
          
          <a  class="btn btn-primary stretched-link" href="order_details.php?id=<?php echo ($result->id)?>">View</a>
      </div>
  </div>
  </div>
  </div>
  </div>
  <?php } ?>
  </div>
  <div id="review" class="tab-pane fade in">
  <?php 
 $sql_review ="SELECT orderdetails.id,orderdetails.paymentID,orderdetails.productID,product.name,orderdetails.status,product.picture ,orderdetails.quantity ,orderdetails.unitPrice from orderdetails JOIN product On orderdetails.productID=product.id Where orderdetails.status=3 AND orderdetails.customerID = '$pid'";
  $query_review = $dbh -> prepare($sql_review);
  $query_review->execute();
  $results_review=$query_review->fetchAll(PDO::FETCH_OBJ);
  foreach($results_review as $result)
  {  
  ?>
  <div class="card"  style="margin-bottom:10px">
  <h5 class="p-1">Payment#<?php echo ($result->paymentID)?></h5>
  <div class="row ml-2">
  <h6>Order#<?php echo ($result->id)?></h6>
  </div>
  <div class="card sm-3" style="max-width: 300px;text-align:center;margin-left:22px">
  <div class="row no-gutters">
  <div class="col" style="background: #868e96;">
      <img src="Upload/<?php echo ($result->picture)?>" style="max-width: 150px;" class="card-img-top ml-1 h-100" alt="<?php echo ($result->name)?>">
  </div>
  <div class="col">
      <div class="card-body">
          <h5 class="card-title"><?php echo ($result->name)?></h5>
          <p class="card-text"><?php echo ($result->quantity)?>
          <?php echo ($result->unitPrice)?>
          </p>
          
          <a  class="btn btn-primary stretched-link" href="order_details.php?id=<?php echo ($result->id)?>">View</a>
      </div>
  </div>
  </div>
  </div>
  </div>
  <?php } ?>
  </div>
    </div>
  </div>
  <?php include("includes/footer.php")?>
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

  </html>
  <?php } ?>
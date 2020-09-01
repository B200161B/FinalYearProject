<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
$pid=$_SESSION['userpid'];
 $pid;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="icon" href="icon.png">
  <title>Profile</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
</head>

<?php 
if(strpos($pid, 'F') !== false){
  $sql1 ="SELECT Username,picture from farmer WHERE pid = '$pid'";
  $query1 = $dbh -> prepare($sql1);
  $query1->execute();
  $results=$query1->fetchAll(PDO::FETCH_OBJ);
 
}
else{
  $sql1 ="SELECT Username,picture from customer WHERE pid = '$pid'";
  $query1 = $dbh -> prepare($sql1);
  $query1->execute();
  $results=$query1->fetchAll(PDO::FETCH_OBJ);
}

?>
<header id="profile" class="dusty-grass-gradient">
    <div id="hUser" class="row">
        <div class="col-6">
                <h5>Hello</h5>
                <?php  foreach($results as $results1){?>
                <h3><?php echo ($results1->Username)?></h3>
        </div>
        <div class="col-6">
                <img src="Upload/profilePic/<?php echo ($results1->picture)?>" class="md-avatar rounded-circle">
        </div>
                <?php } ?>
</div>
</header>
<body>
<div class="container "style="text-align:center">
    <div class="card">
        <div class="row p-2">
            <div class="ml-3">
               <h4>My Order</h4>
            </div>
            <div class="ml-auto mr-3"><a href="myOrder.php#All">Check All Order</a></div>
        
        </div>
        <div class="row ml-2 mr-2" style="text-align:center">
               
                <div class="col-4">
                    <a href="myOrder.php#ship">
                     <i class="fas fa-archive fa-3x"></i>
                    <h6>To Ship</h6></a>
                </div>
                <div class="col-4">
                    <a href="myOrder.php#receive">
                    <i class="fas fa-shipping-fast fa-3x"></i>
                     <h6>To Receive</h6></a>
                </div>
                <div class="col-4">
                        <a href="myOrder.php#review">
                        <i class="fas fa-comment-alt fa-3x"></i>
                       <h6>To Review</h6></a>
                </div>
            
            </div>
    </div>
    <div class="card mt-2 pl-4">
        <?php
        if(strpos($pid, 'F') !== false){?>
           <div class="row pt-1">
            <a href="myProduct.php"><h4>My Product</h4></a>
           </div>
       
        <?php } ?>
            <div class="row">
             <a href="wallet.php"><h4>Wallet</h4></a>   
            </div>
            
            <?php
        if(strpos($pid, 'F') !== false){ 
        ?>
      
          <div class="row">
            <a href="edit-farmerprofile.php"> <h4>Setting</h4></a>
           </div>
         
           
        <?php } else{?>
            <div class="row">
            <a href="edit-customerprofile.php"> <h4>Setting</h4></a>
           </div>
          <?php  }
            ?>
                
            <div class="row ">
            <a href="logout.php"><h4>Log Out</h4></a>
            </div>
    </div>
    
</div>
<?php include('includes/footer.php')?>
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

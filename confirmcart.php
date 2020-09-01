
    <?php
session_start();
error_reporting(0);
include('includes/config.php');
$address="";
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
     
      $pid=$_SESSION['userpid'];
     
      if(isset($_POST['submit'])){
        $count=0;
        $id1 = $_POST['id1'];
        $quantity1 = $_POST['quantity1'];
        $item_name = $_POST['item_name'];
        $address=$_POST['city'];
        for($i=0;$i<count($id1);$i++){
    
            $quantity = $quantity1[$i];
            $id=$id1[$i];
            $sql = "UPDATE cart set quantity= '$quantity' where id='$id'";
            $query=$dbh->prepare($sql);
            $query->execute();
        }
        
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/mystyle.css" rel="stylesheet">
</head>

<body>
<!-- <//?php echo $paypal_url; ?> -->
<form  action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" enctype="multipart/form-data">
<!-- Get paypal email address from core_config.php -->


  <!-- get customer detail -->
  <div class="container">
    
<?php  
$fullname="";

$phone=0;
$sql = "SELECT pid,FullName,address,PhoneNumber FROM customer where pid = '$pid'";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
  foreach($results as $result)
  {
    $fullname = $result->FullName;
 
    $phone = $result->PhoneNumber;
    ?>
    <input type="hidden" name="customer_pid" value="<?php echo htmlentities($result->pid)?>">
    <input type="hidden" name="name" value="<?php echo htmlentities($result->FullName)?>">
    <input type="hidden" name="customer_address" value="<?php echo htmlentities($result->address)?>">
    <input type="hidden" name="phone" value="<?php echo htmlentities($result->PhoneNumber)?>">
   
<?php
  }
}else{
$sql = "SELECT pid,FullName,adress,PhoneNumber FROM farmer where pid = '$pid'";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
  foreach($results as $result)
  {
    $fullname = $result->FullName;
    $phone = $result->PhoneNumber;
    ?>
    <input type="hidden" name="customer_pid" value="<?php echo htmlentities($result->pid)?>">
    <input type="hidden" name="name" value="<?php echo htmlentities($result->FullName)?>">
    <input type="hidden" name="customer_address" value="<?php echo htmlentities($result->adress)?>">
    <input type="hidden" name="phone" value="<?php echo htmlentities($result->PhoneNumber)?>">
<?php
  }
}
}
?>
<!-- get product detail -->
<div class="card mt-4" >
  <div class="card-body">
    <div class="modal-body">
      <h1>Payment Confirm</h1>
      <hr>

      <h4 class="ml-3"><strong>Details</strong></h4>
<?php  
$sql = "SELECT p.name,p.category,p.unitPrice,p.picture,p.details,p.weight,c.quantity FROM product p join cart c ON c.productID = p.id WHERE c.customerID = '$pid'";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalPrice = 0;
if($query->rowCount() > 0)
{
  foreach($results as $result)
  {
    $totalPrice = ($result->unitPrice);
    $productimg=$result->picture;
    $productname = $result->name;
    $category = $result->category;
    $details = $result->details;
    $weight = $result->weight;
    $quantity = $result->quantity;
    $allprice += $totalPrice*$quantity;
    ?>

          <div class="col-md-12 col-sm-10 ">
            <div class="view overlay zoom">
              <img src="Upload/product/<?php echo htmlentities($productimg)?>" class="img-thumbnail " style="width: 200px;height: 200px;" alt="zoom">
            </div>
          </div>

          <div class=" d-flex mt-3">
            <div class="col-md-10 col-sm-8 d-flex flex-column">
              <p>Name</p>
              <p>Quantity</p>
              <p>Unit Amount</p>
            </div>
         
            <div class="col-md-2 col-sm-4 d-flex flex-column">
              <strong><p><?php echo htmlentities($productname)?></p></strong>
              <strong><p>x <?php echo htmlentities($quantity)?></p></strong>
              <strong><p>MYR <?php echo htmlentities($totalPrice)?></p></strong>
            </div>
          </div>
        <hr>
<?php }}?>
<input type="hidden" name="business" value="<?php echo $paypal_seller; ?>">
<input type="hidden" name="item_name" value="<?php echo htmlentities($item_name)?>">
<input type="hidden" name="item_number" value="<?php echo htmlentities($pid)?>">
<input type="hidden" name="quantity" value="1">
<input type="hidden" name="amount" value="<?php echo $allprice?>">
<input type="hidden" name="currency_code" value="MYR">
<input type="hidden" name="payer_id" value="<?php echo $pid?>">


<div class=" d-flex mt-3">
            <div class="col-md-10 col-sm-8 d-flex flex-column">
              <p class="text-danger">Total Amount</p>
            </div>
            <hr>
         
            <div class="col-md-2 col-sm-4 d-flex flex-column">
              <strong class="text-danger"><p>$<?php echo htmlentities($allprice)?></p></strong>
            </div>
          </div>

        <div class="modal-body mx-2">
              <h4><strong>Personal Details</strong></h4>
        </div>

        <div class="modal-body mx-2">
          <label for="formGroupExampleInput">Full Name</label>
          <input type="text" class="form-control" value="<?php echo htmlentities($fullname)?>" disabled>
        </div>

        <input type="hidden" name="address1" value="9">
        <input type="hidden" name="address2" value="99999">

        <div class="modal-body mx-2">
          <label for="formGroupExampleInput">Address</label>
          <input type="text" class="form-control" value="<?php echo htmlentities($address)?>" name="city">
        </div>

        <input type="hidden" name="state" value="11111">
        <input type="hidden" name="zip" value="19312">
        <div class="modal-body mx-2">
          <label for="formGroupExampleInput">Phone Number</label>
          <input type="text" class="form-control" value="<?php echo htmlentities($phone)?>" name="phone" disabled>
        </div>
 
 <!-- IPN Url -->
 <div class="modal-body mx-2">
<input type='hidden' name='notify_url' value='http://9fc48bc9.ngrok.io/fyp3/paypal_ipn.php'>
<!-- Return URLs -->
<input type='hidden' name='cancel_return' value='<?php echo $payment_return_cancel; ?>'>
<input type='hidden' name='return' value='<?php echo $payment_return_success; ?>'>

<!-- Submit Button -->
<input type="hidden" name="cmd" value="_xclick">
<input type="submit" class="btn btn-success" value="Buy Now" name="submit">
</div>

    <!-- modal-body mx-2 -->
    </div>
  <!-- card-body -->
  </div>
</div>



</div>
</form >


<?php include("includes/footer.php")?>
    <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- rating.js file -->
  <script type="text/javascript" src="js/addons/rating.js"></script>
  <script type="text/javascript" src="js/style1.js"></script>
</body>
</html>
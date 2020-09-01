<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
      $itemsid = $_SESSION['productIDs'];
      $pid=$_SESSION['userpid'];
      //$productid = $_GET['productid'];
     
      $quantity = $_SESSION['orderquantitiy'] ;
      if(isset($_POST['submit'])){
        ?>
      <script>
      alert("yeah");
      </script>
        <?php
         $customerid = $_SESSION['userpid'];
  
        $amount = $_POST['amount'];
        $totalPrice = $quantity * $amount;
        $customerAddress = $_POST['customer_address'];

        $date=date_create();
        date_add($date,date_interval_create_from_date_string("3 days"));
        echo $shipmentDate = date_format($date,"Y/m/d");

        echo $sql = "INSERT INTO payment(customerID,totalPrice,customerAddress,status,shipmentDate) values
         ('$customerid','$totalPrice','$customerAddress',1,'$shipmentDate')"; 
        $query = $dbh->prepare($sql);
        $query->execute();

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
<form  action="<?php echo $paypal_url; ?>" method="post" enctype="multipart/form-data">
<!-- Get paypal email address from core_config.php -->
<input type="hidden" name="business" value="admin24@gmail.com">

  <!-- get customer detail -->
  <div class="container">
    
<?php  
$sql = "SELECT pid,FullName,address,PhoneNumber FROM customer where pid = '$pid'";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
  foreach($results as $result)
  {
    $fullname = $result->FullName;
    $address = $result->address;
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
    $address = $result->adress;
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
<?php  
$sql = "SELECT name,category,farmerID,unitPrice,picture,details,weight FROM product where id = '$itemsid'";
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
    ?>
<input type="hidden" name="item_name" value="<?php echo htmlentities($pid)?>">
<input type="hidden" name="item_number" value="<?php echo htmlentities($itemsid)?>">
<input type="hidden" name="quantity" value="<?php echo htmlentities($quantity)?>">
<input type="hidden" name="amount" value="<?php echo $totalPrice?>">
<input type="hidden" name="currency_code" value="MYR">
<input type="hidden" name="payer_id" value="<?php echo $pid?>">



<?php }}?>
<div class="card mt-4" >
  <div class="card-body">
    <div class="modal-body">
      <h1>Payment Confirm</h1>
      <hr>

      <h4 class="ml-3"><strong>Details</strong></h4>

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
<input type='hidden' name='notify_url' value='http://f278905e.ngrok.io/fyp3/paypal_ipn.php'>
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

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
if(isset($_POST['addcart'])){
  $farmerid=$_POST['farmerid'];
  $productid=$_GET['productid'];
  $unitprice=$_POST['unitPrice'];
  $quantity=$_POST['quantity'];

   $check = "SELECT customerID,productID,quantity FROM cart WHERE customerID='$pid'";
  $query = $dbh->prepare($check);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  
  $boolean = true;
  if($query->rowCount() > 0)
  {
    foreach($results as $result)
    {
      ?>
 
  <?php
      if ($result->productID == $productid){
        $boolean = false;
        $newquantity = ($result->quantity+ $quantity);
        
      }
    }
  }

    if($boolean == false){
      $sql1 = "SELECT quantity FROM product WHERE id = '$productid'";
      $query1 = $dbh->prepare($sql1);
      $query1->execute();
      $results1=$query1->fetchAll(PDO::FETCH_OBJ);
      if($query1->rowCount() > 0)
      {
        foreach($results1 as $result1)
        {
          if ($result1->quantity < $quantity){
            echo "<script>alert('Product quantity no enough!');</script>";
          }
          else{
            $countquantity = ($result1->quantity - $quantity);

            $sql2 = "UPDATE product SET quantity = '$countquantity'";
            $query2 = $dbh->prepare($sql2);
            $query2->execute();

            $sql3 = "UPDATE cart SET quantity = '$newquantity'";
            $query3 = $dbh->prepare($sql3);
            $query3->execute();
      
            if($query3){
              echo "<script>alert('Update Success to add!');</script>";
             
            }else{
              echo "<script>alert('Invalid to add!');</script>";
            }
          } 
       
        }
      }
      
      
    }else{
      $sql1 = "SELECT quantity FROM product WHERE id = '$productid'";
      $query1 = $dbh->prepare($sql1);
      $query1->execute();
      $results1=$query1->fetchAll(PDO::FETCH_OBJ);
      if($query1->rowCount() > 0)
      {
        foreach($results1 as $result1)
        {
         
            $countquantity = ($result1->quantity - $quantity);

            $sql2 = "UPDATE product SET quantity = '$countquantity'";
            $query2 = $dbh->prepare($sql2);
            $query2->execute();

            $sql3 ="INSERT INTO cart(customerID,farmerID,productID,unitPrice,quantity) VALUES ('$pid','$farmerid','$productid','$unitprice','$quantity')";
            $query3 = $dbh->prepare($sql3);
            $query3->execute();

            if($query3){
              echo "<script>alert(' Insert Success to add!');</script>";
              //echo "<script type='text/javascript'> document.location = 'main.php'; </script>";
            }else{
              echo "<script>alert('Invalid to add!');</script>";
            }
            
          }
        }
      }
}
if(isset($_POST['ordernow'])){
  $quantity=$_POST['quantity'];
  if ($quantity == ""){
    echo "<script>alert('Please enter the quantity!');</script>";
  }else{
    $_SESSION['orderquantitiy'] = $quantity;
   echo $productid = $_GET['productid'];
   echo $_SESSION['productIDs'] = $productid;
    ?>
    <script type='text/javascript'> document.location = 'payment.php?productid=<?php echo htmlentities($productid)?>'; </script>
    <?php
  }
}

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
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

<body class="tempting-azure-gradient">

  <!-- Start your project here-->
  <div class="container mt-5">

<!--Main Navigation-->
<header>




</header>
<!--Main Navigation-->

<!--Main Layout-->
<main class="text-center py-5">

<div class="container2 d-flex justify-content-center">
    <div class="row">
        <div class="col-md-12" >

          <!-- card -->
          <!-- style="max-width: 20rem; -->
          <div class="card border-success mb-3" style="max-width: 200rem;">
            
       

<?php 
$productid = $_GET['productid'];
$sql = "SELECT product.id as productID,product.name,product.category,product.picture as productPicture,product.weight,product.details,product.quantity,product.unitPrice,product.farmerID,farmer.UserName,farmer.picture as farmerPicture,farmer.shopName from product join farmer on farmer.id=product.farmerID where product.id=$productid";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
foreach($results as $result)
{

  ?>

<form method="post" enctype="multipart/form-data">
<div data-spy="scroll" data-target="#navbar-example2" class="scrollspy-example" data-offset="0">
            <div class="card-body text-success " id="navbar-example2-overview">
              <h2 class="h2-responsive text-center product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">
                <input type="hidden" name="productid" value="<?php echo htmlentities($result->id)?>">
                <input type="hidden" name="farmerid" value="<?php echo htmlentities($result->farmerID)?>">
                <strong><?php echo htmlentities($result->name)?></strong>
                </span>
              </h2>
              <?php 

?>

<div class="form-group">
              <!--Zoom effect-->
              <div class="d-flex justify-content-center mt-3">
                <div class="view overlay zoom">
                    <img src="Upload/product/<?php echo $result->productPicture ?>" class="img-thumbnail " style="width: 500px;height: 400px;" alt="zoom">
                </div>
              </div>
</div>

              <hr class="mt-5">

<div class="form-group">
              <h3 class="h3-responsive text-center mb-5 ml-xl-0 ml-4">
                <span class="red-text font-weight-bold" >
                <input type="hidden" name="unitPrice" value="<?php echo htmlentities($result->unitPrice) ?>">
                  <strong>RM<?php echo htmlentities($result->unitPrice)?>
                    <span class="grey-text">
                      <small>
                        /unit
                      </small><br>
                    </span>
                    <span class="grey-text" >
                      <small>
                        <?php echo htmlentities($result->quantity)?> pieces
                      </small>
                    </span>
                  </strong>
                </span>
              </h3>
</div>

<div class="form-group">
                <div id="navbar-example2-ratings">
                  <span id="rateMe4"  class="feedback"></span>
                </div>
</div>
                <hr>

<div class="form-group">
                <h4 class="card-title text-lg-left text-md-center text-sm-left font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4" id="navbar-example2-productdetails">
                  Product Detail
                </h4>
                <p class="card-text dark-grey-text d-flex justify-content-left mt-3">
                  <?php echo htmlentities($result->details)?>
                </p>
                <p class="card-text dark-grey-text d-flex justify-content-left mt-3">
                  Unit Price: <?php echo htmlentities($result->unitPrice)?>
                </p>
                <p class="card-text dark-grey-text d-flex justify-content-left mt-3">
                  Weight:<?php echo htmlentities($result->weight)?> 
                </p>
</div>

                <hr>

<div class="form-group">
                <h4 class="card-title text-lg-left text-md-center text-sm-left font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4" id="navbar-example2-shopdetails">
                  Shop Detail
                </h4>
                <div class="d-flex justify-content-center mt-3">
                
                  <div class="zoom">
                    <a href="#">
                    
                      <h6 class="font-weight-bold pt-3 text-success"><?php echo htmlentities($result->UserName)?></h6>
                      <p class="text-muted">
                        Shop: <?php echo htmlentities($result->shopName)?>
                      </p>
                    </a>
                  </div>
                <!-- d-flex justify-content-center mt-3 -->
                </div>
</div>

                <hr>

<div class="form-group">
                <h4 class="card-title text-lg-left text-md-center text-sm-left font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4" id="navbar-example2-shopdetails">
                  Order
                </h4>
                <div class="row mt-3 mb-4 d-flex flex-row-reverse">
                  <div class=" p-2 ">
                    Number: <input type="number" name="quantity" min='1' max="<?php echo $result->quantity ?>">
                  </div>
                </div>
</div>


<div class="form-group">
                  <div class="row mt-3 mb-4 d-flex flex-row-reverse">
                    <div class=" p-2 ">
                      <button class="btn dusty-grass-gradient text-dark" name="addcart">
                        <i class="fas fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart</button>
                    </div>

                    <div class="p-2 ">
                      <!-- <a href="payment.php?productid=<//?php echo htmlentities($result->productID)?>" class="btn dusty-grass-gradient text-dark" name="order1">
                        Order now</a> -->
                        <button class="btn dusty-grass-gradient text-dark" name="ordernow">Order now</button>
                    </div>       

                  </div>                         
</div>
     
<!-- scrollspy-example -->
</div>
</form>
<?php } 
}?>
            <!-- card-body text-success -->
            </div>

          <!-- card border-success mb-3  -->
          </div>
        <!-- col-md-12 -->
        </div>

    <!-- row -->
    </div>

<!-- container2 -->
</div>

</main>
<!--Main Layout-->

<!-- container mt-5-->
</div>

<?php include("includes/footer.php")?>
  <!-- Start your project here-->

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
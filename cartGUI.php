<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else
    {
        $pid=$_SESSION['userpid'];

          if(isset($_GET['delete'])){
        $id=$_GET['delete'];
        $sql = "DELETE FROM cart where id='$id'";
        $query = $dbh->prepare($sql);
        $query->execute();

        if($query){
            ?>
            <script type='text/javascript'>
                document.location = 'cartGUI.php';
            </script>
            <?php
        }
    }
       
    }
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    <!-- Start your project here  https://www.sandbox.paypal.com/cgi-bin/webscr-->
<div class="container mt-3">
    <form action="confirmcart.php" method="post" enctype="multipart/form-data">
        <table class="table table-hover"  id="tableID">
            <thead>
                <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Name of Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
<?php
$totalPrice = 0;
$gmail="";
$allPrice = 0;
$sql = "SELECT product.picture,product.name,cart.quantity,cart.unitPrice,cart.id FROM cart JOIN product ON product.id = cart.productID WHERE cart.customerID = '$pid'";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

foreach($results as $result){
    $totalPrice += ($result->quantity) * ($result->unitPrice);
    $allPrice += $totalPrice;
?>
                <tr>
                    <td><img src="Upload/product/<?php echo $result->picture ?>" style="display:hidden" width="auto" height="100px"></td>
                    <td><?php echo htmlentities($result->name)?></td>
                    <td>$<?php echo htmlentities($result->unitPrice)?></td>
                    <td><input type="number" value="<?php echo htmlentities($result->quantity)?>" style="width:50px;" name="quantity1[]"></td>
                    <input type="hidden" value="<?php echo htmlentities($result->id) ?>"  name="id1[]">
                    <td>$<?php echo htmlentities($totalPrice)?></td>
                    <td><a href="cartGUI.php?delete=<?php echo $result->id ?>" class="btn btn-danger btn-rounded btn-sm my-0" style="padding:10px 10px">Remove</a></td>
            
                </tr>
<?php
}
?>
            </tbody>

        </table>
        <hr>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-success" name="continue" onclick="moveToMainPage()">Continue Shopping</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <strong>Cart Total</strong> 
                    </div>

<?php
$fullname = "";
$address = "";
$phone = 0;
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
        }
    }
}?>
                    <div class="card-body">
                        <div class="modal-body">
                            Full Name:
                            <input type="text" class="form-control" value="<?php echo htmlentities($fullname)?>" disabled>
                        </div>

                        <div class="modal-body">
                            Phone Number:
                            <input type="number" class="form-control" value="<?php echo htmlentities($phone)?>" disabled>
                        </div>
                        <input type="hidden" name="address1" value="9">
                        <input type="hidden" name="address2" value="99999">
                        <div class="modal-body">
                            Address:<input type="text" class="form-control" name="city" value="<?php echo htmlentities($address)?>" >
                        </div>  
                        <input type="hidden" name="state" value="11111">
                        <input type="hidden" name="zip" value="19312">
                        <hr>
                        <div class="modal-body">
                            <strong>Total Price:<?php echo $allPrice ?></strong>
                        </div>
                        <!-- admin gmail at here -->
                        <input type="hidden" name="business" value="admin24@gmail.com">
                        <input type="hidden" name="item_number"  value="<?php echo $pid ?>">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="amount" value="<?php echo $allPrice?>">
                        <input type="hidden" name="currency_code" value="MYR">
                        <input type="hidden" name="item_name"  value="forCart">
        
                       
                    

                        <input type='hidden' name='cancel_return' value='<?php echo $payment_return_cancel; ?>'>
                        <input type='hidden' name='return' value='<?php echo $payment_return_success; ?>'>

                        <!-- Submit Button -->
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="submit" value="Confirm" name="submit" class="btn btn-success">
                    </div>
                </div>
            </div>
        </div>
        
       
    </form>    
</div>
    

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
    <script type="text/javascript" src="js/style.js"></script>
    <script>
        function myFunction(what){
           var aa= what.value;
            alert((aa));
        }
        function myFunction2(what){
            alert(what.value);
        }

        function remove(what){
            
        }

        function moveToMainPage(){
            document.location = 'MainPage.php';
        }
    </script>
      <?php include("includes/footer.php")?>
</body>

</html>
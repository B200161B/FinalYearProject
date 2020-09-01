<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
        $pid =$_SESSION['userpid'];

        if (isset($_POST['btnedit'])){
            $checkcustomer = "SELECT pid FROM customer WHERE pid='$pid'";
            $checkquery = $dbh->prepare($checkcustomer);
            $checkquery->execute();
            $results=$checkquery->fetchAll(PDO::FETCH_OBJ);
            if($checkquery->rowCount() > 0)
            {
    
                foreach($results as $result)
                {
                    echo "<script type='text/javascript'> document.location = 'edit-customerprofile.php'; </script>";
                }  
            }else{
                $checkfarmer = "SELECT pid FROM farmer WHERE pid='$pid'";
                $query = $dbh->prepare($checkfarmer);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                if($query->rowCount() > 0)
                {
                    foreach($results as $result)
                    {
                        echo "<script type='text/javascript'> document.location = 'edit-farmerprofile.php'; </script>";
                    }
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
</head>
<body>

<?php 
$sql = "SELECT * from customer where pid='$pid'";

$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{

  ?>


<p>customerid: <?php echo htmlentities($result->pid); ?></p> 
<p>customername: <?php echo htmlentities($result->UserName); ?></p> 
<?php 
}} ?>

<!-- if i put the form then i cannot access to product_info page when i click the product?why? -->
    <div>
    <form action="" method="post" enctype="multipart/form-data">
        <label id="product_a">Onion</label>
        <a href="product_info.php?productid=1" class="btn btn-primary">Click me</a>
    </div>
    
    <div>
    <label>Product B.....</label>
    <a href="productinfo.php?productid=2"><button>Click me!</button></a>
    </div>

    <div>
    <label>Product C.....</label>
    <a href="productinfo.php?productid=3"><button>Click me!</button></a>
    <div>

    <div>

    <button name="btnedit">Edit Profile</button></a>
    </div>
    </form>
</body>
</html>
<?php }?>

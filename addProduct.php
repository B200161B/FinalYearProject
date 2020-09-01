<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
$id=$_SESSION['userid'];
if(isset($_POST['addProduct']))
{ 
    $img=$_FILES['product_img']['tmp_name'];
    $path=  "Upload/product/" . $_FILES["product_img"]["name"];
    $filesName = $_FILES["product_img"]["name"];

    $name=$_POST['name'];
    $quantity=$_POST['quantity']; 
    $unitPrice=$_POST['unitPrice']; 
    $category=$_POST['category']; 
    $details=$_POST['details']; 
   

     $sql="INSERT INTO product(farmerID,picture,name,quantity,unitPrice,category,details) VALUES('$id',:filesName,:name,:quantity,:unitPrice,:category,:details)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':filesName',$filesName,PDO::PARAM_STR);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':quantity',$quantity,PDO::PARAM_STR);
    $query->bindParam(':unitPrice',$unitPrice,PDO::PARAM_STR);
    $query->bindParam(':category',$category,PDO::PARAM_STR);
    $query->bindParam(':details',$details,PDO::PARAM_STR);  
  
    $query->execute();

    if($query){
                  
                   //window.location.href=('index.php');
              
      if ($_FILES["product_img"]["error"] > 0){
          echo "Return Code: " . $_FILES["file"]["error"] . "<br/>";
      }
      else{
          if (file_exists($path)){
              echo $path." already exist";
          }
          else{
           
               move_uploaded_file($img,$path);
               
               
          }  
          
      }
      ?>      <script>
                window.location.href=('MainPage.php');
                
                 </script><?php
      
  }
  else{
      echo "hah??";
  }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="icon.png">
  <title>Add Product</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
</head>
<header>
<nav class="navbar fixed-top navbar-expand-sm navbar-light green lighten-3 p-2">
    <div class="row ml-1">
  <span class="navbar-text white-text">
    <i class="fa fa-chevron-left"></i>
    Add Product
    </span>
    
  </div>
   </nav>

</header>
<body>
  <div class="container-fluid my-4">
    <div id="addForm">
            <form class="text-center" method="POST" enctype="multipart/form-data">
                  <div class="md-form">
                    <img src="img/null.jpg" id="product-img-tag"  class="md-avatar rounded-circle"></img>
                    </div>
                    <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="product-img"
                                aria-describedby="inputGroupFileAddon01"name="product_img">
                              <label class="custom-file-label" for="product-img">Choose Photo of Product</label>
                            </div>
                    </div>
                    <div class="md-form">
                            <input type="text" name="name" class="form-control" id="name" required="required" placeholder="Product Name"></input> 
                    </div>
                    <div class="md-form">       
                            <input type="number" name="quantity" class="form-control" id="quantity" required="required" placeholder="Product Quantity" ></input>
                    </div>
                    <div class="md-form">   
                            <input type="number" name="unitPrice" class="form-control" id="unitPrice" required="required" step="0.01" min="0" placeholder="Product Price"></input>
                    </div>
                    <div class="md-form">
                    <span>Category</span>
                    <select class="mdb-select" name="category">
                      <option value="" disabled>Choose option</option>
                      <option value="Leafy_Vegetable" selected>Leafy Vegetable</option>
                      <option value="Fruit_Vegetable">Fruit Vegetable</option>
                      <option value="Garlic_Chilies_Onions">Garlic, Chilies & Onions</option>
                      <option value="Other_Vegetable">Other Vegetable</option>
                      <option value="Mushroom">Mushroom</option>
                      <option value="Potatoes">Potatoes</option>
                      <option value="Root_Vegetables">Root Vegetables</option>
                      <option value="Shoot_Vegetables">Shoot Vegetables</option>
                      <option value="Dried_Beans_Nuts">Dried Beans & Nuts</option>
                    </select>
                
                    </div>
                   
                      <div class="md-form ">
                        <textarea id="form7" class="md-textarea form-control" rows="3" name="details"></textarea>
                        <label for="form7">Product Detail</label>
                      </div>
                      <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 mb-5  waves-effect" type="submit" name="addProduct" value="Get Selected Values">Add</button>
                    
            </form>
    </div>
    </div>
  <?php include("includes/footer.php")?>
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
        
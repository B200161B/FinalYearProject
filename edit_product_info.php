<?php


session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
$pid=$_SESSION['pid'];
$productID=0;
$filesName="";

if(isset($_GET['productid']))
{
    $productID=$_GET['productid'];
}
if(isset($_POST['update']))
{ 
    if($_FILES["product_img"]['name']!=""){
    $img=$_FILES['product_img']['tmp_name'];
    $path=  "Upload/product/" . $_FILES["product_img"]["name"];
    $filesName = $_FILES["product_img"]["name"];
    }else{
     
        $sql = "SELECT picture FROM product WHERE id = '$productID'";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        { 
        foreach($results as $result){

        if ($result->picture != ""){
            $filesName = $result->picture;
    } }
}}
    $name=$_POST['name'];
    $quantity=$_POST['quantity']; 
    $unitPrice=$_POST['unitPrice']; 
    $category=$_POST['category']; 
    $details=$_POST['details']; 
   

  $sql="UPDATE product SET picture=:filesName,name=:name,quantity=:quantity,unitPrice=:unitPrice,category=:category,details=:details WHERE id='$productID'";

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
                 
      window.location.href=('myProduct.php');
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
  <title>VegNow-Add Product</title>
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
    Edit Product
    </span>
    
  </div>
   </nav>

</header>
<body>
<?php

?>
  <div class="container-fluid my-4">
    <div id="addForm">
            <form class="text-center" method="POST" enctype="multipart/form-data">
                  <div class="md-form">
                  <?php 
$sql = "SELECT picture ,name,quantity,unitPrice,details,category FROM product WHERE id = ' $productID'";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{ 
foreach($results as $result){

    if ($result->picture != ""){
      
        ?>
  
    <img src="Upload/product/<?php echo htmlentities($result->picture)?>" name="productimg" id="product-img-tag" style="display:hidden" class="rounded-circle imgsize" width="150px" height="20%" border-radius="50%" />
<?php }
    else{
        ?>                      
<img src="img/null.jpg" id="product-img-tag"  class="md-avatar rounded-circle"></img>
<?php }
}}
?>
                    
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
                            <input type="text" name="name" class="form-control" id="name" required="required" value="<?php echo ($result->name)?>"></input> 
                    </div>
                    <div class="md-form">       
                            <input type="number" name="quantity" class="form-control" id="quantity" required="required" value="<?php echo ($result->quantity)?>" ></input>
                    </div>
                    <div class="md-form">   
                            <input type="number" name="unitPrice" class="form-control" id="unitPrice" required="required" step="0.01" min="0" value="<?php echo ($result->unitPrice)?>"></input>
                    </div>
                    <div class="md-form">
                    <span>Category</span>
                    <select class="mdb-select" name="category">
                    <option value="" disabled>Choose option</option>
                      <?php 
                      $category= $result->category;
                        if($category=="Leafy_Vegetable"){
                            ?> <option value="Leafy_Vegetable" selected>Leafy Vegetable</option><?php 
                        }
                        else{
                            ?> <option value="Leafy_Vegetable">Leafy Vegetable</option><?php
                        }
                        if($category=="Fruit_Vegetable"){
                            ?> <option value="Fruit_Vegetable" selected>Fruit Vegetable</option><?php 
                        }
                        else{
                            ?> <option value="Fruit_Vegetable">Fruit Vegetable</option><?php
                        }
                        if($category=="Garlic_Chilies_Onions"){
                            ?> <option value="Garlic_Chilies_Onions" selected>Garlic,Chilies&Onions</option><?php 
                        }
                        else{
                            ?> <option value="Garlic_Chilies_Onions">Garlic,Chilies&Onions</option><?php
                        }
                        if($category=="Other_Vegetable"){
                            ?> <option value="Other_Vegetable" selected>Other Vegetable</option><?php 
                        }
                        else{
                            ?> <option value="Other_Vegetable">Other Vegetable</option><?php
                        }
                        if($category=="Mushroom"){
                            ?> <option value="Mushroom" selected>Mushroom</option><?php 
                        }
                        else{
                            ?> <option value="Mushroom">Mushroom</option><?php
                        }
                        if($category=="Potatoes"){
                            ?> <option value="Potatoes" selected>Potatoes</option><?php 
                        }
                        else{
                            ?> <option value="Potatoes">Potatoes</option><?php
                        }
                        if($category=="Root_Vegetables"){
                            ?> <option value="Root_Vegetables" selected>Root Vegetables</option><?php 
                        }
                        else{
                            ?> <option value="Root_Vegetables">Root Vegetables</option><?php
                        }
                        if($category=="Shoot_Vegetables"){
                            ?> <option value="Shoot_Vegetables" selected>Shoot Vegetables</option><?php 
                        }
                        else{
                            ?> <option value="Shoot_Vegetables">Shoot Vegetables</option><?php
                        }
                        if($category=="Dried_Beans_Nuts"){
                            ?> <option value="Dried_Beans_Nuts" selected>Dried Beans Nuts</option> <?php 
                        }
                        else{
                            ?> <option value="Dried_Beans_Nuts">Dried Beans Nuts</option><?php
                        }
                        ?>
                    </select>
                
                    </div>
                   
                      <div class="md-form ">
                        <textarea id="form7" class="md-textarea form-control" rows="3" name="details"><?php echo ($result->details)?></textarea>
                        <label for="form7">Product Detail</label>
                      </div>
                      <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 mb-5  waves-effect" type="submit" name="update" value="Get Selected Values" >Update</button>
                    
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
        
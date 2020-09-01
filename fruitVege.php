<?php
session_start();
error_reporting(0);
include('includes/config.php');
$id=1;//$SESSION('id');
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
  <link href="css/style.css" rel="stylesheet">
</head>
<header>
    <nav class="navbar fixed-top navbar-expand-sm navbar-light green lighten-3 p-2">

        <!-- Collapsible content -->
        
          <!-- Search form -->
          <form class="form-inline">
            <div class="md-form my-0">
              <input class="" type="text" placeholder="Search" aria-label="Search">
              <i class="fas fa-search text-white ml-3" aria-hidden="true"></i>
            </div>
          </form>
      
      
        <!-- Navbar brand -->
        <a class="navbar-brand" href="file:///C:/Users/ASUS/Desktop/2019%20CSEM/Project/test/MDB-Free_4.8.11/MDB-Free_4.8.11/wallet.html"><i class="fas fa-wallet"></i></a>
      
      </nav>
      
</header>
<body>
      
      <div class="container-fluid">
      <?php 
$sql1 ="SELECT name,unitPrice,picture from product WHERE category = "Fruit Vegetable" ";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$count=1;
foreach($results1 as $result)
{   
    ?>

    <div id="cardCategories"class="card">
        <div class="row">
            <div class ="col">
            <img class="card-img-left" src="Upload/<?php echo ($result->picture)?>"
            alt="Product Image">
            </div>
            <div class ="col">
                <div class="row">
                <h4 class="card-title font-weight-bold"><?php echo ($result->name)?></h4>
                <p class="card-text"><?php echo ($result->unitPrice)?></p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
$id=$_SESSION['id'];
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
  <nav class="fixed-top navbar-expand-sm navbar-light green lighten-3 ">
    <div class="row">
      <div class="col">
    <i class="fas fa-chevron-left"></i>
      </div>
    <div class="col">
      <h5 style="text-align: center;">Wallet</h5>
    </div>
  </div>
   </nav>
</header>
<body class="tempting-azure-gradient">
<?php

$sql_wallet ="SELECT wallet FROM ";
$query_wallet = $dbh -> prepare($sql_wallet);
$query_wallet->execute();
$results_wallet=$query_wallet->fetchAll(PDO::FETCH_OBJ);
?>

        <div id="walletContent">
            <h5>Available Balance</h5>
            <h3>MYR XX.XX</h3>
            <a class="btn btn-sm btn-primary">Top Up</a>
         </div>

         <?php include("includes/footer.php")?>
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

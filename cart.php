
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="icon" href="icon.png">
</head>
<body>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<table>
    <th>Product</th>
    <th>UnitPrice</th>
    <th>Quantity</th>

    <?php
    include("includes/config.php");
    $totalPrice = 0;
    $gmail="";
    // here to session
    $pid = "F1";
    //Sql have to change in where condition
    $sql ="SELECT c.farmerID,c.customerID,c.productID,c.unitPrice,c.quantity,p.name  from cart c 
    join product p on p.id=c.productID where c.customerID ='$pid '";
    $query = $dbh ->prepare($sql);
    $query ->execute();
    $results =$query->fetchAll(PDO::FETCH_OBJ);
    
    foreach($results as $result){
       ?>
       <tr>
        <td><?php echo $result->name?></td>
        <td><?php echo $result->unitPrice ?></td>
        <td><?php echo $result->quantity ?></td>
       </tr>
       <?php
       $totalPrice +=$result->unitPrice * $result->quantity;
    }
?>  

    </table>
    <div>Address:<input type="text" name="item_name" class="form-control"></div>
    <div><span>Total Price:<?php echo $totalPrice ?></span></div>
        <!-- admin gmail at here -->
        <input type="hidden" name="business" value="admin24@gmail.com">
        <input type="hidden" name="item_number"  value="<?php echo $pid ?>">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="amount" value="<?php echo $totalPrice?>">
        <input type="hidden" name="currency_code" value="MYR">
        
        <input type="hidden" name="address1" value="9">
        <input type="hidden" name="address2" value="99999">
        <input type="hidden" name="city" value="lol" >
        <input type="hidden" name="state" value="11111">
        <input type="hidden" name="zip" value="19312">

        <input type='hidden' name='cancel_return' value='<?php echo $payment_return_cancel; ?>'>
        <input type='hidden' name='return' value='<?php echo $payment_return_success; ?>'>

        <!-- Submit Button -->
        <input type="hidden" name="cmd" value="_xclick">
        <input type="submit" value="Confirm" name="submit" class="btn btn-primary">
    </form>
</body>
</html>
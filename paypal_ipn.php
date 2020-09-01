<?php
namespace Listener;
session_start();
error_reporting(E_ALL);

include('includes/config.php');
//include PayPal IPN Class file (https://github.com/paypal/ipn-code-samples/blob/master/php/PaypalIPN.php)
require('PaypalIPN.php');

//include configuration file
use PaypalIPN;
$ipn = new PaypalIPN();
if (true) {$ipn->useSandbox();}
$verified = true;

$ipn->verifyIPN();

//reading $_POST data from PayPal
$data_text = "";
foreach ($_POST as $key => $value) {
$data_text .= $key . " = " . $value . "\r\n";
}

$receiver_email_found = true;
// Checking if price was changed during payment.
// Get product price from database and compare with posted price from PayPal
$correct_price_found = false;

if (strtolower($_POST["receiver_email"]) == "admin24@gmail.com") {
    $checking = $_POST['item_name'];
    if($checking == "forCart"){
        $paypal_ipn_status = "PAYMENT VERIFICATION FAILED";
        if ($verified) {
        $paypal_ipn_status = "Email address or price mismatch";
        if ($receiver_email_found || $correct_price_found) {
        $paypal_ipn_status = "Payment has been verified";

        $customer_pid = $_POST['item_number'];
        $payment_amount = $_POST['mc_gross'];
        $unitPrice = $_POST['mc_gross']/$_POST['quantity'];
        $status = 1;
        $customerAddress = $_POST['address_city'];
        $buyByName = "";
        $phoneNumber = 0;
        $quantity = $_POST['quantity'];
        $farmerID = "";
        
        if(strpos($customer_pid,'F')!==false){
            $sql = "UPDATE farmer set adress='$customerAddress' where pid='$customer_pid'";
        }
        else{
            $sql = "UPDATE customer set address='$customerAddress' where pid='$customer_pid'";
        }
        
        $query = $dbh->prepare($sql);
        $query -> execute();

        $paymentID = 0;
        
        echo $sql ="INSERT into payment (customerID,totalPrice,customerAddress,status) values 
        ('$customer_pid','$payment_amount','$customerAddress',1)";

        $query = $dbh->prepare($sql);
        $query -> execute();

        if(strpos($customer_pid,'F')!==false){
           echo $sql = "SELECT FullName,phoneNumber from farmer where pid='$customer_pid'";
        }
        else{
            $sql = "SELECT FullName,phoneNumber from customer where pid = '$customer_pid'";
        }
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll();
        foreach($results as $result){
            $buyByName = $result['FullName'];
            $phoneNumber = $result['phoneNumber'];
        }

        $sql = "SELECT id from payment ORDER BY id DESC LIMIT 1";
        $query = $dbh->prepare($sql);
        $query -> execute();
        $results= $query->fetchAll();
        foreach($results as $result){
            $paymentID = $result['id'];
        }

    
        $sql = "SELECT farmerID,id,productID from cart where customerID='$customer_pid'";
        $query = $dbh->prepare($sql);
        $query -> execute();
        $results = $query->fetchAll();
        foreach($results as $result){
            $farmerID= $result ['farmerID'];
           $productID =$result['productID'];
           

            $sql1="INSERT into orderdetails(customerID,farmerID,productID,buyByName,quantity,unitPrice,status,paymentID,phoneNumber,customerAddress) values
            ('$customer_pid','$farmerID','$productID','$buyByName','$quantity','$unitPrice',1,'$paymentID',
        '$phoneNumber','$customerAddress')";
            $query1 = $dbh->prepare($sql1);
            $query1 -> execute();
        }

        $sql = "DELETE from cart where customerID='$customer_pid'";
        $query = $dbh->prepare($sql);
        $query->execute();
        
        

    }}}
    else{
        $itemsid = $_SESSION['productIDs'];
        //Checking Payment Verification
        $paypal_ipn_status = "PAYMENT VERIFICATION FAILED";
        if ($verified) {
        $paypal_ipn_status = "Email address or price mismatch";
        if ($receiver_email_found || $correct_price_found) {
        $paypal_ipn_status = "Payment has been verified";
        
        // Check if payment has been completed and insert payment data to database
        // if ($_POST["payment_status"] == "Completed") {
        // uncomment upper line to exit sandbox mode
        
        echo $customer_pid = $_POST['item_name'];
        echo $payment_amount = $_POST['mc_gross'];

        $productID = $_POST['item_number'];

        $unitPrice = $_POST['mc_gross']/$_POST['quantity'];
        $status = 1;
        $customerAddress = $_POST['address_city'];
        $buyByName = "";
        $phoneNumber = 0;
        $quantity = $_POST['quantity'];
        $farmerID = "";
        $status = 1;


        if(strpos($customer_pid,'F')!==false){
            $sql = "UPDATE farmer set adress='$customerAddress' where pid='$customer_pid'";
        }
        else{
            $sql = "UPDATE customer set address='$customerAddress' where pid='$customer_pid'";
        }
        
        $query = $dbh->prepare($sql);
        $query -> execute();



        
                // $date=date_create();
                // date_add($date,date_interval_create_from_date_string("3 days"));
                //  $shipmentDate = date_format($date,"Y/m/d");
                $shipmentDate = "";
          $sql = "INSERT INTO payment (customerID, totalPrice, customerAddress, status,shipmentDate) VALUES ('$customer_pid', '$payment_amount' ,'$customerAddress', 1,'$shipmentDate')"    ;
        // Insert payment data to database
        if ( $insert_stmt = $dbh->prepare($sql)) {
        
        if (! $insert_stmt->execute()) {
        $paypal_ipn_status = "Payment has been completed but not stored into database";
        }
        $paypal_ipn_status = "Payment has been completed and stored to database";
        }

        if(strpos($customer_pid,'F')!==false){
            echo $sql = "SELECT FullName,phoneNumber from farmer where pid='$customer_pid'";
         }
         else{
             $sql = "SELECT FullName,phoneNumber from customer where pid = '$customer_pid'";
         }
         $query = $dbh->prepare($sql);
         $query->execute();
         $results = $query->fetchAll();
         foreach($results as $result){
             $buyByName = $result['FullName'];
             $phoneNumber = $result['phoneNumber'];
         }
 
         $sql = "SELECT id from payment ORDER BY id DESC LIMIT 1";
         $query = $dbh->prepare($sql);
         $query -> execute();
         $results= $query->fetchAll();
         foreach($results as $result){
             $paymentID = $result['id'];
         }
 
     
         $sql = "SELECT farmerID,id from product where id='$productID'";
         $query = $dbh->prepare($sql);
         $query -> execute();
         $results = $query->fetchAll();
         foreach($results as $result){
             $farmerID= $result ['farmerID'];
        
            
             echo $sql1="INSERT into orderdetails(customerID,farmerID,productID,buyByName,quantity,unitPrice,status,paymentID,
             shipmentDate,phoneNumber,customerAddress) values
             ('$customer_pid','$farmerID','$productID','$buyByName','$quantity','$unitPrice',1,'$paymentID',
             '$shipmentDate','$phoneNumber','$customerAddress')";
             $query1 = $dbh->prepare($sql1);
             $query1 -> execute();
         }
        // }
        // uncomment upper line to exit sandbox mode
        }
        } else {
        $paypal_ipn_status = "Payment verification failed";
        }
    }
  
}else{
//Checking Payment Verification
$paypal_ipn_status = "PAYMENT VERIFICATION FAILED";
if ($verified) {
$paypal_ipn_status = "Email address or price mismatch";
if ($receiver_email_found || $correct_price_found) {
$paypal_ipn_status = "Payment has been verified";

// Check if payment has been completed and insert payment data to database
// if ($_POST["payment_status"] == "Completed") {
// uncomment upper line to exit sandbox mode

echo $orderID = $_POST['item_number'];
echo "|";
echo $payment_amount = $_POST['mc_gross'];
echo "|";
echo $_POST['receiver_email'];
echo "|";
echo $farmerID=$_POST['item_name'];
 echo $sql = "UPDATE orderdetails set status=4 where id='$orderID'";
// Insert payment data to database
if ( $insert_stmt = $dbh->prepare($sql)) {
if (! $insert_stmt->execute()) {
$paypal_ipn_status = "Payment has been completed but not stored into database";
}
$paypal_ipn_status = "Payment has been completed and stored to database";
}
// }
// uncomment upper line to exit sandbox mode
}
} else {
$paypal_ipn_status = "Payment verification failed";
}
}


?>
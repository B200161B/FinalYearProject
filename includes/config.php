<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','vege');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

$system_mode = 'test'; // set 'test' for sandbox and leave blank for real payments.
$paypal_seller = 'sb-ifpvy601094@business.example.com'; //Your PayPal account email address

$payment_return_success = 'http://f278905e.ngrok.io/fyp3/MainPage.php'; //after payment, user will be redirected in this page, change with your own url
$payment_return_cancel = 'product_info.php'; //if payment cancelled, user will be redirected in this page, change with your own url

if ($system_mode == 'test') {$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; } 
else {$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';}


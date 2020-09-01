<?php
    include('includes/config.php');
    $sql = "";
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {    
        if(isset($_GET['id']) && isset($_GET['customerID'])){
            $id = $_GET['id'];
            $customer = $_GET['customerID'];
            if (strpos($customer, 'F') !== false) {
                 $sql = "SELECT o.id,o.customerID,o.farmerID,o.unitPrice,o.phoneNumber,
                o.customerAddress,o.status,
                o.productID,o.quantity * o.unitPrice as totalPrice,
                o.quantity,o.shipmentDate,
                f1.FullName as farmerName,f2.FullName as customerName FROM vege.orderdetails o  
                JOIN vege.farmer f2 on o.customerID = f2.pid
                JOIN vege.farmer f1 ON o.farmerID = f1.id
                 WHERE o.id=$id"; 
            }
            else{
                $sql = "SELECT o.id,o.customerID,o.farmerID,o.unitPrice,o.phoneNumber,
                o.customerAddress,o.status,
                o.productID,o.quantity * o.unitPrice as totalPrice,
                o.quantity,o.shipmentDate,
                farmer.FullName as farmerName,customer.FullName as customerName FROM vege.orderdetails o
                JOIN customer ON o.customerID = customer.pid
                JOIN farmer ON o.farmerID = farmer.id "; 
            }
    
        }
    
        if(isset($_GET['payment'])){
            
             $sql = "SELECT o.id,o.customerID,o.totalPrice,o.status from vege.payment o where status<=3 order by
             status";
        }
    
        if(isset($_GET['comment'])){
            
         $sql = "SELECT r.id,r.productID,r.customerID,r.rates,r.comment,r.commentByName,product.name as productName from vege.rating r
         join product on r.productID = product.id";
        }
         
        if(isset($_GET['product'])){
            $sql = "SELECT o.id,o.name,o.farmerID,o.quantity,o.unitPrice,farmer.FullName from vege.product o 
            join farmer on o.farmerID = farmer.id";
        }
    
        if(isset($_GET['customer'])){
            $sql = "SELECT c.id,c.FullName,c.UserName,c.PhoneNumber,c.status from vege.customer c";
        }
    
        if(isset($_GET['customerIDS'])){
            $id = $_GET['customerIDS'];
            $sql = "SELECT c.id,c.FullName,c.UserName,c.PhoneNumber,c.ICNumber,c.gmail,c.status,
            c.picture from vege.customer c where
            c.id =  $id";
        }
    
        if(isset($_GET['farmer'])){
            $sql = "SELECT f.id,f.UserName,f.PhoneNumber,f.shopName,f.status from vege.farmer f";
        }
    
        if(isset($_GET['farmerIDS'])){
            $id = $_GET['farmerIDS'];
            $sql = "SELECT f.id,f.FullName,f.UserName,f.PhoneNumber,f.ICNumber,f.shopName,f.shopAddress,
            f.gmail,f.status,f.picture
             from vege.farmer f where f.id = $id";
        }
    
        if(isset($_GET['logistic'])){
            $sql = "SELECT l.id,l.personInCharge,l.companyName,l.companyAddress from vege.logistic l";
        }
    
        if(isset($_GET['logisticIDS'])){
            $id = $_GET['logisticIDS'];
            $sql = "SELECT * from vege.logistic where logistic.id = $id";
        }
    
        if(isset($_GET['verifyFarmer'])){
            $sql ="SELECT * from vege.verifying_user";
        }
    
        if(isset($_GET['verifyFarmerIDS'])){
            $id = $_GET['verifyFarmerIDS'];
            $sql = "SELECT * from vege.verifying_user where verifying_user.id=$id";
        }

        if(isset($_GET['logisticDelivery'])){
            $id=$_GET['logisticDelivery'];
            $sql = "SELECT o.buyByName,o.productID,o.farmerID,o.status,o.id as ID,p.name as productName,
            f.FullName as farmerName,f.logisticID
            from orderdetails o 
            join product p on p.id = o.productID
            join farmer f on f.id=o.farmerID
           
            where o.status = 2 AND f.logisticID='$id'";
        }
    
        if(isset($_GET['logisticFarmer']))
        {   
            $id=$_GET['logisticFarmer'];
            $sql = "SELECT o.buyByName,o.productID,o.farmerID,o.status,o.id as ID,p.name as productName,
            f.FullName as farmerName,f.logisticID
            from orderdetails o 
            join product p on p.id = o.productID
            join farmer f on f.id=o.farmerID
             where o.status = 1 AND f.logisticID='$id'";
        }
        if(isset($_GET['logisticFarmerDetails'])){
            $id = $_GET['logisticFarmerDetails'];
            $sql = "SELECT o.buyByName,o.quantity,o.unitPrice,o.status,o.paymentID,o.shipmentDate,o.phoneNumber,o.id,
            o.customerAddress,farmer.FullName as farmerName,product.name as productName,o.productID as productID,farmer.logisticID ,o.customerID,o.farmerID from orderdetails o
            join farmer on farmer.id = o.farmerID 
            join product on product.id = o.productID where o.id =$id";
        }
        if(isset($_GET['logisticViewOrderDetails'])){
            $id = $_GET['logisticViewOrderDetails'];
            $sql = "SELECT o.buyByName,o.quantity,o.unitPrice,o.status,o.paymentID,o.shipmentDate,o.phoneNumber,o.id,
            o.customerAddress,farmer.FullName as farmerName,product.name as productName,o.productID as productID,farmer.logisticID ,o.customerID,o.farmerID from orderdetails o
            join farmer on farmer.id = o.farmerID 
            join product on product.id = o.productID where o.id =$id";
        }

        if(isset($_GET['payment_details'])){
         $id=$_GET['payment_details'];
         $sql = "SELECT o.customerID,o.id,o.farmerID,o.productID,o.buyByName,o.quantity,o.unitPrice,o.status,o.phoneNumber,o.customerAddress,
         product.name,o.creationDate,o.shipmentDate 
          from orderdetails o join product on product.id = o.productID where paymentID='$id'";   
        }

        if(isset($_GET['order_details'])){
            $id = $_GET['order_details'];
            $sql = "SELECT o.customerID,o.id,o.farmerID,o.productID,o.buyByName,o.quantity,o.unitPrice,o.status,o.phoneNumber,o.customerAddress,
            p.name as productName,farmer.gmail as farmerEmail
          from orderdetails o  join product p on p.id=o.productID
          join farmer on farmer.id = o.farmerID where o.id ='$id'";
        }
        
        $query = $dbh ->prepare($sql);
        $query ->execute();
        $result =$query->fetchAll(PDO::FETCH_OBJ);
        
        if($query){
            $data = array();
            if($query->rowCount() > 0){
            foreach($result as $results){   
            $data[] = $results;
            
            }
            echo json_encode($data);
        }
        else{
            echo "error";
        }
    }   
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
        
        if(isset($_POST['blockOrActiveCustomer'])){
            $id = $_POST['customerID'];
            $status = $_POST['status'];
            $sql = "UPDATE customer set status = $status  where customer.id=$id";
        }

        if(isset($_POST['blockOrActiveFarmer'])){
            $id = $_POST['farmerID'];
            $status = $_POST['status'];
            $sql = "UPDATE farmer set status = $status  where farmer.id=$id";
        }

      

        if(isset($_POST['deleteVerifyIDandAddOn'])){
            $id = $_POST['deleteVerifyIDandAddOn'];
            $FullName = $_POST['FullName'];
            $userName = $_POST['userName'];
            $icNumber = $_POST['icNumber'];
            $gmail = $_POST['gmail'];
            $deliveryCompany = $_POST['deliveryCompany'];
            $shopAddress = $_POST['shopAddress'];
            $shopName = $_POST['shopName'];
            $profilePic = $_POST['profilePic'];
            $password = md5($_POST['password']);
            $phoneNumber = $_POST['phoneNumber'];

            $sql = "SELECT * from farmer";
            $stmt = $dbh ->prepare($sql);
            $stmt->execute();

            $last_id = 0;
            $result =$stmt->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $results){
                $last_id = $results->id; 
            }

            $newID =   $last_id +1;

           echo $sql = "INSERT into farmer (pid,FullName,UserName,Password,PhoneNumber,ICNumber,shopName,logisticID,
            shopAddress,status,gmail,picture) values ('F$newID','$FullName','$userName','$password','$phoneNumber',
            '$icNumber',
            '$shopName','$deliveryCompany','$shopAddress',0,
            '$gmail','$profilePic')";
           
           $query = $dbh ->prepare($sql);
           $query ->execute();
            if($query){
                $sql = "DELETE from verifying_user where id=$id";
            }
       

        }

        if(isset($_POST['deleteVerifyIDandReject'])){
            $id = $_POST['deleteVerifyIDandReject'];
            $sql = "DELETE from verifying_user where id=$id";
        }

        if(isset($_POST['logisticusername'])){
            $username = $_POST['logisticusername'];
            $password = md5($_POST['password']);
            $companyName = $_POST['companyName'];
            $companyAddress = $_POST['companyAddress'];
            $phoneNumber = $_POST['PhoneNumber'];
            $personInCharge = $_POST['personInCharge'];
            $license = $_POST['licenseID'];

            $sql = "INSERT INTO logistic (UserName,Password,companyName,companyAddress,personInCharge,license,PhoneNumber)
             values('$username','$password','$companyName','$companyAddress','$personInCharge','$license','$phoneNumber')";
        }

        if(isset($_POST['oldPassword']))
        {   
            $isCorrect = false;
            $oldPassword = md5($_POST['oldPassword']);
            $newPassword = md5($_POST['newPassword']);
            
            $sql = "SELECT * from admin where id = 1";
            $query = $dbh ->prepare($sql);
            $query ->execute();
            $result =$query->fetchAll(PDO::FETCH_OBJ);
            if($query){
                foreach($result as $results){   
                    if($oldPassword==$results->Password){
                        $isCorrect = true;
                        break;
                    }
                
                }
        }   
            if($isCorrect){
                $sql = "UPDATE admin set Password = '$newPassword' where id=1";
                echo "update successful";
            }
            else{
                echo "password wrong";
                
            }

            echo $sql;

           
        }

        if(isset($_POST['receiveByName']))
        {   
            $customerID = $_POST['customerID'];
            $farmerID = $_POST['farmerID'];
            $logisticID = $_POST['logisticID'];
            $customerLocation = $_POST['customerLocation'];
            $productID = $_POST['productID'];
            $quantity = $_POST['quantity'];
            $receiveByName = $_POST['receiveByName'];
            $receiveByIC = $_POST['receiveByIC'];
            $id = $_POST['id'];

            $sql ="UPDATE orderdetails set status=3 where id ='$id'";
            $query = $dbh ->prepare($sql);
            $query ->execute();

            $sql = "INSERT into receipt (customerID,farmerID,logisticID,customerLocation,productID,quantity,receiveByName,receiveByIC)values
            ('$customerID','$farmerID','$logisticID','$customerLocation','$productID','$quantity','$receiveByName','$receiveByIC')";

            $query = $dbh ->prepare($sql);
            $query ->execute();

            $sql = "SELECT paymentID  from orderdetails where id='$id'";
            $query = $dbh ->prepare($sql);
            $query ->execute();

            $paymentID = 0;
            $result =$query->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $results){
            $paymentID=$results->paymentID;
            }

            $sql = "SELECT orderdetails.status from orderdetails where = '$paymentID'";
            $query = $dbh ->prepare($sql);
            $query ->execute();
            $allHave = true;
            $result =$query->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $results){
            if($results->status !=3){
                $allHave = false;
            break;
        }
    }
        if($allHave){
            $sql="UPDATE payment set status=3 where id='$paymentID'";    
        }
        else{
        $sql="";
        }

    }

        if(isset($_POST['updateStatus'])){
            $id = $_POST['id'];
            $sql = "UPDATE orderdetails set status=2 where id='$id'";
            $query = $dbh ->prepare($sql);
            $query ->execute();

            $sql = "SELECT paymentID  from orderdetails where id='$id'";
            $query = $dbh ->prepare($sql);
            $query ->execute();

            $paymentID = 0;
            $result =$query->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $results){
                $paymentID=$results->paymentID;
            }

            $sql = "SELECT status from orderdetails where paymentID = '$paymentID'";
            $query = $dbh ->prepare($sql);
            $query ->execute();
            $allHave = true;
            $result =$query->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $results){
                if($results->status !=2){
                    $allHave = false;
                break;
                }
            }
            if($allHave){
                $sql="UPDATE payment set status=2 where id='$paymentID'";    
            }
            else{
                $sql="";
            }

        }

        $query = $dbh ->prepare($sql);
        $query ->execute();
      
    }
   
?>
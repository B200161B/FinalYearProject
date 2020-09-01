<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['c_signup']))
{
    $img=$_FILES['profile_img']['tmp_name'];
    $path= "Upload/profilePic/" . $_FILES["profile_img"]["name"];
    $filesName = $_FILES["profile_img"]["name"];

    $fullname=$_POST['fullname'];
    $username=$_POST['username']; 
    $icnum=$_POST['icnum']; 
    $password=md5($_POST['password']); 
    $phone=$_POST['phone']; 
    $gmail=$_POST['gmail']; 
    $status=1;
    
    $sql2 = "SELECT * from customer";
    $stmt = $dbh ->prepare($sql2);
    $stmt->execute();

    $last_id = 0;
    $result =$stmt->fetchAll(PDO::FETCH_OBJ);
    foreach($result as $results){
        $last_id = $results->id; 
    }

    $newID =   $last_id +1;
    
    $sql="INSERT INTO customer(pid,picture,FullName,UserName,ICNumber,Password,PhoneNumber,gmail,status) VALUES('C$newID',:filesName,:fullname,:username,:icnum,:password,:phone,:gmail,:status)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':filesName',$filesName,PDO::PARAM_STR);
    $query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
    $query->bindParam(':username',$username,PDO::PARAM_STR);
    $query->bindParam(':icnum',$icnum,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->bindParam(':phone',$phone,PDO::PARAM_STR);  
    $query->bindParam(':gmail',$gmail,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->execute();

    if($query){
      if ($_FILES["profile_img"]["error"] > 0){
          echo "Return Code: " . $_FILES["file"]["error"] . "<br/>";
      }
      else{
          if (file_exists($path)){
              //echo $path." already exist";
              ?>
              <script>
                   alert("add image successul");
                   //window.location.href=('index.php');
              </script>
              <?php
          }
          else{
               move_uploaded_file($img,$path);
               echo "Stored in: ".$path;
          }  
          
      }
  }
  else{
      echo "hah??";
  }

}

else if(isset($_POST['f_signup']))
{
    $img=$_FILES['profile_img']['tmp_name'];
    $path= "Upload/profilePic/" . $_FILES["profile_img"]["name"];
    $filesName = $_FILES["profile_img"]["name"];

    $fullname=$_POST['fullname'];
    $username=$_POST['username']; 
    $icnum=$_POST['icnum']; 
    $password=md5($_POST['password']); 
    $phone=$_POST['phone']; 
    $gmail=$_POST['gmail']; 
    $shopname=$_POST['shopname'];
    $shopaddress=$_POST['shopaddress'];

    $sql2 = "SELECT * from customer";
    $stmt = $dbh ->prepare($sql2);
    $stmt->execute();

    $last_id = 0;
    $result =$stmt->fetchAll(PDO::FETCH_OBJ);
    foreach($result as $results){
        $last_id = $results->id; 
    }

    $newID =   $last_id +1;

     $sql="INSERT INTO verifying_user(picture,FullName,UserName,ICNumber,Password,PhoneNumber,gmail,shopName,shopAddress) 
    VALUES('$filesName','$fullname','$username','$icnum','$password','$phone','$gmail','$shopname','$shopaddress')";

    $query = $dbh->prepare($sql);
    // $query->bindParam(':filesName',$filesName,PDO::PARAM_STR);
    // $query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
    // $query->bindParam(':username',$username,PDO::PARAM_STR);
    // $query->bindParam(':icnum',$icnum,PDO::PARAM_STR);
    // $query->bindParam(':password',$password,PDO::PARAM_STR);
    // $query->bindParam(':phone',$phone,PDO::PARAM_STR);  
    // $query->bindParam(':gmail',$gmail,PDO::PARAM_STR);
    // $query->bindParam(':shopname',$shopname,PDO::PARAM_STR);
    // $query->bindParam(':shopaddress',$shopaddress,PDO::PARAM_STR);
    $query->execute();

    if($query){
      if ($_FILES["profile_img"]["error"] > 0){
          echo "Return Code: " . $_FILES["file"]["error"] . "<br/>";
      }
      else{
          if (file_exists($path)){
              //echo $path." already exist";
              ?>
              <script>
                   
                   //window.location.href=('index.php');
              </script>
              <?php
          }
          else{
               move_uploaded_file($img,$path);
               echo "Stored in: ".$path;
          }  
          
      }
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
  <title>Material Design Bootstrap</title>
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

  <!-- Start your project here-->
  <!-- <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true"> -->
  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     

 <!-- Nav tabs -->
 <nav class="navbar navbar-nav navbar-expand-lg d-flex justify-content-center dusty-grass-gradient">
    <!-- <nav class="navbar navbar-expand-lg navbar-dark "> -->
    <ul class="nav navbar-nav" role="tablist">
      <li class="nav-item d-flex justify-content-around mr-lg-3">
        <a class="nav-link active dark-grey-text" data-toggle="tab" href="#panel7" role="tab"><i class="fas fa-user mr-1"></i>
          Customer</a>
      </li>
      <li class="nav-item d-flex justify-content-around ml-lg-3">
        <a class="nav-link dark-grey-text" data-toggle="tab" href="#panel8" role="tab"><i class="fas fa-user mr-1"></i>
          Farmer</a>
      </li>
    </ul>
   </nav>

   

    <!-- Tab panels -->
     <div class="tab-content">

        <!--Panel 7-->
        <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

<!-- form -->
<form action="" method="post" enctype="multipart/form-data">

          <!--Body-->
          <div class="modal-body mx-3">

          
            <strong class="font-weight-bold d-flex justify-content-center">Customer</strong>
          
       
          <div class="md-form mb-4 d-flex justify-content-center">
                  <img src="c_uploads/grey.jpg" id="profile-img-tag" style="display:hidden" class="rounded-circle imgsize" width="100px" height="100px" border-radius="50%"/>
              </div>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                 <div class="custom-file">
                    <input type="file" class="custom-file-input" id="profile-img"
                    aria-describedby="inputGroupFileAddon01" name="profile_img">
                    <label class="custom-file-label" for="profile-img">Choose profile picture</label>
                  </div>
              </div>
              
              <div class="md-form mb-4">
                  <input type="text" id="orangeForm-fullname" class="form-control validate" name="fullname" required>
                  <label data-error="wrong" data-success="right" for="orangeForm-fullname">Full Name</label>
              </div>

            <div class="md-form mb-4">
              <input type="text" id="orangeForm-username" class="form-control validate" name="username" required>
              <label data-error="wrong" data-success="right" for="orangeForm-name">Username</label>
            </div>

            <div class="md-form mb-4">
                <input type="text" id="orangeForm-icnum" class="form-control validate" name="icnum" required>
                <label data-error="wrong" data-success="right" for="orangeForm-icnum">IC Number</label>
              </div>

            <div class="md-form mb-4">
                <input type="password" id="orangeForm-pass" class="form-control validate" name="password" required>
                <label data-error="wrong" data-success="right" for="orangeForm-pass">Password</label>
            </div>

            <div class="md-form mb-4">
                <input type="number" id="orangeForm-phone" class="form-control validate" name="phone" required>
                <label data-error="wrong" data-success="right" for="orangeForm-pass">Phone no</label>
            </div>

            <div class="md-form mb-4">
                <input type="email" id="orangeForm-gmail" class="form-control validate" name="gmail" required>
                <label data-error="wrong" data-success="right" for="orangeForm-gmail">Gmail</label>
            </div>


          <!-- Body -->
          </div>
          
          <div class="modal-footer d-flex justify-content-center">
            <button class="btn dusty-grass-gradient btn_login" name="c_signup">SIGN UP</button>
          </div>
<!-- form -->
</form>
        </div>
        <!--/.Panel 7-->



        <!--Panel 8-->
        <div class="tab-pane fade" id="panel8" role="tabpanel">

<!-- form -->
<form action="" method="post" enctype="multipart/form-data">

          <!--Body-->
          <div class="modal-body mx-3">

              <strong class="font-weight-bold d-flex justify-content-center">Farmer</strong>

              <div class="md-form mb-4 d-flex justify-content-center">
                  <img src="f_uploads/grey.jpg" id="profile-img-tag2"  style="display:hidden" class="rounded-circle" width="100px" height="100px" border-radius="50%"/>
              </div>
  
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                 <div class="custom-file">
                    <input type="file" class="custom-file-input" id="profile-img2"
                    aria-describedby="inputGroupFileAddon01" name="profile_img">
                    <label class="custom-file-label" for="profile-img2">Choose profile picture</label>
                  </div>
              </div>

              <div class="md-form mb-4">
                  <input type="text" id="orangeForm-fullname" class="form-control validate" name="fullname" required>
                  <label data-error="wrong" data-success="right" for="orangeForm-fullname">Full Name</label>
              </div>

            <div class="md-form mb-4">
              <input type="text" id="orangeForm-username" class="form-control validate" name="username" required>
              <label data-error="wrong" data-success="right" for="orangeForm-name">Username</label>
            </div>

            <div class="md-form mb-4">
                <input type="text" id="orangeForm-icnum" class="form-control validate" name="icnum" required>
                <label data-error="wrong" data-success="right" for="orangeForm-icnum">IC Number</label>
              </div>

            <div class="md-form mb-4">
                <input type="password" id="orangeForm-pass" class="form-control validate" name="password" required>
                <label data-error="wrong" data-success="right" for="orangeForm-pass">Password</label>
            </div>

            <div class="md-form mb-4">
                <input type="number" id="orangeForm-phone" class="form-control validate" name="phone" required>
                <label data-error="wrong" data-success="right" for="orangeForm-pass">Phone no</label>
            </div>

            <div class="md-form mb-4">
                <input type="email" id="orangeForm-gmail" class="form-control validate" name="gmail" required>
                <label data-error="wrong" data-success="right" for="orangeForm-gmail">Gmail</label>
            </div>

            <div class="md-form mb-4">
                <input type="text" id="orangeForm-shopname" class="form-control validate" name="shopname" required>
                <label data-error="wrong" data-success="right" for="orangeForm-shopname">Shop Name</label>
            </div>

            <div class="md-form mb-4">
                <input type="text" id="orangeForm-shopaddress" class="form-control validate" name="shopaddress" required>
                <label data-error="wrong" data-success="right" for="orangeForm-shopaddress">Shop Address</label>
            </div>
          

          <!-- modal-body -->
          </div>

          <div class="modal-footer d-flex justify-content-center">
            <button class="btn dusty-grass-gradient btn_login" name="f_signup">SIGN UP</button>
          </div>
<!-- form -->
</form>

        <!--/.Panel 8-->
        </div>
        
      <!-- tab-content -->
      </div>
  
    

      <p class="font-small grey-text d-flex justify-content-center">Already a member?<a href="login.php" class="text-success ml-1">
        Login</a></p>


    <!-- modal-content -->
    </div>
  <!-- modal-dialog -->
  </div>
<!-- modal fade -->
<!-- </div> -->


<!-- <div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalRegisterForm">Launch
    Modal Register Form</a>
</div> -->

  <!-- Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
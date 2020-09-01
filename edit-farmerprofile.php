<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
        $pid=$_SESSION['userpid'];
        $filesName="";
        if (isset($_POST['update']))
        {  
            if($_FILES["profile_img"]['name']!="")
            {
                $img=$_FILES['profile_img']['tmp_name'];
                $path= "Upload/profilePic/" . $_FILES["profile_img"]["name"];
                $filesName = $_FILES["profile_img"]["name"];
            }
            else
            {
                $sql = "SELECT picture FROM farmer WHERE pid = '$pid'";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
            
                if($query->rowCount() > 0)
                { 
                    foreach($results as $result)
                    {
                        if ($result->picture != "")
                        {
                            $filesName = $result->picture;
                        }   
                    }
                }
            }
        
            $fullname=$_POST['fullname'];
            $username=$_POST['username'];
            $address=$_POST['address'];
            $phone=$_POST['phone'];
            $gmail=$_POST['gmail'];
            $shopname=$_POST['shopname'];
            $shopaddress=$_POST['shopaddress'];

            $sql="UPDATE farmer set picture=:filesName,FullName=:fullname,UserName=:username,adress=:address,PhoneNumber=:phone,gmail=:gmail,shopName=:shopname,shopAddress=:shopaddress where pid='$pid'";
            $query = $dbh->prepare($sql);
            $query->bindParam(':filesName',$filesName,PDO::PARAM_STR);
            $query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
            $query->bindParam(':username',$username,PDO::PARAM_STR);
            $query->bindParam(':address',$address,PDO::PARAM_STR);
            $query->bindParam(':phone',$phone,PDO::PARAM_STR);
            $query->bindParam(':gmail',$gmail,PDO::PARAM_STR);
            $query->bindParam(':shopname',$shopname,PDO::PARAM_STR);
            $query->bindParam(':shopaddress',$shopaddress,PDO::PARAM_STR);
            $query->execute();

            if($query){
                if ($_FILES["profile_img"]["error"] > 0){
                    ?>
                    <?php
                     "Return Code: " . $_FILES["file"]["error"] . "<br/>";
                }
                else{
                    if (file_exists($path)){
                        //echo $path." already exist";
                        ?>
                        <script>
                             //alert("add image successul");
                             //window.location.href=('index.php');
                        </script>
                        <?php
                    }
                    else{
                         move_uploaded_file($img,$path);
                    }   
                }
            }

            $msg="Info updated successfully!";
        }

        if (isset($_POST['changePassword']))
        {
            $currentpass=md5($_POST['current']);
            $newpass = md5($_POST['new']);
            $checknew = md5($_POST['checknew']);

            $sql="SELECT Password,pid FROM farmer WHERE pid='$pid'";
            $query= $dbh -> prepare($sql);
            $query-> execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);

            if($query->rowCount() > 0)
            {
                foreach($results as $result)
                { 
                    if ($currentpass == $result->Password){
                        if ($newpass == $checknew ){
                            $sql = "UPDATE farmer SET Password=:newpassword WHERE pid = '$pid'";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':newpassword',$newpass,PDO::PARAM_STR);
                            $query-> execute();

                            if ($query){
                                $msg = "Info updated successfully!";
                            }
                        }else{
                            $error =  "Invalid Password!";
                        }
                    }else{
                        $error =  "Invalid Password!";
                    }
                }
            }  
        }


        
        if (isset($_POST['removeimg']))
        {  
            //$profileimg = $_POST['profileimg'];

            $check = "SELECT picture FROM farmer WHERE pid = '$pid'";
            $checkquery = $dbh->prepare($check);
            $checkquery-> execute();
            $checkresults=$checkquery->fetchAll(PDO::FETCH_OBJ);
            
            if($checkquery->rowCount() > 0)
            {
                foreach($checkresults as $result)
                {
                    $sql = "UPDATE farmer SET picture = '' ";  
                    $query= $dbh -> prepare($sql);
                    $query-> execute(); 

                }
            }

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
  <style>
  .btnchange{
      padding:25px 60px;
  }

  </style>
</head>

<body>

  <!-- Start your project here-->
<?php if($msg){?>
<div class="container">
    <div class="alert alert-warning" role="alert">
        <span><i class="fas fa-check"></i> </span>
        <strong> <?php echo htmlentities($msg); ?></strong>
    </div>
</div><?php } 
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="card mt-3">
            <div class="card-header">
                <h5><strong>1. My Profile</strong></h5>
            </div>
            <div class="card-body">
                <div class="modal-body mx-2">
                    <div class="form-row">
                        <div class="col-md-10">
                            <div class="md-form mb-4">
<?php 
$sql = "SELECT picture FROM farmer WHERE pid = '$pid'";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{ 
foreach($results as $result){

    if ($result->picture != ""){
      
        ?>
  
                                <img src="Upload/profilePic/<?php echo htmlentities($result->picture)?>" name="profileimg" id="profile-img-tag" style="display:hidden" class="rounded-circle imgsize" width="150px" height="150px" border-radius="50%" />
<?php }
    else{
        ?>                      
                                <img src="Upload/profilePic/grey.jpg"  id="profile-img-tag" style="display:hidden" class="rounded-circle imgsize" width="150px" height="150px" border-radius="50%"/>
<?php }
}}
?>
<!-- <label class="custom-file-label" for="profile-img">Choose profile picture</label> -->
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-form mb-4">
                            <a href="" class="btn btn-success btnchange" >
                              <input type="file" class="custom-file-input" id="profile-img"
                                aria-describedby="inputGroupFileAddon01" name="profile_img" hidden>
                                <label class="text-white" for="profile-img" style="margin-left:25%">
                                Change
                                </label>
                                </a>
                                <button class="btn btn-danger" name="removeimg">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="form-row mb-4">
                    <div class="col">
                        <div class="modal-body mx-2">
<?php
$sql = "SELECT * FROM farmer WHERE pid = '$pid'";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
?>
                            <label for="formGroupExampleInput">Full Name</label>
                            <input type="text" class="form-control" value="<?php echo htmlentities($result->FullName)?>" name="fullname">
                        </div>

                        <div class="modal-body mx-2">
                            <label for="formGroupExampleInput">User Name</label>
                            <input type="text" class="form-control" value="<?php echo htmlentities($result->UserName)?>" name="username">
                        </div>

                        <div class="modal-body mx-2">
                            <label for="formGroupExampleInput">IC Number</label>
                            <input type="number" class="form-control" value="<?php echo htmlentities($result->ICNumber)?>" name="ICNumber">
                        </div>

                        <div class="modal-body mx-2">
                            <label for="formGroupExampleInput">Address</label>
                            <input type="text" class="form-control" value="<?php echo htmlentities($result->adress)?>" name="address">
                        </div>
                    </div>

                    <div class="col">
                        <div class="modal-body mx-2">
                            <label for="formGroupExampleInput">Phone Number</label>
                            <input type="number" class="form-control" value="<?php echo htmlentities($result->PhoneNumber)?>" name="phone">
                        </div>

                        <div class="modal-body mx-2">
                            <label for="formGroupExampleInput">Gamil</label>
                            <input type="email" class="form-control" value="<?php echo htmlentities($result->gmail)?>" name="gmail">
                        </div>

                        <div class="modal-body mx-2">
                            <label for="formGroupExampleInput">Shop Name</label>
                            <input type="text" class="form-control" value="<?php echo htmlentities($result->shopName)?>" name="shopname">
                        </div>

                        <div class="modal-body mx-2">
                            <label for="formGroupExampleInput">Shop Address</label>
                            <input type="text" class="form-control" value="<?php echo htmlentities($result->shopAddress)?>" name="shopaddress">
                        </div>
                    </div>
                </div>
                    <button class="btn btn-success mx-4" name="update">Update</button>
                
            </div>
        <!-- card -->
        </div>
</form>
<form action="" method="post">
        <div class="card mt-4">
            <div class="card-header">
                <h5><strong>2. Change Password</strong></h5>
            </div>
            
            <div class="card-body">
                <div class="modal-body mx-2">
<?php if($error){?>
    <div class="alert alert-danger" role="alert">
    <span><i class="fas fa-exclamation"></i> </span>
        <strong><?php echo htmlentities($error); ?></strong>
    </div>
<?php } ?>
                    <label for="formGroupExampleInput">Current Password</label>
                    <input type="password" class="form-control" name="current" required>
                </div>

                <div class="modal-body mx-2">
                    <label for="formGroupExampleInput">New Password</label>
                    <input type="password" class="form-control" name="new" required>
                </div>

                <div class="modal-body mx-2">
                    <label for="formGroupExampleInput">Confrim Password</label>
                    <input type="password" class="form-control" name="checknew" required>
                </div>

                <button class="btn btn-success mx-4" name="changePassword">Change</button>
            </div>
        <!-- card -->
        </div>
        </form>
    <!-- container -->
    </div>



<?php 
}}
?>
  <?php include("includes/footer.php")?>

  <!-- Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="js/style.js"></script>


<script>
$("#profile-img").click(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
});
</script>

</body>

</html>
<?php
    include('include/config.php');
    if(isset($_POST['submit'])){
        $files = $_FILES["images"]["tmp_name"];
        $path =  "upload/" . $_FILES["images"]["name"];
        $filesName = $_FILES["images"]["name"];

        $sql = "INSERT INTO imaging values (6,'$filesName')";
        $query=$dbh->prepare($sql);
        $query->execute();
        if($query){
            if ($_FILES["images"]["error"] > 0)
            {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            }
            else{
                if(file_exists($path)){
                    echo $path."already exist";
                }
                else{
                    move_uploaded_file($files,$path);
                    echo "Stored in: ".$path;
                }
            }    
            }
        else{
            echo "gg";
        }
        
        }
       
      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="tryingFileUpload.php" method="post" enctype="multipart/form-data">
        <input type="text" name="name">
        <input type="file" name="images">
        <input type="submit" name="submit">
        <label for="" value="die"></label>

        <img src="upload/kato.jpg" alt="">
    </form>
</body>
</html>
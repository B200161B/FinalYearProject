<?php

session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{

      ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>
        <link rel="icon" href="icon.png">
</head>
<body>

<?php include('leftbar.php');  
      include('headerForAdmin.php');
?>

<div style="width:79%;margin-left:21%">
<h1>Dashboard</h1>
    <div><a href="dashboard.php"><span>Home</span></a></div>

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Customer View"
	},
	axisY:{
		includeZero: false
	},
	data: [{        
		type: "line",       
		dataPoints: [
            <?php 
                $sql = "SELECT * from "
                ?>
			{ y: 450 },
			{ y: 414},
			{ y: 520},
			{ y: 460 },
			{ y: 450 },
			{ y: 500 },
			{ y: 480 },
			{ y: 480 },
			{ y: 410 },
			{ y: 500 },
			{ y: 480 },
			{ y: 510 }
		]
	}]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>

    </div>
    <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
    <script>
     $('#example').DataTable();
    </script>
</body>
</html>
	<?php } ?>
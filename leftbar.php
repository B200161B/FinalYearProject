<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Leftbar</title>
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="icon" href="icon.png">
        <style>
        #panel{
            display:none;
        }
        #table {
            background-color:black;
            opacity:0.8;
        }
        #table div,#table a{
            padding:10px;
            color:white;
            font-size:17px;

        }
    
        </style>
        <script>
        $(document).ready(function(){
            $("#user").click(function(){
                $("#panel").slideToggle("slow");
            });
        });

    
        </script>
    </head>
    <body>
    <div id ="table" style="width:20%;height:92vh;position: absolute;margin-top:52px;">

        <div>
        <a href="dashboard.php"> Dashboard</a>
        </div>

        
        <div id="user">
        <a href="#"><span>User</span> 
        <i class="fa fa-angle-down arrow" style="margin-right:0"></i></a>
        
        <div id="panel">
        <div><a href="view-customer.php"><span>Customer</span></a></div>
        <div><a href="view-farmer.php">Farmer</a></div>
        <div><a href="view-logistic.php">Logistic</a></div>
        <div><a href="verify-farmer.php"><span>Verify Farmer</span></a></div>
        </div>
        </div>
        <!--user -->

        <div id="comment">
        <a href="comment.php"><span> Comment</span>
        </a>
        </div>
        <!--comment -->

        <div>
        <a href="view-payment.php"><span>Payment</span>
    </a>
        </div>
        <!--order -->
        <div>
        <a href="product.php"><span>Product</span></a>
        </div>
        
        <div>
        <a href="register-logistic.php"><span>Register for logistic </span></a>
        </div>
        <!-- logistic -->

        <div>
        <a href="admin-change-password.php">Change password admin</a>
        </div>
        </div>

        
    </body>
    </html>
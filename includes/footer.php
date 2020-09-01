<footer>
    <nav class="navbar fixed-bottom navbar-expand-sm navbar-light green lighten-3 ">
       <a href="MainPage.php"> <i class="fab fa-vuejs fa-lg"></i></a>
        <?php 
        $pid=$_SESSION['userpid'];
        if (strpos($pid, 'F') !== false){
            ?>
        <a href="addProduct.php"><i class="fas fa-plus-circle fa-lg"></i></a>
       <?php  }
        ?>
       
        <a href="cartGUI.php"><i class="fas fa-shopping-cart fa-lg"></i></a>
       <a href="profile.php"> <i class="fas fa-user fa-lg" ></i></a>
      
        
      
      </nav>
</footer>
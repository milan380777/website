<!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
  <style type="text/css">
    :root {
        --purple: #735DA5; /* Updated main color */
        --red: #c0392b;
        --orange: #f39c12;
        --black: #333;
        --white: #fff;
        --light-color: #666;
        --light-white: #ccc;
        --light-bg: #f5f5f5;
        --border: .1rem solid var(--black);
        --box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
    }
</style>
<div class="header">
<header class="header">
   <div class="flex">
      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>
<nav class="navbar">
    <a href="admin_page.php">home</a>
    <div class="services">
        <a href="#">services</a>
        <div class="submenu">
            <a href="admin_products.php">products</a>
            <a href="admin_treks.php">treks</a>
            <a href="admin_expeditions.php">expeditions</a>
        </div>
    </div>
    <a href="admin_orders.php">orders</a>
    <a href="admin_users.php">users</a>
    <a href="admin_contacts.php">messages</a>
</nav>
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>
      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>new <a href="login.php">login</a> | <a href="login.php">register</a></div>
      </div>
   </div>
</header>
</div>
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
<head>
   <style type="text/css">
    body {
   margin: 0;
   padding: 0;
   font-family: 'Arial', sans-serif;
   background-color: white; /* Adjust background color as needed */
}
.message {
   background-color: #4CAF50; /* Green background color */
   color: #fff; /* White text color */
   padding: 15px;
   margin-bottom: 15px;
   display: flex;
   justify-content: space-between;
   align-items: center;
}
.message span {
   margin-right: 10px;
}
.message i {
   cursor: pointer;
}
.header {
   background-color: white; /* Dark background color for the header */
   background: url('images/mm.png') ;
    background-size: 100% 100%;  
   color: #fff; /* White text color */
   padding: 10px 0;
}
.header-1,
.header-2 {
   width: 100%;
   max-width: 1200px;
   margin: 0 auto;
}
.flex {
   display: flex;
   justify-content: space-between;
   align-items: center;
}
.share a {
   color: #fff; /* White color for social media icons */
   text-decoration: none;
   margin-right: 10px;
}
p {
   margin: 0;
   color: #fff; /* White text color for the paragraph */
}
a {
   color: #fff; /* White color for links */
   text-decoration: none;
   margin-right: 15px;
}
a:hover {
   text-decoration: underline;
}
.logo {
   font-size: 1.5rem;
   font-weight: bold;
   color: #fff; /* White color for the logo */
   text-decoration: none;
}
.navbar {
   display: flex;
   list-style: none;
   margin: 0;
   padding: 0;
}
.navbar a {
   color: #fff; /* White color for navigation links */
   text-decoration: none;
   margin-right: 15px;
}
.icons {
   display: flex;
   align-items: center;
}
.icons i {
   margin-right: 15px;
   cursor: pointer;
}
.user-box {
   position: absolute;
   top: 50px;
   right: 20px;
   background-color: #333; /* Dark background color for user box */
   color: #fff; /* White text color for user box */
   padding: 10px;
   border-radius: 5px;
   display: none;
}
.user-box p {
   margin: 0;
   margin-bottom: 10px;
}
.user-box span {
   font-weight: bold;
}
.delete-btn {
   background-color: #e74c3c; /* Red background color for logout button */
   color: #fff; /* White text color for logout button */
   padding: 8px 15px;
   text-decoration: none;
   border-radius: 3px;
   display: inline-block;
}
.delete-btn:hover {
   background-color: #c0392b; /* Darker red color on hover */
}
   </style>
</head>
<header class="header">
   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="https://www.facebook.com/profile.php?id=100036482574362" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com/milan_meow123/" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <p> new <a href="login.php">login</a> | <a href="register.php">register</a> </p>
      </div>
   </div>
   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">Mountain Mavericks</a>
<nav class="navbar">
    <a href="index.php">home</a>
    <a href="about.php">about</a>
    <div class="dropdown">
        <a href="#" class="dropbtn">services</a>
        <div class="dropdown-content">
            <a href="shop.php">shop</a>
            <a href="trecks.php">treks</a>
            <a href="expedition.php">expeditions</a>
        </div>
    </div>
    <a href="contact.php">contact</a>
    <a href="orders.php">orders</a>
</nav>
<style type="text/css">
   /* Dropdown container */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown button */
.dropdown .dropbtn {
    font-size: 16px;  
    border: none;
    outline: none;
    color: white;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #f1f1f1;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
   
}
</style>
         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>
         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
      </div>
   </div>
</header>
<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">



</head>
<body>



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
   
<section class="forms-section">
   <h1 class="section-title">Signup Form</h1>
   <div class="forms">
      <div class="form-wrapper">
         <button type="button" class="switcher switcher-signup">
            Sign Up
            <span class="underline"></span>
         </button>
         <form class="form form-signup" action="signup_process.php" method="post">
            <fieldset>
               <legend>Please, enter your email, password, and password confirmation for sign up.</legend>
               <div class="input-block">
                  <label for="signup-username">Username</label>
                  <input id="signup-username" name="name" type="text" required>
               </div>
               <div class="input-block">
                  <label for="signup-email">E-mail</label>
                  <input id="signup-email" name="email" type="email" required>
               </div>
               <div class="input-block">
                  <label for="signup-password">Password</label>
                  <input id="signup-password" name="password" type="password" required>
               </div>
            </fieldset>
            <button type="submit" class="btn-signup" name="submit">Sign Up</button>
         </form>
      </div>
   </div>
</section>
<script src="js/use.js"></script>

</body>
</html>


<style type="text/css">
   /* styles.css */

/* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.message {
    background-color: #f44336;
    color: white;
    padding: 10px 20px;
    margin: 10px auto;
    width: fit-content;
    border-radius: 5px;
    display: flex;
    align-items: center;
}

.message span {
    margin-right: 10px;
}

.message i {
    cursor: pointer;
}

.forms-section {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.section-title {
    text-align: center;
    margin-bottom: 30px;
}

.forms {
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-wrapper {
    width: 400px;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.switcher {
    background-color: transparent;
    border: none;
    cursor: pointer;
    display: block;
    width: 100%;
    text-align: center;
    font-size: 18px;
    margin-bottom: 20px;
    position: relative;
}

.switcher:focus {
    outline: none;
}

.switcher span.underline {
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 2px;
    background-color: #3498db;
    transition: width 0.3s ease;
}

.switcher:hover span.underline,
.switcher.active span.underline {
    width: 100%;
}

/* Form Styles */
.form fieldset {
    border: none;
    padding: 0;
    margin: 0;
}

.input-block {
    margin-bottom: 20px;
}

.input-block label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.input-block input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn-signup {
    width: 100%;
    background-color: #3498db;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-signup:hover {
    background-color: #2980b9;
}

</style>
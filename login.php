<?php
include 'config.php';
session_start();
if (isset($_POST['login_submit'])) {
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   if(mysqli_num_rows($select_users) > 0){
      $row = mysqli_fetch_assoc($select_users);
      if($row['user_type'] == 'admin'){
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');
      }elseif($row['user_type'] == 'user'){
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:index.php');
      }
   }else{
      $message[] = 'incorrect email or password!';
   }
}
if (isset($_POST['signup_submit'])) {
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
   <title>Login & Signup</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
   <style type="text/css">
     body{
         background: url('images/bg.jpg') center/cover; /* Background image */
      }
      .form-login {
         background: #ffeaa7 !important;
      }
      .form-signup {
         background: #fdcb6e !important;
      }
   </style>
   <style>
      .forms-section,
      .form,
      .btn-login,
      .btn-signup {
          color: black !important;
      }
      .switcher switcher-login{
         color: black;
      }
      .switcher switcher-signup{
         color: black;
      }
   </style>
</head>
<body>

<?php
if (isset($message)) {
   foreach ($message as $message) {
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
   <h1 class="section-title">Login & Signup Forms
      <style type="text/css">
         .section-title{
            color: #001F3F;
         }
      </style>
</h1>
   <div class="forms">
      <div class="form-wrapper is-active">
         <button type="button" class="switcher switcher-login">
            Login
           
            <span class="underline"></span>
         </button>
         <form class="form form-login" action="" method="post">
            <fieldset>
               <legend>Please, enter your email and password for login.</legend>
               <div class="input-block">
                  <label for="login-email">E-mail</label>
                  <input id="login-email" name="email" type="email" required>
               </div>
               <div class="input-block">
                  <label for="login-password">Password</label>
                  <input id="login-password" name="password" type="password" required>
               </div>
            </fieldset>
            <button type="submit" class="btn-login" name="login_submit">Login
               <style>.btn-login{
         color: black;
      }</style></button>
         </form>
      </div>
      <div class="form-wrapper">
         <button type="button" class="switcher switcher-signup">
            Sign Up
            <span class="underline"></span>
         </button>
         <form class="form form-signup" action="" method="post">
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
      <div class="input-block">
         <label for="signup-cpassword">Confirm Password</label>
         <input id="signup-cpassword" name="cpassword" type="password" required>
      </div>
      <div class="input-block">
         <label for="user-type">User Type</label>
         <select id="user-type" name="user_type" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
         </select>
      </div>
   </fieldset>
   <button type="submit" class="btn-signup" name="signup_submit">Sign Up</button>
</form>
      </div>
   </div>
</section>

<script src="js/use.js"></script>
<style type="text/css">
   body {
    background: url('images/bg.jpg') center/cover;
}
.forms-section,
.form,
.btn-login,
.btn-signup {
    color: black !important;
}
.switcher switcher-login{
   color: black;
}
.switcher switcher-signup{
   color: black;
}
.form {
    background: white; !important;
}</style>
</body>
</html>
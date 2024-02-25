<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
}
if(isset($_POST['send'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);
   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');
   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'message sent already!';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'message sent successfully!';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
<style type="text/css">
      *{
         padding: 0;
         margin: 0;
         box-sizing: border-box;
      }
     body {
   width: 100%;
   height: 100vh;
   background-color: #fcba03;
}
.container{
         position: relative;
         width: 100%;
         height: 100%;
         display: flex;
         justify-content: space-around;
         align-items: center;
         flex-wrap: wrap;
      }
      .contact-box{
         max-width: 860px;
         display: grid;
         grid-gap: 10px;
         grid-template-columns: repeat(2, 1fr);
         justify-content: center;
         align-items: center;
         text-align: center;
         background-color: #fff;
         box-shadow: 0px 0px 18px 5px rgba(0, 0, 0, 0.19);
      }
      .left iframe{
         padding: 10px 10px;
         width: 100%;
         height: 470px;
      }
      .right{
         padding: 25px 40px;
      }
      h2{
         position: relative;
         padding: 0 0 10px;
         margin-bottom: 10px;
      }
      h2:after{
         content: "";
         position: absolute;
         left: 50%;
         bottom: 0;
         transform: translateX(-50%);
         height: 4px;
         width: 50px;
         border-radius: 2px;
         background-color: orange;
      }
      .field{
         width: 100%;
         border: 2px solid rgba(0, 0, 0, 0);
         outline: none;
         background-color: rgba(230, 230, 230, 0.6);
         padding: .5rem 1rem;
         margin-bottom: 22px;
         transition: .3s;
      }
      .field:hover{
         background-color: rgba(0, 0, 0, 0.1);
      }
      textarea{
         min-height: 150px;
      }
      .btn{
         width: 100%;
         padding: .5rem 1rem;
         background: orange;
         color: #fff;
         font-size: 1.1rem;
         border: none;
         outline: none;
         cursor: pointer;
         transition: .3s;
      }
      .btn:hover{
         background: #27ae60;
      }
      .field:focus{
         border: 2px solid rgba(30, 85, 250, 0.7);
         background: #fff;
      }
      @media screen and (max-width:769px){
         .contact-box{
            grid-template-columns: 1fr;
         }
         .left iframe{
            padding: 0;
         }
      }
   </style>
</head>
<body>
<?php include 'header.php'; ?>
<div class="heading">
   <h3>contact us</h3>
   <p> <a href="home.php">home</a> / contact </p>
</div>
<section class="contact">
   <div class="container">
      <div class="contact-box">
         <div class="left">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4261.914017038054!2d85.322514491156!3d27.703466653547068!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19a7c6cd102b%3A0x78049640e89dd5ca!2sTrinity%20Int&#39;l%20College!5e0!3m2!1sen!2snp!4v1706957647823!5m2!1sen!2snp" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         </div>
         <div class="right">
            <h2>Contact Us</h2>
            <?php
            if (isset($message)) {
               foreach ($message as $msg) {
                  echo '<p style="color: green;">' . $msg . '</p>';
               }
            }
            ?>
            <form action="" method="post">
               <input type="text" name="name" required placeholder="Enter your name" class="field">
               <input type="email" name="email" required placeholder="Enter your email" class="field">
               <input type="text" name="number" required placeholder="Enter your number" class="field">
               <textarea name="message" class="field" placeholder="Enter your message" id="" cols="30" rows="10"></textarea>
               <input type="submit" value="Send Message" name="send" class="btn">
            </form>
         </div>
      </div>
   </div>
</section>
<?php include 'footer.php'; ?>
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
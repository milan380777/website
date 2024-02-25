<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">


</head>
<body>


   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about.jpg" alt="">
      </div>

      <div class="content">
    <h3>Welcome to Mountain Mavericks</h3>
    <p>At Mountain Mavericks, we don't just offer trips; we create mountain adventures that linger in your memory like a breathtaking view. Our passion for the mountains and commitment to personalized service define who we are.</p>

    <h3>Our Mission:</h3>
    <p>Mountain Mavericks is more than a travel agency; it's an ode to the majestic peaks. Our mission is to curate mountain experiences that ignite the spirit of adventure, blending adrenaline-pumping activities with the tranquility of nature.</p>

    <h3>Why Choose Mountain Mavericks:</h3>
    <ol>
        <li><strong>Alpine Expertise:</strong> Our team comprises seasoned mountain enthusiasts who understand the alpine terrain like the back of their hands.</li>
        <li><strong>Tailored Adventures:</strong> Your mountain journey is as unique as you are. We specialize in crafting bespoke adventures, ensuring every moment aligns with your thrill-seeking spirit.</li>
        <li><strong>Exclusive Mountain Retreats:</strong> With access to exclusive mountain retreats, we bring you closer to the heart of the alps, offering a blend of luxury and rugged beauty.</li>
        <li><strong>Passion-Driven Service:</strong> We don't just plan trips; we share our passion for the mountains with you. Expect a customer-centric approach and a genuine desire to make your adventure exceptional.</li>
    </ol>
    <style type="text/css">
      ol {
    list-style-type: decimal;
    margin: 15px 0;
    padding-left: 20px;
}

ol li {
    font-size: 1.7rem;
    color:var(--light-color); /* You can use your preferred color here */
    margin-bottom: 8px;
}

ol li strong {
    color: #800080; /* You can use your preferred color here */
    font-weight: bold;
    margin-right: 5px;
}


    </style>

    <h3>Our Promise:</h3>
    <p>Mountain Mavericks is your gateway to unparalleled mountain experiences. Whether you're conquering peaks, carving down slopes, or simply absorbing the serene mountain air, we promise memories that last a lifetime.</p>

    <h3>Connect With Mountain Mavericks:</h3>
    <p>Ready to elevate your adventure? Reach out to us at <a href="mailto:infoaboutmountainmavericks@gmail.com"><style> a{
    color: blue}
 </style>
infoaboutmountainmavericks@gmail.com</a> and let the mountain escapades begin. Your next alpine journey awaits!</p>

    <a href="contact.php" class="btn">Contact Us</a>


   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>お世話になりました！素晴らしいサービスでした。また利用したいと思います。</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>田中 太郎 (Taro Tanaka)</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>旅行中に予期せぬ冒険がありましたが、スタッフのサポートが素晴らしく、安心して楽しむことができました。</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>山田 花子 (Hanako Yamada)</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>素晴らしい旅行体験でした！サービスがとても良く、観光地での案内も分かりやすかったです。</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>佐藤 一郎 (Ichiro Sato)</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>親切な対応と美しい景色に感動しました。これからもこちらのサービスを利用していきたいです。</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>鈴木 久美 (Kumi Suzuki)</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>感謝の気持ちでいっぱいです。最高の旅行体験を提供していただき、本当にありがとうございました。</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>中村 美咲 (Misaki Nakamura)</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>素晴らしい旅行体験でした。次回も是非利用させていただきたいです。</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>小林 太一 (Taichi Kobayashi)</h3>

      </div>

   </div>

</section>




<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="js/translate.js"></script>

</body>
</html>
<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
}
if(isset($_POST['add_to_cart'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Choose a meaningful title for your website -->
    <title>Travel Website</title>
    <!-- Font Awesome CDN (Choose the version you prefer) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<body>
<?php include 'header.php'; ?>
<!-- Home Section Start -->
    <div class="home1">
        <div class="content">
            <h5>Welcome To Nepal</h5>
            <h1>Visit <span class="changecontent"></span></h1>
            <p>"Explore the Heart of the Himalayas: Unveiling Nepal's Beauty, One Journey at a Time!"</p>
            <a href="#book">Book Place</a>
        </div>
    </div>
    <!-- Home Section End -->
    /* Home Section Start */
    <style type="text/css">
.home1{
    width: 100%;
    height: 100vh;
    background-image: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.2)), url(./images/a1.jpg);
    background-repeat: no-repeat;
    background-size: cover;
}
.home1 .content{
    text-align: center;
    padding-top: 200px;
}
.home1 .content h5{
    color: white;
    font-size: 38px;
    font-weight: 550;
    text-shadow: 0px 1px 1px black;
}
.home1 .content h1{
    color: white;
    font-size: 70px;
    font-weight: 550;
    text-shadow: 0px 1px 1px black;
    margin-top: 5px;
}
.changecontent::after{
    content: ' ';
    color: #ffa500;
    text-shadow: 0px 1px 1px black;
    animation: changetext 10s infinite linear;
}
@keyframes changetext {
    0%{content: "Kathmandu";}
    10%{content: "Pokhara";}
    20%{content: "Lumbini";}
    30%{content: "Annapurna";}
    40%{content: "Everest Base Camp";}
    50%{content: "Chitwan National Park";}
    60%{content: "Mustang";}
    70%{content: "Rara Lake";}
    80%{content: "Langtang Valley";}
    90%{content: "Gosaikunda";}
    100%{content: "Manang";}
}
.home1 .content p{
    color: white;
    font-size: 15px;
    font-weight: 600;
    text-shadow: 0px 1px 1px black;
    margin-bottom: 30px;
    margin-top: 5px;
}
.home1 .content a{
    padding: 10px;
    background: white;
    color: black;
    letter-spacing: 2px;
    font-weight: 550;
    border-radius: 5px;
    text-decoration: none;
    transition: 0.5s;
}
.home1 .content a:hover{
    background: #ffa500;
    color: white;
}
@media (max-width:850px){
    .home1{
        background-position: 50%;
    }
}
@media (max-width:450px){
    .home1 .content h5{
        font-size: 25px;
    }
    .home1 .content h1{
        font-size: 38px;
    }
    .home1 .content p{
        font-size: 13px;
    }
}
</style>
/* Home Section End */
<section class="home">
   <div class="content">
      <h3>Tailored Journeys: Unrivaled Travel Experiences and Services Await You!</h3>
      <p>Embark on unforgettable adventures with our travel agency's curated services designed exclusively for you. From seamless itineraries to personalized accommodations, our team is dedicated to crafting journeys that exceed expectations. Discover the world with confidence, comfort, and unparalleled service – because your travel experience deserves nothing less.</p>
      <a href="about.php" class="white-btn">discover more</a>
   </div>
</section>
<section class="products">
   <h1 class="title">latest products</h1>
   <div class="box-container">
      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>
   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>
</section>
<!-- Section Services Start -->
    <section class="services" id="services">
    <div class="container">
        <div class="main-txt">
            <h1><span>S</span>ervices</h1>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-4 py-3 py-md-0">
                <div class="card">
                    <i class="fas fa-hotel"></i>
                    <div class="card-body">
                        <h3>Affordable Hotel</h3>
                        <p>Enjoy comfortable and affordable accommodation with our hotel services. We provide a relaxing and convenient stay for our guests, ensuring a memorable experience.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-3 py-md-0">
                <div class="card">
                    <i class="fas fa-utensils"></i>
                    <div class="card-body">
                        <h3>Food & Drinks</h3>
                        <p>Indulge in a delightful culinary experience with our food and drinks services. Our diverse menu caters to various tastes, offering a fusion of flavors to satisfy your appetite.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-3 py-md-0">
                <div class="card">
                    <i class="fas fa-bullhorn"></i>
                    <div class="card-body">
                        <h3>Safety Guide</h3>
                        <p>Travel confidently with our safety guides. Our experienced guides ensure your safety throughout your journey, providing assistance and valuable insights for a worry-free adventure.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-4 py-3 py-md-0">
                <div class="card">
                    <i class="fas fa-globe-asia"></i>
                    <div class="card-body">
                        <h3>Around The World</h3>
                        <p>Explore diverse cultures and landscapes with our "Around The World" service. We offer travel packages that take you on a global journey, providing enriching experiences and lasting memories.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-3 py-md-0">
                <div class="card">
                    <i class="fas fa-plane"></i>
                    <div class="card-body">
                        <h3>Fastest Travel</h3>
                        <p>Reach your destination swiftly with our fastest travel services. We prioritize efficiency and convenience, ensuring you have a seamless and time-saving travel experience.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-3 py-md-0">
                <div class="card">
                    <i class="fas fa-hiking"></i>
                    <div class="card-body">
                        <h3>Adventures</h3>
                        <p>Embark on thrilling adventures with our specialized adventure services. From hiking to extreme sports, we cater to adrenaline enthusiasts seeking excitement and challenges in breathtaking locations.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Section Services End -->
    <style type="text/css">
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    list-style: none;
    scroll-behavior: smooth;
    font-family: 'Lato', sans-serif;
}
/* Section Services Start */
.services{
    background: #f9f9f9;
    margin-top: 50px;
}
.services .card{
    box-shadow: rgba(0,0,0,0.1) 0px 4px 12px;
    border: none;
    cursor: pointer;
}
.services .card i{
    font-size: 80px;
    text-align: center;
    color: #ffa500;
    margin-top: 20px;
}
.services .card .card-body h3{
    font-weight: 600;
}
.services .card .card-body{
    text-align: center;
}
.services .card .card-body p {
    color: black; /* Change to an appropriate text color */
    font-size: 15px;
}
.services .card .card-body p {
    font-size: 16px; /* Adjust the font size as needed */
}
.services .card .card-body p {
    visibility: visible; /* Ensure visibility */
}
.services .card .card-body {
    min-height: 150px; /* Adjust the height as needed */
}
/* Section Services End */
/* Section Gallary Start */
.gallary{
    margin-top: 50px;
}
.gallary .card{
    border-radius: 10px;
    box-shadow: rgba(0,0,0,0.1) 0px 4px 12px;
    cursor: pointer;
}
.gallary .card img{
    border-radius: 10px;
    transition: 0.5s;
}
.gallary .card img:hover{
    transform: scale(1.1);
}
/* Section Gallary End */
</style>
<!-- Section Gallary Start -->
    <section class="gallary" id="gallary">
      <div class="container">
        <div class="main-txt">
          <h1><span>G</span>allary</h1>
        </div>
        <div class="row" style="margin-top: 30px;">
          <div class="col-md-4 py-3 py-md-0">
            <div class="card">
              <img src="./images/g1.jpg" alt="" height="230px">
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card">
              <img src="./images/g2.jpg" alt="" height="230px">
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card">
              <img src="./images/g3.jpg" alt="" height="230px">
            </div>
          </div>
        </div>
        <div class="row" style="margin-top: 30px;">
          <div class="col-md-4 py-3 py-md-0">
            <div class="card">
              <img src="./images/g4.jpg" alt="" height="230px">
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card">
              <img src="./images/g5.jpg" alt="" height="230px">
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card">
              <img src="./images/g6.jpg" alt="" height="230px">
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- Section Gallary End -->
 <!-- About Start -->
<section class="about" id="about">
  <div class="container">
    <div class="main-txt">
      <h1>About <span>Us</span></h1>
    </div>
    <div class="row" style="margin-top: 50px;">
      <div class="col-md-6 py-3 py-md-0">
        <div class="card">
          <img src="./images/k2fwa.jpg" alt="">
        </div>
      </div>
      <div class="col-md-6 py-3 py-md-0">
        <h2>How Our Travel Agency Works</h2>
        <p>At our travel agency, we strive to make your travel experience seamless and memorable. Our process is designed to cater to your unique needs, providing you with the best services and personalized itineraries. From the moment you reach out to us to the completion of your journey, here's how our travel agency works:</p>
        <ul>
          <li><strong>Consultation:</strong> We start by understanding your travel preferences, interests, and budget through a detailed consultation.</li>
          <li><strong>Customized Itinerary:</strong> Our expert team creates a customized itinerary tailored to your preferences, ensuring a unique and fulfilling travel experience.</li>
          <li><strong>Booking and Confirmation:</strong> Once you approve the itinerary, we handle all the bookings and confirmations, ensuring a hassle-free experience for you.</li>
          <li><strong>24/7 Support:</strong> Our dedicated support team is available 24/7 to assist you with any queries or concerns during your journey.</li>
        </ul>
        <p>Embark on a journey with us, and let us take care of the details so you can focus on creating unforgettable memories.</p>
        <a href="about.php" class="white-btn">Read more...</a>
      </div>
    </div>
  </div>
</section>
<!-- About End -->
<section class="home-contact">
  <div class="content">
    <h3>Have any questions?</h3>
    <p>If you have any questions or need assistance, feel free to reach out to us. We are here to help!</p>
    <a href="contact.php" class="white-btn">Contact Us</a>
  </div>
</section>
<style type="text/css">
    /* About Start */
.about {
  padding: 50px;
  margin-top: 50px;
  background: #f9f9f9;
  font-size: 17px;
  text-align: left; /* Updated to left-align */
}
.about .card {
  border-radius: 10px;
  overflow: hidden;
  margin-bottom: 20px;
}

.about .card img {
  width: 100%;
  height: auto;
  border-radius: 10px;
}

.about h2 {
  font-weight: 600;
  letter-spacing: 1px;
  color: #333;
}

.about p {
  font-weight: 500;
  color: #666;
  text-align: left; /* Added left-align for paragraphs */
}

.about a.white-btn {
  display: inline-block;
  padding: 10px 20px;
  background: #ffa500;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  margin-top: 15px;
  transition: background 0.3s ease-in-out;
}

.about a.white-btn:hover {
  background: #333;
}

@media (max-width: 765px) {
  .about {
    padding: 20px;
  }
}
/* Style for list items in the About section */
.about ul {
  list-style: none;
  padding: 0;
}

.about ul li {
  position: relative;
  padding-left: 30px;
  margin-bottom: 10px;
  text-align: left; /* Added left-align for list items */
}

.about ul li::before {
  content: '\2022'; /* Unicode character for a bullet point */
  position: absolute;
  left: 0;
  color: #ffa500; /* Bullet point color */
  font-size: 18px; /* Adjust the size as needed */
  line-height: 1; /* Ensures proper vertical alignment */
}

/* About End */
</style>
<?php include 'footer.php'; ?>
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
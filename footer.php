<head>
   <style type="text/css">
   body {
      margin: 0;
   }
   .footer {
      background-color: #f4f4f4; /* Light gray background */
      color: #333333; /* Dark text color */
      padding: 20px;
      text-align: center;
   }
   .box-container {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
   }
   .box {
      flex: 1;
      margin: 10px;
      color: #333333; /* Dark text color */
   }
   .box a {
      color: #333333; /* Dark text color */
      text-decoration: none;
   }
   .box a:hover {
      text-decoration: underline;
   }
   .credit {
      margin-top: 20px;
      color: #333333; /* Dark text color */
   }
   #google_translate_element {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 9999;
   }
</style>
</head>
<body>
   <section class="footer">
<div id="google_translate_element"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en'},
                'google_translate_element'
            );
        }
    </script>
    <script type="text/javascript"
            src=
"https://translate.google.com/translate_a/element.js?
cb=googleTranslateElementInit">
    </script>
   <div class="box-container">
      <div class="box">
         <h3>quick links</h3>
         <a href="home.php">home</a>
         <a href="about.php">about</a>
         <a href="shop.php">shop</a>
         <a href="contact.php">contact</a>
      </div>
      <div class="box">
         <h3>extra links</h3>
         <a href="login.php">login</a>
         <a href="register.php">register</a>
         <a href="cart.php">cart</a>
         <a href="orders.php">orders</a>
      </div>
      <div class="box">
         <h3>contact info</h3>
         <p> <i class="fas fa-phone"></i> 977-9846221198 </p>
         <p> <i class="fas fa-phone"></i> 977-9846221198 </p>
         <p> <i class="fas fa-envelope"></i> milanmagar259@gmail.com </p>
         <p> <i class="fas fa-map-marker-alt"></i> Kathmandu, Nepal </p>
      </div>
      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="https://www.instagram.com/milan_meow123/"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>
   </div>
   <p class="credit"> &copy; copyright  @ <?php echo date('Y'); ?> by <span>Milan Magar</span> </p>
</section>
</body>

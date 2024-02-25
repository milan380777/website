<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
}
if (isset($_POST['add_to_cart'])) {
    $expedition_name = $_POST['expedition_name'];
    $expedition_price = $_POST['expedition_price'];
    $expedition_image = $_POST['expedition_image'];
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$expedition_name' AND user_id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Already added to cart!';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image) VALUES('$user_id', '$expedition_name', '$expedition_price', '$expedition_image')") or die('query failed');
        $message[] = 'Expedition added to cart!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expedition Packages</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="heading">
    <h3>Our Expeditions</h3>
    <p><a href="home.php">Home</a> / Expeditions</p>
</div>
<section class="products">
    <h1 class="title">Latest Expeditions</h1>
    <div class="box-container">
        <?php
        $select_expeditions = mysqli_query($conn, "SELECT * FROM `expeditions`") or die('query failed');
        if (mysqli_num_rows($select_expeditions) > 0) {
            while ($fetch_expeditions = mysqli_fetch_assoc($select_expeditions)) {
                ?>
                <form action="" method="post" class="box">
                    <img class="image" src="uploaded_img/<?php echo $fetch_expeditions['image']; ?>" alt="">
                    <div class="name"><?php echo $fetch_expeditions['name']; ?></div>
                    <div class="price">$<?php echo $fetch_expeditions['price']; ?>/-</div>
                    <div class="days">Duration: <?php echo $fetch_expeditions['no_of_days']; ?> Days</div>
                    <div class="description"><?php echo $fetch_expeditions['description']; ?></div>
                    <input type="hidden" name="expedition_name" value="<?php echo $fetch_expeditions['name']; ?>">
                    <input type="hidden" name="expedition_price" value="<?php echo $fetch_expeditions['price']; ?>">
                    <input type="hidden" name="expedition_image" value="<?php echo $fetch_expeditions['image']; ?>">
                    <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
                </form>
                <?php
            }
        } else {
            echo '<p class="empty">No expeditions available yet!</p>';
        }
        ?>
    </div>
</section>
<?php include 'footer.php'; ?>
<!-- custom js file link  -->
<script src="js/script.js"></script>
<!-- Custom CSS -->
<style>
    /* CSS for Form Elements */
    .products .box {
        width: calc(50% - 10px); /* Adjust the width to fit two boxes in a row */
        margin: 0 5px 20px; /* Add margin to create space between boxes */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); /* Adding a box shadow for a better look */
    }
    .products .box-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        max-width: 1200px; /* Adjust the max-width as needed */
        margin: 0 auto; /* Center the boxes horizontally */
    }
    @media screen and (max-width: 768px) {
        .products .box {
            width: calc(100% - 10px); /* Adjust the width to occupy full width on smaller screens */
        }
    }
</style>
</body>
</html>

<?php
include 'config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
}
if (isset($_POST['add_expedition'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;
    $no_of_days = $_POST['no_of_days'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $select_expedition_name = mysqli_query($conn, "SELECT name FROM `expeditions` WHERE name = '$name'") or die('query failed');
    if (mysqli_num_rows($select_expedition_name) > 0) {
        $message[] = 'Expedition name already added';
    } else {
        $add_expedition_query = mysqli_query($conn, "INSERT INTO `expeditions`(name, price, image, no_of_days, description) VALUES('$name', '$price', '$image', '$no_of_days', '$description')") or die('query failed');
        if ($add_expedition_query) {
            if ($image_size > 2000000) {
                $message[] = 'Image size is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Expedition added successfully!';
            }
        } else {
            $message[] = 'Expedition could not be added!';
        }
    }
}
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `expeditions` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/' . $fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `expeditions` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_expedition.php');
}
if (isset($_POST['update_expedition'])) {
    $update_e_id = $_POST['update_e_id'];
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_price = $_POST['update_price'];
    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'uploaded_img/' . $update_image;
    $update_old_image = $_POST['update_old_image'];
    $update_no_of_days = $_POST['update_no_of_days'];
    $update_description = mysqli_real_escape_string($conn, $_POST['update_description']);
    mysqli_query($conn, "UPDATE `expeditions` SET name = '$update_name', price = '$update_price', no_of_days = '$update_no_of_days', description = '$update_description' WHERE id = '$update_e_id'") or die('query failed');
    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'Image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `expeditions` SET image = '$update_image' WHERE id = '$update_e_id'") or die('query failed');
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('uploaded_img/' . $update_old_image);
        }
    }
    header('location:admin_expedition.php');
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
   <link rel="stylesheet" href="css/admin_style.css">
    <style type="text/css">
        :root {
        --purple: #8e44ad;
        --red: #c0392b;
        --orange: #f39c12;
        --black: #333;
        --white: #fff;
        --light-color: #666;
        --light-white: #ccc;
        --light-bg: #f5f5f5;
        --border: .1rem solid var(--black);
        --box-shadow: 0 .5rem 1rem rgba(0, 191, 255, .5);
    }
    * {
        font-family: 'Rubik', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none;
        border: none;
        text-decoration: none;
        transition: all .2s linear;
    }
    *::selection {
        background-color: var(--purple);
        color: var(--white);
    }
    *::-webkit-scrollbar {
        height: .5rem;
        width: 1rem;
    }
    *::-webkit-scrollbar-track {
        background-color: transparent;
    }
    *::-webkit-scrollbar-thumb {
        background-color: var(--purple);
    }
    html {
        font-size: 62.5%;
        overflow-x: hidden;
    }
    body {
        background-color: #060c21;
    }
    </style>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="expedition">
    <!-- Expedition package CRUD section starts  -->
    <section class="add-expeditions">
        <h1 class="title">Expedition Packages</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Add Expedition Package</h3>
            <div class="form-group">
                <label for="name">Package Name:</label>
                <input type="text" name="name" id="name" class="box" placeholder="Enter package name" required>
            </div>
            <div class="form-group">
                <label for="price">Package Price:</label>
                <input type="number" min="0" name="price" id="price" class="box" placeholder="Enter package price" required>
            </div>
            <div class="form-group">
                <label for="image">Package Image:</label>
                <input type="file" name="image" id="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
            </div>
            <div class="form-group">
                <label for="no_of_days">Number of Days:</label>
                <input type="number" min="1" name="no_of_days" id="no_of_days" class="box" placeholder="Enter number of days" required>
            </div>
            <div class="form-group">
                <label for="description">Package Description:</label>
                <textarea name="description" id="description" class="box" placeholder="Enter package description" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Add Expedition" name="add_expedition" class="btn">
            </div>
        </form>
    </section>
    <!-- Show expedition packages  -->
    <section class="show-expeditions">
        <div class="box-container">
            <?php
            $select_expeditions = mysqli_query($conn, "SELECT * FROM `expeditions`") or die('query failed');
            if (mysqli_num_rows($select_expeditions) > 0) {
                while ($fetch_expeditions = mysqli_fetch_assoc($select_expeditions)) {
            ?>
                    <div class="box">
                        <img src="uploaded_img/<?php echo $fetch_expeditions['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_expeditions['name']; ?></div>
                        <div class="price">$<?php echo $fetch_expeditions['price']; ?>/-</div>
                        <div class="days"><?php echo $fetch_expeditions['no_of_days']; ?> Days</div>
                        <div class="description"><?php echo $fetch_expeditions['description']; ?></div>
                        <a href="admin_expedition.php?update=<?php echo $fetch_expeditions['id']; ?>" class="option-btn">Update</a>
                        <a href="admin_expedition.php?delete=<?php echo $fetch_expeditions['id']; ?>" class="delete-btn" onclick="return confirm('Delete this expedition?');">Delete</a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">No expedition packages added yet!</p>';
            }
            ?>
        </div>
    </section>
    <section class="edit-expedition-form">
        <?php
        if (isset($_GET['update'])) {
            $update_id = $_GET['update'];
            $update_query = mysqli_query($conn, "SELECT * FROM `expeditions` WHERE id = '$update_id'") or die('query failed');
            if (mysqli_num_rows($update_query) > 0) {
                while ($fetch_update = mysqli_fetch_assoc($update_query)) {
        ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="update_e_id" value="<?php echo $fetch_update['id']; ?>">
                        <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                        <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
                        <div class="form-group">
                            <label for="update_name">Package Name:</label>
                            <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" id="update_name" class="box" required placeholder="Enter package name">
                        </div>
                        <div class="form-group">
                            <label for="update_price">Package Price:</label>
                            <input type="number" min="0" name="update_price" value="<?php echo $fetch_update['price']; ?>" id="update_price" class="box" required placeholder="Enter package price">
                        </div>
                        <div class="form-group">
                            <label for="update_image">Package Image:</label>
                            <input type="file" class="box" name="update_image" id="update_image" accept="image/jpg, image/jpeg, image/png">
                        </div>
                        <div class="form-group">
                            <label for="update_no_of_days">Number of Days:</label>
                            <input type="number" min="1" name="update_no_of_days" value="<?php echo $fetch_update['no_of_days']; ?>" id="update_no_of_days" class="box" required placeholder="Enter number of days">
                        </div>
                        <div class="form-group">
                            <label for="update_description">Package Description:</label>
                            <textarea name="update_description" id="update_description" class="box" required placeholder="Enter package description"><?php echo $fetch_update['description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update" name="update_expedition" class="btn">
                            <input type="reset" value="Cancel" id="close-update" class="option-btn">
                        </div>
                    </form>
        <?php
                }
            }
        } else {
            echo '<script>document.querySelector(".edit-expedition-form").style.display = "none";</script>';
        }
        ?>
    </section>
</div>
    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>
</body>
</html>

<?php

include 'config.php';

$conn = mysqli_connect('localhost', 'root', '', 'shop_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS expeditions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    no_of_days INT NOT NULL,
    description TEXT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'treks' created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);

?>

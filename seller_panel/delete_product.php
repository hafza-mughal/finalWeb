<?php
include("include/db.php");

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch the product details before deleting
    $query = "SELECT * FROM add_product WHERE product_id = $product_id";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Move product to trash
        $insert_trash = "INSERT INTO trash_products (product_id, product_name, price, description, stock, image) 
                         VALUES ('{$row['product_id']}', '{$row['product_name']}', '{$row['price']}', '{$row['description']}', '{$row['stock']}', '{$row['image']}')";
        $connection->query($insert_trash);

        // Delete from main products table
        $delete_query = "DELETE FROM add_product WHERE product_id = $product_id";
        if ($connection->query($delete_query) === TRUE) {
            echo "<script>alert('Product moved to trash!'); window.location.href='manage_product.php';</script>";
        } else {
            echo "Error: " . $connection->error;
        }
    }
}
?>

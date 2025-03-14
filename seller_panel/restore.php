<?php
include("include/db.php");

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch product from trash
    $query = "SELECT * FROM trash_products WHERE product_id = $product_id";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Restore to main table
        $restore_query = "INSERT INTO add_product (product_id, product_name, price, description, stock, image) 
                          VALUES ('{$row['product_id']}', '{$row['product_name']}', '{$row['price']}', '{$row['description']}', '{$row['stock']}', '{$row['image']}')";
        $connection->query($restore_query);

        // Remove from trash
        $delete_query = "DELETE FROM trash_products WHERE product_id = $product_id";
        $connection->query($delete_query);

        echo "<script>alert('Product restored successfully!'); window.location.href='trash.php';</script>";
    }
}
?>

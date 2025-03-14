<?php
include("include/db.php");

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $delete_query = "DELETE FROM trash_products WHERE product_id = $product_id";
    if ($connection->query($delete_query) === TRUE) {
        echo "<script>alert('Product deleted permanently!'); window.location.href='trash.php';</script>";
    } else {
        echo "Error: " . $connection->error;
    }
}
?>

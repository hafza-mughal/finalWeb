<?php
include("include/header.php");
include("include/nav.php");
include("include/db.php");

$sql = "SELECT * FROM trash_products";
$result = $connection->query($sql);
?>
<div class="main-container">
    <div class="container">
        <h2>Trash Bin</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['product_id']}</td>
                            <td>{$row['product_name']}</td>
                            <td>₹ {$row['price']}</td>
                            <td>{$row['description']}</td>
                            <td>{$row['stock']}</td> 
                            <td><img src='uploads/{$row['image']}' width='60' height='60'></td>
                            <td>
                                <a href='restore.php?id={$row['product_id']}' class='btn btn-success btn-sm'>🔄 Restore</a>
                                <a href='delete_forever.php?id={$row['product_id']}' class='btn btn-danger btn-sm'>🗑 Delete Forever</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

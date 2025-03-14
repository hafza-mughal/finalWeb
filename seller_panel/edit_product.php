<?php
include("include/header.php");
include("include/nav.php");
include("include/db.php");

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM add_product WHERE product_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock']; // ✅ Stock value get ki

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $product['image'];
    }
    
    // ✅ Stock field added in query
    $sql = "UPDATE add_product SET product_name=?, price=?, description=?, stock=?, image=? WHERE product_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sdsisi", $product_name, $price, $description, $stock, $image, $product_id);
    
    if ($stmt->execute()) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Product updated successfully!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location='manage_product.php';
                });
            });
        </script>";
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error updating product: " . $connection->error . "',
                });
            });
        </script>";
    }
}
?>

<div class="main-container">
    <div class="container">
        <h2>Edit Product</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" class="form-control" name="product_name" value="<?php echo $product['product_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="text" class="form-control" name="price" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" class="form-control" name="stock" value="<?php echo $product['stock']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Image</label><br>
                <img src="uploads/<?php echo $product['image']; ?>" width="100" class="mb-2"><br>
                <input type="file" class="form-control" name="image">
            </div>
            <button type="submit" class="btn btn-success">Update Product</button>
            <a href="manage_product.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

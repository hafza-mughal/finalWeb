
<?php
include ("include/header.php");
include ("include/nav.php");
include ("include/db.php");

$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = mysqli_real_escape_string($connection, $_POST["product_name"]);
    $price = mysqli_real_escape_string($connection, $_POST["price"]);
    $description = mysqli_real_escape_string($connection, $_POST["description"]);
    $stock = mysqli_real_escape_string($connection, $_POST["stock"]); // Stock field added

    // File Uploading
    $target_dir = "uploads/";

    // Ensure uploads/ directory exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert Query with Stock
        $sql = "INSERT INTO add_product (product_name, price, description, stock, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sdsss", $product_name, $price, $description, $stock, $image_name);

        if ($stmt->execute()) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Product added successfully!',
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
                        text: 'Error: " . $stmt->error . "',
                    });
                    
                });
            </script>";
        }
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to upload image.',
                });
            });
        </script>";
    }
} 

// if (isset($_GET["success"]) && $_GET["success"] == 1) {
//     $message = "<div class='alert alert-success'>Product Added Successfully!</div>";
// }
?>
<div class="container mt-4">
    <div class="add_card">
        <div class="card-header">Add Product</div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="3" name="description" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" class="form-control" name="stock" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Image</label>
                    <input type="file" class="form-control" name="image" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Add Product</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>

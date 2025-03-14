<?php
include ("include/header.php");
include ("include/nav.php");
include ("include/db.php");

$limit = 5; // Har page par kitne products dikhane hain
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Total Products Count
$total_sql = "SELECT COUNT(*) FROM add_product";
$total_result = $connection->query($total_sql);
$total_row = $total_result->fetch_row();
$total_products = $total_row[0];

$total_pages = ceil($total_products / $limit);

// Products Fetch Query with Limit
$sql = "SELECT * FROM add_product LIMIT $limit OFFSET $offset";
$result = $connection->query($sql);
?>

<div class="main-container">
    <div class="container product-table">
        <h2 class="mb-4">Product Management</h2>
        <p class="mb-4" style="font-size:18px;">Manage your products efficiently. Add, edit, or remove products from the list below.</p>
        <button class="btn btn-primary mb-3" onclick="window.location.href='add_product.php'">➕ Add New Product</button>

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
                            <td><img src='uploads/{$row['image']}' width='50' height='50'></td>
                            <td>
                                <a href='edit_product.php?id={$row['product_id']}' class='btn btn-warning btn-sm'>✏️ Edit</a>
                                <button class='btn btn-danger btn-sm' onclick='confirmDelete({$row['product_id']})'>🗑 Delete</button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-end">
                <!-- Previous Button -->
                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                </li>

                <!-- Page Numbers -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Next Button -->
                <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(productId) {
    Swal.fire({
        title: "Are you sure?",
        text: "Product Move to Trash",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'delete_product.php?id=' + productId;
        }
    });
}
</script>


    </div>
</div>

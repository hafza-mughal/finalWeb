<?php
include ("include/header.php");
include ("include/nav.php");
include ("include/db.php");

// Pagination
$limit = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Total Orders Count
$total_sql = "SELECT COUNT(*) FROM orders";
$total_result = $connection->query($total_sql);
$total_row = $total_result->fetch_row();
$total_orders = $total_row[0];

$total_pages = ceil($total_orders / $limit);

// Fetch Orders
$sql = "SELECT * FROM orders ORDER BY order_date DESC LIMIT $limit OFFSET $offset";
$result = $connection->query($sql);
?>
<div class="main-container">
<div class="container mt-4">
    <h2 class="text-center">Orders Management</h2>
    <p class="text-center">View and manage customer orders efficiently.</p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='text-center'>
                            <td>{$row['order_id']}</td>
                            <td>{$row['customer_name']}</td>
                            <td>₹ {$row['total_price']}</td>
                            <td>
                                <span class='badge badge-".statusClass($row['status'])."'>
                                    {$row['status']}
                                </span>
                            </td>
                            <td>{$row['order_date']}</td>
                            <td>
                                <button class='btn btn-success btn-sm' onclick='updateStatus({$row['order_id']}, \"Completed\")'>✅ Complete</button>
                                <button class='btn btn-warning btn-sm' onclick='updateStatus({$row['order_id']}, \"Pending\")'>⏳ Pending</button>
                                <button class='btn btn-danger btn-sm' onclick='updateStatus({$row['order_id']}, \"Cancelled\")'>❌ Cancel</button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No orders found</td></tr>";
                }

                function statusClass($status) {
                    if ($status == 'Completed') return 'success';
                    if ($status == 'Pending') return 'warning';
                    if ($status == 'Cancelled') return 'danger';
                    return 'secondary';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav>
        <ul class="pagination justify-content-center flex-wrap">
            <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
            </li>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function updateStatus(orderId, newStatus) {
    Swal.fire({
        title: "Are you sure?",
        text: "Change order status to " + newStatus + "?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, update!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'update_order.php?id=' + orderId + '&status=' + newStatus;
        }
    });
}
</script>
</div>
<style>
/* Responsive Design */
@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }
    .btn {
        font-size: 14px;
        padding: 6px 10px;
    }
    .pagination .page-link {
        font-size: 14px;
        padding: 5px 10px;
    }
}

/* Mobile View Adjustments */
@media (max-width: 480px) {
    h2 {
        font-size: 18px;
    }
    p {
        font-size: 14px;
    }
    .btn {
        font-size: 12px;
        padding: 4px 8px;
    }
    .pagination {
        flex-wrap: wrap;
    }
    .pagination .page-link {
        padding: 4px 8px;
        font-size: 12px;
    }
    td, th {
        font-size: 12px;
    }
}
</style>
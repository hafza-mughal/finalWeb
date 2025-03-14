<?php
include("include/db.php");

$seller_id = 1; // Yeh session ya login system ke mutabiq set karna hoga

// Fetch Seller Data
$query = "SELECT name, profile_pic FROM sellers WHERE seller_id = $seller_id";
$result = $connection->query($query);
$seller = $result->fetch_assoc();
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <span class="hamburger" onclick="toggleSidebar()"><i class="fas fa-bars"></i></span>
            <a class="navbar-brand fw-bold d-flex align-items-center ms-2" href="#">
                <img src="logo_black-removebg-preview.png" alt="Logo" style="height: 40px;"> Seller Dashboard
            </a>
        </div>
        <div class="ms-auto d-flex align-items-center">
            <div class="notification-icon me-3">
                <i class="fas fa-bell"></i>
                <span class="badge bg-danger">3</span>
            </div>
            <img src="uploads/<?php echo htmlspecialchars($seller['profile_pic'] ?? 'default.jpg'); ?>" 
                 alt="Profile" class="navbar-profile-img me-2" style="width: 40px; height: 40px; border-radius: 50%;">
            <span class="fw-bold"><?php echo htmlspecialchars($seller['name'] ?? 'Seller Name'); ?></span>
        </div>
    </div>
</nav>

    
    <div class="container-fluid">
        <div class="row">
           <!-- Sidebar -->
<nav class="col-md-3 col-lg-2 sidebar" id="sidebar">
    <img src="uploads/<?php echo htmlspecialchars($seller['profile_pic'] ?? 'default.jpg'); ?>" 
         alt="Seller Profile" class="profile-img" style="width: 80px; height: 80px; border-radius: 50%;">
    <h4 class="text-center mt-2"><?php echo htmlspecialchars($seller['name'] ?? 'Seller Name'); ?></h4>

    <a href="dashbord.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="Add_product.php"><i class="fas fa-plus"></i> Add Product</a>
    <a href="manage_product.php"><i class="fas fa-box"></i> Manage Products</a>
    <a href="order.php"><i class="fas fa-shopping-cart"></i> Orders</a>
    <a href="trash.php"><i class="fas fa-trash"></i> Trash</a>
    <a href="edit_profile.php"><i class="fas fa-user"></i> Profile</a>
    <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
</nav>

        </div>
    </div>
    
    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
        }
    </script>
<?php
include ("include/header.php");
include ("include/nav.php");
?>
   
            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 content">
                <h2 class="fw-bold">Dashboard Overview</h2>
              
                
        <!-- Summary Cards -->
<div class="container">
    <div class="row g-3 justify-content-center text-center">
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-sm p-2" style="background-color: #ffcccb !important;">
                <div class="card-body">
                    <i class="fas fa-box fa-3x text-dark"></i>
                    <h5 class="card-title">Total Products</h5>
                    <h3>23</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm p-2" style="background-color: #add8e6 !important;">
                <div class="card-body">
                    <i class="fas fa-clock fa-3x text-dark"></i>
                    <h5 class="card-title">Pending Orders</h5>
                    <h3>5</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card shadow-sm p-2" style="background-color: #90ee90 !important;">
                <div class="card-body">
                    <i class="fas fa-check-circle fa-3x  text-dark"></i>
                    <h5 class="card-title">Completed Orders</h5>
                    <h3>18</h3>
                </div>
            </div>
        </div>
    </div>
</div>

                
                <!-- Orders Table -->
                <div class="card mt-4 shadow-sm recent-orders">
                    <div class="card-header">Recent Orders</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Product A</td>
                                    <td>John Doe</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td><button class="btn btn-sm btn-primary">View</button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Product B</td>
                                    <td>Jane Smith</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td><button class="btn btn-sm btn-primary">View</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

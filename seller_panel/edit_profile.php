<?php
include("include/header.php");
include("include/nav.php");
include("include/db.php");

$seller_id = 1; // Yeh session ya login system ke mutabiq set karna hoga

// Fetch Seller Data
$query = "SELECT * FROM sellers WHERE seller_id = $seller_id";
$result = $connection->query($query);

if ($result->num_rows > 0) {
    $seller = $result->fetch_assoc();
} else {
    $seller = [
        'name' => '',
        'phone' => '',
        'address' => '',
        'profile_pic' => 'default.jpg'
    ];
}

// Profile Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Image Upload
    if (!empty($_FILES['profile_pic']['name'])) {
        $image = $_FILES['profile_pic']['name'];
        $target = "uploads/" . basename($image);

        // Purani image delete karein agar default nahi hai
        if (!empty($seller['profile_pic']) && $seller['profile_pic'] != 'default.jpg') {
            unlink("uploads/" . $seller['profile_pic']);
        }

        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target);

        $update_query = "UPDATE sellers SET name='$name', phone='$phone', address='$address', profile_pic='$image' WHERE seller_id=$seller_id";
    } else {
        $update_query = "UPDATE sellers SET name='$name', phone='$phone', address='$address' WHERE seller_id=$seller_id";
    }

    if ($connection->query($update_query)) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Profile Updated!',
                text: 'Your profile has been updated successfully.',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = 'profile.php';
            });
        </script>";
    }
}
?>

<div class="main-container">
    <div class="container mt-2 d-flex justify-content-center">
        <div class="card p-3 shadow-lg" style="max-width: 450px; width: 100%; border-radius: 15px;">
            <h2 class="text-center">Seller Profile</h2>
            <div class="text-center">
                <div class="profile-img-container position-relative">
                    <img src="uploads/<?php echo htmlspecialchars($seller['profile_pic']); ?>" 
                         class="rounded-circle shadow" width="120" height="120"
                         style="border: 4px solid #007bff;">
                </div>
                <h4 class="mt-2"><?php echo htmlspecialchars($seller['name']); ?></h4>
                <p class="text-muted"><?php echo htmlspecialchars($seller['phone']); ?></p>
            </div>

            <form method="POST" enctype="multipart/form-data" class="mt-2" id="profileForm">
                <div class="mb-2">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control" 
                           value="<?php echo htmlspecialchars($seller['name']); ?>" required disabled>
                </div>
                <div class="mb-2">
                    <label class="form-label fw-bold">Phone</label>
                    <input type="text" name="phone" class="form-control" 
                           value="<?php echo htmlspecialchars($seller['phone']); ?>" required disabled>
                </div>
                <div class="mb-2">
                    <label class="form-label fw-bold">Address</label>
                    <textarea name="address" class="form-control" required 
                              style="resize: none;" disabled><?php echo htmlspecialchars($seller['address']); ?></textarea>
                </div>
                <div class="mb-2">
                    <label class="form-label fw-bold">Profile Picture</label>
                    <input type="file" name="profile_pic" class="form-control" disabled>
                </div>
                <button type="button" id="editBtn" class="btn btn-warning w-100">Edit Profile</button>
                <button type="submit" name="update_profile" id="saveBtn" class="btn btn-success w-100 mt-2 d-none">Save Changes</button>
            </form>
        </div>
    </div>
</div>

<style>
    .profile-img-container {
        display: inline-block;
        transition: transform 0.3s ease-in-out;
    }

    .profile-img-container:hover {
        transform: scale(1.05);
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        transition: background 0.3s ease-in-out;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        transition: background 0.3s ease-in-out;
    }

    .btn-success:hover {
        background-color: #218838;
    }
</style>

<script>
    document.getElementById("editBtn").addEventListener("click", function () {
        let inputs = document.querySelectorAll("input, textarea");
        inputs.forEach(input => input.removeAttribute("disabled"));

        // Show save button and hide edit button
        this.classList.add("d-none");
        document.getElementById("saveBtn").classList.remove("d-none");
    });
</script>

<?php
include ("include/header.php");
include ("include/connection.php");
include ("include/footer.php");
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="images/logo.png" alt="Logo">
                <span class="ms-2 fw-bold">Artify</span>
            </a>
            <div class="d-flex gap-3 nav-icons d-lg-none">
                <i class="fas fa-search"></i>
                <i class="fas fa-shopping-cart"></i>
                <i class="fas fa-user"></i>
            </div>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#home">Gallery</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#shop" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#electronics">Electronics</a></li>
                            <li><a class="dropdown-item" href="#fashion">Fashion</a></li>
                            <li><a class="dropdown-item" href="#beauty">Beauty</a></li>
                            <li><a class="dropdown-item" href="#home-appliances">Home Appliances</a></li>
                            <li><a class="dropdown-item" href="#sports">Sports</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#home">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#home">Contact</a></li>
                </ul>
            </div>
            <div class="d-flex gap-3 nav-icons d-none d-lg-flex">
                <i class="fas fa-search"></i>
                <i class="fas fa-shopping-cart"></i>
                <i class="fas fa-user"></i>
            </div>
        </div>
    </nav>
    
    <section class="hero">
        <video class="background-video" autoplay muted loop>
            <source src="images/video.mp4" type="video/mp4">
        </video>
        <div class="overlay"></div>
        <div class="hero-text">
            <h1>Discover the Best Shopping Experience</h1>
            <p>Shop your favorite products at unbeatable prices with fast delivery.</p>
            <a href="#shop" class="btn">Start Shopping</a>
        </div>
        <div class="hero-image">
            <img src="images/hero-right-img.png" alt="Shopping Illustration">
        </div>
    </section>

				<!-- catagory -->

				<section class="category-section">
					<div class="section-header">
					<h1 class="productH1">Category</h1>
						<div class="swiper-buttons">
							<a href="#" class="btn btn-primary">View All</a>
							<button class="swiper-button-prev">❮</button>
							<button class="swiper-button-next">❯</button>
						</div>
					</div>
					<div class="swiper-container category-slider">
						<div class="swiper-wrapper">
                                  

							<div class="swiper-slide">
								<img src="images/perfume3.webp" alt="Meat Products">
								<h4 class="category-title">Wall Art</h4>
							</div>



							<div class="swiper-slide">
								<img src="images/handbags3.webp" alt="Fruits & Veges">
								<h4 class="category-title">Hand Bag</h4>
							</div>
							<div class="swiper-slide">
								<img src="images/watch.jpg" alt="Breads & Sweets">
								<h4 class="category-title">Men's Wallet</h4>
							</div>
							<div class="swiper-slide">
								<img src="images/perfume3.webp" alt="Fruits & Veges">
								<h4 class="category-title">Perfume</h4>
							</div>
							<div class="swiper-slide">
								<img src="images/doll3.webp" alt="Beverages">
								<h4 class="category-title">Dolls</h4>
							</div>
							<div class="swiper-slide">
								<img src="images/watch.jpg" alt="Meat Products">
								<h4 class="category-title">Watch</h4>
							</div>

							<div class="swiper-slide">
								<img src="images/greeting card.jpg" alt="Meat Products">
								<h4 class="category-title">Greeting Cards</h4>
							</div>

							<div class="swiper-slide">
								<img src="images/beauty2.webp" alt="Meat Products">
								<h4 class="category-title">Beauty Products</h4>
							</div>
						</div>
					</div>
				</section>

				<script>
					var swiper = new Swiper('.category-slider', {
						slidesPerView: 4,
						spaceBetween: 20,
						navigation: {
							nextEl: '.swiper-button-next',
							prevEl: '.swiper-button-prev',
						},
						loop: true,
						autoplay: {
							delay: 3000,
							disableOnInteraction: false,
						},
						breakpoints: {
							320: { slidesPerView: 1 },
							480: { slidesPerView: 2 },
							768: { slidesPerView: 3 },
							1024: { slidesPerView: 4 }
						}
					});
				</script>
				<!-- End-catagory -->
</body>
</html>

<h1 class="productH1">Latest products</h1>
<div class="product-container">

    <?php
	
// Fetch products from database
$sql = "SELECT * FROM add_product";
$result = $connection->query($sql); 
	while ($row = $result->fetch_assoc()): ?>
        <div class="product-card">
            <div class="image-container">
                <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>">
                <button class="add-to-cart" 
    data-id="<?php echo htmlspecialchars($row['product_id']); ?>" 
    data-name="<?php echo htmlspecialchars($row['product_name']); ?>" 
    data-price="<?php echo htmlspecialchars($row['price']); ?>" 
    data-image="<?php echo htmlspecialchars($row['image']); ?>">
    Add to Cart
</button>

            </div>
            <div class="product-info">
                <h3><?php echo $row['product_name']; ?></h3>
                <p><?php echo number_format($row['price'], 2); ?></p>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.addEventListener("click", function() {
            let productId = this.getAttribute("data-id");
            let productName = this.getAttribute("data-name");
            let productPrice = this.getAttribute("data-price");
            let productImage = this.getAttribute("data-image");

            let formData = new FormData();
            formData.append("add_to_cart", true);
            formData.append("id", productId);
            formData.append("name", productName);
            formData.append("price", productPrice);
            formData.append("image", productImage);

            fetch("add_to_cart.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert("Your product has been successfully added to the cart!");
            })
            .catch(error => console.error("Error:", error));
        });
    });
});

</script>

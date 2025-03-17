<?php
include ("include/header.php");
include ("include/connection.php");
include ("include/footer.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Artify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            color: black;
            margin: 0;
            padding: 0;
        }
        .faq-container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .faq-header {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .faq-search {
            text-align: center;
            margin-bottom: 20px;
        }
        .faq-search input {
            width: 60%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .faq-item {
            background: #f9f9f9;
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            color: black;
        }
        .faq-item:hover {
            background: #e6e6e6;
        }
        .faq-question {
            font-size: 1.2em;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1;
            color: black;
        }
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            padding: 0 15px;
            transition: max-height 0.3s ease, padding 0.3s ease;
            font-size: 1em;
            color: black;
            position: relative;
            z-index: 1;
        }
        .faq-item.active .faq-answer {
            max-height: 200px; 
            padding: 15px;
            color: black;
        }
        .icon {
            transition: transform 0.3s ease;
        }
        .faq-item.active .icon {
            transform: rotate(45deg);
        }
        .faq-contact {
            text-align: center;
            margin-top: 30px;
            font-size: 1.1em;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg  shadow-sm">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="logo_black-removebg-preview.png" alt="Logo">
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
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="d-flex gap-3 nav-icons d-none d-lg-flex">
                <i class="fas fa-search"></i>
                <li class="nav-item">
						<a class="nav-link p-0" href="add_to_cart.php"><i class="fa-solid fa-cart-shopping" style="color: #000000; font-size: 1.5rem;"></i></a>
					</li>
                <i class="fas fa-user"></i>
            </div>
        </div>
    </nav>
    <!-- Start Contact Us Hero Section -->
	<div class="hero"
		style="background: linear-gradient(to right, rgba(0, 0, 0, 0.37), rgba(0, 0, 0, 0.5)), url('images/contect2.webp'); background-size: cover; background-position: center; color: white; padding: 150px 0; height: 50vh;" >
		<div class="container">
			<div class="row justify-content-between align-items-center">
				<div class="col-lg-6">
				<div class="intro-excerpt" style="margin-top: 50px; text-align: center;">
    <p class="mb-4" style="font-size: 3rem; color: white; position: absolute; top: 10rem; width: 80%; left: 10%; font-family: 'Poppins', sans-serif; word-wrap: break-word; line-height: 2;">
        <span id="animated-text"></span>
    </p>
</div>

<script>
 const text = `Need help? We're here to assist you!`;  

    let i = 0;
    function typeEffect() {
        if (i < text.length) {
            let char = text.charAt(i) === "\n" ? "<br>" : text.charAt(i);
            document.getElementById("animated-text").innerHTML += char;
            i++;
            setTimeout(typeEffect, 50);
        }
    }
    window.onload = typeEffect;
</script>

				</div>
			</div>
		</div>
	</div>
	<!-- End Contact Us Hero Section -->
    <div class="faq-container mt-5">
        <div class="faq-header">Frequently Asked Questions</div>
        <div class="faq-search">
            <input type="text" id="faq-search" placeholder="Search for a question...">
        </div>
        <div class="faq-item">
            <div class="faq-question">How can I place an order? <i class="fa fa-plus icon"></i></div>
            <div class="faq-answer">You can place an order by selecting your items, adding them to the cart, and proceeding to checkout.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">What payment methods do you accept? <i class="fa fa-plus icon"></i></div>
            <div class="faq-answer">We accept Cash on Delivery (COD) and online card payments.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">How long does delivery take? <i class="fa fa-plus icon"></i></div>
            <div class="faq-answer">Delivery takes 3-5 business days, depending on your location.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Can I return a product? <i class="fa fa-plus icon"></i></div>
            <div class="faq-answer">Yes, you can return products within 7 days of delivery. The item must be unused and in its original packaging.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Do you offer international shipping? <i class="fa fa-plus icon"></i></div>
            <div class="faq-answer">Currently, we only ship within the country. International shipping will be available soon.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">How can I track my order? <i class="fa fa-plus icon"></i></div>
            <div class="faq-answer">Once your order is shipped, you will receive a tracking number via email.</div>
        </div>
        <div class="faq-contact">
            If you have more questions, contact us at <strong>support@artify.com</strong>
        </div>
    </div>

    <script>
        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        });
        document.getElementById('faq-search').addEventListener('input', function() {
            let searchText = this.value.toLowerCase();
            document.querySelectorAll('.faq-item').forEach(item => {
                let question = item.querySelector('.faq-question').textContent.toLowerCase();
                if (question.includes(searchText)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
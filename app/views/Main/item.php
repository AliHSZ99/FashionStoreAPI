<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- For the Boostrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- For the cart icon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- For CSS stylesheet -->
	<link rel="stylesheet" href="/app/styles.css">
	<title>FashionStoreAPI</title>
</head>

<body>
	<!-- This div is for the navigation bar -->
	<div>
		<nav class="navbar navbar-expand-sm" style="background: black;">
			<div class="container-fluid">
				<a class="navbar-brand" href="/Main/index"><img style="height: 70px;" src="/app/images/logo.png" alt=""></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
					<span class="navbar-toggler-icon"></span>
				</button>
                
                <form class="collapse navbar-collapse" style = "margin-left: 100px">
					<input class="form-control me-2" type="text" placeholder="Search for items">
					<button style="background: white;" class="btn" type="button"><img style="height: 20px; margin-bottom: 2px" src="/app/images/searchIcon.png" alt=""></button>
				</form>

				<div  class="collapse navbar-collapse" id="mynavbar">
					<ul class="navbar-nav me-auto position-absolute end-0">
						<li class="nav-item">
							<a class="nav-link text-white h3" href="/Main/About" style="margin-right: 30px;">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white h3" href="/Main/wishlist" style="margin-right: 30px;">Wishlist</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white h3" href="/Main/settings" style="margin-right: 30px;">Settings</a>
						</li>
						<li class="nav-item" style="margin-right: 30px; margin-top: 5px">
							<a class="nav-link text-white h3" href="/Main/cart"><ion-icon name="cart-outline"></ion-icon></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>

	<?php
	echo "
	<div id='itemContainerBox'>
		<div class='row'>
            <div class='col'>
                <img id='itemImage' src='http://$data->image_url' alt='' style='height: 350px; width: 300px'>
            </div>
            <!-- Production Information -->
            <div class='col productInfo'>
                <div class='container'>
                    <div class='row'>
						<form action='/Main/addToCart/$data->item_id' method='POST'>
							<h2>$data->item_name</h2>
							<h2>$data->item_color</h2>
							<br>
							<label for='size'>Choose a size:</label>
							<select id='size' name='size'>
								<option value='S'>S</option>
								<option value='M'>M</option>
								<option value='L'>L</option>
								<option value='XL'>XL</option>
							</select>
							<h2>$$data->item_price</h2>
							<button id='addToCartButton' name='action' style='margin-top: 23%'>Add To Cart</button>
						</form>
                    </div>
                </div>
            </div>
            <!-- Go Back Button -->
            <div class='col'>
                <a href='/Main/index'><button class='btn btn-outline-secondary'>Go Back</button></a>
            </div>
        </div>
	</div>"

	?>
</body>
</html>
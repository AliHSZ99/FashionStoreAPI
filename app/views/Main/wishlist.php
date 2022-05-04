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
							<a class="nav-link text-white h3" href="/Main/about" style="margin-right: 30px;">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white h3" href="/Main/goToWishlist" style="margin-right: 30px;">Wishlist</a>
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
	<!-- Product items and Filter -->
	<div>
		<!-- Product items -->
		<div>
			<div class="container">
				<!-- This div make sure that there's only three items per row -->
				<div class="row row-cols-3 items">
					<!-- Add the for loop here to add more items -->
					<!-- Put the div with class called col inside of the for loop -->
					<!-- <div class="col">
						<div class="itemBox">
							<img src="/app/images/jeremie.jpg">
							<br>
							<a class="h4" href="/Main/quickShopButton">I Love Mayuri Shirt</a>
							<p>$69.69</p> -->
							<!-- Add the guest id after /removeWishlist -->
                            <!-- <a href="/Main/removeWishlist"><img src="/app/images/withstar.png" style='height: 40px; width: 40px; margin-bottom: 5%'alt=""></a>
						</div>
					</div> -->
					<?php
					for ($i = 0; $i < count($data); $i++) {
						echo "
						<div class='col'>
							<div class='itemBox'>
							<form action='/Main/removeToWishlist/{$data[$i]->item_id}' method='POST'>
								<img src='http://{$data[$i]->image_url}' alt='' height='350px'; width='300px'></img>
								<br>
								<a class='h4' href='/Main/quickShopButton/{$data[$i]->item_id}'>{$data[$i]->item_name}</a>
								<p>\${$data[$i]->item_price}</p>
								<button  class='btn btn-outline-danger' name='removeItem' style='margin-bottom:2%'>Remove to Wishlist</button>
							</form> 
							</div>
						</div>
						
					";
					}
					?>
   				</div>
			</div>
		</div>  
	</div>
	
</body>
</html>
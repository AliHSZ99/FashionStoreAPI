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
							<a class="nav-link text-white h3" href="/Main/about" style="margin-right: 80px;">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white h3" href="/Main/settings" style="margin-right: 80px;">Settings</a>
						</li>
						<li class="nav-item" style="margin-right: 80px; margin-top: 5px">
							<a class="nav-link text-white h3" href="/Main/cart"><ion-icon name="cart-outline"></ion-icon></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>

    <!-- This div is for the item -->
	<div id="itemContainerBox">
		<div class="row">
            <div class="col">
                <img id="itemImage" src="/app/images/shirt.jpg" alt="">
            </div>
            <!-- Production Information -->
            <div class="col productInfo">
                <div class="container">
                    <div class="row">
                       <h2>UO Big Corduroy Work Shirt</h2>
                       <h2>Brown</h2>
                       <div class="btn-group me-2" role="group" aria-label="Second group">
                            <button type="button" class="btn btn-outline-secondary">S</button>
                            <button type="button" class="btn btn-outline-secondary">M</button>
                            <button type="button" class="btn btn-outline-secondary">L</button>
                            <button type="button" class="btn btn-outline-secondary">XL</button>
                        </div>
                       <h2>$69.99</h2>
                       <button id="addToCartButton">Add To Cart</button>
                    </div>
                </div>
            </div>
            <!-- Go Back Button -->
            <div class="col">
                <a href="/Main/index"><button class="btn btn-outline-secondary">Go Back</button></a>
            </div>
        </div>
	</div>
	
</body>
</html>
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
	<link rel="stylesheet" href="app/styles.css">
	<title>About</title>
</head>

<body>
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
							<a class="nav-link text-white h3" href="/Main/About" style="margin-right: 80px;">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white h3" href="/Main/settings" style="margin-right: 80px;">Settings</a>
						</li>
						<li class="nav-item" style="margin-right: 80px; margin-top: 5px">
							<a class="nav-link text-white h3" href="/Main/Cart"><ion-icon name="cart-outline"></ion-icon></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	
	<center>
		<div>
			<img src="/app/images/about.png" style="width: 60%; margin-top: 5%" alt="">
		</div>
	</center>

</body>

</html>
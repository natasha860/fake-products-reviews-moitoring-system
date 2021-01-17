<?php
include "db.php";
include "functions.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="admin/assets/css/animate.css">
	<link rel="stylesheet" href="admin/assets/css/notify.css">
	<link rel="stylesheet" href="admin/assets/css/style.css">
	<title>MYPV</title>
	<style>
		.page-item.active .page-link {
			background-color: #28a745 !important;
			border-color: inherit;
		}

		.page-item .page-link {
			color: #000000;
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-success text-white text-center sticky-top">
		<div class="container">
			<a class="navbar-brand" href="index.php"><span class="logo1">F</span><span class="d-none d-sm-inline">ake</span> <span class="logo1">R</span><span class="d-none d-sm-inline">eview</span> <span class="logo1">S</span><span class="d-none d-sm-inline">ystem</span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border: 0.5px solid white;">
				<span class="fa fa-angle-down text-white font-weight-bold"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto text-white">
					<li class="nav-item">
						<a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "index.php") ? "active" : ""; ?>" href="index.php"><i class="fa fa-home"></i>&nbsp;Home</a>
					</li>
					
					<?php
					if (isset($_SESSION['user'])) {
					?>
						<li class="nav-item pt-1 ml-1">
							<div class="btn-group">
								<button type="button" class="btn btn-outline-light btn-sm my-sm-0 dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
								</button>
								<div class="dropdown-menu">
									<a href="edit_profile.php?user_id=<?php echo $_SESSION['user']; ?>" class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == "edit_profile.php") ? "active" : ""; ?>"><i class="fa fa-pencil-alt"></i>&nbsp; Profile</a>
									<div class="dropdown-divider"></div>
									<a href="logout.php" class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == "logout.php") ? "active" : ""; ?>"><i class="fa fa-power-off"></i>&nbsp; Logout</a>
								</div>
							</div>
						</li>
					<?php } else { ?>
						<li class="nav-item">
							<div class="btn-group">
								<button type="button" class="btn btn-outline-light btn-sm mt-1  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
								</button>
								<div class="dropdown-menu">
									<a href="login.php" class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == "login.php") ? "active" : ""; ?>"><i class="fa fa-sign-in-alt"></i>&nbsp; Login</a>
									
							</div>
						</li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
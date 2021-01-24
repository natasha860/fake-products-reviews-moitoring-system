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
  <link rel="stylesheet" href="./assets/css/bootstrap.css">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/animate.css">
  <link rel="stylesheet" href="./assets/css/notify.css">
  <link rel="stylesheet" href="./assets/css/style.css">

  <title>Test Phase </title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white text-center sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.php"><span class="logo1">F</span><span class="d-none d-sm-inline">ake</span> <span class="logo1">R</span><span class="d-none d-sm-inline">eview</span> <span class="logo1">S</span><span class="d-none d-sm-inline">ystem</span> <span class="font-weight-bold font-italic">(ADMIN)</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border: 0.5px solid white;">
        <span class="fa fa-angle-down text-white font-weight-bold"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto text-white">
          <?php
          if (isset($_SESSION['admin'])) {
          ?>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active font-weight-bold' : ''; ?>" href="index.php"><i class="fa fa-home"></i>&nbsp;Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == "all_products.php") ? "active font-weight-bold" : ""; ?>" href="all_products.php"><i class="fa fa-home"></i>&nbsp;All Products</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class='dropdown-item' href="add_category.php">Add Category</a>
                <hr class="my-1 py-0 text-dark">
                <?php
                $query = "SELECT * FROM category";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_array($result)) {
                    $cat_id = $row['id'];
                    $cat_name = $row['name'];

                    echo "<a class='dropdown-item' href='add_product.php?cat_id=$cat_id'>$cat_name</a>";
                  }
                }
                ?>
              </div>
            </li>

            <li class="nav-item dropdown <?php echo (basename($_SERVER['PHP_SELF']) == "new_users.php") ? "active" : "" || (basename($_SERVER['PHP_SELF']) == "all_users.php") ? "active" : "" || (basename($_SERVER['PHP_SELF']) == "block_users.php") ? "active" : ""; ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users"></i>&nbsp;
                Users
                <span class="badge badge-danger badge-count d-none">0</span></a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == "new_users.php") ? "active" : ""; ?>" href="new_users.php"><i class="fas fa-user-check"></i>&nbsp;New Users <span class="badge badge-danger badge-count d-none">0</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == "all_users.php") ? "active" : ""; ?>" href="all_users.php"><i class="fa fa-users"></i>&nbsp;All Users</a>
              </div>
            </li>

            <li class="nav-item dropdown <?php echo (basename($_SERVER['PHP_SELF']) == "product_rating.php") ? "active" : "" || (basename($_SERVER['PHP_SELF']) == "user_rating.php") ? "active" : "" || (basename($_SERVER['PHP_SELF']) == "queries.php") ? "active" : ""; ?>">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                R & R
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == "product_rating.php") ? "active" : ""; ?>" href="product_rating.php"><i class="fas fa-star-half-alt"></i>&nbsp;Product Rating</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item <?php echo (basename($_SERVER['PHP_SELF']) == "queries.php") ? "active" : ""; ?>" href="queries.php"><i class="far fa-question-circle"></i>&nbsp;Reviews</a>
              </div>
            </li>
            <li class="nav-item pt-1 ml-1">
              <a class="btn btn-outline-danger btn-sm" href="../logout.php"><i class="fa fa-power-off"></i></a>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="<?php echo (basename($_SERVER['PHP_SELF']) == "all_products.php") ? "container-fluid" : "container" && (basename($_SERVER['PHP_SELF']) == "new_users.php") ? "container-fluid" : "container" && (basename($_SERVER['PHP_SELF']) == "all_users.php") ? "container-fluid" : "container" && (basename($_SERVER['PHP_SELF']) == "product_rating.php") ? "container-fluid" : "container"; ?>">
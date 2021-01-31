<?php include "include/header.php";

if (!empty($_GET['cat_id'])) {
  $myid = $_GET['cat_id'];
}

$result = 12;

if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

if (isset($myid)) {
  $query = "SELECT p.*, c.name AS category FROM products p JOIN category c ON p.cat_id = c.id WHERE c.id = '$myid' ORDER BY date_create DESC";
} else {
  $query = "SELECT p.*, c.name AS category FROM products p JOIN category c ON p.cat_id = c.id ORDER BY date_create DESC";
}


$run = mysqli_query($con, $query);
$total_result = mysqli_num_rows($run);
$total_pages = ceil($total_result / $result);
while ($total_pages < $page) {
  $page--;
}
if ($total_result <= $result) {
  $page = 1;
}
$result_start = ($page - 1) * $result;
$pagination_no = 5; //how many pagination links wanna show
if ($pagination_no < $total_pages) {
  if ($page == 1) {
    $pagination_start = $page;
  } else {
    $pagination_start = $page - 1;
  }
  while ($pagination_start + $pagination_no - 1 > $total_pages) {
    $pagination_start--;
  }
} else {
  $pagination_start = 1;
}
////result count
$result_count = (($page - 1) * $result) + 1;

?>

<div class="row my-3">
  <?php
  if (isset($myid)) {
    $query = "SELECT p.*, c.name AS category FROM products p JOIN category c ON p.cat_id = c.id WHERE c.id = '$myid' ORDER BY date_create DESC LIMIT $result_start, $result";
  } else {
    $query = "SELECT p.*, c.name AS category FROM products p JOIN category c ON p.cat_id = c.id ORDER BY date_create DESC LIMIT $result_start, $result";
  }
  $result = mysqli_query($con, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $count = 1;
      $pid = $row['id'];
      $name = $row['name'];
      $image = "admin/assets/imgs/products/" . $row['image'];
      $category = $row['category'];
      $company_name = $row['company_name'];
      $quality = $row['quality'];
  ?>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
        <div class="card my-shadow1">
          <div class="card-header ">
            <img src="<?php echo $image; ?>" alt="Product Image" class="card-img-top">
          </div>
          <div class="card-body px-2 pt-2 pb-1 mb-0">
            <h6 class="card-title text-success font-weight-bold text-capitalize h5 my-0 my-font-size"><?php echo $name; ?></h6>
            <hr class="mb-1 mt-1">
            <div class="row">
              <div class="col-md-12">
                <span class="text-dark font-weight-bold my-font-size">Company: </span>
                <span class="float-right text-capitalize my-font-size"><?php echo $company_name; ?></span>
              </div>
              <div class="col-md-12">
                <hr class="mb-1 mt-1">
                <span class="text-dark font-weight-bold my-font-size">Category: </span>
                <span class="float-right text-capitalize my-font-size"><?php echo $category; ?></span>
              </div>
              <div class="col-md-12 mb-1">
                <hr class="mb-2 mt-1">
                <a href="product_detail.php?pid=<?php echo $pid; ?>" class="btn btn-outline-success btn-block btn-sm mybtn" data-toggle="tooltip" data-placement="top" title="See Details">Details&nbsp;
                  <i class="fas fa-info-circle"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
  <?php
      $count++;
    }
  } else {
    echo "<div class='col-md-12'>
    <h3 class='text-center'>No Products Available.</h3>
  </div>";
  }

  ?>
</div>
<div class="row justify-content-center">
  <div class="col-md-12 col-sm-4 col-7">
    <?php
    if ($total_pages > 1) {
    ?>
      <!--pagination start-->
      <nav>
        <ul class="pagination pagination-sm justify-content-center">
          <li class="page-item <?php echo ($page - 1 == 0 ? 'disabled' : ''); ?>">
            <a class="page-link" href="<?php echo ($page - 1 != 0 ? "all_products.php?page=" . ($page - 1) : '#'); ?>">
              <span>&laquo;</span>
            </a>
          </li>
          <?php
          $count = 0;
          for ($i = $pagination_start; $i <= $total_pages; $i++) {
            if ($count == $pagination_no) {
              break;
            }
            echo "<li class='page-item " . ($page == $i ? 'active font-weight-bold' : '') . "'><a class='page-link' href='all_products.php?page=$i'>$i</a></li>";
            $count++;
          }
          ?>
          <li class="page-item <?php echo ($page + 1 > $total_pages ? 'disabled' : ''); ?>">
            <a class="page-link" href="<?php echo ($page + 1 <= $total_pages ? "all_products.php?page=" . ($page + 1) : '#'); ?>">
              <span>&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
      <!--pagination end-->
    <?php
    }
    ?>
  </div>
</div>


<?php include "include/footer.php"; ?>
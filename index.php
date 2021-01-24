<?php include "include/header.php";
if (!isset($_SESSION['admin'])) {
  header('location: login.php?a_login=1');
}
if (isset($_GET['a_login']) && $_GET['a_login'] == 1) {
  Notification("Welcome To Admin Panel.", "2", $notify_icons['error']);
}
$query = "SELECT (SELECT COUNT(id) FROM users WHERE status = 1) AS all_users, (SELECT COUNT(id) FROM products) AS all_products, (SELECT COUNT(id) FROM category) AS all_category, (SELECT COUNT(id) FROM feedback) AS all_feedback";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$all_users = $row['all_users'];
$all_products = $row['all_products'];
$all_category = $row['all_category'];
$all_feedback = $row['all_feedback'];
?>

<div class="row my-3 justify-content-center">
  <div class="col-md-3 col-sm-6 col-auto mb-1">
    <div class="card bg-success text-center text-white my-shadow">
      <div class="card-body">
        <div class="row my-1">
          <div class="col-md-6 my-1"><i class="fa fa-users fa-3x"></i>
          </div>
          <div class="col-md-6 my-1">
            <h4><?php echo $all_users; ?></h4>
          </div>
        </div>
      </div>
      <div class="card-footer py-2">
        <a href="all_users.php" class="text-white">All Users</a>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-auto mb-1">
    <div class="card bg-primary text-center text-white my-shadow">
      <div class="card-body">
        <div class="row my-1">
          <div class="col-md-6 my-1"> <i class="fa fa-shopping-bag fa-3x "></i>
          </div>
          <div class="col-md-6 my-1">
            <h4><?php echo $all_products; ?></h4>
          </div>
        </div>
      </div>
      <div class="card-footer py-2">
        <a href="all_products.php" class="text-white">All Products</a>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-auto mb-1">
    <div class="card bg-warning text-center text-white my-shadow">
      <div class="card-body">
        <div class="row my-1">
          <div class="col-md-6 my-1"> <i class="fa fa-cubes fa-3x"></i>

          </div>
          <div class="col-md-6 my-1">
            <h4><?php echo $all_category; ?></h4>
          </div>
        </div>
      </div>
      <div class="card-footer py-2">
        <a href="add_category.php" class="text-white">Categories</a>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-auto mb-1">
    <div class="card text-center bg-dark text-white my-shadow">
      <div class="card-body">
        <div class="row my-1">
          <div class="col-md-6 my-1"><i class="fas fa-file-signature fa-3x"></i>
          </div>
          <div class="col-md-6 my-1">
            <h4><?php echo $all_feedback; ?></h4>
          </div>
        </div>
      </div>
      <div class="card-footer py-2">
        <a href="add_category.php" class="text-white">All Reviews</a>
      </div>
    </div>
  </div>
  <div class="col-md-12 mt-3">
    <table class="table table-bordered table-sm table-striped text-center">
      <thead class="bg-dark text-white">
        <tr>
          <td colspan='12'>
            <h4 class='text-white py-1 text-uppercase'>Recently Added Users</h4>
          </td>
        </tr>
        <tr>
          <th>SR No.</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Image</th>
          <th>Phone No.</th>
          <th>City</th>
          <th>Email</th>
          <th>Register</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT * FROM users WHERE status = 1 ORDER BY date_create DESC LIMIT 5";
        $run = mysqli_query($con, $query);
        if (mysqli_num_rows($run) > 0) {
          $count = 0;
          while ($row = mysqli_fetch_array($run)) {
            $name = $row['name'];
            $gender = $row['gender'];
            $image = $row['image'];
            $phone = $row['phone'];
            $city = $row['city'];
            $email = $row['email'];
            $date_create = date("g:i A", strtotime($row['date_create'])) . "<br>" . date("d-M-y", strtotime($row['date_create']));

            $count++;

            echo "
            <tr>
              <td>$count</td>
              <td>$name</td>
              <td>$gender</td>
              <td><img src='assets/imgs/users/$image' alt='image' class='tbl-img'></td>
              <td>$phone</td>
              <td>$city</td>
              <td>$email</td>
              <td class='small1'>$date_create</td>
            </tr>";
          }
        } else {
          echo "<tr><td colspan='8' class = 'h5 text-center text-dark py-3'>No User Found</td></tr>";
        }
        ?>

      </tbody>
    </table>
  </div>

</div>

<?php include "include/footer.php"; ?>
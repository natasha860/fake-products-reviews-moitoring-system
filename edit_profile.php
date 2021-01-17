<?php include "include/header.php";
if (isset($_SESSION['user'])) {
  $user_id = $_SESSION['user'];
} else {
  Notification("Please Login First !", "3", $notify_icons['error']);
}

if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $phone = $_POST['phone'];
  $city = $_POST['city'];
  $email = $_POST['email'];
  $old_pass = $_POST['old_pass'];
  $new_pass = $_POST['new_pass'];
  $c_new_pass = $_POST['c_new_pass'];

  if (empty($_POST['name'])) {
    Notification("Name Field is Empty !", "3", $notify_icons['error']);
  } elseif (empty($_POST['gender'])) {
    Notification("Must Select A Gender", "3", $notify_icons['error']);
  } elseif (empty($_POST['phone'])) {
    Notification("Please Enter Phone Number !", "3", $notify_icons['error']);
  } elseif (empty($_POST['city'])) {
    Notification("City Field is Empty !", "3", $notify_icons['error']);
  } elseif (empty($_POST['email'])) {
    Notification("Please Enter a Valid Email Address !", "3", $notify_icons['error']);
  } elseif (empty($_POST['old_pass'])) {
    Notification("Old Password Field Should Not Be Empty !", "3", $notify_icons['error']);
  } else {

    $query = "SELECT password FROM users WHERE id = '$user_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $old_pass_db = $row['password'];

    if ($old_pass == $old_pass_db) {
      if (!empty($new_pass) || !empty($c_new_pass)) {
        if ($new_pass == $c_new_pass) {
          $query = "UPDATE users SET name = '$name', gender = '$gender', phone = '$phone', address = '$address', city = '$city', email = '$email', password = '$new_pass', date_modify = NOW() WHERE id = '$user_id'";
          if (mysqli_query($con, $query)) {
            header('Location: index.php?update=1');
          } else {
            Notification("Registration Unsuccessful ! Please Try Again.", "3", $notify_icons['error']);
          }
        } else {
          Notification("New Password and Confirm New Password Not Match ! Please Try Again.", "3", $notify_icons['error']);
        }
      } else {
        $query = "UPDATE users SET name = '$name', gender = '$gender', phone = '$phone', address = '$address', city = '$city', email = '$email', date_modify = NOW() WHERE id = '$user_id'";
        echo $query;
        if (mysqli_query($con, $query)) {
          header('Location: index.php?update=2');
        } else {
          Notification("Registration Unsuccessful ! Please Try Again.", "3", $notify_icons['error']);
        }
      }
    } else {
      Notification("Old Password Does Not Match ! Please Try Again.", "3", $notify_icons['error']);
    }
  }
}
$old_pass = "";

$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_array($result);

  $name = $row['name'];
  $gender = $row['gender'];
  $image = $row['image'];
  $phone = $row['phone'];
  $address = $row['address'];
  $city = $row['city'];
  $email = $row['email'];
}


?>

<div class="row mt-3 justify-content-center">
  <div class="col-md-10">
    <div class="card">
      <h4 class="card-header bg-success text-center text-white font-weight-bold ">Register</h4>
      <div class="card-body">
        <form action="" class="form" method="POST" enctype="multipart/form-data">
          <div class="row justify-content-center">
            <div class="col-md-4">
              <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" name="name" id="full_name" class="form-control text-capitalize" value="<?php echo $name; ?>" autofocus>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control">
                  <option value="">Select</option>
                  <option value="Male" <?php echo $gender == 'Male' ? 'selected' : ''; ?>>Male</option>
                  <option value="Female" <?php echo $gender == 'Female' ? 'selected' : ''; ?>>Female</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="<?php echo $address; ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" value="<?php echo $city; ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="old_pass">Old Password</label>
                <input type="password" name="old_pass" id="old_pass" class="form-control" value="<?php echo $old_pass; ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="new_pass">New Password</label>
                <input type="password" name="new_pass" id="new_pass" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="c_new_pass">Confirm New Password</label>
                <input type="password" name="c_new_pass" id="c_new_pass" class="form-control" value="">
              </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-6 mt-2">
              <button type="submit" name="update" class="btn btn-outline-success btn-block">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




<?php include "include/footer.php"; ?>
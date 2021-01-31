<?php include "include/header.php";
if (isset($_SESSION['user'])) {
  $user_id = $_SESSION['user'];
} else {
  header("Location: login.php");
}

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
  $old_pass_db = $row['password'];
  $old_img_db = $row['image'];
  if (empty($_POST['new_pass'])) {
    $new_pass = $old_pass_db;
  }
}

if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
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
  } elseif (empty($_POST['address'])) {
    Notification("Please Enter Address !", "3", $notify_icons['error']);
  } elseif (empty($_POST['city'])) {
    Notification("City Field is Empty !", "3", $notify_icons['error']);
  } elseif (empty($_POST['email'])) {
    Notification("Empty Email Address !", "3", $notify_icons['error']);
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    Notification("Please Enter a Valid Email Address !", "3", $notify_icons['error']);
  } elseif (empty($_POST['old_pass'])) {
    Notification("Old Password Field Should Not Be Empty !", "3", $notify_icons['error']);
  } else {
    $is_error = false;
    $is_new_image = false;
    if (!empty($_FILES['image']['name'])) {
      $image = $_FILES['image']['name'];
      $image_tmp = $_FILES['image']['tmp_name'];
      $image_name = pathinfo($image, PATHINFO_FILENAME);
      $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
      $new_image_name = time() . "." . $image_ext;
      if ($image_ext == "jpg" || $image_ext == "jpeg" || $image_ext == "png") {
        if (!move_uploaded_file($image_tmp, "admin/assets/imgs/users/" . $new_image_name)) {
          $is_error = true;
          Notification("Image not uploaded.", "3", $notify_icons['error']);
        } else {
          $is_new_image = true;
        }
      } else {
        $is_error  = true;
        Notification("Image Formate Allow are JPG, JPEG & PNG.", "3", $notify_icons['error']);
      }
    } else {
      $new_image_name = $old_img_db;
      $is_new_image = false;
    }
    if ($old_pass != $old_pass_db) {
      $is_error  = true;
      Notification("Old Password is Incorrect ! Please Try Again.", "3", $notify_icons['error']);
    } elseif (!empty($_POST['new_pass'])) {
      if (empty($new_pass) && empty($c_new_pass)) {
        $is_error  = true;
        Notification("New Password Or Confirm New Password is Empty ! Please Try Again.", "3", $notify_icons['error']);
      } elseif ($_POST['new_pass'] != $_POST['c_new_pass']) {
        $is_error  = true;
        Notification("New Password and Confirm New Password Not Match ! Please Try Again.", "3", $notify_icons['error']);
      }
    }
    if (!$is_error) {
      $query = "UPDATE users SET name = '$name', gender = '$gender', phone = '$phone', address = '$address', city = '$city', email = '$email', date_modify = NOW() ";
      if (isset($new_image_name)) {
        $query .= ", image = '$new_image_name'";
      }
      if (!empty($_POST['new_pass'])) {
        $query .= ", password = '$new_pass'";
      }
      $query .= " WHERE id = $user_id";

      if (mysqli_query($con, $query)) {
        header("Location: index.php?update=1");
        if ($is_new_image) {
          $_SESSION['image'] = $new_image_name;
          unlink("admin/assets/imgs/users/" . $old_img_db);
        }
      } else {
        Notification("User's Profile Updation Unsuccessful ! Please Try Again.", "3", $notify_icons['error']);
        if ($is_new_image) {
          unlink("admin/assets/imgs/users/" . $new_image_name);
        }
      }
    }
  }
}
$old_pass = "";

?>
<div class="row my-3 justify-content-center">
  <div class="col-md-10">
    <div class="card">
      <h4 class="card-header bg-success text-center text-white font-weight-bold ">Update Profile</h4>
      <div class="card-body">
        <form action="" class="form" method="POST" enctype="multipart/form-data">
          <div class="row justify-content-center">
            <div class="col-md-4">
              <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" name="name" id="full_name" class="form-control" value="<?php echo $name; ?>" autofocus>
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
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" value="<?php echo $image; ?>">
              </div>
            </div>
            <div class="col-md-4 text-center">
              <a href="#" id="img_pop">
                <img id="img_view" src="admin/assets/imgs/users/<?php echo $image; ?>" class='rounded-circle text-center img-thumbnail tbl-img1' alt="image">
                Click to Enlarge
              </a>
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
            <div class="col-md-6">
              <div class="form-group">
                <label for="new_pass">New Password</label>
                <input type="password" name="new_pass" id="new_pass" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="c_new_pass">Confirm New Password</label>
                <input type="password" name="c_new_pass" id="c_new_pass" class="form-control" value="">
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-4 col-8 mt-1" id="myOrder2">
              <a href="all_products.php" class="btn btn-outline-success btn-block"><i class="fas fa-arrow-left"></i>&nbsp;Back</a>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-4 col-8 mt-1" id="myOrder1">
              <button type="submit" name="update" class="btn btn-outline-success btn-block">Update&nbsp;<i class="fas fa-pen-alt"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include "include/footer.php"; ?>
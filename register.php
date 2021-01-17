<?php include "include/header.php";

$name = $gender = $image = $phone = $address = $city = $email = $password = "";

if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($_POST['name'])) {
    Notification("Name Field is Empty !", "3", $notify_icons['error']);
  } elseif (empty($_POST['gender'])) {
    Notification("Must Select A Gender", "3", $notify_icons['error']);
  } elseif (empty($_FILES['image']['name'])) {
    Notification("Please Select A Profile Picture !", "3", $notify_icons['error']);
  } elseif (empty($_POST['phone'])) {
    Notification("Please Enter Phone Number !", "3", $notify_icons['error']);
  } elseif (empty($_POST['address'])) {
    Notification("Address Field Should Not Be Empty !", "3", $notify_icons['error']);
  } elseif (empty($_POST['city'])) {
    Notification("City Field is Empty !", "3", $notify_icons['error']);
  } elseif (empty($_POST['email'])) {
    Notification("Please Enter a Valid Email Address !", "3", $notify_icons['error']);
  } elseif (empty($_POST['password'])) {
    Notification("Password Field Should Not Be Empty !", "3", $notify_icons['error']);
  } else {
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_name = pathinfo($image, PATHINFO_FILENAME);
    $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $new_image_name = time() . "." . $image_ext;
    if ($image_ext == "jpg" || $image_ext == "jpeg" || $image_ext == "png") {
      if (move_uploaded_file($image_tmp, "admin/assets/imgs/users/" . $new_image_name)) {
        $query = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
          Notification("Email Already Exist ! Please Change Email or Go To Login Page.", "3", $notify_icons['error']);
        } else {
          $query = "INSERT INTO users VALUES(NULL, '$name', '$gender', '$new_image_name', '$phone', '$address', '$city', '$email', '$password', 0, NOW(), NOW())";
          if (mysqli_query($con, $query)) {
            header("Location: index.php?reg=1");
            $name = $gender = $phone = $address = $city = $email = $password = "";
          } else {
            Notification("Registration Unsuccessful ! Please Try Again.", "3", $notify_icons['error']);
            unlink("admin/assets/imgs/users/" . $new_image_name);
          }
        }
      } else {
        Notification("Could Not Upload Profile Picture !", "3", $notify_icons['error']);
      }
    } else {
      Notification("Wrong Image Extension ! Image Extension Allowed Only JPG, JPEG & PNG.", "3", $notify_icons['error']);
    }
  }
}



?>

<div class="row my-3 justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <h4 class="card-header bg-success text-center text-white font-weight-bold ">Register</h4>
      <div class="card-body">
        <form action="" class="form" method="POST" enctype="multipart/form-data">
          <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" name="name" id="full_name" class="form-control" value="<?php echo $name; ?>" autofocus>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control">
                  <option value="">Select</option>
                  <option value="Male" <?php echo $gender == 'Male' ? 'selected' : ''; ?>>Male</option>
                  <option value="Female" <?php echo $gender == 'Female' ? 'selected' : ''; ?>>Female</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" value="<?php echo $image; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="<?php echo $address; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" value="<?php echo $city; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" value="<?php echo $password; ?>">
              </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-6 mt-2">
              <button type="submit" name="register" class="btn btn-outline-success btn-block">Register</button>
            </div>
            <div class="col-md-12 text-center mx-auto mt-3">
              <span class="span">Already Have An Account ? <a href="login.php">Click Here</a> to Login</span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




<?php include "include/footer.php"; ?>
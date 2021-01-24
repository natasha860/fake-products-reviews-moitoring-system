<?php include 'include/header.php';
if (isset($_GET['a_login']) && $_GET['a_login'] == 1) {
  Notification("Please Provide Admin Credential To Access Admin Panel !", "3", $notify_icons['error']);
}


$email = $password = "";

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM admin WHERE email = '$email'";
  $run = mysqli_query($con, $query);
  if (mysqli_num_rows($run) != 1) {
    Notification("Email Does Not Exist !", "3", $notify_icons['error']);
  } else {
    $query = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $run = mysqli_query($con, $query);
    if (mysqli_num_rows($run) > 0) {
      $_SESSION['admin'] = true;
      header('Location: index.php?a_login=1');
    } else {
      Notification("Something is Wrong, Please Try Again !", "3", $notify_icons['error']);
    }
  }
}
?>

<div class="row mt-5 justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <h4 class="card-header bg-dark text-center text-white font-weight-bold text-uppercase">Admin Login</h4>
      <div class="card-body">
        <form class="form" action="" method="post">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>" autofocus>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" value="<?php echo $password; ?>" value="">
              </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-5 col-8">
              <button type="submit" name="login" class="btn btn-outline-dark btn-block">Login&nbsp;<i class="fas fa-sign-in-alt"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include 'include/footer.php'; ?>
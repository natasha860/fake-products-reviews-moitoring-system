<?php include "include/header.php";
if (isset($_GET['login']) && $_GET['login'] == 1) {
  Notification("Welcome User !", "2", $notify_icons['success']);
}
if (isset($_GET['reg']) && $_GET['reg'] == 1) {
  Notification("Registration Successful ! Please Login After Admin Approval.", "2", $notify_icons['success']);
}
if (isset($_GET['update']) && $_GET['update'] == 1) {
  Notification("Your Profile Successfully Updated With New Password.", "2", $notify_icons['success']);
} elseif (isset($_GET['update']) && $_GET['update'] == 2) {
  Notification("Your Profile Successfully Updated With Old Password.", "2", $notify_icons['success']);
}
?>





<?php include "include/footer.php"; ?>
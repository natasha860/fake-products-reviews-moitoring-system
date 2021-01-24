<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "fake_review_system";
$con = mysqli_connect($server, $username, $password, $db);

if (!$con) {
  die("Connection Failed !" . mysqli_connect_error());
}

ob_start();
session_start();
date_default_timezone_set('Asia/Karachi');

$is_notify = false;
$notify = array();
$notify['message'] = "";
$notify['color'] = "";
$notify['icon'] = "";
$notify_icons = array();
$notify_icons['info'] = "notifications";
$notify_icons['success'] = "check_circle";
$notify_icons['error'] = "error";

<?php 
function Notification($message, $color_value, $notify_icon){
  global $is_notify, $notify;
  $is_notify = true;
  $notify['message'] = $message;
  $notify['color'] = $color_value;
  $notify['icon'] = $notify_icon;
}

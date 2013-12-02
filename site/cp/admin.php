<?php 
require_once '../classes/functions.php';

if (!is_admin()) {
  die("NO CHEATING");
}

$action = $_REQUEST["action"];

include '../header.php'; ?>

<?php 

switch ($action) {
  case 'verify':
    $device_id = $_REQUEST["device"];
    $device = Device::find("device_id=$device_id");
    $device->verify();
    break;

  case 'search':
    include 'search.php';
    break;

  case 'edit':
    include 'edit.php';
    break;
  
  default:
    # code...
    break;
}

?>

<?php include '../footer.php'; ?>

<?php 
require_once '../functions.php';

if (!is_admin()) {
  die("NO CHEATING");
}

$action = (!isset($_REQUEST["action"]) ? "" :  $_REQUEST["action"]);

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

  case 'add':
    include 'add.php';
    break;

  case 'edit':
    include 'edit.php';
    break;
  
  default:
    ?>
          <div class="jumbotron">
            <h1>Hello Admin!</h1>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <form class="col-lg-12 form-inline form-search pull-right" action>
                  <div class="form-group col-lg-9">
                    <input type="text" class="form-control input-lg" placeholder="Search for devices" name="search" id="search">
                    <input type="hidden" name="action" value="search">
                  </div>
                  <button type="submit" class="btn btn-primary" style="padding: 6px 12px;">Search</button>
                </form>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <h2>OR</h2>
                <a href="admin.php?action=add" class="btn btn-success">Add new device</a>
              </div>
            </div>
          </div>
    <?php
    break;
}

?>

<?php include '../footer.php'; ?>

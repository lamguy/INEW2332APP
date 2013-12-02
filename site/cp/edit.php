<?php 

  if (!empty($_REQUEST["device"])) {
    $device = Device::find("device_id=" . $_REQUEST['device']);

    $device_id        = $device->device_id;
    $device_name      = $device->device_name;
    $mac_address      = $device->mac_address;
    $device_status    = $device->device_status;
    $device_type      = $device->device_type;
    $os_system        = $device->os_system;
    $os_version       = $device->os_version;
    $latest_request   = $device->latest_request;
  }
?>

      <div class="row">
        <div class="col-lg-12">
          <h1>Edit device</h1>
        <?php
        
        if (Flash::hasFlashes()) {
            $flashes = Flash::getFlashes();
            echo $flashes;
        }
        
        ?>
        </div>
      </div>
      <div class="row registration">
        <div class="col-lg-12">
          <?php 

          if($_SERVER['REQUEST_METHOD']=="POST") {
              $device_name        = (isset($_POST['device_name']) ? $_POST['device_name'] : '');
              $device_status      = (isset($_POST['device_status']) ? $_POST['device_status'] : '');
              $mac_address        = (isset($_POST['mac_address']) ? $_POST['mac_address'] : '');
              $device_type        = (isset($_POST['device_type']) ? $_POST['device_type'] : '');
              $os_system          = (isset($_POST['os_system']) ? $_POST['os_system'] : '');
              $os_version         = (isset($_POST['os_version']) ? $_POST['os_version'] : '');
              
              $device->update($device_id, $mac_address, $device_name, $device_status, $device_type, $os_system, $os_version);
          }

          ?>


        <?php
        
        if (Flash::hasFlashes()) {
            $flashes = Flash::getFlashes();
            echo $flashes;
        }
        
        ?>

          <form class="form-horizontal" method="post" action="">
            <fieldset>
              <!-- Form Name -->
              <legend>Device Information</legend>
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="os_version">Device Status</label>
                <div class="col-md-4">
                  <label class="radio-inline" for="device_status-0">
                    <input type="radio" name="device_status" id="device_status-0" value="active" <?php echo ($device_status == 'active' ? 'checked' : ''); ?>><span class="label label-success">Active</span> </label> <br>
                  <label class="radio-inline" for="device_status-1">
                    <input type="radio" name="device_status" id="device_status-1" value="inactive" <?php echo ($device_status == 'inactive' ? 'checked' : ''); ?>><span class="label label-warning">Inactive</span> </label> <br>
                  <label class="radio-inline" for="device_status-2">
                    <input type="radio" name="device_status" id="device_status-2" value="revoked"  <?php echo ($device_status == 'revoked' ? 'checked' : ''); ?>><span class="label label-danger">Revoked</span> </label>
                </div>
              </div>
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="device_name">Device Name:</label>
                <div class="col-md-5">
                  <input id="device_name" name="device_name" type="text" placeholder="Your device name" class="form-control input-md" required value="<?php echo $device_name; ?>">
                </div>
              </div>
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="mac_address">MAC Address</label>
                <div class="col-md-5">
                  <input id="mac_address" name="mac_address" type="text" placeholder class="form-control input-md" required value="<?php echo $mac_address; ?>">
                </div>
              </div>
              <!-- Multiple Radios (inline) -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="device_type">Device Type:</label>
                <div class="col-md-4">
                  <label class="radio-inline" for="device_type-0">
                    <input type="radio" name="device_type" id="device_type-0" value="laptop" <?php echo ($device_type == 'laptop' ? 'checked' : ''); ?>>Laptop</label> <br>
                  <label class="radio-inline" for="device_type-1">
                    <input type="radio" name="device_type" id="device_type-1" value="mobile" <?php echo ($device_type == 'mobile' ? 'checked' : ''); ?>>Mobile</label>
                </div>
              </div>
              <!-- Multiple Radios (inline) -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="os_system">Operating System:</label>
                <div class="col-md-4">
                  <label class="radio-inline" for="os_system-0">
                    <input type="radio" name="os_system" id="os_system-0" value="android" <?php echo ($os_system == 'android' ? 'checked' : ''); ?>>Android</label> <br>
                  <label class="radio-inline" for="os_system-1">
                    <input type="radio" name="os_system" id="os_system-1" value="ios" <?php echo ($os_system == 'ios' ? 'checked' : ''); ?>>iOS</label> <br>
                  <label class="radio-inline" for="os_system-2">
                    <input type="radio" name="os_system" id="os_system-2" value="windows"  <?php echo ($os_system == 'windows' ? 'checked' : ''); ?>>Windows</label>
                </div>
              </div>
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="os_version">OS Version</label>
                <div class="col-md-5">
                  <input id="os_version" name="os_version" type="text" placeholder="Version of the operating system" class="form-control input-md" required value="<?php echo $os_version; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-8">
                  <button id="submit" name="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>

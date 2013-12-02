<?php include 'classes/functions.php'; ?>
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
<?php include 'header.php'; ?>

      <div class="row">
        <div class="col-lg-12">
          <h1>Edit your device</h1>
          <div class="alert alert-dismissable alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <b>Help!</b> Our security policy does not allow users to change their devices's mac addresses. Please contact our security department if you have to change the mac address of your devices.
          </div>
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
              $device_type        = (isset($_POST['device_type']) ? $_POST['device_type'] : '');
              $os_system          = (isset($_POST['os_system']) ? $_POST['os_system'] : '');
              $os_version         = (isset($_POST['os_version']) ? $_POST['os_version'] : '');
              
              $device->update($device_id, $device_name, $device_status="Inactive", $device_type, $os_system, $os_version);
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
              <legend>Your Device Information</legend>
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="device_name">Device Status:</label>
                <div class="col-md-5">
                  <?php switch ($device->device_status) {
                    case 'active':
                      $status = "success";
                      break;
                    case 'inactive':
                      $status = "warning";
                      break;
                    
                    default:
                      $status = "danger";
                      break;
                  }  ?>
                  <span class="label label-<?php echo $status; ?>"><?php echo $device->device_status; ?></span>
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
                  <span><?php echo $mac_address; ?></span>
                  <span class="help-block">Cannot change mac address.</span> 
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
              <!-- Button (Double) -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-8">
                  <button id="submit" name="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </fieldset>
          </form>
          <hr>
          <form class="form-horizontal" method="post" action="request.php">
          <fieldset>

          <!-- Button (Double) -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="activate"></label>
            <div class="col-md-8">
              <p>You can request to activate or deactivate your device!</p>
            </div>
          </div>

          <!-- Button (Double) -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="activate">Request</label>
            <div class="col-md-8">
              <?php if($device_status == "active") : ?>
              <button id="revoked" name="action" value="revoke" <?php echo ($latest_request == 'revoke' ? 'disabled' : ''); ?> class="btn btn-danger">Revoke<?php echo ($latest_request == 'revoke' ? ' request sent!' : ''); ?></button>
              <?php endif; ?>
              <?php if($device_status == "revoked") : ?>
              <button id="revoked" name="action" value="activate" <?php echo ($latest_request == 'activate' ? 'disabled' : ''); ?> class="btn btn-success">Activate<?php echo ($latest_request == 'activate' ? ' request sent!' : ''); ?></button>
              <?php endif; ?>
              <input type="hidden" name="device_id" value="<?php echo $device_id; ?>">
            </div>
          </div>

          </fieldset>
          </form>
        </div>
      </div>

<?php include 'footer.php'; ?>

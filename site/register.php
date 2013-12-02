<?php include 'classes/functions.php'; ?>
<?php include 'header.php'; ?>

      <div class="row">
        <div class="col-lg-12">
          <h1>Register your device</h1>
          <div class="alert alert-dismissable alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <b>Help!</b> If you are not registering using the device you wanted to register to the system, you have to enter MAC address of the device to the Mac address field.
          </div>
        </div>
      </div>
      <div class="row registration">
        <div class="col-lg-12">
          <?php 

          if($_SERVER['REQUEST_METHOD']=="POST") {
              $mac_address        = (isset($_POST['mac_address']) ? $_POST['mac_address'] : null);
              $device_name        = (isset($_POST['device_name']) ? $_POST['device_name'] : '');
              $os_system          = (isset($_POST['os_system']) ? $_POST['os_system'] : '');
              $os_version         = (isset($_POST['os_version']) ? $_POST['os_version'] : '');
              $device_type        = (isset($_POST['device_type']) ? $_POST['device_type'] : '');
              
              $device = new Device();
              $device->add($device_name, $mac_address, "Inactive", $device_type, $os_system, $os_version);
          } else {
              $mac_address      = get_mac_address();
              $device_name      = null;
              $device_status    = "Inactive";
              $os_system        = null;
              $os_version       = null;
              $device_type      = null;
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
                <label class="col-md-4 control-label" for="device_name">Device Name:</label>
                <div class="col-md-5">
                  <input id="device_name" name="device_name" type="text" placeholder="Your device name" class="form-control input-md" required>
                </div>
              </div>
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="mac_address">MAC Address</label>
                <div class="col-md-5">
                  <input id="mac_address" name="mac_address" type="text" placeholder class="form-control input-md" required value="<?php echo $mac_address; ?>">
                  <span class="help-block">To find your MAC address, click <a href="faq.php">here</a></span> 
                </div>
              </div>
              <!-- Multiple Radios (inline) -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="device_type">Device Type:</label>
                <div class="col-md-4">
                  <label class="radio-inline" for="device_type-0">
                    <input type="radio" name="device_type" id="device_type-0" value="laptop" checked="checked">Laptop</label> <br>
                  <label class="radio-inline" for="device_type-1">
                    <input type="radio" name="device_type" id="device_type-1" value="mobile">Mobile</label>
                </div>
              </div>
              <!-- Multiple Radios (inline) -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="os_system">Operating System:</label>
                <div class="col-md-4">
                  <label class="radio-inline" for="os_system-0">
                    <input type="radio" name="os_system" id="os_system-0" value="android" checked="checked">Android</label> <br>
                  <label class="radio-inline" for="os_system-1">
                    <input type="radio" name="os_system" id="os_system-1" value="ios">iOS</label> <br>
                  <label class="radio-inline" for="os_system-2">
                    <input type="radio" name="os_system" id="os_system-2" value="windows">Windows</label>
                </div>
              </div>
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="os_version">OS Version</label>
                <div class="col-md-5">
                  <input id="os_version" name="os_version" type="text" placeholder="Version of the operating system" class="form-control input-md" required>
                </div>
              </div>
              <!-- Button (Double) -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="submit"></label>
                <div class="col-md-8">
                  <button id="submit" name="submit" class="btn btn-primary">Register My Device</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>

<?php include 'footer.php'; ?>

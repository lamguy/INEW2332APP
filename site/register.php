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
          <form class="form-horizontal" method="post" action="thankyou.html">
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
                  <input id="mac_address" name="mac_address" type="text" placeholder class="form-control input-md" required>
                  <span class="help-block">To find your MAC address, click <a href="howto-macaddress.html">here</a></span> 
                </div>
              </div>
              <!-- Multiple Radios (inline) -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="os_name">Operating System:</label>
                <div class="col-md-4">
                  <label class="radio-inline" for="os_name-0">
                    <input type="radio" name="os_name" id="os_name-0" value="android" checked="checked">Android</label>
                  <label class="radio-inline" for="os_name-1">
                    <input type="radio" name="os_name" id="os_name-1" value="ios">iOS</label>
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
                  <button id="submit" name="submit" class="btn btn-success">Register My Device</button>
                  <button id="reset" name="reset" class="btn btn-danger">Cancel</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>

<?php include 'footer.php'; ?>

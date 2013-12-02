<?php 
include 'classes/functions.php';
include 'header.php';
?>

      <div class="row">
        <div class="col-lg-12">
          <a class="btn pull-right btn-success" href="register.html">Regiser new device</a><h1>Your Devices</h1>

          <?php if(is_valid_mac_address()) : ?>

          <?php 

            $devices = $_SESSION["devices"];


           ?>

          <p>Here is the list of your devices. You can review your devices to register a new devices or de-register a device.</p>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th width="30%">Device name</th>
                <th width="30%">MAC address</th>
                <th width="15%">Status</th>
                <th width="15%"></th>
              </tr>
            </thead>
            <tbody>

              <?php 
              foreach ($devices as $key => $device) :
              ?>

              <tr>
                <td><?php echo $device->device_name; ?></td>
                <td><?php echo $device->mac_address; ?></td>
                <td>
                  <?php $status = ($device->device_status == "Active" ? "success" : "warning");  ?>
                  <span class="label label-<?php echo $status; ?>"><?php echo $device->device_status; ?></span>
                </td>
                <td>
                  <div class="btn-group btn-group-xs">
                    <a class="btn btn-default" data-toggle="dropdown" href="#">Action</a><a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">                      <span class="caret"></span>                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="#">Edit</a>
                      </li>
                      <li>
                        <a href="#">De-register</a>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
              <?php 
              endforeach;
              ?>
            </tbody>
          </table>
          <?php else : ?>
          <div class="alert alert-danger">
            <p>You have not registered any device. Please follow our <a href="policy.php">security policy</a> to register one.</p>
          </div>
          <?php endif; ?>
        </div>
      </div>

<?php include 'footer.php'; ?>
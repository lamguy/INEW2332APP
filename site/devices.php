<?php 

require_once 'functions.php';

include 'header.php'; ?>

      <div class="row">
        <div class="col-lg-12">
          <a class="btn pull-right btn-success" href="register.php">Regiser new device</a><h1>Your Devices</h1>

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
                </td>
                <td>
                  <a href="edit.php?device=<?php echo $device->device_id; ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</button>
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
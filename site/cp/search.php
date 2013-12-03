      <div class="row">
        <div class="col-lg-12">
          <form class="col-lg-5 form-inline form-search pull-right" action="">
            <div class="form-group">
              <?php $search_query = (!isset($_REQUEST["search"]) ? "" : $_REQUEST["search"]); ?>
              <input type="search" class="form-control" id="search" placeholder="Search for devices" name="search" value="<?php echo $search_query; ?>">
              <input type="hidden" name="action" value="search">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
          </form>
          <h1>Search Devices</h1>

          <?php

            if(!empty($_REQUEST["search"])) {
              $search_query = $_REQUEST["search"];
              $devices = Device::search($search_query);
            } else {
              $devices = Device::find_all();
            }

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
                  <a href="admin.php?action=edit&amp;device=<?php echo $device->device_id; ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</button>
                </td>
              </tr>
              <?php 
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
      </div>
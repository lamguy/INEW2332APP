<?php include 'header.php'; ?>

      <div class="row">
        <div class="col-lg-12">
          <a class="btn pull-right btn-success" href="register.html">Regiser new device</a><h1>Your Devices</h1>
          <p>Here is the list of your devices. You can review your devices to register a new devices or de-register a device.</p>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th width="35%">Device name</th>
                <th width="33%">MAC address</th>
                <th width="12%">Status</th>
                <th width="15%"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Lam's iPhone</td>
                <td>AA:BB:CC:DD</td>
                <td>
                  <span class="label label-success">Active</span>
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
              <tr>
                <td>2</td>
                <td>Lam's S4</td>
                <td>BB:EE:FF:GG</td>
                <td>
                  <span class="label label-warning">On Hold</span>
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
            </tbody>
          </table>
        </div>
      </div>

<?php include 'footer.php'; ?>
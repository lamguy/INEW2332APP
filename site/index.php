<?php 

include 'classes/functions.php';


if (!is_valid_mac_address() && basename($_SERVER['PHP_SELF']) != 'register.php') {
  header("Location: warning.php");
} else {
  header("Location: files.php");
}

include 'header.php'; ?>

      <div class="jumbotron">
        <h1>Files Management</h1>
        <p class="lead">To download, upload files from company file server, it requires your devices have to be validated and registered through our security policy.</p>
        <p><a class="btn btn-success btn-lg" href="register.php">Register your device</a></p>
      </div>
      <div class="row marketing">
        <div class="col-lg-6">
          <h4>Complete registration page</h4>
          <p>It is required that you have to complete the form including your device versions, operating system...</p>
        </div>
        <div class="col-lg-6">
          <h4>Request security team to clear</h4>
          <p>When you have completed the registration, your devices will be on hold before it get cleared by security team.</p>
        </div>
      </div>

<?php include 'footer.php'; ?>

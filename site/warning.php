<?php 

require_once 'functions.php';

if (is_valid_mac_address() && is_activated()) {
  header("Location: files.php");
}

include 'header.php'; ?>

      <div class="jumbotron">
        <h1>Your Device is Not Recognized</h1>
        <p class="lead">To download files from company file server, it requires your devices have to be validated and registered through our <a href="policy.php">security policy</a>.</p>
        <p><a class="btn btn-success btn-lg" href="register.php">Register your device</a></p>
      </div>

<?php include 'footer.php'; ?>

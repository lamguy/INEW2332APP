      <div class="footer">
        <p>&copy; Circle Square 2013</p>
        <p><a href="faq.php">FAQs</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="policy.php">Policy</a>
        	<?php 

        	if(!is_admin()) {
        		echo '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="devices.php" class="label label-primary">Your Devices</a>';
        	}

        	if (is_valid_mac_address()) {
        		echo '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="files.php" class="label label-success"><span class="glyphicon glyphicon-circle-arrow-down"></span>  Files</a></p>';
        	}
        	?>
      </div>
    </div>
    <!-- /container -->
  </body>

</html>
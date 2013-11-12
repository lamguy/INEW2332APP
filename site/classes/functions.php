<?php 

session_start();
if (!is_valid_mac_address()) {
	header("Location: warning.php");
	die("dasdsads");
}

require 'class.database.php';

$db = new Database();
$db->connect();

require 'classes/class.device.php';


function is_valid_mac_address()
{
	$valid = false;
	$mac_address_from_device = "223213141414124";



/*	#2 Get the mac address of current device

	$ipAddress=$_SERVER["REMOTE_ADDR"];

	#run the external command, break output into lines
	$arp="arp -a $ipAddress";
	$lines=explode("\n", $arp);

	#look for the output line describing our IP address
	foreach($lines as $line)
	{
	   $cols=preg_split("/\s+/", trim($line));
	   if ($cols[0]==$ipAddress)
	   {
	   		$mac_address_from_device = $cols[1];
	   }
	}*/


	if ($mac_address_from_device != null) {
		$valid = false;
	} else {
		
		$device = new Device("mac_address='" + $mac_address_from_device + "'");
		#3 Check if mac address from this device has a record in the dabase
		if($device != null) {
			$valid = true;
		} else {
			$valid = false;
		}

	}

	return $valid;
}


function flash($message) {
	$_SESSION['message'] = $message;

	echo $_SESSION['message'];
	$_SESSION['message'] = '';
}

?>
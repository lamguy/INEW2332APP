<?php 

session_start();

require_once 'class.database.php';

$db = new Database();
$db->connect();

require_once 'class.flash.php';
require_once 'class.device.php';

if (!is_valid_mac_address()) {
	header("Location: warning.php");
}


function is_valid_mac_address()
{
	$valid = false;
	$mac_address_from_device = get_mac_address();


	$device = Device::find("mac_address='$mac_address_from_device'");
	#3 Check if mac address from this device has a record in the dabase
	if($device) {
		$valid = true;
	} else {
		$valid = false;
	}

	return $valid;
}

function get_mac_address() {

	$ipAddress=$_SERVER["REMOTE_ADDR"];

	exec('arp -n ' . $ipAddress, $user_mac);
	
	$mac_address_from_device = substr($user_mac[0],strpos($user_mac[0],':')-2, '17');

	return trim($mac_address_from_device);

}


function getFileList($dir)
{
	// array to hold return value
	$retval = array();

	// add trailing slash if missing
	if(substr($dir, -1) != "/") $dir .= "/";

	// open pointer to directory and read list of files
	$d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");
	while(false !== ($entry = $d->read())) {
	  // skip hidden files
	  if($entry[0] == ".") continue;
	  if(is_dir("$dir$entry")) {
	    $retval[] = array(
	      "name" => "$dir$entry/",
	      "type" => filetype("$dir$entry"),
	      "size" => 0,
	      "lastmod" => filemtime("$dir$entry")
	    );
	  } elseif(is_readable("$dir$entry")) {
	    $retval[] = array(
	      "name" => "$dir$entry",
	      "type" => mime_content_type("$dir$entry"),
	      "size" => filesize("$dir$entry"),
	      "lastmod" => filemtime("$dir$entry")
	    );
	  }
	}
	$d->close();

	return $retval;
}

?>
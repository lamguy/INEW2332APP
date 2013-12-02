<?php 

session_start();

require_once 'classes/class.database.php';

$db = new Database();
$db->connect();

require_once 'classes/class.flash.php';
require_once 'classes/class.user.php';
require_once 'classes/class.device.php';


function is_valid_mac_address()
{
	$valid = false;
	$mac_address_from_device = get_mac_address();


	$device = Device::find("mac_address='$mac_address_from_device'");
	#3 Check if mac address from this device has a record in the dabase
	if($device) {
		$valid = true;
		init();
	} else {
		$valid = false;
	}

	return $valid;
}

function get_mac_address() {

	$ipAddress=$_SERVER["REMOTE_ADDR"];

	exec('/usr/sbin/arp -n ' . $ipAddress, $user_mac);
	
	$mac_address_from_device = substr($user_mac[1],strpos($user_mac[1],':')-2, '17');

	return trim($mac_address_from_device);

}

function init() {
	$user = User::find_by_device(get_mac_address());
	//die($user->user_id);

	$devices = Device::find_all(
		array("user" => $user)
		);

	$_SESSION["user"] = $user;
	$_SESSION["devices"] = $devices;
}

function is_admin()
{
	if(get_mac_address() == "c8:2a:14:3f:90:12")
		return true;
	else
		return false;
}

function home_url($path="") {
	$https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
	return
	    ($https ? 'https://' : 'http://').
	    (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
	    (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
	    ($https && $_SERVER['SERVER_PORT'] === 443 ||
	    $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
	    substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/')).$path;
}

function redirect($page) {
    header('Location: ' . $page);
    exit();
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
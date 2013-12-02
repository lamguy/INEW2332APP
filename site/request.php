<?php 
require_once 'functions.php';

if($_SERVER["REQUEST_METHOD"] != "POST")
	die("NO CHEATING");

$action = $_REQUEST["action"];
$device_id = $_REQUEST["device_id"];
$device = Device::find("device_id=$device_id");

switch ($action) {

	case 'activate':
		$device->request($device_id, "activate");
		break;

	case 'revoke':
		$device->request($device_id, "revoke");
		break;
	
	default:
		break;
}

?>
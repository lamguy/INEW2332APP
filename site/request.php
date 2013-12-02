<?php 
require_once 'classes/functions.php';

if($_SERVER["REQUEST_METHOD"] != "POST")
	die("NO CHEATING");

$action = $_REQUEST["action"];
$device_id = $_REQUEST["device_id"];
$device = Device::find("device_id=$device_id");

switch ($action) {
	case 'activate':
		break;

	case 'deactivate':
		$device->request($device_id, $action);
		break;
	
	default:
		break;
}

?>
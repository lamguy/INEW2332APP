<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `device` (
	`deviceid` int(11) NOT NULL auto_increment,
	`device_id` INT NOT NULL,
	`user_id` INT NOT NULL,
	`mac_address` VARCHAR(255) NOT NULL,
	`device_name` VARCHAR(255) NOT NULL,
	`device_status` INT NOT NULL,
	`register_date` DATE NOT NULL,
	`activate_date` DATE NOT NULL,
	`deactivate_date` DATE NOT NULL,
	`deregister_date` DATE NOT NULL,
	`device_type` INT NOT NULL,
	`device_specify` VARCHAR(255) NOT NULL,
	`os_system` INT NOT NULL,
	`os_version` VARCHAR(255) NOT NULL,
	`create_date` DATETIME NOT NULL,
	`modify_date` DATETIME NOT NULL, PRIMARY KEY  (`deviceid`)) ENGINE=MyISAM;
*/

/**
* <b>Device</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Device&attributeList=array+%28%0A++0+%3D%3E+%27device_id%27%2C%0A++1+%3D%3E+%27user_id%27%2C%0A++2+%3D%3E+%27mac_address%27%2C%0A++3+%3D%3E+%27device_name%27%2C%0A++4+%3D%3E+%27device_status%27%2C%0A++5+%3D%3E+%27register_date%27%2C%0A++6+%3D%3E+%27activate_date%27%2C%0A++7+%3D%3E+%27deactivate_date%27%2C%0A++8+%3D%3E+%27deregister_date%27%2C%0A++9+%3D%3E+%27device_type%27%2C%0A++10+%3D%3E+%27device_specify%27%2C%0A++11+%3D%3E+%27os_system%27%2C%0A++12+%3D%3E+%27os_version%27%2C%0A++13+%3D%3E+%27create_date%27%2C%0A++14+%3D%3E+%27modify_date%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27INT%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27INT%27%2C%0A++5+%3D%3E+%27DATE%27%2C%0A++6+%3D%3E+%27DATE%27%2C%0A++7+%3D%3E+%27DATE%27%2C%0A++8+%3D%3E+%27DATE%27%2C%0A++9+%3D%3E+%27INT%27%2C%0A++10+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++11+%3D%3E+%27INT%27%2C%0A++12+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++13+%3D%3E+%27DATETIME%27%2C%0A++14+%3D%3E+%27DATETIME%27%2C%0A%29
*/

class Device
{
	public $deviceId = '';

	/**
	 * @var INT
	 */
	public $device_id;
	
	/**
	 * @var INT
	 */
	public $user_id;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $mac_address;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $device_name;
	
	/**
	 * @var INT
	 */
	public $device_status;
	
	/**
	 * @var DATE
	 */
	public $register_date;
	
	/**
	 * @var DATE
	 */
	public $activate_date;
	
	/**
	 * @var DATE
	 */
	public $deactivate_date;
	
	/**
	 * @var DATE
	 */
	public $deregister_date;
	
	/**
	 * @var INT
	 */
	public $device_type;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $device_specify;
	
	/**
	 * @var INT
	 */
	public $os_system;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $os_version;
	
	/**
	 * @var DATETIME
	 */
	public $create_date;
	
	/**
	 * @var DATETIME
	 */
	public $modify_date;
	
	
    public function __construct() {
    }

    public function __destruct() {
        //Not sure if it destroys the object completely
        //It is still a controversy 
        unset($this);
    }
    
    public function __set($name, $value) 
    {
        if(property_exists($this, $name) && (strpos($name, "pri_") !== 0))
            $this->{$name} = $value;
    }
    
    public function __get($name) 
    {
        if(property_exists($this, $name) && (strpos($name, "pri_") !== 0))
            return $this->{$name};
    }
    
    public static function find($where)
    {
        global $db;
        
        if($db->select('devices', '*', $where)) {
        	if(sizeof($db->getResult()) == 0) {
        		//die(var_dump($db->getResult()));
        		return false;
        	} else {
	        	$device = new Device();
	            foreach ($db->getResult() as $key => $value)
	            {
	                $device->{$key} = $value;
	            }
	            return $device;

        	}
        } else {
            die(mysqli_error($db->con));
        }
    }

    public static function find_all($args=array(), $offset=false, $limit=false) {
        global $db;

        extract($args);

        //die($user);

        $query = "SELECT d.* 
                    FROM devices as d 
                    WHERE d.user_id = $user->user_id";

        $db->query($query);

        $devices = array();

        if($db->getNumResults() == 1) {
            $fetched_device = new Device();
            foreach ($db->getResult() as $key => $value)
            {
                $fetched_device->{$key} = $value;
            }
            array_push($devices, $fetched_device);

        } elseif ($db->getNumResults() > 1) {
            foreach ($db->getResult() as $device)
            {
                $fetched_device = new Device();
                foreach ($device as $key => $value) {
                    $fetched_device->{$key} = $value;
                }
                array_push($devices, $fetched_device);
            }
        }

        return $devices;
    }
    
    public function add($device_name, $mac_address, $device_status="Inactive", $device_type, $os_name, $os_version)
    {
        global $db;

        $current_date = date ("Y-m-d");


        if($db->insert('devices', 
        	array(
        		0, 
        		1, 
        		$mac_address, 
        		$device_name, 
        		$device_status, 
        		$current_date, 
        		NULL, 
        		NULL, 
        		NULL, 
        		$device_type, 
        		$os_name, 
        		$os_version, 
        		$current_date, 
        		$current_date)))
        {
            echo Flash::addFlash('success','Device added sucessfully!');
        } else {
            echo mysqli_error($db->con);
        }
    }
}
?>
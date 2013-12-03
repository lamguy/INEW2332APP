<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author me
 */
class User
{
    //put your code here
    private $user_id = null;
    private $employee_id = null;
    private $first_name = '';
    private $last_name = '';
    private $password = '';
    private $create_date = null;
    private $modify_date = null;
    private $devices;
    
    public function __construct() {
    }

    public function __destruct() {
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
    
    public function find($user_id)
    {
        global $db;
        
        if($db->select('users', '*', "user_id=$user_id")) {
            foreach ($db->getResult() as $key => $value)
            {
                $this->{$key} = $value;
            }
        } else {
            return false;
        }
    }

    public static function find_by_employee_id($employee_id) {
        global $db;
        
        if($db->select('users', '*', "employee_id='$employee_id'")) {
            $fetched_user = new User();
            foreach ($db->getResult() as $key => $value) {
                $fetched_user->{$key} = $value;
            }

            //die(var_dump($db->getResult()));

            return $fetched_user;
        } else {
            return false;
        }
    }

    public static function find_by_device($mac_address)
    {
        global $db;

        $query = "SELECT u.*, d.* FROM users as u, devices as d 
                                  WHERE u.user_id=d.user_id 
                                  AND d.mac_address = '$mac_address' GROUP BY u.user_id";
        
        //die($query);

        if($db->query($query)) {

            $fetched_user = new User();

            
            foreach ($db->getResult() as $user)
            {
                foreach ($user as $key => $value) {
                    $fetched_user->{$key} = $value;
                }
            }

            return $fetched_user;

        } else {

            return false;

        }
    }

    public static function findAll($name='', $offset=false, $limit=false) {
        global $db;
        
        if ($name) {
            $db->select('users', '*', "item_name=$name");
        } else {
            $db->select('users');
        }
        
        if(count($db->getResult()) > 0) {
            $users = array();
            foreach ($db->getResult() as $user)
            {
                $fetchedUser = new User();
                foreach ($user as $key => $value) {
                    $fetchedUser->{$key} = $value;
                }
                array_push($users, $fetchedUser);
            }
            return $users;
        } else {
            return false;
        }
    }
    
    

    /**
     * Check if user logged in
     *
     * @return boolean
     * @author 
     **/
    public static function logged_in()
    {
        if (!array_key_exists('user', $_SESSION)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Login user by email and password. Binding parameter to avoid SQL injection
     *
     * @return boolean
     * @author 
     **/
    public static function login($email, $password) {
        global $db;

        $hashed_password = md5($password);

        // TODO: Need to re-write Database to avoid sql-injection when selecting
        // Temporariry use this query to check password
        $query = "SELECT * FROM users WHERE email=? AND password=?";

        if($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "ss", $email, $hashed_password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result(
                    $stmt, 
                    $userId, 
                    $lastName, 
                    $firstName, 
                    $email, 
                    $password,
                    $userLevel 
            );

            if(mysqli_stmt_fetch($stmt))
            {
                $_SESSION['user'] = array(
                    'userId'		=> $userID, 
                    'lastName'		=> $lastName, 
                    'firstName'		=> $firstName,
                    'email'		=> $email, 
                    'password'          => $password,
                    'userlevel'		=> $userlevel
                );
                        
                Flash::addFlash('success','Logged in!');

                $id = mysqli_insert_id($link);
                Utils::redirect('index.php');
                exit();
            } else {
                return false;
            }

        }
    }
    
    public function add($lastName, $firstName, $email, $password, $repassword, $userLevel)
    {
        global $db;

        if(!is_admin())
            die('Not enough privileges');

        if(empty($lastName) || empty($firstName) || empty($email) || 
            empty($password) || empty($repassword) || $userLevel<1) {
            $_SESSION['errors']['message'] = "All field are required!";
            Flash::addFlash('alert', $_SESSION['error']['message']);
            return false;
        }

        if(!Validate::password($password, $repassword)) {
            $_SESSION['errors']['password'] = "Password not matched!";
        }

        if (!Validate::name($firstName)) {
            $_SESSION['errors']['firstName'] = "Not a valid name!";
        }

        if (!Validate::name($lastName)) {
            $_SESSION['errors']['lastName'] = "Not a valid name!";
        }

        if (!Validate::email($email)) {
            $_SESSION['errors']['email'] = "Not a valid email!";
        }

        if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0)
        {
            Flash::addFlash('alert', 'Check error below!');
            var_dump($_SESSION['errors']);
            return false;
        }



        if($db->insert('users', array('', $lastName, $firstName, $email, md5($password), $userLevel)))
        {
            Flash::addFlash('success','User added sucessfully!');
        } else {
            echo 'fuck';
        }
    }

    public function update($userId, $lastName, $firstName, $email, $password, $repassword, $userLevel) {
        global $db;

        if(!is_admin())
            die('Not enough privileges');

        if(empty($lastName) || empty($firstName) || empty($email) || $userLevel<1) {
            $_SESSION['errors']['all'] = "All field are required except passwords!";
            Flash::addFlash('alert', $_SESSION['error']['all']);
            return false;
        }

        if(!Validate::password($password, $repassword)) {
            $_SESSION['errors']['password'] = "Password not matched!";
        }

        if (!Validate::name($firstName)) {
            $_SESSION['errors']['firstName'] = "Not a valid name!";
        }

        if (!Validate::name($lastName)) {
            $_SESSION['errors']['lastName'] = "Not a valid name!";
        }

        if (!Validate::email($email)) {
            $_SESSION['errors']['email'] = "Not a valid email!";
        }

        if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0)
        {
            Flash::addFlash('alert', 'Check error below!');
            return false;
        }

        $updating_user = array(
            'lastName'      => $lastName,
            'firstName'     => $firstName,
            'email'         => $email,
            'userLevel'     => $userLevel
            );

        if (!empty($password)) {
            array_push($updating_user, $password);
        }

        if($db->update('users',$updating_user,"userId=$userId"))
        {
            Flash::addFlash('success','User updated sucessfully!');
        } else {
            echo mysql_error();
        }

    }
}

?>

<?php

class Database
{

    /*
     * Edit the following variables
     */
    private $db_host = 'localhost';         // Database Host
    private $db_user = 'inew2332_user';           // Username
    private $db_pass = 'inew2332_pass';     // Password
    private $db_name = 'inew2332_db';           // Database
    /*
     * End edit
     */

    public $con = false;               // Checks to see if the connection is active
    private $numResults = 0;
    private $result = array();          // Results that are returned from the query

    /*
     * Connects to the database, only one connection
     * allowed
     */
    public function connect()
    {
        if(!$this->con)
        {
            $this->con = mysqli_connect($this->db_host,$this->db_user,$this->db_pass, $this->db_name);
            if($this->con)
            {
                return true;
            }
            else
            {
                die ("<p class='error'>Sorry, we were unable to connect to the database server.</p>"); 
            }
        }
        else
        {
            return true;
        }
    }

    /*
    * Changes the new database, sets all current results
    * to null
    */
    public function setDatabase($name)
    {
        if($this->con)
        {
            if(mysqli_close())
            {
                $this->con = false;
                $this->results = null;
                $this->db_name = $name;
                $this->connect();
            }
        }

    }

    /*
    * Checks to see if the table exists when performing
    * queries
    */
    private function tableExists($table)
    {
        $tablesInDb = mysqli_query($this->con, 'SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
        if($tablesInDb)
        {
            if(mysqli_num_rows($tablesInDb)==1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    /*
    * Custom query
    */
    public function query($q)
    {
        // A bug here when you never commit destroying the database connection
        // You'll properly want to free the result set before commit another query
        $this->result = array();

        //echo ($q);

        $query = mysqli_query($this->con, $q);

        if($query)
        {
            $this->numResults = mysqli_num_rows($query);
            for($i = 0; $i < $this->numResults; $i++)
            {
                $r = mysqli_fetch_array($query);
                $key = array_keys($r);
                for($x = 0; $x < count($key); $x++)
                {
                    // Sanitizes keys so only alphavalues are allowed
                    if(!is_int($key[$x]))
                    {
                        if(mysqli_num_rows($query) > 0)
                            $this->result[$i][$key[$x]] = $r[$key[$x]];
                        else
                            $this->result = null;
                    }
                }
            }
            return true;
        }
        else
        {   
            die(mysqli_error($this->con));
        }
    }

    /*
    * Selects information from the database.
    * Required: table (the name of the table)
    * Optional: rows (the columns requested, separated by commas)
    *           where (column = value as a string)
    *           order (column DIRECTION as a string)
    */
    public function select($table, $rows = '*', $where = null, $order = null)
    {
        // A bug here when you never commit destroying the database connection
        // You'll properly want to free the result set before commit another query
        $this->result = array();

        $q = 'SELECT '.$rows.' FROM '.$table;
        if($where != null)
            $q .= ' WHERE '.$where;
        if($order != null)
            $q .= ' ORDER BY '.$order;

        //$q="select * from devices where mac_address='0:f4:b9:17:38:69'";
        //die($q);
        $query = mysqli_query($this->con, $q);
        if($query)
        {
            $this->numResults = mysqli_num_rows($query);
            for($i = 0; $i < $this->numResults; $i++)
            {
                $r = mysqli_fetch_array($query);
                //die(var_dump($r));
                $key = array_keys($r);
                for($x = 0; $x < count($key); $x++)
                {
                    // Sanitizes keys so only alphavalues are allowed
                    if(!is_int($key[$x]))
                    {
                        if(mysqli_num_rows($query) > 1)
                            $this->result[$i][$key[$x]] = $r[$key[$x]];
                        else if(mysqli_num_rows($query) < 1)
                            $this->result = null;
                        else
                            $this->result[$key[$x]] = $r[$key[$x]];
                    }
                }
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    /*
    * Insert values into the table
    * Required: table (the name of the table)
    *           values (the values to be inserted)
    * Optional: rows (if values don't match the number of rows)
    */
    public function insert($table,$values,$rows = null)
    {
        if($this->tableExists($table))
        {
            $insert = 'INSERT INTO '.$table;
            if($rows != null)
            {
                $insert .= ' ('.$rows.')';
            }

            for($i = 0; $i < count($values); $i++)
            {
                if(!empty($values[$i]))
                    $values[$i] = '"'.$values[$i].'"';
                else
                    $values[$i] = 'NULL';
            }
            $values = implode(',',$values);
            $insert .= ' VALUES ('.$values.')';

            $ins = mysqli_query($this->con, $insert);

            if($ins)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    /*
    * Deletes table or records where condition is true
    * Required: table (the name of the table)
    * Optional: where (condition [column =  value])
    */
    public function delete($table,$where = null)
    {
        if($this->tableExists($table))
        {
            if($where == null)
            {
                $delete = 'DELETE '.$table;
            }
            else
            {
                $delete = 'DELETE FROM '.$table.' WHERE '.$where;
            }
            $del = mysqli_query($this->con, $delete);

            if($del)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /*
     * Updates the database with the values sent
     * Required: table (the name of the table to be updated
     *           rows (the rows/values in a key/value array
     *           where (the row/condition in an array (row,condition) )
     */
    public function update($table,$rows, $where = null)
    {
        if($this->tableExists($table))
        {

            $update = 'UPDATE '.$table.' SET ';
            $keys = array_keys($rows);
            for($i = 0; $i < count($rows); $i++)
            {
                if(is_string($rows[$keys[$i]]))
                {
                    $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
                }
                else
                {
                    $update .= $keys[$i].'='.$rows[$keys[$i]];
                }

                // Parse to add commas
                if($i != count($rows)-1)
                {
                    $update .= ',';
                }
            }
            $update .= ' WHERE '.$where;
            //die($update);
            $query = mysqli_query($this->con, $update);

            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /*
    * Returns the result set
    */
    public function getResult()
    {
        return $this->result;
    }

    public function getNumResults()
    {
        return $this->numResults;
    }

    public function getInsertedId()
    {
        return mysqli_insert_id($this->con);
    }

    public function getError()
    {
        return mysqli_error($this->con);
    }
}

?>
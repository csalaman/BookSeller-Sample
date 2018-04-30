<?php
/**
 * Created by PhpStorm.
 * User: csalaman
 * Date: 3/26/2018
 * Time: 9:45 PM
 */

require_once "dbAccessInfo.php";

class DatabaseInstance
{
    private $db_connect;
    private $table_name;
    private $password_protected;

    // Constructor, takes server information and authentication, password_protected is true if the database contains passwords, false otherwise
    function __construct($host, $user, $password, $database, $table_name)
    {
        $this->table_name = $table_name;
        $this->db_connect = new mysqli($host, $user, $password, $database);
        if ($this->db_connect->connect_error) {
            die($this->db_connect->connect_error);
        }
    }

    // Params: array of attributes in order of table schema, returns true if successful
    function insert($attributes)
    {
        if($this->table_name == "users"){
            $pass_hash = password_hash($attributes['password'],PASSWORD_DEFAULT);
            $query = "INSERT INTO $this->table_name (name, username, password) VALUES ('{$attributes['name']}','{$attributes['username']}','{$pass_hash}')";
            $result = $this->db_connect->query($query);
            if(!$result){
                die("Insertion to table ".$this->table_name." failed: ". $this->db_connect->error);
            }else{
                return True;
            }
        }else{
            $query = "INSERT INTO $this->table_name (item_name,item_file_name,item_seller,item_description,item_price,item_is_sold,item_buyer,item_post_date) VALUES (";
            $comma_counter = 1;
            foreach ($attributes as $val){
                $query .= "'{$val}'";
                if($comma_counter < sizeof($attributes)){
                    $query .= ",";
                    $comma_counter += 1;
                }
            }
            $query .= ")";

            $result = $this->db_connect->query($query);
            if(!$result){
                die("Insertion to table ".$this->table_name." failed: ". $this->db_connect->error);
            }else{
                return True;
            }
        }
    }
    
    function registerUser($name, $username, $password) {
        if($this->table_name == "users"){
            $pass_hash = password_hash($password,PASSWORD_DEFAULT);
            $query = "INSERT INTO $this->table_name (name, username, password) VALUES ('{$name}','{$username}','{$pass_hash}')";
            $result = $this->db_connect->query($query);
            if(!$result){
                return false;
            }else{
                return true;
            }
        }else{
            return null;
        }
    }

    // Updates an entry, hash table for 'items' or 'users' tables; attribute => new value
    function update($attributes)
    {
        if($this->table_name == "users"){
            $hash_pass = password_hash($attributes['password'],PASSWORD_DEFAULT);
            $query = "UPDATE $this->table_name set password='{$hash_pass}' WHERE username='{$attributes['username']}'";
            $result = $this->db_connect->query($query);
            if (!$result) {
                die("Update to table ".$this->table_name." failed: " . $this->db_connect->error);
            } else {
                return True;
            }
        }else{
            $query = "UPDATE $this->table_name set ";
            $comma_counter = 1;
            foreach ($attributes as $attr => $val){
                if($attr != 'item_id'){
                    $query .= "'{$attr}' = '{$val}'";
                    if($comma_counter < sizeof($attributes)){
                        $query .= ",";
                        $comma_counter += 1;
                    }
                }
            }
            $query .= " WHERE item_id = '{$attributes['item_id']}'";

            $result = $this->db_connect->query($query);
            if (!$result) {
                die("Update to table ".$this->table_name." failed: " . $this->db_connect->error);
            } else {
                return True;
            }

        }



    }

    // Get everything
    function getAllData()
    {
        $query = "select * from $this->table_name";
        $result = $this->db_connect->query($query);
        if (!$result) {
            die("Data Retrieve failed: " . $this->db_connect->error);
        } else {
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    array_push($data,$row);
                }
                return $data;
            }else{
                return null;
            }
        }
    }

    // Function to get attributes with condition
    function getConditionalData($select_atrib,$conditions){
        $query = "SELECT ";
        $comma_counter = 1;
        foreach ($select_atrib as  $val){
            $query .= "{$val}";
            if($comma_counter < sizeof($select_atrib)){
                $query .= ",";
                $comma_counter += 1;
            }

        }
        $query .= " FROM $this->table_name WHERE ".$conditions;

        $result = $this->db_connect->query($query);
        if (!$result) {
            die("Data Retrieve failed: " . $this->db_connect->error);
        } else {
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    array_push($data,$row);
                }
                return $data;
            }else{
                return null;
            }
        }
    }

    // Verifies if the password is associated with email
    function verifyPassword($username, $password)
    {
        $query = "SELECT password FROM users WHERE username = '{$username}'";
        $result = $this->db_connect->query($query);
        if (!$result) {
            die("Data request for users failed: " . $this->db_connect->error);
        } else {
            $row = mysqli_fetch_row($result);
            if (password_verify($password, $row[0])) {
                return True;
            } else {
                return False;
            }
        }
    }
    // Additional function, might not need
    function getUserByUsername($username)
    {
        if($this->table_name == "users"){
            $query = "SELECT * FROM user WHERE email = '{$username}'";
            $result = $this->db_connect->query($query);
            if (!$result) {
                die("Unable to retrieve username: " . $this->db_connect->error);
            } else {
                return $result->fetch_assoc();
            }
        }else{
            return null;
        }
    }
    
    function getItemById($id)
    {
        if($this->table_name == "items"){
            $query = "SELECT * FROM items WHERE item_id = '{$id}'";
            $result = $this->db_connect->query($query);
            if (!$result) {
                die("Unable to retrieve item id: " . $this->db_connect->error);
            } else {
                return $result->fetch_assoc();
            }
        } else {
            return null;
        }
    }
    
    function getUserById($id)
    {
        if($this->table_name == "users"){
            $query = "SELECT * FROM users WHERE user_id = '{$id}'";
            $result = $this->db_connect->query($query);
            if (!$result) {
                die("Unable to retrieve item id: " . $this->db_connect->error);
            } else {
                return $result->fetch_assoc();
            }
        } else {
            return null;
        }
    }
    
    function getItemsWithSearch($search) {
        if($this->table_name == "items"){
            $query = "SELECT * FROM items WHERE item_name like '%{$search}%' or item_description like '%{$search}%'";
            $result = $this->db_connect->query($query);
            if (!$result) {
                die("Data Retrieve failed: " . $this->db_connect->error);
            } else {
                if ($result->num_rows > 0) {
                    $data = array();
                    while ($row = $result->fetch_assoc()) {
                        array_push($data,$row);
                    }
                    return $data;
                }else{
                    return null;
                }
            }
        } else {
            return null;
        }
    }
    
    function getErrno() {
        return $this->db_connect->errno;
    }


}

// Database table access for 'users'
$user_table = new DatabaseInstance($host, $user, $password, $database, 'users');
$items_table = new DatabaseInstance($host, $user, $password, $database, 'items');

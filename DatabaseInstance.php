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
            $query = "INSERT INTO $this->table_name VALUES ('{$attributes['username']}','{$pass_hash}')";
            $result = $this->db_connect->query($query);
            if(!$result){
                die("Insertion to table ".$this->table_name." failed: ". $this->db_connect->error);
            }else{
                return True;
            }
        }else{
            $query = "INSERT INTO $this->table_name VALUES ('{$attributes[0]}','{$attributes[1]}','{$attributes[2]}',
                        '{$attributes[3]}','{$attributes[4]}','{$attributes[5]}','{$attributes[6]}','{$attributes[7]}','{$attributes[8]}',)";
            $result = $this->db_connect->query($query);
            if(!$result){
                die("Insertion to table ".$this->table_name." failed: ". $this->db_connect->error);
            }else{
                return True;
            }
        }
    }

    // Updates an entry, hash table for 'items' or 'users' table
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
                $query .= "'{$attr}' = '{$val}";
                if($comma_counter < sizeof($attributes)){
                    $query .= ",";
                    $comma_counter += 1;
                }
            }
            $result = $this->db_connect->query($query);
            if (!$result) {
                die("Update to table ".$this->table_name." failed: " . $this->db_connect->error);
            } else {
                return True;
            }

        }



    }

    // Get everything
    function getData()
    {
        $query = "select * from $this->table_name";
        $result = $this->db_connect->query($query);
        if (!$result) {
            die("Data Retrieve failed: " . $this->db_connect->error);
        } else {
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                       echo $row['username'] . "," . $row['password'];
                    echo "<br>";
                }
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


}

// Database table access for 'users'
$user_table = new DatabaseInstance($host, $user, $password, $database, 'users');
$items_table = new DatabaseInstance($host, $user, $password, $database, 'items');

//
//$user_table->update(array("username"=>"Seller B","password"=>"bpass"));
//$user_table->getData();

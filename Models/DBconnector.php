<?php
class DBconnector{
    private $name = "atm_db";
    private $host = "db4free.net";
    private $password = "oyounis1";
    private $username = "suiiii";
    public $connection;
    
    # Database connecting function
    public function dbconnect(){
        $this->connection = new mysqli($this->host,$this->username,$this->password,$this->name);
        if($this->connection->connect_error){
            echo "Connection Error: " . $this->connection->connect_error;
            return false;
        }
    }

    # Database closing connection function
    public function dbclose(){
        $this->connection->close();
    }

    # this function for Database SELECT queries
    // input: Mysql query
    public function select($sqlqry){
        try{
            $result = $this->connection->query($sqlqry);
            // query function return false if the query is false and sql object if true
            if($result == false)
                throw new Exception();

            return $result->fetch_assoc();
        }
        catch(Exception $e){
            //use the below statment to know the error
            echo "message: " . $e->getMessage();
            return false;
        }
    }

    # this function for Database INSERT,DELETE,UPDATE queries
    // input: Mysql query
    public function modify($sqlqry){
        // if there is no exeption the function return true else false
        try{
            $result = $this->connection->query($sqlqry);
            if($result == false)
                throw new Exception();
            
            return true;
        }
        catch(Exception $e){
            //use the below statment to know the error
            echo "message: " . $e->getMessage();
            return false;
        }
    }
}
?> 
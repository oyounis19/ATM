<?php
class DBConnector {
    private $connection;
    private $username = "suiiii";
    private $password = "oyounis1";
    private $dbname = "atm_db";
    private $host = "db4free.net";

    /**
     * Opens the connection with the Database.
     *
     * @throws Exception If there was an error opening the connection.
     */
    public function __construct() {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
        if (!$this->connection) {
            throw new Exception("Failed to connect to database: " . mysqli_connect_error());
        }
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

    /**
     * Closes the Database Connection.
     */
    public function close() {
        mysqli_close($this->connection);
    }
}
?>
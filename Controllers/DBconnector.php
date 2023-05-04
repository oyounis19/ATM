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

    /**
     * Retrieves rows from the specified table and returns them as an array of associative arrays.
     *
     * @param string $table The name of the table to select from.
     * @param string|array $columns The column(s) to select.
     * @param string|null $where The WHERE clause of the query, without the "WHERE" keyword.
     * @return array An array of associative arrays representing the rows selected.
     * @throws Exception If there was an error executing the select query.
     */
    public function select($table, $columns = "*", $where = null) {
        $query = "SELECT $columns FROM $table";
        if ($where) {
            $query .= " WHERE $where";
        }
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            throw new Exception("Failed to prepare query: " . $this->connection->error);
        }
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute query: " . $stmt->error);
        }
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Inserts a new record into the specified table with the given data.
     *
     * @param string $table The name of the table to insert into.
     * @param array $data An array of values to insert into the table.
     * @return int The number of rows affected by the insert operation.
     * @throws Exception If there was an error executing the insert query.
     */
    public function insert($table, $data) {
        $columns = implode(",", array_keys($data));
        $values = implode(",", array_fill(0, count($data), "?"));
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            throw new Exception("Failed to prepare query: " . $this->connection->error);
        }
        
        $values = array_values($data);
        $params = array(str_repeat("s", count($data)));
        foreach ($values as $value) {
            $params[] = $value;
        }
        
        if (!$stmt->bind_param(...$params)) {
            throw new Exception("Failed to bind parameters: " . $stmt->error);
        }
        
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute query: " . $stmt->error);
        }
        return $stmt->affected_rows;
    }

    /**
     * Update a record with the specified table with the given data.
     *
     * @param string $table The name of the table to insert into.
     * @param array $data An array of values to insert into the table.
     * @param string $where The WHERE clause of the query, without the "WHERE" keyword.
     * @return int The number of rows affected by the insert operation.
     * @throws Exception If there was an error executing the insert query.
     */    
    public function update($table, $data ,$where) {
        $query = "UPDATE $table SET ";
        foreach($data as $key => $value){
            $query .= "$key = ? ,";
        }
        $query = rtrim($query,",");
        $query .= "WHERE $where";
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            throw new Exception("Failed to prepare query: " . $this->connection->error);
        }
        
        $values = array_values($data);
        $params = array(str_repeat("s", count($data)));
        foreach ($values as $value) {
            $params[] = $value;
        }
        
        if (!$stmt->bind_param(...$params)) {
            throw new Exception("Failed to bind parameters: " . $stmt->error);
        }
        
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute query: " . $stmt->error);
        }
        return $stmt->affected_rows;
    }


    /**
     * Deletes rows from the specified table that match the given condition.
     *
     * @param string $table The name of the table to delete from.
     * @param string|null $where The WHERE clause of the query, without the "WHERE" keyword.
     * @param array $params An array of values to bind to the query.
     * @return int The number of rows affected by the delete operation.
     * @throws Exception If there was an error executing the delete query.
     */
    public function delete($table, $where) {
        $query = "DELETE FROM $table WHERE $where";
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            throw new Exception("Failed to prepare query: " . $this->connection->error);
        } 
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute query: " . $stmt->error);
        }
        return $stmt->affected_rows;
    }

    /**
     * Closes the Database Connection.
     */
    public function close() {
        mysqli_close($this->connection);
    }
}
?>
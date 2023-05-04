<?php
class DBConnector {
    private $conn;
    private $username = "suiiii";
    private $password = "oyounis1";
    private $dbname = "atm_db";
    private $host = "db4free.net";

    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
        if (!$this->conn) {
            throw new Exception("Failed to connect to database: " . mysqli_connect_error());
        }
    }

    public function select($table, $columns = "*", $where = null, $params = array()) {
        $query = "SELECT $columns FROM $table";
        if ($where) {
            $query .= " WHERE $where";
        }
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Failed to prepare query: " . $this->conn->error);
        }
        if ($params) {
            $types = str_repeat("s", count($params));
            $stmt->bind_param($types, ...$params);
        }
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute query: " . $stmt->error);
        }
        $result = $stmt->get_result();
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function insert($table, $data) {
        $columns = implode(",", array_keys($data));
        $values = implode(",", array_fill(0, count($data), "?"));
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Failed to prepare query: " . $this->conn->error);
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
    public function close() {
        mysqli_close($this->conn);
    }
}
?>
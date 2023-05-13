<?php
if (session_status() == PHP_SESSION_NONE) 
    session_start();

require_once (__DIR__."/../Controllers/DBconnector.php");
class servicesTechinican{
    private $firstName;
    private $lastName;
    private $userName;
    private $password;
    private $accId;
    private $role;
    private $db;
    
    public function __construct($firstName = null, $lastName = null, $userName = null, $password = null){
        if($firstName)
            $this->firstName = $firstName;
        if($lastName)
            $this->lastName = $lastName;
        if($userName)
            $this->userName = $userName;
        if($password)
            $this->password = $password;
            
        $this->role = 'Technician';
        $this->db = new DBConnector;
    }

    public function getFirstName(){
        return $this->firstName;
    }
    public function getLastName(){
        return $this->lastName;
    }
    public function getPassword(){
        return $this->password ;
    }
    public function getUserName(){
        return $this->userName;
    }
    // public function getTqId(){
    //     return $this->tqId ;
    // }
    // public function getAtmId(){
    //     return $this->atmId ;
    // }
    // public function getAtmBalance(){
    //     return $this->atmId ;
    // }
    public function getAccId(){
        return $this->accId ;
    }
    /**
	 * @param string $firstName 
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	/**
	 * @param mixed $lastName 
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}
	/**
	 * @param mixed $userName 
	 */
	public function setUserName($userName) {
		$this->userName = $userName;
	}
	/**
	 * @param mixed $password 
	 */
	public function setPassword($password) {
		$this->password = $password;
	}
	/**
	 * @param mixed $accId 
	 */
	public function setAccId($accId) {
		$this->accId = $accId;
	}

    /**
     * @param string $pass password from GUI
     * @return string hashed password
     */
    private function pinVerification($pass) {
        $password = hash("sha256", $pass);
        return $password;
    }

    public function login() {
        $userName = $_POST['teqUserName'];
        $password = $_POST['teqPassword'];
        $atmId = $_POST['atm_Id'];
        if(isset($userName) && isset($password) && isset($atmId) && !empty($userName) && !empty($password) && !empty($userName)){
            $password = $this->pinVerification($password);
            $result = $this->db->select("Employee", "*" , "UserName=? AND Password=?", array($userName,$password));
            $result1 = $this->db->select("ATM", "*" , "ID=?", array($atmId));
            if(!$result){
                $_SESSION['errMsg'] = 'Wrong Username or Password';
                return false;
            }else if(!$result1){
                $_SESSION['errMsg'] = "No Matches For This Atm Id";
                return false;
            } else if($result[0]['Role'] == "Admin"){
                $_SESSION['errMsg'] = 'You Are Not A Services Technician';
            }else{
                $_SESSION['empId'] = $result[0]['ID'];
                $_SESSION['firstName'] = $result[0]['FirstName'];
                $_SESSION['lastName'] = $result[0]['LastName'];
                $_SESSION['userName'] = $result[0]['UserName'];
                $_SESSION['atmId'] = $result1[0]['ID'];
                $_SESSION['atmBalance'] = $result1[0]['Balance'];
                $_SESSION['check'] = 0;
                return true;
            }
        }else 
            return false;
    }

    public function logOut() {
        session_start();
        session_unset();
        session_destroy();
        header("location:../View/index.php");
    }

    public function rechargeAtm() {
        $mAmount = $_POST['mAmount'];
        if(isset($mAmount) && !empty($mAmount) && !$_SESSION['check']){
            $_SESSION['check'] = 1;
            $_SESSION['atmBalance'] = $mAmount;
            $table = 'ATM';
            $data = array('Balance' => $_SESSION['atmBalance']);
            $where = 'ID = ?';
            $params = array($_SESSION['atmId']);
            $affected_rows = $this->db->update($table, $data, $where, $params);
            return $affected_rows;
        }
    }

    public function checkLoggers(){
        return $this->db->select("Transaction", "*" , "AtmID = ?", array($_SESSION['atmId']));
    }

    public function __destruct(){
            $this->db->close();
    }
}
?>
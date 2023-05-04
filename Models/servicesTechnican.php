<?php
session_start();
require_once '../Controllers/DBconnector.php';
class servicesTechinican{
private $username;
private $password;
private $atmamount;
private $TechinicanId;
private $atmBalance;
private $atmId;
private $accId;
private $transactionType;
private $date;
private $amount;
private $time;

private function pinVerification($pass){
        $password = hash("sha256", $pass);
        return $password;
    }
public function login(){
    $userName = $_POST['teqUserName'];
    $password = $_POST['teqPassword'];
    $atmId = $_POST['atm_Id'];
    if(isset($userName) && isset($password) && isset($atmId)){
        $this->db = new DBconnector;
       // if($this->db->__construct()){
            $password = $this->pinVerification($password);
            $result = $this->db->select("Employee", "*" , "User_name=? AND Password=?", array($userName,$password));
            $result1 = $this->db->select("ATM", "*" , "ATM_ID=?", array($atmId));
            if(!$result){
                //echo "PASS OR USER";
                return false;
            }else if(!$result1){
                //$_SESSION['$erMssg'] = ['No Matchs For This Atm_Id'];
                return false;
            } else{
                if(count($result) == 0 || count($result1) == 0){
                    echo "0 result";
                    return false;
                }else{ 
                    //foreach ($rows as $row){
                    $_SESSION['empId'] = $result[0]['Emp_ID'];
                    $_SESSION['firstName'] = $result[0]['First_Name'];
                    $_SESSION['lastName'] = $result[0]['Last_Name'];
                    $_SESSION['userName'] = $result[0]['User_Name'];
                    $_SESSION['atmId'] = $result1[0]['ATM_ID'];
                    $_SESSION['adminId'] = $result1[0]['Admin_ID'];
                    $_SESSION['atmBalance'] = $result1[0]['Balance'];
                    header("location:../View/serviceMenu.php");
                    return true;
                }
            }
    }else {
        //$_SESSION['$erMssg'] = ['Fill all fields'];
    }
}//else echo "SETT";

public function logOut(){
        session_start();
        session_unset();
        session_destroy();
        header("location:../View/index.php");
    }


public function rechargeAtm (){
    $mAmount = $_POST['mAmount'];
    if(isset($mAmount)){
        $this->db = new DBconnector;
        $mAmount += $_SESSION['atmBalance'];
        $_SESSION['atmBalance'] = $mAmount;
        $table = 'ATM';
        $data = array('Balance' => $mAmount);
        $where = 'ATM_ID = ?';
        $params = array($_SESSION['atmId']);
        $affected_rows = $this->db->update($table, $data, $where, $params);
    }
}


public function checkLoggers(){

}

}
?>
<?php
// if(session_start()){

// }else {
//     session_start();
// }
require_once (__DIR__."/../Controllers/DBconnector.php");
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
             $result = $this->db->select("Employee", "*" , "UserName=? AND Password=?", array($userName,$password));
            $result1 = $this->db->select("ATM", "*" , "ID=?", array($atmId));
            if(!$result || $result[0]['Role'] == "Admin"){
                //echo "PASS OR USER";
                return false;
            }else if(!$result1){
                //echo "PASS atm USER";
                //$_SESSION['$erMssg'] = ['No Matchs For This Atm_Id'];
                return false;
            } else{
                if(count($result) == 0 || count($result1) == 0){
                    echo "0 result";
                    return false;
                }else{ 
                    //foreach ($rows as $row){
                    $_SESSION['empId'] = $result[0]['ID'];
                    echo $_SESSION['empId'];
                    $_SESSION['firstName'] = $result[0]['FirstName'];
                    $_SESSION['lastName'] = $result[0]['LastName'];
                    $_SESSION['userName'] = $result[0]['UserName'];
                    $_SESSION['atmId'] = $result1[0]['ID'];
                    $_SESSION['atmBalance'] = $result1[0]['Balance'];
                    $_SESSION['check'] = 0;
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
    if($_SESSION['check'] == 0){
        $_SESSION['check'] = 1;
        $mAmount = $_POST['mAmount'];
        if(isset($mAmount)){
            $this->db = new DBconnector;
            $mAmount += $_SESSION['atmBalance'];
            $_SESSION['atmBalance'] = $mAmount;
            $table = 'ATM';
            $data = array('Balance' => $_SESSION['atmBalance']);
            $where = 'ID = ?';
            $params = array($_SESSION['atmId']);
            $affected_rows = $this->db->update($table, $data, $where, $params);
    }
}
}


public function checkLoggers(){
    $this->db = new DBconnector;
    $result = $this->db->select("Transaction", "AccountID , Type , Date" , "", array());
    return $result;
}

}
?>
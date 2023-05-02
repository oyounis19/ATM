<?php

require_once "DBconnector.php";
require_once "Customer.php";
require_once "Transaction.php";
require_once "Account.php";

class verification{
    private $db ;

    public function PIN($user,$PIN){
        $db = new DBconnector();
        $sql = "SELECT PIN FROM `user` WHERE SSN = $user->SSN;"; // $user is from class customer
        $result = $db->select($sql);
        if($result["PIN"]==$PIN)
            return true;
        else
            return false;
    }
    
    public function CheckBalance($account,$transaction){
        $db = new DBconnector();
        $sql = "SELECT Balance FROM `account` WHERE Account_ID = $account->id;"; // $account is from class account
        $result = $db->select($sql);
        if($result["Balance"]>=$transaction->amount)
            return true;
        else
            return false;
    }

    public function CheckBehavior($account,$transaction){
        $db = new DBconnector();
        $sql = "SELECT `Withdraw_Amount`, `Avg_Withdraw`, `Transfer_Amount`, `Avg_Transfer` FROM `account` WHERE `Account_ID` = $account->id;"; // $account is from class account
        $result = $db->select($sql);
        if($transaction->type == "Withdraw") // $transaction from class transaction
            $AvgAmount = $result["Avg_Withdraw"]/$result["Withdraw_Amount"];
        else
            $AvgAmount = $result["Avg_Transfer"]/$result["Transfer_Amount"];
    
        $ValidAmount = $AvgAmount + $AvgAmount*(30/100);
        if($ValidAmount >= $transaction->amount) // $transaction from class transaction
            return true; 
        else
            return false;
    }
        
    public function VerifyAll($account,$transaction){
        $CheckBalance = $this->CheckBalance($account,$transaction);
        $CheckBehavior = $this->CheckBehavior($account,$transaction);
        if($CheckBalance && $CheckBehavior)
            return true;
        else
            return false;
    }
}


?>
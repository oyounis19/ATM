<?php


require_once __DIR__."/../Controllers/DBconnector.php";
require_once __DIR__."/Customer.php";
require_once __DIR__."/Transaction.php";
require_once __DIR__."/Account.php";


class verification{
    private $db;

    public function PIN(Customer $user,$PIN){// waiting for khaled class
        $db = new DBconnector();
        $result = $db->select("User", "PIN","SSN = ?",array($user->getSSN())); // $user is from class customer
        if($result["PIN"]==$PIN)
            return true;
        else
            return false;
    }
    
    public function CheckBalance(Account $account, Transaction $transaction){
        $db = new DBconnector();
        $result = $db->select("Account","Balance","Account_ID = ?",array($account->getId()));
        if($result["Balance"]>=$transaction->getAmount())
            return true;
        else
            return false;
    }

    public function CheckBehavior(Account $account, Transaction $transaction){
        $db = new DBconnector();
        $result = $db->select("Account","*","Account_ID = ?",array($account->getId()));
        if($transaction->getType() == "Withdraw") // $transaction from class transaction
            $AvgAmount = $result["Avg_Withdraw"]/$result["Withdraw_Amount"];
        else
            $AvgAmount = $result["Avg_Transfer"]/$result["Transfer_Amount"];
    
        $ValidAmount = $AvgAmount + $AvgAmount*(30/100);
        if($ValidAmount >= $transaction->getAmount()) // $transaction from class transaction
            return true; 
        else
            return false;
    }
        
    public function VerifyAll(Account $account, Transaction $transaction){
        $CheckBalance = $this->CheckBalance($account,$transaction);
        $CheckBehavior = $this->CheckBehavior($account,$transaction);
        if($CheckBalance && $CheckBehavior)
            return true;
        else
            return false;
    }
}


?>
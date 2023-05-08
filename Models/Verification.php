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
    
    private function generateOTP() {
        $digits = 6;
        return str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
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

    public function CheckExpDate(Card $card)
    {
        $today = new DateTime();
        date_format($today,'Y-m-d');
        return $today == $card->getDate();
    }

    public function CheckLocation(Customer $customer,ATM $ATM){
        if(strtolower($customer->getCity()) == strtolower($ATM->getCity())){
            return true;
        }
        else{
            try{
                $db = new DBConnector();
                $SSN =  $customer->getSSN();
                $sql = "SELECT `City` From `ATM` inner join `Transaction` on ATM.ID = Transaction.AtmID where SSN = $SSN";
                $result = $db->join($sql);
                if($result){
                    $i = count($result)-1;
                    $lastLocation = $result[$i]["City"];
                    if(strtolower($lastLocation) == strtolower($customer->getCity())){
                        return true;
                    }
                    else{
                        $OTP = $ATM->sendOTP($customer, $this->generateOTP());
                        return $OTP;
                    }
                }
                else
                    return false;
            }
            catch(Exception $e){
                return false;
            }
        }
    }
     
    public function CheckOTP($OTP,$userOTP){
        return $OTP == $userOTP;
    }

    public function LoginVerifyAll(Customer $customer,ATM $ATM,Card $card){
        $CheckExpDate = $this->CheckExpDate($card);
        $CheckLocation = $this->CheckLocation($customer,$ATM);
        if($CheckExpDate && $CheckLocation)
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
<?php


require_once __DIR__."/../Controllers/DBconnector.php";
require_once __DIR__."/Customer.php";
require_once __DIR__."/Transaction.php";
require_once __DIR__."/Account.php";


class verification{
    private $db;

    public function __construct(){
        $this->db = new DBconnector();
    }   
    
    private function generateOTP() {
        $digits = 6;
        return str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
    }

    public function CheckPIN(Customer $customer,$PIN){
        return ($customer->getPin()==$PIN);
    }

    public function CheckBalance(Account $account, Transaction $transaction){
        return ($account->getBalance()==$transaction->getAmount());
    }

    public function CheckBehavior(Account $account, Transaction $transaction){
        $result = $this->db->select("Account","*","Account_ID = ?",array($account->getId()));
        if($transaction->getType() == "Withdraw") // $transaction from class transaction
            $AvgAmount = $result["totalWithdraws"]/$result["numberOfWithdraws"];
        else
            $AvgAmount = $result["totalTransfer"]/$result["numberTransfer"];
    
        $ValidAmount = $AvgAmount + $AvgAmount*(30/100);
        if($ValidAmount >= $transaction->getAmount()) // $transaction from class transaction
            return true; 
        else
            return false;
    }

    public function CheckExpDate(Card $card){//Login
        $date = new DateTime($card->getDate());
        $today = new DateTime();
        $result = $today->diff($date)->format('%R');//comparing

        if ($result === '+')//Early (running)
            return true;
        else{//Late (expired)
            //OTP VERIFICATION GOES HERE*************************************************************************************
            // ازاي لول؟
            return false;
        }
    }

    public function CheckLocation(Customer $customer,ATM $ATM){//Login
        if(strtolower($customer->getCity()) == strtolower($ATM->getCity())){
            return true;
        }
        else{
            try{
                $SSN =  $customer->getSSN();
                $sql = "SELECT `City` From `ATM` inner join `Transaction` on ATM.ID = Transaction.AtmID where SSN = $SSN";
                $result = $this->db->join($sql);
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

    // public function LoginVerifyAll(Customer $customer,ATM $ATM,Card $card){//Login
    //     $CheckExpDate = $this->CheckExpDate($card);
    //     $CheckLocation = $this->CheckLocation($customer,$ATM);
    //     if($CheckExpDate && $CheckLocation)
    //         return true;
    //     else
    //         return false;
    // }

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
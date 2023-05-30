<?php
require_once __DIR__."/../Controllers/DBconnector.php";
require_once __DIR__."/Customer.php";//starts session
require_once __DIR__."/Transaction.php";
require_once __DIR__."/Account.php";

class verification{
    private $db;

    public function __construct(){
        $this->db = new DBconnector();
    }   
    
    /**
     * Generates a random 6-digit OTP for verification
     */
    private function generateOTP() {
        $digits = 6;
        return str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
    }

    /**
     * Compares the transaction amount with the account balance
     * @param Account $account user's account
     * @param Transaction $transaction current transaction
     * @return bool
     */
    private function CheckBalance(Account $account, Transaction $transaction){//At transaction
        return ($transaction->getAmount() > $account->getBalance());
    }

    /**
     * Detects fraud if transaction amount is above the average by more than 30%,
     * Then sends the user OTP for identity verification.
     * @param Account $account user's account
     * @param Transaction $transaction current transaction
     * @param Customer $customer customer's info (email address)
     * @return mixed -1 (Insufficient Account Balance), true (first transaction ever OR no fraud detected), false (fraud detected)
     */
    public function CheckBehavior(Account $account, Transaction $transaction, Customer $customer){//At transaction
        if($this->CheckBalance($account, $transaction)){//Insufficient Account Balance
			$transaction->setState(false);
			return -1;//Save but denied
		}
        $result = $this->db->select("Account","*","ID = ?",array($account->getId()));

        $AvgAmount = null;
        if($transaction->getType() == "Withdraw"){
            if((int)$result[0]["numberOfWithdraws"] == 0){
                return true;//first time
            }
            $AvgAmount = (int)$result[0]["totalWithdraws"]/(int)$result[0]["numberOfWithdraws"];
        }
        else{
            if((int)$result[0]["numberTransfer"] == 0){
                return true;//first time
            }
            $AvgAmount = (int)$result[0]["totalTransfer"]/(int)$result[0]["numberTransfer"];
        }

        $ValidAmount = $AvgAmount + $AvgAmount * (30/100);//30% above Average
        if($ValidAmount >= $transaction->getAmount())
            return true; //No fraud detected
        else{//Fraud detected
            if($transaction->getType() == "Withdraw"){//Withdraw
                if(!isset($_SESSION['CWOTP'])){//not verified yet
                    $atm = new ATM();
                    $atm->getAtmData();
                    $_SESSION['WOTP'] = $atm->sendOTP($customer, $this->generateOTP());
                    return false;
                }else{
                    unset($_SESSION['WOTP']);
                    return true;
                }
            }
            else{//Transfer
                if(!isset($_SESSION['CTOTP'])){//not verified yet
                    $atm = new ATM();
                    $atm->getAtmData();
                    $_SESSION['TOTP'] = $atm->sendOTP($customer, $this->generateOTP());
                    return false;
                }else{
                    unset($_SESSION['TOTP']);
                    return true;
                }
            }
        }
    }

    /**
     * Checks if the card has expired
     * @param Card $card card info
     * @return bool true (OK), false (Expired)
     */
    public function CheckExpDate(Card $card){//At login
        $date = new DateTime($card->getDate());
        $today = new DateTime();
        $result = $today->diff($date)->format('%R');//comparing

        if ($result === '+')
            return true;
        else
            return false;
    }

    /**
     * Detects fraud if current ATM's location is different with last transaction ATM's location,
     * Then sends the user OTP for identity verification.
     * @param Customer $customer customer's info
     * @param ATM $atm current atm
     * @return mixed string (OTP), true (no fraud detected), false (Database Error) 
     */
    public function CheckLocation(Customer $customer,ATM $ATM){//At login
        if(strtolower($customer->getCity()) == strtolower($ATM->getCity()))
            return true;
        else{
            try{
                $SSN =  $customer->getSSN();
                $sql = "SELECT ATM.City FROM Transaction INNER JOIN ATM ON Transaction.AtmID = ATM.ID WHERE Transaction.SSN = '$SSN' ORDER BY Transaction.ID DESC LIMIT 1;";
                $result = $this->db->join($sql);//special db function for join statement
                if($result){
                    $lastLocation = $result['City'];
                    if(strtolower($lastLocation) == strtolower($ATM->getCity()))//Last transaction's location with current ATM's location
                    return true;
                    else{
                        $OTP = $ATM->sendOTP($customer, $this->generateOTP());
                        return $OTP;//fraud detected
                    }
                }
                else{
                    if($result['City'] == '')
                        return true;//1st transaction
                    
                    return false;//error in Database
                }
            }
            catch(Exception $e){
                return false;
            }
        }
    }
}
?>
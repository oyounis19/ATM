<?php
// require_once __DIR__."/Verification.php";
require_once __DIR__."/../Controllers/DBconnector.php";
// require_once __DIR__."/Models/Transaction.php";
// require_once __DIR__."/Models/ATM.php";

class Account {
    private $id;
    private $balance;
    private $type;
    private $state;
    private $db;
    
    public function __construct($id = null, $balance = null, $type = null, $state = null) {
        if($id && $balance && $type){
            $this->id = $id;
            $this->balance = $balance;
            $this->type = $type;
        }
        $this->db = new DBConnector();
    }

    public function getId() {
        return $this->id;
    }
    public function setId(int $id) {
        $this->id = $id;
    }
    public function getBalance() {
        return $this->balance;
    }
    public function setBalance(float $balance) {
        $this->balance = $balance;
    }
    public function getType() {
        return $this->type;
    }
    public function setType(string $type) {
        $this->type = $type;
    }
    public function getState(){
        return $this->state;
    }
    public function setState(string $State)
    {
        $this->state = $State;
    }  
     public function __construct() {
        
     }
    /*public function __construct($id, $balance, $type) {
        $this->id = $id;
        $this->balance = $balance;
        $this->type = $type;
        $this->db = new DBConnector();
    }*/

    /**
     * @param account_id The recipent's account id 
     * @param amount The Transfer amount
     * @return int 0 (The balance is insufficient), 1 (recipent's account id is wrong), 3 (Transfer is done)
     */
    public function transfer($account_id, $amount) {//Composition required
        
        //VERIFICATION goes here
        if($amount > $this->balance)
            return 0;

        $result = $this->db->select("`Account`", "*", "ID=?", array($account_id));

        if(!$result)
            return 1;
        
        $this->db->update("`Account`", array("Balance"=>$this->balance-$amount),"ID=?", array($this->id));
        $this->db->update("`Account`", array("Balance"=>$this->balance+$amount),"ID=?", array($account_id));
        //saveTransaction(this->id,);
        return 2;
    }

    public function deposit($amount) {//Composition required
        if(!$this->db->update("`Account`", array("Balance"=>$this->balance+$amount), "ID=?", array($this->id)))
            return false;
        //add the ATM balance
        //saveTransaction();
        return true;
    }

    /**
     * @param amount The Withdraw amount
     * @return int 0 (The balance is insufficient), 1 (Error in DB), 2 (Transfer is done)
     */
    public function withdraw($amount){//Composition required
        //VERIFICATION goes here
        if($amount > $this->balance)
            return 0;
        
        if(!$this->db->update("`Account`", array("Balance"=>$this->balance-$amount),"ID=?", array($this->id)))
            return 1;

        //decrease the ATM balance
        //saveTransaction();
        return 2;
    }

    public function viewTransactionHistory() {//Composition required
        return $this->db->select("`Transaction`", "*", "AccountID=?", array($this->id));
    }

    public function __destruct() {
        $this->db->close();
    }
}
?>
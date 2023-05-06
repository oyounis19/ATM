<?php
// require_once __DIR__."/Verification.php";
require_once __DIR__."/../Controllers/DBconnector.php";
require_once __DIR__."/Transaction.php";
// require_once __DIR__."/Models/ATM.php";

class Account {
    private $id;
    private $balance;
    private $type;
    private $state;
    
    public function __construct($id = null, $balance = null, $type = null) {
        if($id && $balance && $type){
            $this->id = $id;
            $this->balance = $balance;
            $this->type = $type;
        }
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
    public function setState(string $State) {
        $this->state = $State;
    }  
}
?>
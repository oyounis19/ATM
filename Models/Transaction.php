<?php
    class Transaction
    {
        private string $type;
        private string $time;
        private $date;
        private $amount;
        private DBconnector $e;

    
	public function getType() {
		return $this->type;
	}
	
	
	public function setType(string $type){
		$this->type = $type;
		return $this;
	}
    


	public function getTime(): string {
		return $this->time;
	}
	
	
	public function setTime(string $time): self {
		$this->time = $time;
		return $this;
	}

	
	public function getDate() {
		return $this->date;
	}
	
	
	public function setDate($date): self {
		$this->date = $date;
		return $this;
	}

	
	public function getAmount() {
		return $this->amount;
	}
	
	public function setAmount($amount): self {
		$this->amount = $amount;
		return $this;
	}
    // public function saveTransaction($accountid , $SSN, ATM $x ) 
    // {
    //     $e=new DBConnector();
        
    //     $e ->dbconnect();
    //     $e ->modify("insert into `Transaction`(Account_ID , SSN, ATM_ID, Amount ,`Date` , State , Type , recipient_account_ID ) 
    //     values($accountid , $SSN , ".$x->getID()." ,".$this ->amount." , ".$this->date." ,  )");

    // } 
}
?>
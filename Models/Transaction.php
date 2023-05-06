<?php
		require_once 'ATM.php';
		require_once 'Account.php';
		require_once '../Controllers/DBconnector.php';
		require_once '../View/transaction.php';
	 class Transaction
    {
        private $type ;
		private $date;
        private $amount;


		public function __construct($type, $date , $amount)
		{
			$this->type = $type;
			$this->date = $date;
			$this->amount = $amount;
	
		}
		public function getType() {
		return $this->type;
	}
		
	public function setType(string $type){
		$this->type = $type;
		return $this;
	}
    
	public function getDate() {
		return $this->date;
	}
		
	public function setDate($date)
	{
		$this->date = $date;
		return $this;
	}
	
	public function getAmount()
	{
		return $this->amount;
	}
	
	public function setAmount($amount): self {
		$this->amount = $amount;
		return $this;
	}

	 public function saveTransaction(User $m, Customer $z, Account $e, ATM $x , $Tstate , $recAccID)
	 {
		$db = new DBConnector();
		if (!($this->type == "Transfer"))
		 {
			$recAccID = null;
		 }
		$ok = $db ->insert("`Transaction`",array("Account_ID"=>$e->getId(),"SSN"=>$z->getSSN(),"ATM_ID"=>$x->getID(),
								"Amount"=>$this->amount,"Date"=>"now()","State"=>$Tstate,"Type"=>$this->type,
								"recipient_account_ID"=>$recAccID));
		
		if($ok == true)

		{
			$x->notifyUser($z->getEmail(),$this->type,$this->amount,$e->getBalance(),$x->state,$m->getName(),$x ->getID());
		}			
		
	 } 
}
?>

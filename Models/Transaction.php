<?php
		require_once 'ATM.php';
		require_once 'Account.php';
		require_once '../Controllers/DBconnector.php';
		require_once '../View/transaction.php';
	class Transaction {
        private $type;
		private $date;
        private $amount;
		private $id;
		private $state;

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
		
		public function setAmount($amount)
		{
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
			//	Customer $customer, Transaction $transaction, Account $account
				$x->notifyUser();
			}

			
		} 

		/**
		 * @return mixed
		 */
		public function getId() {
			return $this->id;
		}
		
		/**
		 * @param mixed $id 
		 * @return self
		 */
		public function setId($id): self {
			$this->id = $id;
			return $this;
		}

		/**
		 * @return mixed
		 */
		public function getState() {
			return $this->state;
		}
		
		/**
		 * @param mixed $state 
		 * @return self
		 */
		public function setState($state): self {
			$this->state = $state;
			return $this;
		}
}
?>

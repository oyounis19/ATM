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
		private $db;

		public function __construct($type = null, $date = null, $amount = null, $id = null, $state = null)
		{
			if($type && $date && $amount && $id && $state){
				$this->type = $type;
				$this->date = $date;
				$this->amount = $amount;
				$this->id = $id;
				$this->state = $state;
			}
			$this->db = new DBConnector();
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
		
		public function setAmount($amount) {
			$this->amount = $amount;
		}

		public function saveTransaction(Customer $customer, Account $sender, ATM $atm , Account $reciever)
		{
			if (!($this->type == "Transfer")) {
				$recAccID = null;
			}
			$ok = $this->db ->insert("`Transaction`",array("AccountID"=>$sender->getId(),"SSN"=>$customer->getSSN(),"AtmID"=>$atm->getID(),
									"Amount"=>$this->amount,"Date"=>"now()","State"=>$this->state,"Type"=>$this->type,
									"receiverId"=>$reciever->getId()));
			
			if($ok) 
				$atm->notifyUser($customer, $this, $sender);
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
		public function __destruct() {
			$this->db->close();
		}
}
?>

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

		public function __construct($type = null, $date = null, $amount = null, $id = null, $state = null){
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
			
		public function setDate($date) {
			$this->date = $date;
			return $this;
		}
		
		public function getAmount(){
			return $this->amount;
		}
		
		public function setAmount($amount) {
			$this->amount = $amount;
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


		public function saveTransaction(Customer $customer, Account $sender, ATM $atm , Account $reciever){
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
		 * @param $account_id The recipent's account id 
		 * @param $amount The Transfer amount
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
		 * @param $amount The Withdraw amount
		 * @return int 0 (The balance is insufficient), 1 (Error in DB), 2 (Transfer is done)
		 */
		public function withdraw(Transaction  $transaction, Customer $customer, ATM $atm){//Composition required
			//VERIFICATION goes here
			if($transaction->getAmount() > $this->balance)
				return 0;//Save but denied
			
			if(!$this->db->update("`Account`", array("Balance"=>$this->balance-$transaction->getAmount()),"ID=?", array($this->id)))
				return 1;

			//decrease the ATM balance
			$transaction->saveTransaction($customer, );
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

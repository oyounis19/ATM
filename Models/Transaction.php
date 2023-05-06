<?php
		require_once 'ATM.php';
		require_once 'Account.php';
		require_once 'customer.php';
		require_once '../Controllers/DBconnector.php';

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
		
		public function setType($type){
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
		
		public function setAmount($amount)
		{
			$this->amount = $amount;
		}

		public function getId() {
			return $this->id;
		}
		

		public function setId($id): self {
			$this->id = $id;
			return $this;
		}


		public function getState() {
			return $this->state;
		}
		

		public function setState($state): self {
			$this->state = $state;
			return $this;
		}


		public function saveTransaction(Customer $customer, Account $sender, ATM $atm , Account $reciever){
			if (!($this->type == "Transfer")) {
				$reciever->getId() == null;
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
		public function transfer(Account $sender, Account $reciever ,ATM $atm , Customer $customer ) {//Composition required
			
			//VERIFICATION goes here
			if($this->amount > $sender->getBalance())
				return 0;

			$result = $this->db->select("`Account`", "*", "ID=?", array($reciever));

			if(!$result)
				return 1;
			
			$this->db->update("`Account`", array("Balance"=>$sender->getBalance()-$this->amount),"ID=?", array($sender->getId()));
			$this->db->update("`Account`", array("Balance"=>$reciever->getBalance()+$this->amount),"ID=?", array($reciever->getId()));
			$this->saveTransaction($customer, $sender, $atm , $reciever);
			return 2;
		}

		public function deposit(Account $sender, Account $reciever ,ATM $atm , Customer $customer  ) {//Composition required
			if(!$this->db->update("`Account`", array("Balance"=>$sender->getBalance()+$this->amount), "ID=?", array($sender->getid())))
				return false;
			//add the ATM balance
			$atm->setBalance($atm->getBalance()+$this->amount);
			$this->saveTransaction($customer, $sender, $atm , $reciever);
			return true;
		}

		/**
		 * @param $amount The Withdraw amount
		 * @return int 0 (The balance is insufficient), 1 (Error in DB), 2 (Transfer is done)
		 */
		public function withdraw(Account $sender, Account $reciever ,ATM $atm , Customer $customer){//Composition required
			//VERIFICATION goes here
			if($this->amount > $sender->getBalance())
				return 0;//Save but denied
			
			if(!$this->db->update("`Account`", array("Balance"=>$sender->getBalance()-$this->amount),"ID=?", array($sender->getId())))
				return 1;

				$atm->setBalance($atm->getBalance()-$this->amount);
				$this->saveTransaction($customer, $sender, $atm , $reciever);
			return 2;
		}

		public function viewTransactionHistory(Account $sender) {//Composition required
			return $this->db->select("`Transaction`", "*", "AccountID=?", array($sender->getId()));
		}

		public function __destruct() {
			$this->db->close();
		}
}
?>

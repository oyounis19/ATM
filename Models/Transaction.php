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


	public function __construct($type = null, $amount = null){
		if($type && $amount){
			$this->type = $type;
			$this->amount = $amount;
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
	
	public function setAmount($amount){
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

	/**
	 * @param Customer $customer customer's data 
	 * @param Account $sender sender's data 
	 * @param ATM $atm current ATM
	 * @param Account $reciever|null receipent's account
	 */
	private function saveTransaction(Customer $customer, Account $sender, ATM $atm , Account $reciever = null){
		$ok = 0;
		$currentDate = date("Y-m-d");
		$this->state? $enumDbState = 1 : $enumDbState = 2;
		if($reciever){//Transfer Transaction
			$ok = $this->db ->insert("`Transaction`",array("AccountID"=>$sender->getId(),"SSN"=>$customer->getSSN(),"AtmID"=>$atm->getID(),
								"Amount"=>$this->amount,"Date"=>"$currentDate","State"=>$enumDbState,"Type"=>$this->type,
								"receiverId"=>$reciever->getId()));
		}else{//Deposit or Withdraw
			$ok = $this->db ->insert("`Transaction`",array("AccountID"=>$sender->getId(),"SSN"=>$customer->getSSN(),"AtmID"=>$atm->getID(),
									"Amount"=>$this->amount,"Date"=>"$currentDate","State"=>$enumDbState,"Type"=>$this->type));
		}
		if($ok) 
			$atm->notifyUser($customer, $this, $sender);
	} 


	/**
	 * @param Account $sender sender's account 
	 * @param Account $reciever receipent's account 
	 * @param ATM $atm current ATM
	 * @param Customer $customer customer's data
	 * @return int 0 (The balance is insufficient), 1 (recipent's account id is wrong), 2 (Transfer is done)
	 */
	public function transfer(Account $sender, Account $reciever, ATM $atm , Customer $customer) {//Composition required
		//if(Verification->verifyTransaction())//Waiting for @AhmedEbrahim2322004{
		//	$this->state = false;
		//	$this->saveTransaction($customer, $account, $atm);
		//	return false;
		// }
		$this->state = true;//Fraud not detected
		if($this->amount > $sender->getBalance()){
			$this->state = false;//saved but denied
			$this->saveTransaction($customer, $sender, $atm , $reciever);
			return 0;
		}

		$result = $this->db->select("`Account`", "*", "ID=?", array($reciever->getId()));

		if(!$result)
			return 1;
		$reciever->setBalance($result[0]['Balance']);

		$this->db->update("`Account`", array("Balance"=>   $sender->getBalance() - $this->amount),"ID=?", array($sender->getId()));
		$this->db->update("`Account`", array("Balance"=> $reciever->getBalance() + $this->amount),"ID=?", array($reciever->getId()));

		$sender->setBalance($sender->getBalance() - $this->amount);
		$reciever->setBalance($reciever->getBalance() + $this->amount);
		$this->saveTransaction($customer, $sender, $atm , $reciever);
		return 2;
	}
	
	/**
	 * @param Account $account sender's account 
	 * @param ATM $atm current ATM
	 * @param Customer $customer customer's data
	 * @return int 0 (DB error), 1 (Deposit is done)
	 */
	public function deposit(Account $account, ATM $atm, Customer $customer) {//Composition required
		//if(Verification->verifyTransaction())//Waiting for @AhmedEbrahim2322004{
		//	$this->state = false;
		//	$this->saveTransaction($customer, $account, $atm);
		//	return false;
		// }
		$this->state = true;//Fraud not detected
		if(!$this->db->update("`Account`", array("Balance"=>$account->getBalance() + $this->amount), "ID=?", array($account->getid())))
			return 0;

		$this->db->update("`ATM`", array("Balance"=>$atm->getBalance() + $this->amount),"ID=?", array($atm->getID()));
		$atm->setBalance($atm->getBalance() + $this->amount);
		$account->setBalance($account->getBalance() + $this->amount);
		$this->saveTransaction($customer, $account, $atm);
		return 1;
	}

	/**
	 * @param Account $account sender's account 
	 * @param ATM $atm current ATM
	 * @param Customer $customer customer's data
	 * @return int 0 (Insufficient Account Balance), 1 (DB error), 2 (Withdraw done),3 (Insufficient ATM balance)
	 */
	public function withdraw(Account $account, ATM $atm , Customer $customer){//Composition required
		//if(Verification->verifyTransaction())//Waiting for @AhmedEbrahim2322004{
		//	$this->state = false;
		//	$this->saveTransaction($customer, $account, $atm);
		//	return false;
		// }
		if($this->amount > $account->getBalance()){//Insufficient Account Balance
			$this->state = false;
			$this->saveTransaction($customer, $account, $atm);
			return 0;//Save but denied
		}
		if($this->amount > $atm->getBalance())//Insufficient ATM balance
			return 3;
		// if(Verification->verifyTransaction())//Waiting for @AhmedEbrahim2322004
		$this->state = true;
		if(!$this->db->update("`Account`", array("Balance"=>$account->getBalance() - $this->amount),"ID=?", array($account->getId())))
			return 1;

		$this->db->update("`ATM`", array("Balance"=>$atm->getBalance()-$this->amount),"ID=?", array($atm->getID()));

		$atm->setBalance($atm->getBalance() - $this->amount);
		$account->setBalance($account->getBalance() - $this->amount);
		$this->saveTransaction($customer, $account, $atm);
		return 2;
	}

	/**
	 * @param Account $account account 
	 * @return array transactions
	 */
	public function viewTransactionHistory(Account $account) {//Composition required
		return $this->db->select("`Transaction`", "*", "AccountID=?", array($account->getId()));
	}

	public function __destruct() {
		$this->db->close();
	}
}
?>

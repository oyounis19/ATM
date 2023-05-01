<?php

    class Account {
        private $id;
        private $balance;
        private $type;

    public function getId() 
    {
        return $id;
    }
    public function setId(int $id) 
    {
        this->$id = $id;
    }
    public function getBalance() 
    {
        return $balance;
    }
    public function setBalance(float $balance) 
    {
        this->$balance = $balance;
    }
    public function getType() 
    {
        return $type;
    }
    public function setType(string $type) 
    {
        this->$type = $type;
    }
    public function __construct($id, $balance, $type) 
    {
        $this->id = $id;
        $this->balance = $balance;
        $this->type = $type;
    }

    public function viewBalance() 
    {
        return $this->balance;
    }

    public function transfer($account, $amount) 
    {
        if ($amount > $this->balance) 
        {
            return false;
        } 
        else 
        {
            $this->balance -= $amount;
            $account->deposit($amount);
            return true;
        }
    }

    public function withdraw($amount) 
    {
        if ($amount > $this->balance) 
        {
            return false;
        } else 
        {
            $this->balance -= $amount;
            return true;
        }
    }

    public function deposit($amount) 
    {
        $this->balance += $amount;
        return true;
    }

    public function viewTransactionHistory() {
      // Code to retrieve and return transaction history
    }
}

?>
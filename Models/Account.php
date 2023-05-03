<?php
    require_once "Verification.php";
    require_once "../Models/DBconnector.php"

    class Account {
        private $id;
        private $balance;
        private $type;
        private DBconnector $e;


    public function getId() 
    {
        return $this->id;
    }
    public function setId(int $id) 
    {
        $this->id = $id;
    }
    public function getBalance() 
    {
        return $this->balance;
    }
    public function setBalance(float $balance) 
    {
        $this->balance = $balance;
    }
    public function getType() 
    {
        return $this->type;
    }
    public function setType(string $type) 
    {
        $this->type = $type;
    }
    public function __construct($id, $balance, $type) 
    {
        $this->id = $id;
        $this->balance = $balance;
        $this->type = $type;
    }

    public function viewBalance() 
    {
        $this->e=new DBconnector();
        if($this->e ->dbconnect())
        {
            $qry="SELECT Balance FROM `Account` WHERE Account_ID = ".$this->id." ";
            $result = $this->e->select($qry);
            if(!$result)
            {
                echo "Error in Query";
                return false;
            }
        }
        else
        {
            echo "Error in database Connection";
            return false;
        }
    }

    public function transfer($account, $amount) 
    {
        $verify = new Verification();
        if (!$verify) 
        {
            return false;
        } 
        else 
        {
            $this->e=new DBconnector();
            if($this->e ->dbconnect())
                {
                    $qry="SELECT Balance FROM `Account` WHERE Account_ID = ".$this->id." ";
                    $result = $this->e->select($qry);
                    if(!$result)
                    {
                        echo "Error in Query";
                        return false;
                    }
                }
            else
                {
                    echo "Error in database Connection";
                    return false;
                }
            $this->balance -= $amount;
            $account->deposit($amount);
            return true;
        }
    }

    public function withdraw($amount) 
    {
        $verify = new Verification();
        if (!$verify)
        {
            return false;
        } 
        else 
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
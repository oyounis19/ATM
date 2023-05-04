<?php
    //require_once "Verification.php";
    require_once "../Controllers/DBconnector.php";

    class Account {
        private $id;
        private $balance;
        private $type;
        private DBConnector $e;


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
        $this->e=new DBConnector(); 
        if($this->e->__construct())
        {
            $result = $this->e->select("`Account`","Balance","WHERE", "Account_ID=?" , array($id) );
            if(!$result)
            {
                echo "Error in Query";
                return false;
            }
            else
            {
                echo "connected";
                $this->balance = $result[0]["Balance"];
                $this->type = $result[0]["Type"];
                return true;
                
            }
        }
        else
        {
            echo "Error in database Connection";
            return false;
        }
    }
    /*
    public function transfer($account, $amount) {
        $verify = new Verification();
        if (!$verify) 
        {
            return false;
        } 
        else 
        {
            $this->e=new DBConnector(); 
        if($this->e->DBConnector())
        {
        try {
            $this->e->beginTransaction();
    
            if ($amount > $this->balance) {
                throw new Exception("Insufficient balance");
            }
    
            // Subtract the transferred amount from this account
            $this->balance -= $amount;
            $stmt1 = $this->e->prepare("UPDATE accounts SET balance = balance - :amount WHERE id = :id AND type = :type");
            $stmt1->bindParam(':amount', $amount);
            $stmt1->bindParam(':id', $this->id);
            $stmt1->bindParam(':type', $this->type);
            $stmt1->execute();
    
            // Add the transferred amount to the other account
            $account->balance += $amount;
            $stmt2 = $this->e->prepare("UPDATE accounts SET balance = balance + :amount WHERE id = :id AND type = :type");
            $stmt2->bindParam(':amount', $amount);
            $stmt2->bindParam(':id', $account->id);
            $stmt2->bindParam(':type', $account->type);
            $stmt2->execute();
    
            $this->e->commit();
            return "Transfer successful";
        } catch (Exception $e) {
            $this->e->rollback();
            return $e->getMessage();
        }
        }
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
        $this->e=new DBConnector(); 
        if($this->e->DBConnector())
        {
            $result = $this->e->select("`Account`","Balance","WHERE", "id=?", array($id) );
            if(!$result)
            {
                echo "Error in Query";
                return false;
            }
            else
            {
                echo "connected";
                return true;
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
    }*/
}

?>
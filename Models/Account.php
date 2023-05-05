<?php
    //require_once "Verification.php";
    require_once "../Controllers/DBconnector.php";

    class Account {
        private $id;
        private $balance;
        private $type;
        private $db;


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


    // public function viewBalance() 
    // {
    //     $this->db=new DBConnector();
    //         $result = $this->db->select("`Account`","Balance","Account_ID=?", array($this->id) );
    //             $this->balance = $result[0]['Balance'];
    //             // return true;
    //     //     }
    //     // }
    //     // else
    //     // {
    //     //     echo "Error in database Connection";
    //     //     return false;
    //     // }
    // }
    public function transfer($account_id, $amount) 
    {
        // $verify = new Verification();
        // if (!$verify) 
        // {
        //     return false;
        // } 
        // else 
        // {
        $this->e=new DBConnector(); 
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
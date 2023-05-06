<?php
require_once(__DIR__ . '/../Controllers/DBconnector.php');
require_once(__DIR__."/Account.php");
require_once(__DIR__."/customer.php");
require_once (__DIR__."/User.php");
require_once(__DIR__."/Card.php");
class admin extends User
{
    private string $userName;
    private string $passWord;

    public function __construct($user, $pass){
        $this->userName = $user;
        $this->passWord = $pass;
    } 
    public function login($user, $pass)
    {
        $db = new DBconnector();
        $hashedPassWord = hash("sha256", $this->passWord);
        return $db->select("`Employee`", "*", "UserName=? AND Password=?", array($this->userName, $hashedPassWord));
    }
    public function logout()
    {
        session_unset();
        session_destroy();
    }
    public function CreateCard(){
        $card = new Card();
        $card->generateCard();
        $data["ID"] = $card->getId();
        $data["ExpDate"] = $card->getDate();
        $data["CVV"] = $card->getCVV();
        $db = new DBConnector();
        $result = $db->insert("CreditCard",$data);
        while(!$result){
            $this->CreateCard();
        }
        return $card;
    }

    public function addCustomer(customer $customer)
    {
        $card = $this->CreateCard();
        
        $data["FirstName"] = $customer->getFirstName();
        $data["LastName"] = $customer->getLastName();
        $data["Email"] = $customer->getEmail();
        $data["Street"] = $customer->getStreet();
        $data["Area"] = $customer->getArea();
        $data["City"] = $customer->getCity();
        $data["SSN"] = $customer->getSSN();
        $data["PIN"] = $customer->getPin();
        $data["Fingerprint"] = $customer->getFingerprint();
        $data["CardID"] = $card->getId();

        $db = new DBConnector();
        $result = $db->insert("User",$data);
        if(!$result)
            return false;

        $account = new Account();
        $account->setType("Current");

        $result = $this->createAccount($account,$customer);
        if(!$result)
            return false;

        return true;
    }

    public function editCustomer()
    {
    }
    public function deleteCustomer($customerSNN)
    {
        $db = new DBconnector();
        $ok = $db->delete("'User'", "SSN=?", array($customerSNN));
        return $ok;
    }
    public function createAccount(Account $account, Customer $customer)
    {
        $db = new DBconnector();
        $data["SSN"] = $customer->getSSN();
        $data["Type"] = $account->getType();
        $result = $db->insert("Account", $data);
        return $result;
    }
    public function deleteAccount(Account $account)
    {
        $db = new DBconnector();
        $result = $db->delete("Account", "ID=?", array($account->getId()));
        return $result;
    }

    public function editAccount(Account $account)
    {
        $db = new DBconnector();
        $data["Balance"] = $account->getBalance();
        $data["State"] = $account->getState();
        $data["Type"] = $account->getType();
        $result = $db->update("Account", $data, "ID=?", array($account->getId()));
        return $result;
    }

    public function unblockCreditCard()
    {
    }
    public function viewAtmTransactions()
    {
    }
    public function addAtm($city, $area, $street)
    {
        $row = 0;
        $db = new DBconnector();
        $data["City"] = $city;
        $data["Area"] = $area;
        $data["Street"] = $street;
        $data["Balance"] = 0;
        $row = $db->insert("ATM", $data);

        return $row > 0 ? true : false;
    }
    public function deleteAtm($atmId)
    {
        $db = new DBconnector();
        $ok = $db->delete("ATM", "ID = ?", array($atmId));
        return $ok;
    }
    public function viewAtm()
    {
    }
    public function createAdmin($fName, $lName, $userName, $passWord)
    {
        $row = 0;
        $db = new DBconnector();
        $data["FirstName"] = $fName;
        $data["LastName"] = $lName;
        $data["UserName"] = $userName;
        $data["Password"] = hash("sha256", $passWord);
        $row = $db->insert("Employee", $data);

        return $row > 0 ? true : false;
    }
}

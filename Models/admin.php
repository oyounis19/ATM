<?php
require_once(__DIR__ . '/../Controllers/DBconnector.php');



require_once "User.php";
class admin extends User
{
    private string $userName;
    private string $passWord;

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    public function setPassWord($passWord)
    {
        $this->passWord = $passWord;
    }


    public function login()
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
    public function addCustomer()
    {
    }
    public function editCustomer()
    {
    }
    public function deleteCustomer()
    {
    }
    public function createAccount(Account $account, Customer $customer, Card $card)
    {
        $db = new DBconnector();
        $data["SSN"] = $customer->getSSN();
        $data["Cardid"] = $card->getId();
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

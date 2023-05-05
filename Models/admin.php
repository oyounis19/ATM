<?php
require_once (__DIR__.'/../Controllers/DBconnector.php');



require_once "User.php";
class admin extends User
{
    private string $userName;
    private string $passWord;


    public function login($_userName, $_passWord)
    {
        $db = new DBconnector();
        $hashedPassWord = hash("sha256", $_passWord);
        return $db->select("`Employee`", "*", "UserName=? AND Password=?", array($_userName, $hashedPassWord));
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
    public function createAccount()
    {
    }
    public function deleteAccount()
    {
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

        return $row > 0? true: false; 
    }
    public function deleteAtm()
    {

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

        return $row > 0? true: false; 
    }
}

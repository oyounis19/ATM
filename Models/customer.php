<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/../Controllers/DBconnector.php');
require_once "user.php";

class Customer extends user
{
    private string $SSN;
    private string $FirstName;
    private string $LastName;
    private string $PIN;
    private string $Fingerprint;
    private string $Street;
    private string $Area;
    private string $City;
    private string $Email;
    private string $CardID;
    private string $phoneNO;
    private $db;
    public function getId()
    {
        return $this->CardID;
    }
    public function getPin()
    {
        return $this->PIN;
    }
    public function getSSN()
    {
        return $this->SSN;
    }
    public function getFirstName()
    {
        return $this->FirstName;
    }
    public function getLastName()
    {
        return $this->LastName;
    }
    public function getFingerprint()
    {
        return $this->Fingerprint;
    }
    public function getArea()
    {
        return $this->Area;
    }
    public function getCity()
    {
        return $this->City;
    }
    public function getStreet()
    {
        return $this->Street;
    }
    public function getEmail()
    {
        return $this->Email;
    }
    public function getPhoneNO()
    {
        return $this->phoneNO;
    }
    public function __construct($SSN = null, $FirstName = null, $LastName = null, $PIN = null, $Fingerprint = null, $Street = null, $Area = null, $City = null, $Email = null, $CardID = null, $phoneNO = null)
    {
        if ($SSN)
            $this->SSN = $SSN;
        if ($FirstName)
            $this->FirstName = $FirstName;
        if ($LastName)
            $this->LastName = $LastName;
        if ($PIN)
            $this->PIN = $PIN;
        if ($Fingerprint)
            $this->Fingerprint = $Fingerprint;
        if ($Street)
            $this->Street = $Street;
        if ($Area)
            $this->Area = $Area;
        if ($City)
            $this->City = $City;
        if ($Email)
            $this->Email = $Email;
        if ($CardID)
            $this->CardID = $CardID;
        if ($phoneNO)
            $this->phoneNO = $phoneNO;

        $this->db = new DBConnector;
    }
    private function pinVerification($pass)
    {
        $password = hash("sha256", $pass);
        return $password;
    }
    private function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace(" ", "", $data);
        return $data;
    }
    public function login($id, $pass)
    {
        if (empty($id) or empty($pass)) {
            return false;
        } else if (isset($id) and isset($pass)) {
            $id = $this->validate($id);
            $hashed_password = $this->pinVerification($pass);
            $result = $this->db->select("User", "*", "CardID=? AND PIN=?", array($id, $hashed_password));
            $Block = $this->db->select("CreditCard", "State", "CardID=?", array($id));
            if ($Block == 'Blocked') {
                return 2;
            }
            if ($result) {
                if (count($result) == 0) {
                    return false;
                } else if ($result) {
                    //SetVariables
                    $this->SetVariables($result);
                    //sessions
                    $this->setSessions();
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function logOut()
    {
        session_start();
        session_unset();
        session_destroy();
        header("location:index.php");
    }
    public function resetPIN($pass1, $pass2, $CardID)
    {
        if (empty($pass1) or empty($pass2)) {
            return 1;
        } else {
            if ($pass1 != $pass2) {
                return 2;
            } else {
                $hashed_password = $this->pinVerification($pass1);
                $table = 'User';
                $data = array('Pin' => $hashed_password);
                $where = 'CardID =?';
                $params = array($CardID);
                $affected_rows = $this->db->update($table, $data, $where, $params);
                return $affected_rows;
            }
        }
    }
    public function blockcard($CardID)
    {
        $table = 'Card';
        $data = array('State' => "Block");
        $where = 'Card_ID =?';
        $params = array($CardID);
        $affected_rows = $this->db->update($table, $data, $where, $params);
        return $affected_rows;
    }
    public function accounts($SSN)
    {
        $result = $this->db->select("Account", "ID , Type , Balance", "SSN=?", array($SSN));
        return $result;
    }
    public function FingerprintValidation()
    {
        $target_file1 = $_FILES['image']["tmp_name"];
        $hash1 = md5_file($target_file1);
        $result = $this->db->select("User", "*", "Fingerprint=?", array($hash1));
        $cardid = $result[0]['CardID'];
        $Block = $this->db->select("CreditCard", "State", "CardID=?", array($cardid));
        if ($Block == 'Blocked') {
            return 2;
        }
        if ($result) {
            if (count($result) == 0) {
                return false;
            } else if ($result) {
                //SetVariables
                $this->SetVariables($result);
                //sessions
                $this->setSessions();
                return true;
            }
        } else {
            return false;
        }
    }
    // this function is called if user choose Account from his Accounts, it will take account_id
    public function chooseAccount($account_id)
    {
        $result = $this->db->select("Account", "ID,Balance,State,Type", "ID=?", array($account_id));
        $_SESSION['account_id'] = $result[0]['ID'];
        $_SESSION['balance'] = $result[0]['Balance'];
        $_SESSION['state'] = $result[0]['State'];
        $_SESSION['type'] = $result[0]['Type'];
    }
    public function __destruct()
    {
        $this->db->close();
    }
    // this function called two times : if user logged by card or fingerprint
    private function SetVariables($row)
    {
        $this->SSN = $row[0]['SSN'];
        $this->CardID = $row[0]['CardID'];
        $this->Fingerprint = $row[0]['Fingerprint'];
        $this->PIN = $row[0]['PIN'];
        $this->FirstName = $row[0]['FirstName'];
        $this->LastName = $row[0]['LastName'];
        $this->Street = $row[0]['Street'];
        $this->Area = $row[0]['Area'];
        $this->City = $row[0]['City'];
        $this->Email = $row[0]['Email'];

    }
    /* this function called two times : if user logged by card or fingerprint
        and this sessions will be available for all pages not private but this method is the private one
    */
    private function setSessions()
    {
        $_SESSION['SSN'] = $this->SSN;
        $_SESSION['card_id'] = $this->CardID;
        $_SESSION['fingerpint'] = $this->Fingerprint;
        $_SESSION['upass'] = $this->PIN;
        $_SESSION['fName'] = $this->FirstName;
        $_SESSION['lName'] = $this->LastName;
        $_SESSION['Street'] = $this->Street;
        $_SESSION['Area'] = $this->Area;
        $_SESSION['City'] = $this->City;
        $_SESSION['Email'] = $this->Email;
    }
}

?>
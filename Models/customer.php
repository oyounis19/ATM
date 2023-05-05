<?php
session_start();
require_once "../Controllers/DBconnector.php";
require_once "user.php";
class customer extends user
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
    private $db;
    public function setId()
    {

        $this->CardID = $_SESSION['card_id'];
    }
    public function getId()
    {
        return $this->CardID;
    }
    public function setPin()
    {
        $this->PIN = $_SESSION['pass'];
    }
    public function getPin()
    {
        return $this->PIN;
    }
    public function setSSN()
    {
        $this->SSN = $_SESSION['SSN'];
    }
    public function getSSN()
    {
        return $this->SSN;
    }
    public function setFirstName()
    {
        $this->FirstName = $_SESSION['fName'];
    }
    public function getFirstName()
    {
        return $this->FirstName;
    }
    public function setLastName()
    {
        $this->LastName = $_SESSION['lName'];
    }
    public function getLastName()
    {
        return $this->LastName;
    }
    public function setFingerprint()
    {
        $this->Fingerprint = $_SESSION['fingerpint'];
    }
    public function getFingerprint()
    {
        return $this->Fingerprint;
    }
    public function setArea()
    {
        $this->Area = $_SESSION['Area'];
    }
    public function getArea()
    {
        return $this->Area;
    }
    public function setCity()
    {
        $this->City = $_SESSION['City'];
    }
    public function getCity()
    {
        return $this->City;
    }
    public function setStreet()
    {
        $this->Street = $_SESSION['Street'];
    }
    public function getStreet()
    {
        return $this->Street;
    }
    public function setEmail()
    {
        $this->Email = $_SESSION['Email'];
    }
    public function getEmail()
    {
        return $this->Email;
    }
    private function pinVerification($pass)
    {
        $password = hash("sha256", $pass);
        return $password;
    }
    public function login($id, $pass)
    {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = str_replace(" ", "", $data);
            return $data;
        }
        if (empty($id) or empty($pass)) {
            return false;
        } else if (isset($id) and isset($pass)) {
            $id = validate($id);
            $hashed_password = $this->pinVerification($pass);
            $this->db = new DBconnector;
            $result = $this->db->select("User", "*", "CardID=? AND PIN=?", array($id, $hashed_password));
            if ($result) {
                if (count($result) == 0) {
                    return false;
                } else if ($result) {
                    $_SESSION['SSN'] = $result[0]['SSN'];
                    $_SESSION['card_id'] = $result[0]['CardID'];
                    $_SESSION['fingerpint'] = $result[0]['Fingerprint'];
                    $_SESSION['upass'] = $result[0]['PIN'];
                    $_SESSION['fName'] = $result[0]['First_Name'];
                    $_SESSION['lName'] = $result[0]['Last_Name'];
                    $_SESSION['Street'] = $result[0]['Street'];
                    $_SESSION['Area'] = $result[0]['Area'];
                    $_SESSION['City'] = $result[0]['City'];
                    $_SESSION['Email'] = $result[0]['Email'];
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
                $this->db = new DBconnector;
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
        $this->db=new DBConnector;
        $table = 'Card';
        $data = array('State' => "Block");
        $where = 'Card_ID =?';
        $params = array($CardID);
        $affected_rows = $this->db->update($table, $data, $where, $params);
    }
    public function accounts($SSN)
    {
        $this->db=new DBConnector;
        $result = $this->db->select("Account", "ID , Type , Balance", "SSN=?", array($SSN));
        return $result;
    } 
    public function Fingerprint()
    {
        $target_file1 = $_FILES['image']["tmp_name"];
        $hash1 = md5_file($target_file1);
        $this->db = new DBconnector;
        $result = $this->db->select("User", "*", "Fingerprint=?", array($hash1));
        if ($result) {
            if (count($result) == 0) {
                return false;
            } else if ($result) {
                $_SESSION['SSN'] = $result[0]['SSN'];
                $_SESSION['card_id'] = $result[0]['Card_ID'];
                $_SESSION['fingerpint'] = $result[0]['Fingerprint'];
                $_SESSION['upass'] = $result[0]['PIN'];
                $_SESSION['fName'] = $result[0]['First_Name'];
                $_SESSION['lName'] = $result[0]['Last_Name'];
                $_SESSION['Street'] = $result[0]['Street'];
                $_SESSION['Area'] = $result[0]['Area'];
                $_SESSION['City'] = $result[0]['City'];
                $_SESSION['Email'] = $result[0]['Email'];
                return true;
            }
        } else {
            return false;
        }
    }

}

?>
<?php

if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
  }
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
    private string $phoneNO;
    private $db;
    public function setId($card_id)
    {

        $this->CardID = $card_id;
    }
    public function getId()
    {
        return $this->CardID;
    }
    public function setPin($pin)
    {
        $this->PIN = $pin;
    }
    public function getPin()
    {
        return $this->PIN;
    }
    public function setSSN($ssn)
    {
        $this->SSN = $ssn;
    }
    public function getSSN()
    {
        return $this->SSN;
    }
    public function setFirstName($firstname)
    {
        $this->FirstName = $firstname;
    }
    public function getFirstName()
    {
        return $this->FirstName;
    }
    public function setLastName($lastname)
    {
        $this->LastName = $lastname;
    }
    public function getLastName()
    {
        return $this->LastName;
    }
    public function setFingerprint($fingerprint)
    {
        $this->Fingerprint = $fingerprint;
    }
    public function getFingerprint()
    {
        return $this->Fingerprint;
    }
    public function setArea($area)
    {
        $this->Area = $area;
    }
    public function getArea()
    {
        return $this->Area;
    }
    public function setCity($city)
    {
        $this->City = $city;
    }
    public function getCity()
    {
        return $this->City;
    }
    public function setStreet($street)
    {
        $this->Street = $street;
    }
    public function getStreet()
    {
        return $this->Street;
    }
    public function setEmail($email)
    {
        $this->Email = $email;
    }
    public function getEmail()
    {
        return $this->Email;
    }
    public function setPhoneNO($phoneNo)
    {
        $this->phoneNO = $phoneNo;
    }

    public function getPhoneNO()
    {
        return $this->phoneNO;
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
                    $this->SSN = $result[0]['SSN'];
                    $_SESSION['card_id'] = $result[0]['CardID'];
                    $this->CardID = $result[0]['CardID'];
                    $_SESSION['fingerpint'] = $result[0]['Fingerprint'];
                    $this->Fingerprint = $result[0]['Fingerprint'];
                    $_SESSION['upass'] = $result[0]['PIN'];
                    $this->PIN = $result[0]['PIN'];
                    $_SESSION['fName'] = $result[0]['FirstName'];
                    $this->FirstName = $result[0]['FirstName'];
                    $_SESSION['lName'] = $result[0]['LastName'];
                    $this->LastName = $result[0]['LastName'];
                    $_SESSION['Street'] = $result[0]['Street'];
                    $this->Street = $result[0]['Street'];
                    $_SESSION['Area'] = $result[0]['Area'];
                    $this->Area = $result[0]['Area'];
                    $_SESSION['City'] = $result[0]['City'];
                    $this->City = $result[0]['City'];
                    $_SESSION['Email'] = $result[0]['Email'];
                    $this->Email = $result[0]['Email'];
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
        $this->db = new DBConnector;
        $table = 'Card';
        $data = array('State' => "Block");
        $where = 'Card_ID =?';
        $params = array($CardID);
        $affected_rows = $this->db->update($table, $data, $where, $params);
    }
    public function accounts($SSN)
    {
        $this->db = new DBConnector;
        $result = $this->db->select("Account", "ID , Type , Balance", "SSN=?", array($SSN));
        return $result;
    }
    public function FingerprintValidation()
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
                $this->SSN = $result[0]['SSN'];
                $_SESSION['card_id'] = $result[0]['CardID'];
                $this->CardID = $result[0]['CardID'];
                $_SESSION['fingerpint'] = $result[0]['Fingerprint'];
                $this->Fingerprint = $result[0]['Fingerprint'];
                $_SESSION['upass'] = $result[0]['PIN'];
                $this->PIN = $result[0]['PIN'];
                $_SESSION['fName'] = $result[0]['First_Name'];
                $this->FirstName = $result[0]['First_Name'];
                $_SESSION['lName'] = $result[0]['Last_Name'];
                $this->LastName = $result[0]['Last_Name'];
                $_SESSION['Street'] = $result[0]['Street'];
                $this->Street = $result[0]['Street'];
                $_SESSION['Area'] = $result[0]['Area'];
                $this->Area = $result[0]['Area'];
                $_SESSION['City'] = $result[0]['City'];
                $this->City == $result[0]['City'];
                $_SESSION['Email'] = $result[0]['Email'];
                $this->Email == $result[0]['Email'];
                return true;
            }
        } else {
            return false;
        }
    }

}

?>
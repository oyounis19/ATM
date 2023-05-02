<?php

use PHPMailer\PHPMailer\PHPMailer;//like using namespace to make the code more readable.
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../lib/src/PHPMailer.php';
require_once '../lib/src/SMTP.php';
require_once '../lib/src/Exception.php';

class ATM{
    private int $ID;
    private string $city;
    private string $country;
    private bool $empty;

    private function generateOTP() {
        $digits = 6;
        return str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
    }

    private function serverSettings(){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'atm86596@gmail.com';                //SMTP username
            $mail->Password   = 'yyafjkepoqlrcxye';                     //SMTP password
            $mail->SMTPSecure = 'tls';                                  //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->isHTML(true);   

            //Recipients
            $mail->setFrom('atm86596@gmail.com', 'ATM');
            return $mail;
        }catch (Exception $e) {
            return null;
        }
    }

    public function getID(){
        return $this->ID;
    }
    public function getCity(){
        return $this->city;
    }
    public function getCountry(){
        return $this->country;
    }
    public function isEmpty(){
        return $this->empty;
    }
    public function setID($ID){
        $this->ID = $ID;
    }
    public function setCity($city){
        $this->city = $city;
    }
    public function setCountry($country){
        $this->country = $country;
    }
    public function setStatus(bool $status){
        $this->empty = $status;
    }

    public function sendOTP($recepient_email, string $client_name){
        $mail = $this->serverSettings();

        if($mail == null) 
            return null;

        $OTP = $this->generateOTP();

        $mail->addAddress($recepient_email, 'Client');              //Add a recipient
        $mail->Subject = 'OTP Verification for ATM Access';
        $mail->Body = "<head> 
        <style>
        /* Email styling */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333333;
            background-color: #f7f7f7;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
        }
        h1 {
            margin-top: 0;
            font-size: 24px;
            font-weight: bold;
            color: #333333;
            text-align: center;
        }
        p {
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            background-color: #008CBA;
            color: #ffffff;
            text-align: center;
            padding: 12px 30px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .otp-code {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            padding: 20px 0;
            text-align: center;
            border: 1px solid #cccccc;
            border-radius: 4px;
            background-color: #f2f2f2;
        }
        .notice {
            font-size: 12px;
            margin-top: 40px;
            color: #999999;
        }
    </style>
    </head>
    <body>
        <div class=\"container\">
            <h1>OTP Verification</h1>
            <p>Dear $client_name,</p>
            <p>We have detected a suspicious transaction or login attempt on your account. To ensure your account security, we have sent you an OTP code. Please enter the code in the ATM or website to verify your identity.</p>
            <p>Your OTP code is:</p>
            <p class=\"otp-code\">$OTP</p>
            <p class=\"notice\">Note: This OTP code is valid for 15 minutes only. Please do not share this code with anyone.</p>
            <p>Thank you for banking with us.</p>
        </div>
    </body>";

        // Set up altbody for non-html mails
        $mail->AltBody = "Dear $client_name,

        Please enter the following OTP to verify your account:

        $OTP

        Thank you for using our service!";
        
        try{
            $mail->send();
        }catch(Exception $e){
            return null;
        }
        return $OTP;
    }

    public function notifyUser(string $recepient_email, string $transactionType, $amount, $currentBalance, bool $state, string $client_name, int $atmID){
        $mail = $this->serverSettings();
        $mail->addAddress($recepient_email, 'Client');              
        $mail->Subject = 'Transaction Notification';

        $current_date = date('Y-m-d');
        $current_time = date('h:i:s A');

        if($state == true)
            $HTMLstate = '<!-- Success message -->
            <div class="success">
                <p>The transaction was successful. Thank you for choosing our bank for your financial needs.</p>
            </div>';
        else
            $HTMLstate = '<!-- Error message -->
            <div class="error">
                <p>The transaction failed due to a fraudulent activity detected on your account. Please contact our customer support for more information.</p>
            </div>';


        $emailBody = "
        <head>
            <style>
            /* Global Styles */
            body {
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            td {
                font-family: Arial, sans-serif;
                font-size: 14px;
                color: #555;
                padding: 10px;
            }

            th {
                font-family: Arial, sans-serif;
                font-size: 14px;
                color: #fff;
                background-color: #4CAF50;
                padding: 10px;
            }

            /* Header */
            .header {
                background-color: #333;
                color: #fff;
                text-align: center;
                padding: 10px;
            }

            /* Content */
            .content {
                padding: 10px;
            }

            /* Success message */
            .success {
                background-color: #DFF2BF;
                border: 1px solid #4F8A10;
                color: #4F8A10;
                padding: 10px;
            }

            /* Error message */
            .error {
                background-color: #FFBABA;
                border: 1px solid #D8000C;
                color: #D8000C;
                padding: 10px;
            }
            </style>
            <body>
        <table>
		<!-- Header -->
		<tr>
			<td colspan=\"2\" class=\"header\">
				<h1>Transaction Notification</h1>
			</td>
		</tr>

		<!-- Content -->
		<tr>
			<td colspan=\"2\" class=\"content\">
				<p>Dear $client_name,</p>
				<p>A transaction of type $transactionType of <b>$amount</b> LE on $current_date $current_time occured at ATM with ID: $atmID.</p>
				<p>Your current account balance is <b>$currentBalance</b> LE.</p>				
                $HTMLstate
				<p>Thank you for choosing our bank for your financial needs.</p>
				<p>Sincerely,</p>
				<p>The Bank Team</p>
			</td>
		</tr>
	</table>
    </body>";
    $mail->Body = $emailBody;
    try{
        $mail->send();
    }catch(Exception $e){
        return false;
    }
    return true;
    }
    public function blockCard(Card $Card){
        
    }
}
?>
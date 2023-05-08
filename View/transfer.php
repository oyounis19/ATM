<?php
ob_start();//Capture the HTML in output buffer instead of being sending to the browser immediately
require_once __DIR__.'/../Models/Account.php';
require_once __DIR__.'/../Models/customer.php';//Starts the sessions
require_once __DIR__.'/../Models/Transaction.php';

//Defining Objects
$sender = new Account($_SESSION['account_id'], $_SESSION['balance'], $_SESSION['type']);
$receiver = new Account();
$atm = new ATM();//HARD CODED ATM ID: 1264
$transaction = new Transaction();
$customer = new Customer($_SESSION['SSN'], $_SESSION['fName'], $_SESSION['lName'], $_SESSION['upass'],
                        $_SESSION['fingerpint'], $_SESSION['Street'], $_SESSION['Area'], $_SESSION['City'],
                        $_SESSION['Email'], $_SESSION['card_id']);

$sweetAlert = null;
if(isset($_POST['amount']) && isset($_POST['accountID'])){
    $receiver->setId($_POST['accountID']);
    $transaction->setAmount($_POST['amount']);
    $code = $transaction->transfer($sender, $receiver, $atm, $customer);
    if(0 == $code){
        echo "Your Balance is insufficient";//SWEET ALERT
    }else if(1 == $code){
        echo "Wrong Account ID";//SWEET ALERT
    }else{
        $_SESSION['balance'] = $sender->getBalance();
        echo "Transfered". $_POST['amount'] ."sucessfully";//SWEET ALERT
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/img/atm.png">
    <title>ATM APP</title>
</head>

<body>

    <div class="insert h-100 d-flex align-items-center justify-content-center">
        <div class="screens d-flex">
            <div class="screen deposit">
                <h2 class="text-white">Transfer</h2>
                <form action="" class="w-100" method="post">
                    <div class="form-floating mb-3">
                        <input type="amount" class="form-control input" id="Amount" minlength="2" maxlength="5"
                            placeholder="01234 5648 6542 3156" name="amount">
                        <label for="Amount">Enter Amount</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="amount" class="form-control input" id="account" minlength="4" maxlength="20"
                            placeholder="01234 5648 6542 3156" name="accountID">
                        <label for="account">Enter Receipent's account ID</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        Transfer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="assets/js/transfer.js"></script>
    <!-- <script src="assets/js/sessionTimout.js"></script> -->
</body>

</html>
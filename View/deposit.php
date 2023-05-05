<?php
require_once '../Controllers/DBconnector.php';
require_once '../Models/Account.php';
if(isset($_POST['amount'])){
    $account = new Account(1475369, 3500, "Saving");

    if($account->deposit($_POST['amount']))
        echo "Deposit successfully";// SWEET ALERT 
    else
        echo "Try again Later...";//SWEET ALERT
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
                <h2 class="text-white">Deposit</h2>
                <form action="#" class="w-100" id="depositForm" method="post">
                    <div class="lds-ring mb-4 loading" style="display:none;">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="verifyingCash" style="display:none; color:white">
                        Verifying cash, please wait...
                    </div>
                    <div class="form-floating mb-3">
                        <input type="amount" class="form-control" id="Amount" placeholder="01234 5648 6542 3156" maxlength="5" minlength="2" name="amount">
                        <label for="Amount">Enter Amount</label>
                    </div>
                    <button type = "submit" class="btn btn-primary w-100 depositBTN">
                        Deposit
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
    <script src="assets/js/deposit.js"></script>
</body>

</html>
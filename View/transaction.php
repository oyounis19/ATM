<?php

require_once '../Models/Account.php';

$account = new Account(1475369, 500, "Saving");

$transactions = $account->viewTransactionHistory();

print_r($transactions);
$Tid;
$accountID;
$atmID;
$amount;
$date;
$state;
$type;
$recAccID;
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
            <div class="screen history">
                <h2 class="text-white fw-bolder">transaction History</h2>

                <div class="transactions">
                    <?php  for($i=0; $i<sizeof($transactions); $i++){
                                // for($j=0; $j<sizeof($transactions[$i]); $j++){
                                    $accountID = $transactions[$i]['Account_ID'];
                                    $date = $transactions[$i]['Date'];
                                    $type = $transactions[$i]['Type'];
                                // }
                    ?>
                            <div class="transaction d-flex mt-4 justify-content-between" id="<?php echo $i+1;?>">
                                <div class="accountInfo">
                                    <ul>
                                        <li>
                                            <p>Account ID : <span><?php echo $accountID ?></span></p>
                                        </li>
                                        <li>
                                            <p>transaction Type : <span><?php echo $type ?></span></p>
                                        </li>
                                        <li>
                                            <p>Date : <span><?php echo $date ?></span></p>
                                        </li>
                                    </ul>
                                </div>
                                <i class="fa-solid fa-arrow-up"></i>
                            </div>
                    <?php
                                
                            } 
                    ?>
                    
                </div>
        </div>
    </div>

    <div class="popup-cards">
        <?php  for($i=0; $i<sizeof($transactions); $i++){
                    // for($j=0; $j<sizeof($transactions[$i]); $j++){
                        $Tid = $transactions[$i]['Transaction_ID'];
                        $accountID = $transactions[$i]['Account_ID'];
                        $atmID = $transactions[$i]['ATM_ID'];
                        $amount = $transactions[$i]['Amount'];
                        $date = $transactions[$i]['Date'];
                        $state = $transactions[$i]['State'];
                        $type = $transactions[$i]['Type'];
                        if($type == "Tranfer")
                            $recAccID = $transactions[$i]['recipient_account_ID'];
                    // }
        ?>
        <div class="popup details flex-column" pop="true" id="<?php echo $i+1;?>-popup">
            <i id="close" class="fa-solid fa-xmark"></i>
            <h2 class="text-white fs-1 mb-5">Transaction History</h2>
            <ul class="text-start text-white">
                <li>
                    <p>Account ID : <span><?php echo $accountID ?></span></p>
                </li>
                <li>
                    <p>transaction Type : <span><?php echo $type ?></span></p>
                </li>
                <li>
                    <p>transaction id : <span><?php echo $Tid ?></span></p>
                </li>
                <?php
                if($type == "Tranfer"){
                    ?>
                    <li>
                        <p>Recipient Account ID : <span><?php echo $recAccID ?></span></p>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <p>ATM ID : <span><?php echo $atmID ?></span></p>
                </li>
                <li>
                    <p>State : <span value="<?php echo $state ?>"><?php echo $state ?></span></p>
                </li>
                <li>
                    <p>Amount : <span><?php echo $amount ?> LE</span></p>
                </li>
                <li>
                    <p>Date : <span><?php echo $date ?></span></p>
                </li>
            </ul>
        </div>
        <?php            
            } 
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="assets/js/logger.js"></script>
</body>

</html>
<?php
ob_start();
require_once __DIR__.'/../Models/Account.php';
require_once __DIR__.'/../Models/customer.php';//Starts the sessions
require_once __DIR__.'/../Models/Transaction.php';

if(!isset($_SESSION['SSN'])){
    echo '<b>Redirecting you to login screen to login...</b>';
    $refresh_delay = 1; // 2 seconds delay
    $redirect_url = "index.php";

    header("refresh:$refresh_delay;url=$redirect_url");
    exit();
}

if($_SESSION['fing'] == '1' and $_SESSION['correctPIN'] != '1'){
    $_SESSION['transType'] = 'deposit';
    header("Location: pin.php");
    exit();
}
//Defining Objects
$account = new Account($_SESSION['account_id'], $_SESSION['balance'], $_SESSION['type']);
$atm = new ATM();//HARD CODED ATM ID: 1264
$atm->getAtmData();
$transaction = new Transaction();
$customer = new Customer($_SESSION['SSN'], $_SESSION['fName'], $_SESSION['lName'], $_SESSION['upass'],
                        $_SESSION['fingerpint'], $_SESSION['Street'], $_SESSION['Area'], $_SESSION['City'],
                        $_SESSION['Email'], $_SESSION['card_id']);

$sweetAlert = null;
if(isset($_POST['amount']) && $_POST['amount'] != ''){
    $transaction->setType("Deposit");
    $transaction->setAmount($_POST['amount']);
    $sweetAlert = $transaction->deposit($account, $atm, $customer);
    
    $sweetAlert? $_SESSION['balance'] = $account->getBalance() : null;
}
else if(isset($_POST['amount']) && $_POST['amount'] == '')//Checked by amount bec. js submits the form not the button
    $sweetAlert = 2;
else if(!isset($_SESSION['SSN'])){
    echo '<b>Redirecting you to login screen to login...</b>';
    $refresh_delay = 3; // 3 seconds delay
    $redirect_url = "index.php";

    header("refresh:$refresh_delay;url=$redirect_url");
    exit();
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
                    <button type = "submit" class="btn btn-primary w-100 depositBTN mb-3" name="sbmtbtn">
                        Deposit
                    </button>
                </form>
                <a href="menu.php">
                    <img src="assets/img/icons8-back-64.png" alt="Back button">
                    <br>
                    <b>Back</b>
                </a>
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
    <script src="assets/js/sessionTimout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<?php
if($sweetAlert === 0 or $sweetAlert === 1 or $sweetAlert === 2){
    switch($sweetAlert){
        case 0:
            $icon = 'error';
            $message = 'Deposit Failed, Try again';
            break;
        case 1:
            $icon = 'success';
            $message = 'Deposit completed Successfully';
            break;
        case 2:
            $icon = 'warning';
            $message = 'Please enter amount before submitting';
            break;
        default:
            $icon = 'error';
            $message = 'Something went wrong...';
            break;
    }
?>
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: '<?php echo $icon; ?>',
        title: '<?php echo $message; ?>'
        })
    </script>
<?php
    if($sweetAlert === 1){

        $refresh_delay = 3; // 3 seconds delay
        $redirect_url = "menu.php";
        
        header("refresh:$refresh_delay;url=$redirect_url");
        ob_end_flush();//Sends the HTML to the browser
    }
}?>
</html>
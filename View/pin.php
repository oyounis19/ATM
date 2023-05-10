<?php
ob_start();//Capture the HTML in output buffer instead of being sending to the browser immediately
require_once '../Models/customer.php';//starts session

if(!isset($_SESSION['SSN'])){//check if user not logged in
    echo '<b>Redirecting you to login screen to login...</b>';
    $refresh_delay = 2; // 2 seconds delay
    $redirect_url = "index.php";

    header("refresh:$refresh_delay;url=$redirect_url");
    exit();
}
if(isset($_SESSION['correctPIN']) && $_SESSION['correctPIN'] == '1'){//already entered the pin and came back
    header("Location: ".$_SESSION['transType'].".php");
    exit();
}
$customer = new Customer();
$sweetAlert = null;
if(isset($_POST['pin'])){//Check entered PIN
    if(isset($_POST['pin']) and $_POST['pin'] == '')
    $sweetAlert = 2;
    else{
        $hashedPin = $customer->pinVerification($_POST['pin']);
        if($hashedPin == $_SESSION['upass']){
            $_SESSION['correctPIN'] = '1';
            $sweetAlert = 1;
        }
        else{
            $sweetAlert = 0;
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/img/atm.png">
    <title>ATM APP</title>
</head>
<body>
    <div class="insert h-100 d-flex align-items-center justify-content-center">
            <div class="screens bg d-flex">
                <div class="credit screen">
                    <h2 class="text-white fw-bolder mb-3">Enter PIN to Continue</h2>
                    <form action="" method="POST">
                        <div class="form-floating">
                            <input type="password" name="pin" class="form-control" id="PIN" maxlength="4" minlength="4"
                                id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Enter your PIN code</label>
                        </div>
                        <button name="lg_in" class="btn btn-primary mt-3 w-100" type="submit">Continue</button>
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
    <script src="assets/js/sessionTimout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<?php
    if($sweetAlert === 0 or $sweetAlert === 1 or $sweetAlert === 2){
        $icon = '';
        $message = '';
        switch($sweetAlert){
            case 0:
                $icon = 'error';
                $message = 'Wrong PIN code';
                break;
            case 1:
                $icon = 'success';
                $message = 'Redirecting';
                break;
            case 2:
                $icon = 'warning';
                $message = 'Please enter PIN code before submitting';
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
        timer: 2000,
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
        $refresh_delay = 2; // 3 seconds delay
        header("refresh:$refresh_delay;url=".$_SESSION['transType'].".php");
        ob_end_flush();//Sends the HTML to the browser
    }
}
?>
</html>

<?php
ob_start(); //Capture the HTML in output buffer instead of being sending to the browser immediately
require_once '../Models/customer.php'; //starts session

if(!isset($_SESSION['SSN']) or !isset($_SESSION['OTP'])){//check if user not logged in
    echo '<b>Redirecting you to login screen to login...</b>';
    $refresh_delay = 2; // 2 seconds delay
    $redirect_url = "index.php";

    header("refresh:$refresh_delay;url=$redirect_url");
    exit();
}
$err = null;
if(isset($_POST['otp'])){
    if($_POST['otp'] != ''){
        if($_POST['otp'] == $_SESSION['OTP']){
            $err = "<b>Error occured while sending OTP</b>";//SWEET ALERT
            $refresh_delay = 2;
            $redirect_url = "Account.php";
            header("refresh:$refresh_delay;url=$redirect_url");
            exit();
        }
    }else{
        $err = "<b>Enter OTP code to continue...</b>";//SWEET ALERT
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/img/atm.png">
    <title>ATM APP</title>
</head>

<body>
    <div class="insert h-100 d-flex align-items-center justify-content-center">
        <div class="screens bg d-flex">
            <div class="credit screen">
                <h2 class="text-white fw-bolder mb-3">Enter OTP to Continue</h2>
                <form action="" method="POST">
                    <div class="form-floating">
                        <input type="text" name="otp" maxlength="6" class="form-control" name="PIN" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Enter your OTP code</label>
                    </div>
                    <button name="continue" class="btn btn-primary mt-3 w-100" type="submit">Continue</button>
                </form>
                <?php echo $err;?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- <script src="assets/js/sessionTimout.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        icon: 'info',
        title: 'An OTP has been sent to your gmail'
        })
    </script>
</body>

</html>
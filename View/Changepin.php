<?php
require_once "../Models/customer.php";
if(!isset($_SESSION['SSN'])){
    header("location:index.php");
}
require_once "../Models/customer.php";
$errmsg = "";
$customer = new customer;
if (isset($_POST['change'])) {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $card_id = $_SESSION['card_id'];
    $value = $customer->resetPin($pass1, $pass2, $card_id);
    if ($value == 1) {
        $errmsg = "<b style='color: white;'> All fields is rquired </b>";
    } else if ($value == 2) {
        $errmsg = "<b style='color: white;'>  Not match password </b>";
    } else {
        if ($value == false) {
            $errmsg = "<b style='color: white;'> Server is down now </b>";
        } else
            $customer->logOut();
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
                <h2 class="text-white">Change PIN</h2>
                <form action="#" method="post" class="w-100">
                    <div class="form-floating mb-3">
                        <input type="password" name="pass1" class="form-control input" maxlength="4" minlength="4"
                            placeholder="Password">
                        <label for="floatingPassword">Enter your new pin code</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="pass2" class="form-control input" maxlength="4" minlength="4"
                            placeholder="Password">
                        <label for="floatingPassword">Retype pin code</label>
                    </div>
                    <button name="change" class="btn btn-primary w-100">
                        Change PIN
                    </button>
                    <div class="popup">
                        <img src="/View/assets/img/404-tick.png">
                        <h2>Password is successfully updated</h2>
                        <button type="button">OK</button>
                    </div>
                    <?php echo $errmsg ?>
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
    <script src="./assets/js/transfer.js"></script>
</body>

</html>
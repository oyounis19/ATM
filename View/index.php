<?php
if(session_status() !== PHP_SESSION_ACTIVE)//If session is closed open it to destroy it
session_start();

if (session_status() === PHP_SESSION_ACTIVE) {//session is open
    $_SESSION = array();//remove all data in the session
    session_unset();
    session_destroy();//destroy the previous session when logging out or first time in website
}

/* functions of Customer start from here
*/
require_once "../Models/customer.php";//Actual session starts
require_once "../Models/Verification.php";
require_once "../Models/Card.php";

$customer = new customer;
$verify = new verification();
$customererrmsg = "";
$customererrmsgfingerprint = "";

//login function using Credit Card or Fingerprint 
// if you want to check login by fingerprint or not go to line @14 & line @30
if (isset($_POST['lg_in']) or (isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name']))) {
    $value;
    $Success = false;
    $_SESSION['fing'] = '0';    // session of fingerprint set to zero
    if (isset($_POST['lg_in'])) {//Credit Card
        $cardID = $_POST['card_id'];
        $pass = $_POST['upass'];
        $value = $customer->login($cardID, $pass);
        if ($value == 1) {
            //Start Fraud Verify***********
            $card = unserialize($_SESSION['card']);
            $verify->CheckExpDate($card);
            //End Fraud Verify***********
            $Success = True;
            goto here;
        } if ($value == -1) {
            $customererrmsg = "<b style='color: white;'> Card is blocked </b>";
        } else {//0
            $customererrmsg = "<b style='color: white;'> Wrong Credit Card number or PIN</b>";
        }
    } else if (isset($_POST['upload'])) {//Fingerprint
        $value = $customer->FingerprintValidation();
        if ($value == 1) {
            $Success = True;
            //session of fingerprint set to 1 if logged by it
            $_SESSION['fing'] = '1';
            goto here;
        } else if ($value == -1) {
            $customererrmsgfingerprint = "<b style='color: white;'> Card is blocked </b>";
        } else {
            $customererrmsgfingerprint = "<b style='color: white;'> Not recognized </b>";
        }
    }
    here:;
    // if ($Success) {
    //     header("location:Account.php");
    //     exit();
    // }
}else if(isset($_POST['upload'])){
    $customererrmsgfingerprint = "<b style='color: white;'> Upload image first.. </b>";
}


/////////////////////////////

/* functions of Service technican start from here
*/
require_once(__DIR__ . "/../Models/servicesTechnican.php");
$srvTeq = new servicesTechinican;
if (isset($_POST['bLogin'])) {
    if($srvTeq->login()){
        header("location:../View/serviceMenu.php");
    }else{
        ?>
        <script> alert('<?php echo $_SESSION['errMsg'] ?>')</script>
        <?php
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
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" href="assets/img/atm.png">
    <title>ATM APP</title>
</head>

<body>
    <div class="insert h-100 d-flex flex-column align-items-center justify-content-center">
        <div class="screens">
            <div class="credit screen">
                <h2 class="text-white fw-bolder mb-3">Login by Credit Card</h2>
                <form action="" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="card-input-field form-control" name="card_id" id="credit-card"
                            placeholder="1234 5648 6542 3156" minlength="19" maxlength="19">
                        <label for="credit-card">Enter your credit card number</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="upass" class="form-control" id="PIN" maxlength="4" minlength="4"
                            id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Enter your PIN code</label>
                    </div>
                    <button name="lg_in" class="btn btn-primary mt-3 w-100" type="submit">Log in</button>
                    <?php echo $customererrmsg?>
                </form>

            </div>
            <div class="fingerPrint screen d-flex justify-content-center flex-column align-items-center">
                <h2 class="text-white fw-bolder">Login by FingerPrint Image</h2>
                <div class="scanFingerPrint my-3">
                    <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="80px" height="80px" viewBox="0 0 512 512"
                        xml:space="preserve" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <style type="text/css">
                                .st0 {
                                    fill: #898989;
                                }
                            </style>
                            <g>
                                <path class="st0"
                                    d="M445.928,185.786c-0.516-51.172-21.359-97.641-54.875-131.281c-33.5-33.641-79.766-54.5-130.984-54.5 C157.834,0.02,74.475,82.942,74.209,184.629v-0.063c-0.156,13.453-3.109,26.859-7.781,39.703c-1.172,3.266,0.516,6.859,3.766,8.031 c3.25,1.188,6.844-0.5,8.031-3.766c5.016-13.859,8.328-28.625,8.516-43.828v-0.047c0.219-94.688,78-172.141,173.328-172.125 c47.781,0,90.813,19.406,122.109,50.813c31.281,31.422,50.734,74.734,51.218,122.578c0.016,1.484,0.016,2.953,0.016,4.438 c0,58.594-12.015,111.203-31.25,160.031c-19.219,48.813-45.734,93.844-74.719,137.032c-1.938,2.875-1.172,6.766,1.719,8.688 c2.875,1.922,6.766,1.156,8.688-1.719c29.25-43.594,56.266-89.375,75.984-139.407c19.718-50.016,32.109-104.297,32.109-164.625 C445.943,188.848,445.943,187.317,445.928,185.786z">
                                </path>
                                <path class="st0"
                                    d="M404.178,189.426c0-1.203-0.016-2.422-0.031-3.641c-0.438-39.672-16.578-75.703-42.547-101.781 c-25.953-26.063-61.828-42.25-101.531-42.234c-39.156,0-75.172,15.719-101.391,41.141c-26.219,25.406-42.75,60.625-42.75,99.5 c0,0.953,0.016,1.891,0.047,2.828v-0.016c0.016,1.031,0.016,2.047,0.016,3.078c0,24.125-5.969,47.156-15.078,68.219 c-9.094,21.047-21.297,40.094-33.563,56.125c-2.109,2.75-1.578,6.688,1.172,8.781c2.75,2.109,6.688,1.594,8.781-1.172 c12.734-16.641,25.484-36.5,35.109-58.766s16.109-46.984,16.109-73.188c0-1.109,0-2.219-0.016-3.313v-0.016 c-0.031-0.859-0.047-1.719-0.047-2.563c0-35.281,14.969-67.25,38.953-90.5c23.969-23.234,56.891-37.625,92.656-37.609 c36.281,0,68.906,14.719,92.672,38.563c23.719,23.828,38.484,56.719,38.875,93.063c0.016,1.172,0.031,2.328,0.031,3.5 c0,60.938-17.391,120.781-42.094,174.547c-24.719,53.766-56.734,101.407-85.672,137.875c-2.141,2.703-1.703,6.641,1.016,8.797 c2.719,2.141,6.641,1.688,8.797-1.016c29.438-37.094,61.969-85.484,87.234-140.407 C386.178,314.286,404.163,252.754,404.178,189.426z">
                                </path>
                                <path class="st0"
                                    d="M362.538,195.036c0-3.141-0.047-6.266-0.156-9.391c-0.969-28.031-12.391-53.547-30.656-72.063 c-18.25-18.516-43.469-30.063-71.656-30.047c-28.031,0-53.625,11.344-72.172,29.641c-18.563,18.313-30.172,43.688-30.172,71.688 l0.016,0.797c0,0.547,0,1.063,0,1.531c0,38.547-11.313,74.203-27.266,105.281c-15.922,31.063-36.484,57.5-54.625,77.406 c-2.344,2.547-2.172,6.516,0.391,8.844s6.531,2.156,8.859-0.406c18.688-20.516,39.906-47.734,56.531-80.125 c16.609-32.375,28.625-69.969,28.641-111c0-0.547-0.016-1.078-0.016-1.594v-0.047v-0.688c0-24.5,10.125-46.656,26.438-62.75 c16.313-16.109,38.766-26.047,63.375-26.047c24.75,0,46.641,10.031,62.734,26.313c16.063,16.281,26.188,38.813,27.063,63.688 c0.094,2.984,0.156,5.984,0.156,8.969c0.016,58.047-19.453,116.219-46.453,168.594c-26.984,52.36-61.422,98.891-90.891,133.672 c-2.234,2.641-1.922,6.594,0.734,8.828c2.641,2.25,6.594,1.906,8.844-0.734c29.891-35.313,64.859-82.5,92.438-136.032 C342.272,315.833,362.522,255.895,362.538,195.036z">
                                </path>
                                <path class="st0"
                                    d="M266.319,188.942c0.156-3.469-2.531-6.391-5.969-6.547c-3.469-0.141-6.391,2.531-6.547,5.984 c-2.344,52.641-20.359,103.766-44.578,149.188s-54.609,85.125-81.297,114.922c-2.313,2.578-2.094,6.531,0.484,8.844 s6.547,2.094,8.844-0.5c27.219-30.391,58.172-70.797,83.016-117.375C245.084,296.895,263.85,244.083,266.319,188.942z">
                                </path>
                                <path class="st0"
                                    d="M320.741,192.676c0-2.266-0.047-4.531-0.125-6.813h0.016c0-0.031-0.016-0.078-0.016-0.125c0,0,0-0.047,0-0.078 l0,0c-0.125-33.375-27.172-60.359-60.547-60.375c-33.453,0.016-60.563,27.125-60.563,60.578v-0.063 c-0.406,46.047-14.859,89.641-35.156,128.234c-20.297,38.578-46.375,72.063-69.688,97.782c-2.313,2.563-2.141,6.531,0.438,8.859 c2.563,2.313,6.531,2.125,8.844-0.453c23.813-26.266,50.531-60.516,71.484-100.36c20.953-39.828,36.172-85.313,36.609-133.953 v-0.047c0-13.297,5.359-25.25,14.063-33.969c8.703-8.703,20.688-14.078,33.969-14.078c13.266,0,25.25,5.375,33.953,14.078 c8.703,8.719,14.063,20.672,14.078,33.969v0.109v0.094c0.063,2.188,0.109,4.406,0.109,6.609 c0.031,53.078-20.797,108.422-49.109,158.688c-28.281,50.281-63.953,95.438-93,128.391c-2.281,2.594-2.031,6.563,0.578,8.844 c2.594,2.281,6.547,2.031,8.828-0.563c29.438-33.406,65.578-79.141,94.516-130.516 C298.913,306.129,320.709,249.051,320.741,192.676z">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <svg class="finger2" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="80px" height="80px" viewBox="0 0 512 512"
                        xml:space="preserve" fill="red">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <style type="text/css">
                                .st0 {
                                    fill: #898989;
                                }
                            </style>
                            <g>
                                <path class="st0"
                                    d="M445.928,185.786c-0.516-51.172-21.359-97.641-54.875-131.281c-33.5-33.641-79.766-54.5-130.984-54.5 C157.834,0.02,74.475,82.942,74.209,184.629v-0.063c-0.156,13.453-3.109,26.859-7.781,39.703c-1.172,3.266,0.516,6.859,3.766,8.031 c3.25,1.188,6.844-0.5,8.031-3.766c5.016-13.859,8.328-28.625,8.516-43.828v-0.047c0.219-94.688,78-172.141,173.328-172.125 c47.781,0,90.813,19.406,122.109,50.813c31.281,31.422,50.734,74.734,51.218,122.578c0.016,1.484,0.016,2.953,0.016,4.438 c0,58.594-12.015,111.203-31.25,160.031c-19.219,48.813-45.734,93.844-74.719,137.032c-1.938,2.875-1.172,6.766,1.719,8.688 c2.875,1.922,6.766,1.156,8.688-1.719c29.25-43.594,56.266-89.375,75.984-139.407c19.718-50.016,32.109-104.297,32.109-164.625 C445.943,188.848,445.943,187.317,445.928,185.786z">
                                </path>
                                <path class="st0"
                                    d="M404.178,189.426c0-1.203-0.016-2.422-0.031-3.641c-0.438-39.672-16.578-75.703-42.547-101.781 c-25.953-26.063-61.828-42.25-101.531-42.234c-39.156,0-75.172,15.719-101.391,41.141c-26.219,25.406-42.75,60.625-42.75,99.5 c0,0.953,0.016,1.891,0.047,2.828v-0.016c0.016,1.031,0.016,2.047,0.016,3.078c0,24.125-5.969,47.156-15.078,68.219 c-9.094,21.047-21.297,40.094-33.563,56.125c-2.109,2.75-1.578,6.688,1.172,8.781c2.75,2.109,6.688,1.594,8.781-1.172 c12.734-16.641,25.484-36.5,35.109-58.766s16.109-46.984,16.109-73.188c0-1.109,0-2.219-0.016-3.313v-0.016 c-0.031-0.859-0.047-1.719-0.047-2.563c0-35.281,14.969-67.25,38.953-90.5c23.969-23.234,56.891-37.625,92.656-37.609 c36.281,0,68.906,14.719,92.672,38.563c23.719,23.828,38.484,56.719,38.875,93.063c0.016,1.172,0.031,2.328,0.031,3.5 c0,60.938-17.391,120.781-42.094,174.547c-24.719,53.766-56.734,101.407-85.672,137.875c-2.141,2.703-1.703,6.641,1.016,8.797 c2.719,2.141,6.641,1.688,8.797-1.016c29.438-37.094,61.969-85.484,87.234-140.407 C386.178,314.286,404.163,252.754,404.178,189.426z">
                                </path>
                                <path class="st0"
                                    d="M362.538,195.036c0-3.141-0.047-6.266-0.156-9.391c-0.969-28.031-12.391-53.547-30.656-72.063 c-18.25-18.516-43.469-30.063-71.656-30.047c-28.031,0-53.625,11.344-72.172,29.641c-18.563,18.313-30.172,43.688-30.172,71.688 l0.016,0.797c0,0.547,0,1.063,0,1.531c0,38.547-11.313,74.203-27.266,105.281c-15.922,31.063-36.484,57.5-54.625,77.406 c-2.344,2.547-2.172,6.516,0.391,8.844s6.531,2.156,8.859-0.406c18.688-20.516,39.906-47.734,56.531-80.125 c16.609-32.375,28.625-69.969,28.641-111c0-0.547-0.016-1.078-0.016-1.594v-0.047v-0.688c0-24.5,10.125-46.656,26.438-62.75 c16.313-16.109,38.766-26.047,63.375-26.047c24.75,0,46.641,10.031,62.734,26.313c16.063,16.281,26.188,38.813,27.063,63.688 c0.094,2.984,0.156,5.984,0.156,8.969c0.016,58.047-19.453,116.219-46.453,168.594c-26.984,52.36-61.422,98.891-90.891,133.672 c-2.234,2.641-1.922,6.594,0.734,8.828c2.641,2.25,6.594,1.906,8.844-0.734c29.891-35.313,64.859-82.5,92.438-136.032 C342.272,315.833,362.522,255.895,362.538,195.036z">
                                </path>
                                <path class="st0"
                                    d="M266.319,188.942c0.156-3.469-2.531-6.391-5.969-6.547c-3.469-0.141-6.391,2.531-6.547,5.984 c-2.344,52.641-20.359,103.766-44.578,149.188s-54.609,85.125-81.297,114.922c-2.313,2.578-2.094,6.531,0.484,8.844 s6.547,2.094,8.844-0.5c27.219-30.391,58.172-70.797,83.016-117.375C245.084,296.895,263.85,244.083,266.319,188.942z">
                                </path>
                                <path class="st0"
                                    d="M320.741,192.676c0-2.266-0.047-4.531-0.125-6.813h0.016c0-0.031-0.016-0.078-0.016-0.125c0,0,0-0.047,0-0.078 l0,0c-0.125-33.375-27.172-60.359-60.547-60.375c-33.453,0.016-60.563,27.125-60.563,60.578v-0.063 c-0.406,46.047-14.859,89.641-35.156,128.234c-20.297,38.578-46.375,72.063-69.688,97.782c-2.313,2.563-2.141,6.531,0.438,8.859 c2.563,2.313,6.531,2.125,8.844-0.453c23.813-26.266,50.531-60.516,71.484-100.36c20.953-39.828,36.172-85.313,36.609-133.953 v-0.047c0-13.297,5.359-25.25,14.063-33.969c8.703-8.703,20.688-14.078,33.969-14.078c13.266,0,25.25,5.375,33.953,14.078 c8.703,8.719,14.063,20.672,14.078,33.969v0.109v0.094c0.063,2.188,0.109,4.406,0.109,6.609 c0.031,53.078-20.797,108.422-49.109,158.688c-28.281,50.281-63.953,95.438-93,128.391c-2.281,2.594-2.031,6.563,0.578,8.844 c2.594,2.281,6.547,2.031,8.828-0.563c29.438-33.406,65.578-79.141,94.516-130.516 C298.913,306.129,320.709,249.051,320.741,192.676z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </div>
                <form action="#" method="post" enctype="multipart/form-data">
                    <input type="file" class="btn btn-primary mb-3" name="image">
                    <input type="submit" name="upload" class="btn btn-primary" value="Scan">
                    <?php echo "<pre>$customererrmsgfingerprint</pre>" ?>
                </form>
            </div>
        </div>
        <button id="serviceBTN" name="service" class="btn btn-primary mt-5" pop="true">
            Service ATM
        </button>
    </div>

    <div class="popup serviceLogin flex-column" pop="true">
        <i id="close" class="fa-solid fa-xmark"></i>
        <h2 class="text-white fs-1 mb-5">Login</h2>
        <form method="POST" class="w-100">
            <div class="form-floating mb-3">
                <input type="userName" name="teqUserName" class="form-control" id="Input"
                    placeholder="01234 5648 6542 3156">
                <label for="Input">Enter username</label>
            </div>
            <br>
            <div class="form-floating">
                <input type="password" name="teqPassword" class="form-control" id="Password" placeholder="Password">
                <label for="Password">Enter password</label>
            </div>
            <br>
            <div class="form-floating mb-3">
                <input type="text" name="atm_Id" class="form-control" id="inputId" placeholder="01234 5648 6542 3156">
                <label for="inputId">Enter ATM_ID</label>
            </div>
            <br>
            <button name="bLogin" class="btn btn-primary mt-3 w-100">Log in</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
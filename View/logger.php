<?php 
require_once (__DIR__."/../Models/servicesTechnican.php");
require_once "../Models/customer.php";
$srvTeq = new servicesTechinican; 

if(!$_SESSION['firstName']){
    header("location:../View/index.php");
}
$result =  $srvTeq->checkLoggers();
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
                <h2 class="text-white fw-bolder">Logger</h2>
                 <?php 
                 for( $i = 0 ; $i < sizeof($result);$i++){
                    ?>
                <div class="transictions">
                    <div id="transiction" class="transiction d-flex mt-4 justify-content-between">
                        <div class="accountInfo">
                            <ul>
                                <li>
                                    <p>Account ID : <span><?php echo $result[$i]["Account_ID"] ?></span></p>
                                </li>
                                <li>
                                    <p>Transiction Type : <span><?php echo $result[$i]["Type"] ?></span></p>
                                </li>
                                <li>
                                    <p>Date : <span><?php echo $result[$i]["Date"] ?></span></p>
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
    </div>

    <div class="popup-cards">
        <div class="popup flex-column" pop="true" id="1-popup">
            <i id="close" class="fa-solid fa-xmark"></i>
            <h2 class="text-white fs-1 mb-5">Logger Details</h2>
            <ul class="text-start text-white">
                <li>
                    <p>Account ID : <span>555555555555555</span></p>
                </li>
                <li>
                    <p>Transaction Type : <span>Withdraw</span></p>
                </li>
                <li>
                    <p>Transaction ID : <span>20230321</span></p>
                </li>
                <li>
                    <p>State : <span>2023/3/1</span></p>
                </li>
                <li>
                    <p>Amount : <span>200 LE</span></p>
                </li>
                <li>
                    <p>Date : <span>2023/3/1</span></p>
                </li>
                <li>
                    <p>time : <span>20:08</span></p>
                </li>
            </ul>
        </div>
        <div class="popup flex-column" pop="true" id="2-popup">
            <i id="close" class="fa-solid fa-xmark"></i>
            <h2 class="text-white fs-1 mb-5">Logger Details</h2>
            <ul class="text-start text-white">
                <li>
                    <p>Account ID : <span>4444444444444</span></p>
                </li>
                <li>
                    <p>Transaction Type : <span>Withdraw</span></p>
                </li>
                <li>
                    <p>Transaction ID : <span>20230321</span></p>
                </li>
                <li>
                    <p>State : <span>2023/3/1</span></p>
                </li>
                <li>
                    <p>Amount : <span>200 LE</span></p>
                </li>
                <li>
                    <p>Date : <span>2023/3/1</span></p>
                </li>
                <li>
                    <p>time : <span>20:08</span></p>
                </li>
            </ul>
        </div>
        <div class="popup flex-column" pop="true" id="3-popup">
            <i id="close" class="fa-solid fa-xmark"></i>
            <h2 class="text-white fs-1 mb-5">Logger Details</h2>
            <ul class="text-start text-white">
                <li>
                    <p>Account ID : <span>111111111</span></p>
                </li>
                <li>
                    <p>Transaction Type : <span>Withdraw</span></p>
                </li>
                <li>
                    <p>Transaction ID : <span>20230321</span></p>
                </li>
                <li>
                    <p>State : <span>2023/3/1</span></p>
                </li>
                <li>
                    <p>Amount : <span>200 LE</span></p>
                </li>
                <li>
                    <p>Date : <span>2023/3/1</span></p>
                </li>
                <li>
                    <p>time : <span>20:08</span></p>
                </li>
            </ul>
        </div>
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
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
                    <div class="transaction d-flex mt-4 justify-content-between" id="1">
                        <div class="accountInfo">
                            <ul>
                                <li>
                                    <p>Account ID : <span>123456</span></p>
                                </li>
                                <li>
                                    <p>transaction Type : <span>Withdraw</span></p>
                                </li>
                                <li>
                                    <p>Date : <span>2023/3/1</span></p>
                                </li>
                            </ul>
                        </div>
                        <i class="fa-solid fa-arrow-up"></i>
                    </div>
                    <div class="transaction d-flex mt-4 justify-content-between" id="2">
                        <div class="accountInfo">
                            <ul>
                                <li>
                                    <p>Account ID : <span>123456</span></p>
                                </li>
                                <li>
                                    <p>transaction Type : <span>Withdraw</span></p>
                                </li>
                                <li>
                                    <p>Date : <span>2023/3/1</span></p>
                                </li>
                            </ul>
                        </div>
                        <i class="fa-solid fa-arrow-down"></i>
                    </div>
                    <div class="transaction d-flex mt-4 justify-content-between" id="3">
                        <div class="accountInfo">
                            <ul>
                                <li>
                                    <p>Account ID : <span>123456</span></p>
                                </li>
                                <li>
                                    <p>transaction Type : <span>Withdraw</span></p>
                                </li>
                                <li>
                                    <p>Date : <span>2023/3/1</span></p>
                                </li>
                            </ul>
                        </div>
                        <i class="fa-solid fa-arrow-down"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="popup-cards">
        <div class="popup details flex-column" pop="true" id="1-popup">
            <i id="close" class="fa-solid fa-xmark"></i>
            <h2 class="text-white fs-1 mb-5">Transaction History</h2>
            <ul class="text-start text-white">
                <li>
                    <p>Account ID : <span>123456</span></p>
                </li>
                <li>
                    <p>transaction Type : <span>Withdraw</span></p>
                </li>
                <li>
                    <p>transaction id : <span>20230321</span></p>
                </li>
                <li>
                    <p>ATM ID : <span>20545</span></p>
                </li>
                <li>
                    <p>State : <span value="approved">Approved</span></p>
                </li>
                <li>
                    <p>Amount : <span>200 LE</span></p>
                </li>
                <li>
                    <p>Date : <span>2023/3/1</span></p>
                </li>
            </ul>
        </div>
        <div class="popup details flex-column" pop="true" id="2-popup">
            <i id="close" class="fa-solid fa-xmark"></i>
            <h2 class="text-white fs-1 mb-5">Transaction History</h2>
            <ul class="text-start text-white">
                <li>
                    <p>Account ID : <span>123456</span></p>
                </li>
                <li>
                    <p>transaction Type : <span>Withdraw</span></p>
                </li>
                <li>
                    <p>transaction id : <span>20230321</span></p>
                </li>
                <li>
                    <p>ATM ID : <span>20545</span></p>
                </li>
                <li>
                    <p>State : <span value="declined">Declined</span></p>
                </li>
                <li>
                    <p>Amount : <span>200 LE</span></p>
                </li>
                <li>
                    <p>Date : <span>2023/3/1</span></p>
                </li>
            </ul>
        </div>
        <div class="popup details flex-column" pop="true" id="3-popup">
            <i id="close" class="fa-solid fa-xmark"></i>
            <h2 class="text-white fs-1 mb-5">Transaction History</h2>
            <ul class="text-start text-white">
                <li>
                    <p>Account ID : <span>123456</span></p>
                </li>
                <li>
                    <p>transaction Type : <span>Withdraw</span></p>
                </li>
                <li>
                    <p>transaction id : <span>20230321</span></p>
                </li>
                <li>
                    <p>ATM ID : <span>20545</span></p>
                </li>
                <li>
                    <p>State : <span value="approved">Approved</span></p>
                </li>
                <li>
                    <p>Amount : <span>200 LE</span></p>
                </li>
                <li>
                    <p>Date : <span>2023/3/1</span></p>
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
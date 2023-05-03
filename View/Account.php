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
            <div class="screen account">
                <h2 class="text-white fw-bolder">Select Account</h2>
                
                    <form action="" id="accountForm" class="accounts">
                        <div class="account d-flex mt-4" data-value="1">
                            <i class="fa-solid fa-credit-card"></i>
                            <div class="accountInfo">
                                <ul>
                                    <li>
                                        <p>Account NO. : <span>1236</span></p>
                                    </li>
                                    <li>
                                        <p>Account Type : <span>Saving</span></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="account d-flex mt-4" data-value="2">
                            <i class="fa-solid fa-credit-card"></i>
                            <div class="accountInfo">
                                <ul>
                                    <li>
                                        <p>Account NO. : <span>1236</span></p>
                                    </li>
                                    <li>
                                        <p>Account Type : <span>Gold</span></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="account d-flex mt-4" data-value="3">
                        <i class="fa-solid fa-credit-card"></i>
                        <div class="accountInfo">
                            <ul>
                                <li>
                                    <p>Account NO. : <span>1236</span></p>
                                </li>
                                <li>
                                    <p>Account Type : <span>Current</span></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                        <input type="hidden" name="selectedAccount" id="selectedAccount">
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
    <script src="assets/js/account.js"></script>
</body>

</html>
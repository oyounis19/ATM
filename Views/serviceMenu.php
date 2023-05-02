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
    <title>ATM APP</title>
</head>

<body>



    <div class="insert h-100 d-flex align-items-center justify-content-center">
        <div class="screens bg d-flex">
            <div class="screen info">
                <h2 class="text-white fw-bolder">ATM </h2>
                <div class="userInfo my-5">
                    <ul>
                        <li class="text-white d-flex flex-column text-start fs-5 mb-3"><span>welcome</span>
                            OUR TEAM LEADER IS THE BEST :)
                        </li>
                        <li class="text-white d-flex flex-column text-start fs-5 mb-3"><span>ATM Balance</span>
                            500,522 LE
                        </li>
                        <li class="text-white d-flex flex-column text-start fs-5 mb-3"><span>employee ID</span>
                            1204
                        </li>
                        <li class="text-white d-flex flex-column text-start fs-5 mb-3"><span>ATM ID</span>
                            1204
                        </li>
                    </ul>
                </div>

            </div>
            <div class="screen menu">
                <div class="buttons d-flex flex-wrap justify-content-between">
                    <button id="cashBTN" class="btn btnMenu">
                        Fill Cash
                    </button>
                    <a href="logger.php" class="btn btnMenu">
                        Check ATM Logger
                    </a>
                    <form action="" style="width: 100%">
                        <button class="btn btnMenu btn-primary">
                            logOut
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="popup serviceMenu flex-column" pop="true">
        <i id="closeMenu" class="fa-solid fa-xmark"></i>
        <h2 class="text-white fs-1 mb-5">Enter Cash</h2>
        <div class="lds-ring mb-4">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <form action="#" class="w-100">
            <div class="form-floating mb-3">
                <input type="amount" class="form-control input" id="Input" placeholder="01234 5648 6542 3156"
                    minlength="3" maxlength="7">
                <label for="Input">Enter Amount</label>
            </div>
            <button class="btn btn-primary mt-3 w-100">Enter</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script src="assets/js/serviceMenu.js"></script>
    <script src="assets/js/transfer.js"></script>
</body>

</html>
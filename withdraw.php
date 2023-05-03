<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" href="assets/img/atm.png">
    <title>ATM APP</title>
</head>

<body>

    <div class="insert h-100 d-flex align-items-center justify-content-center">
        <div class="screens bg d-flex">
            <div class="screen info">
                <h2 class="text-white fw-bolder">Withdraw</h2>
                <div class="userInfo my-5">
                    <ul>
                        <li class="text-white d-flex flex-column text-start fs-5 mb-3"><span>Balcnce</span> $2,000

                        </li>
                        <li class="text-white d-flex flex-column text-start fs-5 mb-3"><span>Account id</span> 1204

                        </li>
                    </ul>
                </div>
            </div>

            <div class="screen menu">
                <div class="buttons d-flex flex-wrap justify-content-between">
                    <form action="#" class="w-100" method="get">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="Amount" minlength="2" maxlength="5"
                                placeholder="01234 5648 6542 3156" name="amount">
                            <label for="Amount">Enter Amount</label>
                        </div>
                        <div class="btn btnMenu withdrawBTN" value="50">
                            50 LE
                        </div>
                        <div class="btn btnMenu withdrawBTN" value="100">
                            100 LE
                        </div>
                        <div class="btn btnMenu withdrawBTN" value="200">
                            200 LE
                        </div>
                        <div class="btn btnMenu withdrawBTN" value="500">
                            500 LE
                        </div>
                        <div class="btn btnMenu withdrawBTN" value="1000">
                            1000 LE
                        </div>
                        <div class="btn btnMenu withdrawBTN" value="2000">
                            2000 LE
                        </div>
                        <button class="btn btn-primary w-100 py-3 mt-4">
                            Withdraw
                        </button>
                    </form>
                </div>
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
    <script src="assets/js/withdraw.js"></script>
</body>

</html>
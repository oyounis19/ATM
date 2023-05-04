<?php
session_start();
$userID = "";
$firstname = "";
$lastname = "";

require_once '../Models/admin.php';

$showAlert = false;

if(isset($_SESSION['userID']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname'])){
    $userID = $_SESSION['userID'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $showAlert = true;
}else{
    echo '<b>Redirecting you to login screen to login...</b>';
    $refresh_delay = 3; // 3 seconds delay
    $redirect_url = "login.php";

    header("refresh:$refresh_delay;url=$redirect_url");
    exit();
}

$admin = new admin;


// create new admin
if (isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['userName']) && isset($_POST['passWord'])){
    $admin->createAdmin($_POST['fName'], $_POST['lName'], $_POST['userName'], $_POST['passWord']);
}


//Log Out
if(isset($_POST['ptnLogOut'])){
    $admin->logout();
    header("Location: loginAdmin.php");
    exit;
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
    <link rel="stylesheet" href="adminAssets/css/style.css">
    <link rel="icon" href="adminAssets/img/atm.png">
    <title>Admin Page</title>
</head>

<body>

    <!-- start nav  -->

    <nav class="navbar">
        <div class="container-fluid">
            <i id="menuBTN" class="fa-solid fa-bars"></i>
            <span class="mb-0 fs-1">ADMIN ATM</span>
        </div>
    </nav>

    <!-- end nav  -->

    <!-- start leftSide -->

    <div class="leftSide" id="leftSide">
        <ul class="d-flex flex-column ">
            <li>
                <button class="btn-primary d-flex" id="DashBoardBTN">DashBoard</button>
            </li>
            <li>
                <button class="btn-primary d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
                    Mange Accounts <i class="fa-solid fa-chevron-down"></i>
                </button>
            </li>
            <div class="collapse" id="collapseExample1">
                <ul>
                    <li class="ps-3 " id="createAccountBTN">Create Account</li>
                    <li class="ps-3 " id="deleteAccountBTN">Delete Account</li>
                    <li class="ps-3 " id="editAccountBTN">Edit Account</li>
                    <li class="ps-3 " id="creditCardBTN">Mangae Credit Cards</li>
                </ul>
            </div>
            <li>
                <button class="btn-primary d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                    Mange users <i class="fa-solid fa-chevron-down"></i>
                </button>
            </li>
            <div class="collapse" id="collapseExample2">
                <ul>
                    <li class="ps-3" id="createUserBTN">Create user</li>
                    <li class="ps-3" id="deleteUserBTN">Delete user</li>
                    <li class="ps-3" id="editUserBTN">Edit user</li>
                </ul>
            </div>
            <li>
                <button class="btn-primary d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
                    Mange ATMs <i class="fa-solid fa-chevron-down"></i>
                </button>
            </li>
            <div class="collapse" id="collapseExample3">
                <ul>
                    <li class="ps-3" id="createATMBTN">Create ATM</li>
                    <li class="ps-3" id="deleteATMBTN">Delete ATM</li>
                </ul>
            </div>
            <li>
                <button class="btn-primary d-flex" id="CreateAdminBTN">Create Admin</button>
            </li>
        </ul>
        
        <form method="POST" action="home.php">
            <button class="btn btn-danger" name="ptnLogOut" style="width: 100%">Log Out</button>
        </form>
    </div>

    <!-- end leftSide -->

    <!-- start dashboard  -->

    <section class="DashBoard screen" id="DashBoard">
        <div class="container-fluid">
            <ul>
                <li>
                    <h2>Welcome : <span><?php echo $firstname.' '.$lastname ?></span></h2>
                </li>
                <li>
                    <h2>Your Account ID : <span><?php echo $userID ?></span></h2>
                </li>
            </ul>
        </div>
    </section>

    <!-- end dashboard  -->

    <!-- start createAccount  -->

    <section class="createAccount screen d-none" id="createAccount">
        <div class="container-fluid">
            <h2>Create Account</h2>
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingSSN" placeholder="Password">
                    <label for="floatingSSN">SSN</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingCard" placeholder="Password">
                    <label for="floatingCard">Card ID</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option value="Gold">Gold</option>
                        <option value="Saving">Saving</option>
                        <option value="Current">Current</option>
                    </select>
                    <label for="floatingSelect">Select Account Type</label>
                </div>
                <button class="btn btn-success">Add Account</button>
            </form>
        </div>
    </section>

    <!-- end createAccount  -->

    <!-- start editAccount -->

    <section class="editAccount d-none screen" id="editAccount">
        <div class="container-fluid">
            <h2>Edit Account</h2>
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="UserID" placeholder="name@example.com">
                    <label for="UserID">Account ID</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingSSN" placeholder="Password">
                    <label for="floatingSSN">Balance</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option value="Running">Running</option>
                        <option value="Blocked">Blocked</option>
                    </select>
                    <label for="floatingSelect">State</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option value="Gold">Gold</option>
                        <option value="Saving" selected>Saving</option>
                        <option value="Current">Current</option>
                    </select>
                    <label for="floatingSelect">Change Account Type</label>
                </div>
                <button class="btn btn-success">Edit Account</button>
            </form>
        </div>
    </section>

    <!-- end editAccount -->

    <!-- start deleteAccount -->


    <section class="deleteAccount d-none screen" id="deleteAccount">
        <div class="container-fluid">
            <h2>Delete Account</h2>
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="UserID" placeholder="name@example.com">
                    <label for="UserID">Account ID</label>
                </div>
                <button class="btn btn-danger rounded">Edit Account</button>
            </form>
        </div>
    </section>

    <!-- end deleteAccount -->


    <!-- start creditCard -->

    <section class="creditCard d-none screen" id="creditCard">
        <div class="container-fluid">
            <h2>Manage Creddit Cards</h2>
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="UserID" placeholder="name@example.com">
                    <label for="UserID">Credit Card ID</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option value="Blocked">Blocked</option>
                        <option value="Running" selected>Running</option>
                    </select>
                    <label for="floatingSelect">Change State</label>
                </div>
                <button class="btn btn-success rounded">Edit Credit Card</button>
            </form>
        </div>
    </section>

    <!-- end creditCard -->

    <!-- start createUser  -->

    <section class="createUser d-none screen" id="createUser">
        <div class="container-fluid">
            <h2>Create User</h2>
            <form action="#">
                <div class="name d-flex gap-4">

                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="firstName" placeholder="First Name">
                        <label for="firstName">First Name</label>
                    </div>
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                        <label for="lastName">Last Name</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" placeholder="Email">
                    <label for="email">Email</label>
                </div>

                <div class="d-flex gap-4">
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="street" placeholder="Street">
                        <label for="street">Street</label>
                    </div>
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="area" placeholder="Area">
                        <label for="area">Area</label>
                    </div>
                </div>

                <div class="d-flex gap-4">

                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="city" placeholder="City">
                        <label for="city">City</label>
                    </div>
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="country" placeholder="country">
                        <label for="country">Country</label>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="postalCode" placeholder="postal code">
                    <label for="postalCode">postal code</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingSSN" placeholder="SSN">
                    <label for="floatingSSN">SSN</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="fingerprint" placeholder="Fingerprint Image">
                    <label for="fingerprint">upload Fingerprint Image</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="PINcode" placeholder="PIN Code">
                    <label for="PINcode">PIN Code</label>
                </div>
                <button class="btn btn-success">Add User</button>
            </form>
        </div>
    </section>

    <!-- end createUser  -->

    <!-- start editUser  -->

    <section class="editUser screen d-none screen" id="editUser">
        <div class="container-fluid">
            <h2>Edit User</h2>

            <form action="#">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="SSN" placeholder="SSN">
                    <label for="SSN">SSN</label>
                </div>

                <button class="btn btn-success mb-3 ">Edit User</button>
            </form>
        </div>
        <div class="Formpopup editForm ">
            <form action="#">
                <div class="d-flex gap-4">
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="street" placeholder="Street">
                        <label for="street">Edit Street</label>
                    </div>
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="area" placeholder="Area">
                        <label for="area">Edit Area</label>
                    </div>
                </div>
                <div class="d-flex gap-4">
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="city" placeholder="City">
                        <label for="city">Edit City</label>
                    </div>
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="country" placeholder="country">
                        <label for="country">Edit Country</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="postalCode" placeholder="postal code">
                    <label for="postalCode">Edit postal code</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="fingerprint" placeholder="Fingerprint Image">
                    <label for="fingerprint">Edit Fingerprint Image</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="PINcode" placeholder="PIN Code">
                    <label for="PINcode">Edit PIN Code</label>
                </div>
                <button class="btn btn-success">Edit User</button>
            </form>
        </div>
        <div class="OTPpopup">
            <div class="alert alert-info" role="alert">
                OTP Send to Your Email
            </div>
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="OTP" placeholder="OTP">
                    <label for="OTP">OTP</label>
                </div>
                <button class="btn btn-success">
                    Check OTP
                </button>
            </form>
            <a href="#" class="forget">
                Forget Email
            </a>

            <!-- <div class="form-floating mb-3">
                <input type="file" class="form-control" id="fingerprint" placeholder="Fingerprint Image">
                <label for="fingerprint">Edit Fingerprint Image</label>
            </div> -->
        </div>
        <div class="fingerPopup">
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="fingerprint" placeholder="Fingerprint Image">
                    <label for="fingerprint">Edit Fingerprint Image</label>
                </div>
                <button class="btn btn-success">
                    Check Fingerprint
                </button>
            </form>
        </div>
    </section>

    <!-- end editUser  -->

    <!-- start deleteUser  -->

    <section class="deleteUser screen d-none" id="deleteUser">
        <div class="container-fluid">
            <h2>Delete User</h2>

            <form action="#">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="SSN" placeholder="SSN">
                    <label for="SSN">SSN</label>
                </div>

                <button class="btn btn-danger mb-3 ">Delete User</button>
            </form>
        </div>
        <div class="OTPpopup">
            <div class="alert alert-info" role="alert">
                OTP Send to Your Email
            </div>
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="OTP" placeholder="OTP">
                    <label for="OTP">OTP</label>
                </div>
                <button class="btn btn-danger">
                    Delete User
                </button>
            </form>
            <a href="#" class="forget">
                Forget Email
            </a>
        </div>
        <div class="fingerPopup">
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="fingerprint" placeholder="Fingerprint Image">
                    <label for="fingerprint">Edit Fingerprint Image</label>
                </div>
                <button class="btn btn-danger">
                    Delete User
                </button>
            </form>
        </div>
    </section>

    <!-- end deleteUser  -->


    <!-- start Create ATM  -->

    <section class="createATM screen d-none" id="createATM">
        <div class="container-fluid">
            <h2>Add ATM</h2>
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="CityATM" placeholder="City">
                    <label for="CityATM">City</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="AreaATM" placeholder="Area">
                    <label for="AreaATM">Area</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="StreetATM" placeholder="StreetATM">
                    <label for="StreetATM">Street</label>
                </div>
                <button class="btn btn-success">
                    Add ATM
                </button>
            </form>
        </div>
    </section>

    <!-- end Create ATM  -->

    <!-- start Delete ATM  -->

    <section class="deleteATM screen d-none" id="deleteATM">
        <div class="container-fluid">
            <h2>Delete ATM</h2>
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="ATMid" placeholder="ATMid">
                    <label for="ATMid">ATM ID</label>
                </div>
                <button class="btn btn-danger">
                    Delete ATM
                </button>
            </form>
        </div>
    </section>

    <!-- end Delete ATM  -->

    <!-- start CreateAdmin -->
    <section class="CreateAdmin screen d-none" id="CreateAdmin">
        <div class="container-fluid">
            <form  method="POST" action="home.php">
                <div class="d-flex gap-4">
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="floatingSSN" placeholder="First Name" name="fName" required>
                        <label for="floatingSSN">First Name</label>
                    </div>
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lName" required>
                        <label for="lastName">Last Name</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="UserName" placeholder="user Name" name="userName" required>
                    <label for="UserName">User Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="Password" class="form-control" id="floatingPassword" placeholder="Password" name="passWord" >
                    <label for="floatingCard">Password</label>
                </div>
                <button class="btn btn-success">Add Amin</button>
            </form>
        </div>
    </section>

    <!-- end CreateAdmin -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="adminassets/js/script.js"></script>
</body>

</html>

<?php
if($showAlert){

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
        icon: 'success',
        title: 'Signed in successfully'
        })
    </script>
    <?php
     }?>

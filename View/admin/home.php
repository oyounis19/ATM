<?php
require_once __DIR__."/../../Models/admin.php";

session_start();
$userID = "";
$firstname = "";
$lastname = "";


$showAlert = false;

if(isset($_SESSION['userID']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname'])){
    $userID = $_SESSION['userID'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $showAlert = true;
}else{
    echo '<b>Redirecting you to login screen to login...</b>';
    $refresh_delay = 3; // 3 seconds delay
    $redirect_url = "loginAdmin.php";

    header("refresh:$refresh_delay;url=$redirect_url");
    exit();
}
require_once __DIR__."/nav.php";
require_once (__DIR__."/Head.php");
?>
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

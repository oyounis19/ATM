    <!-- start createAccount  -->
    <?php
require_once (__DIR__."/Head.php");
require_once (__DIR__."/../../Models/Account.php");
require_once (__DIR__."/../../Models/Card.php");
require_once (__DIR__."/../../Models/customer.php");

$showAlert = 0;

if(isset($_POST["SSN"]) && isset($_POST["Type"])){
    $account = new Account();
    $account->setType($_POST["Type"]);
    $customer = new customer();
    $customer->setSSN($_POST["SSN"]);
    $admin = new admin();
    $result = $admin->createAccount($account,$customer);
    if ($result) {
        $showAlert = 1;
    } else {
        $showAlert = 2;
    }
}
?>
<body>
    <?php
        require_once (__DIR__. "/nav.php");
    ?>    
    <div class="container">
        <div class="createAccount screen" id="createAccount">
            <div class="container-fluid">
                <h2>Create Account</h2>
                <form method="post" action="#">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingSSN" placeholder="Password" name="SSN">
                        <label for="floatingSSN">SSN</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="Type">
                            <option value="Gold">Gold</option>
                            <option value="Saving">Saving</option>
                            <option value="Current">Current</option>
                        </select>
                        <label for="floatingSelect">Select Account Type</label>
                    </div>
                    <input type = "submit" class="btn btn-success" value="Add Account">
                </form>
            </div>
        </div>
    </div>

</body>
<?php
if ($showAlert == 1) {

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
            title: 'Account created successfully'
        })
    </script>
<?php
} else if ($showAlert == 2) {
?>
    <script>
        const Tooast = Swal.mixin({
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

        Tooast.fire({
            icon: 'error',
            title: 'Something went wrong with creating the account'
        })
    </script>
<?php
} ?>

    <!-- end createAccount  -->
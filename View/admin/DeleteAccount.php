<?php
require_once(__DIR__ . "/Head.php");
require_once(__DIR__ . "/../../Models/Account.php");
$showAlert = 0;

if (isset($_POST["AccId"])) {
    $account = new Account();
    $account->setId($_POST["AccId"]);
    $admin = new admin("", "");

    $result = $admin->deleteAccount($account);
    if ($result) {
        $showAlert = 1;
    } else {
        $showAlert = 2;
    }
}
?>

<body>
    <?php
    require_once(__DIR__ . "/nav.php");
    ?>
    <div class="container">
        <!-- start deleteAccount -->

        <section class="deleteAccount screen" id="deleteAccount">
            <div class="container-fluid">
                <h2>Delete Account</h2>
                <form action="#" method="post">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="UserID" placeholder="name@example.com" name="AccId">
                        <label for="UserID">Account ID</label>
                    </div>
                    <input class="btn btn-danger rounded" value="Delete Account" type="submit">
                </form>
            </div>
        </section>

        <!-- end deleteAccount -->

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
            title: 'ATM deleted successfully'
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
            title: 'something went wrong with the ATM deleting'
        })
    </script>
<?php
} ?>
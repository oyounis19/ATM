<?php
require_once(__DIR__ . "/../../Models/admin.php");
require_once(__DIR__ . "/Head.php");

$showAlert = 0;
$admin = new admin("", "");


if (isset($_POST['atmId'])) {
    $ok = $admin->deleteATM($_POST['atmId']);
    if ($ok) {
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
        <!-- start Delete ATM  -->

        <section class="deleteATM screen " id="deleteATM">
            <div class="container-fluid">
                <h2>Delete ATM</h2>
                <form method="POST" action="#">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="ATMid" placeholder="ATMid" name="atmId">
                        <label for="ATMid">ATM ID</label>
                    </div>
                    <button class="btn btn-danger">
                        Delete ATM
                    </button>
                </form>
            </div>
        </section>

        <!-- end Delete ATM  -->
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
<?php
require_once(__DIR__ . "/../../Models/admin.php");
require_once(__DIR__ . "/Head.php");

$showAlert = 0;
$admin = new admin();


if (isset($_POST['city']) && isset($_POST['area']) && isset($_POST['street'])) {
    $ok = $admin->addATM($_POST['city'], $_POST['area'], $_POST['street']);
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
        <!-- start Create ATM  -->

        <section class="createATM screen " id="createATM">
            <div class="container-fluid">
                <h2>Add ATM</h2>
                <form method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="CityATM" placeholder="City" name="city" required>
                        <label for="CityATM">City</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="AreaATM" placeholder="Area" name="area" required>
                        <label for="AreaATM">Area</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="StreetATM" placeholder="StreetATM" name="street" required>
                        <label for="StreetATM">Street</label>
                    </div>
                    <button class="btn btn-success">
                        Add ATM
                    </button>
                </form>
            </div>
        </section>

        <!-- end Create ATM  -->
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
            title: 'New ATM added successfully'
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
            title: 'something went wrong with ATM adding'
        })
    </script>
<?php
} ?>
<?php
require_once __DIR__ . "/../../Models/admin.php";

session_start();
$userID = "";
$firstname = "";
$lastname = "";

isset($_SESSION['views']) ? $_SESSION['views']++ : $_SESSION['views'] = 1;

$showAlert = false;

if (isset($_SESSION['userID']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) {
    $userID = $_SESSION['userID'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];

    if ($_SESSION['views'] < 2) {
        $showAlert = true;
    }
} else {
    echo '<b>Redirecting you to login screen to login...</b>';
    $refresh_delay = 3; // 3 seconds delay
    $redirect_url = "../loginAdmin.php";

    header("refresh:$refresh_delay;url=$redirect_url");
    exit();
}
require_once __DIR__ . "/nav.php";
require_once(__DIR__ . "/Head.php");
?>
<!-- start dashboard  -->

<section class="DashBoard screen" id="DashBoard">
    <div class="container-fluid">
        <ul>
            <li>
                <h2>Welcome : <span><?php echo $firstname . ' ' . $lastname ?></span></h2>
            </li>
            <li>
                <h2>Your Account ID : <span><?php echo $userID ?></span></h2>
            </li>
        </ul>
    </div>
</section>

<!-- end dashboard  -->

</body>

</html>

<?php
if ($showAlert) {

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
} ?>
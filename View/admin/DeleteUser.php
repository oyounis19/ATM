<?php
require_once (__DIR__."/Head.php");
?>

<body>  
    <?php
        require_once (__DIR__. "/nav.php");
    ?>

    <div class="container">
        <!-- start deleteUser  -->

    <section class="deleteUser screen" id="deleteUser">
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
    </div>
</body>
<?php
require_once (__DIR__."/Head.php");
?>

<body>  
    <?php
        require_once (__DIR__. "/nav.php");
    ?>

    <div class="container">
        <!-- start editUser  -->

    <section class="editUser screen screen" id="editUser">
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

    </div>
</body>
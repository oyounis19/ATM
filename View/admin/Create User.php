<?php
require_once (__DIR__."/Head.php");
?>

<body>  
    <?php
        require_once (__DIR__. "/nav.php");
    ?>

    <div class="container">
       <!-- start createUser  -->

       <section class="createUser screen" id="createUser">
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
    </div>
</body>
<?php
require_once (__DIR__."/Head.php");
require_once(__DIR__."/../../Models/customer.php");

$showAlert = 0;
echo "ahmed";

$hashedFingerPrint = false;

if(isset($_FILES['fprint'])){
    $target_file1 = $_FILES['fprint']["tmp_name"];
    $hashedFingerPrint = md5_file ($target_file1);
    echo $hashedFingerPrint."<br>";
}

if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["street"]) && isset($_POST["area"])
&& isset($_POST["city"]) && isset($_POST["SSN"]) &&  isset($_POST["PIN"]) && $hashedFingerPrint){
    $customer = new customer();
    $customer->setFirstName($_POST["fname"]);
    $customer->setLastName($_POST["lname"]);
    $customer->setEmail($_POST["email"]);
    $customer->setStreet($_POST["street"]);
    $customer->setArea($_POST["area"]);
    $customer->setCity($_POST["city"]);
    $customer->setSSN($_POST["SSN"]);
    $customer->setPin($_POST["PIN"]);
    $customer->setFingerprint($hashedFingerPrint);

    $admin = new Admin("","");
    echo "ahmed";
    $result = $admin->addCustomer($customer);
    echo "ahmed2";
    if ($result) 
        $showAlert = 1;
    else 
        $showAlert = 2;
    
}
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
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="name d-flex gap-4">

                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="firstName" placeholder="First Name" name="fname">
                        <label for="firstName">First Name</label>
                    </div>
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lname">
                        <label for="lastName">Last Name</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                    <label for="email">Email</label>
                </div>

                <div class="d-flex gap-4">
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="street" placeholder="Street" name="street">
                        <label for="street">Street</label>
                    </div>
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="area" placeholder="Area" name="area">
                        <label for="area">Area</label>
                    </div>
                </div>

                <div class="d-flex gap-4">

                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="city" placeholder="City" name="city">
                        <label for="city">City</label>
                    </div>
                    <div class="form-floating w-50 mb-3">
                        <input type="text" class="form-control" id="country" placeholder="country" name="country">
                        <label for="country">Country</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingSSN" placeholder="SSN" name="SSN">
                    <label for="floatingSSN">SSN</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="fingerprint" placeholder="Fingerprint Image" name="fprint">
                    <label for="fingerprint">upload Fingerprint Image</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="PINcode" placeholder="PIN Code" name="PIN">
                    <label for="PINcode">PIN Code</label>
                </div>
                <input class="btn btn-success" type = "submit" value="Add User">
            </form>
        </div>
    </section>

    <!-- end createUser  -->
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
                title: 'New customer created successfully'
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
                title: 'something went wrong with creating the customer'
            })
        </script>
    <?php
    } ?>
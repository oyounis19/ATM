    <?php 
        require_once (__DIR__ . "/../../Models/admin.php");
        $admin = new admin();
        // create new admin
        if (isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['userName']) && isset($_POST['passWord'])){
            $admin->createAdmin($_POST['fName'], $_POST['lName'], $_POST['userName'], $_POST['passWord']);
        }   
        require_once (__DIR__."/Head.php");
    ?>
    <!-- start CreateAdmin -->

    <body>
        
        <?php
            require_once (__DIR__. "/nav.php");
        ?>
        <div class="container">
        <div class="CreateAdmin screen" id="CreateAdmin">
            <div class="container-fluid">
                <form  method="POST" action="#">
                    <div class="d-flex gap-4">
                        <div class="form-floating w-50 mb-3">
                            <input type="text" class="form-control" id="floatingSSN" placeholder="First Name" name="fName" required>
                            <label for="floatingSSN">First Name</label>
                        </div>
                        <div class="form-floating w-50 mb-3">
                            <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lName" required>
                            <label for="lastName">Last Name</label>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="UserName" placeholder="user Name" name="userName" required>
                        <label for="UserName">User Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Password" class="form-control" id="floatingPassword" placeholder="Password" name="passWord" >
                        <label for="floatingCard">Password</label>
                    </div>
                    <input class="btn btn-success" type = "submit" name = "Add Admin">
                </form>
            </div>
        </div>
        </div>
    </body>


    <!-- end CreateAdmin -->

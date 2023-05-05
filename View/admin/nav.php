<?php 
    require_once (__DIR__ . "/../../Models/admin.php");
    //Log Out
    if(isset($_POST['ptnLogOut'])){
        $admin = new admin();
        $admin->logout();
        header("Location: ../loginAdmin.php");
        exit;
    }
?>


    <!-- start nav  -->

    <nav class="navbar">
        <div class="container-fluid">
            <i id="menuBTN" class="fa-solid fa-bars"></i>
            <span class="mb-0 fs-1">ADMIN ATM</span>
        </div>
    </nav>

    <!-- end nav  -->

    <!-- start leftSide -->

    <div class="leftSide" id="leftSide">
        <ul class="d-flex flex-column ">
            <li>
                <button class="btn-primary d-flex" id="DashBoardBTN">DashBoard</button>
            </li>
            <li>
                <button class="btn-primary d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
                    Mange Accounts <i class="fa-solid fa-chevron-down"></i>
                </button>
            </li>
            <div class="collapse" id="collapseExample1">
                <ul>
                    <li class="ps-3 " id="createAccountBTN">Create Account</li>
                    <li class="ps-3 " id="deleteAccountBTN">Delete Account</li>
                    <li class="ps-3 " id="editAccountBTN">Edit Account</li>
                    <li class="ps-3 " id="creditCardBTN">Mangae Credit Cards</li>
                </ul>
            </div>
            <li>
                <button class="btn-primary d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                    Mange users <i class="fa-solid fa-chevron-down"></i>
                </button>
            </li>
            <div class="collapse" id="collapseExample2">
                <ul>
                    <li class="ps-3" id="createUserBTN">Create user</li>
                    <li class="ps-3" id="deleteUserBTN">Delete user</li>
                    <li class="ps-3" id="editUserBTN">Edit user</li>
                </ul>
            </div>
            <li>
                <button class="btn-primary d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
                    Mange ATMs <i class="fa-solid fa-chevron-down"></i>
                </button>
            </li>
            <div class="collapse" id="collapseExample3">
                <ul>
                    <li class="ps-3" id="createATMBTN">Create ATM</li>
                    <li class="ps-3" id="deleteATMBTN">Delete ATM</li>
                </ul>
            </div>
            <li>
                <a href="CreateAdmin.php"><button class="btn-primary d-flex" id="CreateAdminBTN">Create Admin</button></a>
            </li>
        </ul>
        
        <form method="POST" action="home.php">
            <button class="btn btn-danger" name="ptnLogOut" style="width: 100%">Log Out</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="adminAssets/js/script.js"></script>



    <!-- end leftSide -->
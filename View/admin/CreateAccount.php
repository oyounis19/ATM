    <!-- start createAccount  -->
    <?php
require_once (__DIR__."/Head.php");
require_once (__DIR__."/../../Models/Account.php");
require_once (__DIR__."/../../Models/Card.php");
require_once (__DIR__."/../../Models/customer.php");
if(isset($_POST["SSN"]) && isset($_POST["Cardid"]) && isset($_POST["Type"])){
    $account->setType($_POST["Type"]);
    $card = new Card();
    $card->setId($_POST["Cardid"]);
    $customer = new customer();
    $customer->setSSN($_POST["SSN"]);
    $admin = new admin();
    $admin->createAccount($account,$customer,$card);
}
?>
<body>
    <?php
        require_once (__DIR__. "/nav.php");
    ?>    
    <div class="container">
        <div class="createAccount screen" id="createAccount">
            <div class="container-fluid">
                <h2>Create Account</h2>
                <form method="post" action="#">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingSSN" placeholder="Password" name="SSN">
                        <label for="floatingSSN">SSN</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingCard" placeholder="Password" name="Cardid">
                        <label for="floatingCard">Card ID</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="Type">
                            <option value="Gold">Gold</option>
                            <option value="Saving">Saving</option>
                            <option value="Current">Current</option>
                        </select>
                        <label for="floatingSelect">Select Account Type</label>
                    </div>
                    <input type = "submit" class="btn btn-success" value="Add Account">
                </form>
            </div>
        </div>
    </div>

</body>


    <!-- end createAccount  -->
    <!-- start createAccount  -->
<?php
require_once (__DIR__."/Head.php");
?>
<body>
    <?php
        require_once (__DIR__. "/nav.php");
    ?>    
    <div class="container">
        <div class="createAccount screen" id="createAccount">
            <div class="container-fluid">
                <h2>Create Account</h2>
                <form action="#">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingSSN" placeholder="Password">
                        <label for="floatingSSN">SSN</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingCard" placeholder="Password">
                        <label for="floatingCard">Card ID</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option value="Gold">Gold</option>
                            <option value="Saving">Saving</option>
                            <option value="Current">Current</option>
                        </select>
                        <label for="floatingSelect">Select Account Type</label>
                    </div>
                    <button class="btn btn-success">Add Account</button>
                </form>
            </div>
        </div>
    </div>

</body>


    <!-- end createAccount  -->
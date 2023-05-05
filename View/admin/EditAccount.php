<?php
require_once (__DIR__."/Head.php");
?>

<body>  
    <?php
        require_once (__DIR__. "/nav.php");
    ?>
    <!-- start editAccount -->
    <div class="container">
        <section class="editAccount screen" id="editAccount">
            <div class="container-fluid">
                <h2>Edit Account</h2>
                <form action="#">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="UserID" placeholder="name@example.com">
                        <label for="UserID">Account ID</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingSSN" placeholder="Password">
                        <label for="floatingSSN">Balance</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option value="Running">Running</option>
                            <option value="Blocked">Blocked</option>
                        </select>
                        <label for="floatingSelect">State</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option value="Gold">Gold</option>
                            <option value="Saving" selected>Saving</option>
                            <option value="Current">Current</option>
                        </select>
                        <label for="floatingSelect">Change Account Type</label>
                    </div>
                    <button class="btn btn-success">Edit Account</button>
                </form>
            </div>
        </section>
    </div>

</body>
    <!-- end editAccount -->
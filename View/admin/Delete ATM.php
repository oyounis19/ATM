<?php
require_once (__DIR__."/Head.php");
?>

<body>  
    <?php
        require_once (__DIR__. "/nav.php");
    ?>
    <div class = "container">
            <!-- start Delete ATM  -->

    <section class="deleteATM screen " id="deleteATM">
        <div class="container-fluid">
            <h2>Delete ATM</h2>
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="ATMid" placeholder="ATMid">
                    <label for="ATMid">ATM ID</label>
                </div>
                <button class="btn btn-danger">
                    Delete ATM
                </button>
            </form>
        </div>
    </section>

    <!-- end Delete ATM  -->
    </div>
</body>
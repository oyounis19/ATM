<?php
require_once (__DIR__."/Head.php");
?>
<body>
    <?php
        require_once (__DIR__. "/nav.php");
    ?>    
    <div class="container">
        <!-- start deleteAccount -->

        <section class="deleteAccount screen" id="deleteAccount">
        <div class="container-fluid">
            <h2>Delete Account</h2>
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="UserID" placeholder="name@example.com">
                    <label for="UserID">Account ID</label>
                </div>
                <button class="btn btn-danger rounded">Edit Account</button>
            </form>
        </div>
    </section>

    <!-- end deleteAccount -->

    </div>
</body>
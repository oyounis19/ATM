<?php
require_once (__DIR__."/Head.php");
?>

<body>  
    <?php
        require_once (__DIR__. "/nav.php");
    ?>

    <div class="container">
        <!-- start creditCard -->

        <section class="creditCard screen" id="creditCard">
            <div class="container-fluid">
                <h2>Manage Credit Cards</h2>
                <form action="#">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="UserID" placeholder="name@example.com">
                        <label for="UserID">Credit Card ID</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option value="Blocked">Blocked</option>
                            <option value="Running" selected>Running</option>
                        </select>
                        <label for="floatingSelect">Change State</label>
                    </div>
                    <button class="btn btn-success rounded">Edit Credit Card</button>
                </form>
            </div>
        </section>

        <!-- end creditCard -->
    </div>
</body>

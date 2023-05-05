<?php
require_once (__DIR__."/Head.php");
?>

<body>  
    <?php
        require_once (__DIR__. "/nav.php");
    ?>
    <div class = "container">
            <!-- start Create ATM  -->

    <section class="createATM screen " id="createATM">
        <div class="container-fluid">
            <h2>Add ATM</h2>
            <form action="#">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="CityATM" placeholder="City">
                    <label for="CityATM">City</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="AreaATM" placeholder="Area">
                    <label for="AreaATM">Area</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="StreetATM" placeholder="StreetATM">
                    <label for="StreetATM">Street</label>
                </div>
                <button class="btn btn-success">
                    Add ATM
                </button>
            </form>
        </div>
    </section>

    <!-- end Create ATM  -->
    </div>
</body>
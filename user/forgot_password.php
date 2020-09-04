<?php
echo "<title>Kato | Reset Password</title>";
?>
<div class="container-fluid text-center max400 d-flex flex-column">
    <h1 class="ml-0 mr-0  mb-5 mt-5">Password Reset </h1>
    <form>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text logobgcolor text-white">
                    <i class="fas fa-user"></i></span>
            </div>
            <input id="forgotuname" type="text" class="form-control" placeholder="Username" required>
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class=" input-group-text logobgcolor text-white">
                    <i class=" fas fa-key"></i></span>
            </div>
            <input id="forgotemail" type="email" class="form-control" placeholder="E-Mail" required>
        </div>

        <button id="reset" class="btn btn-dark w-100 logobgcolor p-2">Reset</button>
        <p class="m-2">New User? <a class="logocolor" href=<?php echo $baseUrl . "/Register" ?>>Register</a> <br>
            Already an User? <a class="logocolor" href=<?php echo $baseUrl ?>>Login</a></p>
    </form>
</div>
<script src=<?php echo $baseUrl . "/cssandjs/js/forgot_password.js"; ?>></script>
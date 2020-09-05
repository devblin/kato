<?php
echo "<title>Kato | Login</title>";
?>

<div class="container-fluid text-center max400 d-flex flex-column">
    <h1 class="m-5 logodcolor">Login</h1>
    <div class="mb-2" id="info"></div>
    <form>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text logobgdcolor text-white">
                    <i class="fas fa-user"></i></span>
            </div>
            <input id="username" type="text" class="form-control info" placeholder="Username" required>
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class=" input-group-text logobgdcolor text-white">
                    <i class=" fas fa-key"></i></span>
            </div>
            <input id="userpwd" type="password" class="form-control info" placeholder="Password" required>
        </div>
        <div class="form-check text-left mb-1">
            <label class="form-check-label m-1">
                <input id="rememberme" type="checkbox" class="form-check-input" value="rememberme"> Remember Me
            </label>
        </div>
        <button id="login" class="btn btn-dark w-100 logobgcolor p-2">Login</button>
        <p class="m-2">New User? <a class="logocolor" href=<?php echo $baseUrl . "/Register" ?>>Register</a> <br>
            Forgot Password? <a class="logocolor" href=<?php echo $baseUrl . "/ResetPassword"; ?>>Reset</a></p>
    </form>
</div>
<script src=<?php echo $baseUrl . "/cssandjs/js/login.js"; ?>></script>
<?php
echo "<title>Kato | Register</title>";
?>
<div class="container-fluid text-center max400 d-flex flex-column">
    <h1 class="m-5">Register</h1>
    <form>
        <div class="row">
            <div class="input-group mb-2 col-sm-6 pr-sm-1">
                <div class="input-group-prepend">
                    <span class="input-group-text logobgcolor text-white">
                        <i class="fas fa-user"></i></span>
                </div>
                <input id="newfname" type="text" class="form-control" placeholder="Firstname" required>
            </div>
            <div class="input-group mb-2 col-sm-6 pl-sm-1">
                <input id="newlname" type="text" class="form-control" placeholder="Lastname" required>
            </div>
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class=" input-group-text logobgcolor text-white">
                    <i class="fas fa-user-secret"></i></span>
            </div>
            <input id="newuname" type="text" class="form-control" placeholder="New Username" required>
        </div>
        <div class="form-group mb-2">
            <select id="newutype" class="form-control logocolor" required>
                <option value="" selected disabled hidden>Who Are You?</option>
                <option value="Buyer">Buyer</option>
                <option value="Seller">Seller</option>
            </select>
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class=" input-group-text logobgcolor text-white">
                    <i class="fas fa-at"></i></span>
            </div>
            <input id="newemail" type="email" class="form-control" placeholder="E-Mail" required>
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class=" input-group-text logobgcolor text-white">
                    <i class=" fas fa-key"></i></span>
            </div>
            <input id="newpwd" type="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class=" input-group-text logobgcolor text-white">
                    <i class=" fas fa-check-circle"></i></span>
            </div>
            <input id="newcpwd" type="password" class="form-control" placeholder="Confirm Password" required>
        </div>
        <button id="register" class="btn btn-dark w-100 logobgcolor p-2">Register</button>
        <p class="m-2">Already Registered? <a class="logocolor" href=<?php echo $baseUrl; ?>>Login</a>
        </p>
    </form>
</div>
<script src=<?php echo $baseUrl . "/cssandjs/js/register.js"; ?>></script>
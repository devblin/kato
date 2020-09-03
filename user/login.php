<div class="container-fluid text-center max400 d-flex flex-column">
    <h1 class="m-5">Login</h1>
    <form>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text logobgcolor text-white">
                    <i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Username">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class=" input-group-text logobgcolor text-white">
                    <i class=" fas fa-key"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="Password">
        </div>

        <button class="btn btn-dark w-100 logobgcolor p-2">Login</button>
        <p class="m-2">New User? <a class="logocolor" href=<?php echo $baseUrl . "/Register" ?>>Register</a> <br>
            Forgot Password? <a class="logocolor" href=<?php echo $baseUrl . "/ResetPassword"; ?>>Reset</a></p>
    </form>
</div>
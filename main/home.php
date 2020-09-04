<button class="btn btn-danger" id="logout">Logout</button>
<h1>HOME</h1>
<script>
let logoutBtn = $("#logout");
logoutBtn.click(function() {
    window.location = baseUrl + "/user/logout.php";
});
</script>
<div class="container p-0 ml-auto mr-auto mb-4 mt110" style="height: 80vh;">
    <div class="alert alert-dismissible fade show" style=" z-index:2;">
        <button type="button" class="close">&times;</button>
        <strong class="alert-msg">ERRO</strong>
    </div>
    <div class="m-1" style="    display: flex;
    flex-direction: column;
    align-items: center;">
        <h3><i class="fas fa-user-circle"></i> Your Account</h3>
        <hr class="logobgcolor w-100">
        <div id="accarea">
            <div class="input-group mb-3 d-block" style="max-width: 500px;">
                <h5 data-toggle="tooltip" title="Your Name" class="text-primary"><i class="fas fa-globe"></i> <span
                        id="accname">Deepanshu Dhruw</span></h5>
            </div>
            <div class="input-group mb-3 d-block" style="max-width: 500px;">
                <h5 data-toggle="tooltip" title="Your Username" class="text-danger"><i class="fas fa-user-circle"></i>
                    <span id="accuname">devblin</span>
                </h5>
            </div>
            <div class="input-group mb-3" style="max-width: 300px;">
                <div class="input-group-prepend">
                    <span class="input-group-text logobgcolor text-light"><i class="fas fa-envelope "></i></span>
                </div>
                <input id="accemail" type="email" class="form-control" placeholder="Email">
            </div>
            <div class="input-group mb-3 d-block" style="max-width: 500px;">
                <h4><i class="fas fa-balance-scale"></i> Role <span id="role" class="text-primary">Seller</span></h4>
            </div>
            <div>
                <button id="accupdate" class="btn btn-success w-auto mb-1"><i class="fas fa-pen-alt"></i>
                    Update</button>
                <button id="accdelete" class="btn btn-danger w-auto mb-1"><i class="fas fa-trash-alt"></i> Delete
                    Account</button>
            </div>
        </div>
    </div>
</div>
<script>
var alertMsg = new AlertMsg();
alertMsg.hideAlert();

$(document).on("click", ".close", function() {
    alertMsg.hideAlert();
});


class Account {
    url = baseUrl + "/main/seller_auth.php";
    updateDef = "<i class='fas fa-pen-alt'></i> Update";
    deleteDef = "<i class='fas fa-trash-alt'></i> Delete Account";
    getAccount = () => {
        var formData = new FormData();
        formData.append("accdetails", true);
        var body = $("#accarea").html();
        var beforeSend = () => whileAuth("#accarea", false, defaultSpinner);
        var success = (data) => {
            whileAuth("#accarea", false, "");
            $("#accarea").append(body);
            var newData = JSON.parse(data);
            $("#accname").html(newData[0].NAME);
            $("#accuname").html(newData[0].USERNAME);
            $("#accemail").val(newData[0].EMAIL);
            $("#role").html(newData[0].ROLE);
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }
    updateAccount = (newEmail) => {
        var formData = new FormData();
        formData.append("updateacc", true);
        formData.append("newemail", newEmail);
        var beforeSend = () => whileAuth("accupdate", true, smallSpinner);
        var success = (data) => {
            whileAuth("#accupdate", false, this.updateDef);
            if (data == "success" || data == "same") {
                alertMsg.showAlert("Updated Successfully", "success");
                $("#accemail").val(newEmail);
            } else {
                alertMsg.showAlert("E-Mail Already in Use", "danger");
            }
        }
        sendAjax(this.url, "POST", formData, false, false, beforeSend, success);
    }
}
var newAcc = new Account();
newAcc.getAccount();

$(document).on("click", "#accupdate", function() {
    newAcc.updateAccount($("#accemail").val());
});
</script>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginmodalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginmodalLabel">Login to iDiscuss</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="partials/_handlelogin.php" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="loginEmail">Email address</label>
                        <input type="email" class="form-control" id="loginEmail" name="loginEmail" aria-describedby="emailHelp"
                            placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="loginpassword">Password</label>
                        <input type="password" class="form-control" id="loginpassword" name="loginpassword" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
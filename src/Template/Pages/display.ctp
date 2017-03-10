

<!-- Large modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login_modal">Large modal</button>

<div class="modal fade" tabindex="-1" role="dialog" id="login_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= __('Login') ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-default pull-right"><?= __('Login') ?></button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <p><a href="" onClick="logInWithFacebook()">Log In with the JavaScript SDK</a></p>

                        <p><a href="" onClick="logOutFacebook()">Log Out</a></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <?= $this->Html->css([
        'common/bootstrap.min.css',
        'common/font-awesome.min.css',
        'admin/AdminLTE.min.css',
        'admin/skins/_all-skins.min.css',
        'admin/admin.css',
        'iCheck/square/blue.css'
    ]) ?>
    <?= $this->Html->script([
        'common/jquery.min.js',
        'common/bootstrap.min.js',
        'common/jquery.lazy.min.js',
        'admin/icheck.min.js'
    ]); ?>

</head>
<body class="hold-transition login-page" style="overflow: hidden">
<div class="login-box">
    <div class="login-logo">
        <a href="<?= $this->Url->build('/admin', true); ?>"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?= __("Sign in to start your session")?></p>
        <?= $this->Flash->render() ?>
        <form action="<?= $this->Url->build('/admin/user/login', true); ?>" method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="<?= __("Password") ?> " name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-block btn-flat"><?= __("Sign In") ?></button>
                </div>
                <!-- /.col -->
            </div>
        </form>


    </div>
</div>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>

</html>
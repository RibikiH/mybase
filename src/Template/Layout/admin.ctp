<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
        'common/bootstrap.min.css',
        'common/font-awesome.min.css',
        'admin/metisMenu.min.css',
        'admin/sb-admin-2.css'
    ]) ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

    <?= $this->Html->script([
        'common/bootstrap.min.js',
        'admin/metisMenu.min.js',
        'admin/sb-admin-2.js'
    ]) ?>

    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="wrapper">
        <?= $this->element('Admin/nav'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?= $this->fetch('title') ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
<footer>
</footer>
</body>
</html>
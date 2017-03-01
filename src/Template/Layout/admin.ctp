<!DOCTYPE html>
<html>
<head><?= $this->element('Admin/admin_head'); ?></head>
<body class="hold-transition skin-blue sidebar-mini">
    <div id="wrapper">
        <header class="main-header">
            <?= $this->element('Admin/header'); ?>
        </header>
        <?= $this->element('Admin/nav'); ?>

        <div id="page-wrapper" class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?= $this->fetch('title') ?>
                    <small>Admin Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><?= $this->fetch('title') ?></li>
                </ol>
            </section>
            <section class="content">
                <?= $this->fetch('content') ?>
            </section>
        </div>
    </div>
<footer>
</footer>
</body>
</html>
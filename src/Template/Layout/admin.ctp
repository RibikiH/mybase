<!DOCTYPE html>
<html>
<head><?= $this->element('Admin/admin_head'); ?></head>
<body class="hold-transition skin-blue sidebar-mini <?= isset($_COOKIE['toggle_nav']) ? 'sidebar-collapse' : ''; ?>">
    <div class="wrapper">
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

        <?= $this->element('Admin/common_modal'); ?>
        <?= $this->element('Admin/footer'); ?>
    </div>
<footer>
</footer>
</body>
</html>
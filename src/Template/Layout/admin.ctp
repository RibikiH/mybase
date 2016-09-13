<!DOCTYPE html>
<html>
<head><?= $this->element('Admin/admin_head'); ?></head>
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
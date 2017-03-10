<!DOCTYPE html>
<html>
<head><?= $this->element('Public/head'); ?></head>
<body>
<div class="wrapper">
    <header class="main-header" style="height: 50px">
        <?= $this->element('Public/header'); ?>
    </header>

    <div id="page-wrapper" class="content-wrapper">
        <?= $this->fetch('content') ?>
    </div>
    <footer>

    </footer>
</div>
<footer>
</footer>
</body>
</html>
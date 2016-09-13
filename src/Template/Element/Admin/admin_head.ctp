<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
    <?= $this->fetch('title') ?>
</title>
<?= $this->Html->meta('icon') ?>

<?= $this->element('Admin/common_js_css') ; ?>
<?= $this->element('Admin/admin_css') ; ?>
<?= $this->element('Admin/admin_js') ; ?>

<?= $this->fetch('meta') ?>
<?= $this->fetch('css') ?>

<?= $this->fetch('script') ?>
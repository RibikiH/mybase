<?php
use Cake\Core\Configure;
?>

<?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') . ' | ' .  Configure::read('page_title')?>
    </title>
<?= $this->Html->meta('icon') ?>

<?= $this->element('Admin/common_js_css') ; ?>
<?= $this->element('Public/css') ; ?>
<?= $this->element('Public/js') ; ?>

<?= $this->fetch('meta') ?>
<?= $this->fetch('css') ?>

<?= $this->fetch('script') ?>
<?php
    $this->assign('title', __('Dashboard'));
    $this->set('menu', 'dashboard');
?>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= isset($totalUser) ? $totalUser : '0' ?></h3>

                <p><?= __('User Registrations')?></p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= $this->Url->Build('/admin/user', true); ?>" class="small-box-footer"><?= __('More info') ?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
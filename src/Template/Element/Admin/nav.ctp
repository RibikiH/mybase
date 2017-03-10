<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu">
            <li class="header"><?= __('MAIN NAVIGATION') ?></li>
            <li class="treeview <?= !empty($menu) && $menu == 'dashboard' ? 'active' : '' ; ?>">
                <a href="<?= $this->Url->build('/admin'); ?>">
                    <i class="fa fa-dashboard"></i> <span><?= __('Dashboard') ?></span>
                </a>
            </li>
            <li class="treeview <?= !empty($menu) && $menu == 'user' ? 'active' : '' ; ?>">
                <a href="<?= $this->Url->build('/admin/user', true); ?>">
                    <i class="fa fa-users"></i> <span><?= __('Users') ?></span>
                </a>
            </li>

            <li class="header"><?= __('Manager') ?></li>
        </ul>
    </section>
</aside>
<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <ul class="sidebar-menu">
            <li class="header"><?= __('MAIN NAVIGATION') ?></li>
            <li class="treeview <?= !empty($menu) && $menu == 'dashboard' ? 'active' : '' ; ?>">
                <a href="<?= $this->Url->build('/admin'); ?>">
                    <i class="fa fa-dashboard"></i> <span><?= __('Dashboard') ?></span>
                </a>
            </li>
            <li class="treeview <?= !empty($menu) && $menu == 'options_admin' ? 'active' : '' ; ?>">
                <a href="<?= $this->Url->build('/admin/option-admin', true); ?>">
                    <i class="fa fa-gear"></i> <span><?= __('Options Admin') ?></span>
                </a>
            </li>
            <li class="treeview <?= !empty($menu) && $menu == 'user' ? 'active' : '' ; ?>">
                <a href="<?= $this->Url->build('/admin/user', true); ?>">
                    <i class="fa fa-users"></i> <span><?= __('Users') ?></span>
                </a>
            </li>
        </ul>
    </section>
</aside>
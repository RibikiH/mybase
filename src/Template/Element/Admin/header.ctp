<a href="<?= $this->Url->build('/admin', true); ?>" class="logo">
    <span class="logo-mini"><b>A</b>LT</span>
    <span class="logo-lg"><b>Admin</b>LTE</span>
</a>
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" onclick="AdminController.toggleNav()">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?= $this->Url->build('/img/user.png', true); ?>" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?= isset($authUser) ? $authUser['username'] : 'Admin';?></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header">
                        <img src="<?= $this->Url->build('/img/user.png', true); ?>" class="img-circle" alt="User Image">

                        <p>
                            <?= isset($authUser) ? $authUser['username'] : 'Admin';?>
                        </p>
                    </li>
                    <li class="user-footer">
                        <div class="pull-right">
                            <a href="<?= $this->Url->build('/admin/user/logout', true); ?>" class="btn btn-default btn-flat"><?= __('Sign out') ?></a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
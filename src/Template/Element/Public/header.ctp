<div class="user-block" style="float: right">
    <?php if (isset($authUser)): ?>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?= $this->Url->build('/img/user.png', true); ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?= isset($authUser) ? $authUser['username'] : 'Admin';?></span>
        </a>
    <?php else: ?>
        <div class="fb-login-button" data-max-rows="1" data-size="icon" data-show-faces="false" data-auto-logout-link="false"></div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login_modal">Login</button>
    <?php endif; ?>
</div>
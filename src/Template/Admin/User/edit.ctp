<?php
    use Cake\Core\Configure;
    $this->assign('title', isset($user['id']) ? __('Edit user') : __('Add user'));
?>

<div class="row">
    <?= $this->Form->create('User', array(
            'type' => 'POST',
            'autocomplete' => 'off',
            'class' => 'autoValidate',
            'enctype' => "multipart/form-data"
        )
    ); ?>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= __('Information') ?></h3>
            </div>
            <div class="box-body">
                <?= $this->Form->input('username', array(
                    'label' => __('Username'),
                    'class' => 'form-control',
                    'templates' => [
                        'inputContainer' => '<div class="form-group input {{type}}{{required}}">{{content}}</div>',
                        'inputContainerError' => '<div class="form-group input {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'autocomplete' => 'off',
                    'id' => 'ctrl_username',
                    'value' => isset($user['username']) ? $user['username'] : ''
                )); ?>
                <?= $this->Form->input('email', array(
                    'label' => __('Email'),
                    'class' => 'form-control',
                    'templates' => [
                        'inputContainer' => '<div class="form-group input {{type}}{{required}}">{{content}}</div>',
                        'inputContainerError' => '<div class="form-group input {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'autocomplete' => 'off',
                    'id' => 'ctrl_username',
                    'value' => isset($user['email']) ? $user['email'] : ''
                )); ?>
                <?= $this->Form->input('password', array(
                    'label' => __('Password'),
                    'class' => 'form-control',
                    'templates' => [
                        'inputContainer' => isset($user['id']) ?
                            '<div class="form-group input {{type}}{{required}}">{{content}}<p class="help-block">Để trống nếu không thay đổi</p></div>'
                            :'<div class="form-group input {{type}}{{required}}">{{content}}</div>',
                        'inputContainerError' => '<div class="form-group input {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'autocomplete' => 'off',
                    'id' => 'ctrl_password',
                    'type' => 'text'
                ));?>
                <?= $this->Form->input('role', array(
                    'options' => Configure::read('role'),
                    'class' => 'form-control',
                    'label' => __('Role'),
                    'templates' => [
                        'inputContainer' => '<div class="form-group input {{type}}{{required}}">{{content}}</div>',
                        'inputContainerError' => '<div class="form-group input {{type}}{{required}} error">{{content}}{{error}}</div>'
                    ],
                    'value' => isset($user['role']) ? $user['role'] : ''
                )) ?>
            </div>
            <div class="box-footer">
                <?= $this->Form->button('Submit',array(
                    'class' => 'btn btn-primary'
                )); ?>
                <?= $this->Html->link(
                    'Hủy',
                    ['controller' => 'User', 'action' => 'index', 'prefix' => 'admin'],
                    ['class' => 'btn btn-default']
                ) ?>
            </div>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>

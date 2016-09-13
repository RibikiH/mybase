<?php
    use Cake\Core\Configure;
    $this->assign('title', __('Add member'));
?>

<div class="row">
    <?= $this->Form->create('User', array(
            'type' => 'POST',
            'autocomplete' => 'off',
            'class' => 'autoValidate',
            'enctype' => "multipart/form-data"
        )
    ); ?>
    <div class="col-lg-6">
        <?= $this->Form->input('username', array(
            'label' => __('Username'),
            'class' => 'form-control',
            'templates' => [
                'inputContainer' => '<div class="form-group input {{type}}{{required}}">{{content}}</div>',
                'inputContainerError' => '<div class="form-group input {{type}}{{required}} error">{{content}}{{error}}</div>'
            ],
            'autocomplete' => 'off',
            'id' => 'ctrl_username'
        )); ?>
        <?= $this->Form->input('password', array(
            'label' => __('Password'),
            'class' => 'form-control',
            'templates' => [
                'inputContainer' => isset($user->id) ?
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
        )) ?>
        <?= $this->Form->button('Submit',array(
            'class' => 'btn btn-primary'
        )); ?>
        <?= $this->Html->link(
            'Hủy',
            ['controller' => 'Users', 'action' => 'index', 'prefix' => 'admin'],
            ['class' => 'btn btn-default']
        ) ?>
    </div>

    <?= $this->Form->end() ?>
</div>

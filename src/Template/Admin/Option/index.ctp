<?php
    $this->assign('title', __('Options Admin'));
?>

<div class="row">
    <?= $this->Form->create('Option', array(
            'type' => 'POST',
            'autocomplete' => 'off',
            'class' => 'autoValidate',
            'enctype' => "multipart/form-data"
        )
    ); ?>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= __('Information') ?></h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="full_nav" value="0" />
                            <input type="checkbox" name="full_nav" value="1"> <?= __('Show full navigation') ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <?= $this->Form->button('Submit',array(
                    'class' => 'btn btn-primary'
                )); ?>
            </div>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>
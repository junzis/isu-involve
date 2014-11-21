<?php $this->set("title_for_layout", "Reset Password") ?>

<div class="row">
<div class="col-md-6 col-md-offset-3">


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Reset my password</h3>
    </div>
    <div class="panel-body">
        <div class="alert alert-info">
            Rest Involve password for login: <strong><u><?php echo $email; ?></u></strong>
        </div>
        <?php echo $this->Form->create('User', array(
            'url'=> array('controller'=>'users', 'action'=>'reset_password', $token),
            'role' => 'form',
            'type' => 'post',
            'inputDefaults' => array(
                'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                'div' => array('class' => 'form-group'),
                'class' => 'form-control',
                'label' => array('class' => 'control-label'),
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
            ))); ?>
                <?php echo $this->Form->input('new_password', array(
                    'type'=>'password', 
                )); ?>
                <?php echo $this->Form->input('new_password_confirm', array(
                    'type'=>'password', 
                )); ?>

                <div>
                    <?php echo $this->Form->submit('Submit', array(
                        'div' => false,
                        'class' => 'btn btn-warning',
                    )); ?>
                </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

</div>
</div>
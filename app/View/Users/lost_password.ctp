<?php $this->set("title_for_layout", "Recover Password") ?>

<div class="row">
<div class="col-md-6 col-md-offset-3">


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Recover my password</h3>
    </div>
    <div class="panel-body">
        <div class="alert alert-info">
            Upon success validation of the email address, an instruction on how to reset your password will be sent to you mail box.
        </div>
        <?php echo $this->Form->create('User', array(
            'action'=>'lost_password',
            'role' => 'form',
            'type' => 'post',
            'inputDefaults' => array(
                'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                'div' => array('class' => 'form-group'),
                'class' => 'form-control',
                'label' => array('class' => 'control-label'),
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
            ))); ?>
                <?php echo $this->Form->input('email', array(
                    'type' => 'text',
                    'label' => 'Please Validate Your Email'
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
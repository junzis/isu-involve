<?php $this->set("title_for_layout", "Login") ?>

<div class="row">
<div class="col-md-6 col-md-offset-3">


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Sign In</h3>
    </div>
    <div class="panel-body">
    <fieldset>
        <?php echo $this->Form->create('User', array(
            'action'=>'login',
            'role' => 'form',
            'inputDefaults' => array(
                'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                'div' => array('class' => 'form-group'),
                'class' => 'form-control',
                'label' => array('class' => 'control-label'),
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
            ))); ?>
            <?php echo $this->Form->hidden('id'); ?>
                <?php echo $this->Form->input('email', array(
                    'type' => 'text',
                )); ?>
                <?php echo $this->Form->input('password', array(
                    'type'=>'password', 
                )); ?>

                <div>
                    <?php echo $this->Form->submit('Sign In', array(
                        'div' => false,
                        'class' => 'btn btn-primary',
                    )); ?>
                    <?php
                        echo $this->Html->link('Lost password?', array('controller'=>'users', 'action'=>'lost_password'), array('class'=>'pull-right'));
                    ?>
                </div>
        <?php echo $this->Form->end(); ?>
    </fieldset>
    </div>
</div>

</div>
</div>

<script type="text/javascript">
    document.getElementById('UserEmail').focus();
</script>
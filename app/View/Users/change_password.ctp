<?php $this->set("title_for_layout", "Change Pwd") ?>

<h3>Change My Password</h3>
<hr/>

<?php echo $this->Form->create('User', array(
    'action'=>'change_password',
    'role' => 'form',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'form-group'),
        'class' => 'form-control',
        'label' => array('class' => 'control-label'),
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    ))); ?>

    <?php echo $this->Form->hidden('id'); ?>

    <?php echo $this->Form->input('oldpassword', array(
        'type'=>'password',
        'label' => 'Old Password',
    )); ?>
    <hr>
    <?php echo $this->Form->input('newpassword1', array(
        'type'=>'password', 
        'label' => 'New Password',
    )); ?>
    <?php echo $this->Form->input('newpassword2', array(
        'type'=>'password', 
        'label' => 'Confirm Password',
    )); ?>

    <hr/>

    <div class="form-actions">
        <?php echo $this->Form->submit('Save', array(
            'div' => false,
            'class' => 'btn btn-default',
        )); ?>
        <?php
            echo $this->Html->link('Cancel', 
                array('controller'=>'users', 'action'=>'index'),
                array('class'=>'btn btn-warning')
            );
        ?>
    </div>
<?php echo $this->Form->end(); ?>


<script type="text/javascript">
    document.getElementById('UserOldpassword').focus();
</script>

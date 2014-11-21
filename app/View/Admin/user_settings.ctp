<h2>Update User Setting</h2>

<?php echo $this->Element('admin-user-nav-header', array('uid'=>$user['User']['id'])) ?>

<hr/>

<table class="table table-bordered">
    <tr>
        <td width="25%">Email (login)</td>
        <td><?php echo $user['User']['email']; ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?></td>
    </tr>
    <tr>
        <td>Current Group</td>
        <td><strong style="font-size:120%; color:#c60f13"><?php echo $groups[$user['User']['group_id']]; ?><strong></td>
    </tr>
</table>

<hr/>


<div class="row">
    <div class="col-md-6" style="border-right: 2px solid #ccc;">
        <h4>Reset User Password</h4>
        <?php echo $this->Form->create('User', array(
            'url'=>array('controller'=>'admin', 'action'=>'user_reset_passwd', $user['User']['id']),
            'role' => 'form',
            'inputDefaults' => array(
                'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                'div' => array('class' => 'form-group'),
                'class' => 'form-control',
                'label' => array('class' => 'control-label'),
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
            ))); ?>

            <?php echo $this->Form->input('newpassword1', array(
                'type'=>'password', 
                'label' => 'Set New Password',
            )); ?>
            <?php echo $this->Form->input('newpassword2', array(
                'type'=>'password', 
                'label' => 'Confirm Password',
            )); ?>

            <?php echo $this->Form->submit('Save', array(
                'div' => false,
                'class' => 'btn btn-sm btn-default',
            )); ?>
            <?php
                echo $this->Html->link('Cancel', 
                    array('controller'=>'admin', 'action'=>'users'),
                    array('class'=>'btn btn-sm btn-warning')
                );
            ?>
        <?php echo $this->Form->end(); ?>
    </div>


    <div class="col-md-6">

        <h4>Change user group</h4>
        <?php echo $this->Form->create('User', array(
            'url'=>array('controller'=>'admin', 'action'=>'user_change_group', $user['User']['id']),
            'role' => 'form',
            'inputDefaults' => array(
                'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                'div' => array('class' => 'form-group'),
                'class' => 'form-control',
                'label' => array('class' => 'control-label'),
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
            ))); ?>

            <?php echo $this->Form->input('group_id', array(
                'options' => $groups,
                'empty' => '---- Select ----',
                'label' => 'Move to Group',
            )); ?>

            <?php echo $this->Form->submit('Save', array(
                'div' => false,
                'class' => 'btn btn-sm btn-default',
            )); ?>

            <?php
                echo $this->Html->link('Cancel', 
                    array('controller'=>'admin', 'action'=>'users'),
                    array('class'=>'btn btn-sm  btn-warning')
                );
            ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<hr/>

<h4>Deadline Exception</h4>
<?php if($user['User']['deadline_exception']) : ?>
    <div class="alert alert-success">
        <span class="glyphicon glyphicon-ok"></span> This user is permitted to submit applicaiton at any time. <br/><br/>
        <?php echo $this->Html->link('Revoke Deadline Exception', 
            array('controller'=>'admin', 'action'=>'user_revoke_deadline_exception', $user['User']['id']), 
            array('class'=>'btn btn-sm btn-primary'), 'Are you sure to REVOKE the deadline exception.')?>
    </div>
<?php else : ?>
    <div class="alert alert-warning">
        <span class="glyphicon glyphicon-ban-circle"></span> This user is only allowed to submit applicaiton before deadlines. <br/><br/>
        <?php echo $this->Html->link('Permit Deadline Exception', 
            array('controller'=>'admin', 'action'=>'user_permit_deadline_exception', $user['User']['id']), 
            array('class'=>'btn btn-sm btn-primary'), 'Are you sure to PERMIT the deadline exception.')?>
    </div>
<?php endif; ?>

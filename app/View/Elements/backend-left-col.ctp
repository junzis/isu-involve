<?php 
    $user_id = $this->Session->read('Auth.User.id'); 
    $group_id = $this->Session->read('Auth.User.group_id'); 
?>

<div class="well">

<h4>Manage</h4>
<hr/>

<div class="btn-group-vertical" style="width:100%;">
<?php if ($group_id == 99) : ?>
    <?php echo $this->Html->link('Applications', 
        array('controller'=>'admin', 'action'=>'apps'), array('class'=>'btn btn-sm btn-primary')); ?>
    <?php echo $this->Html->link('Invitations', 
        array('controller'=>'admin', 'action'=>'invitations'), array('class'=>'btn btn-sm btn-primary')); ?>
    <?php echo $this->Html->link('Users', 
        array('controller'=>'admin', 'action'=>'users'), array('class'=>'btn btn-sm btn-primary')); ?>
    <?php echo $this->Html->link('Settings', 
        array('controller'=>'admin', 'action'=>'settings'), array('class'=>'btn btn-sm btn-primary')); ?>
<?php elseif ($group_id == 20) : ?>
    <?php echo $this->Html->link('Applications', 
        array('controller'=>'chair', 'action'=>'apps'), array('class'=>'btn btn-sm btn-primary')); ?>
<?php endif; ?>
</div>

<hr/>

</div>
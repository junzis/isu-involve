<div>
    <?php echo $this->Html->link('<span class="glyphicon glyphicon-user"></span> User Information', 
        array('controller'=>'admin', 'action'=>'user_view', $uid), array('class'=>'btn btn-sm btn-info', 'escape'=>false)) ?>
    <?php echo $this->Html->link('<span class="glyphicon glyphicon-book"></span> User Applications', 
        array('controller'=>'admin', 'action'=>'user_all_apps', $uid), array('class'=>'btn btn-sm btn-info', 'escape'=>false)) ?>
    <?php echo $this->Html->link('<span class="glyphicon glyphicon-cog"></span> User Settings', 
        array('controller'=>'admin', 'action'=>'user_settings', $uid), array('class'=>'btn btn-sm btn-info', 'escape'=>false)) ?>
    <?php echo $this->Html->link('<span class="glyphicon glyphicon-import"></span> Invite', 
            array('controller'=>'admin', 'action'=>'invite_user', $uid), 
            array('class'=>'btn btn-sm btn-primary pull-right', 'escape'=>false),
            'Are you sure to invite this user?'
    );?>
</div>

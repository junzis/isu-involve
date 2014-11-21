<?php $this->set("title_for_layout", "All Users") ?>

<h3>
    Manage Users
    <?php echo $this->Html->link('Show users with deadline exception', 
        array('action'=>'users_with_deadline_exception'), array('class' => 'btn btn-xs btn-primary pull-right')); ?>
</h3>

<div class="well">
<?php echo $this->Form->create('User', array('url'=>array('controller'=>'admin', 'action'=>'search_users'), 'class'=>'form-inline', 'role'=>'form')); ?>
    <div class="form-group col-md-5">
        <?php echo $this->Form->input('search', array('type' => 'text', 'placeholder' => 'Name or Email', 'label' => false, 'div'=>false, 'class'=>'form-control')); ?>
    </div>
    <?php echo $this->Form->submit('Search', array('class' => 'btn btn-default','div'=>false)); ?>
    <?php echo $this->Html->link('Show All', array('action'=>'users'), array('class' => 'btn btn-info')); ?>
<?php echo $this->Form->end(); ?>
</div>

<table class="table table-bordered" style="font-size:90%">
    <thead>
        <tr>
            <th></th>
            <th nowrap><?php echo $this->Paginator->sort('first_name', 'First Name'); ?></th>
            <th nowrap><?php echo $this->Paginator->sort('last_name', 'Last Name'); ?></th>
            <th nowrap><?php echo $this->Paginator->sort('email', 'Email'); ?></th>
            <th nowrap><?php echo $this->Paginator->sort('group_id', 'Group'); ?></th>
            <th></th>
        </tr>
    </thead>
    
    <?php foreach($users as $user): ?>
        <?php $id = $user['User']['id'] ?>
        
        <tr>
            <td>
                <?php
                    if($user['Group']['id'] == 99){
                      echo '{A}';
                    } else if($user['Group']['id'] == 20){
                      echo '{C}';
                    }
                ?>
            </td>
            <td><?php echo $user['User']['first_name']; ?> </td>
            <td><?php echo $user['User']['last_name']; ?> </td>
            <td><?php echo $user['User']['email']?></td>
            <td><?php echo $user['Group']['name'] ?></td>
            <td nowrap align="right">
                <?php echo $this->Html->link('Apps ['.$user['apps_count'].']', 
                        array('controller'=>'admin', 'action'=>'user_all_apps', $id), 
                        array('class'=>'btn btn-xs btn-default')
                );?>
                <?php echo $this->Html->link('View', 
                        array('controller'=>'admin', 'action'=>'user_view', $id), 
                        array('class'=>'btn btn-xs btn-default')
                );?>
                <?php echo $this->Html->link('Setting', 
                        array('controller'=>'admin', 'action'=>'user_settings', $id), 
                        array('class'=>'btn btn-xs btn-default')
                );?>
                <?php echo $this->Html->link('Invite', 
                        array('controller'=>'admin', 'action'=>'invite_user', $id), 
                        array('class'=>'btn btn-xs btn-default'),
                        'Are you sure to invite: '.$user['User']['first_name'].' '.$user['User']['last_name']
                );?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php echo $this->Element('pagination'); ?>
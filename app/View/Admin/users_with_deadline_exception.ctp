<?php $this->set("title_for_layout", "All Users") ?>

<h3>Users with deadline exception</h3>

<table class="table" style="font-size:90%">
    <thead>
        <tr>
            <th></th>
            <th nowrap>First Name</th>
            <th nowrap>Last Name</th>
            <th nowrap>Email</th>
            <th nowrap>Group</th>
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
                <?php echo $this->Html->link('Revoke Exception', 
                    array('controller'=>'admin', 'action'=>'user_revoke_deadline_exception', $user['User']['id']), 
                    array('class'=>'btn btn-xs btn-warning'), 'Are you sure to REVOKE the deadline exception.')?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
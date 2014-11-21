<?php $this->set("title_for_layout", "User Info") ?>


<h4>Personal Information</h4>

<table class="table table-bordered table-bordered table-condensed table-sm-font">
    <tr>
        <td width="25%">Email (login)</td>
        <td><?php echo $user['User']['email']; ?></td>
    </tr>
    <tr>
        <td>Title</td>
        <td><?php echo $user['User']['title']; ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?></td>
    </tr>
    <tr>
        <td>Affiliation</td>
        <td><?php echo $user['User']['affiliation']?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?php 
            echo $user['User']['address'].'<br/>'
                .$user['User']['postcode'].'<br/>'
                .$user['User']['city'].'<br/>'
                .$user['User']['country']
        ?></td>
    </tr>
    <tr>
        <td>Phone</td>
        <td><?php echo $user['User']['phone']?></td>
    </tr>

    <tr>
        <td width="25%">ISU Experience</td>
        <td><?php echo $user['User']['isu_experience']?></td>
    </tr>
    <tr>
        <td>Discipline areas</td>
        <td><?php echo nl2br($user['User']['discipline_areas']); ?></td>
    </tr>
    <tr>
        <td>Biography</td>
        <td><?php echo nl2br($user['User']['bio']); ?></td>
    </tr>
    <tr>
        <td>Need transportation support</td>
        <td><?php echo ($user['User']['is_transport_need']) ? 'Yes':'No' ; ?></td>
    </tr>
    <tr>
        <td>Need Lodging support</td>
        <td><?php echo ($user['User']['is_lodging_need']) ? 'Yes':'No' ; ?></td>
    </tr>
    <tr>
        <td>Financially supported by</td>
        <td><?php echo $user['User']['financial_support']; ?></td>
    </tr>
</table>

<div style="margin-bottom: 40px;"></div>

<h4>Curriculum Vitae</h4>
<div class="well">
    <div class="file">
        <?php if(strlen($user['User']['cv_file']) > 0): ?>
            <h4><span class="glyphicon glyphicon-file"></span> <?php echo $user['User']['cv_file']; ?> </h4>
            <br/>
            <?php echo $this->Html->link('<span class="glyphicon glyphicon-new-window"></span> View CV', array('controller'=>'users', 'action'=>'user_view_cv_backend', $user['User']['id']), array('class'=>'btn btn-sm btn-info', 'target'=>'_blank', 'escape'=>false)); ?> 
        <?php else: ?>
            No additional CV avaiable.
        <?php endif; ?>
    </div>
</div>

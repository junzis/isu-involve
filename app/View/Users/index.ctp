<?php $this->set("title_for_layout", "My Info") ?>

<h3><?php echo $this->Html->image('cv.png');?> My Curriculum Vitae</h3>
<div class="well text-center">
    <?php if(strlen($user['User']['cv_file']) > 0): ?>
        <?php echo $this->Html->image('file.png');?>
        <?php echo $user['User']['cv_file']; ?> <br/><br/>
        <?php echo $this->Html->link('View', array('controller'=>'users', 'action'=>'view_cv'), array('class'=>'btn btn-sm btn-info', 'target'=>'_blank')); ?> 
        <?php echo $this->Html->link('Delete', array('controller'=>'users', 'action'=>'delete_cv'), array('class'=>'btn btn-sm btn-danger'), 'Are you sure to delete your CV?'); ?> 
        <br/>
        <hr/>
        Want to update the CV?
        <?php 
            echo $this->Form->create('Upload', array('url'=>array('controller'=>'users', 'action'=>'update_cv'), 
                'type' => 'file', 'id'=>'UploadFileForm'));
            echo $this->Form->input('file', array('type' => 'file', 'label'=>false));
            echo $this->Form->submit('Update', array('class'=>'btn btn-sm btn-default'));
            echo $this->Form->end(); 
        ?>
    <?php else: ?>
        You haven't uploaded a CV yet. Please provide one if the biography field is too short to describe you :) <br/>
        <?php 
            echo $this->Form->create('Upload', array('url'=>array('controller'=>'users', 'action'=>'update_cv'), 
                'type' => 'file', 'id'=>'UploadFileForm'));
            echo $this->Form->input('file', array('type' => 'file', 'label'=>false));
            echo $this->Form->submit('Upload', array('class'=>'btn btn-sm btn-default'));
            echo $this->Form->end(); 
        ?>
    <?php endif; ?>

    <script type="text/javascript">
        $('#UploadFile').bind('change', function() {
            if(this.files[0].size/1024 > 300){
                alert('This file size is too large! It must be smaller than 300KB. \nPlease try another file.');
                $('#UploadFileForm')[0].reset();
            }
        });
    </script>

    <br/>
    <i>* only <strong class="imp">PDF</strong> document is accepted. and file size must be <strong class="imp">smaller than 300KB</strong>.</i>
</div>

<hr/>

<div class="pull-right">
    <?php echo $this->Html->link('Update My Info', array('controller'=>'users', 'action'=>'edit'), array('class'=>'btn btn-default')); ?> 
    <?php echo $this->Html->link('Change Password', array('controller'=>'users', 'action'=>'change_password'), array('class'=>'btn btn-default')); ?>
</div>

<h3><?php echo $this->Html->image('account.png');?> My Personal Information</h3>

<br/>

<table class="table table-bordered">
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
        <td>Website</td>
        <td><?php echo $user['User']['website']?></td>
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

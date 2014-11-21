<h4>User Info</h4>

<table class="table table-bordered table-bordered table-condensed ">
    <tr>
        <td width="25%">Email</td>
        <td><?php echo $invite['User']['email']; ?></td>
    </tr>
    <tr>
        <td>Title</td>
        <td><?php echo $invite['User']['title']; ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo $invite['User']['first_name'].' '.$invite['User']['last_name']; ?></td>
    </tr>
    <tr>
        <td>Affiliation</td>
        <td><?php echo $invite['User']['affiliation']?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?php echo $invite['User']['address'].' | '.$invite['User']['postcode'].' | '.$invite['User']['city'].' | '.$invite['User']['country']?></td>
    </tr>
</table>

<div class="row">
    <div class="col-md-6">
        <h4>Invitation Details</h4>
        <div class="well">
        <?php echo $this->Form->create('Invite', array(
            'url'=>array('controller'=>'admin', 'action'=>'manage_invite', $invite['Invite']['id']),
            'type'=>'post',
            'role' => 'form',
            'inputDefaults' => array(
                'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                'div' => array('class' => 'form-group'),
                'class' => 'form-control',
                'label' => array('class' => 'control-label'),
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
            ))); ?>

            <?php echo $this->Form->hidden('id'); ?>
            <?php echo $this->Form->input('date_start', array(
                'type' => 'text',
                'label' => 'Starting Date (Format: YYYY-MM-DD)',
            )); ?>

            <?php echo $this->Form->input('date_end', array(
                'type' => 'text',
                'label' => 'End Date (Format: YYYY-MM-DD)',
            )); ?>

            <?php echo $this->Form->input('activities', array(
                'rows' => 3,
            )); ?>

            <?php echo $this->Form->input('is_isu_cover_travel', array(
                'label' => 'Is ISU covering the tarvel?',
                'type' => 'select',
                'options' => array('0'=>'No', '1'=>'Yes'),
            )); ?>

            <?php echo $this->Form->input('is_isu_cover_lodging', array(
                'label' => 'Is ISU covering the lodging?',
                'type' => 'select',
                'options' => array('0'=>'No', '1'=>'Yes'),
            )); ?>

            <?php echo $this->Form->submit('Save', array(
                'div' => false,
                'class' => 'btn btn-sm btn-primary',
            )); ?>
        <?php echo $this->Form->end(); ?>
        </div>
    </div>

    <div class="col-md-6">
        <h4>Invitation Status</h4>
        <?php if($invite['Invite']['is_invitation_sent']) : ?>
            <div class="alert alert-success">
                <span class="glyphicon glyphicon-ok-sign"></span> The invitation email has been sent out. <br/><br/>
                <?php echo $this->Html->link('Resend Invitation Email', 
                    array('controller'=>'admin', 'action'=>'preview_invitation', $invite['Invite']['id']), 
                    array('class'=>'btn btn-sm btn-warning'))?>
            </div>
        <?php else : ?>
            <div class="alert alert-warning">
                <span class="glyphicon glyphicon-question-sign"></span> The invitation email has <u>NOT</u> been sent yet. <br/><br/>
                <?php echo $this->Html->link('Send Invitation Email', 
                    array('controller'=>'admin', 'action'=>'preview_invitation', $invite['Invite']['id']), 
                    array('class'=>'btn btn-sm btn-warning'))?>
            </div>
        <?php endif; ?>

        <h4>Confirmation Status</h4>
        <?php if($invite['Invite']['is_invitation_confirmed']) : ?>
            <div class="alert alert-success">
                <span class="glyphicon glyphicon-ok-sign"></span> <?php echo $invite['User']['name']?> has confirmed the invitation. <br/><br/>
                <table class="table table-bordered ">
                    <tr>
                        <td>Departure City and County</td>
                        <td><?php echo $invite['Invite']['departure_city_country']; ?></td>
                    </tr>
                    <tr>
                        <td>Departure Airport</td>
                        <td><?php echo $invite['Invite']['departure_airport']; ?></td>
                    </tr>
                    <tr>
                        <td>Sponsor</td>
                        <td><?php echo $invite['Invite']['sponsor']; ?></td>
                    </tr>
                    <tr>
                        <td>Date of confirmation</td>
                        <td><?php echo $invite['Invite']['date_of_confirm']; ?></td>
                    </tr>
                </table>
            </div>
        <?php else : ?>
            <div class="alert alert-warning">
                <span class="glyphicon glyphicon-question-sign"></span> This invitation has <u>NOT</u> been confirmed. <br/><br/>
            </div>
        <?php endif; ?>
    </div>
</div>
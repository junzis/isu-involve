<h2>
    Invitation to <?php echo $invite['User']['title'].'. '.$invite['User']['name'] ?>
</h2>

<?php if($invite['Invite']['is_invitation_confirmed']): ?>
    <span class="label label-success pull-right"> <span class="glyphicon glyphicon-ok"></span> Confirmed on <?php echo $invite['Invite']['date_of_confirm']?> </span>
<?php endif; ?>

<a id="ToggleLetter" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-collapse-down"></span> Show / Hide Invitation Letter</a>
<script>
    $("#ToggleLetter").click(function(){
        $("#LetterDetail").slideToggle();
    });
</script>

<pre id="LetterDetail" class="well" style="font-size:80%; ">
<?php echo $this->Element('invitation', $invite); ?>
</pre>

<div class="row">
    <div class="col-md-6">
        <h3>Your Info</h3>
        <table class="table table-bordered ">
            <tr>
                <td width="30%">Email</td>
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
    </div>
    <div class="col-md-6">
        <h3>Your Inviation Details</h3>
        <table class="table table-bordered ">
            <tr>
                <td>Starting Date</td>
                <td><?php echo $invite['Invite']['date_start']; ?></td>
            </tr>
            <tr>
                <td>End Date</td>
                <td><?php echo $invite['Invite']['date_end']; ?></td>
            </tr>
            <tr>
                <td>Activities</td>
                <td><?php echo $invite['Invite']['activities']; ?></td>
            </tr>
            <tr>
                <td>Is ISU covering the tarvel?</td>
                <td><?php echo $invite['Invite']['is_isu_cover_travel'] ? 'Yes' : 'No'; ?></td>
            </tr>
            <tr>
                <td>Is ISU covering the lodging?</td>
                <td><?php echo $invite['Invite']['is_isu_cover_lodging'] ? 'Yes' : 'No'; ?></td>
            </tr>
        </table>
    </div>
</div>

<?php if(!$invite['Invite']['is_invitation_confirmed']): ?>
    <div class="well">
        <h3>Confirmation</h3>
        <?php echo $this->Form->create('Invite', array(
            'url'=>array('controller'=>'users', 'action'=>'invitation_confirm', $invite['Invite']['confirmation_token']),
            'type'=>'post',
            'role' => 'form',
            'inputDefaults' => array(
                'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                'div' => array('class' => 'form-group'),
                'class' => 'form-control',
                'label' => array('class' => 'control-label'),
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
            ))); ?>

            <?php echo $this->Form->input('departure_city_country', array(
                'label' => 'Departure City & County ',
            )); ?>
            <?php echo $this->Form->input('departure_airport', array(
                'label' => 'Departure Airport',
            )); ?>
            <?php echo $this->Form->input('sponsor', array(
                'label' => 'Sponsor (If any)',
            )); ?>

            <hr/>

            <div class="alert alert-info">
                <strong>
                    - Before confirm, please fill above information for your SSP logistc arrangements later on.<br/>
                    - By clicking the following button, you are accepting this inviation of participate SSP. 
                </strong>
            </div>

            <?php echo $this->Form->submit('Yes, I confirm my acceptance of this invitation.', array('div' => false, 'class' => 'btn btn-success')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
<?php else : ?>
<div class="row">
    <div class="col-md-6">
        <h3>Confirmation</h3>
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
</div>
<?php endif; ?>

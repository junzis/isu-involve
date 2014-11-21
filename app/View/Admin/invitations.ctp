<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#invited" data-toggle="tab">Invited (<?php echo sizeof($invites) ?>)</a></li>
    <li><a href="#non-invited" data-toggle="tab">Not Invited (<?php echo sizeof($non_invites) ?>)</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="invited">
        <h3>
            Invited Lecturers (<?php echo sizeof($invites) ?>)
        </h3>
            <a id="ToggleInviteeEmails" class="btn btn-info btn-sm pull-right">Invited VL Emails</a> 
            <?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Invite More', 
                    array('controller'=>'admin', 'action'=>'users'), 
                    array('class'=>'btn btn-sm btn-primary', 'escape'=>false)
            );?> 

        <br /><br />
        <div id="InviteeEmails" style="display:none">
            <div class="well" style="font-size:80%">
                <div class="alert alert-info"> For sending emails to all: <br/><strong>First check the table carefully, then copy and paste the following address to BCC.</strong> </div>
                <?php foreach ($invites as $i) { echo $i['User']['email'].', '; } ?>
            </div>
        </div>

        <table class="table table-bordered table-condensed table-sm-font">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Start Date</th>
                    <th>End Data</th>
                    <th>Letter Sent</th>
                    <th>Confirmed</th>
                    <th></th>
                </tr>
            </thead>
            <?php foreach ($invites as $u) : ?>
                <tr>
                    <td><b><?php echo $this->Html->link($u['User']['name'], array('controller'=>'admin', 'action'=>'user_view', $u['User']['id']), array('target'=>'_blank')); ?></b></td>
                    <td><?php echo $u['User']['email']; ?></td>
                    <td nowrap><?php echo $u['Invite']['date_start']; ?></td>
                    <td nowrap><?php echo $u['Invite']['date_end']; ?></td>
                    <td><?php echo $u['Invite']['is_invitation_sent'] ? '<span class="label label-success">Yes</span>' : 'No'; ?></td>
                    <td><?php echo $u['Invite']['is_invitation_confirmed'] ? '<span class="label label-success">Yes</span>' : 'No'; ?></td>
                    <td align="right" nowrap>
                        <?php echo $this->html->link('Manage', array('controller'=>'admin', 'action'=>'manage_invite', $u['Invite']['id']), 
                        array('class'=>'btn btn-primary btn-xs')) ?>
                        <?php echo $this->html->link('Remove', array('controller'=>'admin', 'action'=>'remove_invite', $u['Invite']['id']), 
                        array('class'=>'btn btn-danger btn-xs'), 'Are you sure to REMOVE: '.$u['User']['name'].'?') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
    <div class="tab-pane" id="non-invited">
        <h3/>
            Not Invited (<?php echo sizeof($non_invites) ?>)
            <a id="ToggleDearJohns" class="btn btn-info btn-sm pull-right">Dear John Emails</a>
        </h3>

        <div id="DearJohns" style="display:none">
            <div class="well" style="font-size:80%">
                <div class="alert alert-info"> For sending emails to all: <br/><strong>First check the table carefully, then copy and paste the following address to BCC.</strong> </div>
                <?php foreach ($non_invites as $john) { echo $john['User']['email'].', '; } ?>
            </div>
        </div>

        <table class="table table-bordered table-condensed table-sm-font">
            <thead>
                <tr>
                    <th width="30%">Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <?php foreach ($non_invites as $u) : ?>
                <tr>
                    <td><b><?php echo $this->Html->link($u['User']['name'], array('contorller'=>'admin', 'action'=>'user_view', $u['User']['id']), array('target'=>'_blank')); ?></b></td>
                    <td><?php echo $u['User']['email']; ?></td>
                    <td align="right">
                        <?php echo $this->html->link('Invite', array('controller'=>'admin', 'action'=>'invite_user', $u['User']['id']), 
                        array('class'=>'btn btn-default btn-xs'), 'Are you sure to invite: '.$u['User']['name'].'?') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>


<script>
    $("#ToggleInviteeEmails").click(function(){
        $("#InviteeEmails").slideToggle();
    });
    $("#ToggleDearJohns").click(function(){
        $("#DearJohns").slideToggle();
    });
</script>

<h3> Invitation Email Preview </h3>

<div class="well">
	<strong style='color:red'>Attention</strong>: the following email will be sent to: <strong><u> <?php echo $invite['User']['email']; ?></u></strong>. 
	Confirmation status will be reset if you are re-sending an invitation. <br /> <br/>
	The template of this email can be modified at: <strong>[ app/View/Elements/inivation.ctp ]</strong>. Ask the web admin to do make changes.
</div>


<pre class="well">
<?php echo $this->Element('invitation', $invite); ?>
</pre>

<?php echo $this->Html->link('<span class="glyphicon glyphicon-send"></span> Send Invitation Email', 
	array('controller'=>'admin', 'action'=>'send_invitation_email', $invite['Invite']['id']), array('class'=>'btn btn-primary', 'escape'=>false),
	'Are you sure to send the invitation email?') ?>
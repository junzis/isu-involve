Dear <?php echo $invite['User']['title'].'. '.$invite['User']['name'] ?>,

On behalf of the International Space University, you are herewith invited to participate in Space Studies Program <?php echo Configure::read('SiteConfig.current_year') ?> 

Your invitation detail is listed below:

----------------------------------------
Date of arrival: <?php echo date('d-F-Y', strtotime($invite['Invite']['date_start'])); ?> 
Date of departure: <?php echo date('d-F-Y', strtotime($invite['Invite']['date_end'])); ?> 

Activities: 
<?php echo $invite['Invite']['activities'] ? $invite['Invite']['activities'] : 'Various activities, details to be notified.' ?> 
(Please notice that the details of your activities will be discussed with SSP chairs or academic unit.)

Logistics:
<?php if($invite['Invite']['is_isu_cover_travel']) : ?>
- ISU will provide one (1) economy class round-trip ticket between your city of origin and SSP location to be arranged by SSP Logistics in accordance with the ISU travel policy. 
<?php endif; ?>
<?php if($invite['Invite']['is_isu_cover_lodging']) : ?>
- ISU will provide accommodations at the official SSP faculty or staff residence for the dates of service specified.
<?php endif; ?>
<?php if(!$invite['Invite']['is_isu_cover_travel'] && !$invite['Invite']['is_isu_cover_lodging']) : ?>
- ISU is grateful to you or your orgnization for covering the costs associated with your travel and lodging. This generosity is sincerely appreciated.
<?php elseif($invite['Invite']['is_isu_cover_travel'] && !$invite['Invite']['is_isu_cover_lodging']) : ?>
- ISU is grateful to you or your orgnization for covering the costs associated with your lodging. This generosity is sincerely appreciated.
<?php elseif(!$invite['Invite']['is_isu_cover_travel'] && $invite['Invite']['is_isu_cover_lodging']) : ?>
- ISU is grateful to you or your orgnization for covering the costs associated with your travel. This generosity is sincerely appreciated.
<?php endif; ?>
- ISU will provide meals per the ISU meal plan for the dates of service specified.
----------------------------------------

You may log on to ISU Involve platform (https://sspac.isunet.edu/involve) to confrim you invitaiton. Or quickly confirm the invitation at the following address:

<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'invitation_confirm', $invite['Invite']['confirmation_token']), true); ?> 

Our logistic team will follow the travel and lodging details once this invitation is confirmed. If you have any questions, please don't hesitate to contact us at: isu.academics@isunet.edu

Best Regards,

Space Studies Program <?php echo Configure::read('SiteConfig.current_year') ?> 
International Space University
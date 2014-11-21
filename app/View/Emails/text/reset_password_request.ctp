Hello <?php echo $user['User']['name'] ?>,

A password reset request has been received for your login at the ISU Involve Platform. To reset your password, please follow this link: 

<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'reset_password', $user['User']['reset_password_token']), true); ?> 

If you did not initiate the reset password request, please just ignore and delete this email.

Thanks!

ISU Involve Platform
https://sspac.isunet.edu/involve
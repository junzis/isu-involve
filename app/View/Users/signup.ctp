<?php $this->set("title_for_layout", "Sign Up") ?>

<div class="row">
<div class="well col-md-6 col-md-offset-3">

    <h3>Create my account</h3>

    <hr/>

    <?php echo $this->Form->create('User', array(
        'action'=>'signup',
        'role' => 'form',
        'inputDefaults' => array(
            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
            'div' => array('class' => 'form-group'),
            'class' => 'form-control',
            'label' => array('class' => 'control-label'),
            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
        ))); ?>

        <?php echo $this->Form->hidden('id'); ?>
        <?php echo $this->Form->input('email', array(
            'type' => 'text',
            'label' => 'Email Address (will be for user login)'
        )); ?>
        
        <?php echo $this->Form->input('password', array(
            'type'=>'password', 
        )); ?>
        <?php echo $this->Form->input('password_confirm', array(
            'type'=>'password', 
        )); ?>

        <hr/>

        <?php echo $this->Form->input('title', array(
            'options' => array('Ms'=>'Ms.', 'Mr'=>'Mr.', 'Dr'=>'Dr.', 'Prof'=>'Prof.'),
            'empty'=>'--- please select ---'
        )); ?>

        <?php echo $this->Form->input('first_name', array(
            'type' => 'text',
        )); ?>

        <?php echo $this->Form->input('last_name', array(
            'type' => 'text',
        )); ?>

        <?php echo $this->Form->input('affiliation', array(
            'type' => 'text',
            'label' => 'Your affiliation',
            'placeholder' => 'Leave empty if not relate to any'
        )); ?>

        <?php echo $this->Form->input('isu_experience', array(
            'label' => 'ISU experience (< 100 words)',
            'placeholder' => 'Please briefly describe your ISU experience, and/or your background here.',
        )); ?>

        <div class="form-actions">
            <?php echo $this->Form->submit('Create Account', array(
                'div' => false,
                'class' => 'btn btn-default',
            )); ?>
        </div>
    <?php echo $this->Form->end(); ?>

</div>
</div>

<script type="text/javascript">
    document.getElementById('UserEmail').focus();
</script>

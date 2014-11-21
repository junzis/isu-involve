<?php $this->set("title_for_layout", "Home") ?>

<div class="row">

<div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Sign In</h3>
        </div>
        <div class="panel-body">
        <fieldset>
            <?php echo $this->Form->create('User', array(
                'action'=>'login',
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
                    )); ?>
                    <?php echo $this->Form->input('password', array(
                        'type'=>'password', 
                    )); ?>


                    <div>
                        <?php echo $this->Form->submit('Sign In', array(
                            'div' => false,
                            'class' => 'btn btn-primary',
                        )); ?>
                        <?php
                            echo $this->Html->link('Lost password?', array('controller'=>'users', 'action'=>'lost_password'), array('class'=>'pull-right'));
                        ?>
                    </div>
            <?php echo $this->Form->end(); ?>
        </fieldset>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Sign up</h3>
        </div>
        <div class="panel-body">
            This platform is open to everyone for submitting applications to SSP program. <strong>Registeration is required</strong> prior to login. <br/><br/>
            <?php
                echo $this->Html->link('Create my account', array('controller'=>'users', 'action'=>'signup'), array('class'=>'btn btn-default '));
            ?>
        </div>
    </div>

    <div class="well">
        This tool is designed for ISU Space Studies Program applications of Chairs, 
        TA, Staff, and Visiting Lectuers. If you have any troubles with the platform, 
        please contact our staff. Email: <u>sspacademics[at]isunet.edu</u>

        <hr/>

        <strong>
            Please read first:<u><a href="<?php echo Configure::read('SiteConfig.ssp_calls_url'); ?>" target="_blank">
            Calls for next SSP Chairs, Faculty, Staff, and TAs</a></u>
        </strong>
    </div>

</div>

</div>

<script type="text/javascript">
    document.getElementById('UserEmail').focus();
</script>
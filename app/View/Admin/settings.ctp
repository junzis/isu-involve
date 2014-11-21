<?php $this->set("title_for_layout", "Stie Settings") ?>
<?php
    // generate a list of years for current_year setting
    $years = array_combine(range(date("Y")+5, date("Y")-5), range(date("Y")+5, date("Y")-5));
?>

<div class="well">
    <div>
    <h3>Global Settings</h3>
    <hr/>
    <?php echo $this->Form->create('SiteConfig', array(
        'url'=> array('controller'=>'admin', 'action'=>'update_settings'),
        'type' => 'post',
        'role' => 'form',
        'inputDefaults' => array(
            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
            'div' => array('class' => 'form-group'),
            'class' => 'form-control',
            'label' => array('class' => 'control-label'),
            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
        ))); ?>
        <?php echo $this->Form->input('is_chair_app_on', array(
            'type'=>'checkbox', 
            'label' => 'Accept Chair Applicatons',
            'class' =>'',
        )); ?>
        <?php echo $this->Form->input('is_staff_app_on', array(
            'type'=>'checkbox', 
            'label' => 'Accept Staff, TA, and Activity Applications',
            'class' =>'',
        )); ?>
        <?php echo $this->Form->input('current_year', array(
            'label' => 'Current SSP Year',
            'options' => array($years),
        )); ?>
        <?php echo $this->Form->input('ssp_calls_url', array(
            'label' => 'Url for SSP calls (link on the homapage) ',
            'type' => 'textarea',
            'rows' => 2,
        )); ?>

        <?php echo $this->Form->submit('Save', array('div' => false,'class' => 'btn btn-sm btn-primary')); ?>
    <?php echo $this->Form->end(); ?>
    </div>
</div>

<div class="well">
    <h3>Database Management</h3>
    <hr/>
    <?php echo $this->Html->link('View / Download Backups', array('controller'=>'admin', 'action'=>'backup_db'), array('class'=>'btn btn-sm btn-primary')); ?>
    <?php echo $this->Html->link('Create a Backup', array('controller'=>'admin', 'action'=>'create_db_backup'), array('class'=>'btn btn-sm btn-primary')); ?>
</div>



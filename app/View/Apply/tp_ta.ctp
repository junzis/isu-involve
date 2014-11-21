<h3>Team Project TA Application</h3>

<div class="well">

<?php echo $this->Form->create('TpTaApp', array(
    'url'=> array('controller'=>'apply', 'action'=>'tp_ta', $act),
    'type' => 'post',
    'role' => 'form',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'form-group'),
        'class' => 'form-control',
        'label' => array('class' => 'control-label'),
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    ))); ?>

    <?php echo $this->Form->hidden('id'); ?>

    <fieldset>
        <?php echo $this->Form->input('tp_id', array(
            'label' => 'Team Project',
            'empty' => '------ Please select one ------',
        )); ?>
        
        <?php echo $this->Form->input('description', array(
            'label' => 'Describe your <strong class="imp">motivation</strong> to be a TA of this Team Project',
            'rows' => 20,
        )); ?>

        <div class="form-group">
            <?php echo $this->Form->submit('Save', array(
                'div' => false,
                'class' => 'btn btn-primary',
            )); ?>
            <?php
                echo $this->Html->link('Cancel', 
                    array('controller'=>'apply', 'action'=>'back'),
                    array('class'=>'btn btn-warning')
                );
            ?>
        </div>

    </fieldset>
<?php echo $this->Form->end(); ?>

</div>
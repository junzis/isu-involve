<h3>Propose a core lecture</h3>

<div class="well">

<?php echo $this->Form->create('CoreLectureApp', array(
    'url'=> array('controller'=>'apply', 'action'=>'core_lecture', $act),
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
        <?php echo $this->Form->input('title', array(
            'label' => 'Lecture Title',
        )); ?>
        
        <?php echo $this->Form->input('description', array(
            'label' => 'Briefly describe your lecture content',
            'rows' => 10,
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

<h3>Department Chair Application</h3>

<div class="well">

<?php echo $this->Form->create('DepartmentChairApp', array(
    'url'=> array('controller'=>'apply', 'action'=>'department_chair', $act),
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
        <?php echo $this->Form->input('department_id', array(
            'empty' => '------ Please select one ------',
        )); ?>
        
        <?php echo $this->Form->input('description', array(
            'label' => 'Your goals for the department, and include a brief description of the hands-on department activities that you might include.',
            'rows' => 20,
        )); ?>
        
        <?php 
            echo $this->Form->input('is_attend_cpm', 
                array(
                    'label'=>array('text'=>'I commit to attending the Curriculum Planning Meeting (See call for dates)', 'class' => ' '),
                    'class'=>' ',
                )
            ); 
        ?>

        <?php 
            echo $this->Form->input('is_time_commit', 
                array(
                    'label'=>array('text'=>'I commit to be on site for the three-week period indicated in the call for chairs', 'class' => ' '),
                    'class'=>' ',
                )
            ); 
        ?>


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
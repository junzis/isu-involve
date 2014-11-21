<h2>Propose a Team Project for ISU Program(s)</h2>

<div class="well">

<?php echo $this->Form->create('ProjectApp', array(
    'url'=> array('controller'=>'apply', 'action'=>'project', $act),
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
        <?php echo $this->Form->input('title', array('label' => 'Project Title')); ?>
        
        <?php echo $this->Form->input('program', array('label' => 'Proposed ISU program', 'empty'=>'-- Select --', 'options'=>array('ANY'=>'ANY Program', 'MSS'=>'MSS', 'SSP'=>'SSP', 'SHS-SP'=>'SHS-SP'))); ?>
        
        <?php echo $this->Form->input('description', array('label' => 'One-paragraph description', 'rows' => 5)); ?>
        
        <?php echo $this->Form->input('background', array('label' => 'Background rationale', 'rows' => 5)); ?>

        <?php echo $this->Form->input('issues', array('label' => 'Main issue(s) to be addressed', 'rows' => 5)); ?>
        
        <?php echo $this->Form->input('tasks', array('label' => 'Main tasks to be accomplished', 'rows' => 5)); ?>
        
        <?php echo $this->Form->input('scope_2i', array('label' => 'International / Interculture scope of the project', 'rows' => 5)); ?>
        
        <hr/>

        <h4>Interdisciplinary Scope - Expected level of involvement of by disciplines</h4>
        <?php echo $this->Form->input('level_app', array('label' => 'Space Applications', 'options'=>array('2'=>'Major', '1'=>'Minor'), 'empty'=>'-- Select --')); ?>
        <?php echo $this->Form->input('level_eng', array('label' => 'Space Engineering ', 'options'=>array('2'=>'Major', '1'=>'Minor'), 'empty'=>'-- Select --')); ?>
        <?php echo $this->Form->input('level_hps', array('label' => 'Human Performance in Space', 'options'=>array('2'=>'Major', '1'=>'Minor'), 'empty'=>'-- Select --')); ?>
        <?php echo $this->Form->input('level_hum', array('label' => 'Space Humanities', 'options'=>array('2'=>'Major', '1'=>'Minor'), 'empty'=>'-- Select --')); ?>
        <?php echo $this->Form->input('level_mgb', array('label' => 'Space Management and Business', 'options'=>array('2'=>'Major', '1'=>'Minor'), 'empty'=>'-- Select --')); ?>
        <?php echo $this->Form->input('level_pel', array('label' => 'Space Policy, Economics and Law', 'options'=>array('2'=>'Major', '1'=>'Minor'), 'empty'=>'-- Select --')); ?>
        <?php echo $this->Form->input('level_sci', array('label' => 'Space Sciences', 'options'=>array('2'=>'Major', '1'=>'Minor'), 'empty'=>'-- Select --')); ?>

        <hr/>

        <h4>Brief explanation of expected involvement of by disciplines</h4>

        <?php echo $this->Form->input('area_app', array('label' => 'Space Applications', 'rows' => 3)); ?>
        <?php echo $this->Form->input('area_eng', array('label' => 'Space Engineering ', 'rows' => 3)); ?>
        <?php echo $this->Form->input('area_hps', array('label' => 'Human Performance in Space', 'rows' => 3)); ?>
        <?php echo $this->Form->input('area_hum', array('label' => 'Space Humanities', 'rows' => 3)); ?>
        <?php echo $this->Form->input('area_mgb', array('label' => 'Space Management and Business', 'rows' => 3)); ?>
        <?php echo $this->Form->input('area_pel', array('label' => 'Space Policy, Economics and Law', 'rows' => 3)); ?>
        <?php echo $this->Form->input('area_sci', array('label' => 'Space Sciences', 'rows' => 3)); ?>
        
        <?php echo $this->Form->input('opportunity_window', array('label' => 'Window of opportunity in terms of potential relevance of and interest in the project topic', 'rows' => 3)); ?>
        
        <?php echo $this->Form->input('potential_sponsorship', array('label' => 'Potential external interest in or sponsorship of the TP topic', 'rows' => 2)); ?>
        
        <?php echo $this->Form->input('prospective_impact', array('label' => 'Prospective impact of the TP', 'rows' => 3)); ?>
        
        <?php echo $this->Form->input('comments', array('label' => 'Additional comments', 'rows' => 5)); ?>
        
        <hr/>

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

<script type="text/javascript">
    function check_department_div(){
        if($("#ActivityAppIsDa").is(':checked')){
            $("#departments").slideDown();
        } else {
            $("#departments").slideUp();
        }
    }

    check_department_div();

    $("#ActivityAppIsDa").click(function(){
        check_department_div();
    });
</script>
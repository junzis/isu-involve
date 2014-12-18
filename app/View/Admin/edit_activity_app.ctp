<h3>Edit Activity Application</h3>

<?php echo $this->Form->create('ActivityApp', array(
    'url'=> array('controller'=>'admin', 'action'=>'edit_activity_app'),
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

    From: <strong><?php echo $this->data['User']['name']; ?> </strong> <hr/>

    <?php echo $this->Form->input('title', array(
        'label' => 'Title of the activity',
    )); ?>
    
    <?php echo $this->Form->input('description', array(
        'label' => 'Please describe your activity',
        'rows' => 15,
    )); ?>
    
    <?php 
        echo $this->Form->input('is_ws', 
            array(
                'label'=>array('text'=>'This activity can be a workshop'),
                'class'=>' ',
            )
        ); 
    ?>

    <?php 
        echo $this->Form->input('is_da', 
            array(
                'label'=>array('text'=>'This activity can be a department activity'),
                'class'=>' ',
            )
        ); 
    ?>

    <div id="departments" class="expandbox">
        <h5>Which departments can these be applied:</h5><br/>
        <?php 
            foreach ($departments as $id => $dept) {
                echo $this->Form->input('Dept.'.$id, array('label'=>$dept, 'type'=>'checkbox', 'class'=>' ')); 
            }
        ?>
    </div>

    <hr/>

    <div>
        <?php echo $this->Form->submit('Save', array(
            'div' => false,
            'class' => 'btn btn-primary',
        )); ?>
        <?php
            echo $this->Html->link('Cancel', 
                array('controller'=>'proposals', 'action'=>'activity_apps'),
                array('class'=>'btn btn-warning')
            );
        ?>
    </div>

<?php echo $this->Form->end(); ?>


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
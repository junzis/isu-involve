<h3>Propose a workshop or department activity</h3>

<div class="well">

<?php echo $this->Form->create('ActivityApp', array(
    'url'=> array('controller'=>'apply', 'action'=>'activity', $act),
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
            'label' => 'Title of the activity',
        )); ?>
        
        <?php echo $this->Form->input('description', array(
            'label' => 'Please describe your activity',
            'rows' => 15,
        )); ?>
        
        <?php 
            echo $this->Form->input('year', 
                array(
                    'label'=>'SSP year',
                    'value'=>Configure::read('SiteConfig.current_year'),
                    'readonly'=>true,
                )
            ); 
        ?>

        <?php 
            echo $this->Form->input('is_ws', 
                array(
                    'label'=>array('text'=>'This activity can be a workshop', 'class' => ' '),
                    'class'=>' ',
                )
            ); 
        ?>

        <?php 
            echo $this->Form->input('is_da', 
                array(
                    'label'=>array('text'=>'This activity can be a department activity', 'class' => ' '),
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
<h3>Suggest a theme days topic</h3>

<div class="well">

<?php echo $this->Form->create('ThemeDayApp', array(
    'url'=> array('controller'=>'apply', 'action'=>'theme_day', $act),
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
            'label' => 'Title of the theme day',
        )); ?>
        
        <?php echo $this->Form->input('description', array(
            'label' => 'Please describe the topic, and also suggest whom we could invite to give the talks.',
            'rows' => 15,
        )); ?>
        
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
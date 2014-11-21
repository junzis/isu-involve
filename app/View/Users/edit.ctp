<?php $this->set("title_for_layout", "Update My Info") ?>
    <?php echo $this->Form->create('User', array(
        'action'=>'edit',
        'role' => 'form',
        'inputDefaults' => array(
            'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
            'div' => array('class' => 'form-group'),
            'class' => 'form-control',
            'label' => array('class' => 'control-label'),
            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
        ))); ?>
        
        <?php //echo $this->Form->hidden('id'); ?>
        
        <div class="row well">
            <div class="col-md-5" style="border-right:1px dashed #ccc;">
                <fieldset>
                    <legend>My Contact Information</legend>

                    <?php echo $this->Form->input('email', array('label' => 'Email Address ( this is also your login name )')); ?>

                    <?php echo $this->Form->input('first_name'); ?>

                    <?php echo $this->Form->input('last_name'); ?>

                    <?php echo $this->Form->input('title', array(
                        'options' => array('Ms'=>'Ms.', 'Mr'=>'Mr.', 'Dr'=>'Dr.', 'Prof'=>'Prof.'),
                        'empty'=>'--- please select ---'
                    )); ?>

                    <?php echo $this->Form->input('affiliation', array(
                        'type' => 'text',
                        'label' => 'Your affiliation',
                        'placeholder' => 'Leave empty if not relate to any'
                    )); ?>

                    <?php echo $this->Form->input('address', array(
                        'label' => 'Postal Address'
                    )); ?>

                    <?php echo $this->Form->input('postcode', array(
                        'label' => 'Post code'
                    )); ?>

                    <?php echo $this->Form->input('city', array(
                        'label' => 'City, State'
                    )); ?>

                    <?php echo $this->Form->input('country', array(
                    )); ?>

                    <?php echo $this->Form->input('phone', array(
                    )); ?>

                    <?php echo $this->Form->input('website', array(
                    )); ?>
                </fieldset>
            </div>

            <div class="col-md-7">
                <fieldset class="important">
                    <legend>[ Important ] Background / Additional Information</legend>
                    <?php echo $this->Form->input('isu_experience', array(
                        'label' => 'ISU experience (< 50 words)',
                        'placeholder' => 'Please briefly describe your ISU experience, and/or your background here.',
                        'rows' => 4,
                    )); ?>

                    <?php echo $this->Form->input('discipline_areas', array(
                        'label' => 'Your discipline areas',
                        'rows' => 3,
                    )); ?>

                    <?php echo $this->Form->input('bio', array(
                        'label' => 'Biography (< 300 words)',
                        'placeholder' => 'Please tell us a little more about yourself.',
                        'rows' => 15,
                    )); ?>

                    <hr/>

                    <?php echo $this->Form->input('is_transport_need', array('label'=>'I require <strong class="imp">transportation</strong> support from ISU to attend SSP', 'class'=>' ')); ?>

                    <?php echo $this->Form->input('is_lodging_need', array('label'=>'I require <strong class="imp">lodging</strong> support from ISU to attend SSP', 'class'=>' ')); ?>

                    <?php echo $this->Form->input('financial_support', array(
                        'label' => 'If any above ISU support is NOT required, please indicate who will provide financial support',
                        'placeholder' => 'eg. : Self / Institute, Company, Agency / Other'
                    )); ?>

                </fieldset>
            </div>
        </div>

        <hr/>

        <div>
            <?php echo $this->Form->submit('Save', array(
                'div' => false,
                'class' => 'btn btn-lg btn-default',
            )); ?>
            <?php
                echo $this->Html->link('Cancel', 
                    array('controller'=>'users', 'action'=>'index'),
                    array('class'=>'btn btn-lg btn-warning')
                );
            ?>
        </div>

    <?php echo $this->Form->end(); ?>

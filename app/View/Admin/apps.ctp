<h3>SSP<?php echo Configure::read('SiteConfig.current_year') ?>  Applications</h3>

<hr/>

<div class="well">
    <h4>Chair</h4>
    <?php echo $this->Html->link('Core Chairs', array('controller'=>'admin', 'action'=>'core_chair_apps'), array('class'=>'btn btn-sm btn-info')) ?>
    <?php echo $this->Html->link('Departments Chairs', array('controller'=>'admin', 'action'=>'department_chair_apps'), array('class'=>'btn btn-sm btn-info')) ?>
    <?php echo $this->Html->link('TP Chairs', array('controller'=>'admin', 'action'=>'tp_chair_apps'), array('class'=>'btn btn-sm btn-info')) ?>

    <hr/>

    <h4>TA / Staff</h4>
    <?php echo $this->Html->link('Department TAs', array('controller'=>'admin', 'action'=>'department_ta_apps'), array('class'=>'btn btn-sm btn-info')) ?>
    <?php echo $this->Html->link('TP TAs', array('controller'=>'admin', 'action'=>'tp_ta_apps'), array('class'=>'btn btn-sm btn-info')) ?>
    <?php echo $this->Html->link('SSP Staff', array('controller'=>'admin', 'action'=>'tmp_staff_apps'), array('class'=>'btn btn-sm btn-info')) ?>
    <?php echo $this->Html->link('Dear Johns Lists', array('controller'=>'admin', 'action'=>'dearjohn_ta_staff'), array('class'=>'btn btn-sm btn-warning pull-right')) ?>
</div>

<div class="well">
    <h4> Activity Proposals </h4>
    <?php echo $this->Html->link('Activity (WS or DA)', array('controller'=>'proposals', 'action'=>'activity_apps'), array('class'=>'btn btn-sm btn-info'));?>
    <?php echo $this->Html->link('Theme Day', array('controller'=>'proposals', 'action'=>'theme_day_apps'), array('class'=>'btn btn-sm btn-info'));?>
</div>

<div class="well">
    <h4> Team Project Proposals </h4>
    <?php echo $this->Html->link('View TP Proposals', array('controller'=>'proposals', 'action'=>'project_apps'), array('class'=>'btn btn-sm btn-info'));?>
</div>

<hr />

<h3>Statistics</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>SSP Positions</th>
            <th>Number of Applications</th>
        </tr>
    </thead>
    <tr>
        <td>Core Lecture Chairs</td>
        <td><?php echo $core_chair_apps_count; ?></td>
    </tr>
    <tr>
        <td>Department Chairs</td>
        <td><?php echo $department_chair_apps_count; ?></td>
    </tr>
    <tr>
        <td>TP Chairs</td>
        <td><?php echo $tp_chair_apps_count; ?></td>
    </tr>
    <tr>
        <td>Department TAs</td>
        <td><?php echo $department_ta_apps_count; ?></td>
    </tr>
    <tr>
        <td>TP TAs</td>
        <td><?php echo $tp_ta_apps_count; ?></td>
    </tr>
    <tr>
        <td>TMP Staff</td>
        <td><?php echo $tmp_staff_apps_count; ?></td>
    </tr>
    <tr>
        <td>Activities</td>
        <td><?php echo $activity_apps_count; ?></td>
    </tr>
    <tr>
        <td>Theme Day Topics</td>
        <td><?php echo $theme_day_apps_count; ?></td>
    </tr>
</table>

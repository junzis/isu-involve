<h3>SSP<?php echo Configure::read('SiteConfig.current_year') ?>  Applications</h3>

<hr/>

<div class="well">
    <h4>TA / Staff</h4>
    <?php echo $this->Html->link('Department TAs', array('controller'=>'chair', 'action'=>'department_ta_apps'), array('class'=>'btn btn-sm btn-default')) ?>
    <?php echo $this->Html->link('TP TAs', array('controller'=>'chair', 'action'=>'tp_ta_apps'), array('class'=>'btn btn-sm btn-default')) ?>
    <?php echo $this->Html->link('SSP Staff', array('controller'=>'chair', 'action'=>'tmp_staff_apps'), array('class'=>'btn btn-sm btn-default')) ?>
</div>

<div class="well">
    <h4> Activity Proposals </h4>
    <?php echo $this->Html->link('Activity (WS or DA)', array('controller'=>'proposals', 'action'=>'activity_apps'), array('class'=>'btn btn-sm btn-default'));?>

</div>

<div class="well">
    <h4>Statistics</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SSP Positions</th>
                <th width="30%">Number of Applications</th>
                <th width="30%">Selected</th>
            </tr>
        </thead>
        <tr>
            <td>Department TAs</td>
            <td><?php echo $department_ta_apps_count; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>TP TAs</td>
            <td><?php echo $tp_ta_apps_count; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>TMP Staff</td>
            <td><?php echo $tmp_staff_apps_count; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Activities</td>
            <td><?php echo $activity_apps_count; ?></td>
            <td></td>
        </tr>
    </table>
</div>
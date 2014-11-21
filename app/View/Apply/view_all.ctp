<div class="pull-right">
    <?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Apply for more positions / activities', 
        array('action'=>'index'), array('class'=>'btn btn-primary', 'escape'=>false)); ?>
</div>


<h2>My applications for SSP <?php echo Configure::read('SiteConfig.current_year'); ?></h2>

<br />

<table class="table table-bordered">
    <thead>
        <tr>
            <th width=20%>Application / Proposal</th>
            <th>Summary</th>
            <th></th>
        </tr>
    </thead>

    <?php foreach ($core_chair_apps as $app) : ?>
        <?php $tag=String::uuid(); ?>
        <tr>
            <td>Core Chair</td>
            <td>
                <span class="desc-toggle" id="toggle-<?php echo $tag?>">Show / Hide details</span>
                <div class="description-wrapper" id="description-<?php echo $tag?>" style="display:none">
                    <?php echo $app['CoreChairApp']['is_attend_cpm'] ? '<span class="small-badge green">CPM</span>' : '<span class="small-badge red">CPM</span>'; ?>
                    <?php echo $app['CoreChairApp']['is_time_commit'] ? '<span class="small-badge green">Time Commit</span>' : '<span class="small-badge red">Time Commit</span>'; ?>
                    <h5>Areas of expertise</h5>
                    <?php echo nl2br($app['CoreChairApp']['exp_areas']) ?>
                </div>
                <script>
                    $("#toggle-<?php echo $tag?>").click(function(){
                        $("#description-<?php echo $tag?>").slideToggle();
                    });
                </script>
            </td>
            <td align="right" nowrap>
                <?php echo $this->Html->link('Update', array('controller'=>'apply', 'action'=>'core_chair', 'update',  $app['CoreChairApp']['id']), array('class'=>'btn btn-sm btn-default')) ?>
                <?php echo $this->Html->link('Delete', array('controller'=>'apply', 'action'=>'core_chair', 'delete',  $app['CoreChairApp']['id']), array('class'=>'btn btn-sm btn-danger'), 'Are you sure to delete this application?') ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php foreach ($department_chair_apps as $app) : ?>
        <?php $tag=String::uuid(); ?>
        <tr>
            <td>Department Chair</td>
            <td>
                <?php echo $app['Department']['name'] ?>
                <br/>
                <span class="desc-toggle" id="toggle-<?php echo $tag?>">Show / Hide details</span>
                <div class="description-wrapper" id="description-<?php echo $tag?>" style="display:none">
                    <?php echo $app['DepartmentChairApp']['is_attend_cpm'] ? '<span class="small-badge green">CPM</span>' : '<span class="small-badge red">CPM</span>'; ?>
                    <?php echo $app['DepartmentChairApp']['is_time_commit'] ? '<span class="small-badge green">Time Commit</span>' : '<span class="small-badge red">Time Commit</span>'; ?>
                    <h5>Department goals, activites, plans</h5>
                    <?php echo nl2br($app['DepartmentChairApp']['description']) ?>
                </div>
                <script>
                    $("#toggle-<?php echo $tag?>").click(function(){
                        $("#description-<?php echo $tag?>").slideToggle();
                    });
                </script>
            </td>
            <td align="right" nowrap>
                <?php echo $this->Html->link('Update', array('controller'=>'apply', 'action'=>'department_chair', 'update',  $app['DepartmentChairApp']['id']), array('class'=>'btn btn-sm btn-default')) ?>
                <?php echo $this->Html->link('Delete', array('controller'=>'apply', 'action'=>'department_chair', 'delete',  $app['DepartmentChairApp']['id']), array('class'=>'btn btn-sm btn-danger'), 'Are you sure to delete this application?') ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php foreach ($tp_chair_apps as $app) : ?>
        <?php $tag=String::uuid(); ?>
        <tr>
            <td>TP Chair</td>
            <td>
                <?php echo $app['Tp']['name'] ?>
                <br/>
                <span class="desc-toggle" id="toggle-<?php echo $tag?>">Show / Hide details</span>
                <div class="description-wrapper" id="description-<?php echo $tag?>" style="display:none">
                    <?php echo $app['TpChairApp']['is_attend_cpm'] ? '<span class="small-badge green">CPM</span>' : '<span class="small-badge red">CPM</span>'; ?>
                    <?php echo $app['TpChairApp']['is_time_commit'] ? '<span class="small-badge green">Time Commit</span>' : '<span class="small-badge red">Time Commit</span>'; ?>
                    <h5>TP goals, activites, plans</h5>
                    <?php echo nl2br($app['TpChairApp']['description']) ?>
                </div>
                <script>
                    $("#toggle-<?php echo $tag?>").click(function(){
                        $("#description-<?php echo $tag?>").slideToggle();
                    });
                </script>
            </td>
            <td align="right" nowrap>
                <?php echo $this->Html->link('Update', array('controller'=>'apply', 'action'=>'tp_chair', 'update',  $app['TpChairApp']['id']), array('class'=>'btn btn-sm btn-default')) ?>
                <?php echo $this->Html->link('Delete', array('controller'=>'apply', 'action'=>'tp_chair', 'delete',  $app['TpChairApp']['id']), array('class'=>'btn btn-sm btn-danger'), 'Are you sure to delete this application?') ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php foreach ($department_ta_apps as $app) : ?>
        <?php $tag=String::uuid(); ?>
        <tr>
            <td>Department TA</td>
            <td>
                <?php echo $app['Department']['name'] ?>
                <span class="desc-toggle" id="toggle-<?php echo $tag?>">Show / Hide details</span>
                <div class="description-wrapper" id="description-<?php echo $tag?>" style="display:none">
                    <h5>Motivation:</h5>
                    <?php echo nl2br($app['DepartmentTaApp']['description']) ?>
                </div>
                <script>
                    $("#toggle-<?php echo $tag?>").click(function(){
                        $("#description-<?php echo $tag?>").slideToggle();
                    });
                </script>
            </td>
            <td align="right" nowrap>
                <?php echo $this->Html->link('Update', array('controller'=>'apply', 'action'=>'department_ta', 'update',  $app['DepartmentTaApp']['id']), array('class'=>'btn btn-sm btn-default')) ?>
                <?php echo $this->Html->link('Delete', array('controller'=>'apply', 'action'=>'department_ta', 'delete',  $app['DepartmentTaApp']['id']), array('class'=>'btn btn-sm btn-danger'), 'Are you sure to delete this application?') ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php foreach ($tp_ta_apps as $app) : ?>
        <?php $tag=String::uuid(); ?>
        <tr>
            <td>Team Project TA</td>
            <td>
                <?php echo $app['Tp']['name'] ?>
                <span class="desc-toggle" id="toggle-<?php echo $tag?>">Show / Hide details</span>
                <div class="description-wrapper" id="description-<?php echo $tag?>" style="display:none">
                    <h5>Motivation:</h5>
                    <?php echo nl2br($app['TpTaApp']['description']) ?>
                </div>
                <script>
                    $("#toggle-<?php echo $tag?>").click(function(){
                        $("#description-<?php echo $tag?>").slideToggle();
                    });
                </script>
            </td>
            <td align="right" nowrap>
                <?php echo $this->Html->link('Update', array('controller'=>'apply', 'action'=>'tp_ta', 'update',  $app['TpTaApp']['id']), array('class'=>'btn btn-sm btn-default')) ?>
                <?php echo $this->Html->link('Delete', array('controller'=>'apply', 'action'=>'tp_ta', 'delete',  $app['TpTaApp']['id']), array('class'=>'btn btn-sm btn-danger'), 'Are you sure to delete this application?') ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php foreach ($tmp_staff_apps as $app) : ?>
        <?php $tag=String::uuid(); ?>
        <tr>
            <td>SSP Staff</td>
            <td>
                <?php echo $tmp_staffs[$app['TmpStaffApp']['tmp_staff_id']] ?>
                <span class="desc-toggle" id="toggle-<?php echo $tag?>">Show / Hide details</span>
                <div class="description-wrapper" id="description-<?php echo $tag?>" style="display:none">
                    <h5>Motivation:</h5>
                    <?php echo nl2br($app['TmpStaffApp']['description']) ?>
                </div>
                <script>
                    $("#toggle-<?php echo $tag?>").click(function(){
                        $("#description-<?php echo $tag?>").slideToggle();
                    });
                </script>
            </td>
            <td align="right" nowrap>
                <?php echo $this->Html->link('Update', array('controller'=>'apply', 'action'=>'tmp_staff', 'update',  $app['TmpStaffApp']['id']), array('class'=>'btn btn-sm btn-default')) ?>
                <?php echo $this->Html->link('Delete', array('controller'=>'apply', 'action'=>'tmp_staff', 'delete',  $app['TmpStaffApp']['id']), array('class'=>'btn btn-sm btn-danger'), 'Are you sure to delete this application?') ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php foreach ($activity_apps as $app) : ?>
        <?php 
            if($app['ActivityApp']['year'] == Configure::read('SiteConfig.current_year')) :
            $tag=String::uuid(); 
        ?>
        <tr>
            <td>Activity</td>
            <td>
                <?php echo $app['ActivityApp']['title'] ?>

                <span class="desc-toggle" id="toggle-<?php echo $tag?>">Show / Hide details</span>

                <div class="description-wrapper" id="description-<?php echo $tag?>" style="display:none">
                    <h5>Descriptions:</h5>
                    <?php echo nl2br($app['ActivityApp']['description']) ?>
                    <br/><br/>
                    <h5>Activity Type:</h5>
                    <ul>
                    <?php
                        if($app['ActivityApp']['is_ws']){
                            echo '<li>Can be a Workshop</li>';
                        }

                        if($app['ActivityApp']['is_da']){
                            echo '<li>Can be a Department Activity for: ';
                            foreach ($app['Department'] as $dept) {
                                echo $dept['abbr'].' ';
                            }
                            echo '</li>';
                        }
                    ?>
                    </ul>
                </div>

                <script>
                    $("#toggle-<?php echo $tag?>").click(function(){
                        $("#description-<?php echo $tag?>").slideToggle();
                    });
                </script>
            </td>
            <td align="right" nowrap>
                <?php echo $this->Html->link('Update', array('controller'=>'apply', 'action'=>'activity', 'update',  $app['ActivityApp']['id']), array('class'=>'btn btn-sm btn-default')) ?>
                <?php echo $this->Html->link('Delete', array('controller'=>'apply', 'action'=>'activity', 'delete',  $app['ActivityApp']['id']), array('class'=>'btn btn-sm btn-danger'), 'Are you sure to delete this application?') ?>
            </td>
        </tr>
    <?php endif; ?>
    <?php endforeach; ?>

    <?php foreach ($theme_day_apps as $app) : ?>
        <?php $tag=String::uuid(); ?>
        <tr>
            <td>Theme Day</td>
            <td>
                <?php echo $app['ThemeDayApp']['title'] ?>
                <span class="desc-toggle" id="toggle-<?php echo $tag?>">Show / Hide details</span>
                <div class="description-wrapper" id="description-<?php echo $tag?>" style="display:none">
                    <h5>Description:</h5>
                    <?php echo nl2br($app['ThemeDayApp']['description']) ?>
                </div>
                <script>
                    $("#toggle-<?php echo $tag?>").click(function(){
                        $("#description-<?php echo $tag?>").slideToggle();
                    });
                </script>
            </td>
            <td align="right" nowrap>
                <?php echo $this->Html->link('Update', array('controller'=>'apply', 'action'=>'theme_day', 'update',  $app['ThemeDayApp']['id']), array('class'=>'btn btn-sm btn-default')) ?>
                <?php echo $this->Html->link('Delete', array('controller'=>'apply', 'action'=>'theme_day', 'delete',  $app['ThemeDayApp']['id']), array('class'=>'btn btn-sm btn-danger'), 'Are you sure to delete this application?') ?>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php foreach ($project_apps as $app) : ?>
        <?php $tag=String::uuid(); ?>
        <tr>
            <td>Team Project</td>
            <td>
                <?php echo $app['ProjectApp']['title'] ?>
                <span class="desc-toggle" id="toggle-<?php echo $tag?>">Show / Hide details</span>

                <div class="description-wrapper" id="description-<?php echo $tag?>" style="display:none">
                    <h5>Project Title: </h5>
                    <?php echo nl2br($app['ProjectApp']['title']) ?>
                    
                    <h5>One-paragraph description:</h5>
                    <?php echo nl2br($app['ProjectApp']['description']) ?>
                    
                    <h5>Background rationale:</h5>
                    <?php echo nl2br($app['ProjectApp']['background']) ?>

                    <h5>Main issue(s) to be addressed:</h5>
                    <?php echo nl2br($app['ProjectApp']['issues']) ?>

                    <h5>Main tasks to be accomplished:</h5>
                    <?php echo nl2br($app['ProjectApp']['tasks']) ?>

                    <h5>International / Interculture scope of the project:</h5>
                    <?php echo nl2br($app['ProjectApp']['scope_2i']) ?>

                    <h5>Interdisciplinary Scope - Expected level of involvement of by disciplines:</h5>
                    Space Applications:
                    <?php if($app['ProjectApp']['level_app']==2){echo "Major";} else {echo "Minor";} ?>
                    <br/>
                    Space Engineering:
                    <?php if($app['ProjectApp']['level_eng']==2){echo "Major";} else {echo "Minor";} ?>
                    <br/>
                    Human Performance in Space:
                    <?php if($app['ProjectApp']['level_hps']==2){echo "Major";} else {echo "Minor";} ?>
                    <br/>
                    Space Humanities:
                    <?php if($app['ProjectApp']['level_hum']==2){echo "Major";} else {echo "Minor";} ?>
                    <br/>
                    Space Management and Business:
                    <?php if($app['ProjectApp']['level_mgb']==2){echo "Major";} else {echo "Minor";} ?>
                    <br/>
                    Space Policy, Economics and Law:
                    <?php if($app['ProjectApp']['level_pel']==2){echo "Major";} else {echo "Minor";} ?>
                    <br/>
                    Space Sciences:
                    <?php if($app['ProjectApp']['level_sci']==2){echo "Major";} else {echo "Minor";} ?>

                    <h5>Brief explanation of expected involvement of by disciplines:</h5>
                    Space Applications:
                    <?php echo nl2br($app['ProjectApp']['area_app']) ?>
                    <br/>
                    Space Engineering:
                    <?php echo nl2br($app['ProjectApp']['area_eng']) ?>
                    <br/>
                    Human Performance in Space:
                    <?php echo nl2br($app['ProjectApp']['area_hps']) ?>
                    <br/>
                    Space Humanities:
                    <?php echo nl2br($app['ProjectApp']['area_hum']) ?>
                    <br/>
                    Space Management and Business:
                    <?php echo nl2br($app['ProjectApp']['area_mgb']) ?>
                    <br/>
                    Space Policy, Economics and Law:
                    <?php echo nl2br($app['ProjectApp']['area_pel']) ?>
                    <br/>
                    Space Sciences:
                    <?php echo nl2br($app['ProjectApp']['area_sci']) ?>

                    <h5>Proposed ISU program:</h5>
                    <?php echo nl2br($app['ProjectApp']['program']) ?>

                    <h5>Window of opportunity in terms of potential relevance of and interest in the project topic:</h5>
                    <?php echo nl2br($app['ProjectApp']['opportunity_window']) ?>

                    <h5>Potential external interest in or sponsorship of the TP topic:</h5>
                    <?php echo nl2br($app['ProjectApp']['potential_sponsorship']) ?>

                    <h5>Prospective impact of the TP:</h5>
                    <?php echo nl2br($app['ProjectApp']['prospective_impact']) ?>

                    <h5>Additional comments:</h5>
                    <?php echo nl2br($app['ProjectApp']['comments']) ?>
                    
                </div>
                <script>
                    $("#toggle-<?php echo $tag?>").click(function(){
                        $("#description-<?php echo $tag?>").slideToggle();
                    });
                </script>
            </td>
            <td align="right" nowrap>
                <?php echo $this->Html->link('Update', array('controller'=>'apply', 'action'=>'project', 'update',  $app['ProjectApp']['id']), array('class'=>'btn btn-sm btn-default')) ?>
                <?php echo $this->Html->link('Delete', array('controller'=>'apply', 'action'=>'project', 'delete',  $app['ProjectApp']['id']), array('class'=>'btn btn-sm btn-danger'), 'Are you sure to delete this application?') ?>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<hr/>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">My history activity proposals</h3>
    </div>
    <div class="panel-body">
        <button class="btn btn-xs btn-info" id="toggle-previous">Show / Hide proposals</button>
        <br/><br/>
        <div id="previous-wrapper" style="display:none">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th width=20%>Application for</th>
                        <th>Summary</th>
                        <th>Year</th>
                        <th></th>
                    </tr>
                </thead>
                <?php foreach ($activity_apps as $app) : ?>
                    <?php 
                        if($app['ActivityApp']['year'] < Configure::read('SiteConfig.current_year')) :
                        $tag=String::uuid(); 
                    ?>
                    <tr>
                        <td>Activity</td>
                        <td>
                            <?php echo $app['ActivityApp']['title'] ?>

                            <span class="desc-toggle" id="toggle-<?php echo $tag?>">Show / Hide details</span>

                            <div class="description-wrapper" id="description-<?php echo $tag?>" style="display:none">
                                <h5>Descriptions:</h5>
                                <?php echo nl2br($app['ActivityApp']['description']) ?>
                                <br/><br/>
                                <h5>Activity Type:</h5>
                                <ul>
                                <?php
                                    if($app['ActivityApp']['is_ws']){
                                        echo '<li>Can be a Workshop</li>';
                                    }

                                    if($app['ActivityApp']['is_da']){
                                        echo '<li>Can be a Department Activity for: ';
                                        foreach ($app['Department'] as $dept) {
                                            echo $dept['abbr'].' ';
                                        }
                                        echo '</li>';
                                    }
                                ?>
                                </ul>
                            </div>

                            <script>
                                $("#toggle-<?php echo $tag?>").click(function(){
                                    $("#description-<?php echo $tag?>").slideToggle();
                                });
                            </script>
                        </td>
                        <td><?php echo $app['ActivityApp']['year'] ?></td>
                        <td align="right" nowrap>
                            <?php echo $this->Html->link('Re-Sumbit', array('controller'=>'apply', 'action'=>'carry_over',  $app['ActivityApp']['id']), array('class'=>'btn btn-xs btn-default')) ?>
                            <?php echo $this->Html->link('Remove from history', array('controller'=>'apply', 'action'=>'activity', 'delete',  $app['ActivityApp']['id']), array('class'=>'btn btn-xs btn-danger'), 'Are you sure to delete this application?') ?>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <script>
        $("#toggle-previous").click(function(){
            $("#previous-wrapper").slideToggle();
        });
    </script>
</div>

<?php
    // debug($core_chair_apps);
    // debug($department_chair_apps);
    // debug($tp_chair_apps);
    // debug($department_ta_apps);
    // debug($tp_ta_apps);
    // debug($tmp_staff_apps);
?>
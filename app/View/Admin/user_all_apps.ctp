<h2>User Applications</h2>

<?php echo $this->Element('admin-user-nav-header', array('uid'=>$user['User']['id'])) ?>

<hr/>

<table class="table table-bordered">
    <tr>
        <td width="25%">Email (login)</td>
        <td><?php echo $user['User']['email']; ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?></td>
    </tr>
</table>

<hr/>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width=20%>Application for</th>
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
            <td></td>
        </tr>
    <?php endforeach; ?>

    <?php foreach ($department_chair_apps as $app) : ?>
        <?php $tag=String::uuid(); ?>
        <tr>
            <td>Department Chair</td>
            <td>
                <?php echo $app['Department']['name'] ?>
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
            <td></td>
        </tr>
    <?php endforeach; ?>

    <?php foreach ($tp_chair_apps as $app) : ?>
        <?php $tag=String::uuid(); ?>
        <tr>
            <td>TP Chair</td>
            <td>
                <?php echo $app['Tp']['name'] ?>
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
            <td></td>
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
            <td></td>
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
            <td></td>
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
            <td></td>
        </tr>
    <?php endforeach; ?>

    <?php foreach ($activity_apps as $app) : ?>
        <?php $tag=String::uuid(); ?>
        <?php if($app['ActivityApp']['year'] == Configure::read('SiteConfig.current_year')) :?>
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
            <td>SSP<?php echo $app['ActivityApp']['year']; ?></td>
        </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>

<hr/>

<!-- Disply historical applications -->
<h5> Hitorical activities proposals </h5>
<table class="table table-bordered">
    <?php foreach ($activity_apps as $app) : ?>
        <?php $tag=String::uuid(); ?>
        <?php if($app['ActivityApp']['year'] < Configure::read('SiteConfig.current_year')) :?>
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
            <td>SSP<?php echo $app['ActivityApp']['year']; ?></td>
        </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>


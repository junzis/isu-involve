<?php $this->set("title_for_layout", "Department Chair Applications") ?>


<h3>Department Chair Applications</h3>


<table class="table table-bordered">
    <thead>
        <tr>
            <th width="20%">Name</th>
            <th>Department</th>
            <th></th>
        </tr>
    </thead>
    <?php foreach($department_chair_apps as $app): ?>
        <?php $id = $app['User']['id']; $appid = $app['DepartmentChairApp']['id']; ?>
        <tr>
            <td>
                <?php echo $app['User']['name']; ?> <br/>
                <?php
                    if($app['DepartmentChairApp']['selected']) {
                        echo '<span class="small-badge green">Chair</span>';
                    } 
                ?>
            </td>
            <td>
                <?php echo $app['Department']['name'] ?>
                <?php echo $app['DepartmentChairApp']['is_attend_cpm'] ? '<span class="small-badge green">CPM</span>' : '<span class="small-badge red">CPM</span>'; ?>
                <?php echo $app['DepartmentChairApp']['is_time_commit'] ? '<span class="small-badge green">Time Commit</span>' : '<span class="small-badge red">Time Commit</span>'; ?>
                <br/>
                <span class="desc-toggle" id="toggle-<?php echo $appid?>">Show / Hide details</span>
                <div class="description-wrapper" id="description-<?php echo $appid?>" style="display:none">
                    <h5>Department goals, activites, plans</h5>
                    <?php echo nl2br($app['DepartmentChairApp']['description']) ?>
                </div>
                <script>
                    $("#toggle-<?php echo $appid?>").click(function(){
                        $("#description-<?php echo $appid?>").slideToggle();
                    });
                </script>
            </td>
            <td align='right'>
                <?php 
                    echo $this->Js->link('View User', 
                        array('controller'=>'users', 'action'=>'user_view_backend',  $id), 
                        array('update'=>'#user-container', 'class'=>'btn btn-xs btn-info', 'complete'=>'$("#userModal").modal("show");')
                    );

                    echo '<br/>';

                    if($app['DepartmentChairApp']['selected']) {
                        echo $this->Html->link('Remove Chair', array('controller'=>'admin', 'action'=>'remove_department_chair', $app['DepartmentChairApp']['id']), array('class'=>'btn btn-xs btn-danger'), 
                            'Are you sure to !!REMOVE!! '.$app['User']['name'].' as a Chair?');
                    } else {
                        echo $this->Html->link('Select Chair', array('controller'=>'admin', 'action'=>'add_department_chair', $app['DepartmentChairApp']['id']), array('class'=>'btn btn-xs btn-default'),
                            'Are you sure to ||SELECT|| '.$app['User']['name'].' as a Chair?');
                    }
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="userModalLabel">User Information</h4>
      </div>
      <div class="modal-body">
        <div id="user-container"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
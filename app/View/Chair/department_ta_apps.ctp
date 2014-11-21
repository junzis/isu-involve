<?php $this->set("title_for_layout", "Department TA Applications") ?>


<div class="pull-right">
    <?php
        echo $this->Html->link('Show / Hide Non-selected Applications', '#', array('id'=>'trtoggle', 'class'=>'btn btn-sm btn-primary'));
        $this->Js->get("#trtoggle");
        $this->Js->event('click', '$(".tr-hide").toggle();')
    ?>
</div>

<h3>Department TA Applications</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="20%">Name</th>
            <th>Department</th>
            <th></th>
        </tr>
    </thead>

    <?php foreach($department_ta_apps as $app): ?>
        <?php $id = $app['User']['id']; $appid = $app['DepartmentTaApp']['id'] ?>
        
                <tr <?php if(!$app['DepartmentTaApp']['selected']){echo 'class="tr-hide"';}?> >
                    <td>
                        <?php echo $app['User']['name']; ?> <br/>
                        <?php if($app['DepartmentTaApp']['selected']) { echo '<span class="small-badge green">TA</span>';} ?>
                    </td>
                    <td>
                        <?php echo $app['Department']['name'] ?>
                        <span class="desc-toggle" id="toggle-<?php echo $appid?>">Show / Hide details</span>
                        <div class="description-wrapper" id="description-<?php echo $appid?>" style="display:none">
                            <h5>Motivation:</h5>
                            <?php echo nl2br($app['DepartmentTaApp']['description']) ?>
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

                            echo "<br/>";
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


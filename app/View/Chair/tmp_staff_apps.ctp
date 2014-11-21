<?php $this->set("title_for_layout", "Tmp Staff Applications") ?>

<div class="pull-right">
    <?php
        echo $this->Html->link('Show / Hide Non-selected Applications', '#', array('id'=>'trtoggle', 'class'=>'btn btn-sm btn-primary'));
        $this->Js->get("#trtoggle");
        $this->Js->event('click', '$(".tr-hide").toggle();')
    ?>
</div>

<h3>Tmp Staff Applications</h3>


<table class="table table-bordered">
    <thead>
        <tr>
            <th width="20%">Name</th>
            <th>Tmp Staff Position</th>
            <th></th>
        </tr>
    </thead>

    <?php foreach($tmp_staff_apps as $app): ?>
        <?php $id = $app['User']['id']; $appid = $app['TmpStaffApp']['id'];  ?>
        <tr <?php if(!$app['TmpStaffApp']['selected']){echo 'class="tr-hide"';}?> >
            <td>
                <?php echo $app['User']['name']; ?> <br/>
                <?php if($app['TmpStaffApp']['selected']) { echo '<span class="small-badge green">Staff</span>';} ?>
            </td>
            <td>
                <?php echo $tmp_staffs[$app['TmpStaffApp']['tmp_staff_id']] ?>
                <span class="desc-toggle" id="toggle-<?php echo $appid?>">Show / Hide details</span>
                <div class="description-wrapper" id="description-<?php echo $appid?>" style="display:none">
                    <h5>Motivation:</h5>
                    <?php echo nl2br($app['TmpStaffApp']['description']) ?>
                </div>
                <script>
                    $("#toggle-<?php echo $appid?>").click(function(){
                        $("#description-<?php echo $appid?>").slideToggle();
                    });
                </script>
            </td>
            <td align='right'>
                <?php echo $this->Js->link('View User', 
                        array('controller'=>'users', 'action'=>'user_view_backend',  $id), 
                        array('update'=>'#user-container', 'class'=>'btn btn-xs btn-info', 'complete'=>'$("#userModal").modal("show");')
                );?>
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
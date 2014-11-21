<?php $this->set("title_for_layout", "Core Lecture Applications") ?>


<h3>Theme Day Proposals</h3>


<table class="table table-bordered">
    <thead>
        <tr>
            <th width="20%">Name</th>
            <th>Theme Day Topic</th>
            <th></th>
        </tr>
    </thead>

    <?php foreach($theme_day_apps as $app): ?>
        <?php $id = $app['User']['id']; $appid = $app['ThemeDayApp']['id']; ?>        
        <tr>
            <td><?php echo $app['User']['first_name'].' '.$app['User']['last_name']; ?></td>
            <td>
                <?php echo $app['ThemeDayApp']['title'] ?>
                <span class="desc-toggle" id="toggle-<?php echo $appid?>">Show / Hide details</span>

                <div class="description-wrapper" id="description-<?php echo $appid?>" style="display:none">
                    <?php echo nl2br($app['ThemeDayApp']['description']) ?>
                </div>
                <script>
                    $("#toggle-<?php echo $appid?>").click(function(){
                        $("#description-<?php echo $appid?>").slideToggle();
                    });
                </script>
            </td>
            <td align="right" nowrap>
                <?php echo $this->Js->link('View User', 
                        array('controller'=>'users', 'action'=>'user_view_backend',  $id), 
                        array('update'=>'#user-container', 'class'=>'btn btn-xs btn-info', 'complete'=>'$("#userModal").modal("show");')
                );?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<?php echo $this->Element('pagination'); ?>


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
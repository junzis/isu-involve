<?php $this->set("title_for_layout", "TP Proposals") ?>

<h3>TP Proposals</h3>

<hr/>

<div class="well well-sm">
<?php echo $this->Form->create('Project', array('url'=>array('controller'=>'admin', 'action'=>'search_project'), 'class'=>'form-inline', 'role'=>'form')); ?>
    <div class="form-group">
        <h4>Search:</h4>
    </div>
    <div class="form-group">
        <?php echo $this->Form->input('search', array('type' => 'text', 'placeholder' => 'keyword', 'label' => false, 'div'=>false, 'class'=>'form-control')); ?>
    </div>
    <?php echo $this->Form->submit('Search', array('class' => 'btn btn-sm btn-default','div'=>false)); ?>
<?php echo $this->Form->end(); ?>
</div>

<hr/>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="20%">Name</th>
            <th>Activity</th>
            <th>ID</th>
            <th>Date</th>
            <th></th>
        </tr>
    </thead>

    <?php foreach ($project_apps as $app) : ?>
        <tr>
            <td>
                <?php echo $this->Js->link($app['User']['name'], 
                        array('controller'=>'users', 'action'=>'user_view_backend',  $app['User']['id']), 
                        array('update'=>'#user-container', 'complete'=>'$("#userModal").modal("show");')
                );?>
            </td>
            <td>
                <?php echo $app['ProjectApp']['title'] ?>
            </td>
            <td nowrap>
                <?php echo $app['ProjectApp']['uid'] ?>
            </td>
            <td nowrap>
                <?php echo $app['ProjectApp']['created'] ?>
            </td>
            <td align="right" nowrap>
                <?php echo $this->Html->link('View', 
                        array('controller'=>'proposals', 'action'=>'manage_project_app',  $app['ProjectApp']['id']), 
                        array('class'=>'btn btn-xs btn-info')
                );?>
            </td>
        </tr>
    <?php endforeach; ?>

</table>


<?php 
    if($this->Paginator->params()){
        echo $this->Element('pagination'); 
    }
?>

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
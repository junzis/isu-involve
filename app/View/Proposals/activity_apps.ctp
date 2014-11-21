<?php $this->set("title_for_layout", "Activity Applications") ?>

<?php echo $this->Html->link('Show All Activity Applications', array('action'=>'activity_apps'), array('class' => 'btn btn-sm btn-info pull-right')); ?>
<h3>Activity Applications</h3>

<hr/>

<div class="well well-sm">
<?php echo $this->Form->create('Dept', array('url'=>array('controller'=>'proposals', 'action'=>'activities_for_department'), 'class'=>'form-inline', 'role'=>'form')); ?>
    <div class="form-group">
        <h4>Department:</h4>
    </div>
    <div class="form-group">
        <?php echo $this->Form->input('id', array('options'=>$departments, 'empty' => '- Select -', 'label' => false, 'class'=>'form-control')); ?>
    </div>
    <?php echo $this->Form->submit('Filter', array('class' => 'btn btn-sm btn-default','div'=>false)); ?>
<?php echo $this->Form->end(); ?>
</div>

<div class="well well-sm">
<?php echo $this->Form->create('Activity', array('url'=>array('controller'=>'proposals', 'action'=>'search_activity'), 'class'=>'form-inline', 'role'=>'form')); ?>
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
            <th>Year</th>
            <th width="5%"></th>
        </tr>
    </thead>

    <?php foreach($activity_apps as $app): ?>
        <?php $id = $app['User']['id']; $appid = $app['ActivityApp']['id']; ?>
        
                <tr>
                    <td><?php echo $app['User']['first_name'].' '.$app['User']['last_name']; ?></td>
                    <td>
                        <?php echo $app['ActivityApp']['title'] ?>

                        <span class="desc-toggle" id="toggle-<?php echo $appid?>">Show / Hide details</span>

                        <div class="description-wrapper" id="description-<?php echo $appid?>" style="display:none">
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
                            <?php 
                                echo $this->Html->link('Edit', array('controller'=>'admin', 'action'=>'edit_activity_app', $appid), array('class'=>'btn btn-xs btn-danger'), 
                                '"With great power, comes great responsibility". Please be conscious when modify someone else application, changes can NOT be undone!'); 
                            ?>
                        </div>

                        <script>
                            $("#toggle-<?php echo $appid?>").click(function(){
                                $("#description-<?php echo $appid?>").slideToggle();
                            });
                        </script>

                    </td>
                    <td><?php echo $app['ActivityApp']['year'] ?></td>
                    <td nowrap>
                        <?php echo $this->Js->link('View User', 
                                array('controller'=>'users', 'action'=>'user_view_backend',  $id), 
                                array('update'=>'#user-container', 'class'=>'btn btn-xs btn-info', 'complete'=>'$("#userModal").modal("show");')
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
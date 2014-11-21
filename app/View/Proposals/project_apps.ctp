<?php $this->set("title_for_layout", "Activity Applications") ?>

<?php echo $this->Html->link('Show All Activity Applications', array('action'=>'activity_apps'), array('class' => 'btn btn-sm btn-info pull-right')); ?>
<h3>Activity Applications</h3>

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
            <th width="5%"></th>
        </tr>
    </thead>

    <?php foreach ($project_apps as $app) : ?>
        <?php $tag=String::uuid();?>
        <tr>
            <td><?php echo $app['User']['name']; ?></td>
            <td>
                <?php echo $app['ProjectApp']['title'] ?>
                <span class="desc-toggle" id="toggle-<?php echo $tag?>">Show / Hide details</span>

                <div class="description-wrapper" id="description-<?php echo $tag?>" style="display:none">
                    <h5>Project Title: </h5>
                    <?php echo $app['ProjectApp']['title'] ?>
                    
                    <h5>Proposed ISU program:</h5>
                    <?php echo nl2br($app['ProjectApp']['program']) ?>

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
            <td></td>
            <td align="right" nowrap>
                <?php echo $this->Html->link('Manage', 
                        array('controller'=>'proposals', 'action'=>'manage_project_app',  $app['ProjectApp']['id']), 
                        array('class'=>'btn btn-xs btn-info')
                );?>
                <?php echo $this->Js->link('View User', 
                        array('controller'=>'users', 'action'=>'user_view_backend',  $app['User']['id']), 
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
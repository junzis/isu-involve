<div class="well">
     <?php
          echo $this->Html->link('Print / PDF', 
               array('controller'=>'proposals', 'action'=>'print_project_app', $app['ProjectApp']['id']), 
               array('target'=>'_blank', 'class'=>'btn btn-primary pull-right')
          );
     ?>
     <?php echo $this->Form->create('ProjectApp', array('url'=>array('controller'=>'proposals', 'action'=>'update_project_uid'), 'class'=>'form-inline', 'role'=>'form', 'type'=>'post')); ?>
         <div class="form-group">
             <h4>Update TP Unique ID:</h4>
         </div>
         <div class="form-group">
             <?php echo $this->Form->hidden('id'); ?>
             <?php echo $this->Form->input('uid', array('type' => 'text', 'label' => false, 'div'=>false, 'class'=>'form-control')); ?>
         </div>
         <?php echo $this->Form->submit('Submit', array('class' => 'btn btn-default','div'=>false)); ?>
     <?php echo $this->Form->end(); ?>
</div>

<div class="well">
     <h4>
          ISU TP Proposal Unique ID: 
          <?php echo ($app['ProjectApp']['uid']) ? '<u>'.$app['ProjectApp']['uid']."</u>" : "N/A" ?>
     </h4>

     <h5>By: <?php echo $app['User']['name'] ?></h5>
     <h5>Date: <?php echo date('d M, Y', strtotime($app['ProjectApp']['created'])); ?></h5>

     <hr/>

     <h4>Project Title: </h4>
     <?php echo $app['ProjectApp']['title'] ?>

     
     <h4>Proposed ISU program:</h4>
     <?php echo nl2br($app['ProjectApp']['program']) ?>

     <h4>One-paragraph description:</h4>
     <?php echo nl2br($app['ProjectApp']['description']) ?>
     
     <h4>Background rationale:</h4>
     <?php echo nl2br($app['ProjectApp']['background']) ?>

     <h4>Main issue(s) to be addressed:</h4>
     <?php echo nl2br($app['ProjectApp']['issues']) ?>

     <h4>Main tasks to be accomplished:</h4>
     <?php echo nl2br($app['ProjectApp']['tasks']) ?>

     <h4>International / Interculture scope of the project:</h4>
     <?php echo nl2br($app['ProjectApp']['scope_2i']) ?>

     <h4>Interdisciplinary Scope - Expected level of involvement of by disciplines:</h4>
     <table class="table table-bordered table-condensed table-bordered">
          <tr>
               <td nowrap width="30%">Space Applications</td>
               <td><?php if($app['ProjectApp']['level_app']==2){echo "Major";} else {echo "Minor";} ?></td>
          </tr>
          <tr>
               <td nowrap>Space Engineering</td>
               <td><?php if($app['ProjectApp']['level_eng']==2){echo "Major";} else {echo "Minor";} ?></td>
          </tr>
          <tr>
               <td nowrap>Human Performance in Space</td>
               <td><?php if($app['ProjectApp']['level_hps']==2){echo "Major";} else {echo "Minor";} ?></td>
          </tr>
          <tr>
               <td nowrap>Space Humanities</td>
               <td nowrap><?php if($app['ProjectApp']['level_hum']==2){echo "Major";} else {echo "Minor";} ?></td>
          </tr>
          <tr>
               <td nowrap>Space Management and Business</td>
               <td><?php if($app['ProjectApp']['level_mgb']==2){echo "Major";} else {echo "Minor";} ?></td>
          </tr>
          <tr>
               <td nowrap>Space Policy, Economics and Law</td>
               <td><?php if($app['ProjectApp']['level_pel']==2){echo "Major";} else {echo "Minor";} ?></td>
          </tr>
          <tr>
               <td nowrap>Space Sciences</td>
               <td><?php if($app['ProjectApp']['level_sci']==2){echo "Major";} else {echo "Minor";} ?></td>
          </tr>
     </table>
     

     <h4>Brief explanation of expected involvement of by disciplines:</h4>
     <table class="table table-bordered table-condensed">
          <tr>
               <td nowrap width="30%">Space Applications</td>
               <td><?php echo nl2br($app['ProjectApp']['area_app']) ?></td>
          </tr>
          <tr>
               <td nowrap>Space Engineering</td>
               <td><?php echo nl2br($app['ProjectApp']['area_eng']) ?></td>
          </tr>
          <tr>
               <td nowrap>Human Performance in Space</td>
               <td><?php echo nl2br($app['ProjectApp']['area_hps']) ?></td>
          </tr>
          <tr>
               <td nowrap>Space Humanities</td>
               <td><?php echo nl2br($app['ProjectApp']['area_hum']) ?></td>
          </tr>
          <tr>
               <td nowrap>Space Management and Business</td>
               <td><?php echo nl2br($app['ProjectApp']['area_mgb']) ?></td>
          </tr>
          <tr>
               <td nowrap>Space Policy, Economics and Law</td>
               <td><?php echo nl2br($app['ProjectApp']['area_pel']) ?></td>
          </tr>
          <tr>
               <td nowrap>Space Sciences</td>
               <td><?php echo nl2br($app['ProjectApp']['area_sci']) ?></td>
          </tr>
     </table>

     <h4>Window of opportunity in terms of potential relevance of and interest in the project topic:</h4>
     <?php echo nl2br($app['ProjectApp']['opportunity_window']) ?>

     <h4>Potential external interest in or sponsorship of the TP topic:</h4>
     <?php echo nl2br($app['ProjectApp']['potential_sponsorship']) ?>

     <h4>Prospective impact of the TP:</h4>
     <?php echo nl2br($app['ProjectApp']['prospective_impact']) ?>

     <h4>Additional comments:</h4>
     <?php echo nl2br($app['ProjectApp']['comments']) ?>
     
 </div>

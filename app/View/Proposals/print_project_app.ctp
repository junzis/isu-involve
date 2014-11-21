     <h4>
          ISU Team Project Proposal
          <span class="pull-right">UID: <?php echo ($app['ProjectApp']['uid']) ? '<u>'.$app['ProjectApp']['uid']."</u>" : "N/A" ?> </span>
     </h4>
     <h5>By: <?php echo $app['User']['name'] ?></h5>
     <h5>Date: <?php echo date('d M, Y', strtotime($app['ProjectApp']['created'])); ?></h5>

     <hr/>


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
     

     <h5>Brief explanation of expected involvement of by disciplines:</h5>
     <table class="table table-bordered table-condensed table-bordered">
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

     <h5>Window of opportunity in terms of potential relevance of and interest in the project topic:</h5>
     <?php echo nl2br($app['ProjectApp']['opportunity_window']) ?>

     <h5>Potential external interest in or sponsorship of the TP topic:</h5>
     <?php echo nl2br($app['ProjectApp']['potential_sponsorship']) ?>

     <h5>Prospective impact of the TP:</h5>
     <?php echo nl2br($app['ProjectApp']['prospective_impact']) ?>

     <h5>Additional comments:</h5>
     <?php echo nl2br($app['ProjectApp']['comments']) ?>
     

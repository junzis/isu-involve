<div class="row">

<div class="col-md-6">    
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">For SSP <?php echo Configure::read('SiteConfig.current_year'); ?></h3>
      </div>
      <div class="panel-body">
        <div class="well well-sm">
            1. Please read first: <u><a href="https://drive.google.com/folderview?id=0B4DzXK9e9KhVaWNTS2NNUk50dEk#list" target="_blank">
                Calls for SSP15 Chairs, Faculty, Staff, and TAs</a></u> <br/>
            2. You may apply for different positions
        </div>

        <h4> Be a Chair </h4>
            <?php echo $this->Html->link('Core Lecture Chair', 
                array('controller'=>'apply', 'action'=>'core_chair', 'add'), array('class'=>'btn btn-primary'));?>
            <?php echo $this->Html->link('Department Chair', 
                array('controller'=>'apply', 'action'=>'department_chair', 'add'), array('class'=>'btn btn-primary'));?> 
            <?php echo $this->Html->link('TP Chair', 
                array('controller'=>'apply', 'action'=>'tp_chair', 'add'), array('class'=>'btn btn-primary'));?> 
        <br/><br/>
        <h4> Be a TA or Staff </h4>
            <?php echo $this->Html->link('Department TA', 
                array('controller'=>'apply', 'action'=>'department_ta', 'add'), array('class'=>'btn btn-primary'));?> 
            <?php echo $this->Html->link('Team Project TA', 
                array('controller'=>'apply', 'action'=>'tp_ta', 'add'), array('class'=>'btn btn-primary'));?> 
            <?php echo $this->Html->link('SSP Staff', 
                array('controller'=>'apply', 'action'=>'tmp_staff', 'add'), array('class'=>'btn btn-primary'));?> 

        <hr/>

        <div class="well well-sm">
            You are encouraged to propose a few activities, such as workshops (WS) and/or department activities (DA).
        </div>

        <h4> Propose SSP activities</h4>
            <?php echo $this->Html->link('Activity (WS or DA)', 
                array('controller'=>'apply', 'action'=>'activity', 'add'), array('class'=>'btn btn-primary'));?>
        <hr/>

        <div class="well well-sm">
            If you have a Theme Day topic idea, please let us know.
        </div>

        <h4> Suggest a Theme Day topic</h4>
            <?php echo $this->Html->link('Theme Day Topic', 
                array('controller'=>'apply', 'action'=>'theme_day', 'add'), array('class'=>'btn btn-primary'));?>
      </div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">For ISU</h3>
      </div>
      <div class="panel-body">
        <h3> Propose future ISU Team Projects</h3>
        <div class="well">
            1. Read the example of a TP proposal: <?php echo $this->Html->link('[Example]', '/files/TP_Proposal_Example.pdf', array('target'=>'_blank')); ?> <br/>
            2. Complete the TP form, link below. Be aware which ISU program can this TP be held.
        </div>
        
        <?php echo $this->Html->link('I have a TP idea !', array('controller'=>'apply', 'action'=>'project', 'add'), array('class'=>'btn btn-primary'));?>

      </div>
    </div>

</div>

</div>


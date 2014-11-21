<?php
  $controller = $this->request->params['controller'];
  $action = $this->request->params['action'];
  $user_id = $this->Session->read('Auth.User.id'); 
  $group_id = $this->Session->read('Auth.User.group_id'); 
?>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-head-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    <a href=<?php echo $this->Html->url('/');?> class="navbar-brand"> ISU Involve </a>
  </div>

  <div class="collapse navbar-collapse navbar-head-collapse">
    <ul class="nav navbar-nav">
      <?php if (isset($user_id)) : ?>
        <li class="<?php echo ($controller=='apply'&&$action!='view_all') ? 'active' :''; ?>">
          <?php echo $this->Html->link('<span class="glyphicon glyphicon-cloud-upload"></span> Get Involved', array('controller'=>'apply', 'action'=>'index'), array('escape'=>false)); ?>
        </li>
        <li class="<?php echo ($controller=='apply'&&$action=='view_all') ? 'active' :''; ?>">
          <?php echo $this->Html->link('<span class="glyphicon glyphicon-briefcase"></span> My Applications', array('controller'=>'apply', 'action'=>'view_all'), array('escape'=>false)); ?>
        </li>
      <?php endif; ?>
   </ul>

    <ul class="nav navbar-nav navbar-right">
      <?php if (isset($user_id)) : ?>
          <?php if ($group_id == 99) : ?>
            <li class="<?php echo ($controller=='admin') ? 'active' :''; ?>">
              <?php echo $this->Html->link('<span class="glyphicon glyphicon-tower"></span> Admin', array('controller'=>'admin', 'action'=>'index'), array('escape'=>false)); ?>
            </li>
          <?php elseif ($group_id == 20) : ?>
            <li class="<?php echo ($controller=='chair') ? 'active' :''; ?>">
              <?php echo $this->Html->link('<span class="glyphicon glyphicon-saved"></span> Chair', array('controller'=>'chair', 'action'=>'index'), array('escape'=>false)); ?>
            </li>
          <?php endif; ?>

          <li  class="<?php echo ($controller=='users') ? 'active' :''; ?>">
            <?php echo $this->Html->link('<span class="glyphicon glyphicon-user"></span> My Account', array('controller'=>'users', 'action'=>'index'), array('escape'=>false)); ?>
          </li>
          <li>
            <?php echo $this->Html->link('<span class="glyphicon glyphicon-log-out"></span> Sign Out', array('controller'=>'users', 'action'=>'logout'), array('escape'=>false)); ?>
          </li>
      <?php else : ?>
          <li>
            <?php echo $this->Html->link('<span class="glyphicon glyphicon-log-in"></span> Sign In', array('controller'=>'users', 'action'=>'login'), array('escape'=>false)); ?>
          </li>
          <li>
            <?php echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Create Account', array('controller'=>'users', 'action'=>'signup'), array('escape'=>false)); ?>
          </li>
      <?php endif; ?>
    </ul>
  
  </div><!-- /.nav-collapse -->
  </div><!-- /.container -->
</div>
<!DOCTYPE html>

<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo "Involve - ".$title_for_layout; ?>
    </title>
    <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('bootstrap.min.css');
        echo $this->Html->css('app.css');
        echo $this->Html->css('debug.css');
        //echo $this->Html->css('cake.generic.css');

        echo $this->Html->script('jquery-1.9.1.min.js');
        echo $this->Html->script('bootstrap.min.js');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>

<body>
    <div id="body-wrapper">
        <?php echo $this->element('header')?>

        <div id="content" class="container">
            <div class="row">
                <div class="col-md-2">
                    <?php echo $this->element('backend-left-col'); ?>
                </div>
                <div class="col-md-10">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>
        </div>

        <div id="footer">
            <?php echo $this->element('footer')?>
        </div>
    </div>
    <?php echo $this->Js->writeBuffer(); ?>
</body>
</html>

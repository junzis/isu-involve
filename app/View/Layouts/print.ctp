<!DOCTYPE html>
<html>

<head>
    <?php echo $this->Html->charset('utf-8'); ?>
    <title>
        <?php echo "ISU TP Proposal" ?>
    </title>
    <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('bootstrap.min.css');
        echo $this->Html->css('print.css');
    ?>
</head>

<body onload="window.print();">
    <div id="content">
        <?php echo $this->fetch('content'); ?>
    </div>
</body>

</html>

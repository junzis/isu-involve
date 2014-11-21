<?php

function getFileSize($bits){
    if ($bits < 1000){
        return $bits . 'B';
    } elseif ($bits >=1000 && $bits < 1000000) {
        return (int) ($bits/1024) . 'KB'; 
    } else {
        return (int) ($bits/1048576) . 'MB'; 
    }
}

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

$db_dumps_path = WWW_ROOT . 'db_backups';

$dir = new Folder($db_dumps_path);
$files = array_reverse($dir->find('.*\.sql'));      // reverse array, so newer files are in the beginning

// $sql_dumps = glob($db_dumps_dir.'*.{sql}', GLOB_BRACE);

// debug($sql_dumps);

?>

<div class="pull-right">
    <?php echo $this->Html->link('<span class="glyphicon glyphicon-hdd"></span> Create a Backup Now', array('controller'=>'admin', 'action'=>'create_db_backup'), array('class'=>'btn btn-warning', 'escape'=>false)); ?>
</div>

<h3>Manage DB Backups</h3>

<hr/>

<table class="table table-bordered">
    <thead>
        <th>Previously Saved Backup Files</th>
        <th>Size</th>
        <th>Created on</th>
        <th></th>
    </thead>
<?php
foreach ($files as $filename) {
    $file = new File($dir->pwd() . DS . $filename);
    echo '<tr>';
    echo '<td>';
    echo '<strong>'.$filename.'</strong>'; 
    echo '</td>';
    echo '<td>';
    echo getFileSize($file->size()); 
    echo '</td>';
    echo '<td>';
    echo date('Y-m-d h:i:s A', $file->LastChange()); 
    echo '</td>';
    echo '<td align="right">';
    echo $this->Html->link('Download', array('controller'=>'admin', 'action'=>'download_db_backup', $filename), array('class'=>'btn btn-xs btn-default'));
    echo ' ';
    echo $this->Html->link('Delete', array('controller'=>'admin', 'action'=>'delete_db_backup', $filename), 
                            array('class'=>'btn btn-xs btn-default'),
                            "Are you sure to delete this backup file, created on date:".date('Y-m-d h:i:s A', $file->LastChange()));
    echo '</td>';
    echo '</tr>';
}
?>

</table>

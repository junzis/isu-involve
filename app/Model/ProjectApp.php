<?php
class ProjectApp extends AppModel {
    
    public $name = 'ProjectApp';
    
    public $belongsTo = array('User');

    public $validate = array(
        'title'         => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'description'   => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'program'   	=> array('rule' => 'notEmpty', 'message' => 'x Required'),
    );
}
?>
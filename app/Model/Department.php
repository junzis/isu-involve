<?php
class Department extends AppModel {
    
    public $name = 'Department';
    
    public $validate = array(
        'name' => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'abbr' => array('rule' => 'notEmpty', 'message' => 'x Required'),
    );
}
?>
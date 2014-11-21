<?php
class ActivityAppsDepartment extends AppModel {
    
    public $name = 'ActivityAppsDepartment';
    
    public $belongsTo = array('ActivityApp', 'Department');
    
    public $validate = array(
        'activity_app_id' => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'department_id'   => array('rule' => 'notEmpty', 'message' => 'x Required'),
    );
}
?>
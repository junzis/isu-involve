<?php
class DepartmentTaApp extends AppModel {
    
    public $name = 'DepartmentTaApp';
    
    public $belongsTo = array('User', 'Department');
    
    public $validate = array(
        'user_id'           => array('rule' => 'notEmpty', 'required'=>true, 'message' => 'x Required'),
        'department_id'     => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'description'       => array('rule' => 'notEmpty', 'message' => 'x Required'),
    );
}
?>
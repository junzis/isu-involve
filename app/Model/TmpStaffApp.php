<?php
class TmpStaffApp extends AppModel {
    
    public $name = 'TmpStaffApp';
    
    public $belongsTo = array('User');
    
    public $validate = array(
        'user_id'          => array('rule' => 'notEmpty', 'required'=>true, 'message' => 'x Required'),
        'tmp_staff_id'     => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'description'      => array('rule' => 'notEmpty', 'message' => 'x Required'),
    );
}
?>
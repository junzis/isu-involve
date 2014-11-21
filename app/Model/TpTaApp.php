<?php
class TpTaApp extends AppModel {
    
    public $name = 'TpTaApp';
    
    public $belongsTo = array('User', 'Tp');
    
    public $validate = array(
        'user_id'           => array('rule' => 'notEmpty', 'required'=>true, 'message' => 'x Required'),
        'department_id'     => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'description'       => array('rule' => 'notEmpty', 'message' => 'x Required'),
    );
}
?>
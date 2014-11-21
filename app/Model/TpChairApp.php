<?php
class TpChairApp extends AppModel {
    
    public $name = 'TpChairApp';
    
    public $belongsTo = array('User', 'Tp');
    
    public $validate = array(
        'user_id'           => array('rule' => 'notEmpty', 'required'=>true, 'message' => 'x Required'),
        'tp_id'             => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'description'       => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'is_attend_cpm'     => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'is_time_commit'    => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'is_transport_need' => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'is_lodging_need'   => array('rule' => 'notEmpty', 'message' => 'x Required'),
    );
}
?>
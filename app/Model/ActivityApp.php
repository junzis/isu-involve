<?php
class ActivityApp extends AppModel {
    
    public $name = 'ActivityApp';
    
    public $belongsTo = array('User');

    public $hasAndBelongsToMany = array('Department');

    public $order = array('ActivityApp.year'=>'desc');

    public $validate = array(
        'title'         => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'description'   => array('rule' => 'notEmpty', 'message' => 'x Required'),
        // 'is_ws'          => array('rule' => 'notEmpty', 'message' => 'x Required'),
        // 'is_da'          => array('rule' => 'notEmpty', 'message' => 'x Required'),
    );
}
?>
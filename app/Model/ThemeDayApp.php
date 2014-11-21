<?php
class ThemeDayApp extends AppModel {
    
    public $name = 'ThemeDayApp';
    
    public $belongsTo = array('User');
    
    public $validate = array(
        'user_id'       => array('rule' => 'notEmpty', 'required'=>true, 'message' => 'x Required'),
        'title'         => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'description'   => array('rule' => 'notEmpty', 'message' => 'x Required'),
    );
}
?>
<?php
class Tp extends AppModel {
    
    public $name = 'Tp';
    
    public $validate = array(
        'name' => array('rule' => 'notEmpty', 'message' => 'x Required'),
    );
}
?>
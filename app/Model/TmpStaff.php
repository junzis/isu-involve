<?php
class TmpStaff extends AppModel {
    
    public $name = 'TmpStaff';
    
    public $validate = array(
        'title'    => array('rule' => 'notEmpty', 'message' => 'x Required'),
    );
}
?>
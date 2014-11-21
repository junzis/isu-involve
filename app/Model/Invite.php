<?php
class Invite extends AppModel {
    
    public $name = 'Invite';
    
    public $belongsTo = array('User');
    
    public $validate = array(
        'date_start' => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'date_end' => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'is_isu_cover_travel' => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'is_isu_cover_lodging' => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'departure_city_country' => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'departure_airport' => array('rule' => 'notEmpty', 'message' => 'x Required'),
    );


}
?>
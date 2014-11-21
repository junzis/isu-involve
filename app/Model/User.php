<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    
    public $name = 'User';
    
    public $belongsTo = array('Group');

    public $hasOne = array('Invite');
    
    public $validate = array(
        'email' => array(
            'email'=>array(
                'rule' => 'email',
                'message' => 'X Must be a valid email address'
            ),
            'unique' => array(
                'rule'=>'isUnique',
                'message' => 'X This email is already registered.'
            )
        ),
        
        'password' => array('rule' => 'notEmpty', 'message' => 'x Required'),
        
        'password_confirm' => array(
            array(
                'rule' => array('validateMatch', 'password', 'password_confirm'),
                'message' => 'X Password not match'
            )
        ),
        
        'title' => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'first_name' => array('rule' => 'notEmpty', 'message' => 'x Required'),
        'last_name' => array('rule' => 'notEmpty', 'message' => 'x Required'),
    );

    public $virtualFields = array(
        'name' => 'CONCAT(User.first_name, " ", User.last_name)'
    );
    
    public function beforeSave($options = array()) {
        if (!empty($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        }
        return true;
    }

    /**
     * Checks two fields to see if they are equal, for password confirm
     */
    function validateMatch($checkData, $field1, $field2) {
        
        if (isset($this->data[$this->name][$field1]) && isset($this->data[$this->name][$field2])) {
            return $this->data[$this->name][$field1] == $this->data[$this->name][$field2];
        }
        
        return false;
    }

}
?>
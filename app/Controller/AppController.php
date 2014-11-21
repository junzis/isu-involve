<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array('Session', 'Auth', /*'DebugKit.Toolbar'*/);

    public $helpers = array('Session', 'Html', 'Form', 'Paginator', 'Js');

    public $uses = array('User', 'SiteConfig', 'Department', 'Tp', 'TmpStaff');

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->authenticate = array(
            'Form' => array(
                'fields' => array('username' => 'email', 'password' => 'password'),
            ),
        );

        $this->Auth->loginRedirect = '/';

        $this->__check_user_info_completion();

        $this->__read_db_site_config();
    }

    private function __read_db_site_config(){
        $site_configs = $this->SiteConfig->find('all');

        foreach ($site_configs as $sc) {
            Configure::write('SiteConfig.'.$sc['SiteConfig']['name'], $sc['SiteConfig']['value']);
        }
    }

    private function __check_user_info_completion(){
        $uid = $this->Session->read('Auth.User.id');
        $check_fields = array('email', 'title', 'first_name', 'last_name', 'isu_experience', 'discipline_areas', 'bio', 'address', 'city', 'country');

        if($uid > 0) {
            $this->User->recursive = -1;
            $user = $this->User->findById($this->Auth->user('id'));
            $is_complete = true;
            $missing_fields = '';
            
            foreach ($user['User'] as $k => $v) {
                if(strlen($v) == 0 && in_array($k, $check_fields)) {
                    $missing_fields = $missing_fields.$k.', ';
                    $is_complete = false;
                }
            }

            if($is_complete){
                $this->set('user_info_complete', 1);
            } else {
                $this->set('user_info_complete', 0);
            }
        }
    }

    function __current_ssp_year(){
        return Configure::read('SiteConfig.current_year');
    }

    function __uid(){
        return $this->Auth->user('id');
    }

    function __is_admin(){
        $user= $this->Auth->user();
        if ($user['group_id'] == 99) {
            return true;
        } else {
            return false;
        }
    }

    function __is_backend_user(){
        if($this->__get_group_id() >= 20){
            return true;
        } else {
            return false;
        }
    }

    function __get_group_id(){
        $user= $this->Auth->user();
        return $user['group_id'];
    }

    function __check_record($model, $id){
        $res = $this->$model->find('count', array('conditions'=>array($model.'.id'=>$id)));
        if($res > 0) {
            return true;
        } else {
            return false;
        }
    }

    function __get_departments(){
        $departments = $this->Department->find('list', array('fields'=>array('id', 'name'), 'order'=>'abbr'));
        return $departments;
    }

    function __get_tps(){
        $tps = $this->Tp->find('list', array('fields'=>array('id', 'name')));
        return $tps;
    }

    function __get_tmp_staff(){
        $tps = $this->TmpStaff->find('list', array('fields'=>array('id', 'title')));
        return $tps;
    }

}

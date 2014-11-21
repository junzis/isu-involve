<?php
class ApplyController extends AppController {

    public $uses = array('User', 'Department', 'Tp', 'TmpStaff', 'CoreChairApp', 'DepartmentChairApp', 'TpChairApp',
        'DepartmentTaApp', 'TpTaApp', 'TmpStaffApp', 'ActivityApp', 'ActivityAppsDepartment', 'ThemeDayApp', 'ProjectApp', 'Invite');

    function beforeFilter() {
        parent::beforeFilter();
        // if($this->request->is('Post')){ debug($this->request->data);}
    }

    function index() {
        $uid = $this->__uid();
        
        // $this->CoreChairApp->recursive = -1;
        // $this->DepartmentChairApp->recursive = -1;
        // $this->TpChairApp->recursive = -1;
        // $this->DepartmentTaApp->recursive = -1;
        // $this->TpTaApp->recursive = -1;
        // $this->TmpStaffApp->recursive = -1;

        // $core_chair_apps = $this->CoreChairApp->findAllByUserId($uid);
        // $department_chair_apps = $this->DepartmentChairApp->findAllByUserId($uid);
        // $tp_chair_apps = $this->TpChairApp->findAllByUserId($uid);
        // $department_ta_apps = $this->DepartmentTaApp->findAllByUserId($uid);
        // $tp_ta_apps = $this->TpTaApp->findAllByUserId($uid);
        // $tmp_staff_apps = $this->TmpStaffApp->findAllByUserId($uid);
        // $activity_apps = $this->ActivityApp->findAllByUserId($uid);
        // $core_lecture_apps = $this->CoreLectureApp->findAllByUserId($uid);

        // $this->set(compact('core_chair_apps', 'department_chair_apps', 
        //     'tp_chair_apps', 'department_ta_apps', 'tp_ta_apps', 'tmp_staff_apps', 'activity_apps', 'core_lecture_apps'));

        // debug($core_chair_apps);
        // debug($department_chair_apps);
        // debug($tp_chair_apps);
        // debug($department_ta_apps);
        // debug($tp_ta_apps);
        // debug($tmp_staff_apps);

        // check if there is an invitation
        $invite = $this->Invite->findByUserId($uid);
        $this->set(compact('invite'));
    }

    function view_all(){

        $uid = $this->__uid();
        $core_chair_apps = $this->CoreChairApp->findAllByUserId($uid);
        $department_chair_apps = $this->DepartmentChairApp->findAllByUserId($uid);
        $tp_chair_apps = $this->TpChairApp->findAllByUserId($uid);
        $department_ta_apps = $this->DepartmentTaApp->findAllByUserId($uid);
        $tp_ta_apps = $this->TpTaApp->findAllByUserId($uid);
        $tmp_staff_apps = $this->TmpStaffApp->findAllByUserId($uid);

        $this->ActivityApp->Behaviors->load('Containable');
        $this->ActivityApp->contain('Department.abbr');
        $activity_apps = $this->ActivityApp->findAllByUserId($uid);

        // $core_lecture_apps = $this->CoreLectureApp->findAllByUserId($uid);
        $theme_day_apps = $this->ThemeDayApp->findAllByUserId($uid);

        $project_apps = $this->ProjectApp->findAllByUserId($uid);

        $this->set(compact('core_chair_apps', 'department_chair_apps', 'tp_chair_apps', 
            'department_ta_apps', 'tp_ta_apps', 'tmp_staff_apps', 'activity_apps', 'theme_day_apps', 'project_apps'));

        $departments = $this->__get_departments();
        $this->set(compact('departments'));

        $tps = $this->__get_tps();
        $this->set(compact('tps'));

        $tmp_staffs = $this->__get_tmp_staff();
        $this->set(compact('tmp_staffs'));
    }

    function core_chair($act, $id=null){
        
        $act = $this->__check_chair_deadline($act);

        $this->set(compact('act'));

        if( $act === 'add' )
            $this->__data_add_handler('CoreChairApp', $id);
        
        elseif ( $act === 'update')
            $this->__data_update_handler('CoreChairApp', $id);

        elseif ( $act === 'delete' && $id>0 )
            $this->__data_delete_handler('CoreChairApp', $id);

        else{
            $this->redirect(array('action'=>'view_all'));
        }
    }

    function department_chair($act, $id=null){

        $act = $this->__check_chair_deadline($act);
        
        $departments = $this->__get_departments();
        $this->set(compact('departments'));

        $this->set(compact('act'));

        if( $act === 'add' )
            $this->__data_add_handler('DepartmentChairApp', $id);
        
        elseif ( $act === 'update')
            $this->__data_update_handler('DepartmentChairApp', $id);

        elseif ( $act === 'delete' && $id>0 )
            $this->__data_delete_handler('DepartmentChairApp', $id);

        else{
            $this->redirect(array('action'=>'view_all'));
        }

    }

    function tp_chair($act, $id=null){

        $act = $this->__check_chair_deadline($act);
        
        $tps = $this->__get_tps();
        $this->set(compact('tps'));

        $this->set(compact('act'));

        if( $act === 'add' )
            $this->__data_add_handler('TpChairApp', $id);
        
        elseif ( $act === 'update')
            $this->__data_update_handler('TpChairApp', $id);

        elseif ( $act === 'delete' && $id>0 )
            $this->__data_delete_handler('TpChairApp', $id);

        else{
            $this->redirect(array('action'=>'view_all'));
        }

    }

    function department_ta($act, $id=null){

        $act = $this->__check_staff_deadline($act);
        
        $departments = $this->__get_departments();
        $this->set(compact('departments'));

        $this->set(compact('act'));

        if( $act === 'add' )
            $this->__data_add_handler('DepartmentTaApp', $id);
        
        elseif ( $act === 'update')
            $this->__data_update_handler('DepartmentTaApp', $id);

        elseif ( $act === 'delete' && $id>0 )
            $this->__data_delete_handler('DepartmentTaApp', $id);

        else{
            $this->redirect(array('action'=>'view_all'));
        }

    }

    function tp_ta($act, $id=null){

        $act = $this->__check_staff_deadline($act);
        
        $tps = $this->__get_tps();
        $this->set(compact('tps'));

        $this->set(compact('act'));

        if( $act === 'add' )
            $this->__data_add_handler('TpTaApp', $id);
        
        elseif ( $act === 'update')
            $this->__data_update_handler('TpTaApp', $id);

        elseif ( $act === 'delete' && $id>0 )
            $this->__data_delete_handler('TpTaApp', $id);

        else{
            $this->redirect(array('action'=>'view_all'));
        }

    }

    function tmp_staff($act, $id=null){

        $act = $this->__check_staff_deadline($act);
        
        $tmp_staffs = $this->__get_tmp_staff();
        $this->set(compact('tmp_staffs'));

        $this->set(compact('act'));

        if( $act === 'add' )
            $this->__data_add_handler('TmpStaffApp', $id);
        
        elseif ( $act === 'update')
            $this->__data_update_handler('TmpStaffApp', $id);

        elseif ( $act === 'delete' && $id>0 )
            $this->__data_delete_handler('TmpStaffApp', $id);

        else{
            $this->redirect(array('action'=>'view_all'));
        }

    }

    function activity($act, $id=null){

        $act = $this->__check_staff_deadline($act);
        
        $departments = $this->__get_departments();
        $this->set(compact('departments'));

        $this->set(compact('act'));

        if( $act === 'add' ) {
            $this->Session->write('apply.back_action', 'index');

            if($this->request->is('post')){
                $app = $this->request->data;
                $app['ActivityApp']['id'] = '';                        // set id to empty, avoid enjection hacking
                $app['ActivityApp']['user_id'] = $this->__uid();

                if($app['ActivityApp']['is_ws']==0 && $app['ActivityApp']['is_da']==0){
                    $this->Session->setFlash('Please indicate the type of this activity (workshop or/and department)!', 'flash-red');
                    return;
                }

                if ($this->ActivityApp->saveAll($app)) {
                    
                    $activity_app_id = $this->ActivityApp->id;

                    // save all department info
                    if($app['ActivityApp']['is_da'] > 0){
                        foreach ($app['Dept'] as $dept_id => $v) {
                            if($v > 0){
                                $aad = array();
                                $aad['id'] = '';
                                $aad['activity_app_id'] = $activity_app_id;
                                $aad['department_id'] = $dept_id;
                                $this->ActivityAppsDepartment->save($aad);
                            }
                        }
                    }

                    $this->Session->setFlash('Application Saved.', 'flash-green');
                    $this->redirect(array('action'=>'view_all'));
                } else {
                    $this->Session->setFlash('Error, can not save your application.', 'flash-red');
                }
            }
        } elseif ($act == 'update') {
            $this->Session->write('apply.back_action', 'view_all');
            $model = 'ActivityApp';
            if(!$this->__is_owner($model, $id)){
                $this->redirect(array('action'=>'view_all'));
                return;
            }

            if($this->request->is('post')){
                $app = $this->request->data;
                $app[$model]['user_id'] = $this->__uid();

                if(!$this->__is_owner($model, $app[$model]['id'])){
                    $this->redirect(array('action'=>'view_all'));
                    return;
                }

                if($app['ActivityApp']['is_ws']==0 && $app['ActivityApp']['is_da']==0){
                    $this->Session->setFlash('Please indicate the type of this activity (workshop or/and department)!', 'flash-red');
                    return;
                }

                // first delete all departments related with this application
                $this->ActivityAppsDepartment->deleteAll(array('activity_app_id'=>$app['ActivityApp']['id']));

                if ($this->$model->saveAll($app)) {
                    $activity_app_id = $this->ActivityApp->id;

                    // save all department info
                    if($app['ActivityApp']['is_da'] > 0){
                        foreach ($app['Dept'] as $dept_id => $v) {
                            if($v > 0){
                                $aad = array();
                                $aad['id'] = '';
                                $aad['activity_app_id'] = $activity_app_id;
                                $aad['department_id'] = $dept_id;
                                $this->ActivityAppsDepartment->save($aad);
                            }
                        }
                    }
                    $this->Session->setFlash('Application Saved.', 'flash-green');
                    $this->redirect(array('action'=>'view_all'));
                } else {
                    $this->Session->setFlash('Error, can not save your application.', 'flash-red');
                }
            }

            $app = $this->$model->findById($id);

            // set department check array
            foreach ($app['Department'] as $d) {
                $app['Dept'][$d['id']] = 1;
            }

            $this->data = $app;

        } elseif ($act == 'delete'){
            $app = $this->ActivityApp->findById($id);

            if ($app['ActivityApp']['user_id'] == $this->__uid()){
                if($this->ActivityApp->delete($id, true)){
                    $this->Session->setFlash('Application deleted.', 'flash-green');
                } else {
                    $this->Session->setFlash('Error, can not delete this application.', 'flash-red');
                }
                $this->redirect(array('action'=>'view_all'));
            }
        } else{
            $this->redirect(array('action'=>'view_all'));
        }
    }

    function carry_over($id=null){
        
        $act = 'add';

        $act = $this->__check_staff_deadline($act);
        
        $departments = $this->__get_departments();
        $this->set(compact('departments'));

        $activity = $this->ActivityApp->findById($id);
        // debug($activity);
        $this->request->data = $activity;
        $this->set('act', $act);
        $this->render('activity');

    }
    
    // Core Lecture application removed
    /*
    function core_lecture($act, $id=null){

        $act = $this->__check_staff_deadline($act);
        
        $this->set(compact('act'));

        if( $act === 'add' )
            $this->__data_add_handler('CoreLectureApp', $id);
        
        elseif ( $act === 'update')
            $this->__data_update_handler('CoreLectureApp', $id);

        elseif ( $act === 'delete' && $id>0 )
            $this->__data_delete_handler('CoreLectureApp', $id);

        else{
            $this->redirect(array('action'=>'view_all'));
        }
    } */

    function theme_day($act, $id=null){

        $act = $this->__check_staff_deadline($act);
        
        $this->set(compact('act'));

        if( $act === 'add' )
            $this->__data_add_handler('ThemeDayApp', $id);
        
        elseif ( $act === 'update')
            $this->__data_update_handler('ThemeDayApp', $id);

        elseif ( $act === 'delete' && $id>0 )
            $this->__data_delete_handler('ThemeDayApp', $id);

        else{
            $this->redirect(array('action'=>'view_all'));
        }
    }

    function project($act, $id=null){
        $this->set(compact('act'));

        if( $act === 'add' )
            $this->__data_add_handler('ProjectApp', $id);
        
        elseif ( $act === 'update')
            $this->__data_update_handler('ProjectApp', $id);

        elseif ( $act === 'delete' && $id>0 )
            $this->__data_delete_handler('ProjectApp', $id);

        else{
            $this->redirect(array('action'=>'view_all'));
        }
    }

    function back(){
        $back = $this->Session->read('apply.back_action');

        if($back === 'view_all'){
            $this->Session->delete('apply.back_action');
            $this->redirect(array('action'=>'view_all'));
        } else {
            $this->redirect(array('action'=>'index'));
        }
    }

    function __data_add_handler($model){

        $this->Session->write('apply.back_action', 'index');

        if($this->request->is('post')){
            $app = $this->request->data;
            $app[$model]['id'] = '';                        // set id to empty, avoid enjection hacking
            $app[$model]['user_id'] = $this->__uid();

            if ($this->$model->save($app)) {
                $this->Session->setFlash('Application Saved.', 'flash-green');
                $this->redirect(array('action'=>'view_all'));
            } else {
                $this->Session->setFlash('Error, can not save your application.', 'flash-red');
            }
        }
    }

    function __data_update_handler($model, $id=null){
        
        $this->Session->write('apply.back_action', 'view_all');

        if(!$this->__is_owner($model, $id)){
            $this->redirect(array('action'=>'view_all'));
            return;
        }

        if($this->request->is('post')){
            $app = $this->request->data;
            $app[$model]['user_id'] = $this->__uid();

            if(!$this->__is_owner($model, $app[$model]['id'])){
                $this->redirect(array('action'=>'view_all'));
                return;
            }

            if ($this->$model->save($app)) {
                $this->Session->setFlash('Application Saved.', 'flash-green');
                $this->redirect(array('action'=>'view_all'));
            } else {
                $this->Session->setFlash('Error, can not save your application.', 'flash-red');
            }
        }

        $app = $this->$model->findById($id);
        $this->data = $app;
    }

    function __data_delete_handler($model, $id){
        $app = $this->$model->findById($id);
        
        if ($app[$model]['user_id'] == $this->__uid()){
            if($this->$model->delete($id)){
                $this->Session->setFlash('Application deleted.', 'flash-green');
            } else {
                $this->Session->setFlash('Error, can not delete this application.', 'flash-red');
            }
            $this->redirect(array('action'=>'view_all'));
        }
    }

    function __is_owner($model, $id=null){

        if(!isset($id) || $id==''){
            return true;
        }

        $uid = $this->__uid();

        $count = $this->$model->find('count', 
            array('conditions'=>array($model.'.id'=>$id, $model.'.user_id'=>$this->__uid() )));

        if($count > 0){
            return true;
        } else {
            $this->Session->setFlash('Error, you can not update this application.', 'flash-red');
            return false;
        }
    }

    function __have_vlinfo(){
        $user = $this->User->findById($this->__uid());

        $check_fields = array('discipline_areas', 'date_start', 'date_end');
        $is_complete = true;

        foreach ($user['User'] as $k => $v) {
            if(in_array($k, $check_fields)){
                if(strlen($v)<=0){
                    $is_complete = false;
                    break;
                }
            }
        }

        if(!$is_complete){
            $this->Session->setFlash('All fields with (*) need to be completed.', 'flash-red');
        }

        return $is_complete;
    }

    function __check_chair_deadline($act){
        $is_chair_app_on = Configure::read('SiteConfig.is_chair_app_on');

        if($this->__has_user_deadline_exception()){
            return $act;
        }
        
        if(!$is_chair_app_on){
            if($act != 'view') {
                $this->Session->setFlash('Deadline has passed for Chair Applications, you applications now are read only. Thanks.', 'flash-blue');
                $new_act = 'view';
                return $new_act;
            }
        } else {
            return $act;
        }
    }

    function __check_staff_deadline($act){
        $is_staff_app_on = Configure::read('SiteConfig.is_staff_app_on');

        if($this->__has_user_deadline_exception()){
            return $act;
        }

        if(!$is_staff_app_on){
            if($act != 'view') {
                $this->Session->setFlash('Deadline has passed for Staff, TA, and Lecturers Applications, you applications now are read only. Thanks.', 'flash-blue');

                $new_act = 'view';
                return $new_act;
            }
        } else {
            return $act;
        }
    }

    function __has_user_deadline_exception(){
        $user = $this->User->findById($this->__uid());
        if ($user['User']['deadline_exception']){
            return true;
        }
        return false;
    }
}
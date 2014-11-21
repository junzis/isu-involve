<?php
class AdminController extends AppController {

    public $uses = array('Group', 'User', 'Department', 'Tp', 'TmpStaff', 'CoreChairApp', 'DepartmentChairApp', 'TpChairApp',
        'DepartmentTaApp', 'TpTaApp', 'TmpStaffApp', 'ActivityApp', 'ActivityAppsDepartment', 'ThemeDayApp', 'ProjectApp', 'Invite');

    public $paginate = array(
        'User' => array(
            'limit' => 30, 
            'order' => array('group_id'=>'desc'),
            'fields' => array('Group.id', 'Group.name', 'id', 'group_id', 'email', 'first_name', 'last_name', 'title', 'country'),
        ),

        'ActivityApp' => array(
            'limit' => 30, 
            'order' => array('User.first_name'=>'asc'),
        ),

        'ThemeDayApp' => array(
            'limit' => 30, 
            'order' => array('User.first_name'=>'asc'),
        ),

        'ProjectApp' => array(
            'limit' => 30, 
            'order' => array('User.first_name'=>'asc'),
        ),

    );

    function beforeFilter() {
        parent::beforeFilter();

        if (!$this->__is_admin()) {
            $this->Session->setFlash('Access denied! Administrator only', 'flash-red');
            $this->redirect('/');
        }

        $this->layout = 'backend';
    }


    function index() {
        
    }

    function apps(){
        $core_chair_apps_count = $this->CoreChairApp->find('count');
        $department_chair_apps_count = $this->DepartmentChairApp->find('count');
        $tp_chair_apps_count = $this->TpChairApp->find('count');
        $department_ta_apps_count = $this->DepartmentTaApp->find('count');
        $tp_ta_apps_count = $this->TpTaApp->find('count');
        $tmp_staff_apps_count = $this->TmpStaffApp->find('count');
        $activity_apps_count = $this->ActivityApp->find('count', array('conditions'=>array('year'=>$this->__current_ssp_year())));
        $theme_day_apps_count = $this->ThemeDayApp->find('count');

        $this->set(compact(array('core_chair_apps_count', 'core_chair_apps_count', 'tp_chair_apps_count', 
            'department_chair_apps_count', 'tp_ta_apps_count', 'department_ta_apps_count', 'tmp_staff_apps_count',
            'activity_apps_count', 'theme_day_apps_count')));
    }

    function core_chair_apps(){
        $core_chair_apps = $this->CoreChairApp->find('all', array('order'=>'CoreChairApp.selected desc, User.first_name asc'));
        $this->set(compact('core_chair_apps'));
    }

    function department_chair_apps(){
        $department_chair_apps = $this->DepartmentChairApp->find('all', array('order'=>'DepartmentChairApp.selected desc, Department.abbr asc'));
        $this->set(compact('department_chair_apps'));
    }

    function tp_chair_apps(){
        $tp_chair_apps = $this->TpChairApp->find('all', array('order'=>'TpChairApp.selected desc, Tp.name asc'));
        $this->set(compact('tp_chair_apps'));
    }

    function department_ta_apps(){
        $department_ta_apps = $this->DepartmentTaApp->find('all',  array('order'=>'DepartmentTaApp.selected desc, Department.abbr asc'));
        $this->set(compact('department_ta_apps'));
    }

    function tp_ta_apps(){
        $tp_ta_apps = $this->TpTaApp->find('all', array('order'=>'TpTaApp.selected desc, Tp.name asc'));
        $this->set(compact('tp_ta_apps'));
    }

    function tmp_staff_apps(){
        $tmp_staff_apps = $this->TmpStaffApp->find('all', array('order'=>'TmpStaffApp.selected desc, tmp_staff_id asc'));
        $this->set(compact('tmp_staff_apps'));

        $tmp_staffs = $this->__get_tmp_staff();
        $this->set(compact('tmp_staffs'));
    }

    function edit_activity_app($id){
        $departments = $this->Department->find('list', array('fields'=>array('id', 'name')));
        $this->set(compact('departments'));

        if($this->request->is('post')){
            $app = $this->request->data;

            if($app['ActivityApp']['is_ws']==0 && $app['ActivityApp']['is_da']==0){
                $this->Session->setFlash('Please indicate the type of this activity (workshop or/and department)!', 'flash-red');
                return;
            }

            // first delete all departments related with this application
            $this->ActivityAppsDepartment->deleteAll(array('activity_app_id'=>$app['ActivityApp']['id']));

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
            } else {
                $this->Session->setFlash('Error, can not save the application.', 'flash-red');
            }
        }

        $app = $this->ActivityApp->findById($id);

        // set department check array
        foreach ($app['Department'] as $d) {
            $app['Dept'][$d['id']] = 1;
        }

        $this->data = $app;

        // debug($this->data);

    }

    function users(){
        $this->User->recursive = 1;
        $users = $this->paginate('User');
        
        $users = $this->__get_user_app_count($users);

        $this->set(compact('users'));
    }

    function search_users($keyword=null){
        if($this->request->is('post')){
            $keyword = $this->request->data['User']['search'];
            $this->redirect(array('action'=>'search_users', str_replace('/', '\\', $keyword)));
        }

        if(!isset($keyword)){
            $this->redirect(array('action'=>'users'));
        }

        $this->User->recursive = 1;
        $users = $this->paginate('User', array(
            'OR' => array(
                'User.name LIKE' => "%$keyword%",
                'User.email LIKE' => "%$keyword%",
            )
        ));

        $users = $this->__get_user_app_count($users);

        $this->request->data['User']['search'] = $keyword;
        $this->set(compact('users'));
        $this->render('users');
    }


    function user_delete() {
        $this->Session->setFlash('User deletion not allowed at this moment', 'flash-red');
        $this->redirect('users');
    }

    function user_change_group($uid) {

        if($uid <= 0){
            $this->redirect('users');
            return;
        }

        if(!empty($this->request->data)){
            $new_group_id = $this->request->data['User']['group_id'];

            if ($new_group_id > 0){
                $this->User->id = $uid;
                if($this->User->saveField('group_id', $new_group_id)) {
                    $this->Session->setFlash('User group updated.', 'flash-green');
                }
            }
            
        }

        $user = $this->User->findById($uid);
        $this->set(compact('user'));

        $groups = $this->Group->find('all');
        $groups = Set::combine($groups, '{n}.Group.id', '{n}.Group.name');
        $this->set(compact('groups'));

        $this->redirect(array('action'=>'user_settings', $uid));
    }


    function user_all_apps($uid){
        $user = $this->User->findById($uid);
        if(!isset($user['User'])){
            $this->redirect(array('controller'=>'admin', 'action'=>'users'));
            return;
        }

        $core_chair_apps = $this->CoreChairApp->findAllByUserId($uid);
        $department_chair_apps = $this->DepartmentChairApp->findAllByUserId($uid);
        $tp_chair_apps = $this->TpChairApp->findAllByUserId($uid);
        $department_ta_apps = $this->DepartmentTaApp->findAllByUserId($uid);
        $tp_ta_apps = $this->TpTaApp->findAllByUserId($uid);
        $tmp_staff_apps = $this->TmpStaffApp->findAllByUserId($uid);

        $this->ActivityApp->Behaviors->load('Containable');
        $this->ActivityApp->contain('Department.abbr');
        $activity_apps = $this->ActivityApp->findAllByUserId($uid);

        // $theme_day_apps = $this->CoreLectureApp->findAllByUserId($uid);

        $this->set(compact('core_chair_apps', 'department_chair_apps', 'tp_chair_apps', 
            'department_ta_apps', 'tp_ta_apps', 'tmp_staff_apps', 'activity_apps', 'theme_day_apps'));

        $departments = $this->__get_departments();
        $this->set(compact('departments'));

        $tps = $this->__get_tps();
        $this->set(compact('tps'));

        $tmp_staffs = $this->__get_tmp_staff();
        $this->set(compact('tmp_staffs'));

        $this->set(compact('user'));
    }

    function user_view($id){
        $user = $this->User->findById($id);
        if(!isset($user['User'])){
            $this->redirect(array('controller'=>'admin', 'action'=>'users'));
            return;
        }
        $this->set(compact('user'));
    }

    function user_settings($id){
        $user = $this->User->findById($id);
        if(!isset($user['User'])){
            $this->redirect(array('controller'=>'admin', 'action'=>'users'));
            return;
        }
        $this->set(compact('user'));

        $groups = $this->Group->find('all');
        $groups = Set::combine($groups, '{n}.Group.id', '{n}.Group.name');
        $this->set(compact('groups'));

    }

    function user_reset_passwd($id){

        if (!empty($this->request->data)) {
            
            if ($this->__validateChangePassword()) {
                
                $user = $this->User->find('first', array('conditions'=> array('id'=>$id), 
                    'fields'=>array('id', 'password', 'first_name', 'last_name')));
                $user['User']['password'] = $this->request->data['User']['newpassword1'];

                if($this->User->save($user)){
                    $this->Session->setFlash('Password reset successful.', 'flash-green');
                    $this->redirect(array('action'=>'user_settings', $id));
                } else {
                    $this->Session->setFlash('Can not change password.', 'flash-red');
                }
            }
        }

        $this->user_settings($id);
        $this->render('user_settings');
    }

    function user_view_cv($id){

        $user = $this->User->findById($id);
        if(!isset($user['User'])){
            $this->redirect(array('controller'=>'admin', 'action'=>'users'));
            return;
        }

        $cv_file_name = $user['User']['cv_file'];

        if(strlen($cv_file_name) > 0){
            $file = new File(WWW_ROOT.'user_cvs'.DS.$cv_file_name, false);
            if(!$file->exists()){
                // cv file not exsiting, remove the tag in DB, and redirect
                // $this->User->read('cv_file', $id);
                // $this->User->set('cv_file', NULL);
                // $this->User->save();

                $this->Session->setFlash('This PDF file is not existing anymore.', 'flash-red');                
                $this->redirect(array('controller'=>'admin', 'action'=>'user_view', $id));
                return;
            }
        }

        $this->viewClass = 'Media';

        $user = $this->User->findById($id);
        $cv_file = $user['User']['cv_file'];

        $params = array(
              'id' => $cv_file,
              //'name' => 'SSP-CV-'.$user['User']['first_name'].' '.$user['User']['last_name'],       // effective only for download
              'download' => false,
              'extension' => 'pdf',  // must be lower case
              'path' => WWW_ROOT . 'user_cvs' . DS   // don't forget terminal 'DS'
       );
       $this->set($params);
    }

    function users_with_deadline_exception(){
        $this->User->recursive = 1;
        $users = $this->User->findAllByDeadlineException(1);
        $this->set(compact('users'));
    }

    function user_permit_deadline_exception($uid){
        $this->User->id = $uid;
        $this->User->saveField('deadline_exception', 1);
        $this->redirect($this->referer());
    }

    function user_revoke_deadline_exception($uid){
        $this->User->id = $uid;
        $this->User->saveField('deadline_exception', 0);
        $this->redirect($this->referer());
    }


    function settings(){
        // read global settings
        $configs = $this->SiteConfig->find('all');
        $params['SiteConfig'] = Set::combine($configs, '{n}.SiteConfig.name', '{n}.SiteConfig.value');
        $this->data = $params;

    }

    function update_settings(){
        if (!empty($this->request->data)) {
            $configs = $this->request->data['SiteConfig'];
            foreach ($configs as $k => $v) {
                $this->SiteConfig->read(null, $k);
                $this->SiteConfig->set('value', $v);
                $res = $this->SiteConfig->save();
            }
            $this->Session->setFlash('Settings updated.', 'flash-green');
        }

        $this->redirect('settings');
    }

    function backup_db(){
    }

    function create_db_backup(){
        $db_dumps_dir = WWW_ROOT . 'db_backups' . DS;

        App::uses('ConnectionManager', 'Model');
        $dataSource = ConnectionManager::getDataSource('default');

        $user = $dataSource->config['login'];
        $passwd = $dataSource->config['password'];
        $db = $dataSource->config['database'];

        $timestamp = date('YmdHis');

        $cmd_export = 'mysqldump -u '.$user.' -p'.$passwd.' '.$db.' > '.$db_dumps_dir.'db-backup-'.$timestamp.'.sql';

        $output = shell_exec($cmd_export);

        $this->Session->setFlash('Backup Command Excuted. Check the following list for results.', 'flash-blue');

        $this->redirect('backup_db');
    }

    function download_db_backup($filename){
        $this->viewClass = 'Media';

        $params = array(
            'id'        => $filename,
            'download'  => true,
            'extension' => 'sql',
            'path'      =>  WWW_ROOT . 'db_backups' . DS
        );

        $this->set($params);
    }

    function delete_db_backup($filename){
        $file = new File(WWW_ROOT . 'db_backups' . DS . $filename);

        if($file->delete()){
            $this->Session->setFlash('File deleted.', 'flash-green');
        } else {
            $this->Session->setFlash('Can not delete file.', 'flash-red');
        }

        $this->redirect('backup_db');
    }

    function add_core_chair($appid){
        if(!$this->__check_record('CoreChairApp', $appid)){ return; }
        
        $this->CoreChairApp->id = $appid;
        $this->CoreChairApp->saveField('selected', 1);

        $this->Session->setFlash('New chair added.', 'flash-green');
        $this->redirect($this->referer());
    }

    function remove_core_chair($appid){
        if(!$this->__check_record('CoreChairApp', $appid)){ return; }
        
        $this->CoreChairApp->id = $appid;
        $this->CoreChairApp->saveField('selected', 0);

        $this->Session->setFlash('Chair removed.', 'flash-green');
        $this->redirect($this->referer());
    }

    function add_department_chair($appid){
        if(!$this->__check_record('DepartmentChairApp', $appid)){ return; }
        
        $this->DepartmentChairApp->id = $appid;
        $this->DepartmentChairApp->saveField('selected', 1);

        $this->Session->setFlash('New chair added.', 'flash-green');
        $this->redirect($this->referer());
    }

    function remove_department_chair($appid){
        if(!$this->__check_record('DepartmentChairApp', $appid)){ return; }
        
        $this->DepartmentChairApp->id = $appid;
        $this->DepartmentChairApp->saveField('selected', 0);

        $this->Session->setFlash('Chair removed.', 'flash-green');
        $this->redirect($this->referer());
    }

    function add_tp_chair($appid){
        if(!$this->__check_record('TpChairApp', $appid)){ return; }
        
        $this->TpChairApp->id = $appid;
        $this->TpChairApp->saveField('selected', 1);

        $this->Session->setFlash('New chair added.', 'flash-green');

        $this->redirect($this->referer());
    }

    function remove_tp_chair($appid){
        if(!$this->__check_record('TpChairApp', $appid)){ return; }
        
        $this->TpChairApp->id = $appid;
        $this->TpChairApp->saveField('selected', 0);

        $this->Session->setFlash('Chair removed.', 'flash-green');

        $this->redirect($this->referer());
    }

    function add_department_ta($appid){
        if(!$this->__check_record('DepartmentTaApp', $appid)){ return; }
        
        $this->DepartmentTaApp->id = $appid;
        $this->DepartmentTaApp->saveField('selected', 1);

        $this->Session->setFlash('New TA added.', 'flash-green');
        $this->redirect($this->referer());
    }

    function remove_department_ta($appid){
        if(!$this->__check_record('DepartmentTaApp', $appid)){ return; }

        $this->DepartmentTaApp->id = $appid;
        $this->DepartmentTaApp->saveField('selected', 0);

        $this->Session->setFlash('TA removed.', 'flash-green');
        $this->redirect($this->referer());
    }

    function add_tp_ta($appid){
        if(!$this->__check_record('TpTaApp', $appid)){ return; }

        $this->TpTaApp->id = $appid;
        $this->TpTaApp->saveField('selected', 1);

        $this->Session->setFlash('New TA added.', 'flash-green');
        $this->redirect($this->referer());
    }

    function remove_tp_ta($appid){
        if(!$this->__check_record('TpTaApp', $appid)){ return; }

        $this->TpTaApp->id = $appid;
        $this->TpTaApp->saveField('selected', 0);

        $this->Session->setFlash('TA removed.', 'flash-green');
        $this->redirect($this->referer());
    }

    function add_tmp_staff($appid){
        if(!$this->__check_record('TmpStaffApp', $appid)){ return; }

        $this->TmpStaffApp->id = $appid;
        $this->TmpStaffApp->saveField('selected', 1);

        $this->Session->setFlash('New Staff added.', 'flash-green');
        $this->redirect($this->referer());
    }

    function remove_tmp_staff($appid){
        if(!$this->__check_record('TmpStaffApp', $appid)){ return false; }

        $this->TmpStaffApp->id = $appid;
        $this->TmpStaffApp->saveField('selected', 0);

        $this->Session->setFlash('Staff removed.', 'flash-green');
        $this->redirect($this->referer());
    }

    function dearjohn_ta_staff(){

        $dept_ta_apps = $this->DepartmentTaApp->find('all', array('fields'=>array('id', 'selected', 'user_id'), 'order'=>'user_id asc'));
        $dept_ta_apps = Set::combine($dept_ta_apps, '{n}.DepartmentTaApp.id', '{n}.DepartmentTaApp.selected', '{n}.DepartmentTaApp.user_id');
        foreach ($dept_ta_apps as $k => $apps) {
            $is_seleted=array_sum($apps);
            $dept_ta_apps[$k] = $is_seleted;
        }
        $dept_ta_apps_uids = array_keys($dept_ta_apps);


        $tp_ta_apps = $this->TpTaApp->find('all', array('fields'=>array('id', 'selected', 'user_id'), 'order'=>'user_id asc'));
        $tp_ta_apps = Set::combine($tp_ta_apps, '{n}.TpTaApp.id', '{n}.TpTaApp.selected', '{n}.TpTaApp.user_id');
        foreach ($tp_ta_apps as $k => $apps) {
            $is_seleted=array_sum($apps);
            $tp_ta_apps[$k] = $is_seleted;
        }
        $tp_ta_apps_uids = array_keys($tp_ta_apps);

        $staff_apps = $this->TmpStaffApp->find('all', array('fields'=>array('id', 'selected', 'user_id'), 'order'=>'user_id asc'));
        $staff_apps = Set::combine($staff_apps, '{n}.TmpStaffApp.id', '{n}.TmpStaffApp.selected', '{n}.TmpStaffApp.user_id');
        foreach ($staff_apps as $k => $apps) {
            $is_seleted=array_sum($apps);
            $staff_apps[$k] = $is_seleted;
        }
        $staff_apps_uids = array_keys($staff_apps);

        // get all users who applied, regardless selected or not
        // merge all three arrays
        $uids = array_merge($dept_ta_apps_uids, $tp_ta_apps_uids, $staff_apps_uids);
        // remove duplicated values
        $uids = array_unique($uids);
        sort($uids);

        //remove seletct Department TAs from the list above
        foreach ($dept_ta_apps as $uid => $v) {
            if($v){
                if (($key = array_search($uid, $uids)) !== false) unset($uids[$key]);
            }
        }

        //remove seletct TP TAs from the list above
        foreach ($tp_ta_apps as $uid => $v) {
            if($v){
                if (($key = array_search($uid, $uids)) !== false) unset($uids[$key]);
            }
        }

        //remove seletct staff from the list above
        foreach ($staff_apps as $uid => $v) {
            if($v){
                if (($key = array_search($uid, $uids)) !== false) unset($uids[$key]);
            }
        }

        $johns = $this->User->find('all', array('conditions'=>array('id'=>$uids), 'fields'=>array('id', 'name', 'email'), 'order'=>'name asc'));

        $this->set(compact('johns'));
    }

    function invitations(){
        $this->ActivityApp->recursive = -1;
        $activity_apps = $this->ActivityApp->find('all', array('fields'=>array('id', 'user_id'), 'order'=>'user_id asc'));
        $activity_apps = Hash::extract($activity_apps, '{n}.ActivityApp.user_id');

        // // $lecture_apps = $this->CoreLectureApp->find('all', array('fields'=>array('id', 'user_id'), 'order'=>'user_id asc'));
        // // $lecture_apps = Hash::extract($lecture_apps, '{n}.CoreLectureApp.user_id');

        // $uids = array_merge($activity_apps, $lecture_apps);
        $uids = array_merge($activity_apps);
        $uids = array_unique($uids);


        $this->User->Behaviors->load('Containable');
        $this->User->contain('Invite');
        $invites = $this->User->find('all', array('conditions'=>array('Invite.id >'=>'0'),  'order'=>'name asc'));
        $this->set(compact('invites'));

        $this->User->contain('Invite');
        $non_invites = $this->User->find('all', array('conditions'=>array('User.id'=>$uids, 'Invite.id'=>NULL),  'order'=>'name asc'));
        $this->set(compact('non_invites'));
        //debug($applicants);
    }

    function invite_user($uid){
        $user = $this->User->findById($uid);
        if($user['User']['id'] <= 0) {
            $this->Session->setFlash('User not exsiting!', 'flash-red');
            $this->redirect($this->referer());
            return;
        }

        // check if use is already invited
        $inv = $this->Invite->findByUserId($uid);
        if(isset($inv['Invite']['id'])){
            $this->Session->setFlash('User has already been invited before. Please check.', 'flash-yellow');
            $this->redirect($this->referer());
            return;
        }

        $invite['Invite']['id'] = null;
        $invite['Invite']['user_id'] = $uid;

        if($this->Invite->save($invite)){
            $this->Session->setFlash('User added to invited list.', 'flash-green');
            $this->redirect($this->referer());
        }

    }

    function remove_invite($id){
        if($this->Invite->delete($id)){
            $this->Session->setFlash('User removed from invited list.', 'flash-green');
            $this->redirect($this->referer());
        }
    }

    function manage_invite($id) {
        if($this->request->is('post')){
            if($this->Invite->save($this->request->data)){
                $invite = $this->Invite->findById($id);

                if(!isset($invite['Invite']['confirmation_token'])){
                    $this->Invite->id = $id;
                    $this->Invite->saveField('confirmation_token', md5(uniqid()));
                }
                
                $this->Session->setFlash('Invitation details updated.', 'flash-green');
            }
        }

        $invite = $this->Invite->findById($id);
        $this->data = $invite;
        $this->set(compact('invite'));
        // debug($invite);
    }

    function preview_invitation($id){
        $invite = $this->Invite->findById($id);

        // check if the confirmation code is ready
        if(!isset($invite['Invite']['confirmation_token'])){
            $this->Invite->id = $id;
            $this->Invite->saveField('confirmation_token', md5(uniqid()));
        }

        // check if all required fields are filled
        if(!isset($invite['Invite']['date_start']) || !isset($invite['Invite']['date_end']) || !isset($invite['Invite']['is_isu_cover_travel'])
            || !isset($invite['Invite']['is_isu_cover_lodging']) ) {
                $this->Session->setFlash('Please complete invitation details first!', 'flash-red');
                $this->redirect($this->referer());
        }

        $this->set(compact('invite'));
    }

    function send_invitation_email($id){
        // disable debug, prevent infomation leaking
        Configure::write('debug', 0);

        $invite = $this->Invite->findById($id);
        $address = $invite['User']['email'];

        // $address = 'junzi.sun@isunet.edu';

        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail('gmail');
        $Email->template('invitation')
            ->emailFormat('text')
            ->viewVars(array('invite'=>$invite))
            ->to($address)
            ->subject('Invitation for ISU SSP2014');
        
        if($Email->send()) {
            $this->Session->setFlash('Invitation send out.', 'flash-green');

            // update DB field
            $this->Invite->id = $id;
            $this->Invite->saveField('is_invitation_sent', 1);
            $this->Invite->saveField('is_invitation_confirmed', 0);
            $this->Invite->saveField('date_of_confirm', null);

            $this->redirect(array('action'=>'manage_invite', $id));
        } else {
            $this->Session->setFlash('Problem occured, can not send email', 'flash-red');
        }

    }

    function __get_user_app_count($users){
        // calculate how many applications submited
        foreach ($users as $k => $user) {
            $uid = $user['User']['id'];
            $core_chair_apps = $this->CoreChairApp->find('count', array('conditions'=>array('user_id'=>$uid)));
            $department_chair_apps = $this->DepartmentChairApp->find('count', array('conditions'=>array('user_id'=>$uid)));
            $tp_chair_apps = $this->TpChairApp->find('count', array('conditions'=>array('user_id'=>$uid)));
            $department_ta_apps = $this->DepartmentTaApp->find('count', array('conditions'=>array('user_id'=>$uid)));
            $tp_ta_apps = $this->TpTaApp->find('count', array('conditions'=>array('user_id'=>$uid)));
            $tmp_staff_apps = $this->TmpStaffApp->find('count', array('conditions'=>array('user_id'=>$uid)));
            $activity_apps = $this->ActivityApp->find('count', array('conditions'=>array('user_id'=>$uid, 'year'=>$this->__current_ssp_year())));
            $theme_day_apps = $this->ThemeDayApp->find('count', array('conditions'=>array('user_id'=>$uid)));

            $apps_count = $core_chair_apps + $department_chair_apps + $tp_chair_apps + $department_ta_apps
                            + $tp_ta_apps + $tmp_staff_apps + $activity_apps + $theme_day_apps;

            $users[$k]['apps_count'] = $apps_count;
        }

        return $users;
    }

    function __get_departments(){
        $departments = $this->Department->find('list', array('fields'=>array('id', 'name')));
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

    function __validateChangePassword() {
        
        $okay = true;
        
        if (strlen($this->request->data['User']['newpassword1']) == 0) {
            $this->User->invalidate("newpassword1", "x Invalid New Password");
            $okay = false;
        }
        
        if (strlen($this->request->data['User']['newpassword2']) == 0) {
            $this->User->invalidate("newpassword2", "x Invalid New Password");
            $okay = false;
        }
        
        if ($okay && $this->request->data['User']['newpassword1'] != $this->request->data['User']['newpassword2']) {
            $this->User->invalidate("newpassword2", "x New Passwords do not match");
            $okay = false;
        }
                
        return $okay;
    }

}
?>
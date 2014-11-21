<?php
class UsersController extends AppController {

    public $uses = array('User', 'Group', 'Invite');

    public $paginate = array(
        'User' => array('limit' => 20, 'order' => array('role'=>'asc', 'name' => 'asc'))
    );

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('init', 'signup', 'lost_password', 'reset_password', 'invitation_confirm'));
    }

    function index() {
        $user = $this->User->findById($this->__uid());
        $this->set(compact('user'));
        $this->__check_cv();
    }

    function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash('User or password error! Cannot Login.', 'flash-red');
            }
        }

        // if already logged in, redirect to home
        if($this->__uid() > 0)
            $this->redirect('/');
    }

    function logout() {
        $this->Session->setFlash('Logged out. see you next time.', 'flash-green');
        $this->redirect($this->Auth->logout());
    }

    function signup($id=null) {
        if ($id==null && !empty($this->request->data)) {
            $this->User->set($this->request->data);

            if ($this->User->validates()) {
                $this->request->data['User']['group_id'] = 10;      // default user group

                if($this->User->save($this->request->data)){
                    $this->Session->setFlash('User created.', 'flash-green');
                    $this->redirect(array('controller'=>'users', 'action'=>'index'));
                } else {
                    $this->Session->setFlash('Cannot create user...', 'flash-red');
                }
            }
        }

        $groups = $this->Group->find("list", array('fields'=> array('id','name'), 'order' => array('name' => 'asc')));
        $this->set(compact("groups"));
    }


    function edit(){
        $uid = $this->__uid();

        if ($this->request->is('post')){
            $this->request->data['User']['id'] = $uid;
            if($this->User->save($this->request->data)){
                $this->Session->setFlash('User update.', 'flash-green');
                $this->redirect('index');
            } else {
                $this->Session->setFlash('Cannot update user info...', 'flash-red');
            }
        } else {
            $this->request->data = $this->User->findById($uid);
        }
    }


    function view_cv(){
        if(!$this->__check_cv()){
            $this->Session->setFlash('You cv file cannot be found...', 'flash-red');
            $this->redirect('index');
            return;
        }

        $this->viewClass = 'Media';

        $user = $this->User->findById($this->__uid());
        $cv_file = $user['User']['cv_file'];

        $params = array(
              'id' => $cv_file,
              'download' => false,
              'extension' => 'pdf',  // must be lower case
              'path' => 'user_cvs' . DS   // don't forget terminal 'DS'
       );
       $this->set($params);
    }

    function update_cv(){

        APP::uses('Sanitize', 'Utility');
        
        $file = $this->data['Upload']['file'];

        // check if upload is ok
        if ($file['error'] != UPLOAD_ERR_OK) {
            $this->Session->setFlash('Upload error...', 'flash-red');
            $this->redirect('index');
            return;
        }

        // check file type is PDF
        if($file['type'] != "application/pdf"){
            $this->Session->setFlash('File is not a PDF...', 'flash-red');
            $this->redirect('index');
            return;
        }

        // check file size is smaller than 300KB, 50 more for a margin
        if($file['size']/1024 > 350){
            $this->Session->setFlash('File too big, must be less than 300KB size...', 'flash-red');
            $this->redirect('index');
            return;
        }

        // generate the file name
        $cv_file_name = 'cv_'
                    .Sanitize::paranoid($this->Auth->user('first_name')).'_'
                    .Sanitize::paranoid($this->Auth->user('last_name')).'_'
                    .$this->Auth->user('id')
                    .'.pdf';

        $cv_file_name = strtolower($cv_file_name);

        $this->__delete_cv();       // before copy in the new cv, remove the old one, (incase names are different)

        if (move_uploaded_file($file['tmp_name'], WWW_ROOT.'user_cvs'.DS.$cv_file_name)) {

            // update file field in user table
            $this->User->read('cv_file', $this->__uid());
            $this->User->set('cv_file', $cv_file_name);
            $this->User->save();

            $this->Session->setFlash('File uploaded.', 'flash-green');
        } else {
            $this->Session->setFlash('Permission error, please contact us...', 'flash-red');
        }

        $this->redirect('index');
    }

    function delete_cv(){
        if($this->__delete_cv()){
            $this->Session->setFlash('File deleted.', 'flash-green');
        } else {
            $this->Session->setFlash('Permission error, please contact us...', 'flash-red');
        }
        $this->redirect('index');
    }

    function __delete_cv(){
        $user = $this->User->findById($this->__uid());
        $cv_file_name = $user['User']['cv_file'];

        if(strlen($cv_file_name) > 0){
            App::uses('File', 'Utility');

            $file = new File(WWW_ROOT.'user_cvs'.DS.$cv_file_name, false);
            
            if($file->delete()) {
                // cool, now remove the tag in DB
                $this->User->read('cv_file', $this->__uid());
                $this->User->set('cv_file', NULL);
                $this->User->save();
            } else {
                return false;
            }
        }

        return true;
    }

    function __check_cv(){
        $user = $this->User->findById($this->__uid());
        $cv_file_name = $user['User']['cv_file'];

        if(strlen($cv_file_name) > 0){
            $file = new File(WWW_ROOT.'user_cvs'.DS.$cv_file_name, false);
            if($file->exists()){
                // we are cool
                return true;
            } else {
                // remove the tag in DB
                $this->User->read('cv_file', $this->__uid());
                $this->User->set('cv_file', NULL);
                $this->User->save();
            }
        }

        return false;
    }


    function change_password() {
        if (!empty($this->request->data)) {
            
            $uid = $this->__uid();
            
            if ($this->__validateChangePassword($uid)) {
                
                $user = $this->User->findById($uid);
                $user['User']['password'] = $this->request->data['User']['newpassword1'];

                if($this->User->save($user)){
                    $this->Session->setFlash('Password changed.', 'flash-green');
                    $this->redirect(array('action'=>'index'));
                } else {
                    $this->Session->setFlash('Can not change password...', 'flash-red');
                }
            }
        }
    }
    
    function __validateChangePassword($uid) {
        
        $okay = true;
        if (strlen($this->request->data['User']['oldpassword']) == 0) {
            $this->User->invalidate("oldpassword", "x Invalid Old Password");
            $okay = false;
        }
        
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
        
        $conditions = array("User.id = ? and User.password = ?" => array($uid, $this->Auth->password($this->request->data['User']['oldpassword'])));
        if (strlen($this->request->data['User']['oldpassword']) > 0 && !$this->User->hasAny($conditions)) {
            $this->User->invalidate("oldpassword", "x Old Password does not match");
            $okay = false;
        }
        
        return $okay;
    }

    function lost_password(){
        // disable debug, prevent infomation leaking
        Configure::write('debug', 0);

        if($this->request->is('post')){
            $email = $this->request->data['User']['email'];
            
            $this->User->recursive = -1;
            $user = $this->User->findByEmail($email);
            
            if(!isset($user['User'])) {
                // email not found
                $this->Session->setFlash('We can find login related to your email.', 'flash-red');
                $this->redirect('/');
            } elseif ($user['User']['id'] > 0) {
                // set reset password token, if it is not already exist
                if(strlen($user['User']['reset_password_token']) != 64) {
                    $token = hash('sha256', uniqid().$user['User']['password']);
                    $this->User->id = $user['User']['id'];
                    $this->User->saveField('reset_password_token', $token);

                    // read again the $user value
                    $user = $this->User->findById($user['User']['id']);
                }

                $address = $user['User']['email'];

                App::uses('CakeEmail', 'Network/Email');
                $Email = new CakeEmail('gmail');
                $Email->template('reset_password_request')
                    ->emailFormat('text')
                    ->viewVars(array('user'=>$user))
                    ->to($address)
                    ->subject('ISU Involve - Reset Password Request');
                
                if($Email->send()) {
                    $this->Session->setFlash('Reset password email sent.', 'flash-green');
                    $this->redirect('/');
                } else {
                    $this->Session->setFlash('Problem occured, can not send email', 'flash-red');
                }
            }
        }
    }

    function reset_password($token){
        if(!isset($token) || strlen($token)!=64){
            $this->Session->setFlash('Error.', 'flash-red');
            $this->redirect('/');
            return;
        }

        $user = $this->User->findByResetPasswordToken($token);
        if(!isset($user['User']['id'])){
            $this->Session->setFlash('Error.', 'flash-red');
            $this->redirect('/');
            return;
        }

        if($this->request->is('post')){
            if (!$this->__validateResetPassword()) {
                $this->set(compact('token'));
                $this->set('email', $user['User']['email']);
            } else {
                $user['User']['password'] = $this->request->data['User']['new_password'];

                if($this->User->save($user)){
                    // remove token
                    $this->User->id = $user['User']['id'];
                    $this->User->saveField('reset_password_token', null);

                    // notify user about the password update
                    $address = $user['User']['email'];

                    App::uses('CakeEmail', 'Network/Email');
                    $Email = new CakeEmail('gmail');
                    $Email->template('reset_password_notify')
                        ->emailFormat('text')
                        ->viewVars(array('user'=>$user))
                        ->to($address)
                        ->subject('ISU Involve - Password has been reset')
                        ->send();

                    $this->Session->setFlash('Password reset.', 'flash-green');
                    $this->redirect('/');
                } else {
                    $this->redirect('/');
                    $this->Session->setFlash('Error, can not rest password. Please contact us.', 'flash-red');
                }
            }

        } else {
            $this->set(compact('token'));
            $this->set('email', $user['User']['email']);
        }
    }

    function __validateResetPassword() {
        
        $okay = true;
        
        if (strlen($this->request->data['User']['new_password']) == 0) {
            $this->User->invalidate("new_password", "x Invalid Password");
            $okay = false;
        }
        
        if (strlen($this->request->data['User']['new_password_confirm']) == 0) {
            $this->User->invalidate("new_password_confirm", "x Invalid Password");
            $okay = false;
        }
        
        if ($okay && $this->request->data['User']['new_password'] != $this->request->data['User']['new_password_confirm']) {
            $this->User->invalidate("new_password_confirm", "x Passwords do not match");
            $okay = false;
        }
                
        return $okay;
    }

    function invitation_confirm($token=null){
        if(!isset($token) || strlen($token)!=32){
            $this->Session->setFlash('Error', 'flash-red');
            $this->render('invitation_error');
            return;
        }

        $invite = $this->Invite->findByConfirmationToken($token);
        if(!isset($invite['Invite']['id'])){
            $this->Session->setFlash('Error', 'flash-red');
            $this->render('invitation_error');
            return;
        }

        if($this->request->is('post')){
            $inv_id = $invite['Invite']['id'];

            $this->Invite->id = $inv_id;
            $this->Invite->saveField('departure_city_country', $this->request->data['Invite']['departure_city_country']);
            $this->Invite->saveField('departure_airport', $this->request->data['Invite']['departure_airport']);
            $this->Invite->saveField('sponsor', $this->request->data['Invite']['sponsor']);
            $this->Invite->saveField('is_invitation_confirmed', 1);
            $this->Invite->saveField('date_of_confirm', date('Y-m-d'));

            $this->Session->setFlash('Invitation Confirmed. Thank you!', 'flash-green');
            
            $this->redirect(array('action'=>'invitation_confirm', $token));
        } else {
            $this->set(compact('invite'));
            $this->data = $invite;
            $this->render('invitation_confirm');
        }
    }

    function confirm_my_invitation(){
        $uid = $this->__uid();
        $invite = $this->Invite->findByUserId($uid);
        $this->redirect(array('action'=>'invitation_confirm', $invite['Invite']['confirmation_token']));
    }

    // ########################## Admin functions ##########################

    function user_view_backend($id){
        if (!$this->__is_backend_user()) {
            $this->Session->setFlash('Access denied! you don not have access to this page.', 'flash-red');
            $this->redirect($this->referer());
            return;
        }


        if($this->request->is('ajax')) {
            $this->layout = "ajax";
        } else {
            $this->layout = 'backend';
        }

        $user = $this->User->findById($id);
        if(!isset($user['User'])){
            $this->redirect(array('controller'=>'admin', 'action'=>'users'));
            return;
        }
        $this->set(compact('user'));
    }

    function user_view_cv_backend($id){
        // if (!$this->__is_backend_user()) {
        //     $this->Session->setFlash('Access denied! you don not have access to this page.', 'flash-red');
        //     $this->redirect($this->referer());
        //     return;
        // }

        $user = $this->User->findById($id);
        if(!isset($user['User'])){
            $this->redirect($this->referer());
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
                $this->redirect($this->referer());
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

}
?>
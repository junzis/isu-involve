<?php
class ProposalsController extends AppController {

    public $uses = array('Group', 'User', 'Department', 'Tp', 'ActivityApp', 'ActivityAppsDepartment', 'ThemeDayApp', 'ProjectApp');

    public $paginate = array(
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
            'order' => array('ProjectApp.created'=>'desc'),
        ),

    );

    function beforeFilter() {
        parent::beforeFilter();

        if (!$this->__is_backend_user()) {
            $this->Session->setFlash('Access denied! you don not have access to this page.', 'flash-red');
            $this->redirect('/');
        }

        $this->layout = 'backend';

    }


    function index() {
        
    }

    function theme_day_apps(){
        $theme_day_apps = $this->paginate('ThemeDayApp');
        $this->set(compact('theme_day_apps'));
    }

    function activity_apps(){
        // $activity_apps = $this->ActivityApp->find('all', array('order'=>'User.first_name asc'));

        // find out the activities of the current ssp year
        $activity_apps = $this->paginate('ActivityApp', array('ActivityApp.year'=>$this->__current_ssp_year()));
        $this->set(compact('activity_apps'));

        $departments = $this->Department->find('list', array('fields'=>array('id', 'abbr'), 'order'=>'abbr asc'));
        $this->set(compact('departments'));
    }

    function activities_for_department($dept=null){
        if($this->request->is('post')){
            $dept = $this->request->data['Dept']['id'];
            $this->redirect(array('action'=>'activities_for_department', $dept));
        }

        if(!isset($dept)){
            $this->redirect(array('action'=>'activity_apps'));
        }

        $this->ActivityAppsDepartment->Behaviors->load('Containable');
        $this->ActivityAppsDepartment->contain(array('ActivityApp', 'ActivityApp.Department', 'ActivityApp.User'));
        $aads = $this->ActivityAppsDepartment->find('all', array('conditions'=>array('department_id'=>$dept, 'ActivityApp.year'=>$this->__current_ssp_year())));
        // debug($aads);

        // regroup arrays
        $activity_apps = array();

        foreach ($aads as $k => $aad){
            $activity_apps[$k]['User'] = $aad['ActivityApp']['User'];
            unset($aad['ActivityApp']['User']);
            $activity_apps[$k]['Department'] = $aad['ActivityApp']['Department'];
            unset($aad['ActivityApp']['Department']);
            $activity_apps[$k]['ActivityApp'] = $aad['ActivityApp'];
        }

        // debug($activity_apps);

        $activity_apps = Set::sort($activity_apps, '{n}.User.name', 'asc');

        $this->set(compact('activity_apps'));

        $departments = $this->Department->find('list', array('fields'=>array('id', 'abbr'), 'order'=>'abbr asc'));
        $this->set(compact('departments'));

        $this->request->data['Dept']['id'] = $dept;

        $this->render('activity_apps');
    }

    function search_activity($keyword=null){
        if($this->request->is('post')){
            $keyword = $this->request->data['Activity']['search'];
            $this->redirect(array('action'=>'search_activity', str_replace('/', '\\', $keyword)));
        }

        if(!isset($keyword)){
            $this->redirect(array('action'=>'activity_apps'));
        }

        $activity_apps = $this->paginate('ActivityApp', array(
            'OR' => array(
                'ActivityApp.title LIKE' => "%$keyword%",
                'ActivityApp.description LIKE' => "%$keyword%",
            ),
            'AND' => array('ActivityApp.year'=>$this->__current_ssp_year()),
        ));
        $this->set(compact('activity_apps'));

        $departments = $this->Department->find('list', array('fields'=>array('id', 'abbr'), 'order'=>'abbr asc'));
        $this->set(compact('departments'));

        $this->request->data['Activity']['search'] = $keyword;

        $this->render('activity_apps');
    }


    function project_apps(){
        $project_apps = $this->paginate('ProjectApp');
        $this->set(compact('project_apps'));
    }

    function search_project($keyword=null){
        if($this->request->is('post')){
            $keyword = $this->request->data['Project']['search'];
            $this->redirect(array('action'=>'search_project', str_replace('/', '\\', $keyword)));
        }

        if(!isset($keyword)){
            $this->redirect(array('action'=>'project_apps'));
        }

        $project_apps = $this->paginate('ProjectApp', array(
            'OR' => array(
                'ProjectApp.title LIKE' => "%$keyword%",
                'ProjectApp.description LIKE' => "%$keyword%",
                'ProjectApp.background LIKE' => "%$keyword%",
                'ProjectApp.issues LIKE' => "%$keyword%",
                'ProjectApp.tasks LIKE' => "%$keyword%",
                'ProjectApp.scope_2i LIKE' => "%$keyword%",
                'ProjectApp.potential_sponsorship LIKE' => "%$keyword%",
                'ProjectApp.prospective_impact LIKE' => "%$keyword%",
                'ProjectApp.comments LIKE' => "%$keyword%",
            )
        ));
        $this->set(compact('project_apps'));

        $this->request->data['Project']['search'] = $keyword;

        $this->render('project_apps');
    }

    function manage_project_app($id){
        $app = $this->ProjectApp->findById($id);
        $this->Set(compact('app'));
        $this->data = $app;
    }

    function update_project_uid($id){
        if($this->request->is('post')){
            $app = $this->request->data;
            $this->ProjectApp->id = $app['ProjectApp']['id'];
            if($this->ProjectApp->saveField('uid', $app['ProjectApp']['uid'])){
                $this->Session->setFlash('Data saved', 'flash-green');
            } else {
                $this->Session->setFlash('Error, can not save data', 'flash-red');
            }
        }
        $this->redirect($this->referer());
    }

    function print_project_app($id){
        $app = $this->ProjectApp->findById($id);
        $this->Set(compact('app'));

        $this->layout = 'print';
    }

}
?>
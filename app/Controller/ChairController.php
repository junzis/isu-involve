<?php
class ChairController extends AppController {

    public $uses = array('Group', 'User', 'Department', 'Tp', 'TmpStaff', 'CoreChairApp', 'DepartmentChairApp', 'TpChairApp',
        'DepartmentTaApp', 'TpTaApp', 'TmpStaffApp', 'ActivityApp', 'ActivityAppsDepartment');

    public $paginate = array(
        'ActivityApp' => array(
            'limit' => 30, 
            'order' => array('User.first_name'=>'asc'),
        ),

        'CoreLectureApp' => array(
            'limit' => 30, 
            'order' => array('User.first_name'=>'asc'),
        ),
    );

    function beforeFilter() {
        parent::beforeFilter();

        if (!$this->__is_backend_user()) {
            $this->Session->setFlash('Access denied! this page is for chairs only.', 'flash-red');
            $this->redirect('/');
        }

        $this->layout = 'backend';

    }

    function index() {
        $this->redirect('apps');

        // $chair = $this->User->findById($this->__uid());
        // $this->set('chair');

        // $chair_app = $this->DepartmentChairApp->find('first', array('conditions'=>array('user_id'=>$this->__uid(), 'selected'=>true)) );
        // $this->set('chair_app');
    }

    function apps(){
        $department_ta_apps_count = $this->DepartmentTaApp->find('count');
        $tp_ta_apps_count = $this->TpTaApp->find('count');
        $tmp_staff_apps_count = $this->TmpStaffApp->find('count');
        $activity_apps_count = $this->ActivityApp->find('count', array('conditions'=>array('year'=>$this->__current_ssp_year())));

        $this->set(compact(array('tp_ta_apps_count', 'department_ta_apps_count', 'tmp_staff_apps_count',
            'activity_apps_count', 'core_lecture_apps_count')));
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

    function __get_tmp_staff(){
        $tps = $this->TmpStaff->find('list', array('fields'=>array('id', 'title')));
        return $tps;
    }
}

?>

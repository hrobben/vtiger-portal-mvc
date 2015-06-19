<?php

class MySettings extends Controller {

    function __construct() {
        parent::__construct();    
    }
    
    function index() 
    {    
        $this->view->title = 'MySettings';
        
        //$this->view->render('header');
        Session::init();
        $this->view->errormsg = '';
        $this->view->render('mysettings/index');
        //$this->view->render('footer');
    }
    
    function run()
    {
        Session::init();
        $this->view->errormsg = $this->model->run();
        $this->view->render('mysettings/index');
    }
    
}
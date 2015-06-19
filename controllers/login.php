<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();    
    }
    
    function index() 
    {    
        $this->view->title = 'Login';
        
        //$this->view->render('header');
        $this->view->render('login/index');
        //$this->view->render('footer');
    }
    
    function run()
    {
        $this->model->run();
    }
    
    public function elog($msg)
    {
        $this->view->er_log = $this->model->elog($msg);
        $this->view->render('login/index');
    }

    public function supportpage($param)
    {
        $this->view->supportpage = $this->model->supportpage($param);
        // echo $this->view->supportpage;
        $this->view->title = $param;
        
        //$this->view->render('header');
        $this->view->render('login/supportpage/index');
        //$this->view->render('footer');    
    }
}
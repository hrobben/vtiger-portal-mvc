<?php

class Error extends Controller {

    function __construct() {
        parent::__construct(); 
    }
    
    function index() {
        $this->view->title = '404 Error';
        $this->view->msg = 'The page was not found';

        $this->view->render('header');
        $this->view->render('error/index'); 
        $this->view->render('footer');        
    }

}
<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        
    }

    /**
     *
     */
    function index() {
        //echo Hash::create('sha256', 'jesse', HASH_PASSWORD_KEY);
        //echo Hash::create('sha256', 'test2', HASH_PASSWORD_KEY);

        // kijken of we logged zijn anders eerst naar inlog.....
        Auth::handleLogin();

        //$this->view->content = '';//$this->model->accounts();
        $this->view->content = $this->model->helpdesk('false', '');
        $this->view->title = 'Home';
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');
    }

    function run()
    {
        Auth::handleLogin();
        Session::init();
        $this->view->content = '<h3>we zijn in <b>run</b> moet nog worden aangepast openen in standaard<h3><br>'.print_r($this->model->run());
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');
    }

    function accounts($action = 'index',$onlymine = 'true')
    {
        Auth::handleLogin();
        Session::init();
        $this->view->content = $this->model->accounts($action, $onlymine);
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');       
    }

    function contacts($action = 'index',$onlymine = 'true', $id = '')
    {
        Auth::handleLogin();
        Session::init();
        $this->view->content = $this->model->contacts($action, $onlymine, $id);
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');       
    }

    function project($action = 'index',$onlymine = 'true', $id = '')
    {
        Auth::handleLogin();
        Session::init();
        $this->view->content = $this->model->project($action, $onlymine, $id);
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');       
    }

    function services($action = 'index',$onlymine = 'true', $id = '')
    {
        Auth::handleLogin();
        Session::init();
        $this->view->content = $this->model->services($action, $onlymine, $id);
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');       
    }

    function assets($action = 'index',$onlymine = 'true', $id = '')
    {
        Auth::handleLogin();
        Session::init();
        $this->view->content = $this->model->assets($action, $onlymine, $id);
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');       
    }

    function products($action = 'index',$onlymine = 'true', $id = '')
    {
        Auth::handleLogin();
        Session::init();
        $this->view->content = $this->model->products($action, $onlymine, $id);
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');       
    }

    function quotes($action = 'index',$onlymine = 'true', $id = '')
    {
        Auth::handleLogin();
        Session::init();
        $this->view->content = $this->model->quotes($action, $onlymine, $id);
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');       
    }

    function invoice($onlymine = 'true', $action = 'index', $status = '', $id = '')
    {
        Auth::handleLogin();
        Session::init();
        $this->view->content = $this->model->invoice($onlymine, $action, $status, $id);
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');       
    }

    function documents($onlymine = 'true', $action = 'index', $id = '', $filename = '', $folderid='1', $extra = '')
    {
        Auth::handleLogin();
        Session::init();
        $this->view->content = $this->model->documents($onlymine, $action, $id, $filename, $folderid, $extra);
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');       
    }

    function faq($onlymine = 'true', $fun = '', $category_index = '', $productid = '', $search_text = '', $search_category = '', $faqid = '')
    {
        Auth::handleLogin();
        Session::init();
        //$onlymine, $action, $fun = '', $category_index, $search_text, $search_category, $productid)
        if (isset($_REQUEST['search_text'])) $search_text = $_REQUEST['search_text'];
        if (isset($_REQUEST['search_category'])) $search_category = $_REQUEST['search_category'];
        $this->view->content = $this->model->faq($onlymine, $fun, $category_index, $productid, $search_text, $search_category, $faqid);
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');       
    }

    function helpdesk($onlymine = 'true', $fun = '', $category_index = '', $productid = '', $search_text = '', $search_category = '', $id = '')
    {
        Auth::handleLogin();
        Session::init();
        //$onlymine, $action, $fun = '', $category_index, $search_text, $search_category, $productid)
/*        if (isset($_REQUEST['search_text'])) $search_text = $_REQUEST['search_text'];
        if (isset($_REQUEST['search_category'])) $search_category = $_REQUEST['search_category'];
*/
        $this->view->content = $this->model->helpdesk($onlymine, $fun, $category_index, $productid, $search_text, $search_category, $id);
        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');       
    }

}

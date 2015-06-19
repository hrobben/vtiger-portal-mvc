<?php

interface MyInterface
{
    public function myFunction($data);
}

/**
 *
 */
class Auth
{

    public static function handleLogin()
    {
        @session_start();
        $logged = $_SESSION['loggedIn'];

        //if (!isset($_SESSION['customer_id']) || !isset($_SESSION['customer_name'])) {
        if (!$logged || $logged === 'false') {
            session_destroy();
            //Session::set('loggedIn', 'true');
            header('location: ' . URL . 'login');
            exit;
        } /*else {
            header('location: '.URL.'index/run');
            exit;
        }*/
    }

}

class MyClass implements MyInterface
{
    public function thisFunction()
    {
        return $this;
    }

    public function myFunction($data)
    {
        // TODO: Implement myFunction() method.
    }
}

abstract class MyAbstractClass
{

}

class ConcreteClass extends MyAbstractClass
{

}

$myAbstractClass = new ConcreteClass();
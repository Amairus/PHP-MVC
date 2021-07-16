<?php

namespace App\Libraries;

class RouteHandler{

    private $type;
    private $message;
    private $route;


    public static function redirect($route)
    {
        header('Location: '.$route);
        exit;
    }

    public static function exitPage($msg){
        echo $msg;
        die;
    }

    public static function redirectView($view, $data = [])
    {
        if(file_exists('app/views/' . $view . '.php')){
            require_once 'app/views/' . $view . '.php';
        }
        else{
            die('Redirection did not happened');
        }

    }

}
?>
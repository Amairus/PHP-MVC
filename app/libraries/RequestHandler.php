<?php

namespace App\Libraries;

class RequestHandler {

    /**
     * Associative array of routes (the routing table)
     * @var array
     */
    protected static $routes = [
        'Home' => array(null),
        'Rental' => array('keyword','type', 'minYear', 'maxYear', 'price', 'id'),
        'Signup' => array('Email', 'Password', 'Logins','Name', 'Lastname', 'Email', 'Password', 'Signup'),
        'Contact' => array('name','email','subject','description','submit'),
        'Profiles' => array('id')
    ];

    /**
     * Parameters from the matched route
     * @var array
     */
    protected $requests = [];


    public static function paramData()
    {
        unset($_GET['url']);
        $data =  array_merge($_POST, $_GET);
        return $data;
    }

    public static function getParamDataKey($param)
    {
        return array_keys($param);
    }
    /**
     * hasValidParams: Checks if the whole requests is valid
     * @access public
     * @return void
     * @since 1.0.1
     */
    public static function hasValidParams($controller)
    {
        if (!empty(self::getParamDataKey(self::paramData()))) {
            $result = array_intersect(self::$routes[$controller] , self::getParamDataKey(self::paramData()));
            if(empty($result))
            Exception::throwRequestError('Bad Request', 400);
        }

    }
    /**
     * isPost: Checks if the request is POST request
     * @access public
     * @return boolean
     * @since 1.0.1
     */
    public static function isPost()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        return true;
        else return false;
    }


    public static function isGet()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        return true;
        else return false;
    }

    public static function getRequest()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    /**
     * Get all the routes from the routing table
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Get the currently matched parameters
     *
     * @return array
     */
    public function getRequests()
    {
        return $this->requests;
    }


    /**
     * Get params url
     * @return array
     */

     public function getParams($route)
     {
        $params = explode('?', $route);
        unset($params[0]);
        $params = implode(" ",$params);
        $str;
        parse_str($params, $str);
        return array_keys($str);
     }
}
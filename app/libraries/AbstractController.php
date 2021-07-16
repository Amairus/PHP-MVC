<?php

namespace App\Libraries;

use App\Libraries\QueryBuilder\DB;
/**
 * AbstractClass it is the base class of all Controllers
 * @package Controller
 */

abstract class AbstractController extends Controller
{

    public $request_handler;
    /**
     * Constructor: Loads all the equipment used an all child
     * Request handler, CarModel, UserModel, Session
     */
    public function __construct()
    {
        $this->request_handler = new RequestHandler();
        Session::init();
        DB::bind('User', $this->model('UserRepository'));
        DB::bind('Car', $this->model('CarRepository'));
    }

    public function loadModel($model)
    {
        $modelName = $model.'Model';
        $this->$modelName = $this->model($model);
    }

    /**
     *  userLoggedin: checks if user is logedin
     *  @access public
     *  @return bool
     *  @since 1.0.1
     */
    public static function userLoggedin()
    {
        if (!empty($_SESSION['id'])) return true; else return false;
    }


    /**
     * checkAuthorization: This function purpouse is to give premission only to the users
     * It checks if the user has authorization
     * @access private
     * @return void
     * @since 1.0.1
     */
    protected static function checkAuthorization ()
    {
        if (!self::userLoggedin()) {
            RouteHandler::redirect('../Home');
        }
    }
    /**
     * hasLoginCookie: Checks if a user has the loggedin cookie
     * @access protected
     * @return void
     * @since 1.0.1
     */
    protected static function hasLoginCookie()
    {
        if(!isset($_COOKIE['loggedin'])) RouteHandler::redirect('Home');
    }

}
?>
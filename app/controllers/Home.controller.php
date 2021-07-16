<?php

use App\Libraries\EmploymentPolicy;
use App\Libraries\Exception;
use App\Libraries\RouteHandler;
use App\Libraries\Session;
use App\Libraries\QueryBuilder\DB;
/**
 *
 *  Home Controller used to controll and load views
 *  Manages requests done under /Home
 * @package AbstractService
 * @subpackage HomeService
 */
class Home extends App\Libraries\AbstractController
{
    /**
     * Logout: Redirect to Services layout to procceed with logout
     * @access public
     * @return void
     * @since 1.0.1
     */
    public static function LogoutGET()
    {
        setcookie('loggedin', time()-3600);
        Session::destroy();
        RouteHandler::redirect('../Home');
    }

    /**
     * Index: Redirects to the index view and manages bad requests
     * @uses RequestHandler to manage bad requests
     * @access public
     * @return void
     * @throws BadRequest
     * @since 1.0.1
     */
    public function indexGET()
    {
        //Load Home.view
        $this->view('Home.view');
    }
}
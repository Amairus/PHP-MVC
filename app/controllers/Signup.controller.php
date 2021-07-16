<?php


use App\Libraries\RouteHandler;
use App\Libraries\RequestHandler;
use App\Libraries\AbstractController;
use App\Libraries\Middleware;
use App\Libraries\Auth;
/**
 * Signup Controller used to controll Singup Page and load views
 * Manages all reqeuest and sends data to Service
 * @package Controller
 * @subpackage AbstractClass
 */
class Signup extends AbstractController
{

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

        $this->view('Signup.view');
    }

    public function indexPOST()
    {
        //Handles index behavior on POST request
        self::indexPostService();
    }

        /**
     * indexPost: handles behavior on POST request
     * @access private
     * @return void
     * @since 1.0.1
     */
    protected function indexPostService()
    {
           //Validate which form submit
        if(isset($_POST['Signup']) && Middleware::validateForm('Signup')) {
            $data = Middleware::getData($_POST);
            $auth = new Auth();
            $auth->Signup($data);
        }
        if (isset($_POST['Login']) && Middleware::validateForm('Login')) {
            $data = Middleware::getData($_POST);
            $auth = new Auth();
            $auth->Login($data);
        }
    }

}

?>
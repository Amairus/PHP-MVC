<?php

use App\Libraries\Middleware;
/**
 * Contact controller loads view and controlles it
 * Manges requests done in /Contact
 * @package Controller
 * @subpackage AbstractClass
 */
class Contact extends App\Libraries\AbstractController
{
    /**
     * Index: Redirects to the index view and manages bad requests
     * Validates data and sends email to the applyer
     * @uses RequestHandler to manage bad requests
     * @access public
     * @return void
     * @throws BadRequest
     * @since 1.0.1
     */
    public function indexGET()
    {
        //Load view
        $this->view('contact.view');
    }

    /**
     * indexPost: Handles index page on POST request
     * @access private
     * @return array
     * @since 1.0.1
     */
    public function indexPOST()
    {
        $data = $this->indexPostService();

        $this->view('contact.view', $data);
    }

    /**
     * indexPost: Handles index page on POST request
     * @access private
     * @return array
     * @since 1.0.1
     */
    protected function indexPostService()
    {
            if (Middleware::hasEmptyFields($_POST))
                return ['error' => 'Please fill all the fields required'];

            $data = Middleware::getData($_POST);

            if(empty(Middleware::isValidEmail($data['email'])))
                return ['error' => 'Please enter an valid email'];

            if (EmailSender::sendEmail($data['name'], $data['email'], $data['subject'], $data['description']))
                return ['message' => 'done'];
    }
}
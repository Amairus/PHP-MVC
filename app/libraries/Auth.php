<?php

namespace App\Libraries;


/**
 *  Auth Class is responsible for Authentication
 *  This class makes the Signup and Login action in our Website
 *  Getting the data and sending it to the model after verification
 */
class Auth extends AbstractController
{
    public function __construct()
    {
        parent::loadModel('UserRepository');
    }
    //Signup main function
    public function Signup($data)
    {
        Middleware::isValidEmail($data['Email']);
        $data['Password'] = $this->hashPassword($data['Password']);
        $this->UserRepositoryModel->register($data);
        RouteHandler::redirectView('Signup.view', array('message' => 'You registered successfully!'));
        // self::checkPassword($data['Password']);
        // self::addUser($data);
    }

    //Login main function
    public function Login($data)
    {
        Middleware::isValidEmail($data['Email']);
        $this->UserRepositoryModel->login($data);
    }

    //Checks if an email already exists in database
    public function checkEmail($email)
    {
        $rows = $this->UserRepositoryModel->checkEmail($email);
        if ($rows > 0) {
            RouteHandler::redirectView('Signup.view', array('error' => 'This email already exists!'));
        }
    }

    //Checks if password is longer than 6 characters
    public function checkPassword($data)
    {
        if (strlen($data) < 6) {
            RouteHandler::redirectView('Signup.view', array('error' => 'Password is too short!'));
        }
    }

    //Checks if email is valid format
    //Parent function overriding
    protected function isValidEmail($email)
    {
        if (empty(parent::isValidEmail($email))) {
            RouteHandler::redirectView('Signup.view', array('error' => 'Please enter an valid email'));
        }
    }

    //Checks if user Exists [Login]
    protected function userExists($data)
    {
        if ($this->UserRepositoryModel->checkEmail($data) == 0) {
            RouteHandler::redirectView('Signup.view', array('error' => 'This user is not founded. Please register!'));
            exit;
        }
    }

    //Hashing Password
    private function hashPassword($data)
    {
        return password_hash($data,PASSWORD_ARGON2I);
    }

    //Register user and adds it to DB
    private function addUser($data)
    {
        $data['Password'] = $this->hashPassword($data['Password']);
        if ($this->UserRepositoryModel->addUser($data)) {
            RouteHandler::redirect('Signup?message=success');
        }
    }
}
?>
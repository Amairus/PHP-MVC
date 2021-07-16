<?php

use App\Libraries\QueryBuilder\QueryBuilder;
use App\Libraries\RouteHandler;
use App\Libraries\Session;

class UserRepository extends QueryBuilder
{
    /**
     * @var string
     * @access protected
     */
    protected static $class = 'users';
    /**
     * register a user to db
     * @access public
     * @param array
     * @return void
     */
    public function register($data)
    {
        if( !empty( parent::select(self::$class)->Where(['email'=> $data['Email']])->getfirst() ) ){
            RouteHandler::redirectView('Signup.view', array('error' => 'This email already exists!'));
            exit;
        }
        parent::insert(self::$class, [
            'name' => $data['Name'],
            'lastname' => $data['Lastname'],
            'email' => $data['Email'],
            'password' => $data['Password']
        ]);
    }

    /**
     * login: user authentication to login
     * @access public
     * @param array
     * @return void
     */
    public function login($data)
    {
        $user = parent::select(self::$class)->Where(['email' => $data['Email']])->getfirst();
        if (empty($user)) {
            RouteHandler::redirectView('Signup.view', array('error' => 'This user is not founded. Please register!'));
            exit;
        }
        if (password_verify($data['Password'], $user->password)){
            Session::put('id',$user->id);
            Session::put('name', $user->name);
            Session::put('email', $user->email);
            setcookie('loggedin', 1, time()+3600);
            RouteHandler::redirect('Home');
        }else {
            RouteHandler::redirectView('Signup.view', array('error' => 'Password is incorrect'));
        }
    }

}
<?php
    /*
     * Base Controller
     * Load the Models and View
     */
    namespace App\Libraries;

    class Controller {
        //load model
        public function model($model){
            //require model file
            require_once 'app/models/' . $model . '.php';

            //instantiate model
            return new $model();
        }

        //load the view

        public static function view($view, $data = []){
            //check for the view field
            if(file_exists('app/views/' . $view . '.php')){
                require_once 'app/views/' . $view . '.php';
            } else {
                //view does not exist
                die('view not found');
            }
        }
    }
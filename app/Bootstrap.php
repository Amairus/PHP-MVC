<?php
    //Load Config
    namespace App\Bootstrap;

    //Auto Load Core Libraries
    class Bootstrap {
        public function __construct()
        {
            spl_autoload_register(function($className){
                $path = 'libraries/' . $className . '.php';
                if ($className == 'Employe') {
                    $path = 'models/' . $className . '.php';
                }
                if (file_exists($path)) {
                    $path = 'controllers/' .$className. '.php';
                    echo $path;
                    //require_once $path;
                }
                    print_r($path);
                    require_once $path;
            });
        }

    }

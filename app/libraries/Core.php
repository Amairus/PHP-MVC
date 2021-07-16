<?php
    /*
     * App Core Class
     * Create URL & Loads core Controller
     * URL FORMATE - /controller/method/params
     */

    namespace App\Libraries;

    class Core
    {
        protected $currentController = 'Home';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct()
        {

            $url = $this->getUrl();

            //Look In Controllers For First Value
            if(file_exists('app/controllers/' . ucwords($url[0]) . '.controller.php')){
                //if exists, set as controller
                $this->currentController = ucwords($url[0]);
                //unset 0 index
                unset($url[0]);
            } else {
                Exception::throwRequestError('Route not found', 404);
            }
            //require controller
            require_once 'app/controllers/' . $this->currentController . '.controller.php';
            //Saves the name of controller
            $this->currentControllerName =  $this->currentController;
            //instantiate controller class
            $this->currentController = new $this->currentController;

            //check for the second part of the url
            if(isset($url[1])){
                //check to see if method exist
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    //unset 1 index
                    unset($url[1]);
                }
            }

            //Checks if the second part of the url doesn't exists
            //And follows his own way to load controller class
            //@throws Error if controller no found
            if ($this->getSecondUrl() !== null) {
                $URL = $this->getSecondUrl();
                if(empty($URL[1])) {
                    $this->currentMethod = $this->reqController($this->currentMethod);
                    if(!method_exists($this->currentController, $this->currentMethod))
                        Exception::throwRequestError('Bad Request', 400);
                }
            }

            //check for the second part of the url
            //if url doesnt exist throws an error
            if ($this->getSecondUrl() !== null) {
                $URL = $this->getSecondUrl();
                if(!empty($URL[1])) {
                    $URL[1] = explode('?', $URL[1]);
                    $method = $URL[1][0];
                    $method = $this->reqController($method);
                    if (method_exists($this->currentController, $method))
                    $this->currentMethod = $method;
                    else Exception::throwRequestError('Route not found', 404);
                }
            }

            //Checks if the Params are valid
            RequestHandler::hasValidParams($this->currentControllerName);

           // get params
           $this->params = $url ? $url : [];
           //call a callback with array of params
           call_user_func([$this->currentController, $this->currentMethod], null);

        }

        /**
         * getUrl: Gets and returns the sanitized url
         * @access protected
         * @param GET
         * @return string
         * @since 1.0.1
         */
        protected function getUrl()
        {
            if(isset( $_GET ['url'] ) ) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }

        /**
         * getSecondUrl: Gets the seconnd parameter of the url to load the controller
         * @access protected
         * @return string
         * @since 1.0.1
         */
        protected function getSecondUrl()
        {
            $url = substr($_SERVER['REQUEST_URI'], 16);
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }

        /**
         * reqController: adds the request type tho the method to load the specified controller
         * @access protected
         * @param string
         * @return string
         * @since 1.0.1
         */
        protected function reqController($method)
        {
            return $method . RequestHandler::getRequest();
        }

    }


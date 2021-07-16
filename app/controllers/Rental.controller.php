<?php

use App\Libraries\AbstractController;
use App\Libraries\Middleware;
use App\Libraries\Exception;
use App\Utilities\PhotoUploader;
use App\Utilities\Search;
use App\Libraries\Session;
use App\Libraries\RouteHandler;
use App\Libraries\QueryBuilder\DB;

/**
 * Rental Controller is used to load couple views
 * Manages all requests on each view
 * Comunicating with the Database/Model sendin and retriving data
 * @package Controller
 * @subpackage AbstractClass
 */
class Rental extends AbstractController
{

    /**
     * AddCar: Loads AddCar view and posts a car to the page
     * Posts data to Database
     * @access public
     * @return void
     * @since 1.0.1
     */
    public function AddCarGET()
    {
        //Loads view
        $this->view('AddCar');
    }

    public function AddCarPOST()
    {
        //Handles Post request
        $this->addcarPostService();
    }

    /**
     * Single: It gets the data of a single product and send to view
     * @access public
     * @return void
     * @since 1.0.1
     */
    public function SingleGET()
    {

        //Handles Single page on get request
        $data = $this->singleGetService();

        //Loads view with specified data
        $this->view('single_rental_car', $data);

    }

    public function SinglePOST()
    {
        //Handles Single page on post request
        $this->singlePostService();

        //Handles Single page on get request
        $data = $this->singleGetService();

        //Loads view with specified data
        $this->view('single_rental_car', $data);
    }

    /**
     * index: The base view loader, it loads and sends all products data to view
     * @access public
     * @return void
     * @since 1.0.1
     */
    public function indexGet()
    {

        //Handles index page on Get request
        $data = $this->indexGetService();

        //Loads view
        $this->view('all_rental_cars', $data);
    }

    /**
     * indexGet: handles index page on GET reques
     * @access private
     * @return void
     * @since 1.0.1
     */
    protected static function indexGetService()
    {

            $data = Middleware::getData($_GET);
            //Using Search class for search
            $search = new Search();
            $data = $search->searchCar($data);

            //Gets Car Specified data by type
            //$printCar = new CarTypeSpec($data);
            //$data = $printCar->syncData($data);

            //Loading view with the data retrived after search
            return $data;
    }

        /**
     * addcarPost: Handles Post request behavior in AddCar page
     * @access private
     * @return void
     * @since 1.0.1
     */

    protected function addcarPostService()
    {
        //Checks if users has Authrization to post a product
        self::checkAuthorization();

        if (Middleware::hasEmptyFields($_POST))
            RouteHandler::redirectView('AddCar', array('error' => 'Please fill all fields!'));

        //Gets data from FrontEnd
        $data = Middleware::getData($_POST);

        if(!file_exists($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name']))
        RouteHandler::redirectView('AddCar', array('error' => 'Please upload an image!'));

        //Photo uploading
        PhotoUploader::uploadImage($_FILES['photo'], "public/image");

        //Addind extra data on variable to send to DB
       DB::get('Car')->CreateCar($data,$_FILES['photo']['name'], $_SESSION['id'] );

        //Redirecting route after DB injection
        RouteHandler::redirectView('AddCar', array('message' => 'Car Added Successfully!'));
    }


           /**
     * singleGet: handles Single page on get request
     * @access private
     * @return array
     * @since 1.0.1
     */
    protected function singleGetService()
    {
        //Gets id from GET request
        $data = Middleware::getData($_GET);
        //Initialize Exception

        if (!empty($data['id'])) {
            $data = DB::get('Car')->readSingleCar($data['id']);
            if(empty($data)) {
                Exception::throwError('Product not founded');
                die;
            }
            //Sends data retrived from DB to the view
            $status = DB::get('Car')->getCarStatus($data->id);
            $data = (array)$data;
            array_push($data, ['status' => $status]);
            if (Session::exists('id'))
            array_push($data, ['user' => $data['id']]);
            return $data;
        }else {
            Exception::throwError('Unspecified product');
            die;
            }
    }

    /**
     * singlePost: handles Single page on post request
     */
    protected function singlePostService()
    {

        $data = Middleware::getData($_POST);
        if (!empty($data['id'])) {
           DB::get('Car')->reserve($data['id'], Session::get('id'));
            $status =DB::get('Car')->getCarStatus($data['id']);
        }
    }
}
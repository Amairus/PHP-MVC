<?php

use App\Libraries\AbstractController;
use App\Libraries\Session;
use App\Libraries\Middleware;
use App\Libraries\QueryBuilder\DB;
/**
 * Profile controller handles requests and redirect them to Service Layout
 * @package AbstractService
 * @subpackage ProfileService
 */

class Profiles extends AbstractController
{
    /**
     * index: loads base view and comunicates with DB
     * @access public
     * @return void
     * @since 1.0.1
     */
    public function indexGET()
    {

            //Handles GET request
            $data = self::indexGetService();

            //Loads view and gives data
            $this->view('Profile.view', $data);

    }

    public function indexPOST()
    {
        //Handles DELETE request
        self::indexDeleteService();

        //Handles GET request
        $data = self::indexGetService();

        //Loads view and gives data
        $this->view('Profile.view', $data);
    }

       /**
     * indexDelete: handles index behaviour on DELETE
     * @access private
     * @return void
     * @since 1.0.1
     */
    protected function indexDeleteService()
    {
        //Deleting an user product
        $data = file_get_contents("php://input");
        if($data != null) {
            $data = Middleware::getAjaxValue($data);
            DB::get('Car')->deleteCar($data);
        }
    }
    /**
     * indexGet: handles index behaviour on GET
     * @access private
     * @return array
     * @since 1.0.1
     */
    protected function indexGetService()
    {
        //Returning all users products(cars)
        $id = Session::get('id');
        $personal = DB::get('Car')->readUserCar($id);
        $reserved = DB::get('Car')->readReservedCar($id);

        //Ading icon based on data information practicing the O Principal on SOLID
        //$printCar = new CarTypeSpec($personal);
        //$personal = $printCar->syncData($personal);

        $data = array();
        array_push($data, $personal);
        array_push($data, $reserved);
        return $data;
    }


}
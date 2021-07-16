<?php

namespace App\Services;

use App\Services\CarType;

/**
 * CarTypeSpec: It gets all the car type specefication and calculation
 * @package CarType
 */
class CarTypeSpec
{

    /**
     * carTypes saves all type classes
     * @access protected
     * @var array
     */
    protected $carTypes;
    /**
     * iconData: saves all Icons to an array
     * @access protected
     * @var array
     */
    protected $iconData;
    /**
     * allCars: saves the data from constructor in array
     * to loop later and get the type data to initialize classes
     * @access protected
     * @var array
     */
    protected $allCars;

    /**
     * __constructor:
     * @access public
     * @param array
     * @return void
     */
    public function __construct($cars)
    {
        $this->carTypes = [];
        $this->iconData = [];
        $this->allCars = $cars;
        self::addClasess();
    }

    /**
     * addClasess: Initalizes and add classes based on their type to the carType
     * @access public
     * @return void
     */
    public function addClasess()
    {
        foreach($this->allCars as $key => $value){

            /**
             * @todo Fix to load classes automatically by string
             */
            // $className = $value->type;
            // $className = $value->type.'CarTrophy';
            // $className = 'CarTrophy\\'.$className;

            if($value->type == 'New')
            array_push($this->carTypes, new CarType\NewCarType());
            if($value->type == 'Old')
            array_push($this->carTypes, new CarType\OldCarType());
            if($value->type == 'Epic')
            array_push($this->carTypes, new CarType\EpicCarType());
        }
    }
    /**
     * getTypeSpec: The closed func according to O principle
     * this func loops on all obj and calls their method
     * @access public
     * @return array
     */
    public function getTypeSpec()
    {
        foreach($this->carTypes as $key => $value){
            array_push($this->iconData ,$value->getIcon());
        }
        return $this->iconData;
    }
    /**
     * syncData: Syncronizes data with the data that is prepared for view
     * @access public
     * @param array
     * @return array
     */
    public function syncData($data)
    {
        foreach($data as $key => $value){
            $value->icon = $this->getTypeSpec()[$key];
        }
        return $data;
    }

}
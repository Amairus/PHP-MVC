<?php

use App\Libraries\QueryBuilder\QueryBuilder;

class CarRepository extends QueryBuilder
{
    /**
     * CLASS_1: saves table name on db
     * @var const
     */
    protected const CLASS_1 = 'cars';

    /**
     * CreateCar: insert a car on DB
     * @access public
     * @param array
     * @return void
     */
    public function CreateCar($data, $photo, $user_id)
    {
        parent::insert(self::CLASS_1, [
            'brand' => $data['brand'],
            'type' => $data['type'],
            'year' => $data['year'],
            'engine' => $data['engine'],
            'milleage' => $data['milleage'],
            'price' => $data['price'],
            'photo' => $photo,
            'user_id' => $user_id
        ]);
    }
    /**
     * readSingleCar: reads a single car on DB
     * @access public
     * @param int
     * @return object
     */
    public function readSingleCar($id)
    {
        $car =  parent::select(self::CLASS_1)->Where(['id' => $id])->getfirst();
        if(empty($car))
            return null;
        else
            return $car;
    }
    /**
     * select1: select a class in db
     * (not allowing overloading on a same func with different params)
     * @access public
     * @return object
     */
    public function select1()
    {
        return $this->select(self::CLASS_1);
    }

    /**
     * getCarStatus: gets a car status on db
     * @access public
     * @param int
     * @return int
     */
    public function getCarStatus($id)
    {
        $carInfo = parent::select(self::CLASS_1)->Where(['id' => $id])->getfirst();
        return $carInfo->status;
    }
    /**
     * reserve: reserves a car
     * @access public
     * @param int,int
     * @return void
     */
    public function reserve($carId, $userId)
    {
        parent::update(self::CLASS_1)->set([
            'status' => 0,
            'ordered_by' => $userId]
             )->Where(['id' => $carId])->exec();
        return;
    }
    /**
     * readUserCar: reads a user car on db
     * @access public
     * @param int
     * @return object
     */
    public function readUserCar($userId)
    {
        return parent::select(self::CLASS_1)->Where(['user_id' => $userId])->getAll();
    }
    /**
     * readReservedCar
     * @access public
     * @param int
     * @return object
     */
    public function readReservedCar($userId)
    {
        return parent::select(self::CLASS_1)->Where(['ordered_by' => $userId])->getAll();
    }
    /**
     * deleteCar
     * @access public
     * @param int
     * @return void
     */
    public function deleteCar($id)
    {
        parent::delete(self::CLASS_1)->Where(['id' => $id])->exec();
    }
}
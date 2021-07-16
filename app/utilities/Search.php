<?php

namespace App\Utilities;

use App\Libraries\Database;

class Search {

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public  function searchCar($data)
    {
        $keyword='';
        $type='';
        $minYear='';
        $maxYear='';
        $price='';


        $query = 'SELECT * FROM `cars` WHERE ';
        if (!empty($data['keyword'])) {
            $keyword = $data['keyword'];
            $query .= "brand like '%".$keyword."%' ";
        }

        if (!empty($data['type'])) {
            $type = $data['type'];
            if (strlen($query) == 27) {
                $query .= "type like '%".$type."%' ";
            }else {
                $query .= "AND type like '%".$type."%' ";
            }
        }

        if (!empty($data['price'])) {
            $price = $data['price'];
            if (strlen($query) == 27) {
                $query .= "price <= '".$price."' ";
            }else {
                $query .= "AND price <= '".$price."' ";
            }
        }
        if (!empty($data['minYear']) || !empty($data['maxYear']) ){
            if(empty($data['maxYear'])) {
                $minYear = $data['minYear'];
                if (strlen($query) == 27) {
                    $query .= "year <= '".$minYear."' ";
                }else {
                    $query .= "AND year <= '".$minYear."' ";
                }
            }
            else if (empty($data['minYear'])) {
                $maxYear = $data['maxYear'];
                if (strlen($query) == 27) {
                    $query .= "year >= '".$maxYear."' ";
                }else {
                    $query .= "AND year >= '".$maxYear."' ";
                }
            }
            else {
                $minYear = $data['minYear'];
                $maxYear = $data['maxYear'];
                if (strlen($query) == 27) {
                    $query .= "year BETWEEN '".$minYear."' AND '".$maxYear."' ";
                }else {
                    $query .= "AND year BETWEEN '".$minYear."' AND '".$maxYear."' ";
                }
            }

        }

        if (strlen($query) == 27) {
            $query .= '1';
        }
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }
}
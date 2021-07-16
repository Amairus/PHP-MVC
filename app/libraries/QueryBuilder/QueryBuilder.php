<?php
/**
 * QueryBuilder: builds the querys for the Repository Pattern implementation
 * uses a Pdo and has its own functions
 */
namespace App\Libraries\QueryBuilder;

require_once 'app/models/CarModel.php';

class QueryBuilder
{

    /**
     * db instance
     * @access protected
     */
    protected static $db;

    /**
     * Saves query string
     * @access protected
     */
    protected $query;

    /**
     * Saves the pdo statments
     * @access protected
     */
    protected $pdo;

    /**
     * Saves the params to be binded
     * @access protected
     */
    protected $params;

    /**
     * Get the DB instance form Database class
     * Initializess other class variables
     * @access public
     * @return void
     */
    function __construct()
    {
        self::$db = QueryConnector::make();

        $this->query = null;

        $this->pdo = null;

        $this->params = [];
    }

    /**
     * Select one table from database
     * @access public
     * @param string
     * @return object
     */
    public function select($table)
    {
        $statement ="select * from {$table} ";
        $this->query = $statement;
        return $this;
    }

    /**
     * getAll: returns all rows from database prepares, binds and executes
     * @access public
     * @return array
     */
    public function getAll()
    {
        $this->pdo = self::$db->prepare($this->query);
        $this->bind();
        $this->pdo->execute();
        //Mini maping example with carModel
        $this->pdo->setFetchMode(\PDO::FETCH_CLASS| \PDO::FETCH_PROPS_LATE, 'CarModel');
        $data = $this->pdo->fetchAll();
        //For each fetched object call a method
        foreach ($data as $obj) {
            $obj->setKilometers();
        }
        return $data;
    }
    /**
     * getfirst: returns the first row from database
     * @access public
     * @return array
     */
    public function getfirst()
    {
        $this->pdo = self::$db->prepare($this->query);
        $this->bind();
        $this->pdo->execute();
        return $this->pdo->fetch(\PDO::FETCH_OBJ);
    }
    /**
     * Insert a record into a table.
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public static function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {#
            $statement = self::$db->prepare($sql);

            $statement->execute($parameters);
        } catch (\Exception $e) {
            //
        }
    }
    /**
     * update: Updates a table in a specific field
     * @access public
     * @param string
     * @return object
     */
    public function update($table)
    {
        $this->query = "update {$table} ";

        return $this;
    }

    /**
     * set: Sets and changes elements to update
     * @access public
     * @param array
     * @return object
     */
    public function set($conditions)
    {
        $this->query.="set ";

        $this->addConditions($conditions);

        return $this;
    }

    /**
     * delete: Starts query string with delete odf ana specific table in DB
     * @access public
     * @param string
     * @return object
     */
    public function delete($table)
    {
        $this->query = "delete from {$table} ";

        return $this;
    }
    /**
     * Where adds where to query string and than adds all coditions
     * @access public
     * @param array
     * @return object
     */
    public function Where($conditions)
    {
        $this->query.="where ";

        $this->addConditions($conditions);

        return $this;
    }
    /**
     * Prepares ,bindes and executes the query string with PDO
     * @access public
     * @return void
     */
    public function exec()
    {
        try {#
            $this->pdo = self::$db->prepare($this->query);
            $this->bind();
            $this->pdo->execute();
        } catch (\Exception $e) {
            //
        }
    }

    /**
     * The engine func which adds conditions to query string
     * @access protected
     * @param array
     * @return void
     */
    protected function addConditions($conditions){
        //Check if the array is empty
        if(empty($conditions)){
            $this->query .="1";
        }
        else {
            //Get the last element of condition so we dont put coma after it
            $lastElement = end($conditions);
            //Start iteration throught condition
            foreach($conditions as $condition => $conditionValue){
                //Check if we are in the last element of array so we dont put coma
                if($conditionValue == $lastElement){
                    $this->query.= "{$condition} = :{$condition} ";
                    array_push($this->params, [$condition => $conditionValue]);
                }
                //Else we put comma after every element
                else{
                    $this->query.= "{$condition} = :{$condition}, ";
                    array_push($this->params,[$condition => $conditionValue]);
                }

            }
        }

    }
    /**
     * bind: binds all the saved params to the query
     * @access protected
     * @return void
     */
    protected function bind()
    {
        //Check if params not empty
        if(!empty($this->params)){
            //Loops thorught params
            foreach($this->params as $param){
                foreach($param as $condition => $conditionValue){
                    //Binds the values
                    $this->pdo->bindValue(":{$condition}" , $conditionValue);
                }
            }
        }
        //Removes values from query and params to be ready for reuse
        $this->query = [];
        $this->params = [];
    }
}

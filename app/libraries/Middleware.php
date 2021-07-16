<?php

namespace App\Libraries;

/**
 * @package Middleware
 * Middleware class provide servicess for input validation
 */
class Middleware {

    /**
     * hasEmptyFields: Checks if a POST data has empty fields
     * @access public
     * @param array
     * @return boolean
     * @since 1.0.1
     */
    public static function hasEmptyFields($postData)
    {
        //Checks if param isn't array
        if(!is_array($postData)) return true;
        //Checks if param has empty field
        foreach($postData as $data){
            if (empty($data)) {
                echo $data;
                return true;
            }
        }
        return false;
    }

    /**
     * getData: This func gets data from param ,validate input and returns array
     * @access public
     * @param array
     * @return arrayy
     * @since 1.0.1
     */
    public static function getData($postData)
    {
        $data_arr = array();
        foreach($postData as $data => $key) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data_arr = array_merge($data_arr, array($data => $key));
        }
        return $data_arr;
    }

    /**
     * validateForm: Validates a POST form
     * @access public
     * @param array
     * @return bool
     * @since 1.0.1
     */
    public static function validateForm($form)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (isset($_POST[$form])) {
                if (self::hasEmptyFields($_POST) == false) {
                    return true;
                }
            }
        }
        return false;
    }
    /**
     * isValidEmail: Checks if an email is valid
     * @access protected
     * @param @string
     * @return bool
     * @since 1.0.1
     */
    public static function isValidEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
           return true;
        }
        return false;
    }
     /**
     * getAjaxValue: This function gets ajax value and returns it to string ready to use
     * @access protected
     * @param array
     * @return string
     * @since 1.0.1
     */
    public static function getAjaxValue($data){
        $data = explode('=',$data);
        return $data[1];
    }


    public static function fileExists($filePath)
    {
        return file_exists($filePath);
    }

}
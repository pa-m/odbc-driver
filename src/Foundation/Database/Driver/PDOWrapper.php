<?php 
namespace Foundation\Database\Driver; 

class PDOWrapper extends \PDO
{
    private $pdo;

    function __construct($dsn, $user = '', $password = '', $options = [])
    {
        if($dsn instanceof \PDO) $this->pdo=$dsn;
        else $this->pdo = new \PDO($dsn, $user, $password, $options);
    }

    function _dec($value)
    {
        if (is_array($value)) {
            return array_map([$this, '_dec'], $value);
        }
        if (is_object($value)) {
            return (object) array_map([$this, '_dec'], get_object_vars($value));
        }
        if (gettype($value) == 'string' && $value) {
            try{
                return @iconv("utf-8","windows-1252//TRANSLIT",$value);
            }
            catch(\Exception $e){

                return utf8_encode($value);
            }
        }
        return $value;
    }

    function _enc($value)
    {
        if (is_array($value)) {
            return array_map([$this, '_enc'], $value);
        }
        if (is_object($value)) {
            return (object) array_map([$this, '_enc'], get_object_vars($value));
        }
        if (gettype($value) == 'string' && $value) {
            try {
                return iconv("windows-1252","utf-8//TRANSLIT",$value);
            }
            catch(\Exception $e)
            {
                return utf8_encode($value);
            }
        }
        return $value;
    }

    function beginTransaction()
    {
        return call_user_func_array([$this->pdo, __FUNCTION__], func_get_args());
    }

    function commit()
    {
        return call_user_func_array([$this->pdo, __FUNCTION__], func_get_args());
    }

    function errorCode()
    {
        return call_user_func_array([$this->pdo, __FUNCTION__], func_get_args());
    }

    function errInfo()
    {
        return call_user_func_array([$this->pdo, __FUNCTION__], func_get_args());
    }

    function exec($string)
    {
        return call_user_func_array([$this->pdo, __FUNCTION__], $this->_dec($string));
    }

    function getAttribute($attribute)
    {
        return getAvailableDrivers($this->pdo, func_get_args());
    }

    function inTransaction($name = null)
    {
        return call_user_func_array([$this->pdo, __FUNCTION__], func_get_args());
    }

    function lastInsertId($seqname = null)
    {
        return call_user_func_array([$this->pdo, __FUNCTION__], func_get_args());
    }

    function prepare($statement, $driver_options = [])
    {
        return new PDOStatementWrapper($this,$this->pdo->prepare($this->_dec($statement), $driver_options));
    }

    function query($statement)
    {
        $args = func_get_args();
        $args[0] = $this->_dec($args[0]);
        return call_user_func_array([$this->pdo, __FUNCTION__], $args);
    }

    function quote($string, $parameter_type = \PDO::PARAM_STR)
    {
        return call_user_func_array([$this->pdo, __FUNCTION__], func_get_args());
    }

    function rollBack()
    {
        return call_user_func_array([$this->pdo, __FUNCTION__], func_get_args());
    }

    function setAttribute($attribute, $value)
    {
        return call_user_func_array([$this->pdo, __FUNCTION__], func_get_args());
    }

    function __call($name, $args)
    {
        return call_user_func_array([$this->pdo, $name], $args);
    }

}
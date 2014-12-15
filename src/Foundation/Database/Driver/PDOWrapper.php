<?php 
namespace Foundation\Database\Driver; 

class PDOWrapper extends PDO
{
    private $pdo;
    function __construct($dsn,$user='',$password='',$options=array()){
        $this->pdo=new PDO($dsn,$user,$password,$options);
    }
    function _dec($value){
        if(is_array($value)) return array_map([$this,'_dec'],$value);
        if(is_object($value)){
            return (object)array_map([$this,'_dec'],get_object_vars($value));
        }
        if(gettype($value)=='string'&&$value) return utf8_decode($value);
        return $value;
    }
    function _enc($value){
        if(is_array($value)) return array_map([$this,'_dec'],$value);
        if(is_object($value)){
            return (object)array_map([$this,'_dec'],get_object_vars($value));
        }
        if(gettype($value)=='string'&&$value) return utf8_encode($value);
        return $value;
    }
    function beginTransaction()
    {
        return call_user_func_array([$this->pdo,__FUNCTION__],func_get_args());
    }
    function commit()
    {
        return call_user_func_array([$this->pdo,__FUNCTION__],func_get_args());
    }
    function errCode()
    {
        return call_user_func_array([$this->pdo,__FUNCTION__],func_get_args());
    }
    function errInfo()
    {
        return call_user_func_array([$this->pdo,__FUNCTION__],func_get_args());
    }
    function exec($string)
    {
        return call_user_func_array([$this->pdo,__FUNCTION__],$this->_dec($string));
    }
    function getAttribute()
    {
        return getAvailableDrivers($this->pdo,func_get_args());
    }
    function inTransaction()
    {
        return call_user_func_array([$this->pdo,__FUNCTION__],func_get_args());
    }
    function lastInsertId()
    {
        return call_user_func_array([$this->pdo,__FUNCTION__],func_get_args());
    }
    function prepare($statement,$driver_options=array())
    {
        return new EncodingPdoStatement($this->pdo->prepare($this->_dec($statement),$driver_options));
    }
    function query()
    {
        $args=func_get_args();
        $args[0]=$this->_dec($args[0]);
        return call_user_func_array([$this->pdo,__FUNCTION__],$args);
    }
    function quote()
    {
        return call_user_func_array([$this->pdo,__FUNCTION__],func_get_args());
    }
    function rollBack()
    {
        return call_user_func_array([$this->pdo,__FUNCTION__],func_get_args());
    }
    function setAttribute()
    {
        return call_user_func_array([$this->pdo,__FUNCTION__],func_get_args());
    }
    function __call($name,$args){
        return call_user_func_array([$this->pdo,$name],$args);
    }

}
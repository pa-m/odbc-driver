<?php 
namespace Foundation\Database\Driver; 

class PDOStatementWrapper extends \PDOStatement
{
    private $pdowrapper;
    private $statement;
    function __construct(PDOWrapper $pdowrapper,$statement)
    {
        $this->pdowrapper=$pdowrapper;
        $this->statement=$statement;

    }
    public function bindColumn ($column, &$param, $type = null, $maxlen = null, $driverdata = null)
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function bindParambindParam ($parameter, &$variable, $data_type = \PDO::PARAM_STR, $length = null, $driver_options = null)
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function bindValue ($parameter, $value, $data_type = \PDO::PARAM_STR)
    {
        $args = func_get_args();
        $args[1]=$this->pdowrapper->_dec($args[1]);
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function closeCursor()
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function columnCount()
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function debugDumpParams()
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function errorCode()
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function errorInfo()
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function execute($bound_input_params=null)
    {
        $args = func_get_args();
        $args = $this->pdowrapper->_dec($args);
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function fetch( $fetch_style=null ,  $cursor_orientation = \PDO::FETCH_ORI_NEXT ,  $cursor_offset = 0 )
    {
        $args = func_get_args();
        return $this->pdowrapper->_enc(call_user_func_array([$this->statement,__FUNCTION__],$args));
    }
    public function fetchAll($fetch_style=null,$fetch_argument=null,$ctor_args=array())
    {
        $args = func_get_args();
        $retval=call_user_func_array([$this->statement,__FUNCTION__],$args);
        return $this->pdowrapper->_enc($retval);
    }
    public function fetchColumn($column=0)
    {
        $args = func_get_args();
        return $this->pdowrapper->_enc(call_user_func_array([$this->statement,__FUNCTION__],$args));
    }
    public function fetchObject($className="stdClass",$ctor_args=array())
    {
        $args = func_get_args();
        return $this->pdowrapper->_enc(call_user_func_array([$this->statement,__FUNCTION__],$args));
    }
    public function getAttribute($attribute)
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function getColumnMeta($column)
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function nextRowset()
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function rowCount()
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function setAttribute($attribute,$value)
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }
    public function setFetchMode($mode,$params=null)
    {
        $args = func_get_args();
        return call_user_func_array([$this->statement,__FUNCTION__],$args);
    }



}
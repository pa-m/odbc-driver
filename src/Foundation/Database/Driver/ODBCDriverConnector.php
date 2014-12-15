<?php namespace Foundation\Database\Driver;

use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connectors\ConnectorInterface;

class ODBCDriverConnector extends Connector implements ConnectorInterface
{
	public function connect(array $config)
	{
		$dsn = $this->getDsn($config);
		
        $options = $this->getOptions($config);

        $connection = $this->createConnection($dsn, $config, $options);

        return $connection;
	}

	protected function getDsn(array $config) {
        extract($config);

        $dsn = "odbc:{$dsn}; {$username}; {$password};";

        return $dsn;
    }
        /**
         * Create a new PDO connection.
         *
         * @param  string  $dsn
         * @param  array   $config
         * @param  array   $options
         * @return \PDO
         */
        public function createConnection($dsn, array $config, array $options)
        {
                $username = array_get($config, 'username');

                $password = array_get($config, 'password');

                $pdoclass='PDO';
                if(PHP_OS=='WINNT' && preg_match('/SQL Server/i',$config['dsn']))
                        $pdoclass="Foundation\\Database\\Driver\\PDOWrapper";
                return new $pdoclass($dsn, $username, $password, $options);
        }

}
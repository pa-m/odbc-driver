<?php namespace Foundation\Database\Driver;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class ODBCDriverServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		Model::setConnectionResolver($this->app['db']);

		Model::setEventDispatcher($this->app['events']);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bindShared('db.factory', function($app) {
            return new ODBCDriverConnectionFactory($app);
		});

		$this->app->bindShared('db', function($app) {
            return new DatabaseManager($app, $app['db.factory']);
		});
        $this->app->bind('db.connector.odbc',function($app){
            return new ODBCDriverConnector;
        });
        $this->app->bind('db.connection.odbc',function($app,$args){
            list($pdo,$database,$prefix,$config)=$args;
            $factory=new ODBCDriverConnectionFactory($app);
            $connector=$factory->createConnector($config);
            //$pdo2=$connector->connect($config);
            return new ODBCDriverConnection($pdo, $database, $prefix, $config);
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('odbcdriver');
	}
}
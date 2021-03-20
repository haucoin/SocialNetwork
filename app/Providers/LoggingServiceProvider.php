<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LoggingServiceProvider extends ServiceProvider {
	
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
    	
    	$this->app->singleton('App\Utility\LoggerInterface', function ($app) {
    		return new \App\Utility\Logger();
    	});
    }
    
    
    public function provides() {
    	echo "Deffered true and i am here in provides()";
    	return ['App\Utility\LoggerInterface'];
    }
    

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        //
    }
}

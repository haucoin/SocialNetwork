<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Closure;

/**
 * @name Social Network
 * @version 6.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - SecurityMiddleware is a class that contains a method that handles an incoming which is used to check for page security
 */
class SecurityMiddleware {
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
    	
    	// Get the route URI and log it
    	$path = $request->path();
    	Log::info("Entering SecurityMiddleware.handle() at path: " . $path);
    	
    	// Set security to true
    	$secureCheck = true;
    	
    	// Check if the user is on the index, login, or registration pages or performing one of those action, set security to false
    	if($request->is('/') || $request->is('login') || $request->is('loginUser') || $request->is('registration') || $request->is('registerUser') 
    			|| $request->is('errorPage') || $request->is('profilerest/*') || $request->is('postingrest') || $request->is('postingrest/*')) {
    		$secureCheck = false;
    	}
    	// Check if the session is set, set security to false
    	if(session()->get('currentUser') != null) {
    		$secureCheck = false;
    	}
    	
    	// Check to see if security is needed, if so, redirect to login
    	if($secureCheck) {
    		Log::info("Leaving the SecurityMiddleware.handle() doing a redirect to login");
    		return redirect('/login');
    	}
    	
    	// Continue (security was not needed)
    	Log::info("Leaving the SecurityMiddleware.handle()");
    	return $next($request);
    }
}

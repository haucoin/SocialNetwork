<?php

namespace App\Business;

use App\Data\UserDataService;

/**
 * @name Social Network
 * @version 6.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - UserBusinessService is a class that performs all business logic on the user data being sent and retrieved from the database
 */
class UserBusinessService implements BusinessServiceInterface {
    
	// Define service variable to be used as UserDataService
    private $service;
    
    
    /**
     * Default constructor to initialize the Data Service object
     */
    public function __construct() {
    	$this->service = new UserDataService();
    }

    
	/**
	 * {@inheritDoc}
	 * 
	 * @see \App\Business\BusinessServiceInterface::create()
	 */
    public function create($user) {
        // Call the create method in UserDataService
        return $this->service->create($user);
    }

    
	/**
	 * {@inheritDoc}
	 * 
	 * @see \App\Business\BusinessServiceInterface::update()
	 */
    public function update($user) {
    	// Call the update method in UserDataService
    	return $this->service->update($user);
    }

    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Business\BusinessServiceInterface::delete()
     */
    public function delete(int $id) {
    	// Call the delete method in UserDataService
    	return $this->service->delete($id);
    }

    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Business\BusinessServiceInterface::viewAll()
     */
    public function viewAll() {
    	// Call the viewAll method in UserDataService
        return $this->service->viewAll();
    }

    
    /**
     * {@inheritDoc}
     *
     * @see \App\Business\BusinessServiceInterface::viewById()
     */
    public function viewById(int $id) {
    	// Call the viewById method in UserDataService
    	return $this->service->viewById($id);
    }
    
    
    // ---------------------- End of business interface implementation -------------------
    
    
    /**
     * {@inheritDoc}
     *
     * @see \App\Business\BusinessServiceInterface::authenticate()
     */
    public function authenticate($user) {
    	// Call the viewAll method in UserDataService and set to variable
    	$users = $this->service->viewAll();
    	
    	// Set variables for the user being verified
    	$username = $user->getUsername();
    	$password = $user->getPassword();
    	$validUser = false;
    	
    	// Iterate through all users within the database
    	for($i = 0; $i < count($users); $i++) {
    		// Set the current user being checked
    		$currentUser = $users[$i];
    		
    		// Verify if the current user matches the provided credentials
    		if(strcmp($currentUser->getUsername(), $username) == 0 && strcmp($currentUser->getPassword(), $password) == 0) {
    			// Set the validity to true and set the session variable
    			$validUser = true;
    			$_SESSION['currentUser'] = $currentUser;
    			break;
    		}
    	}
    	// Return the validity of the user
    	return $validUser;
    }
    
}
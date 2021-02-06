<?php

namespace App\Business;

use App\Data\UserDataService;

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - UserBusinessService is a class that performs all business logic on the data being sent and retrieved from the database
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
     * @see \App\Business\BusinessServiceInterface::authenticate()
     */
    public function authenticate($user) {
    	
        // Get an array of users from the data service
    	$users = $this->service->viewAll();
        
        // Set variables for the user being verified
        $username = $user->getUserName();
        $password = $user->getPassword(); 
        $validUser = false;
        
        // Iterate through all users within the database
        for($i = 0; $i < count($users); $i++) {
            // Set the current user
            $currentUser = $users[$i];
            
            // Verify if the current user matches the provided credentials
            if(strcmp($currentUser->getUserName(), $username) == 0 && strcmp($currentUser->getPassword(), $password) == 0) {
                // Set the validity to true and set the session variable
                $validUser = true;
                $_SESSION['currentUser'] = $currentUser;
                break;
            }
        }
        // Return the validity of the user
        return $validUser;
    }

    
	/**
	 * {@inheritDoc}
	 * 
	 * @see \App\Business\BusinessServiceInterface::create()
	 */
    public function create($user) {
        //Sends a object to to the data service in write to the database
        return $this->service->create($user);
    }

    
	/**
	 * {@inheritDoc}
	 * 
	 * @see \App\Business\BusinessServiceInterface::update()
	 */
    public function update($user) {
        //Sends an updated object to the data service
    	return $this->service->update($user);
    }

    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Business\BusinessServiceInterface::delete()
     */
    public function delete(int $userId) {
        //Sends an id of an object to be deleted
    	return $this->service->delete($userId);
    }

    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Business\BusinessServiceInterface::viewAll()
     */
    public function viewAll() {
        //Request an array of all user objects from the data service
        return $this->service->viewAll();
    }

    
    /**
     * {@inheritDoc}
     *
     * @see \App\Business\BusinessServiceInterface::viewById()
     */
    public function viewById(int $userId) {
    	return $this->service->viewById($userId);
    }
    
}
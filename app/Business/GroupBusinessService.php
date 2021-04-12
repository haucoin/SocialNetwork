<?php

namespace App\Business;

use App\Data\GroupDataService;

/**
 * @name Social Network
 * @version 7.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - GroupBusinessService is a class that performs all business logic on the group data being sent and retrieved from the database
 */
class GroupBusinessService implements BusinessServiceInterface {
    
    // Define service variable to be used as GroupDataService
    private $service;
    
    
    /**
     * Default constructor to initialize the Data Service object
     */
    public function __construct() {
        $this->service = new GroupDataService();
    }
    
    
    /**
     * {@inheritDoc}
     *
     * @see \App\Business\BusinessServiceInterface::create()
     */
    public function create($group) {
    	// Call the create method in GroupDataService
    	return $this->service->create($group);
    }
    
    
    /**
     * {@inheritDoc}
     *
     * @see \App\Business\BusinessServiceInterface::update()
     */
    public function update($group) {
    	// Call the update method in GroupDataService
    	return $this->service->update($group);
    }

    
    /**
     * {@inheritDoc}
     *
     * @see \App\Business\BusinessServiceInterface::delete()
     */
    public function delete($id) {
    	// Call the delete method in GroupDataService
    	return $this->service->delete($id);
    }
    
    
    /**
     * {@inheritDoc}
     *
     * @see \App\Business\BusinessServiceInterface::viewAll()
     */
    public function viewAll() {
    	// Call the viewAll method in GroupDataService
    	return $this->service->viewAll();
    }
    
    
	/**
	 * {@inheritDoc}
	 * 
	 * @see \App\Business\BusinessServiceInterface::viewById()
	 */
    public function viewById(int $id) {
    	// Call the viewById method in GroupDataService
        return $this->service->viewById($id);
    }

    
    // ---------------------- End of business interface implementation -------------------
    
    
	/**
	 * Method to view all groups by the user identification variable of username
	 * 
	 * @param $username - String: The username of a user
	 * @return 'viewAllById' - Method: Retrieves all group id's that a user is part of
	 */
    public function viewAllById($username) {
    	// Call the viewAllById method in GroupDataService
    	return $this->service->viewAllById($username);
    }
    
    
    /**
     * Method to get all of the usernames (as a string) of a given group
     * 
     * @param $groupId - Integer: The ID of a group
     * @return 'getUsers' - Method: Retrieves a string of the usernames of all users in a group
     */
    public function getUsers($groupId) {
    	// Call the getUsers method in GroupDataService
    	return $this->service->getUsers($groupId);
    }
    
    
    /**
     * Method for a user to join a group
     * 
     * @param $groupId - Integer: The ID of a group
     * @param $username - String: The username of a user
     * @return 'join' - Method: Adds a user to a group
     */
    public function join($groupId, $username) {
    	// Call the join method in GroupDataService
    	return $this->service->join($groupId, $username);
    }
    
    
    /**
     * Method for a user to leave a group
     *
     * @param $groupId - Integer: The ID of a group
     * @param $username - String: The username of a user
     * @return 'leave' - Method: Removes a user to a group
     */
    public function leave($groupId, $username) {
    	// Call the leave method in GroupDataService
    	return $this->service->leave($groupId, $username);
    }

}


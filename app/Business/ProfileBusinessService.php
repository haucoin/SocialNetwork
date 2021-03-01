<?php

namespace App\Business;

use App\Data\ProfileDataService;

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - ProfileBusinessService is a class that performs all business logic on the user profile data being sent and retrieved from the database
 */
class ProfileBusinessService implements BusinessServiceInterface {
	
	// Define service variable to be used as ProfileDataService
	private $service;
	
	
	/**
	 * Default constructor to initialize the Data Service object
	 */
	public function __construct() {
		$this->service = new ProfileDataService();
	}
	
	
	/**
	 * {@inheritDoc}
	 *
	 * @see \App\Business\BusinessServiceInterface::create()
	 */
	public function create($profile) {
		// Call the create method in ProfileDataService
		return $this->service->create($profile);
	}
	
	
	/**
	 * {@inheritDoc}
	 *
	 * @see \App\Business\BusinessServiceInterface::update()
	 */
	public function update($profile) {
		// Call the update method in ProfileDataService
		return $this->service->update($profile);
	}
	
	
	/**
	 * UNUSED FOR THIS BUSINESS SERVICE
	 */
	public function delete(int $id) { }
	
	
	/**
	 * UNUSED FOR THIS BUSINESS SERVICE
	 */
	public function viewAll() { }
	
	
	/**
	 * {@inheritDoc}
	 * 
	 * @see \App\Business\BusinessServiceInterface::viewById()
	 */
	public function viewById($userId) {
		// Call the viewById method in ProfileDataService
		return $this->service->viewById($userId);
	}

}


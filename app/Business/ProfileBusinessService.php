<?php

namespace App\Business;

use App\Data\ProfileDataService;

class ProfileBusinessService {
	
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
	public function createProfile($profile) {
		//Sends a object to to the data service in write to the database
		return $this->service->create($profile);
	}
	
	
	public function viewUserProfile($userId) {
		
		$currentProfile = $this->service->viewByUserId($userId);
		
		return $currentProfile;
	}
	
	/**
	 * {@inheritDoc}
	 *
	 * @see \App\Business\BusinessServiceInterface::update()
	 */
	public function updateProfile($profile) {
		//Sends an updated object to the data service
		return $this->service->update($profile);
	}
}


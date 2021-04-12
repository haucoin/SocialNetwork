<?php

namespace App\Business;

use App\Data\JobDataService;

/**
 * @name Social Network
 * @version 7.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - JobBusinessService is a class that performs all business logic on the job history data of users being sent and retrieved from the database
 */
class JobBusinessService implements BusinessServiceInterface {
	
	// Define service variable to be used as JobDataService
	private $service;
	
	
	/**
	 * Default constructor to initialize the Data Service object
	 */
	public function __construct() {
		$this->service = new JobDataService();
	}

	
	/**
	 * {@inheritDoc}
	 *
	 * @see \App\Business\BusinessServiceInterface::create()
	 */
	public function create($job) {
		// Call the create method in JobDataService
		return $this->service->create($job);
	}
	
	
	/**
	 * UNUSED FOR THIS BUSINESS SERVICE
	 */
	public function update($job) { }
	
	
	/**
	 * {@inheritDoc}
	 *
	 * @see \App\Business\BusinessServiceInterface::delete()
	 */
	public function delete($id) {
		// Call the delete method in JobDataService
		return $this->service->delete($id);
	}
	
	
	/**
	 * UNUSED FOR THIS BUSINESS SERVICE
	 */
	public function viewAll() { }
	

	/**
	 * UNUSED FOR THIS BUSINESS SERVICE
	 */
	public function viewById(int $id) { }

	
	// ---------------------- End of business interface implementation -------------------


	/**
	 * Method to get all jobs of a user
	 * 
	 * @param $userId - Integer: The ID of a user
	 * @return 'viewAllById' - Method: Retrieves all jobs of a user
	 */
	public function viewAllById($userId) {
		// Call the viewAllById method in JobDataService
		return $this->service->viewAllById($userId);
	}
	
}


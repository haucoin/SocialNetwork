<?php

namespace App\Business;

use App\Data\EducationDataService;

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - EducationBusinessService is a class that performs all business logic on the education history data of users being sent and retrieved from the database
 */
class EducationBusinessService implements BusinessServiceInterface {
	
	// Define service variable to be used as EducationDataService
	private $service;
	
	
	/**
	 * Default constructor to initialize the Data Service object
	 */
	public function __construct() {
		$this->service = new EducationDataService();
	}
	
	
	/**
	 * {@inheritDoc}
	 *
	 * @see \App\Business\BusinessServiceInterface::create()
	 */
	public function create($education) {
		// Call the create method in EducationDataService
		return $this->service->create($education);
	}
	
	
	/**
	 * UNUSED FOR THIS BUSINESS SERVICE
	 */
	public function update($object) { }
	
	
	/**
	 * {@inheritDoc}
	 *
	 * @see \App\Business\BusinessServiceInterface::delete()
	 */
	public function delete($id) {
		// Call the delete method in EducationDataService
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
	 * Method to get all education of a user
	 *
	 * @param $userId - Integer: The ID of a user
	 * @return 'viewAllById' - Method: Retrieves all education of a user
	 */
	public function viewAllById($userId) {
		// Call the viewByUserId method in EducationDataService
		return $this->service->viewAllById($userId);
	}
	
}


<?php

namespace App\Business;

use App\Data\EducationDataService;

class EducationBusinessService {
	
	// Define service variable to be used as EducationDataService
	private $service;
	
	
	/**
	 * Default constructor to initialize the Data Service object
	 */
	public function __construct() {
		$this->service = new EducationDataService();
	}
	
	
	public function viewAllUserEducation($userId) {
		
		$userEducation = $this->service->viewByUserId($userId);
		
		return $userEducation;
	}
	
	/**
	 * {@inheritDoc}
	 *
	 * @see \App\Business\BusinessServiceInterface::create()
	 */
	public function createEducation($education) {
		//Sends a object to to the data service in write to the database
		return $this->service->create($education);
	}
	
	public function delete($id) {
		return $this->service->delete($id);
	}
}


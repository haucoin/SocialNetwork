<?php

namespace App\Business;

use App\Data\JobDataService;

class JobBusinessService {
	
	// Define service variable to be used as JobDataService
	private $service;
	
	
	/**
	 * Default constructor to initialize the Data Service object
	 */
	public function __construct() {
		$this->service = new JobDataService();
	}
	
	
	public function viewAllUserJobs($userId) {
		
		$userJobs = $this->service->viewByUserId($userId);
		
		return $userJobs;
	}
	
	/**
	 * {@inheritDoc}
	 *
	 * @see \App\Business\BusinessServiceInterface::create()
	 */
	public function createJob($job) {
		//Sends a object to to the data service in write to the database
		return $this->service->create($job);
	}
}


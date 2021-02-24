<?php

namespace App\Business;

use App\Data\JobPostingDataService;

class PostBusinessService implements BusinessServiceInterface {
	
	// Define service variable to be used as JobDataService
	private $service;
	
	
	/**
	 * Default constructor to initialize the Data Service object
	 */
	public function __construct() {
		$this->service = new JobPostingDataService();
	}

	
    public function authenticate($object)
    {}

    public function viewById(int $id)
    {
        return $this->service->viewById($id);
    }

    public function create($post)
    {
        return $this->service->create($post);
    }

    public function update($post)
    {
        return $this->service->update($post);
    }

    public function delete(int $id)
    {
        return $this->service->delete($id);
    }

    public function viewAll()
    {
        $userJobs = $this->service->viewAll();
        
        return $userJobs;
    }

}


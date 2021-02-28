<?php

namespace App\Business;

use App\Data\JobPostingDataService;

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - PostBusinessService is a class that performs all business logic on the job posting data being sent and retrieved from the database
 */
class PostBusinessService implements BusinessServiceInterface {
	
	// Define service variable to be used as JobDataService
	private $service;
	
	
	/**
	 * Default constructor to initialize the Data Service object
	 */
	public function __construct() {
		$this->service = new JobPostingDataService();
	}

	
    /**
     * {@inheritDoc}
     *
     * @see \App\Business\BusinessServiceInterface::create()
     */
    public function create($post) {
    	// Call the create method in PostDataService
        return $this->service->create($post);
    }
       
    
    /**
     * {@inheritDoc}
     *
     * @see \App\Business\BusinessServiceInterface::update()
     */
    public function update($post) {
    	// Call the update method in PostDataService
        return $this->service->update($post);
    }

    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Business\BusinessServiceInterface::delete()
     */
    public function delete(int $id) {
    	// Call the delete method in PostDataService
        return $this->service->delete($id);
    }

    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Business\BusinessServiceInterface::viewAll()
     */
    public function viewAll() {
    	// Call the viewAll method in PostDataService
        return $this->service->viewAll();
    }
	
	
	/**
	 * {@inheritDoc}
	 * 
	 * @see \App\Business\BusinessServiceInterface::viewById()
	 */
	public function viewById(int $id) {
		// Call the viewById method in PostDataService
		return $this->service->viewById($id);
	}

}


<?php

namespace App\Business;

use App\Data\PostingDataService;

/**
 * @name Social Network
 * @version 6.0
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
		$this->service = new PostingDataService();
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
	
	
	// ---------------------- End of business interface implementation -------------------
	
	
	/**
	 * Method to get all postings that match a search parameter
	 *
	 * @param $searchParam - String: The search parameter that was entered by the user
	 * @return 'search' - Method: Retrieves all postings that match the search parameter
	 */
	public function search($searchParam) {
		// Call the search method in PostingDataService
		return $this->service->search($searchParam);
	}
	
	
	/*
	*
	* @param $sortBy - String: The string representing which column button was clicked to be sorted by
	* @param $jobPostings - Array<Posting>: The list of job postings
	* @return $jobPostings - Array<Posting>: The sorted list of job postings
	*/
	public function sort($sortBy, $jobPostings){
		
		/*
		* Based off the $sortBy string this method will sort the list of job postings.
		*
		* If $sortBy is id, the list is sorted by the id number
		* Else if $sortBy is companyName, the list is sorted by the companyNames
		* Else if $sortBy is jobTitle, the list is sorted by the jobTitles
		* Else if $sortBy is location, the list is sorted by the locations
		*
		*/
		if($sortBy == "id"){
			usort($jobPostings, function($a, $b) {return strcmp($a->getId(), $b->getId());});
		}
		else if($sortBy == "companyName"){
			usort($jobPostings, function($a, $b) {return strcmp($a->getCompanyName(), $b->getCompanyName());});
		}
		else if($sortBy == "jobTitle"){
			usort($jobPostings, function($a, $b) {return strcmp($a->getJobTitle(), $b->getJobTitle());});
		}
		else if($sortBy == "location"){
			usort($jobPostings, function($a, $b) {return strcmp($a->getLocation(), $b->getLocation());});
		}
		
		// return the sorted list
		return $jobPostings;
	}

}


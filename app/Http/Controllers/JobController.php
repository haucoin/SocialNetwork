<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Business\JobBusinessService;

session_start();

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - JobController is a controller class that handles the events and page navigation of job modules
 */
class JobController extends Controller {
	
	// Define service variable to be used as JobBusinessService
    private $jobService;
    
    
    /**
     * Default constructor to initialize the Business Service object
     */
    function __construct() {
    	$this->jobService = new JobBusinessService();
    }
    
    
	/**
	 * Method to create a job within a users profile
	 * 
     * @param $request - Request: The request object sent from the form submission
	 * @return 'profile' - Route: A redirect to the /profile route
	 */
    public function createJob(Request $request) {
    	// Get the variables within $request passed in through the form
    	$title = $request->input('title');
    	$description = $request->input('description');
    	$company = $request->input('company');
    	$location = $request->input('location');
    	$startDate = $request->input('startDate');
    	$endDate = $request->input('endDate');
    	
    	// Check if there was an end date inserted, if not set to null
    	if($endDate == "") {
    		$endDate = null;
    	}
    	
    	// Create a Job object using variables
    	$job = new Job(0, $title, $description, $company, $location, $startDate, $endDate, $_SESSION['currentUser']->getId());
    	
    	// Call create method in JobBusinessService
    	$this->jobService->create($job);
        
    	// Redirect to the /profile route
    	return redirect()->route('profile');
    }
    
    
    /**
     * Method to delete a job from a users profile
     *
     * @param $request - Request: The request object sent from the form submission
	 * @return 'profile' - Route: A redirect to the /profile route
     */
    public function deleteJob(Request $request) {
    	// Get the variable within $request passed in through the form
    	$jobId = $request->input('jobId');
    	
    	// Call delete method in JobBusinessService
    	$this->jobService->delete($jobId);
    	
    	// Redirect to the /profile route
    	return redirect()->route('profile');
    }  
 
}

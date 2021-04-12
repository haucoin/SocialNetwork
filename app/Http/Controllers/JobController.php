<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Utility\LoggerInterface;
use App\Business\JobBusinessService;
use Exception;

session_start();

/**
 * @name Social Network
 * @version 7.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - JobController is a controller class that handles the events and page navigation of job modules
 */
class JobController extends Controller {
	
	// Define service variable to be used as JobBusinessService
    private $jobService;
    
    // Define protected logger variable
    protected $logger;
    
    
    /**
     * Default constructor to initialize the Business Service object as well as the logging interface
     */
    function __construct(LoggerInterface $logger) {
    	$this->jobService = new JobBusinessService();
    	
    	$this->logger = $logger;
    }
    
    
	/**
	 * Method to create a job within a users profile
	 * 
     * @param $request - Request: The request object sent from the form submission
	 * @return 'profile' - Route: A redirect to the /profile route
	 */
    public function createJob(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering JobController.createJob()");
    	
    	try {
    		// Get the variables within $request passed in through the form
    		$titleStart = $request->input('title');
    		$descriptionStart = $request->input('description');
    		$companyStart = $request->input('company');
    		$locationStart = $request->input('location');
    		$startDate = $request->input('startDate');
    		$endDate = $request->input('endDate');
    		
    		// Replace all ' with \' to allow for ' in SQL statements in the data layer
    		$titleReplace = str_replace("'", "\'", $titleStart);
    		$descriptionReplace = str_replace("'", "\'", $descriptionStart);
    		$companyReplace = str_replace("'", "\'", $companyStart);
    		$locationReplace = str_replace("'", "\'", $locationStart);
    		// Replace all " with \" to allow for " in SQL statements in the data layer
    		$title = str_replace('"', '\"', $titleReplace);
    		$description = str_replace('"', '\"', $descriptionReplace);
    		$company = str_replace('"', '\"', $companyReplace);
    		$location = str_replace('"', '\"', $locationReplace);
    		
    		// Check if there was an end date inserted, if not set to null
    		if($endDate == "") {
    			$endDate = null;
    		}
    		
    		// Create a Job object using variables
    		$job = new Job(0, $title, $description, $company, $location, $startDate, $endDate, $_SESSION['currentUser']->getId());
    		
    		// Call create method in JobBusinessService
    		$this->jobService->create($job);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving JobController.createJob() successfully");
    		
    		// Redirect to the /profile route
    		return redirect()->route('profile');
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: JobController.createJob()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to delete a job from a users profile
     *
     * @param $request - Request: The request object sent from the form submission
	 * @return 'profile' - Route: A redirect to the /profile route
     */
    public function deleteJob(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering JobController.deleteJob()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$jobId = $request->input('jobId');
    		
    		// Call delete method in JobBusinessService
    		$this->jobService->delete($jobId);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving JobController.deleteJob() successfully");
    		
    		// Redirect to the /profile route
    		return redirect()->route('profile');
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: JobController.deleteJob()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }  
 
}

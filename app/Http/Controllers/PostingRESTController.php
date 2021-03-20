<?php

namespace App\Http\Controllers;

use App\Business\PostBusinessService;
use App\Models\DTO;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * @name Social Network
 * @version 6.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - PostingRESTController is a controller class that acts as a REST API for posting objects
 */
class PostingRESTController extends Controller {
	
    /**
     * Method to display all posting objects
     *
     * @return $json - Json: DTO encoded in json
     */
    public function index() { 
    	
    	// Logging entering method
    	Log::info("======> Entering PostingRESTController.index()");
    	
    	try {
    		// Initialize the Post Business Service object, call viewAll method and set to variable
    		$jobsService = new PostBusinessService();
    		$jobs = $jobsService->viewAll();
    		
    		// Check if the variable is null, set DTO to no data found
    		if($jobs == null) {
    			$dto = new DTO(400, "No data could be retrieved from the database", null);
    		}
    		// Variable is not null, store it in DTO object
    		else {
    			$dto = new DTO(200, "OK", $jobs);
    		}
    		
    		// Encode the DTO as json
    		$json = json_encode($dto);
    		
    		// Logging leaving method and return json object
    		Log::info("======> Leaving PostingRESTController.index()");
    		return $json;
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Create DTO object with exception information
    		$dto = new DTO(400, $e->getMessage(), array());
    		
    		// Encode the DTO as json
    		$json = json_encode($dto);
    		
    		// Logging with an error  and return json object
    		Log::error("*** Error: PostingRESTController.index() ", array("message" => $e->getMessage()));
    		return $json;
     	}
    }


    /**
   	 * Method to display a post object given the ID
     *
     * @param $id - Integer: The ID of a job posting
     * @return $json - Json: DTO encoded in json
     */
    public function show($id) {
    	
    	// Logging entering method
    	Log::info("======> Entering PostingRESTController.show()");
    	
    	try {
    		// Initialize the Post Business Service object, call viewById method and set to variable
    		$jobsService = new PostBusinessService();
    		$job = $jobsService->viewById($id);
    		
    		// Check if the attributes are null (to know the data that was retrieved is empty), set DTO to no data found
    		if($job->getCompanyName() == null && $job->getJobTitle() == null) {
    			$dto = new DTO(400, "No data could be retrieved at the given id", null);
    		}
    		// Variable is not null, store it in DTO object
    		else {
    			$dto = new DTO(200, "OK", $job);
    		}
    		
    		// Encode the DTO as json
    		$json = json_encode($dto);
    		
    		// Logging leaving method and return json object
    		Log::info("======> Leaving PostingRESTController.show()");
    		return $json;
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Create DTO object with exception information
    		$dto = new DTO(400, $e->getMessage(), array());
    		
    		// Encode the DTO as json
    		$json = json_encode($dto);
    		
    		// Logging with an error  and return json object
    		Log::error("*** Error: PostingRESTController.show() ", array("message" => $e->getMessage()));
    		return $json;
    	}
    }

}

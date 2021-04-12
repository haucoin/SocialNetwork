<?php

namespace App\Http\Controllers;

use App\Business\ProfileBusinessService;
use App\Models\DTO;
use App\Utility\LoggerInterface;
use Exception;

/**
 * @name Social Network
 * @version 7.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - ProfileRESTController is a controller class that acts as a REST API for profile objects
 */
class ProfileRESTController extends Controller {
	
	// Define service variable to be used as ProfileBusinessService
	private $profileService;
	
	// Define protected logger variable
	protected $logger;
	
	
	/**
	 * Default constructor to initialize the Business Service object as well as the logging interface
	 */
	function __construct(LoggerInterface $logger) {
		$this->profileService = new ProfileBusinessService();
		
		$this->logger = $logger;
	}
    
	
    /**
     * Method to display a profile ojbect given the user ID
     *
     * @param $userId - Integer: The ID of a user
     * @return $json - Json: DTO encoded in json
     */
	public function show($userId) {
		
		// Logging entering method
		$this->logger->info("======> Entering ProfileRESTController.show()");
		
    	try {
    		// Call viewById method and set to variable
    		$profile = $this->profileService->viewById($userId);

    		// Check if the ID is null (to know the data that was retrieved is empty), set DTO to no data found
    		if($profile->getId() == null) {
    			$dto = new DTO(400, "No data could be retrieved at the given user id", null);
    		}
    		// Variable is not null, store it in DTO object
    		else {
    			$dto = new DTO(200, "OK", $profile);
    		}

    		// Encode the DTO as json
    		$json = json_encode($dto);

    		// Logging leaving method and return json object
    		$this->logger->info("======> Leaving ProfileRESTController.show()");
    		return $json;
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Create DTO object with exception information
    		$dto = new DTO(400, $e->getMessage(), array());

    		// Encode the DTO as json
    		$json = json_encode($dto);

    		// Logging with an error  and return json object
    		$this->logger->error("*** Error: ProfileRESTController.show() ", array("message" => $e->getMessage()));
    		return $json;
    	}
    }

}

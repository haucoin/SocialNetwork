<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Education;
use App\Utility\LoggerInterface;
use App\Business\EducationBusinessService;
use Exception;

session_start();

/**
 * @name Social Network
 * @version 7.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - EducationController is a controller class that handles the events and page navigation of the education modules
 */
class EducationController extends Controller {
	
	// Define service variable to be used as EducationBusinessService
    private $educationService;
    
    // Define protected logger variable
    protected $logger;
    
    
    /**
     * Default constructor to initialize the Business Service object as well as the logging interface
     */
    function __construct(LoggerInterface $logger) {
    	$this->educationService = new EducationBusinessService();
    	
    	$this->logger = $logger;
    }
    
    
	/**
	 * Method to create an education object of a user to be displayed on their profile
	 * 
     * @param $request - Request: The request object sent from the form submission
	 * @return 'profile' - Route: A redirect to the /profile route
	 */
    public function createEducation(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering EducationController.createEducation()");
    	
    	try {
    		// Get the variables within $request passed in through the form
    		$schoolStart = $request->input('school');
    		$degree = $request->input('degree');
    		$fieldOfStudyStart = $request->input('fieldOfStudy');
    		$graduationYear = $request->input('graduationYear');
    		$gpa = $request->input('gpa');
    		
    		// Replace all ' with \' to allow for ' in SQL statements in the data layer
    		$schoolReplace = str_replace("'", "\'", $schoolStart);
    		$fieldOfStudyReplace = str_replace("'", "\'", $fieldOfStudyStart);
    		// Replace all " with \" to allow for " in SQL statements in the data layer
    		$school = str_replace('"', '\"', $schoolReplace);
    		$fieldOfStudy = str_replace('"', '\"', $fieldOfStudyReplace);	
    		
    		// Create an education object using the variables
    		$education = new Education(0, $school, $degree, $fieldOfStudy, $graduationYear, $gpa, $_SESSION['currentUser']->getId());
    		
    		// Call the create method in EducationBusinessService
    		$this->educationService->create($education);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving EducationController.createEducation() successfully");
    		
    		// Redirect to the /profile route
    		return redirect()->route('profile');
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: EducationController.createEducation()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to delete an education object of a user from their profile
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'profile' - Route: A redirect to the /profile route
     */
    public function deleteEducation(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering EducationController.deleteEducation()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$educationId = $request->input('educationId');
    		
    		// Call the delete method in EducationBusinessService
    		$this->educationService->delete($educationId);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving EducationController.deleteEducation() successfully");
    		
    		// Redirect to the /profile route
    		return redirect()->route('profile');
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: EducationController.deleteEducation()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
}

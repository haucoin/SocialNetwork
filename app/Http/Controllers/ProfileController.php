<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Utility\LoggerInterface;
use App\Business\ProfileBusinessService;
use App\Business\JobBusinessService;
use App\Business\EducationBusinessService;
use Exception;

session_start();

/**
 * @name Social Network
 * @version 6.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - ProfileController is a controller class that handles the events and page navigation of the profile for a user
 */
class ProfileController extends Controller {
	
	// Define service variable to be used as ProfileBusinessService
    private $profileService;
    // Define service variable to be used as JobBusinessService
    private $jobService;
    // Define service variable to be used as EducationBusinessService
    private $educationService;
    
    // Define protected logger variable
    protected $logger;
    
    
    /**
     * Default constructor to initialize the Business Service objects as well as the logging interface
     */
    function __construct(LoggerInterface $logger) {
    	$this->profileService = new ProfileBusinessService();
    	$this->jobService = new JobBusinessService();
    	$this->educationService = new EducationBusinessService();
    	
    	$this->logger = $logger;
    }
    
    
	/**
	 * Method to view a user's profile by gathering all information about the user and their job and education history
	 * 
	 * @return 'profile' - View: The profile of a user containing their information
	 */
    public function viewProfile() {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering ProfileController.viewProfile()");
    	
    	try {
    		// Call viewById method in ProfileBusinessService and set to variable
    		$userProfile = $this->profileService->viewById($_SESSION['currentUser']->getId());
    		// Call viewAllById method in JobBusinessService and set to variable
    		$jobHistory = $this->jobService->viewAllById($_SESSION['currentUser']->getId());
    		// Call viewAllById method in EducationBusinessService and set to variable
    		$educationHistory = $this->educationService->viewAllById($_SESSION['currentUser']->getId());
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving ProfileController.viewProfile() successfully");
    		
    		// Set $data variable to a the userProfile, jobHistory, and educationHistory variables and return to the profile view
    		$data = ['userProfile' => $userProfile, 'jobHistory' => $jobHistory, 'educationHistory' => $educationHistory];
    		return view('profile')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: ProfileController.viewProfile()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to show the edit page for a profile
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'profile' - View: The profile of a user containing their information
     */
    public function editProfile(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering ProfileController.editProfile()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$userId = $request->input('userId');
    		
    		// Call the viewByUserId method in the ProfileBusinessService
    		$profile = $this->profileService->viewById($userId);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving ProfileController.editProfile() successfully");
    		
    		// Set $data variable to a the profile variable and return to the profile view
    		$data = ['userProfile' => $profile];
    		return view('editProfile')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: ProfileController.editProfile()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    
    /**
     * Method to save the user's information after an edit and redisplay the profile
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'profile' - View: The profile of a user containing their information
     */
    public function updateProfile(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering ProfileController.updateProfile()");
    	
    	try {
    		// Get the variables within $request passed in through the form
    		$id = $request->input('profileId');
    		$bioStart = $request->input('bio');
    		$cityStart = $request->input('city');
    		$stateStart = $request->input('state');
    		$skillsStart = $request->input('skills');
    			
    		// Replace all ' with \' to allow for ' in SQL statements in the data layer
    		$bioReplace = str_replace("'", "\'", $bioStart);
    		$cityReplace = str_replace("'", "\'", $cityStart);
    		$stateReplace = str_replace("'", "\'", $stateStart);
    		$skillsReplace = str_replace("'", "\'", $skillsStart);
    		// Replace all " with \" to allow for " in SQL statements in the data layer
    		$bio = str_replace('"', '\"', $bioReplace);
    		$city = str_replace('"', '\"', $cityReplace);
    		$state = str_replace('"', '\"', $stateReplace);
    		$skills = str_replace('"', '\"', $skillsReplace);
    		
    		// Create a new profile object
    		$profile = new Profile($id, $bio, $city, $state, $skills, $_SESSION['currentUser']->getId());
    		// Call the update method in the ProfileBusinessService
    		$this->profileService->update($profile);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving ProfileController.updateProfile() successfully");
    		
    		// Call the viewProfile method above to shown the profile again after being updated
    		return $this->viewProfile();
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: ProfileController.updateProfile()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
 
}

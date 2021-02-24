<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Business\ProfileBusinessService;
use App\Business\JobBusinessService;
use App\Business\EducationBusinessService;

session_start();

/**
 * @name Social Network
 * @version 3.0
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
    
    
    /**
     * Default constructor to initialize the Business Service objects
     */
    function __construct() {
    	$this->profileService = new ProfileBusinessService();
    	$this->jobService = new JobBusinessService();
    	$this->educationService = new EducationBusinessService();
    }
    
    
	/**
	 * Method to view a user's profile by gathering all information about the user and their job and education history
	 * 
	 * @return 'profile' - View: The profile of a user containing their information
	 */
    public function viewMyProfile() {
    	
    	// Call viewUserProfile method in ProfileBusinessService and set to variable
    	$userProfile = $this->profileService->viewUserProfile($_SESSION['currentUser']->getId());
    	// Call viewAllUserJobs method in JobBusinessService and set to variable
    	$jobHistory = $this->jobService->viewAllUserJobs($_SESSION['currentUser']->getId());
    	// Call viewAllUserEducation method in EducationBusinessService and set to variable
    	$educationHistory = $this->educationService->viewAllUserEducation($_SESSION['currentUser']->getId());
        
    	// Set $data variable to a the userProfile, jobHistory, and educationHistory variables and return to the profile view
    	$data = ['userProfile' => $userProfile, 'jobHistory' => $jobHistory, 'educationHistory' => $educationHistory];
    	return view('profile')->with($data);
    }
    
    
    /**
     * Method to edit a user's information
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'profile' - View: The profile of a user containing their information
     */
    public function editProfilePage(Request $request) {
    	// Get the variables within $request passed in through the form
    	$userId = $request->input('userId');
    	
    	// Call the viewByUserId method in the ProfileBusinessService
    	$profile = $this->profileService->viewUserProfile($userId);
    
    	// Set $data variable to a the profile variables and return to the profile view
    	$data = ['userProfile' => $profile];
    	return view('editProfile')->with($data);
    }
    
    
    
    /**
     * Method to save the user's information after an edit and redisplay the profile
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'profile' - View: The profile of a user containing their information
     */
    public function editProfile(Request $request) {
    	// Get the variables within $request passed in through the form
    	$id = $request->input('profileId');
    	$bio = $request->input('bio');
    	$city = $request->input('city');
    	$state = $request->input('state');
    	$skills = $request->input('skills');
    	
    	// Create a new profile object and call the updateProfile method in the ProfileBusinessService
    	$profile = new Profile($id, $bio, $city, $state, $skills, $_SESSION['currentUser']->getId());
    	$this->profileService->updateProfile($profile);
        
    	// Call the viewMyProfile method above to shown the profile again after being updated
    	return $this->viewMyProfile();
    }
    
 
}

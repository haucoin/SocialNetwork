<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Education;
use App\Business\ProfileBusinessService;
use App\Business\JobBusinessService;
use App\Business\EducationBusinessService;

session_start();

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - UserController is a controller class that handles the events and page navigation of the login and register modules and other user features
 */
class EducationController extends Controller {
	
	// Define service variables to be used as business services
    private $educationService;
    
    
    /**
     * Default constructor to initialize the Business Service objects
     */
    function __construct() {
    	$this->educationService = new EducationBusinessService();
    }
    
    

    public function addUserEducation(Request $request) {
    	
    	$school = $request->input('school');
    	$degree = $request->input('degree');
    	$fieldOfStudy = $request->input('fieldOfStudy');
    	$graduationYear = $request->input('graduationYear');
    	$gpa = $request->input('gpa');
    	
    	$education = new Education(0, $school, $degree, $fieldOfStudy, $graduationYear, $gpa, $_SESSION['currentUser']->getId());
    	
    	// Call viewAllUserEducation method in EducationBusinessService and set to variable
    	$this->educationService->createEducation($education);
        
    	return redirect()->route('profile');
    }
    
    
    /**
     * Method to edit a user's information
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'profile' - View: The profile of a user containing their information
     */
//     public function editProfilePage(Request $request) {
//     	// Get the variables within $request passed in through the form
//     	$userId =  $request->input('userId');
    	
//     	// Call the viewByUserId method in the business servicee
//     	$profile = $this->profileService->viewUserProfile($userId);
    
//     	// Set $data variable to a the profile variables and return to the profile view
//     	$data = ['userProfile' => $profile];
//     	return view('editProfile')->with($data);
//     }
    
    
    
    /**
     * Method to edit a user's information
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'profile' - View: The profile of a user containing their information
     */
//     public function editProfile(Request $request) {
//     	// Get the variables within $request passed in through the form
//     	$id =  $request->input('profileId');
//     	$bio =  $request->input('bio');
//     	$city =  $request->input('city');
//     	$state =  $request->input('state');
//     	$skills =  $request->input('skills');
    	
//     	// Call the viewByUserId method in the business servicee
//     	$profile = new Profile($id, $bio, $city, $state, $skills, $_SESSION['currentUser']->getId());
        
//         // Call the update method within the bussiness service, set the session
//     	$this->profileService->updateProfile($profile);
        
//     	return $this->viewMyProfile();
//     }
    
 
}

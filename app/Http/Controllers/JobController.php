<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Business\JobBusinessService;

session_start();

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - UserController is a controller class that handles the events and page navigation of the login and register modules and other user features
 */
class JobController extends Controller {
	
	// Define service variables to be used as business services
    private $jobService;
    
    
    /**
     * Default constructor to initialize the Business Service objects
     */
    function __construct() {
    	$this->jobService = new JobBusinessService();
    }
    
    

    public function addUserJob(Request $request) {
    	
    	$title = $request->input('title');
    	$description = $request->input('description');
    	$company = $request->input('company');
    	$location = $request->input('location');
    	$startDate = $request->input('startDate');
    	$endDate = $request->input('endDate');
    	
    	if($endDate == "") {
    		$endDate = null;
    	}
    	
    	$job = new Job(0, $title, $description, $company, $location, $startDate, $endDate, $_SESSION['currentUser']->getId());
    	
    	// Call viewAllUserEducation method in EducationBusinessService and set to variable
    	$this->jobService->createJob($job);
        
    	return redirect()->route('profile');
    }
    
    
    /**
     * Method to delete a user (physical delete) from the website
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'admin' - View: The admin user page that displays all users
     */
    public function deleteJob(Request $request) {
    	// Gets the users id that is being requested to delete
    	$jobId = $request->input('jobId');
    	
    	// Call the delete method within the business service to delete the user given the id
    	$this->jobService->delete($jobId);
    	
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\business\UserBusinessService; 
use App\business\ProfileBusinessService; 
use App\Business\JobBusinessService;
use App\Business\EducationBusinessService;

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - AdminController is a controller class that handles the events and page navigation of admin modules
 */
class AdminController extends Controller {
   
	// Define service variable to be used as UserBusinessService
	private $userService;
	// Define service variable to be used as ProfileBusinessService
	private $profileService;
	private $jobService;
	private $educationService;
    
	
	/**
	 * Default constructor to initialize the Business Service objectz
	 */
    function __construct() {
        $this->userService = new UserBusinessService();
        $this->profileService = new ProfileBusinessService();
        $this->jobService = new JobBusinessService();
        $this->educationService = new EducationBusinessService();
    }
    
    
    /**
     * Method to direct a user to the admin page that shows all users' account information
     * 
     * @return 'admin' - View: The admin user page that displays all users
     */
    public function adminPage() {
    	// Set $data variable to a userList containing all users (retrieved by calling method in businesss service)
    	$data = ['userList' => $this->userService->viewAll()];
        
        // Return to the admin view
        return view('admin')->with($data); 
    }
    
    
    /**
     * Method to delete a user (physical delete) from the website
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'admin' - View: The admin user page that displays all users
     */
    public function deleteUser(Request $request) {
        // Gets the users id that is being requested to delete
        $userId = $request->input('userId');
        
        // Call the delete method within the business service to delete the user given the id
        $this->userService->delete($userId);
        
        // Set $data variable to a userList containing all users (retrieved by calling method in businesss service)
        $data = ['userList' => $this->service->viewAll()];
        return view('admin')->with($data); 
    }
    
    
    /**
     * Mehtod to suspend a user (logical delete) from the website
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'admin' - View: The admin user page that displays all users
     */
    public function suspendUser(Request $request) {
        // Get the users id that is being requested to suspend
        $userId = $request->input('userId');
        
        // Get the user object by called the viewById method in the business service
        $currentUser = $this->userService->viewById($userId);
        
        // Verify if the user is currently active
        if($currentUser->getActive() == 1) {
            $currentUser->setActive(0);
        }
        // The user is currently inactive
        else {
            $currentUser->setActive(1);
        }
        
        // Update the users information by calling the update method within the business service
        $this->userService->update($currentUser);
        
        // Set $data variable to a userList containing all users (retrieved by calling method in businesss service)
        $data = ['userList' => $this->userService->viewAll()];
        return view('admin')->with($data); 
    }
    
    
    /**
     * Method to view a user's information
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'adminUserView' - View: The admin's view of a user's profile page
     */
    public function viewUser(Request $request) {
        // Get the users id that is being requested to view
        $userId = $request->input('userId');
        
        $user = $this->userService->viewById($userId);
        $userProfile = $this->profileService->viewUserProfile($userId);
        // Call viewAllUserJobs method in JobBusinessService and set to variable
        $jobHistory = $this->jobService->viewAllUserJobs($userId);
        // Call viewAllUserEducation method in EducationBusinessService and set to variable
        $educationHistory = $this->educationService->viewAllUserEducation($userId);
        
        // Set $data variable to a currentUser containing the user's information (retrieved by calling method in businesss service)
        $data = ['currentUser' => $user, 'userProfile' => $userProfile, 'jobHistory' => $jobHistory, 'educationHistory' => $educationHistory];
        return view('adminProfile')->with($data); 
    }
    
    
    public function adminEdit(Request $request) {
    	// Get the variables within $request passed in through the form
    	$userId =  $request->input('userId');
    	
    	$user = $this->userService->viewById($userId);
    	$userProfile = $this->profileService->viewUserProfile($userId);
    	// Call viewAllUserJobs method in JobBusinessService and set to variable
    	$jobHistory = $this->jobService->viewAllUserJobs($userId);
    	// Call viewAllUserEducation method in EducationBusinessService and set to variable
    	$educationHistory = $this->educationService->viewAllUserEducation($userId);
    	
    	// Set $data variable to a the profile variables and return to the profile view
    	$data = ['currentUser' => $user, 'userProfile' => $userProfile, 'jobHistory' => $jobHistory, 'educationHistory' => $educationHistory];
    	return view('adminEditProfile')->with($data);
    }
    
    
    /**
     * Method to edit a user's information
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'adminUserView' - View: The admin's view of a user's profile page
     */
    public function adminSaveUser(Request $request) {
    	// Get the variables within $request passed in through the form
    	$userId = $request->input('userId');
    	$role =  $request->input('role');
    	$active =  $request->input('active');
    	
    	$user = $this->userService->viewById($userId);
    	
    	$user->setRole($role);
    	$user->setActive($active);
    	
    	// Call the update method within the business service function in order to update the user
    	$this->userService->update($user);
    	
    	return $this->adminPage();
    }
}

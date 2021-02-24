<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\business\UserBusinessService; 
use App\business\ProfileBusinessService; 
use App\Business\JobBusinessService;
use App\Business\EducationBusinessService;
use App\Business\PostBusinessService;
use App\Models\JobPosting;

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
	private $postingService;
    
	
	/**
	 * Default constructor to initialize the Business Service objectz
	 */
    function __construct() {
        $this->userService = new UserBusinessService();
        $this->profileService = new ProfileBusinessService();
        $this->jobService = new JobBusinessService();
        $this->educationService = new EducationBusinessService();
        $this->postingService = new PostBusinessService();
    }
    
    
    /**
     * Method to direct a user to the admin page that shows all users' account information
     * 
     * @return 'admin' - View: The admin user page that displays all users
     */
    public function adminUsersPage() {
    	// Set $data variable to a userList containing all users (retrieved by calling method in businesss service)
    	$data = ['userList' => $this->userService->viewAll()];
        
        // Return to the admin view
        return view('adminUsers')->with($data); 
    }
    
    /**
     * Method to direct a user to the admin page that shows all users' account information
     *
     * @return 'admin' - View: The admin user page that displays all users
     */
    public function adminJobPostingsPage() {
    	// Set $data variable to a userList containing all users (retrieved by calling method in businesss service)
    	$data = ['postList' => $this->postingService->viewAll()];
    	
    	// Return to the admin view
    	return view('adminJobPostings')->with($data); 
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
        return view('adminUsers')->with($data); 
    }
    
    /**
     * Method to delete a post (physical delete) from the website
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'post' - View: The job post page that displays all job postings
     */
    public function deletePost(Request $request) {
    	// Gets the job post id that is being requested to delete
    	$postId = $request->input('postId');
    	
    	// Call the delete method within the business service to delete the post given the id
    	$this->postingService->delete($postId);
    	
    	// Set $data variable to a postList containing all users (retrieved by calling method in businesss service)
    	$data = ['postList' => $this->postingService->viewAll()];
    	return view('adminJobPostings')->with($data);
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
        return view('adminUsers')->with($data); 
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
     * Method to view a user's information
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'adminUserView' - View: The admin's view of a user's profile page
     */
    public function viewPost(Request $request) {
    	// Get the users id that is being requested to view
    	$postId = $request->input('postId');

    	$post = $this->postingService->viewById($postId);
    	
    	// Set $data variable to a currentUser containing the user's information (retrieved by calling method in businesss service)
    	$data = ['post' => $post];
    	return view('adminViewPosting')->with($data);
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
    
    
    
    public function addJobPosting(Request $request) {
    	
    	$company = $request->input('companyName');
    	$title = $request->input('jobTitle');
    	$description = $request->input('jobDescription');
    	$salary = $request->input('salary');
    	$location = $request->input('location');

    	$posting = new JobPosting(0, $company, $title, $description, $salary, $location);
    	
    	// Call viewAllUserEducation method in EducationBusinessService and set to variable
    	$this->postingService->create($posting);
    	
    	return redirect()->route('adminPostings');
    }
    
    
    
    public function editPostPage(Request $request) {
    	// Get the variables within $request passed in through the form
    	$postId =  $request->input('postId');
    	
    	$post = $this->postingService->viewById($postId);
    	
    	// Set $data variable to a the profile variables and return to the profile view
    	$data = ['currentPost' => $post];
    	return view('editJobPosting')->with($data);
    }
    
    
    /**
     * Method to edit a job post
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'adminUserView' - View: The admin's view of a job post
     */
    public function adminSavePost(Request $request) {
    	// Get the variables within $request passed in through the form
    	$id = $request->input('postId');
    	$companyName =  $request->input('companyName');
    	$jobTitle=  $request->input('jobTitle');
    	$jobDescription =  $request->input('jobDescription');
    	$salary =  $request->input('salary');
    	$location =  $request->input('location');
    	
    	$post = $this->postingService->viewById($id);
    	
    	$post->setCompanyName($companyName);
    	$post->setJobTitle($jobTitle);
    	$post->setJobDescription($jobDescription);
    	$post->setSalary($salary);
    	$post->setLocation($location);
    	
    	// Call the update method within the business service function in order to update the post
    	$this->postingService->update($post);
    	
    	return $this->adminJobPostingsPage();
    }
}

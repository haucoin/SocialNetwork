<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Utility\LoggerInterface;
use App\Business\UserBusinessService;
use App\Business\ProfileBusinessService;
use App\Business\JobBusinessService;
use App\Business\EducationBusinessService;
use App\Business\GroupBusinessService;
use App\Business\PostBusinessService;
use Exception;

session_start();

/**
 * @name Social Network
 * @version 6.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - UserController is a controller class that handles the events and page navigation of the login and register modules and other user features
 */
class UserController extends Controller {
	
	// Define service variable to be used as UserBusinessService
    private $userService;  
    // Define service variable to be used as ProfileBusinessService
    private $profileService;
    // Define service variable to be used as JobBusinessService
    private $jobService;
    // Define service variable to be used as EducationBusinessService
    private $educationService;
    // Define service variable to be used as GroupBusinessService
    private $groupService;
    // Define service variable to be used as PostBusinessService
    private $postService;
    
    // Define protected logger variable
    protected $logger;
    
    
    /**
     * Default constructor to initialize the Business Service objects as well as the logging interface
     */
    function __construct(LoggerInterface $logger) {
    	$this->userService = new UserBusinessService();
    	$this->profileService = new ProfileBusinessService();
    	$this->jobService = new JobBusinessService();
    	$this->educationService = new EducationBusinessService();
    	$this->groupService = new GroupBusinessService();
    	$this->postService = new PostBusinessService();
    	
    	$this->logger = $logger;
    }
    
    
    /**
     * Method to authenticate a user given their credentials
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'homePage' - View: The home page a user reaches once logged in
     * @return 'login' - View: The login page showing an error message
     */
    public function authenticateUser(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering UserController.authenticateUser()");
    	
    	try {
    		// Get the variables stored within $request that were passed in through the form
    		$username = $request->input('username');
    		$password = $request->input('password');
    		
    		// Create a User object with the parameters
    		$user = new User(0, "", "", $username, $password, "", "", null, null);
    		
    		// Calls the authenticate method within UserBusinessService to determine if the user is authenticated
    		if($this->userService->authenticate($user)) {
    			// Set $currentUser variable to user object within the session (set in business service)
    			$currentUser = $_SESSION['currentUser'];
    			
    			// Verification to determine if the user is currently suspended
    			if($currentUser->getActive() == 1) {
    				// Set the session of the current user
    				$request->session()->put('currentUser', $currentUser);
    				
    				// Logging leaving method
    				$this->logger->info("======> Leaving UserController.authenticateUser() after a succesful login");
    				
    				// Send the user to the homepage by calling viewHome method
    				return $this->viewHome();
    			}
    			// The user is currently suspended
    			else  {
    				// Logging leaving method
    				$this->logger->info("======> Leaving UserController.authenticateUser() with notifying the user of their suspended account");
    				
    				// Set $data variable to a returnMessage containing the error information, return to the login view
    				$data = ['returnMessage' => "Your account is disable, contact us for more information."];
    				return view('login')->with($data);
    			}
    		}
    		// The user failed to authenticate
    		else {
    			// Logging leaving method
    			$this->logger->info("======> Leaving UserController.authenticateUser() with an invalid login");
    			
    			// Set $data variable to a returnMessage containing the error information, return to the login view
    			$data = ['returnMessage' => "Incorrect username or password."];
    			return view('login')->with($data);
    		}
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: UserController.authenticateUser() ", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to register a user using the information provided
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'homePage' - View: The home page a user reaches once registered
     * @return 'registration' - View: The registration page showing an error message
     */
    public function registerUser(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering UserController.registerUser()");
    	
    	try {
    		// Get the variables within $request passed in through the form
    		$firstName =  $request->input('firstName');
    		$lastName =  $request->input('lastName');
    		$username =  $request->input('username');
    		$password =  $request->input('password');
    		$email =  $request->input('email');
    		$phoneNumber =  $request->input('phoneNumber');
    		
    		// Create a User object with the parameters (set to normal and active user)
    		$user = new User(0, $firstName, $lastName, $username, $password, $email, $phoneNumber, 1, 1);
    		
    		// Calls the create method within UserBusinessService to register a new user
    		$result = $this->userService->create($user);
    		
    		// Verify if the creation was a success
    		if($result == 1) {
    			
    			// Set the session variable to the new user
    			$request->session()->put('currentUser', $_SESSION['currentUser']);
    			
    			// Create empty profile for the new user, call create method in ProfileBusinessService
    			$profile = new Profile(0, "", "", "", "", $_SESSION['currentUser']->getId());
    			$this->profileService->create($profile);
    			
    			// Logging leaving method
    			$this->logger->info("======> Leaving UserController.registerUser() with a successful registration");
    			
    			// Send to the homePage view by calling viewHome method
    			return $this->viewHome();
    		}
    		// Failed to register the user, username already exists
    		else if($result == -1) {
    			// Logging leaving method
    			$this->logger->info("======> Leaving UserController.registerUser() with an invalid registration");
    			
    			// Set $data variable to a returnMessage containing the error information, return to the registration view
    			$data = ['returnMessage' => "Username is already taken, please try again."];
    			return view('registration')->with($data);
    		}
    		// Failed to register the user, other error occurred
    		else {
    			// Logging leaving method
    			$this->logger->info("======> Leaving UserController.registerUser() with an error after the request");
    			
    			// Set $data variable to a returnMessage containing the error information, return to the registration view
    			$data = ['returnMessage' => "An error occurred trying to process your request."];
    			return view('registration')->with($data);
    		}
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: UserController.registerUser() ", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to edit a user's information in the settings page
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'settings' - View: The settings page of a user containing their information
     */
    public function updateUser(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering UserController.updateUser()");
    	
    	try {
    		// Get the variables within $request passed in through the form
    		$firstName =  $request->input('firstName');
    		$lastName =  $request->input('lastName');
    		$password =  $request->input('password');
    		$email =  $request->input('email');
    		$phoneNumber =  $request->input('phoneNumber');
    		
    		// Get the current user based on session
    		$currentUser = $request->session()->get('currentUser');
    		
    		// Set the new values to the user object model
    		$currentUser->setFirstName($firstName);
    		$currentUser->setLastName($lastName);
    		$currentUser->setPassword($password);
    		$currentUser->setEmail($email);
    		$currentUser->setPhoneNumber($phoneNumber);
    		
    		// Call the update method within UserBusinessService to update the user, set the session
    		$this->userService->update($currentUser);
    		$_SESSION['currentUser'] = $currentUser;
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving UserController.updateUser() with a successful update");
    		
    		// Put the user as the session, return the user's profile page with the updated user model
    		$request->session()->put('currentUser', $currentUser);
    		return view('settings');
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: UserController.updateUser() ", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to show the home page
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'home' - View: The home page of the website
     */
    public function viewHome() {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering UserController.viewHome()");
    	
    	try {
    		// Call viewById method in ProfileBusinessService and set to variable
    		$userProfile = $this->profileService->viewById($_SESSION['currentUser']->getId());
//     		// Call viewAllById method in JobBusinessService and set to variable
//     		$jobHistory = $this->jobService->viewAllById($_SESSION['currentUser']->getId());
//     		// Call viewAllById method in EducationBusinessService and set to variable
//     		$educationHistory = $this->educationService->viewAllById($_SESSION['currentUser']->getId());
    		// Call viewAll method in GroupBusinessService and set to variable
    		$groups = $this->groupService->viewAll();
    		// Call viewAll method in PostBusinessService and set to variable
    		$postList = $this->postService->viewAll();
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving UserController.viewHome() successfully");
    		
    		// Set $data variable to a the userProfile, groups, and postList variables and return the home view
    		$data = ['userProfile' => $userProfile, 'groups' => $groups, 'postList' => $postList];
    		return view('homePage')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: UserController.viewHome() ", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
   
    
// ----------------------------------- ADMIN FUNCTIONS ---------------------------------------------    
    
    
    /**
     * Method to direct a user to the admin page that shows all users' account information
     *
     * @return 'manageUsers' - View: The admin user page that displays all users
     */
    public function manageUserAccounts() {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering UserController.manageUserAccounts()");
    	
    	try {
    		// Call viewAll method in UserBusinessService and set to variable
    		$users = $this->userService->viewAll();
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving UserController.manageUserAccounts() successfully");
    		
    		// Set $data variable to a userList containing all users and return the manageUsers view
    		$data = ['userList' => $users];
    		return view('manageUsers')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: UserController.manageUserAccounts() ", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to view a user's information
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'adminUserView' - View: The admin's view of a user's profile page
     */
    public function viewUserAccount(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering UserController.viewUserAccount()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$userId = $request->input('userId');
    		
    		// Call viewById method in UserBusinessService and set to variable
    		$user = $this->userService->viewById($userId);
    		// Call viewById method in ProfileBusinessService and set to variable
    		$userProfile = $this->profileService->viewById($userId);
    		// Call viewAllById method in JobBusinessService and set to variable
    		$jobHistory = $this->jobService->viewAllById($userId);
    		// Call viewAllById method in EducationBusinessService and set to variable
    		$educationHistory = $this->educationService->viewAllById($userId);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving UserController.viewUserAccount() successfully");
    		
    		// Set $data variable to a the profile variables and return the adminProfile view
    		$data = ['currentUser' => $user, 'userProfile' => $userProfile, 'jobHistory' => $jobHistory, 'educationHistory' => $educationHistory];
    		return view('adminProfile')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: UserController.viewUserAccount() ", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to show the edit page of a user's account
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'adminEditProfile' - View: The admin's edit page for a user's profile
     */
    public function editUserAccount(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering UserController.editUserAccount()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$userId =  $request->input('userId');
    		
    		// Call viewById method in UserBusinessService and set to variable
    		$user = $this->userService->viewById($userId);
    		// Call viewById method in ProfileBusinessService and set to variable
    		$userProfile = $this->profileService->viewById($userId);
    		// Call viewAllById method in JobBusinessService and set to variable
    		$jobHistory = $this->jobService->viewAllById($userId);
    		// Call viewAllById method in EducationBusinessService and set to variable
    		$educationHistory = $this->educationService->viewAllById($userId);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving UserController.editUserAccount() successfully");
    		
    		// Set $data variable to a the profile variables and return the adminEditProfile view
    		$data = ['currentUser' => $user, 'userProfile' => $userProfile, 'jobHistory' => $jobHistory, 'educationHistory' => $educationHistory];
    		return view('adminEditProfile')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: UserController.editUserAccount() ", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to edit a user's information
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'manageUserAccounts' - Method: The method above to show the manageUsers page
     */
    public function updateUserAccount(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering UserController.updateUserAccount()");
    	
    	try {
    		// Get the variables within $request passed in through the form
    		$userId = $request->input('userId');
    		$role =  $request->input('role');
    		$active =  $request->input('active');
    		
    		// Call viewAllById method in UserBusinessService and set to variable
    		$user = $this->userService->viewById($userId);
    		
    		// Set the role and active status based on the update
    		$user->setRole($role);
    		$user->setActive($active);
    		
    		// Call the update method within the UserBusinessService to update the user
    		$this->userService->update($user);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving UserController.updateUserAccount() successfully");
    		
    		// Call the manageUserAccounts method above to return to the manageUsers page
    		return $this->manageUserAccounts();
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: UserController.updateUserAccount() ", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to delete a user (physical delete) from the website
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'manageUsers' - View: The admin user page that displays all users
     */
    public function deleteUserAccount(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering UserController.deleteUserAccount()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$userId = $request->input('userId');
    		
    		// Call delete method in UserBusinessService
    		$this->userService->delete($userId);
    		// Call viewAll method in UserBusinessService and set to variable
    		$users = $this->userService->viewAll();
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving UserController.deleteUserAccount() successfully");
    		
    		// Set $data variable to a userList containing all users and return the manageUsers view
    		$data = ['userList' => $users];
    		return view('manageUsers')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: UserController.deleteUserAccount() ", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to suspend a user (logical delete) from the website
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'manageUsers' - View: The admin user page that displays all users
     */
    public function suspendUserAccount(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering UserController.suspendUserAccount()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$userId = $request->input('userId');
    		
    		// Call viewById method in UserBusinessService to get the full user
    		$currentUser = $this->userService->viewById($userId);
    		
    		// Check to see if the user is active
    		if($currentUser->getActive() == 1) {
    			// Set to inactive
    			$currentUser->setActive(0);
    		}
    		// The user is inactive
    		else {
    			// Set to active
    			$currentUser->setActive(1);
    		}
    		
    		// Call update method in UserBusinessService
    		$this->userService->update($currentUser);
    		// Call viewAll method in UserBusinessService and set to variable
    		$users = $this->userService->viewAll();
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving UserController.suspendUserAccount() successfully");
    		
    		// Set $data variable to a userList containing all users and return the manageUsers view
    		$data = ['userList' => $users];
    		return view('manageUsers')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: UserController.suspendUserAccount() ", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to allow the user to log out of their account
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'index' - View: The index page of the website
     */
    public function logout(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering UserController.logout()");
    	
    	try {
    		// Forget the current user within the session
    		$request->session()->forget('currentUser');
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving UserController.logout() successfully");
    		
    		// Return the user to the index page
    		return view('index');
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: UserController.logout() ", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
}

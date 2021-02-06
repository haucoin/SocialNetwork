<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\business\UserBusinessService; 
use App\Models\User;
use App\Models\Profile;

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - AdminController is a controller class that handles the events and page navigation of admin modules
 */
class AdminController extends Controller {
   
	// Define service variable to be used as UserBusinessService
	private $service;
    
	
	/**
	 * Default constructor to initialize the Business Service object
	 */
    function __construct() {
        $this->service = new UserBusinessService();
    }
    
    
    /**
     * Method to direct a user to the admin page that shows all users' account information
     * 
     * @return 'admin' - View: The admin user page that displays all users
     */
    public function adminPage() {
    	// Set $data variable to a userList containing all users (retrieved by calling method in businesss service)
        $data = ['userList' => $this->service->viewAll()];
        
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
        $this->service->delete($userId);
        
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
        $currentUser = $this->service->viewById($userId);
        
        // Verify if the user is currently active
        if($currentUser->getActive() == 1) {
            $currentUser->setActive(0);
        }
        // The user is currently inactive
        else {
            $currentUser->setActive(1);
        }
        
        // Update the users information by calling the update method within the business service
        $this->service->update($currentUser);
        
        // Set $data variable to a userList containing all users (retrieved by calling method in businesss service)
        $data = ['userList' => $this->service->viewAll()];
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
        
        // Set $data variable to a currentUser containing the user's information (retrieved by calling method in businesss service)
        $data = ['currentUser' => $this->service->viewById($userId)];
        return view('adminUserView')->with($data); 
    }
    
    
    /**
     * Method to edit a user's information
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'adminUserView' - View: The admin's view of a user's profile page
     */
    public function adminEditUser(Request $request) {
    	// Get the variables within $request passed in through the form
    	$userId = $request->input('userId');
    	$firstName =  $request->input('firstName');
    	$lastName =  $request->input('lastName');
    	$username =  $request->input('username');
    	$password =  $request->input('password');
    	$email =  $request->input('email');
    	$role =  $request->input('role');
    	$active =  $request->input('active');
    	$bio =  $request->input('bio');
    	$phoneNumber = $request->input('phoneNumber');
    	$streetAddress = $request->input('streetAddress');
    	$city =  $request->input('city');
    	$state =  $request->input('state');
    	$zipCode =  $request->input('zipCode');
    	
    	// Create a Profile object as well as a User object with the parameters
    	$userProfile = new Profile($bio, $phoneNumber, $streetAddress, $city, $state, $zipCode);
    	$user = new User($userId, $firstName, $lastName, $username, $password, $email, $role, $active, $userProfile);
    	
    	// Call the update method within the business service function in order to update the user
    	$this->service->update($user);
    	
    	// Set $data variable to a currentUser containing the user's information (retrieved by calling method in businesss service)
    	$data = ['currentUser' => $this->service->viewById($userId)];
    	return view('adminUserView')->with($data); 
    }
}

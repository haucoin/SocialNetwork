<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Business\GroupBusinessService;
use App\Models\Group;

session_start();

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - GroupController is a controller class that handles the events and page navigation of group modules
 */
class GroupController extends Controller {
   
	// Define service variable to be used as GroupBusinessService
	private $groupService;

	
	/**
	 * Default constructor to initialize the Business Service object
	 */
    function __construct() {
    	$this->groupService = new GroupBusinessService();
    }
    
    
    /**
     * Method to direct a user to the groups page that shows all group information
     * 
     * @return 'groups' - View: The groups page that displays all groups
     */
    public function groups() {
    	// Call viewAll method in GroupBusinessService and set to variable
    	$groups = $this->groupService->viewAll();
    	// Call viewAll method in GroupBusinessService and set to variable
    	$myGroups = $this->groupService->viewAllById($_SESSION['currentUser']->getUsername());

    	// Set $data variable to the group variables and return to the profile view
    	$data = ['groupList' => $groups, 'myGroups' => $myGroups];
        return view('groups')->with($data); 
    }
    
    
    /**
     * Method to view an individual group
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'viewGroup' - View: The view of an individual group details
     */
    public function viewGroup(Request $request) {	
    	// Get the variable within $request passed in through the form
        $groupId = $request->input('groupId');
        
        // Call the viewById method in the GroupBusinessService and set to variable
        $group = $this->groupService->viewById($groupId);
        // Call viewAll method in GroupBusinessService and set to variable
        $myGroups = $this->groupService->viewAllById($_SESSION['currentUser']->getUsername());
        // Call the getUsers method in the GroupBusinessService and set to variable
        $users = $this->groupService->getUsers($groupId);
        
        // Check if the users variable is empty, if so set to "None"
        if($users == "") {
        	$users = "None";
        }
        
        // Set $data variable to the group variables and show the viewGroup page
        $data = ['group' => $group, 'myGroups' => $myGroups, 'users' => $users];
        return view('viewGroup')->with($data); 
    }
    
    
    /**
     * Method for a user to join a group
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'groups' - Method: The method above to show the groups page
     */
    public function joinGroup(Request $request) {
    	// Get the variable within $request passed in through the form
    	$groupId = $request->input('groupId');
    	
    	// Call the join method in the GroupBusinessService
    	$this->groupService->join($groupId, $_SESSION['currentUser']->getUsername());
    	
    	// Call the groups method above to shown the groups page again
    	return $this->groups();
    }
    
    
    /**
     * Method for a user to leave a group
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'groups' - Method: The method above to show the groups page
     */
    public function leaveGroup(Request $request) {
    	// Get the variable within $request passed in through the form
    	$groupId = $request->input('groupId');
    	
    	// Call the leave method in the GroupBusinessService
    	$this->groupService->leave($groupId, $_SESSION['currentUser']->getUsername());
    	
    	// Call the groups method above to shown the groups page again
    	return $this->groups();
    }
    
    

// ----------------------------------- ADMIN FUNCTIONS ---------------------------------------------   

    
    /**
     * Method to create a new group
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'groups' - Method: The method above to show the groups page
     */
    public function createGroup(Request $request) {
    	// Get the variables within $request passed in through the form
    	$name = $request->input('name');
    	$description = $request->input('description');
    	
    	// Create a new group object using the varibles
    	$group = new Group(0, $name, $description);
    	
    	// Call create method in GroupBusinessService
    	$this->groupService->create($group);
    	
    	// Call the groups method above to shown the groups page again
    	return $this->groups();
    }
    
    
    /**
     * Method to show the edit group page
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'editGroup' - View: The view of the edit page for a group
     */
    public function editGroup(Request $request) {
    	// Get the variables within $request passed in through the form
    	$groupId =  $request->input('groupId');
    	
    	// Call viewById method in GroupBusinessService and set to variable
    	$group = $this->groupService->viewById($groupId);
    	
    	// Set $data variable to the group variable and return to the editGroup view
    	$data = ['group' => $group];
    	return view('editGroup')->with($data);
    }
    
    
	/**
	 * Method to update a group
	 * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'groups' - Method: The method above to show the groups page
	 */
    public function updateGroup(Request $request) {
    	// Get the variables within $request passed in through the form
    	$id = $request->input('groupId');
    	$name =  $request->input('name');
    	$description =  $request->input('description');
    	
    	// Call viewById method in GroupBusinessService and set to variable
    	$group = $this->groupService->viewById($id);
    	
    	// Set the group attributes using variables
    	$group->setName($name);
    	$group->setDescription($description);
    	
    	// Call update method in GroupBusinessService
    	$this->groupService->update($group);
    	
    	// Call the groups method above to shown the groups page again
    	return $this->groups();
    }
    
    
	/**
	 * Method to delete a group
	 * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'groups' - Method: The method above to show the groups page
	 */
    public function deleteGroup(Request $request) {
    	// Get the variable within $request passed in through the form
    	$groupId = $request->input('groupId');
    	
    	// Call delete method in GroupBusinessService
    	$this->groupService->delete($groupId);
    	
    	// Call the groups method above to shown the groups page again
    	return $this->groups();
    } 

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Business\GroupBusinessService;
use App\Models\Group;
use App\Utility\LoggerInterface;
use Exception;

session_start();

/**
 * @name Social Network
 * @version 6.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - GroupController is a controller class that handles the events and page navigation of group modules
 */
class GroupController extends Controller {
   
	// Define service variable to be used as GroupBusinessService
	private $groupService;
	
	// Define protected logger variable
	protected $logger;

	
	/**
	 * Default constructor to initialize the Business Service object as well as the logging interface
	 */
	function __construct(LoggerInterface $logger) {
    	$this->groupService = new GroupBusinessService();
    	
    	$this->logger = $logger;
    }
    
    
    /**
     * Method to direct a user to the groups page that shows all group information
     * 
     * @return 'groups' - View: The groups page that displays all groups
     */
    public function groups() {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering GroupController.groups()");
    	
    	try {
    		// Call viewAll method in GroupBusinessService and set to variable
    		$groups = $this->groupService->viewAll();
    		// Call viewAll method in GroupBusinessService and set to variable
    		$myGroups = $this->groupService->viewAllById($_SESSION['currentUser']->getUsername());
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving GroupController.groups() successfully");
    		
    		// Set $data variable to the group variables and return to the profile view
    		$data = ['groupList' => $groups, 'myGroups' => $myGroups];
    		return view('groups')->with($data); 
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: GroupController.groups()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to view an individual group
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'viewGroup' - View: The view of an individual group details
     */
    public function viewGroup(Request $request) {	
    	
    	// Logging entering method
    	$this->logger->info("======> Entering GroupController.viewGroup()");
    	
    	try {
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
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving GroupController.viewGroup() successfully");
    		
    		// Set $data variable to the group variables and show the viewGroup page
    		$data = ['group' => $group, 'myGroups' => $myGroups, 'users' => $users];
    		return view('viewGroup')->with($data); 
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: GroupController.viewGroup()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method for a user to join a group
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'groups' - Method: The method above to show the groups page
     */
    public function joinGroup(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering GroupController.joinGroup()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$groupId = $request->input('groupId');
    		
    		// Call the join method in the GroupBusinessService
    		$this->groupService->join($groupId, $_SESSION['currentUser']->getUsername());
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving GroupController.joinGroup() successfully");
    		
    		// Call the groups method above to shown the groups page again
    		return $this->groups();
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: GroupController.joinGroup()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method for a user to leave a group
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'groups' - Method: The method above to show the groups page
     */
    public function leaveGroup(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering GroupController.leaveGroup()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$groupId = $request->input('groupId');
    		
    		// Call the leave method in the GroupBusinessService
    		$this->groupService->leave($groupId, $_SESSION['currentUser']->getUsername());
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving GroupController.leaveGroup() successfully");
    		
    		// Call the groups method above to shown the groups page again
    		return $this->groups();
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: GroupController.leaveGroup()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    

// ----------------------------------- ADMIN FUNCTIONS ---------------------------------------------   

    
    /**
     * Method to create a new group
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'groups' - Method: The method above to show the groups page
     */
    public function createGroup(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering GroupController.createGroup()");
    	
    	try {
    		// Get the variables within $request passed in through the form
    		$name = $request->input('name');
    		$description = $request->input('description');
    		
    		// Create a new group object using the varibles
    		$group = new Group(0, $name, $description);
    		
    		// Call create method in GroupBusinessService
    		$this->groupService->create($group);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving GroupController.createGroup() successfully");
    		
    		// Call the groups method above to shown the groups page again
    		return $this->groups();
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: GroupController.createGroup()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to show the edit group page
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'editGroup' - View: The view of the edit page for a group
     */
    public function editGroup(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering GroupController.editGroup()");
    	
    	try {
    		// Get the variables within $request passed in through the form
    		$groupId =  $request->input('groupId');
    		
    		// Call viewById method in GroupBusinessService and set to variable
    		$group = $this->groupService->viewById($groupId);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving GroupController.editGroup() successfully");
    		
    		// Set $data variable to the group variable and return to the editGroup view
    		$data = ['group' => $group];
    		return view('editGroup')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: GroupController.editGroup()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
	/**
	 * Method to update a group
	 * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'groups' - Method: The method above to show the groups page
	 */
    public function updateGroup(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering GroupController.updateGroup()");
    	
    	try {
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
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving GroupController.updateGroup() successfully");
    		
    		// Call the groups method above to shown the groups page again
    		return $this->groups();
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: GroupController.updateGroup()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
	/**
	 * Method to delete a group
	 * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'groups' - Method: The method above to show the groups page
	 */
    public function deleteGroup(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering GroupController.deleteGroup()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$groupId = $request->input('groupId');
    		
    		// Call delete method in GroupBusinessService
    		$this->groupService->delete($groupId);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving GroupController.deleteGroup() successfully");
    		
    		// Call the groups method above to shown the groups page again
    		return $this->groups();
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: GroupController.deleteGroup()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    } 

}

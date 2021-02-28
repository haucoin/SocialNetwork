<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Education;
use App\Business\EducationBusinessService;

session_start();

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - EducationController is a controller class that handles the events and page navigation of the education modules
 */
class EducationController extends Controller {
	
	// Define service variable to be used as EducationBusinessService
    private $educationService;
    
    
    /**
     * Default constructor to initialize the Business Service object
     */
    function __construct() {
    	$this->educationService = new EducationBusinessService();
    }
    
    
	/**
	 * Method to create an education object of a user to be displayed on their profile
	 * 
     * @param $request - Request: The request object sent from the form submission
	 * @return 'profile' - Route: A redirect to the /profile route
	 */
    public function createEducation(Request $request) {
    	// Get the variables within $request passed in through the form
    	$school = $request->input('school');
    	$degree = $request->input('degree');
    	$fieldOfStudy = $request->input('fieldOfStudy');
    	$graduationYear = $request->input('graduationYear');
    	$gpa = $request->input('gpa');
    	
    	// Create an education object using the variables
    	$education = new Education(0, $school, $degree, $fieldOfStudy, $graduationYear, $gpa, $_SESSION['currentUser']->getId());
    	
    	// Call the create method in EducationBusinessService
    	$this->educationService->create($education);
        
    	// Redirect to the /profile route
    	return redirect()->route('profile');
    }
    
    
    /**
     * Method to delete an education object of a user from their profile
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'profile' - Route: A redirect to the /profile route
     */
    public function deleteEducation(Request $request) {
    	// Get the variable within $request passed in through the form
    	$educationId = $request->input('educationId');
    	
    	// Call the delete method in EducationBusinessService
    	$this->educationService->delete($educationId);
    	
    	// Redirect to the /profile route
    	return redirect()->route('profile');
    }
    
}

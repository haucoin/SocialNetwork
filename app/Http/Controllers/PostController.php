<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Business\PostBusinessService;

/**
 * @name Social Network
 * @version 3.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - PostController is a controller class that handles the events and page navigation of post modules
 */
class PostController extends Controller {
   
	// Define service variable to be used as PostBusinessService
	private $postService;

	
	/**
	 * Default constructor to initialize the Business Service objectz
	 */
    function __construct() {
        $this->postService = new PostBusinessService();
    }
    
    
    /**
     * Method to direct a user to the posts page that shows all job post information
     * 
     * @return 'jobPostings' - View: The job posting page that displays all job postings
     */
    public function postPage() {
    	
    	// Call viewAll method in PostBusinessService and set to variable
    	$jobPostings = $this->postService->viewAll();
    	
    	// Set $data variable to a the jobPostings and return to the profile view
    	$data = ['postList' => $jobPostings];
        return view('jobPostings')->with($data); 
    }
    
    
    /**
     * Method to view an individual job post
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'viewPosting' - View: The view of an individual job posting details
     */
    public function viewPost(Request $request) {
    	
    	// Get the variables within $request passed in through the form
        $postId = $request->input('postId');
        
        // Call the viewById method in the PostBusinessService and set to variable
        $post = $this->postService->viewById($postId);
        
        // Set $data variable to the post retrieved and show the viewPosting page
        $data = ['post' => $post];
        return view('viewPosting')->with($data); 
    }
    

}

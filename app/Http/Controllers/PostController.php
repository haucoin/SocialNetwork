<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\JobPosting;
use App\Business\PostBusinessService;

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - PostController is a controller class that handles the events and page navigation of post modules
 */
class PostController extends Controller {
   
	// Define service variable to be used as PostBusinessService
	private $postService;

	
	/**
	 * Default constructor to initialize the Business Service object
	 */
    function __construct() {
        $this->postService = new PostBusinessService();
    }
    
    
    /**
     * Method to direct a user to the posts page that shows all job post information
     * 
     * @return 'jobPostings' - View: The job posting page that displays all job postings
     */
    public function viewAllPosts() {
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
    	// Get the variable within $request passed in through the form
        $postId = $request->input('postId');
        
        // Call the viewById method in the PostBusinessService and set to variable
        $post = $this->postService->viewById($postId);
        
        // Set $data variable to the post retrieved and show the viewPosting page
        $data = ['post' => $post];
        return view('viewPosting')->with($data); 
    }
    
    
    /**
     * Method to create a new job post
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'viewAllPosts' - Method: The method above to show the jobPostings page
     */
    public function createPost(Request $request) {
    	// Get the variables within $request passed in through the form
    	$company = $request->input('companyName');
    	$title = $request->input('jobTitle');
    	$description = $request->input('jobDescription');
    	$salary = $request->input('salary');
    	$location = $request->input('location');
    	
    	// Create a new JobPosting object using the variables
    	$posting = new JobPosting(0, $company, $title, $description, $salary, $location);
    	
    	// Call create method in PostBusinessService
    	$this->postService->create($posting);
    	
    	// Call the viewAllPosts method above to shown the job postings again
    	return $this->viewAllPosts();
    }
    
    
    /**
     * Method to show the edit page of a post
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'editJobPosting' - View: The view of editing a job posting
     */
    public function editPost(Request $request) {
    	// Get the variable within $request passed in through the form
    	$postId =  $request->input('postId');
    	
    	// Call viewById method in PostBusinessService and set to variable
    	$post = $this->postService->viewById($postId);
    	
    	// Set $data variable to the post variable and return to the editJobPosting view
    	$data = ['currentPost' => $post];
    	return view('editJobPosting')->with($data);
    }
    
    
    /**
     * Method to update a job post
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'viewAllPosts' - Method: The method above to show the jobPostings page
     */
    public function updatePost(Request $request) {
    	// Get the variables within $request passed in through the form
    	$id = $request->input('postId');
    	$companyName =  $request->input('companyName');
    	$jobTitle=  $request->input('jobTitle');
    	$jobDescription =  $request->input('jobDescription');
    	$salary =  $request->input('salary');
    	$location =  $request->input('location');
    	
    	// Call viewById method in PostBusinessService and set to variable
    	$post = $this->postService->viewById($id);
    	
    	// Set the post attributes using the variables
    	$post->setCompanyName($companyName);
    	$post->setJobTitle($jobTitle);
    	$post->setJobDescription($jobDescription);
    	$post->setSalary($salary);
    	$post->setLocation($location);
    	
    	// Call the update method in PostBusinessService
    	$this->postService->update($post);
    	
    	// Call the viewAllPosts method above to shown the job postings again
    	return $this->viewAllPosts();
    }
    
    
    /**
     * Method to delete a post from the website
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'jobPostings' - View: The job posting page that displays all job postings
     */
    public function deletePost(Request $request) {
    	// Get the variable within $request passed in through the form
    	$postId = $request->input('postId');
    	
    	// Call delete method in PostBusinessService
    	$this->postService->delete($postId);
    	// Call viewAll method in PostBusinessService and set to variable
    	$posts = $this->postService->viewAll();
    	
    	// Set $data variable to the post variable and return to the editJobPosting view
    	$data = ['postList' => $posts];
    	return view('jobPostings')->with($data);
    }
    

}

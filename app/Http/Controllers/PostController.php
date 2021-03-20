<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Posting;
use App\Utility\LoggerInterface;
use App\Business\PostBusinessService;
use Exception;

session_start();

/**
 * @name Social Network
 * @version 6.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - PostController is a controller class that handles the events and page navigation of post modules
 */
class PostController extends Controller {
   
	// Define service variable to be used as PostBusinessService
	private $postService;
	
	// Define protected logger variable
	protected $logger;

	
	/**
	 * Default constructor to initialize the Business Service object as well as the logging interface
	 */
	function __construct(LoggerInterface $logger) {
        $this->postService = new PostBusinessService();
        
        $this->logger = $logger;
    }
    
    
    /**
     * Method to direct a user to the posts page that shows all job post information
     * 
     * @return 'jobPostings' - View: The job posting page that displays all job postings
     */
    public function viewAllPosts() {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering PostController.viewAllPosts()");
    	
    	try {
    		// Call viewAll method in PostBusinessService and set to variable
    		$jobPostings = $this->postService->viewAll();
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving PostController.viewAllPosts() successfully");
    		
    		// Set $data variable to a the jobPostings and return to the profile view
    		$data = ['postList' => $jobPostings];
    		return view('jobPostings')->with($data); 
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: PostController.viewAllPosts()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to view an individual job post
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'viewPosting' - View: The view of an individual job posting details
     */
    public function viewPost(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering PostController.viewPost()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$postId = $request->input('postId');
    		
    		// Call the viewById method in the PostBusinessService and set to variable
    		$post = $this->postService->viewById($postId);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving PostController.viewPost() successfully");
    		
    		// Set $data variable to the post retrieved and show the viewPosting page
    		$data = ['post' => $post];
    		return view('viewPosting')->with($data); 
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: PostController.viewPost()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to create a new job post
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'viewAllPosts' - Method: The method above to show the jobPostings page
     */
    public function createPost(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering PostController.createPost()");
    	
    	try {
    		// Get the variables within $request passed in through the form
    		$company = $request->input('companyName');
    		$title = $request->input('jobTitle');
    		$description = $request->input('jobDescription');
    		$salary = $request->input('salary');
    		$location = $request->input('location');
    		
    		// Create a new Posting object using the variables
    		$posting = new Posting(0, $company, $title, $description, $salary, $location);
    		
    		// Call create method in PostBusinessService
    		$this->postService->create($posting);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving PostController.createPost() successfully");
    		
    		// Call the viewAllPosts method above to shown the job postings again
    		return $this->viewAllPosts();
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: PostController.createPost()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to show the edit page of a post
     * 
     * @param $request - Request: The request object sent from the form submission
     * @return 'editJobPosting' - View: The view of editing a job posting
     */
    public function editPost(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering PostController.editPost()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$postId =  $request->input('postId');
    		
    		// Call viewById method in PostBusinessService and set to variable
    		$post = $this->postService->viewById($postId);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving PostController.editPost() successfully");
    		
    		// Set $data variable to the post variable and return to the editJobPosting view
    		$data = ['currentPost' => $post];
    		return view('editJobPosting')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: PostController.editPost()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to update a job post
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'viewAllPosts' - Method: The method above to show the jobPostings page
     */
    public function updatePost(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering PostController.updatePost()");
    	
    	try {
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
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving PostController.updatePost() successfully");
    		
    		// Call the viewAllPosts method above to shown the job postings again
    		return $this->viewAllPosts();
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: PostController.updatePost()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to delete a post from the website
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'jobPostings' - View: The job posting page that displays all job postings
     */
    public function deletePost(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering PostController.deletePost()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$postId = $request->input('postId');
    		
    		// Call delete method in PostBusinessService
    		$this->postService->delete($postId);
    		// Call viewAll method in PostBusinessService and set to variable
    		$posts = $this->postService->viewAll();
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving PostController.deletePost() successfully");
    		
    		// Set $data variable to the post variable and return to the editJobPosting view
    		$data = ['postList' => $posts];
    		return view('jobPostings')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: PostController.deletePost()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
     
    /**
     * Method to search the job postings
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'jobPostings' - View: The job posting page that displays all job postings that match the search
     */
    public function searchJobPostings(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering PostController.searchJobPostings()");
    	
    	try {
    		// Get the variable within $request passed in through the form
    		$searchParam = $request->input('searchParam');
    		
    		// Call search method in PostBusinessService and set to variable
    		$posts = $this->postService->search($searchParam);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving PostController.searchJobPostings() successfully");
    		
    		// Set $data variable to the post variable and return to the editJobPosting view
    		$data = ['postList' => $posts];
    		return view('jobPostings')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: PostController.searchJobPostings()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }
    
    
    /**
     * Method to sort the job postings
     *
     * @param $request - Request: The request object sent from the form submission
     * @return 'jobPostings' - View: The job posting page that displays all job postings sorted by the chosen column
     */
    public function sortJobPostings(Request $request) {
    	
    	// Logging entering method
    	$this->logger->info("======> Entering PostController.sortJobPostings()");
    	
    	try {
    		// Get the variables within $request passed in through the form
    		$sortBy = $request->input('sortBy');
    		$jobPostings = unserialize(base64_decode($_POST['postList']));
    		
    		// Call sort method in PostBusinessService and set to variable
    		$posts = $this->postService->sort($sortBy, $jobPostings);
    		
    		// Logging leaving method
    		$this->logger->info("======> Leaving PostController.sortJobPostings() successfully");
    		
    		// Set $data variable to the post variable and return to the editJobPosting view
    		$data = ['postList' => $posts];
    		return view('jobPostings')->with($data);
    	}
    	// An error occurred
    	catch(Exception $e) {
    		// Logging with an error
    		$this->logger->error("*** Error: PostController.sortJobPostings()", array("message" => $e->getMessage()));
    		return view('error');
    	}
    }

}

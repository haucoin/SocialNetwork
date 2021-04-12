<?php

namespace App\Data;

use App\Models\Posting;
use Exception;

/**
 * @name Social Network
 * @version 7.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - PostDataService is a DAO that is used to access the job postings table within the database
 */
class PostingDataService implements DataServiceInterface {
    
	// Define connection variable to be used as the database connection
    private $connection;
    
    
    /**
     * Default constructor to initialize the database connection
     */
    public function __construct() {
        $database = new Database();
        $this->connection = $database->getConnection();  
    }
    
    
	/**
	 * {@inheritDoc}
	 * 
	 * @see \App\Data\DataServiceInterface::create()
	 */
    public function create($posting) {
    	
        try {
        	// SQL insert statement to create a job posting within the database
            $sqlJobPost = "INSERT INTO `JOB_POSTINGS` (`COMPANY_NAME`, `JOB_TITLE`, `JOB_DESCRIPTION`, `SALARY`, `LOCATION`)
	                           VALUES ('{$posting->getCompanyName()}', '{$posting->getJobTitle()}', '{$posting->getJobDescription()}', '{$posting->getSalary()}', '{$posting->getLocation()}');";
            
            // Run the insert group SQL statement
            $result = $this->connection->query($sqlJobPost);
            
            // Return the result
            return $result;
        } 
        // An error occurred, throw exception
        catch (Exception $e) {
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }

    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::update()
     */
    public function update($posting) {
        
    	try {
    		// SQL update statement to update a job posting within the database, run query
            $sqlJobPost = "UPDATE `JOB_POSTINGS` SET `COMPANY_NAME` = '{$posting->getCompanyName()}', `JOB_TITLE` = '{$posting->getJobTitle()}',
                                `JOB_DESCRIPTION` = '{$posting->getJobDescription()}', `SALARY` = '{$posting->getSalary()}', `LOCATION` = '{$posting->getLocation()}'
                                    WHERE `JOB_POSTINGS`.`ID` = {$posting->getId()};";
            $this->connection->query($sqlJobPost);
            
            // Get and return the number of rows affected by the update
            $numRowsAffected = $this->connection->affected_rows;
            return $numRowsAffected;
        } 
        // An error occurred, throw exception
        catch (Exception $e) {
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::delete()
     */
    public function delete($id) {
    	
        try {
        	// SQL delete statement to delete the job posting given the id, run the query
            $sqlJobPost = "DELETE FROM `JOB_POSTINGS` WHERE `ID`= {$id};";
            $this->connection->query($sqlJobPost);
            
            // Get and return the number of rows affected by the delete
            $numRowsAffected = $this->connection->affected_rows;
            return $numRowsAffected;
        } 
        // An error occurred, throw exception
        catch (Exception $e) {
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::viewAll()
     */
    public function viewAll() {
    	
        try {
        	// Create an array and index for job postings
            $jobPosts = array();
            $indexJobPost = 0;
            
            // SQL select statement to get all postings, run query
            $sqljobPost = "SELECT * FROM JOB_POSTINGS";
            $resultsJobPost = mysqli_query($this->connection, $sqljobPost);
            
            // Iterate through each row retrieved
            while ($row = $resultsJobPost->fetch_assoc()) {
                
            	// Get the ID column from the results and set to variable
                $id = $row['ID'];
                
                // Get the current posting by calling viewById method
                $currentJobPost = $this->viewByID($id);
                
                // Set the current array position to the current posting, increment index
                $jobPosts[$indexJobPost] = $currentJobPost;
                $indexJobPost ++;
            }
            
            // Return the array of posts
            return $jobPosts;
            
        } 
        // An error occurred, throw exception
        catch (Exception $e) { 
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    
    /**
     * {@inheritDoc}
     *
     * @see \App\Data\DataServiceInterface::viewById()
     */
    public function viewById($id) {
    	
    	try {
    		// SQL select statement to get a posting given the id, run query
    		$sqlJobPost = "SELECT * FROM JOB_POSTINGS WHERE ID = {$id}";
    		$resultsJobPost = mysqli_query($this->connection, $sqlJobPost);
    		
    		// Set results to associative array
    		$rowJobPost = $resultsJobPost->fetch_assoc();
    		
    		// Get the columns from the results and set to variables
    		$companyName = $rowJobPost['COMPANY_NAME'];
    		$jobTitle = $rowJobPost['JOB_TITLE'];
    		$jobDescription = $rowJobPost['JOB_DESCRIPTION'];
    		$salary = $rowJobPost['SALARY'];
    		$location = $rowJobPost['LOCATION'];
    		
    		// Create a new posting object using the variables
    		$currentJobPost = new Posting($id, $companyName, $jobTitle, $jobDescription, $salary, $location);
    		
    		// Return the posting
    		return $currentJobPost;
    	}
    	// An error occurred, throw exception
    	catch (Exception $e) {
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    }
    
    
    // ---------------------- End of data interface implementation -------------------
    
    
    /**
     *
     * @param $seachParam - String: The search string sent by the user
     * @throws Exception
     * @return $jobPosts - Array<Posting>: A list (or array) of job postings
     */
    public function search($searchParam) {
    	
    	try {
    		
    		// Create an array and index for job postings
    		$jobPosts = array();
    		$indexJobPost = 0;
    		
    		// SQL select statement to get a posting given the search term, run query
    		$sqlJobPost = "SELECT * FROM JOB_POSTINGS WHERE COMPANY_NAME LIKE '%{$searchParam}%' OR JOB_TITLE LIKE '%{$searchParam}%'";
    		$resultsJobPost = mysqli_query($this->connection, $sqlJobPost);
    		
    		// Iterate through each row retrieved
    		while ($row = $resultsJobPost->fetch_assoc()) {
    			
    			// Get the ID column from the results and set to variable
    			$id = $row['ID'];
    			
    			// Get the current posting by calling viewById method
    			$currentJobPost = $this->viewByID($id);
    			
    			// Set the current array position to the current posting, increment index
    			$jobPosts[$indexJobPost] = $currentJobPost;
    			$indexJobPost ++;
    		}
    		
    		// Return the job postings list
    		return $jobPosts;
    	}
    	// An error occurred, throw exception
    	catch (Exception $e) {
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    }
    
}


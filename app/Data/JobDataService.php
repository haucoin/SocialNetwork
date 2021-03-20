<?php

namespace App\Data;

use App\Models\Job;
use Exception;

/**
 * @name Social Network
 * @version 6.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - JobDataService is a DAO that is used to access the job table within the database
 */
class JobDataService implements DataServiceInterface {
    
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
    public function create($job) {
    	
    	try {
    		// Check if the end date is null (alters SQL statement)
    		if($job->getEndDate() == null) {
    			// SQL insert statement to create a job history within the database
    			$sqlJob = "INSERT INTO `JOBS` (`TITLE`, `DESCRIPTION`, `COMPANY`, `LOCATION`, `START_DATE`, `END_DATE`, `USER_ID`)
	                           VALUES ('{$job->getTitle()}', '{$job->getDescription()}', '{$job->getCompany()}', '{$job->getLocation()}', '{$job->getStartDate()}', null, '{$_SESSION['currentUser']->getId()}');";
    		}
    		// End date was entered
    		else {
    			// SQL insert statement to create a job history within the database
	    		$sqlJob = "INSERT INTO `JOBS` (`TITLE`, `DESCRIPTION`, `COMPANY`, `LOCATION`, `START_DATE`, `END_DATE`, `USER_ID`)
		                           VALUES ('{$job->getTitle()}', '{$job->getDescription()}', '{$job->getCompany()}', '{$job->getLocation()}', '{$job->getStartDate()}', '{$job->getEndDate()}', '{$_SESSION['currentUser']->getId()}');";
	    	}
    		
    		// Run the insert SQL statement and return the result
	    	$result = $this->connection->query($sqlJob);
    		return $result;
    	} 
    	// An error occurred, throw exception
    	catch (Exception $e) {
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    	
    }

    
    /**
     * UNUSED FOR THIS DATA SERVICE
     */
    public function update($job) { }

    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::delete()
     */
    public function delete(int $id) {
    	
    	try {
    		// SQL delete statements to remove the user's job from the database given the id passed in
    		$sqlStatement = "DELETE FROM `JOBS` WHERE `ID`= {$id};";
	        
    		// Run the delete user SQL statement
    		$result = $this->connection->query($sqlStatement);
	        
	        // Return the result
    		return $result;
    	}
    	// An error occurred, throw exception
        catch(Exception $e) {
        	throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    
    /**
     * UNUSED FOR THIS DATA SERVICE
     */
    public function viewAll() { }
    
    
    /**
     * UNUSED FOR THIS DATA SERVICE
     */
    public function viewById(int $id) { }
    
    
    // ---------------------- End of data interface implementation -------------------

    
    /**
     * Method to get all of the job history of a user
     *
     * @param $userId - Integer: The ID of the user
     * @throws Exception
     * @return $jobs - Array<Job>: A list (or array) of a user's job history
     */
    public function viewAllById(int $userId) {
    	
    	try {
    		// Create an array to store the job history with an index
    		$jobs = array();
    		$indexJob = 0;
    		
    		// SQL select statement to check to get job history of a user, run query
    		$sqlStatement = "SELECT * FROM JOBS WHERE USER_ID = {$userId}";
    		$resultsJobs = mysqli_query($this->connection, $sqlStatement);
    		
    		// Iterate through all job history retrieved
    		while($row = $resultsJobs->fetch_assoc()) {
    			// Set table column results to variables
    			$id = $row['ID'];
    			$title = $row['TITLE'];
    			$description = $row['DESCRIPTION'];
    			$company = $row['COMPANY'];
    			$location = $row['LOCATION'];
    			$startDate = $row['START_DATE'];
    			$endDate = $row['END_DATE'];
    			$userId = $row['USER_ID'];
    			
    			// Create a new job object using the variables
    			$currentJob = new Job($id, $title, $description, $company, $location, $startDate, $endDate, $userId);
    			
    			// Add the job object to the array
    			$jobs[$indexJob] = $currentJob;
    			$indexJob++;
    		}
    		
    		// Return the array of job objects
    		return $jobs;
    		
    	} 
    	// An error occurred, throw exception
    	catch (Exception $e) {
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    }
    
}
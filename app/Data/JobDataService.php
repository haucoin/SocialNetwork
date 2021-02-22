<?php

namespace App\Data;

use App\Models\Job;
use Exception;

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - UserDataService is a DAO that is used to access the users table within the database
 */
Class JobDataService {
    
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
    		// SQL insert statement to create the profile within the database for the user of the passed in id
    		$sqlProfile = "INSERT INTO `JOBS` (`TITLE`, `DESCRIPTION`, `COMPANY`, `LOCATION`, `START_DATE`, `END_DATE`, `USER_ID`)
	                           VALUES ('{$job->getTitle()}', '{$job->getDescription()}', '{$job->getCompany()}', '{$job->getLocation()}', '{$job->getStartDate()}', '{$job->getEndDate()}', '{$_SESSION['currentUser']->getId()}');";
    		
    		// Run the insert profile SQL statement
    		$result = $this->connection->query($sqlProfile);
    		
    		return $result;
    	} 
    	catch (Exception $e) {
    		// Throw exception
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    	
    }

    
	/**
	 * {@inheritDoc}
	 * 
	 * @see \App\Data\DataServiceInterface::update()
	 */
    public function update($job) {
        
    	try {
	        
	        // SQL update statements to update the user within the database to the user object passed in
    		$sqlStatement = "UPDATE `JOBS` SET `TITLE` = '{$job->getTitle()}', `DESCRIPTION` = '{$job->getDescription()}', `COMPANY` = '{$job->getCompany()}', 
                                    `LOCATION` = '{$job->getLocation()}', `START_DATE` = '{$job->getStartDate()}', `END_DATE` = '{$job->getEndDate()}' WHERE `JOBS`.`ID` = {$job->getId()};";
	        
	        // Run the update user SQL statement
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
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::delete()
     */
    public function delete(int $id) {
    	
    	try {
	        
	        // SQL delete statements to remove the user's profile from the database given the id passed in
    		$sqlStatement = "DELETE FROM `JOBS` WHERE `ID`= {$id};";
	        
	        // Run the delete user SQL statement and add to affected rows
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
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::viewById()
     */
    public function viewByUserId(int $userId) {
    	
    	try {
    		// Create an array to store the users with an index
    		$jobs = array();
    		$indexJob = 0;
    		
    		// Select statment for profiles
    		$sqlStatement = "SELECT * FROM JOBS WHERE USER_ID = {$userId}";
    		
    		$resultsJobs = mysqli_query($this->connection, $sqlStatement);
    		
    		// Iterate through all users retrieved
    		while($row = $resultsJobs->fetch_assoc()) {
    			// Get the id of current user
    			$id = $row['ID'];
    			$title = $row['TITLE'];
    			$description = $row['DESCRIPTION'];
    			$company = $row['COMPANY'];
    			$location = $row['LOCATION'];
    			$startDate = $row['START_DATE'];
    			$endDate = $row['END_DATE'];
    			$userId = $row['USER_ID'];
    			
    			// Get the current user using the id
    			$currentJob = new Job($id, $title, $description, $company, $location, $startDate, $endDate, $userId);
    			
    			// Add the user object to the array
    			$jobs[$indexJob] = $currentJob;
    			$indexJob++;
    		}
    		
    		// Return the array of education objects
    		return $jobs;
    		
    	} 
    	catch (Exception $e) {
    		// Throw exception
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    	
    }
    
    
    
	public function viewAll() {
		
	}

    
}
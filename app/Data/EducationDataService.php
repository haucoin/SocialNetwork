<?php

namespace App\Data;

use App\Models\Education;
use Exception;

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - UserDataService is a DAO that is used to access the users table within the database
 */
Class EducationDataService {
    
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
    public function create($education) {
    	
    	try {
    		// SQL insert statement to create an eduation within the database for the user of the passed in id
    		$sqlStatement = "INSERT INTO `EDUCATION` (`SCHOOL`, `DEGREE`, `FIELD_OF_STUDY`, `GRADUATION_YEAR`, `GPA`, `USER_ID`)
	                           VALUES ('{$education->getSchool()}', '{$education->getDegree()}', '{$education->getFieldOfStudy()}', '{$education->getGraduationYear()}', '{$education->getGpa()}', '{$_SESSION['currentUser']->getId()}');";
    		
    		// Run the insert education SQL statement
    		$result = $this->connection->query($sqlStatement);
    		
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
    public function update($education) {
        
    	try {
	        
	        // SQL update statements to update the user within the database to the user object passed in
    		$sqlStatement = "UPDATE `EDUCATION` SET `SCHOOL` = '{$education->getSchool()}', `DEGREE` = '{$education->getDegree()}', `FIELD_OF_STUDY` = '{$education->getFieldOfStudy()}', 
                                    `GRADUATION_YEAR` = '{$education->getGraduationYear()}', `GPA` = '{$education->getGpa()}' WHERE `EDUCATION`.`ID` = {$education->getId()};";
	        
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
    		$sqlStatement = "DELETE FROM `EDUCATION` WHERE `ID`= {$id};";
	        
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
    		$education = array();
    		$indexEducation = 0; 
    		
    		// Select statment for profiles
    		$sqlStatement = "SELECT * FROM EDUCATION WHERE USER_ID = {$userId}";
    		
    		$resultsEducation = mysqli_query($this->connection, $sqlStatement);
    		
    		// Iterate through all users retrieved
    		while($row = $resultsEducation->fetch_assoc()) {
    			// Get the id of current user
    			$id = $row['ID'];
    			$school = $row['SCHOOL'];
    			$degree = $row['DEGREE'];
    			$fieldOfStudy = $row['FIELD_OF_STUDY'];
    			$graduationYear = $row['GRADUATION_YEAR'];
    			$gpa = $row['GPA'];
    			$userId = $row['USER_ID'];
    			
    			// Get the current user using the id
    			$currentEducation = new Education($id, $school, $degree, $fieldOfStudy, $graduationYear, $gpa, $userId);
    			
    			// Add the user object to the array
    			$education[$indexEducation] = $currentEducation;
    			$indexEducation++;
    		}
    		
    		// Return the array of education objects
    		return $education;
    		
    	} 
    	catch (Exception $e) {
    		// Throw exception
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    	
    }
    
    
    
	public function viewAll() {
		
	}

    
}